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
                            <input type="date" class="form-control" name="tgl_awal" value="<?= esc($tgl_awal) ?>">
                        </div>
                        <div class="col-md-3">
                            <label>End Date</label>
                            <input type="date" class="form-control" name="tgl_akhir" value="<?= esc($tgl_akhir) ?>">
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
                            <tr class="report-section-header">
                                <th colspan="2" class="font-weight-bold text-cyan"><i class="fas fa-coins mr-2"></i>A. CASH FLOWS FROM OPERATING ACTIVITIES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="font-weight-bold"><td colspan="2" class="text-white small">// Operating Cash Receipts:</td></tr>
                            <?php foreach ($operasionalMasuk as $om) : ?>
                                <tr>
                                    <td class="pl-4 text-muted"><?= esc($om['deskripsi']) ?></td>
                                    <td class="text-right font-monospace">Rp <?= number_format($om['nilai'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>

                            <tr class="font-weight-bold mt-2"><td colspan="2" class="text-white small">// Operating Cash Disbursements:</td></tr>
                            <?php foreach ($operasionalKeluar as $ok) : ?>
                                <tr>
                                    <td class="pl-4 text-muted"><?= esc($ok['deskripsi']) ?></td>
                                    <td class="text-right font-monospace text-danger" style="color: #f87171 !important;">( Rp <?= number_format($ok['nilai'], 0, ',', '.') ?> )</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="report-summary-row font-weight-bold">
                                <td class="text-white">Net Cash Flows from Operating Activities</td>
                                <td class="text-right font-monospace" style="color: #38bdf8 !important;">Rp <?= number_format($netOperasi, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>

                        <thead>
                            <tr class="report-section-header">
                                <th colspan="2" class="font-weight-bold text-cyan"><i class="fas fa-chart-line mr-2"></i>B. CASH FLOWS FROM INVESTING & FINANCING ACTIVITIES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($investasiMasuk as $im) : ?>
                                <tr>
                                    <td class="pl-4 text-muted"><?= esc($im['deskripsi']) ?></td>
                                    <td class="text-right font-monospace">Rp <?= number_format($im['nilai'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php foreach ($investasiKeluar as $ik) : ?>
                                <tr>
                                    <td class="pl-4 text-muted"><?= esc($ik['deskripsi']) ?></td>
                                    <td class="text-right font-monospace text-danger" style="color: #f87171 !important;">( Rp <?= number_format($ik['nilai'], 0, ',', '.') ?> )</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="report-summary-row font-weight-bold">
                                <td class="text-white">Net Cash Flows from Investing / Financing Activities</td>
                                <td class="text-right font-monospace" style="color: #38bdf8 !important;">Rp <?= number_format($netInvestasi, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr class="report-total-row font-weight-bold">
                                <td class="text-white" style="letter-spacing: 0.8px;"><i class="fas fa-money-bill-wave text-cyan mr-2"></i>NET INCREASE / (DECREASE) IN CASH (ENDING BALANCE):</td>
                                <td class="text-right font-monospace" style="color: var(--cyan-bright) !important; font-size: 15px; text-shadow: 0 0 10px rgba(0, 240, 255, 0.3);">
                                    Rp <?= number_format($netKas, 0, ',', '.') ?>
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
