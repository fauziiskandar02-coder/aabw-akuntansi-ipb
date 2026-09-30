<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederStatus extends Seeder
{
    public function run()
    {
        $data = [
            ['id_status' => 1, 'status' => 'Penerimaan'],
            ['id_status' => 2, 'status' => 'Pengeluaran'],
            ['id_status' => 3, 'status' => 'Investasi Masuk'],
            ['id_status' => 4, 'status' => 'Investasi Keluar'],
            ['id_status' => 5, 'status' => 'Normal'],
        ];

        $this->db->table('tbl_status')->insertBatch($data);
    }
}
