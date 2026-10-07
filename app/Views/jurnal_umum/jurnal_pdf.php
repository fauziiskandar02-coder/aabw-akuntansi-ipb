<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jurnal Umum</title>
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
        .indent { padding-left: 20px; }
        .total-row td { background-color: #f8fafc; font-weight: bold; border-top: 1px solid #475569; border-bottom: 1.5px solid #0f172a; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SISTEM INFORMASI AKUNTANSI AABW</h2>
        <h3>JURNAL UMUM</h3>
        <p>Periode: <?= !empty($tgl_awal) ? date('d F Y', strtotime($tgl_awal)) : 'Awal' ?> s/d <?= !empty($tgl_akhir) ? date('d F Y', strtotime($tgl_akhir)) : 'Akhir' ?></p>
    </div>
    <div class="divider"></div>

    <table>
        <thead>
            <tr>
                <th width="12%">Tanggal</th>
                <th width="10%">Kwitansi</th>
                <th width="42%">Keterangan / Akun</th>
                <th width="8%">Ref</th>
                <th width="14%">Debit (Rp)</th>
                <th width="14%">Kredit (Rp)</th>
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
                    <td class="text-center"><?= $showTgl ?></td>
                    <td class="text-center"><?= $showKwitansi ?></td>
                    <td class="<?= $row->kredit > 0 ? 'indent' : '' ?>"><?= $row->nama_akun3 ?></td>
                    <td class="text-center"><?= $row->kode_akun3 ?></td>
                    <td class="text-right"><?= $row->debit > 0 ? number_format($row->debit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right"><?= $row->kredit > 0 ? number_format($row->kredit, 0, ',', '.') : '-' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="text-right"><strong>TOTAL:</strong></td>
                <td class="text-right"><strong><?= number_format($totalDebit, 0, ',', '.') ?></strong></td>
                <td class="text-right"><strong><?= number_format($totalKredit, 0, ',', '.') ?></strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
