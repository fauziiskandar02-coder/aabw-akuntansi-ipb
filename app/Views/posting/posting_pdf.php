<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Buku Besar (Posting)</title>
    <style>
        body { font-family: helvetica, Arial, sans-serif; font-size: 8.5pt; color: #111827; }
        .header { text-align: center; margin-bottom: 10px; }
        .header h2 { margin: 0; padding: 0; font-size: 15pt; color: #0f172a; font-weight: bold; }
        .header h3 { margin: 2px 0; font-size: 11pt; color: #1e293b; font-weight: bold; }
        .header p { margin: 2px 0 0 0; font-size: 8pt; color: #475569; }
        .divider { border-bottom: 2px solid #0284c7; margin-bottom: 8px; }
        .account-title { font-size: 10pt; font-weight: bold; color: #0284c7; margin: 10px 0 4px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        th { background-color: #e2e8f0; border: 1px solid #64748b; padding: 5px 3px; font-size: 8pt; text-align: center; font-weight: bold; color: #0f172a; }
        td { border: 1px solid #94a3b8; padding: 4px 3px; font-size: 7.8pt; color: #111827; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .total-row td { background-color: #f1f5f9; font-weight: bold; border-top: 1.5px solid #334155; border-bottom: 1.5px solid #0f172a; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PERUSAHAAN AKN-IPB</h2>
        <h3>BUKU BESAR (POSTING)</h3>
        <p>Periode: <?= !empty($tgl_awal) ? date('d F Y', strtotime($tgl_awal)) : 'Awal' ?> s/d <?= !empty($tgl_akhir) ? date('d F Y', strtotime($tgl_akhir)) : 'Akhir' ?></p>
    </div>
    <div class="divider"></div>

    <?php
    $groupedPosting = [];
    foreach ($dtposting as $row) {
        $groupedPosting[$row->kode_akun3]['nama'] = $row->nama_akun3;
        $groupedPosting[$row->kode_akun3]['rows'][] = $row;
    }
    ?>

    <?php foreach ($groupedPosting as $kodeAkun => $accData) : 
        $firstDigit = substr((string)$kodeAkun, 0, 1);
        $isDebitNormal = ($firstDigit == '1' && $kodeAkun != 1202) 
                      || $firstDigit == '5' 
                      || substr((string)$kodeAkun, 0, 2) == '32';
        $saldo = 0;
        $totDebit = 0;
        $totKredit = 0;
    ?>
        <div class="account-title">
            Akun: <?= $kodeAkun ?> &mdash; <?= $accData['nama'] ?> (Saldo Normal: <?= $isDebitNormal ? 'Debit' : 'Kredit' ?>)
        </div>
        <table border="1" cellpadding="4" cellspacing="0">
            <thead>
                <tr style="background-color: #e2e8f0;">
                    <th rowspan="2" width="10%">Tanggal</th>
                    <th rowspan="2" width="34%">Keterangan</th>
                    <th rowspan="2" width="8%">Ref</th>
                    <th rowspan="2" width="13%">Debit (Rp)</th>
                    <th rowspan="2" width="13%">Kredit (Rp)</th>
                    <th colspan="2" width="22%">Saldo (Rp)</th>
                </tr>
                <tr style="background-color: #e2e8f0;">
                    <th width="11%">Debit</th>
                    <th width="11%">Kredit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accData['rows'] as $row) : 
                    $totDebit += $row->debit;
                    $totKredit += $row->kredit;
                    if ($isDebitNormal) {
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
                        <td width="10%" class="text-center"><?= date('d/m/Y', strtotime($row->tanggal)) ?></td>
                        <td width="34%"><?= !empty($row->ketjurnal) ? $row->ketjurnal : $row->deskripsi ?></td>
                        <td width="8%" class="text-center"><?= $row->kode_akun3 ?></td>
                        <td width="13%" class="text-right"><?= $row->debit > 0 ? number_format($row->debit, 0, ',', '.') : '-' ?></td>
                        <td width="13%" class="text-right"><?= $row->kredit > 0 ? number_format($row->kredit, 0, ',', '.') : '-' ?></td>
                        <td width="11%" class="text-right"><?= $saldoDebit > 0 ? number_format($saldoDebit, 0, ',', '.') : '-' ?></td>
                        <td width="11%" class="text-right"><?= $saldoKredit > 0 ? number_format($saldoKredit, 0, ',', '.') : '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" width="52%" class="text-right"><strong>TOTAL MUTASI:</strong></td>
                    <td width="13%" class="text-right"><strong><?= number_format($totDebit, 0, ',', '.') ?></strong></td>
                    <td width="13%" class="text-right"><strong><?= number_format($totKredit, 0, ',', '.') ?></strong></td>
                    <td colspan="2" width="22%" class="text-center"><strong>Saldo Akhir: Rp <?= number_format(abs($saldo), 0, ',', '.') ?> (<?= $isDebitNormal ? ($saldo >= 0 ? 'D' : 'K') : ($saldo >= 0 ? 'K' : 'D') ?>)</strong></td>
                </tr>
            </tfoot>
        </table>
    <?php endforeach; ?>
</body>
</html>
