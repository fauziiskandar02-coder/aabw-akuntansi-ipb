<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Neraca Saldo</title>
    <style>
        body { font-family: helvetica, sans-serif; font-size: 10pt; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; padding: 0; font-size: 16pt; color: #111; }
        .header h3 { margin: 5px 0; font-size: 12pt; font-weight: normal; }
        .header p { margin: 0; font-size: 9pt; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f2f2f2; border: 0.5px solid #666; padding: 6px 4px; font-size: 9pt; text-align: center; }
        td { border: 0.5px solid #888; padding: 5px 4px; font-size: 9pt; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .total-row { background-color: #f9f9f9; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SISTEM INFORMASI AKUNTANSI AABW</h2>
        <h3>NERACA SALDO (TRIAL BALANCE)</h3>
        <p>Periode: <?= !empty($tgl_awal) ? date('d F Y', strtotime($tgl_awal)) : 'Awal' ?> s/d <?= !empty($tgl_akhir) ? date('d F Y', strtotime($tgl_akhir)) : 'Akhir' ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="15%">Kode Akun</th>
                <th width="45%">Nama Akun</th>
                <th width="20%">Debit (Rp)</th>
                <th width="20%">Kredit (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalDebit = 0;
            $totalKredit = 0;
            foreach ($dtneraca as $row) :
                $firstDigit = substr((string)$row->kode_akun3, 0, 1);
                if ($firstDigit == '1' || $firstDigit == '5') {
                    $net = $row->debit - $row->kredit;
                    $saldoDeb = ($net >= 0) ? $net : 0;
                    $saldoKre = ($net < 0) ? abs($net) : 0;
                } else {
                    $net = $row->kredit - $row->debit;
                    $saldoKre = ($net >= 0) ? $net : 0;
                    $saldoDeb = ($net < 0) ? abs($net) : 0;
                }
                $totalDebit += $saldoDeb;
                $totalKredit += $saldoKre;
            ?>
                <tr>
                    <td class="text-center"><?= $row->kode_akun3 ?></td>
                    <td><?= $row->nama_akun3 ?></td>
                    <td class="text-right"><?= $saldoDeb > 0 ? number_format($saldoDeb, 0, ',', '.') : '-' ?></td>
                    <td class="text-right"><?= $saldoKre > 0 ? number_format($saldoKre, 0, ',', '.') : '-' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="2" class="text-right"><strong>TOTAL:</strong></td>
                <td class="text-right"><strong><?= number_format($totalDebit, 0, ',', '.') ?></strong></td>
                <td class="text-right"><strong><?= number_format($totalKredit, 0, ',', '.') ?></strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
