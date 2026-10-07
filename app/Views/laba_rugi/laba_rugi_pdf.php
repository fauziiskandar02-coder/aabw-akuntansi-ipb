<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Laba Rugi</title>
    <style>
        body { font-family: helvetica, Arial, sans-serif; font-size: 8.5pt; color: #1e293b; }
        .header { text-align: center; margin-bottom: 12px; }
        .header h2 { margin: 0; padding: 0; font-size: 14pt; color: #0f172a; font-weight: bold; }
        .header h3 { margin: 3px 0; font-size: 10.5pt; color: #334155; font-weight: bold; }
        .header p { margin: 2px 0 0 0; font-size: 8pt; color: #64748b; }
        .divider { border-bottom: 1.5px solid #0284c7; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        th { background-color: #f1f5f9; border: 0.5px solid #94a3b8; padding: 5px 3px; font-size: 8.5pt; text-align: left; font-weight: bold; color: #0f172a; }
        td { border: 0.5px solid #cbd5e1; padding: 4px 3px; font-size: 8pt; color: #1e293b; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .total-row td { background-color: #f8fafc; font-weight: bold; border-top: 1px solid #475569; }
        .laba-row td { background-color: #dcfce7; font-weight: bold; font-size: 9.5pt; color: #166534; border-top: 1.5px solid #16a34a; border-bottom: 2px solid #16a34a; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PERUSAHAAN AKN-IPB</h2>
        <h3>LAPORAN LABA / RUGI</h3>
        <p>Periode: <?= !empty($tgl_awal) ? date('d F Y', strtotime($tgl_awal)) : 'Awal' ?> s/d <?= !empty($tgl_akhir) ? date('d F Y', strtotime($tgl_akhir)) : 'Akhir' ?></p>
    </div>
    <div class="divider"></div>

    <?php
    $pendapatan = [];
    $beban = [];
    $totPendapatan = 0;
    $totBeban = 0;

    foreach ($dtlajur as $row) {
        $k1 = $row->kode_akun1;
        if ($k1 == 4) {
            $val = ($row->kre_trx - $row->deb_trx) + ($row->kre_adj - $row->deb_adj);
            if ($val > 0) {
                $pendapatan[] = ['nama' => $row->nama_akun3, 'kode' => $row->kode_akun3, 'nilai' => $val];
                $totPendapatan += $val;
            }
        } elseif ($k1 == 5) {
            $val = ($row->deb_trx - $row->kre_trx) + ($row->deb_adj - $row->kre_adj);
            if ($val > 0) {
                $beban[] = ['nama' => $row->nama_akun3, 'kode' => $row->kode_akun3, 'nilai' => $val];
                $totBeban += $val;
            }
        }
    }
    $labaBersih = $totPendapatan - $totBeban;
    ?>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr style="background-color: #e2e8f0;">
                <th colspan="3"><strong>A. PENDAPATAN</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pendapatan as $p) : ?>
                <tr>
                    <td width="15%" class="text-center"><?= $p['kode'] ?></td>
                    <td width="55%"><?= $p['nama'] ?></td>
                    <td width="30%" class="text-right">Rp <?= number_format($p['nilai'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="2" width="70%" class="text-right"><strong>TOTAL PENDAPATAN:</strong></td>
                <td width="30%" class="text-right"><strong>Rp <?= number_format($totPendapatan, 0, ',', '.') ?></strong></td>
            </tr>
        </tbody>

        <thead>
            <tr style="background-color: #e2e8f0;">
                <th colspan="3"><strong>B. BEBAN - BEBAN OPERASIONAL</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($beban as $b) : ?>
                <tr>
                    <td width="15%" class="text-center"><?= $b['kode'] ?></td>
                    <td width="55%"><?= $b['nama'] ?></td>
                    <td width="30%" class="text-right">Rp <?= number_format($b['nilai'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="2" width="70%" class="text-right"><strong>TOTAL BEBAN:</strong></td>
                <td width="30%" class="text-right"><strong>Rp <?= number_format($totBeban, 0, ',', '.') ?></strong></td>
            </tr>
        </tbody>

        <tfoot>
            <tr class="laba-row">
                <td colspan="2" width="70%" class="text-right"><strong>LABA BERSIH USAHA (NET INCOME):</strong></td>
                <td width="30%" class="text-right"><strong>Rp <?= number_format($labaBersih, 0, ',', '.') ?></strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
