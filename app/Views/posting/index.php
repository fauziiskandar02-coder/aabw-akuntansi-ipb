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
        <div class="card">
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

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th rowspan="2" class="text-center align-middle" style="width: 10%">Date</th>
                                <th rowspan="2" class="align-middle" style="width: 25%">Description</th>
                                <th rowspan="2" class="text-center align-middle" style="width: 8%">Ref</th>
                                <th rowspan="2" class="text-right align-middle" style="width: 14%">Debit (IDR)</th>
                                <th rowspan="2" class="text-right align-middle" style="width: 14%">Credit (IDR)</th>
                                <th colspan="2" class="text-center" style="width: 29%">Balance (IDR)</th>
                            </tr>
                            <tr>
                                <th class="text-right" style="width: 14.5%">Debit</th>
                                <th class="text-right" style="width: 14.5%">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $saldo = 0;
                            $totDebit = 0;
                            $totKredit = 0;
                            foreach ($dtposting as $row) :
                                $totDebit += $row->debit;
                                $totKredit += $row->kredit;
                                $firstDigit = substr((string)$row->kode_akun3, 0, 1);
                                if ($firstDigit == '1' || $firstDigit == '5') {
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
                                    <td><?= !empty($row->ketjurnal) ? $row->ketjurnal : $row->deskripsi ?> (<?= $row->nama_akun3 ?>)</td>
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
                                <td colspan="3" class="text-right">TOTAL MUTASI:</td>
                                <td class="text-right">Rp <?= number_format($totDebit, 0, ',', '.') ?></td>
                                <td class="text-right">Rp <?= number_format($totKredit, 0, ',', '.') ?></td>
                                <td colspan="2" class="text-center">
                                    Saldo Akhir: Rp <?= number_format(abs($saldo), 0, ',', '.') ?> (<?= $saldo >= 0 ? 'Normal' : 'Menyesuaikan' ?>)
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
