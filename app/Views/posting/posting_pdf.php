<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Buku Besar (Posting)</title>
    <style>
        body { font-family: helvetica, Arial, sans-serif; font-size: 8.5pt; color: #1e293b; }
        .header { text-align: center; margin-bottom: 12px; }
        .header h2 { margin: 0; padding: 0; font-size: 14pt; color: #0f172a; font-weight: bold; letter-spacing: 0.5px; }
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
        <h3>BUKU BESAR (POSTING)</h3>
        <p>Periode: <?= !empty($tgl_awal) ? date('d F Y', strtotime($tgl_awal)) : 'Awal' ?> s/d <?= !empty($tgl_akhir) ? date('d F Y', strtotime($tgl_akhir)) : 'Akhir' ?></p>
    </div>
    <div class="divider"></div>

    <table cellpadding="4">
        <thead>
            <tr style="background-color: #e2e8f0;">
                <th rowspan="2" width="9%">Tanggal</th>
                <th rowspan="2" width="29%">Keterangan</th>
                <th rowspan="2" width="8%">Ref</th>
                <th rowspan="2" width="13%">Debit (Rp)</th>
                <th rowspan="2" width="13%">Kredit (Rp)</th>
                <th colspan="2" width="28%">Saldo (Rp)</th>
            </tr>
            <tr style="background-color: #e2e8f0;">
                <th width="14%">Debit</th>
                <th width="14%">Kredit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $saldo = 0;
            $totDebit = 0;
            $totKredit = 0;
            foreach ($dtposting as $row) :
                $totDebit += $row->debit;
                $totKredit += $row->kredit;
                $firstDigit = substr((string)$row->kode_akun3, 0, 1);
                if ($firstDigit == '1' || $firstDigit == '5') {
                    $saldo += ($row->debit - $row->kredit);
                    $saldoDebit = ($saldo >= 0) ? $saldo : 0;
                    $saldoKredit = ($saldo < 0) ? abs($saldo) : 0;
                } else {
                    $saldo += ($row->kredit - $row->debit);
                    $saldoKredit = ($saldo >= 0) ? $saldo : 0;
                    $saldoDebit = ($saldo < 0) ? abs($saldo) : 0;
                }
            ?>
                <tr>
                    <td class="text-center"><?= date('d/m/Y', strtotime($row->tanggal)) ?></td>
                    <td><?= !empty($row->ketjurnal) ? $row->ketjurnal : $row->deskripsi ?> (<?= $row->nama_akun3 ?>)</td>
                    <td class="text-center"><?= $row->kode_akun3 ?></td>
                    <td class="text-right"><?= $row->debit > 0 ? number_format($row->debit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right"><?= $row->kredit > 0 ? number_format($row->kredit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right"><?= $saldoDebit > 0 ? number_format($saldoDebit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right"><?= $saldoKredit > 0 ? number_format($saldoKredit, 0, ',', '.') : '-' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" class="text-right"><strong>TOTAL:</strong></td>
                <td class="text-right"><strong><?= number_format($totDebit, 0, ',', '.') ?></strong></td>
                <td class="text-right"><strong><?= number_format($totKredit, 0, ',', '.') ?></strong></td>
                <td colspan="2" class="text-center"><strong>Saldo Akhir: Rp <?= number_format(abs($saldo), 0, ',', '.') ?></strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
