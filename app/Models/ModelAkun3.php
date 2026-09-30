<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAkun3 extends Model
{
    protected $table            = 'akun3s';
    protected $primaryKey       = 'id_akun3';
    protected $returnType       = 'object';
    protected $allowedFields    = ['kode_akun3', 'nama_akun3', 'kode_akun1', 'kode_akun2'];

    public function ambilrelasi()
    {
        $builder = $this->db->table('akun3s');
        $builder->select('akun3s.*, akun1s.nama_akun1, akun2s.nama_akun2');
        $builder->join('akun1s', 'akun1s.kode_akun1 = akun3s.kode_akun1');
        $builder->join('akun2s', 'akun2s.kode_akun2 = akun3s.kode_akun2');
        $builder->orderBy('akun3s.kode_akun3', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
}
