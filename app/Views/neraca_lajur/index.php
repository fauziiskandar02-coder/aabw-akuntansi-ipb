<?= $this->extend('layout/backend') ?>
<?php /** @var array $dtlajur */ ?>
<?php /** @var string $tgl_awal */ ?>
<?php /** @var string $tgl_akhir */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; 10-Column Worksheet</title>

<section class="section">
    <div class="section-header">
        <h1>10-Column Accounting Worksheet</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Filter & Export Accounting Worksheet</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= site_url('neracalajur') ?>" method="post">
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
                            <button type="submit" formaction="<?= site_url('neracalajur/cetak') ?>" formtarget="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Export PDF</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-sm table-hover text-nowrap">
                        <thead class="thead-light text-center">
                            <tr>
                                <th rowspan="2" class="align-middle">Ref</th>
                                <th rowspan="2" class="align-middle">Account Title</th>
                                <th colspan="2">Trial Balance</th>
                                <th colspan="2">Adjustments</th>
                                <th colspan="2">Adjusted TB</th>
                                <th colspan="2">Income Statement</th>
                                <th colspan="2">Balance Sheet</th>
                            </tr>
                            <tr>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th>Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tot_ns_deb = 0; $tot_ns_kre = 0;
                            $tot_ajp_deb = 0; $tot_ajp_kre = 0;
                            $tot_nsd_deb = 0; $tot_nsd_kre = 0;
                            $tot_lr_deb = 0; $tot_lr_kre = 0;
                            $tot_nrc_deb = 0; $tot_nrc_kre = 0;

                            foreach ($dtlajur as $row) :
                                $k1 = $row->kode_akun1;

                                // 1. Neraca Saldo
                                if ($k1 == 1 || $k1 == 5) {
                                    $net = $row->deb_trx - $row->kre_trx;
                                    $ns_deb = ($net >= 0) ? $net : 0;
                                    $ns_kre = ($net < 0) ? abs($net) : 0;
                                } else {
                                    $net = $row->kre_trx - $row->deb_trx;
                                    $ns_kre = ($net >= 0) ? $net : 0;
                                    $ns_deb = ($net < 0) ? abs($net) : 0;
                                }

                                // 2. AJP
                                $ajp_deb = $row->deb_adj;
                                $ajp_kre = $row->kre_adj;

                                // 3. NSD
                                if ($k1 == 1 || $k1 == 5) {
                                    $nsd_net = ($ns_deb - $ns_kre) + ($ajp_deb - $ajp_kre);
                                    $nsd_deb = ($nsd_net >= 0) ? $nsd_net : 0;
                                    $nsd_kre = ($nsd_net < 0) ? abs($nsd_net) : 0;
                                } else {
                                    $nsd_net = ($ns_kre - $ns_deb) + ($ajp_kre - $ajp_deb);
                                    $nsd_kre = ($nsd_net >= 0) ? $nsd_net : 0;
                                    $nsd_deb = ($nsd_net < 0) ? abs($nsd_net) : 0;
                                }

                                // 4. Laba Rugi (4 & 5)
                                $lr_deb = ($k1 == 4 || $k1 == 5) ? $nsd_deb : 0;
                                $lr_kre = ($k1 == 4 || $k1 == 5) ? $nsd_kre : 0;

                                // 5. Neraca (1, 2, 3)
                                $nrc_deb = ($k1 == 1 || $k1 == 2 || $k1 == 3) ? $nsd_deb : 0;
                                $nrc_kre = ($k1 == 1 || $k1 == 2 || $k1 == 3) ? $nsd_kre : 0;

                                // Accumulate
                                $tot_ns_deb  += $ns_deb;  $tot_ns_kre  += $ns_kre;
                                $tot_ajp_deb += $ajp_deb; $tot_ajp_kre += $ajp_kre;
                                $tot_nsd_deb += $nsd_deb; $tot_nsd_kre += $nsd_kre;
                                $tot_lr_deb  += $lr_deb;  $tot_lr_kre  += $lr_kre;
                                $tot_nrc_deb += $nrc_deb; $tot_nrc_kre += $nrc_kre;
                            ?>
                                <tr>
                                    <td class="text-center"><?= $row->kode_akun3 ?></td>
                                    <td><?= $row->nama_akun3 ?></td>
                                    <td class="text-right"><?= $ns_deb > 0 ? number_format($ns_deb, 0, ',', '.') : '-' ?></td>
                                    <td class="text-right"><?= $ns_kre > 0 ? number_format($ns_kre, 0, ',', '.') : '-' ?></td>
                                    <td class="text-right"><?= $ajp_deb > 0 ? number_format($ajp_deb, 0, ',', '.') : '-' ?></td>
                                    <td class="text-right"><?= $ajp_kre > 0 ? number_format($ajp_kre, 0, ',', '.') : '-' ?></td>
                                    <td class="text-right"><?= $nsd_deb > 0 ? number_format($nsd_deb, 0, ',', '.') : '-' ?></td>
                                    <td class="text-right"><?= $nsd_kre > 0 ? number_format($nsd_kre, 0, ',', '.') : '-' ?></td>
                                    <td class="text-right"><?= $lr_deb > 0 ? number_format($lr_deb, 0, ',', '.') : '-' ?></td>
                                    <td class="text-right"><?= $lr_kre > 0 ? number_format($lr_kre, 0, ',', '.') : '-' ?></td>
                                    <td class="text-right"><?= $nrc_deb > 0 ? number_format($nrc_deb, 0, ',', '.') : '-' ?></td>
                                    <td class="text-right"><?= $nrc_kre > 0 ? number_format($nrc_kre, 0, ',', '.') : '-' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-light font-weight-bold">
                                <td colspan="2" class="text-right">SUBTOTAL:</td>
                                <td class="text-right"><?= number_format($tot_ns_deb, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($tot_ns_kre, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($tot_ajp_deb, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($tot_ajp_kre, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($tot_nsd_deb, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($tot_nsd_kre, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($tot_lr_deb, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($tot_lr_kre, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($tot_nrc_deb, 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format($tot_nrc_kre, 0, ',', '.') ?></td>
                            </tr>
                            <?php
                            $laba = $tot_lr_kre - $tot_lr_deb;
                            ?>
                            <tr class="table-warning font-weight-bold">
                                <td colspan="8" class="text-right"><strong>NET INCOME / (LOSS):</strong></td>
                                <td class="text-right"><?= ($laba >= 0) ? number_format($laba, 0, ',', '.') : '-' ?></td>
                                <td class="text-right"><?= ($laba < 0) ? number_format(abs($laba), 0, ',', '.') : '-' ?></td>
                                <td class="text-right"><?= ($laba < 0) ? number_format(abs($laba), 0, ',', '.') : '-' ?></td>
                                <td class="text-right"><?= ($laba >= 0) ? number_format($laba, 0, ',', '.') : '-' ?></td>
                            </tr>
                            <tr class="bg-dark text-white font-weight-bold">
                                <td colspan="8" class="text-right">BALANCED TOTAL:</td>
                                <td class="text-right"><?= number_format(max($tot_lr_deb, $tot_lr_kre), 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format(max($tot_lr_deb, $tot_lr_kre), 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format(max($tot_nrc_deb, $tot_nrc_kre), 0, ',', '.') ?></td>
                                <td class="text-right"><?= number_format(max($tot_nrc_deb, $tot_nrc_kre), 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
