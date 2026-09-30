<?= $this->extend('layout/backend') ?>
<?php /** @var array $dtjurnal */ ?>
<?php /** @var string $tgl_awal */ ?>
<?php /** @var string $tgl_akhir */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; General Journal</title>

<section class="section">
    <div class="section-header">
        <h1>General Journal</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Filter & Export General Journal</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= site_url('jurnalumum') ?>" method="post">
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
                            <button type="submit" formaction="<?= site_url('jurnalumum/cetak') ?>" formtarget="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Export PDF</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 12%">Date</th>
                                <th style="width: 10%">Receipt No</th>
                                <th style="width: 38%">Account Title & Description</th>
                                <th class="text-center" style="width: 10%">Ref</th>
                                <th class="text-right" style="width: 15%">Debit (IDR)</th>
                                <th class="text-right" style="width: 15%">Credit (IDR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tempTgl = '';
                            $tempKwitansi = '';
                            $totalDebit = 0;
                            $totalKredit = 0;
                            foreach ($dtjurnal as $row) :
                                $totalDebit += $row->debit;
                                $totalKredit += $row->kredit;
                                $showTgl = ($tempTgl != $row->tanggal) ? date('d/m/Y', strtotime($row->tanggal)) : '';
                                $showKwitansi = ($tempKwitansi != $row->kwitansi) ? $row->kwitansi : '';
                                $tempTgl = $row->tanggal;
                                $tempKwitansi = $row->kwitansi;
                            ?>
                                <tr>
                                    <td><?= $showTgl ?></td>
                                    <td><?= $showKwitansi ?></td>
                                    <td style="<?= $row->kredit > 0 ? 'padding-left: 40px;' : 'font-weight: 500;' ?>">
                                        <?= $row->nama_akun3 ?>
                                        <?php if (!empty($row->ketjurnal) && !empty($showKwitansi)) : ?>
                                            <div class="text-muted small"><em>(<?= $row->ketjurnal ?>)</em></div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center"><?= $row->kode_akun3 ?></td>
                                    <td class="text-right"><?= $row->debit > 0 ? number_format($row->debit, 0, ',', '.') : '-' ?></td>
                                    <td class="text-right"><?= $row->kredit > 0 ? number_format($row->kredit, 0, ',', '.') : '-' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-light font-weight-bold">
                                <td colspan="4" class="text-right">TOTAL:</td>
                                <td class="text-right">Rp <?= number_format($totalDebit, 0, ',', '.') ?></td>
                                <td class="text-right">Rp <?= number_format($totalKredit, 0, ',', '.') ?></td>
                            </tr>
                            <tr class="text-center font-weight-bold">
                                <td colspan="6">
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
