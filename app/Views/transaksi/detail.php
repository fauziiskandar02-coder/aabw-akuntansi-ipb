<?= $this->extend('layout/backend') ?>
<?php /** @var object $transaksi */ ?>
<?php /** @var array $dtnilai */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Detail Transaksi</title>

<section class="section">
    <div class="section-header">
        <a href="<?= site_url('transaksi') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="section-body">
        <div class="card invoice tech-blueprint-card" style="background: var(--bg-card) !important; border: 1px solid var(--border-tech) !important; color: var(--text-main) !important;">
            <div class="invoice-print p-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Detail Transaksi</h2>
                            <div class="invoice-number">Kwitansi #<?= $transaksi->kwitansi ?></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Tanggal Transaksi:</strong><br>
                                    <?= date('d F Y', strtotime($transaksi->tanggal)) ?><br><br>
                                    <strong>Keterangan Jurnal:</strong><br>
                                    <?= $transaksi->ketjurnal ?>
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Deskripsi:</strong><br>
                                    <?= $transaksi->deskripsi ?><br><br>
                                    <strong>Status Transaksi:</strong><br>
                                    <span class="badge badge-success">Selesai</span>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="section-title">Rincian Jurnal</div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 15%">Kode Akun</th>
                                        <th style="width: 35%">Nama Akun</th>
                                        <th class="text-right" style="width: 15%">Debit</th>
                                        <th class="text-right" style="width: 15%">Kredit</th>
                                        <th class="text-center" style="width: 15%">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totDebit = 0;
                                    $totKredit = 0;
                                    foreach ($dtnilai as $k => $row) :
                                        $totDebit += $row->debit;
                                        $totKredit += $row->kredit;
                                    ?>
                                        <tr>
                                            <td><?= $k + 1 ?></td>
                                            <td><?= $row->kode_akun3 ?></td>
                                            <td><?= $row->nama_akun3 ?></td>
                                            <td class="text-right">Rp <?= number_format($row->debit, 0, ',', '.') ?></td>
                                            <td class="text-right">Rp <?= number_format($row->kredit, 0, ',', '.') ?></td>
                                            <td class="text-center"><span class="badge badge-info"><?= $row->status ?? 'Normal' ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="font-weight-bold bg-light">
                                        <td colspan="3" class="text-right">Total :</td>
                                        <td class="text-right">Rp <?= number_format($totDebit, 0, ',', '.') ?></td>
                                        <td class="text-right">Rp <?= number_format($totKredit, 0, ',', '.') ?></td>
                                        <td class="text-center">
                                            <?php if ($totDebit == $totKredit) : ?>
                                                <span class="badge badge-success"><i class="fas fa-check"></i> Balanced</span>
                                            <?php else : ?>
                                                <span class="badge badge-danger">Unbalanced</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-md-right">
                <a href="<?= site_url('transaksi/edit/' . $transaksi->id_transaksi) ?>" class="btn btn-warning btn-icon icon-left"><i class="fas fa-pencil-alt"></i> Edit Transaksi</a>
                <button class="btn btn-primary btn-icon icon-left" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
