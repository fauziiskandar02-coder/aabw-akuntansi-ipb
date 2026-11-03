<?= $this->extend('layout/backend') ?>
<?php /** @var array $dtposting */ ?>
<?php /** @var array $dtakun3 */ ?>
<?php /** @var string $tgl_awal */ ?>
<?php /** @var string $tgl_akhir */ ?>
<?php /** @var string $kode_akun3 */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; General Ledger Posting</title>

<section class="section">
    <div class="section-header">
        <h1>General Ledger Posting</h1>
    </div>

    <div class="section-body">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Filter & Export General Ledger</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= site_url('posting') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label>Select Account</label>
                                <select class="form-control" name="kode_akun3">
                                    <option value="">-- All Accounts --</option>
                                    <?php foreach ($dtakun3 as $akun) : ?>
                                        <option value="<?= $akun->kode_akun3 ?>" <?= ($kode_akun3 == $akun->kode_akun3) ? 'selected' : '' ?>>
                                            <?= $akun->kode_akun3 ?> - <?= $akun->nama_akun3 ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="tgl_awal" value="<?= $tgl_awal ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label>End Date</label>
                                <input type="date" class="form-control" name="tgl_akhir" value="<?= $tgl_akhir ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-filter"></i> Filter / Display</button>
                            <button type="submit" formaction="<?= site_url('posting/cetak') ?>" formtarget="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Export PDF</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php
        // Group transactions by account so each general ledger account has its own independent running balance
        $groupedPosting = [];
        foreach ($dtposting as $row) {
            $groupedPosting[$row->kode_akun3]['nama'] = $row->nama_akun3;
            $groupedPosting[$row->kode_akun3]['rows'][] = $row;
        }
        ?>

        <?php if (empty($groupedPosting)) : ?>
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No General Ledger records found for the selected filter.</h5>
                </div>
            </div>
        <?php else : ?>
            <?php foreach ($groupedPosting as $kodeAkun => $accData) : 
                $firstDigit = substr((string)$kodeAkun, 0, 1);
                $isDebitNormal = ($firstDigit == '1' && $kodeAkun != 1202) 
                              || $firstDigit == '5' 
                              || substr((string)$kodeAkun, 0, 2) == '32';
                $saldo = 0;
                $totDebit = 0;
                $totKredit = 0;
            ?>
                <div class="card mb-4 border shadow-sm">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                        <h6 class="mb-0 font-weight-bold text-primary">
                            <i class="fas fa-book mr-2"></i> Account: <?= $kodeAkun ?> &mdash; <?= $accData['nama'] ?>
                        </h6>
                        <span class="badge badge-info text-uppercase font-weight-bold">
                            Normal: <?= $isDebitNormal ? 'Debit (+)' : 'Credit (+)' ?>
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th rowspan="2" class="text-center align-middle" style="width: 12%">Date</th>
                                        <th rowspan="2" class="align-middle" style="width: 34%">Description</th>
                                        <th rowspan="2" class="text-center align-middle" style="width: 8%">Ref</th>
                                        <th rowspan="2" class="text-right align-middle" style="width: 14%">Debit (IDR)</th>
                                        <th rowspan="2" class="text-right align-middle" style="width: 14%">Credit (IDR)</th>
                                        <th colspan="2" class="text-center" style="width: 18%">Balance (IDR)</th>
                                    </tr>
                                    <tr>
                                        <th class="text-right" style="width: 9%">Debit</th>
                                        <th class="text-right" style="width: 9%">Credit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($accData['rows'] as $row) : 
                                        $totDebit += $row->debit;
                                        $totKredit += $row->kredit;
                                        if ($isDebitNormal) {
                                            $saldo += ($row->debit - $row->kredit);
                                            $saldoDebit = ($saldo >= 0) ? $saldo : 0;
                                            $saldoKredit = ($saldo < 0) ? abs($saldo) : 0;
                                        } else {
                                            $saldo += ($row->kredit - $row->debit);
                                            $saldoKredit = ($saldo >= 0) ? $saldo : 0;
                                            $saldoDebit = ($saldo < 0) ? abs($saldo) : 0;
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= date('d/m/Y', strtotime($row->tanggal)) ?></td>
                                            <td><?= !empty($row->ketjurnal) ? $row->ketjurnal : $row->deskripsi ?></td>
                                            <td class="text-center"><?= $row->kode_akun3 ?></td>
                                            <td class="text-right"><?= $row->debit > 0 ? number_format($row->debit, 0, ',', '.') : '-' ?></td>
                                            <td class="text-right"><?= $row->kredit > 0 ? number_format($row->kredit, 0, ',', '.') : '-' ?></td>
                                            <td class="text-right"><?= $saldoDebit > 0 ? number_format($saldoDebit, 0, ',', '.') : '-' ?></td>
                                            <td class="text-right"><?= $saldoKredit > 0 ? number_format($saldoKredit, 0, ',', '.') : '-' ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light font-weight-bold">
                                        <td colspan="3" class="text-right">MUTATION TOTAL:</td>
                                        <td class="text-right">Rp <?= number_format($totDebit, 0, ',', '.') ?></td>
                                        <td class="text-right">Rp <?= number_format($totKredit, 0, ',', '.') ?></td>
                                        <td colspan="2" class="text-center font-weight-bold text-primary">
                                            Ending Balance: Rp <?= number_format(abs($saldo), 0, ',', '.') ?> (<?= $isDebitNormal ? ($saldo >= 0 ? 'Debit' : 'Credit') : ($saldo >= 0 ? 'Credit' : 'Debit') ?>)
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
