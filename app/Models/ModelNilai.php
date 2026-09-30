<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNilai extends Model
{
    protected $table            = 'tbl_nilai';
    protected $primaryKey       = 'id_nilai';
    protected $returnType       = 'object';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['id_transaksi', 'kode_akun3', 'debit', 'kredit', 'id_status'];

    public function ambilrelasi($id_transaksi)
    {
        $builder = $this->db->table('tbl_nilai');
        $builder->select('tbl_nilai.*, akun3s.nama_akun3, tbl_status.status');
        $builder->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai.kode_akun3', 'left');
        $builder->join('tbl_status', 'tbl_status.id_status = tbl_nilai.id_status', 'left');
        $builder->where('tbl_nilai.id_transaksi', $id_transaksi);
        $builder->orderBy('tbl_nilai.id_nilai', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
}
