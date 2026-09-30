<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederPenyesuaian extends Seeder
{
    public function run()
    {
        $this->db->disableForeignKeyChecks();
        $this->db->table('tbl_nilai_penyesuaian')->emptyTable();
        $this->db->table('tbl_penyesuaian')->emptyTable();
        $this->db->enableForeignKeyChecks();

        $penyesuaian = [
            // 1. Beban Sewa (1 bulan dari 6 bulan)
            [
                'tanggal'   => '2025-12-31',
                'deskripsi' => 'Penyesuaian beban sewa tempat kantor bulan Desember (1 bulan terpakai dari total 6 bulan)',
                'nilai'     => 15000000,
                'waktu'     => 6,
                'jumlah'    => 2500000,
                'items'     => [
                    ['kode_akun3' => 5106, 'debit' => 2500000, 'kredit' => 0, 'id_status' => 5], // Beban Sewa
                    ['kode_akun3' => 1104, 'debit' => 0, 'kredit' => 2500000, 'id_status' => 5], // Sewa Dibayar di muka
                ],
            ],
            // 2. Beban Asuransi (1 bulan dari 12 bulan)
            [
                'tanggal'   => '2025-12-31',
                'deskripsi' => 'Penyesuaian beban asuransi perlindungan kantor bulan Desember (1 bulan terpakai dari total 12 bulan)',
                'nilai'     => 4200000,
                'waktu'     => 12,
                'jumlah'    => 350000,
                'items'     => [
                    ['kode_akun3' => 5103, 'debit' => 350000, 'kredit' => 0, 'id_status' => 5], // Beban Asuransi
                    ['kode_akun3' => 1105, 'debit' => 0, 'kredit' => 350000, 'id_status' => 5], // Asuransi dibayar di muka
                ],
            ],
            // 3. Penyusutan Peralatan Kantor
            [
                'tanggal'   => '2025-12-31',
                'deskripsi' => 'Penyesuaian beban penyusutan peralatan kantor untuk bulan Desember',
                'nilai'     => 600000,
                'waktu'     => 1,
                'jumlah'    => 600000,
                'items'     => [
                    ['kode_akun3' => 5107, 'debit' => 600000, 'kredit' => 0, 'id_status' => 5], // Beban Penyusutan Peralatan Kantor
                    ['kode_akun3' => 1202, 'debit' => 0, 'kredit' => 600000, 'id_status' => 5], // Akumulasi Penyusutan P. Kantor
                ],
            ],
            // 4. Perlengkapan Kantor yang Terpakai
            [
                'tanggal'   => '2025-12-31',
                'deskripsi' => 'Penyesuaian pemakaian perlengkapan kantor selama bulan Desember (terpakai Rp 1.000.000, tersisa Rp 3.200.000)',
                'nilai'     => 1000000,
                'waktu'     => 1,
                'jumlah'    => 1000000,
                'items'     => [
                    ['kode_akun3' => 5108, 'debit' => 1000000, 'kredit' => 0, 'id_status' => 5], // Beban Perlengkapan Kantor
                    ['kode_akun3' => 1103, 'debit' => 0, 'kredit' => 1000000, 'id_status' => 5], // Perlengkapan Kantor
                ],
            ],
            // 5. Piutang Jasa / Pendapatan Jasa Yang Belum Ditagih
            [
                'tanggal'   => '2025-12-31',
                'deskripsi' => 'Penyesuaian pendapatan jasa konsultasi yang telah diselesaikan tetapi belum ditagih/diterima',
                'nilai'     => 2500000,
                'waktu'     => 1,
                'jumlah'    => 2500000,
                'items'     => [
                    ['kode_akun3' => 1102, 'debit' => 2500000, 'kredit' => 0, 'id_status' => 5], // Piutang Usaha
                    ['kode_akun3' => 4101, 'debit' => 0, 'kredit' => 2500000, 'id_status' => 5], // Pendapatan Jasa
                ],
            ],
        ];

        foreach ($penyesuaian as $p) {
            $dataHeader = [
                'tanggal'    => $p['tanggal'],
                'deskripsi'  => $p['deskripsi'],
                'nilai'      => $p['nilai'],
                'waktu'      => $p['waktu'],
                'jumlah'     => $p['jumlah'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->table('tbl_penyesuaian')->insert($dataHeader);
            $idAdj = $this->db->insertID();

            foreach ($p['items'] as $item) {
                $this->db->table('tbl_nilai_penyesuaian')->insert([
                    'id_penyesuaian' => $idAdj,
                    'kode_akun3'     => $item['kode_akun3'],
                    'debit'          => $item['debit'],
                    'kredit'         => $item['kredit'],
                    'id_status'      => $item['id_status'],
                    'created_at'     => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
