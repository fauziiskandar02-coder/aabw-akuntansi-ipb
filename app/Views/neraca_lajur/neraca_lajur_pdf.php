<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Neraca Lajur (Worksheet)</title>
    <style>
        body { font-family: helvetica, Arial, sans-serif; font-size: 7pt; color: #1e293b; margin: 0; padding: 0; }
        .header { text-align: center; margin-bottom: 8px; width: 100%; }
        .header h2 { margin: 0; padding: 0; font-size: 13pt; color: #0f172a; font-weight: bold; }
        .header h3 { margin: 2px 0; font-size: 9.5pt; color: #334155; font-weight: bold; }
        .header p { margin: 1px 0 0 0; font-size: 7.5pt; color: #64748b; }
        .divider { border-bottom: 1.5px solid #0284c7; margin-bottom: 6px; }
        table { width: 100%; border-collapse: collapse; margin-top: 2px; }
        th { background-color: #f1f5f9; border: 0.5px solid #94a3b8; padding: 3px 1px; font-size: 6.8pt; text-align: center; font-weight: bold; color: #0f172a; }
        td { border: 0.5px solid #cbd5e1; padding: 2px 1px; font-size: 6.5pt; color: #1e293b; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .total-row td { background-color: #f8fafc; font-weight: bold; border-top: 1px solid #475569; }
        .laba-row td { background-color: #fef3c7; font-weight: bold; color: #92400e; }
        .balanced-row td { background-color: #1e293b; font-weight: bold; color: #ffffff; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PERUSAHAAN AKN-IPB</h2>
        <h3>NERACA LAJUR (WORKSHEET 10 KOLOM)</h3>
        <p>Periode: <?= !empty($tgl_awal) ? date('d F Y', strtotime($tgl_awal)) : 'Awal' ?> s/d <?= !empty($tgl_akhir) ? date('d F Y', strtotime($tgl_akhir)) : 'Akhir' ?></p>
    </div>
    <div class="divider"></div>

    <table border="1" cellpadding="2" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th rowspan="2" width="6%" align="center">Ref</th>
                <th rowspan="2" width="20%" align="center">Nama Akun</th>
                <th colspan="2" width="14%" align="center">Neraca Saldo</th>
                <th colspan="2" width="14%" align="center">Penyesuaian</th>
                <th colspan="2" width="15%" align="center">NS Disesuaikan</th>
                <th colspan="2" width="15%" align="center">Laba / Rugi</th>
                <th colspan="2" width="16%" align="center">Neraca</th>
            </tr>
            <tr>
                <th width="7%" align="center">D</th>
                <th width="7%" align="center">K</th>
                <th width="7%" align="center">D</th>
                <th width="7%" align="center">K</th>
                <th width="7.5%" align="center">D</th>
                <th width="7.5%" align="center">K</th>
                <th width="7.5%" align="center">D</th>
                <th width="7.5%" align="center">K</th>
                <th width="8%" align="center">D</th>
                <th width="8%" align="center">K</th>
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

                if ($k1 == 1 || $k1 == 5) {
                    $net = $row->deb_trx - $row->kre_trx;
                    $ns_deb = ($net >= 0) ? $net : 0;
                    $ns_kre = ($net < 0) ? abs($net) : 0;
                } else {
                    $net = $row->kre_trx - $row->deb_trx;
                    $ns_kre = ($net >= 0) ? $net : 0;
                    $ns_deb = ($net < 0) ? abs($net) : 0;
                }

                $ajp_deb = $row->deb_adj;
                $ajp_kre = $row->kre_adj;

                if ($k1 == 1 || $k1 == 5) {
                    $nsd_net = ($ns_deb - $ns_kre) + ($ajp_deb - $ajp_kre);
                    $nsd_deb = ($nsd_net >= 0) ? $nsd_net : 0;
                    $nsd_kre = ($nsd_net < 0) ? abs($nsd_net) : 0;
                } else {
                    $nsd_net = ($ns_kre - $ns_deb) + ($ajp_kre - $ajp_deb);
                    $nsd_kre = ($nsd_net >= 0) ? $nsd_net : 0;
                    $nsd_deb = ($nsd_net < 0) ? abs($nsd_net) : 0;
                }

                $lr_deb = ($k1 == 4 || $k1 == 5) ? $nsd_deb : 0;
                $lr_kre = ($k1 == 4 || $k1 == 5) ? $nsd_kre : 0;

                $nrc_deb = ($k1 == 1 || $k1 == 2 || $k1 == 3) ? $nsd_deb : 0;
                $nrc_kre = ($k1 == 1 || $k1 == 2 || $k1 == 3) ? $nsd_kre : 0;

                $tot_ns_deb  += $ns_deb;  $tot_ns_kre  += $ns_kre;
                $tot_ajp_deb += $ajp_deb; $tot_ajp_kre += $ajp_kre;
                $tot_nsd_deb += $nsd_deb; $tot_nsd_kre += $nsd_kre;
                $tot_lr_deb  += $lr_deb;  $tot_lr_kre  += $lr_kre;
                $tot_nrc_deb += $nrc_deb; $tot_nrc_kre += $nrc_kre;
            ?>
                <tr>
                    <td width="6%" class="text-center"><?= $row->kode_akun3 ?></td>
                    <td width="20%"><?= $row->nama_akun3 ?></td>
                    <td width="7%" class="text-right"><?= $ns_deb > 0 ? number_format($ns_deb, 0, ',', '.') : '-' ?></td>
                    <td width="7%" class="text-right"><?= $ns_kre > 0 ? number_format($ns_kre, 0, ',', '.') : '-' ?></td>
                    <td width="7%" class="text-right"><?= $ajp_deb > 0 ? number_format($ajp_deb, 0, ',', '.') : '-' ?></td>
                    <td width="7%" class="text-right"><?= $ajp_kre > 0 ? number_format($ajp_kre, 0, ',', '.') : '-' ?></td>
                    <td width="7.5%" class="text-right"><?= $nsd_deb > 0 ? number_format($nsd_deb, 0, ',', '.') : '-' ?></td>
                    <td width="7.5%" class="text-right"><?= $nsd_kre > 0 ? number_format($nsd_kre, 0, ',', '.') : '-' ?></td>
                    <td width="7.5%" class="text-right"><?= $lr_deb > 0 ? number_format($lr_deb, 0, ',', '.') : '-' ?></td>
                    <td width="7.5%" class="text-right"><?= $lr_kre > 0 ? number_format($lr_kre, 0, ',', '.') : '-' ?></td>
                    <td width="8%" class="text-right"><?= $nrc_deb > 0 ? number_format($nrc_deb, 0, ',', '.') : '-' ?></td>
                    <td width="8%" class="text-right"><?= $nrc_kre > 0 ? number_format($nrc_kre, 0, ',', '.') : '-' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="2" width="26%" class="text-right"><strong>SUBTOTAL:</strong></td>
                <td width="7%" class="text-right"><?= number_format($tot_ns_deb, 0, ',', '.') ?></td>
                <td width="7%" class="text-right"><?= number_format($tot_ns_kre, 0, ',', '.') ?></td>
                <td width="7%" class="text-right"><?= number_format($tot_ajp_deb, 0, ',', '.') ?></td>
                <td width="7%" class="text-right"><?= number_format($tot_ajp_kre, 0, ',', '.') ?></td>
                <td width="7.5%" class="text-right"><?= number_format($tot_nsd_deb, 0, ',', '.') ?></td>
                <td width="7.5%" class="text-right"><?= number_format($tot_nsd_kre, 0, ',', '.') ?></td>
                <td width="7.5%" class="text-right"><?= number_format($tot_lr_deb, 0, ',', '.') ?></td>
                <td width="7.5%" class="text-right"><?= number_format($tot_lr_kre, 0, ',', '.') ?></td>
                <td width="8%" class="text-right"><?= number_format($tot_nrc_deb, 0, ',', '.') ?></td>
                <td width="8%" class="text-right"><?= number_format($tot_nrc_kre, 0, ',', '.') ?></td>
            </tr>
            <?php $laba = $tot_lr_kre - $tot_lr_deb; ?>
            <tr class="laba-row">
                <td colspan="8" width="69%" class="text-right"><strong>LABA BERSIH:</strong></td>
                <td width="7.5%" class="text-right"><?= ($laba >= 0) ? number_format($laba, 0, ',', '.') : '-' ?></td>
                <td width="7.5%" class="text-right"><?= ($laba < 0) ? number_format(abs($laba), 0, ',', '.') : '-' ?></td>
                <td width="8%" class="text-right"><?= ($laba < 0) ? number_format(abs($laba), 0, ',', '.') : '-' ?></td>
                <td width="8%" class="text-right"><?= ($laba >= 0) ? number_format($laba, 0, ',', '.') : '-' ?></td>
            </tr>
            <tr class="balanced-row">
                <td colspan="8" width="69%" class="text-right"><strong>BALANCED TOTAL:</strong></td>
                <td width="7.5%" class="text-right"><?= number_format(max($tot_lr_deb, $tot_lr_kre), 0, ',', '.') ?></td>
                <td width="7.5%" class="text-right"><?= number_format(max($tot_lr_deb, $tot_lr_kre), 0, ',', '.') ?></td>
                <td width="8%" class="text-right"><?= number_format(max($tot_nrc_deb, $tot_nrc_kre), 0, ',', '.') ?></td>
                <td width="8%" class="text-right"><?= number_format(max($tot_nrc_deb, $tot_nrc_kre), 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
