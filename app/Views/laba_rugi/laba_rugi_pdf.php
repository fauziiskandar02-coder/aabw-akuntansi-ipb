<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Laba Rugi</title>
    <style>
        body { font-family: helvetica, sans-serif; font-size: 10pt; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; padding: 0; font-size: 16pt; color: #111; }
        .header h3 { margin: 5px 0; font-size: 12pt; font-weight: normal; }
        .header p { margin: 0; font-size: 9pt; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f2f2f2; border: 0.5px solid #666; padding: 6px 4px; font-size: 9.5pt; text-align: left; }
        td { border: 0.5px solid #888; padding: 5px 4px; font-size: 9.5pt; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .total-row { background-color: #f9f9f9; font-weight: bold; }
        .laba-row { background-color: #d4edda; font-weight: bold; font-size: 11pt; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SISTEM INFORMASI AKUNTANSI AABW</h2>
        <h3>LAPORAN LABA / RUGI</h3>
        <p>Periode: <?= !empty($tgl_awal) ? date('d F Y', strtotime($tgl_awal)) : 'Awal' ?> s/d <?= !empty($tgl_akhir) ? date('d F Y', strtotime($tgl_akhir)) : 'Akhir' ?></p>
    </div>

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

    <table>
        <thead>
            <tr>
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
                <td colspan="2" class="text-right"><strong>TOTAL PENDAPATAN:</strong></td>
                <td class="text-right"><strong>Rp <?= number_format($totPendapatan, 0, ',', '.') ?></strong></td>
            </tr>
        </tbody>

        <thead>
            <tr>
                <th colspan="3"><strong>B. BEBAN - BEBAN OPERASIONAL</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($beban as $b) : ?>
                <tr>
                    <td class="text-center"><?= $b['kode'] ?></td>
                    <td><?= $b['nama'] ?></td>
                    <td class="text-right">Rp <?= number_format($b['nilai'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="2" class="text-right"><strong>TOTAL BEBAN:</strong></td>
                <td class="text-right"><strong>Rp <?= number_format($totBeban, 0, ',', '.') ?></strong></td>
            </tr>
        </tbody>

        <tfoot>
            <tr class="laba-row">
                <td colspan="2" class="text-right"><strong>LABA BERSIH USAHA (NET INCOME):</strong></td>
                <td class="text-right"><strong>Rp <?= number_format($labaBersih, 0, ',', '.') ?></strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
