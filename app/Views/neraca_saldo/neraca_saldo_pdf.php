<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Neraca Saldo</title>
    <style>
        body { font-family: helvetica, Arial, sans-serif; font-size: 8.5pt; color: #1e293b; }
        .header { text-align: center; margin-bottom: 12px; }
        .header h2 { margin: 0; padding: 0; font-size: 14pt; color: #0f172a; font-weight: bold; }
        .header h3 { margin: 3px 0; font-size: 10.5pt; color: #334155; font-weight: bold; }
        .header p { margin: 2px 0 0 0; font-size: 8pt; color: #64748b; }
        .divider { border-bottom: 1.5px solid #0284c7; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        th { background-color: #f1f5f9; border: 0.5px solid #94a3b8; padding: 5px 3px; font-size: 8pt; text-align: center; font-weight: bold; color: #0f172a; }
        td { border: 0.5px solid #cbd5e1; padding: 4px 3px; font-size: 7.8pt; color: #1e293b; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .total-row td { background-color: #f8fafc; font-weight: bold; border-top: 1px solid #475569; border-bottom: 1.5px solid #0f172a; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SISTEM INFORMASI AKUNTANSI AABW</h2>
        <h3>NERACA SALDO (TRIAL BALANCE)</h3>
        <p>Periode: <?= !empty($tgl_awal) ? date('d F Y', strtotime($tgl_awal)) : 'Awal' ?> s/d <?= !empty($tgl_akhir) ? date('d F Y', strtotime($tgl_akhir)) : 'Akhir' ?></p>
    </div>
    <div class="divider"></div>

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
