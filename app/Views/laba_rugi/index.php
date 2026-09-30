<?= $this->extend('layout/backend') ?>
<?php /** @var array $dtlajur */ ?>
<?php /** @var string $tgl_awal */ ?>
<?php /** @var string $tgl_akhir */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Income Statement</title>

<section class="section">
    <div class="section-header">
        <h1>Income Statement</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Comprehensive Income Statement</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= site_url('labarugi') ?>" method="post">
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
                            <button type="submit" formaction="<?= site_url('labarugi/cetak') ?>" formtarget="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Export PDF</button>
                        </div>
                    </div>
                </form>

                <?php
                $pendapatan = [];
                $beban = [];
                $totPendapatan = 0;
                $totBeban = 0;

                foreach ($dtlajur as $row) {
                    $k1 = $row->kode_akun1;
                    $debAdj = $row->deb_adj ?? 0;
                    $kreAdj = $row->kre_adj ?? 0;
                    if ($k1 == 4) {
                        $val = $row->kre_trx - $row->deb_trx + ($kreAdj - $debAdj);
                        if ($val > 0) {
                            $pendapatan[] = ['kode' => $row->kode_akun3, 'nama' => $row->nama_akun3, 'nilai' => $val];
                            $totPendapatan += $val;
                        }
                    } elseif ($k1 == 5) {
                        $val = $row->deb_trx - $row->kre_trx + ($debAdj - $kreAdj);
                        if ($val > 0) {
                            $beban[] = ['kode' => $row->kode_akun3, 'nama' => $row->nama_akun3, 'nilai' => $val];
                            $totBeban += $val;
                        }
                    }
                }
                $labaBersih = $totPendapatan - $totBeban;
                ?>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr class="table-primary">
                                <th colspan="3" class="font-weight-bold h6 mb-0">OPERATING REVENUES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pendapatan)) : ?>
                                <tr><td colspan="3" class="text-center text-muted">No revenue data available</td></tr>
                            <?php else : ?>
                                <?php foreach ($pendapatan as $p) : ?>
                                    <tr>
                                        <td style="width: 15%" class="text-center"><?= $p['kode'] ?></td>
                                        <td style="width: 55%"><?= $p['nama'] ?></td>
                                        <td style="width: 30%" class="text-right">Rp <?= number_format($p['nilai'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <tr class="bg-light font-weight-bold">
                                <td colspan="2" class="text-right text-white" style="letter-spacing: 0.5px;">TOTAL REVENUES:</td>
                                <td class="text-right font-weight-bold text-success h6 mb-0" style="color: #34d399 !important; font-family: var(--font-mono);">Rp <?= number_format($totPendapatan, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>

                        <thead>
                            <tr class="table-danger">
                                <th colspan="3" class="font-weight-bold h6 mb-0">OPERATING EXPENSES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($beban)) : ?>
                                <tr><td colspan="3" class="text-center text-muted">No expense data available</td></tr>
                            <?php else : ?>
                                <?php foreach ($beban as $b) : ?>
                                    <tr>
                                        <td class="text-center"><?= $b['kode'] ?></td>
                                        <td><?= $b['nama'] ?></td>
                                        <td class="text-right">Rp <?= number_format($b['nilai'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <tr class="bg-light font-weight-bold">
                                <td colspan="2" class="text-right text-white" style="letter-spacing: 0.5px;">TOTAL EXPENSES:</td>
                                <td class="text-right font-weight-bold text-danger h6 mb-0" style="color: #f87171 !important; font-family: var(--font-mono);">Rp <?= number_format($totBeban, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr class="<?= $labaBersih >= 0 ? 'table-success' : 'table-danger' ?> font-weight-bold" style="border-top: 2px solid <?= $labaBersih >= 0 ? '#10b981' : '#ef4444' ?> !important;">
                                <td colspan="2" class="text-right h5 mb-0 font-weight-bold text-white" style="letter-spacing: 0.8px;">
                                    <?= $labaBersih >= 0 ? '<i class="fas fa-check-circle text-success mr-2"></i>NET PROFIT (INCOME):' : '<i class="fas fa-exclamation-circle text-danger mr-2"></i>NET LOSS:' ?>
                                </td>
                                <td class="text-right h5 mb-0 font-weight-bold font-monospace" style="color: <?= $labaBersih >= 0 ? '#34d399' : '#f87171' ?> !important; text-shadow: 0 0 10px rgba(16, 185, 129, 0.4);">
                                    Rp <?= number_format(abs($labaBersih), 0, ',', '.') ?>
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
