<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenyesuaian extends Model
{
    protected $table            = 'tbl_penyesuaian';
    protected $primaryKey       = 'id_penyesuaian';
    protected $returnType       = 'object';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['tanggal', 'deskripsi', 'nilai', 'waktu', 'jumlah'];

    public function ambilrelasi()
    {
        $builder = $this->db->table('tbl_penyesuaian');
        $builder->orderBy('id_penyesuaian', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }
}
