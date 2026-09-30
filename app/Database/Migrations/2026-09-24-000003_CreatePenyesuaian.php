<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenyesuaian extends Migration
{
    public function up()
    {
        // 1. Tabel tbl_penyesuaian
        $this->forge->addField([
            'id_penyesuaian' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'nilai' => [
                'type'       => 'FLOAT',
                'constraint' => '12,2',
                'default'    => 0,
            ],
            'waktu' => [
                'type'       => 'INT',
                'constraint' => 6,
                'default'    => 1,
            ],
            'jumlah' => [
                'type'       => 'FLOAT',
                'constraint' => '12,2',
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_penyesuaian', true);
        $this->forge->createTable('tbl_penyesuaian', true, ['ENGINE' => 'InnoDB']);

        // 2. Tabel tbl_nilai_penyesuaian
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_penyesuaian' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'kode_akun3' => [
                'type'       => 'INT',
                'constraint' => 6,
                'unsigned'   => true,
            ],
            'debit' => [
                'type'       => 'FLOAT',
                'constraint' => '12,2',
                'default'    => 0,
            ],
            'kredit' => [
                'type'       => 'FLOAT',
                'constraint' => '12,2',
                'default'    => 0,
            ],
            'id_status' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('id_penyesuaian');
        $this->forge->addForeignKey('id_penyesuaian', 'tbl_penyesuaian', 'id_penyesuaian', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_nilai_penyesuaian', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_nilai_penyesuaian', true);
        $this->forge->dropTable('tbl_penyesuaian', true);
    }
}
