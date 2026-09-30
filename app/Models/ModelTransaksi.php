<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $returnType       = 'object';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['kwitansi', 'tanggal', 'deskripsi', 'ketjurnal'];

    public function noKwitansi()
    {
        $builder = $this->db->table('tbl_transaksi');
        $builder->selectMax('kwitansi', 'max_id');
        $query = $builder->get();
        $data = $query->getRow();
        $kode = $data ? $data->max_id : null;
        if ($kode) {
            $noUrut = (int) substr($kode, -4);
            $noUrut++;
        } else {
            $noUrut = 1;
        }
        return sprintf("%04s", $noUrut);
    }

    public function ambilrelasi()
    {
        $builder = $this->db->table('tbl_transaksi');
        $builder->orderBy('id_transaksi', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getJurnalUmum($tgl_awal = null, $tgl_akhir = null)
    {
        $builder = $this->db->table('tbl_nilai');
        $builder->select('tbl_nilai.*, tbl_transaksi.kwitansi, tbl_transaksi.tanggal, tbl_transaksi.deskripsi, tbl_transaksi.ketjurnal, akun3s.nama_akun3');
        $builder->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_nilai.id_transaksi');
        $builder->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai.kode_akun3');
        
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $builder->where('tbl_transaksi.tanggal >=', $tgl_awal);
            $builder->where('tbl_transaksi.tanggal <=', $tgl_akhir);
        }
        
        $builder->orderBy('tbl_transaksi.tanggal', 'ASC');
        $builder->orderBy('tbl_transaksi.id_transaksi', 'ASC');
        $builder->orderBy('tbl_nilai.id_nilai', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getPosting($tgl_awal = null, $tgl_akhir = null, $kode_akun3 = null)
    {
        $builder = $this->db->table('tbl_nilai');
        $builder->select('tbl_nilai.*, tbl_transaksi.kwitansi, tbl_transaksi.tanggal, tbl_transaksi.deskripsi, tbl_transaksi.ketjurnal, akun3s.nama_akun3');
        $builder->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_nilai.id_transaksi');
        $builder->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai.kode_akun3');
        
        if (!empty($kode_akun3)) {
            $builder->where('tbl_nilai.kode_akun3', $kode_akun3);
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $builder->where('tbl_transaksi.tanggal >=', $tgl_awal);
            $builder->where('tbl_transaksi.tanggal <=', $tgl_akhir);
        }
        
        $builder->orderBy('tbl_transaksi.tanggal', 'ASC');
        $builder->orderBy('tbl_nilai.id_nilai', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getNeracaSaldo($tgl_awal = null, $tgl_akhir = null)
    {
        $builder = $this->db->table('tbl_nilai');
        $builder->select('tbl_nilai.kode_akun3, akun3s.nama_akun3, tbl_transaksi.tanggal, SUM(tbl_nilai.debit) as debit, SUM(tbl_nilai.kredit) as kredit');
        $builder->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_nilai.id_transaksi');
        $builder->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai.kode_akun3');

        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $builder->where('tbl_transaksi.tanggal >=', $tgl_awal);
            $builder->where('tbl_transaksi.tanggal <=', $tgl_akhir);
        }

        $builder->groupBy('tbl_nilai.kode_akun3');
        $builder->orderBy('tbl_nilai.kode_akun3', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getNeracaLajur($tgl_awal = null, $tgl_akhir = null)
    {
        $whereTrx = "";
        $whereAdj = "";
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $whereTrx = "WHERE t.tanggal >= '{$tgl_awal}' AND t.tanggal <= '{$tgl_akhir}'";
            $whereAdj = "WHERE p.tanggal >= '{$tgl_awal}' AND p.tanggal <= '{$tgl_akhir}'";
        }

        $sql = "SELECT 
                    a.kode_akun3, 
                    a.nama_akun3, 
                    a.kode_akun1,
                    COALESCE(trx.deb_trx, 0) as deb_trx,
                    COALESCE(trx.kre_trx, 0) as kre_trx,
                    COALESCE(adj.deb_adj, 0) as deb_adj,
                    COALESCE(adj.kre_adj, 0) as kre_adj
                FROM akun3s a
                LEFT JOIN (
                    SELECT n.kode_akun3, SUM(n.debit) as deb_trx, SUM(n.kredit) as kre_trx
                    FROM tbl_nilai n
                    JOIN tbl_transaksi t ON t.id_transaksi = n.id_transaksi
                    {$whereTrx}
                    GROUP BY n.kode_akun3
                ) trx ON trx.kode_akun3 = a.kode_akun3
                LEFT JOIN (
                    SELECT np.kode_akun3, SUM(np.debit) as deb_adj, SUM(np.kredit) as kre_adj
                    FROM tbl_nilai_penyesuaian np
                    JOIN tbl_penyesuaian p ON p.id_penyesuaian = np.id_penyesuaian
                    {$whereAdj}
                    GROUP BY np.kode_akun3
                ) adj ON adj.kode_akun3 = a.kode_akun3
                WHERE (COALESCE(trx.deb_trx, 0) > 0 OR COALESCE(trx.kre_trx, 0) > 0 OR COALESCE(adj.deb_adj, 0) > 0 OR COALESCE(adj.kre_adj, 0) > 0)
                ORDER BY a.kode_akun3 ASC";

        $query = $this->db->query($sql);
        return $query->getResult();
    }
}
