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

                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tbody>
                            <tr>
                                <td style="width: 70%" class="font-weight-bold">Beginning Owner's Capital</td>
                                <td style="width: 30%" class="text-right font-weight-bold">Rp <?= number_format($modalAwal, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td class="pl-4">Net Profit for the Period</td>
                                <td class="text-right text-success">Rp <?= number_format($labaBersih, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td class="pl-4">Owner's Drawings (Prive)</td>
                                <td class="text-right text-danger">( Rp <?= number_format($prive, 0, ',', '.') ?> )</td>
                            </tr>
                            <tr class="table-info font-weight-bold">
                                <td>Net Increase / (Decrease) in Capital</td>
                                <td class="text-right">Rp <?= number_format($labaBersih - $prive, 0, ',', '.') ?></td>
                            </tr>
                            <tr class="table-success font-weight-bold h5">
                                <td>ENDING OWNER'S CAPITAL</td>
                                <td class="text-right">Rp <?= number_format($modalAkhir, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
