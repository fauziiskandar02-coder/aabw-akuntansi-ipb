<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jurnal Umum</title>
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
        .indent { padding-left: 25px; }
        .total-row { background-color: #f9f9f9; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SISTEM INFORMASI AKUNTANSI AABW</h2>
        <h3>JURNAL UMUM</h3>
        <p>Periode: <?= !empty($tgl_awal) ? date('d F Y', strtotime($tgl_awal)) : 'Awal' ?> s/d <?= !empty($tgl_akhir) ? date('d F Y', strtotime($tgl_akhir)) : 'Akhir' ?></p>
    </div>

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
