<?= $this->extend('layout/backend') ?>
<?php /** @var float $modalAwal */ ?>
<?php /** @var float $labaBersih */ ?>
<?php /** @var float $prive */ ?>
<?php /** @var float $modalAkhir */ ?>
<?php /** @var string $tgl_awal */ ?>
<?php /** @var string $tgl_akhir */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Statement of Owner's Equity</title>

<section class="section">
    <div class="section-header">
        <h1>Statement of Owner's Equity</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Statement of Changes in Owner's Equity</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= site_url('laporan/perubahan-modal') ?>" method="post">
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
                $perubahanNet = $labaBersih - $prive;
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tbody>
                            <tr>
                                <td style="width: 70%" class="font-weight-bold text-white"><i class="fas fa-coins text-cyan mr-2"></i>Beginning Owner's Capital</td>
                                <td style="width: 30%" class="text-right font-weight-bold font-monospace">Rp <?= number_format($modalAwal, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td class="pl-4 text-muted"><i class="fas fa-chart-line text-cyan mr-2"></i><?= $labaBersih >= 0 ? 'Net Profit for the Period' : 'Net Loss for the Period' ?></td>
                                <td class="text-right font-monospace <?= $labaBersih >= 0 ? 'text-success' : 'text-danger' ?>" style="color: <?= $labaBersih >= 0 ? '#34d399' : '#f87171' ?> !important;">
                                    <?= $labaBersih >= 0 ? 'Rp ' . number_format($labaBersih, 0, ',', '.') : '( Rp ' . number_format(abs($labaBersih), 0, ',', '.') . ' )' ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-4 text-muted"><i class="fas fa-hand-holding-usd text-warning mr-2"></i>Owner's Drawings (Prive)</td>
                                <td class="text-right font-monospace text-danger" style="color: #f87171 !important;">( Rp <?= number_format($prive, 0, ',', '.') ?> )</td>
                            </tr>
                            <tr class="report-summary-row font-weight-bold">
                                <td class="text-white"><i class="fas fa-exchange-alt text-cyan mr-2"></i>Net Increase / (Decrease) in Capital</td>
                                <td class="text-right font-monospace" style="color: <?= $perubahanNet >= 0 ? '#38bdf8' : '#f87171' ?> !important;">
                                    <?= $perubahanNet >= 0 ? 'Rp ' . number_format($perubahanNet, 0, ',', '.') : '( Rp ' . number_format(abs($perubahanNet), 0, ',', '.') . ' )' ?>
                                </td>
                            </tr>
                            <tr class="report-total-row font-weight-bold h6 mb-0">
                                <td class="text-white" style="letter-spacing: 0.8px;"><i class="fas fa-landmark text-cyan mr-2"></i>ENDING OWNER'S CAPITAL</td>
                                <td class="text-right font-monospace" style="color: var(--cyan-bright) !important; font-size: 15px; text-shadow: 0 0 10px rgba(0, 240, 255, 0.3);">
                                    Rp <?= number_format($modalAkhir, 0, ',', '.') ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
