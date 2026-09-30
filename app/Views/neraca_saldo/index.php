<?= $this->extend('layout/backend') ?>
<?php /** @var array $dtneraca */ ?>
<?php /** @var string $tgl_awal */ ?>
<?php /** @var string $tgl_akhir */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Trial Balance</title>

<section class="section">
    <div class="section-header">
        <h1>Trial Balance</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Filter & Export Trial Balance</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= site_url('neracasaldo') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="row align-items-end">
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
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-filter"></i> Filter / Display</button>
                            <button type="submit" formaction="<?= site_url('neracasaldo/cetak') ?>" formtarget="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Export PDF</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="width: 15%">Account Code</th>
                                <th style="width: 45%">Account Title</th>
                                <th class="text-right" style="width: 20%">Debit (IDR)</th>
                                <th class="text-right" style="width: 20%">Credit (IDR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalDebit = 0;
                            $totalKredit = 0;
                            foreach ($dtneraca as $row) :
                                $firstDigit = substr((string)$row->kode_akun3, 0, 1);
                                if ($firstDigit == '1' || $firstDigit == '5') {
                                    $net = $row->debit - $row->kredit;
                                    $saldoDeb = ($net >= 0) ? $net : 0;
                                    $saldoKre = ($net < 0) ? abs($net) : 0;
                                } else {
                                    $net = $row->kredit - $row->debit;
                                    $saldoKre = ($net >= 0) ? $net : 0;
                                    $saldoDeb = ($net < 0) ? abs($net) : 0;
                                }
                                $totalDebit += $saldoDeb;
                                $totalKredit += $saldoKre;
                            ?>
                                <tr>
                                    <td class="text-center"><?= $row->kode_akun3 ?></td>
                                    <td><?= $row->nama_akun3 ?></td>
                                    <td class="text-right"><?= $saldoDeb > 0 ? number_format($saldoDeb, 0, ',', '.') : '-' ?></td>
                                    <td class="text-right"><?= $saldoKre > 0 ? number_format($saldoKre, 0, ',', '.') : '-' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-light font-weight-bold">
                                <td colspan="2" class="text-right">TOTAL:</td>
                                <td class="text-right">Rp <?= number_format($totalDebit, 0, ',', '.') ?></td>
                                <td class="text-right">Rp <?= number_format($totalKredit, 0, ',', '.') ?></td>
                            </tr>
                            <tr class="text-center font-weight-bold">
                                <td colspan="4">
                                    <?php if ($totalDebit == $totalKredit && $totalDebit > 0) : ?>
                                        <span class="badge badge-success px-4 py-2"><i class="fas fa-check-circle"></i> STATUS: BALANCED</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger px-4 py-2"><i class="fas fa-exclamation-triangle"></i> STATUS: UNBALANCED</span>
                                    <?php endif; ?>
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
