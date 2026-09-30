<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederTransaksi extends Seeder
{
    public function run()
    {
        $this->db->disableForeignKeyChecks();
        $this->db->table('tbl_nilai')->emptyTable();
        $this->db->table('tbl_transaksi')->emptyTable();
        $this->db->enableForeignKeyChecks();

        $transaksi = [
            // 1. Dec 1: Setoran modal awal
            [
                'kwitansi'  => '0001',
                'tanggal'   => '2025-12-01',
                'deskripsi' => 'Setoran modal awal Pak Najwan berupa uang tunai, perlengkapan kantor, dan peralatan kantor',
                'ketjurnal' => 'Setoran Modal Awal',
                'items'     => [
                    ['kode_akun3' => 1101, 'debit' => 30000000, 'kredit' => 0, 'id_status' => 3], // Kas (Investasi Masuk)
                    ['kode_akun3' => 1103, 'debit' => 3000000,  'kredit' => 0, 'id_status' => 5], // Perlengkapan
                    ['kode_akun3' => 1201, 'debit' => 35000000, 'kredit' => 0, 'id_status' => 5], // Peralatan
                    ['kode_akun3' => 3101, 'debit' => 0, 'kredit' => 68000000, 'id_status' => 5], // Modal Pemilik
                ],
            ],
            // 2. Dec 2: Sewa gedung kantor 6 bulan tunai
            [
                'kwitansi'  => '0002',
                'tanggal'   => '2025-12-02',
                'deskripsi' => 'Pembayaran sewa gedung kantor selama 6 bulan tunai',
                'ketjurnal' => 'Pembayaran Sewa Gedung',
                'items'     => [
                    ['kode_akun3' => 1104, 'debit' => 15000000, 'kredit' => 0, 'id_status' => 5], // Sewa Dibayar di muka
                    ['kode_akun3' => 1101, 'debit' => 0, 'kredit' => 15000000, 'id_status' => 2], // Kas (Pengeluaran)
                ],
            ],
            // 3. Dec 3 (A): Beli peralatan kantor kredit
            [
                'kwitansi'  => '0003',
                'tanggal'   => '2025-12-03',
                'deskripsi' => 'Pembelian peralatan kantor secara kredit dari Toko Furniture',
                'ketjurnal' => 'Pembelian Peralatan Kredit',
                'items'     => [
                    ['kode_akun3' => 1201, 'debit' => 5000000, 'kredit' => 0, 'id_status' => 5], // Peralatan Kantor
                    ['kode_akun3' => 2101, 'debit' => 0, 'kredit' => 5000000, 'id_status' => 5], // Utang Usaha
                ],
            ],
            // 4. Dec 3 (B): Terima uang muka jasa akuntansi
            [
                'kwitansi'  => '0004',
                'tanggal'   => '2025-12-03',
                'deskripsi' => 'Penerimaan uang muka dari pelanggan untuk jasa akuntansi yang akan diselesaikan',
                'ketjurnal' => 'Penerimaan Pendapatan Diterima Dimuka',
                'items'     => [
                    ['kode_akun3' => 1101, 'debit' => 2000000, 'kredit' => 0, 'id_status' => 1], // Kas (Penerimaan)
                    ['kode_akun3' => 2103, 'debit' => 0, 'kredit' => 2000000, 'id_status' => 5], // Pendapatan Diterima Dimuka
                ],
            ],
            // 5. Dec 5: Premi asuransi 1 tahun tunai
            [
                'kwitansi'  => '0005',
                'tanggal'   => '2025-12-05',
                'deskripsi' => 'Pembayaran premi asuransi perlindungan kantor untuk 1 tahun tunai',
                'ketjurnal' => 'Pembayaran Asuransi Dibayar Dimuka',
                'items'     => [
                    ['kode_akun3' => 1105, 'debit' => 4200000, 'kredit' => 0, 'id_status' => 5], // Asuransi Dibayar Dimuka
                    ['kode_akun3' => 1101, 'debit' => 0, 'kredit' => 4200000, 'id_status' => 2], // Kas (Pengeluaran)
                ],
            ],
            // 6. Dec 7: Beban iklan tunai
            [
                'kwitansi'  => '0006',
                'tanggal'   => '2025-12-07',
                'deskripsi' => 'Pembayaran beban promosi dan iklan media sosial tunai',
                'ketjurnal' => 'Pembayaran Beban Iklan',
                'items'     => [
                    ['kode_akun3' => 5102, 'debit' => 300000, 'kredit' => 0, 'id_status' => 5], // Beban Iklan
                    ['kode_akun3' => 1101, 'debit' => 0, 'kredit' => 300000, 'id_status' => 2], // Kas (Pengeluaran)
                ],
            ],
            // 7. Dec 8: Bayar sebagian utang usaha
            [
                'kwitansi'  => '0007',
                'tanggal'   => '2025-12-08',
                'deskripsi' => 'Pembayaran sebagian utang usaha atas pembelian peralatan tanggal 3 Desember',
                'ketjurnal' => 'Pembayaran Sebagian Utang',
                'items'     => [
                    ['kode_akun3' => 2101, 'debit' => 2500000, 'kredit' => 0, 'id_status' => 5], // Utang Usaha
                    ['kode_akun3' => 1101, 'debit' => 0, 'kredit' => 2500000, 'id_status' => 2], // Kas (Pengeluaran)
                ],
            ],
            // 8. Dec 10: Pendapatan jasa pembukuan kredit
            [
                'kwitansi'  => '0008',
                'tanggal'   => '2025-12-10',
                'deskripsi' => 'Penyelesaian jasa pembukuan akuntansi kepada klien secara kredit',
                'ketjurnal' => 'Pendapatan Jasa Kredit',
                'items'     => [
                    ['kode_akun3' => 1102, 'debit' => 5800000, 'kredit' => 0, 'id_status' => 5], // Piutang Usaha
                    ['kode_akun3' => 4101, 'debit' => 0, 'kredit' => 5800000, 'id_status' => 5], // Pendapatan Jasa
                ],
            ],
            // 9. Dec 15: Bayar gaji periode pertama tunai
            [
                'kwitansi'  => '0009',
                'tanggal'   => '2025-12-15',
                'deskripsi' => 'Pembayaran gaji staf akuntansi periode tengah bulan Desember tunai',
                'ketjurnal' => 'Pembayaran Beban Gaji',
                'items'     => [
                    ['kode_akun3' => 5101, 'debit' => 1250000, 'kredit' => 0, 'id_status' => 5], // Beban Gaji
                    ['kode_akun3' => 1101, 'debit' => 0, 'kredit' => 1250000, 'id_status' => 2], // Kas (Pengeluaran)
                ],
            ],
            // 10. Dec 16: Pelunasan piutang tgl 10 Des
            [
                'kwitansi'  => '0010',
                'tanggal'   => '2025-12-16',
                'deskripsi' => 'Penerimaan pelunasan piutang usaha dari klien atas jasa tanggal 10 Desember',
                'ketjurnal' => 'Pelunasan Piutang Usaha',
                'items'     => [
                    ['kode_akun3' => 1101, 'debit' => 5800000, 'kredit' => 0, 'id_status' => 1], // Kas (Penerimaan)
                    ['kode_akun3' => 1102, 'debit' => 0, 'kredit' => 5800000, 'id_status' => 5], // Piutang Usaha
                ],
            ],
            // 11. Dec 17: Pendapatan jasa audit kredit
            [
                'kwitansi'  => '0011',
                'tanggal'   => '2025-12-17',
                'deskripsi' => 'Penyelesaian jasa audit laporan keuangan secara kredit kepada PT Rekanan',
                'ketjurnal' => 'Pendapatan Jasa Kredit',
                'items'     => [
                    ['kode_akun3' => 1102, 'debit' => 19400000, 'kredit' => 0, 'id_status' => 5], // Piutang Usaha
                    ['kode_akun3' => 4101, 'debit' => 0, 'kredit' => 19400000, 'id_status' => 5], // Pendapatan Jasa
                ],
            ],
            // 12. Dec 19: Pembelian perlengkapan kantor tunai
            [
                'kwitansi'  => '0012',
                'tanggal'   => '2025-12-19',
                'deskripsi' => 'Pembelian tambahan perlengkapan operasional kantor tunai',
                'ketjurnal' => 'Pembelian Perlengkapan Kantor',
                'items'     => [
                    ['kode_akun3' => 1103, 'debit' => 1200000, 'kredit' => 0, 'id_status' => 5], // Perlengkapan
                    ['kode_akun3' => 1101, 'debit' => 0, 'kredit' => 1200000, 'id_status' => 2], // Kas (Pengeluaran)
                ],
            ],
            // 13. Dec 20 (A): Beban telepon tunai
            [
                'kwitansi'  => '0013',
                'tanggal'   => '2025-12-20',
                'deskripsi' => 'Pembayaran tagihan telepon dan internet kantor bulan Desember tunai',
                'ketjurnal' => 'Pembayaran Beban Telepon',
                'items'     => [
                    ['kode_akun3' => 5104, 'debit' => 350000, 'kredit' => 0, 'id_status' => 5], // Beban Telepon
                    ['kode_akun3' => 1101, 'debit' => 0, 'kredit' => 350000, 'id_status' => 2], // Kas (Pengeluaran)
                ],
            ],
            // 14. Dec 20 (B): Beban listrik tunai
            [
                'kwitansi'  => '0014',
                'tanggal'   => '2025-12-20',
                'deskripsi' => 'Pembayaran tagihan listrik PLN kantor bulan Desember tunai',
                'ketjurnal' => 'Pembayaran Beban Listrik',
                'items'     => [
                    ['kode_akun3' => 5105, 'debit' => 170000, 'kredit' => 0, 'id_status' => 5], // Beban Listrik
                    ['kode_akun3' => 1101, 'debit' => 0, 'kredit' => 170000, 'id_status' => 2], // Kas (Pengeluaran)
                ],
            ],
            // 15. Dec 24: Terima sebagian piutang tgl 17 Des
            [
                'kwitansi'  => '0015',
                'tanggal'   => '2025-12-24',
                'deskripsi' => 'Penerimaan pembayaran sebagian piutang atas jasa tgl 17 Desember dari PT Rekanan',
                'ketjurnal' => 'Penerimaan Sebagian Piutang',
                'items'     => [
                    ['kode_akun3' => 1101, 'debit' => 8000000, 'kredit' => 0, 'id_status' => 1], // Kas (Penerimaan)
                    ['kode_akun3' => 1102, 'debit' => 0, 'kredit' => 8000000, 'id_status' => 5], // Piutang Usaha
                ],
            ],
            // 16. Dec 30 (A): Bayar gaji periode kedua tunai
            [
                'kwitansi'  => '0016',
                'tanggal'   => '2025-12-30',
                'deskripsi' => 'Pembayaran gaji staf akuntansi periode akhir bulan Desember tunai',
                'ketjurnal' => 'Pembayaran Beban Gaji',
                'items'     => [
                    ['kode_akun3' => 5101, 'debit' => 1250000, 'kredit' => 0, 'id_status' => 5], // Beban Gaji
                    ['kode_akun3' => 1101, 'debit' => 0, 'kredit' => 1250000, 'id_status' => 2], // Kas (Pengeluaran)
                ],
            ],
            // 17. Dec 30 (B): Terima pelunasan sisa piutang tgl 17 Des
            [
                'kwitansi'  => '0017',
                'tanggal'   => '2025-12-30',
                'deskripsi' => 'Penerimaan pelunasan sisa piutang dari PT Rekanan atas jasa tgl 17 Desember',
                'ketjurnal' => 'Pelunasan Sisa Piutang',
                'items'     => [
                    ['kode_akun3' => 1101, 'debit' => 11400000, 'kredit' => 0, 'id_status' => 1], // Kas (Penerimaan)
                    ['kode_akun3' => 1102, 'debit' => 0, 'kredit' => 11400000, 'id_status' => 5], // Piutang Usaha
                ],
            ],
            // 18. Dec 30 (C): Pendapatan jasa konsultasi kredit
            [
                'kwitansi'  => '0018',
                'tanggal'   => '2025-12-30',
                'deskripsi' => 'Penyelesaian jasa konsultasi perpajakan kepada klien secara kredit',
                'ketjurnal' => 'Pendapatan Jasa Kredit',
                'items'     => [
                    ['kode_akun3' => 1102, 'debit' => 3000000, 'kredit' => 0, 'id_status' => 5], // Piutang Usaha
                    ['kode_akun3' => 4101, 'debit' => 0, 'kredit' => 3000000, 'id_status' => 5], // Pendapatan Jasa
                ],
            ],
            // 19. Dec 30 (D): Prive Tuan Najwan
            [
                'kwitansi'  => '0019',
                'tanggal'   => '2025-12-30',
                'deskripsi' => 'Penarikan uang tunai oleh Tuan Najwan untuk keperluan pribadi',
                'ketjurnal' => 'Prive Tuan Najwan',
                'items'     => [
                    ['kode_akun3' => 3201, 'debit' => 1200000, 'kredit' => 0, 'id_status' => 5], // Prive
                    ['kode_akun3' => 1101, 'debit' => 0, 'kredit' => 1200000, 'id_status' => 4], // Kas (Investasi Keluar)
                ],
            ],
        ];

        foreach ($transaksi as $t) {
            $dataTrx = [
                'kwitansi'   => $t['kwitansi'],
                'tanggal'    => $t['tanggal'],
                'deskripsi'  => $t['deskripsi'],
                'ketjurnal'  => $t['ketjurnal'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->table('tbl_transaksi')->insert($dataTrx);
            $idTrx = $this->db->insertID();

            foreach ($t['items'] as $item) {
                $this->db->table('tbl_nilai')->insert([
                    'id_transaksi' => $idTrx,
                    'kode_akun3'   => $item['kode_akun3'],
                    'debit'        => $item['debit'],
                    'kredit'       => $item['kredit'],
                    'id_status'    => $item['id_status'],
                    'created_at'   => date('Y-m-d H:i:s'),
                    'updated_at'   => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
