<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederAkun3 extends Seeder
{
    public function run()
    {
        $data = [
            // 1. Aktiva (kode_akun1 = 1)
            // 11 Aktiva Lancar
            [
                'kode_akun3' => 1101,
                'nama_akun3' => 'Kas',
                'kode_akun1' => 1,
                'kode_akun2' => 11,
            ],
            [
                'kode_akun3' => 1102,
                'nama_akun3' => 'Piutang Usaha',
                'kode_akun1' => 1,
                'kode_akun2' => 11,
            ],
            [
                'kode_akun3' => 1103,
                'nama_akun3' => 'Perlengkapan Kantor',
                'kode_akun1' => 1,
                'kode_akun2' => 11,
            ],
            [
                'kode_akun3' => 1104,
                'nama_akun3' => 'Sewa Dibayar di muka',
                'kode_akun1' => 1,
                'kode_akun2' => 11,
            ],
            [
                'kode_akun3' => 1105,
                'nama_akun3' => 'Asuransi dibayar di muka',
                'kode_akun1' => 1,
                'kode_akun2' => 11,
            ],
            // 12 Aktiva Tetap
            [
                'kode_akun3' => 1201,
                'nama_akun3' => 'Peralatan Kantor',
                'kode_akun1' => 1,
                'kode_akun2' => 12,
            ],
            [
                'kode_akun3' => 1202,
                'nama_akun3' => 'Akumulasi Penyusutan P. Kantor',
                'kode_akun1' => 1,
                'kode_akun2' => 12,
            ],
            [
                'kode_akun3' => 1203,
                'nama_akun3' => 'Tanah',
                'kode_akun1' => 1,
                'kode_akun2' => 12,
            ],

            // 2. Kewajiban (kode_akun1 = 2)
            // 21 Utang Jangka Pendek
            [
                'kode_akun3' => 2101,
                'nama_akun3' => 'Utang Usaha',
                'kode_akun1' => 2,
                'kode_akun2' => 21,
            ],
            [
                'kode_akun3' => 2102,
                'nama_akun3' => 'Utang Gaji',
                'kode_akun1' => 2,
                'kode_akun2' => 21,
            ],
            [
                'kode_akun3' => 2103,
                'nama_akun3' => 'Pendapatan diterima di muka',
                'kode_akun1' => 2,
                'kode_akun2' => 21,
            ],
            // 22 Utang Jangka Panjang
            [
                'kode_akun3' => 2201,
                'nama_akun3' => 'Utang Hipotek',
                'kode_akun1' => 2,
                'kode_akun2' => 22,
            ],
            [
                'kode_akun3' => 2202,
                'nama_akun3' => 'Utang Obligasi',
                'kode_akun1' => 2,
                'kode_akun2' => 22,
            ],

            // 3. Modal (kode_akun1 = 3)
            // 31 Modal Pemilik
            [
                'kode_akun3' => 3101,
                'nama_akun3' => 'Modal Pemilik',
                'kode_akun1' => 3,
                'kode_akun2' => 31,
            ],
            [
                'kode_akun3' => 3102,
                'nama_akun3' => 'Modal Lainnya',
                'kode_akun1' => 3,
                'kode_akun2' => 31,
            ],
            // 32 Prive Pemilik
            [
                'kode_akun3' => 3201,
                'nama_akun3' => 'Prive Tuan Najwan',
                'kode_akun1' => 3,
                'kode_akun2' => 32,
            ],
            [
                'kode_akun3' => 3202,
                'nama_akun3' => 'Prive Tuan A',
                'kode_akun1' => 3,
                'kode_akun2' => 32,
            ],

            // 4. Pendapatan (kode_akun1 = 4)
            // 41 Pendapatan Usaha
            [
                'kode_akun3' => 4101,
                'nama_akun3' => 'Pendapatan Jasa',
                'kode_akun1' => 4,
                'kode_akun2' => 41,
            ],
            [
                'kode_akun3' => 4102,
                'nama_akun3' => 'Pendapatan diterima di muka',
                'kode_akun1' => 4,
                'kode_akun2' => 41,
            ],
            // 42 Pendapatan di Luar Usaha
            [
                'kode_akun3' => 4201,
                'nama_akun3' => 'Pendapatan diluar usaha',
                'kode_akun1' => 4,
                'kode_akun2' => 42,
            ],
            [
                'kode_akun3' => 4202,
                'nama_akun3' => 'Pendapatan lainnya',
                'kode_akun1' => 4,
                'kode_akun2' => 42,
            ],

            // 5. Beban (kode_akun1 = 5)
            // 51 Beban Usaha
            [
                'kode_akun3' => 5101,
                'nama_akun3' => 'Beban Gaji Karyawan',
                'kode_akun1' => 5,
                'kode_akun2' => 51,
            ],
            [
                'kode_akun3' => 5102,
                'nama_akun3' => 'Beban Iklan',
                'kode_akun1' => 5,
                'kode_akun2' => 51,
            ],
            [
                'kode_akun3' => 5103,
                'nama_akun3' => 'Beban Asuransi',
                'kode_akun1' => 5,
                'kode_akun2' => 51,
            ],
            [
                'kode_akun3' => 5104,
                'nama_akun3' => 'Beban Telepon',
                'kode_akun1' => 5,
                'kode_akun2' => 51,
            ],
            [
                'kode_akun3' => 5105,
                'nama_akun3' => 'Beban Listrik',
                'kode_akun1' => 5,
                'kode_akun2' => 51,
            ],
            [
                'kode_akun3' => 5106,
                'nama_akun3' => 'Beban Sewa',
                'kode_akun1' => 5,
                'kode_akun2' => 51,
            ],
            [
                'kode_akun3' => 5107,
                'nama_akun3' => 'Beban Penyusutan Peralatan Kantor',
                'kode_akun1' => 5,
                'kode_akun2' => 51,
            ],
            [
                'kode_akun3' => 5108,
                'nama_akun3' => 'Beban Perlengkapan Kantor',
                'kode_akun1' => 5,
                'kode_akun2' => 51,
            ],
            // 52 Beban di Luar Usaha
            [
                'kode_akun3' => 5201,
                'nama_akun3' => 'Beban Bunga',
                'kode_akun1' => 5,
                'kode_akun2' => 52,
            ],
        ];

        $this->db->table('akun3s')->insertBatch($data);
    }
}
