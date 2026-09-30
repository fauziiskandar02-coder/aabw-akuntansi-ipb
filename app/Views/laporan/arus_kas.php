<?= $this->extend('layout/backend') ?>
<?php /** @var array $operasionalMasuk */ ?>
<?php /** @var array $operasionalKeluar */ ?>
<?php /** @var array $investasiMasuk */ ?>
<?php /** @var array $investasiKeluar */ ?>
<?php /** @var string $tgl_awal */ ?>
<?php /** @var string $tgl_akhir */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Cash Flow Statement</title>

<section class="section">
    <div class="section-header">
        <h1>Cash Flow Statement</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Inflow & Outflow of Cash</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= site_url('laporan/arus-kas') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="row align-items-end mb-4">
                        <div class="col-md-3">
                            <label>Start Date</label>
                            <input type="date" class="form-control" name="tgl_awal" value="<?= $tgl_awal ?>">
                        </div>
                        <div class="col-md-3">
                            <label>End Date</label>
                            <input type="date" class="form-control" name="tgl_akhir" value="<?= $tgl_akhir ?>">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter / Display</button>
                            <button type="button" onclick="window.print()" class="btn btn-secondary ml-2"><i class="fas fa-print"></i> Print</button>
                        </div>
                    </div>
                </form>

                <?php
                $totOpMasuk  = array_sum(array_column($operasionalMasuk, 'nilai'));
                $totOpKeluar = array_sum(array_column($operasionalKeluar, 'nilai'));
                $netOperasi  = $totOpMasuk - $totOpKeluar;

                $totInvMasuk  = array_sum(array_column($investasiMasuk, 'nilai'));
                $totInvKeluar = array_sum(array_column($investasiKeluar, 'nilai'));
                $netInvestasi = $totInvMasuk - $totInvKeluar;

                $netKas = $netOperasi + $netInvestasi;
                ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr class="table-primary">
                                <th colspan="2" class="font-weight-bold">A. CASH FLOWS FROM OPERATING ACTIVITIES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="font-weight-bold"><td colspan="2">Operating Cash Receipts:</td></tr>
                            <?php foreach ($operasionalMasuk as $om) : ?>
                                <tr>
                                    <td class="pl-4"><?= $om['deskripsi'] ?></td>
                                    <td class="text-right">Rp <?= number_format($om['nilai'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>

                            <tr class="font-weight-bold mt-2"><td colspan="2">Operating Cash Disbursements:</td></tr>
                            <?php foreach ($operasionalKeluar as $ok) : ?>
                                <tr>
                                    <td class="pl-4"><?= $ok['deskripsi'] ?></td>
                                    <td class="text-right text-danger">( Rp <?= number_format($ok['nilai'], 0, ',', '.') ?> )</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="bg-light font-weight-bold">
                                <td>Net Cash Flows from Operating Activities</td>
                                <td class="text-right">Rp <?= number_format($netOperasi, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>

                        <thead>
                            <tr class="table-warning">
                                <th colspan="2" class="font-weight-bold">B. CASH FLOWS FROM INVESTING & FINANCING ACTIVITIES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($investasiMasuk as $im) : ?>
                                <tr>
                                    <td class="pl-4"><?= $im['deskripsi'] ?></td>
                                    <td class="text-right">Rp <?= number_format($im['nilai'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php foreach ($investasiKeluar as $ik) : ?>
                                <tr>
                                    <td class="pl-4"><?= $ik['deskripsi'] ?></td>
                                    <td class="text-right text-danger">( Rp <?= number_format($ik['nilai'], 0, ',', '.') ?> )</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="bg-light font-weight-bold">
                                <td>Net Cash Flows from Investing / Financing Activities</td>
                                <td class="text-right">Rp <?= number_format($netInvestasi, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr class="table-success font-weight-bold h5">
                                <td>NET INCREASE / (DECREASE) IN CASH (ENDING CASH BALANCE):</td>
                                <td class="text-right">Rp <?= number_format($netKas, 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
