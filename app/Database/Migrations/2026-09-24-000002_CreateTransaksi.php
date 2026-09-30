<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksi extends Migration
{
    public function up()
    {
        // 1. Tabel tbl_status
        $this->forge->addField([
            'id_status' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('id_status', true);
        $this->forge->createTable('tbl_status', true, ['ENGINE' => 'InnoDB']);

        // 2. Tabel tbl_transaksi
        $this->forge->addField([
            'id_transaksi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kwitansi' => [
                'type'       => 'VARCHAR',
                'constraint' => 4,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'ketjurnal' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
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
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_transaksi', true);
        $this->forge->createTable('tbl_transaksi', true, ['ENGINE' => 'InnoDB']);

        // 3. Tabel tbl_nilai
        $this->forge->addField([
            'id_nilai' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_transaksi' => [
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
        $this->forge->addKey('id_nilai', true);
        $this->forge->addKey('id_transaksi');
        $this->forge->addForeignKey('id_transaksi', 'tbl_transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_nilai', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_nilai', true);
        $this->forge->dropTable('tbl_transaksi', true);
        $this->forge->dropTable('tbl_status', true);
    }
}
