<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNilaiPenyesuaian extends Model
{
    protected $table            = 'tbl_nilai_penyesuaian';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['id_penyesuaian', 'kode_akun3', 'debit', 'kredit', 'id_status'];

    public function ambilrelasi($id_penyesuaian)
    {
        $builder = $this->db->table('tbl_nilai_penyesuaian');
        $builder->select('tbl_nilai_penyesuaian.*, akun3s.nama_akun3, tbl_status.status');
        $builder->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai_penyesuaian.kode_akun3', 'left');
        $builder->join('tbl_status', 'tbl_status.id_status = tbl_nilai_penyesuaian.id_status', 'left');
        $builder->where('tbl_nilai_penyesuaian.id_penyesuaian', $id_penyesuaian);
        $builder->orderBy('tbl_nilai_penyesuaian.id', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
}
