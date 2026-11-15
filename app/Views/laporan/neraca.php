<?= $this->extend('layout/backend') ?>
<?php /** @var array $aktivaLancar */ ?>
<?php /** @var array $aktivaTetap */ ?>
<?php /** @var array $kewajiban */ ?>
<?php /** @var float $modalAkhir */ ?>
<?php /** @var string $tgl_awal */ ?>
<?php /** @var string $tgl_akhir */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Balance Sheet</title>

<section class="section">
    <div class="section-header">
        <h1>Balance Sheet</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Company Financial Balance Sheet</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= site_url('laporan/neraca') ?>" method="post">
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
                $totLancar = array_sum(array_column($aktivaLancar, 'nilai'));
                $totTetap  = array_sum(array_column($aktivaTetap, 'nilai'));
                $totAktiva = $totLancar + $totTetap;

                $totKewajiban = array_sum(array_column($kewajiban, 'nilai'));
                $totPasiva    = $totKewajiban + $modalAkhir;
                ?>

                <div class="row">
                    <!-- SISI AKTIVA / ASSETS -->
                    <div class="col-md-6">
                        <div class="card border mb-4">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="mb-0 text-cyan"><i class="fas fa-wallet mr-2"></i>ASSETS</h5>
                            </div>
                            <div class="card-body p-3">
                                <h6 class="text-white small font-weight-bold mb-2">// Current Assets:</h6>
                                <table class="table table-sm mb-3">
                                    <tbody>
                                        <?php foreach ($aktivaLancar as $a) : ?>
                                            <tr>
                                                <td class="text-muted"><?= $a['nama'] ?></td>
                                                <td class="text-right font-monospace">Rp <?= number_format($a['nilai'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr class="report-summary-row font-weight-bold">
                                            <td class="text-white">Total Current Assets</td>
                                            <td class="text-right font-monospace" style="color: #38bdf8 !important;">Rp <?= number_format($totLancar, 0, ',', '.') ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h6 class="text-white small font-weight-bold mt-3 mb-2">// Fixed Assets:</h6>
                                <table class="table table-sm mb-0">
                                    <tbody>
                                        <?php foreach ($aktivaTetap as $a) : ?>
                                            <tr>
                                                <td class="text-muted"><?= $a['nama'] ?></td>
                                                <td class="text-right font-monospace"><?= $a['nilai'] < 0 ? '(Rp ' . number_format(abs($a['nilai']), 0, ',', '.') . ')' : 'Rp ' . number_format($a['nilai'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr class="report-summary-row font-weight-bold">
                                            <td class="text-white">Total Fixed Assets</td>
                                            <td class="text-right font-monospace" style="color: #38bdf8 !important;">Rp <?= number_format($totTetap, 0, ',', '.') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer font-weight-bold h6 d-flex justify-content-between mb-0" style="border-top: 2px solid rgba(56, 189, 248, 0.35); background: rgba(8, 14, 28, 0.75);">
                                <span class="text-white" style="letter-spacing: 0.8px;">TOTAL ASSETS:</span>
                                <span class="font-monospace" style="color: var(--cyan-bright) !important; text-shadow: 0 0 10px rgba(0, 240, 255, 0.3);">Rp <?= number_format($totAktiva, 0, ',', '.') ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- SISI PASIVA / LIABILITIES & EQUITY -->
                    <div class="col-md-6">
                        <div class="card border mb-4">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="mb-0 text-cyan"><i class="fas fa-balance-scale mr-2"></i>LIABILITIES & OWNER'S EQUITY</h5>
                            </div>
                            <div class="card-body p-3">
                                <h6 class="text-white small font-weight-bold mb-2">// Liabilities:</h6>
                                <table class="table table-sm mb-3">
                                    <tbody>
                                        <?php foreach ($kewajiban as $k) : ?>
                                            <tr>
                                                <td class="text-muted"><?= $k['nama'] ?></td>
                                                <td class="text-right font-monospace">Rp <?= number_format($k['nilai'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr class="report-summary-row font-weight-bold">
                                            <td class="text-white">Total Liabilities</td>
                                            <td class="text-right font-monospace" style="color: #38bdf8 !important;">Rp <?= number_format($totKewajiban, 0, ',', '.') ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h6 class="text-white small font-weight-bold mt-3 mb-2">// Owner's Equity:</h6>
                                <table class="table table-sm mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-muted">Ending Owner's Capital</td>
                                            <td class="text-right font-monospace">Rp <?= number_format($modalAkhir, 0, ',', '.') ?></td>
                                        </tr>
                                        <tr class="report-summary-row font-weight-bold">
                                            <td class="text-white">Total Equity</td>
                                            <td class="text-right font-monospace" style="color: #38bdf8 !important;">Rp <?= number_format($modalAkhir, 0, ',', '.') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer font-weight-bold h6 d-flex justify-content-between mb-0" style="border-top: 2px solid rgba(56, 189, 248, 0.35); background: rgba(8, 14, 28, 0.75);">
                                <span class="text-white" style="letter-spacing: 0.8px;">TOTAL LIABILITIES & EQUITY:</span>
                                <span class="font-monospace" style="color: var(--cyan-bright) !important; text-shadow: 0 0 10px rgba(0, 240, 255, 0.3);">Rp <?= number_format($totPasiva, 0, ',', '.') ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert <?= ($totAktiva == $totPasiva) ? 'alert-success' : 'alert-danger' ?> mt-3 text-center font-weight-bold">
                    <?php if ($totAktiva == $totPasiva) : ?>
                        <i class="fas fa-check-circle"></i> BALANCE SHEET STATUS: BALANCED | Total Assets (Rp <?= number_format($totAktiva, 0, ',', '.') ?>) = Total Liabilities & Equity (Rp <?= number_format($totPasiva, 0, ',', '.') ?>)
                    <?php else : ?>
                        <i class="fas fa-exclamation-triangle"></i> BALANCE SHEET STATUS: UNBALANCED | Difference Rp <?= number_format(abs($totAktiva - $totPasiva), 0, ',', '.') ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
