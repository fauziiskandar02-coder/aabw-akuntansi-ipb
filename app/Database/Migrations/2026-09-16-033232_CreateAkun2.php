<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAkun2 extends Migration
{
    public function up()
    {
        //Mendefinisikan struktur kolom untuk tabel akun2s
        $this->forge->addField([
            'id_akun2' => [
                'type'           => 'INT',
                'constraint'     => 6,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_akun2' => [
                'type'       => 'INT',
                'constraint' => 6,
                'unsigned'   => true,

            ],
            'nama_akun2' => [
                'type'       => 'VARCHAR',
                'constraint' => 40,
            ],
            'kode_akun1' => [
                'type'       => 'INT',
                'constraint' => 6,
                'unsigned'   => true,
            ],
        ]);

        // Menjadikan kolom 'id' sebagai Primary Key
        $this->forge->addKey('id_akun2', true);
        $this->forge->addKey('kode_akun1');
        $this->forge->addForeignKey('kode_akun1', 'akun1s', 'id_akun1', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('akun2s', false, $attributes);
    }


    public function down()
    {
        // Menghapus tabel jika kita melakukan perintah rollback/undo migration
        $this->forge->dropForeignKey('akun2s', 'akun2s_kode_akun1_foreign');
        $this->forge->dropTable('akun2s');
    }
}
