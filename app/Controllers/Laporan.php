<?php

namespace App\Controllers;

use App\Models\ModelTransaksi;
use CodeIgniter\Controller;

class Laporan extends Controller
{
    protected ModelTransaksi $objTransaksi;
    /** @var \CodeIgniter\Database\BaseConnection */
    protected $db;

    public function __construct()
    {
        $this->objTransaksi = new ModelTransaksi();
        $this->db           = \Config\Database::connect();
    }

    public function perubahanModal()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal') ?? '';
        $tgl_akhir = $this->request->getVar('tgl_akhir') ?? '';

        $lajur = $this->objTransaksi->getNeracaLajur($tgl_awal, $tgl_akhir);

        $totPendapatan = 0;
        $totBeban      = 0;
        $modalAwal     = 0;
        $prive         = 0;

        foreach ($lajur as $row) {
            $k1 = $row->kode_akun1;
            if ($k1 == 4) {
                $totPendapatan += ($row->kre_trx - $row->deb_trx) + ($row->kre_adj - $row->deb_adj);
            } elseif ($k1 == 5) {
                $totBeban += ($row->deb_trx - $row->kre_trx) + ($row->deb_adj - $row->kre_adj);
            } elseif ($row->kode_akun3 == 3101) {
                $modalAwal += ($row->kre_trx - $row->deb_trx);
            } elseif ($row->kode_akun3 == 3201) {
                $prive += ($row->deb_trx - $row->kre_trx);
            }
        }

        $labaBersih = $totPendapatan - $totBeban;
        $modalAkhir = $modalAwal + $labaBersih - $prive;

        $data = [
            'tgl_awal'    => $tgl_awal,
            'tgl_akhir'   => $tgl_akhir,
            'modalAwal'   => $modalAwal,
            'labaBersih'  => $labaBersih,
            'prive'       => $prive,
            'modalAkhir'  => $modalAkhir,
        ];

        return view('laporan/perubahan_modal', $data);
    }

    public function neraca()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal') ?? '';
        $tgl_akhir = $this->request->getVar('tgl_akhir') ?? '';

        $lajur = $this->objTransaksi->getNeracaLajur($tgl_awal, $tgl_akhir);

        $aktivaLancar = [];
        $aktivaTetap  = [];
        $kewajiban    = [];
        $totPendapatan = 0;
        $totBeban      = 0;
        $modalAwal     = 0;
        $prive         = 0;

        foreach ($lajur as $row) {
            $k1 = $row->kode_akun1;
            $k3 = $row->kode_akun3;

            // Saldo Disesuaikan (NSD)
            if ($k1 == 1) {
                if ($k3 == 1202) { // Akumulasi Penyusutan (Contra-Asset)
                    $val = ($row->kre_trx - $row->deb_trx) + ($row->kre_adj - $row->deb_adj);
                    $aktivaTetap[] = ['nama' => $row->nama_akun3, 'kode' => $k3, 'nilai' => -$val];
                } elseif (substr((string)$k3, 0, 2) == '11') {
                    $val = ($row->deb_trx - $row->kre_trx) + ($row->deb_adj - $row->kre_adj);
                    $aktivaLancar[] = ['nama' => $row->nama_akun3, 'kode' => $k3, 'nilai' => $val];
                } else {
                    $val = ($row->deb_trx - $row->kre_trx) + ($row->deb_adj - $row->kre_adj);
                    $aktivaTetap[] = ['nama' => $row->nama_akun3, 'kode' => $k3, 'nilai' => $val];
                }
            } elseif ($k1 == 2) {
                $val = ($row->kre_trx - $row->deb_trx) + ($row->kre_adj - $row->deb_adj);
                $kewajiban[] = ['nama' => $row->nama_akun3, 'kode' => $k3, 'nilai' => $val];
            } elseif ($k1 == 4) {
                $totPendapatan += ($row->kre_trx - $row->deb_trx) + ($row->kre_adj - $row->deb_adj);
            } elseif ($k1 == 5) {
                $totBeban += ($row->deb_trx - $row->kre_trx) + ($row->deb_adj - $row->kre_adj);
            } elseif ($k3 == 3101) {
                $modalAwal += ($row->kre_trx - $row->deb_trx);
            } elseif ($k3 == 3201) {
                $prive += ($row->deb_trx - $row->kre_trx);
            }
        }

        $labaBersih = $totPendapatan - $totBeban;
        $modalAkhir = $modalAwal + $labaBersih - $prive;

        $data = [
            'tgl_awal'     => $tgl_awal,
            'tgl_akhir'    => $tgl_akhir,
            'aktivaLancar' => $aktivaLancar,
            'aktivaTetap'  => $aktivaTetap,
            'kewajiban'    => $kewajiban,
            'modalAkhir'   => $modalAkhir,
        ];

        return view('laporan/neraca', $data);
    }

    public function arusKas()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal') ?? '';
        $tgl_akhir = $this->request->getVar('tgl_akhir') ?? '';

        $builder = $this->db->table('tbl_nilai');
        $builder->select('tbl_nilai.*, tbl_transaksi.tanggal, tbl_transaksi.deskripsi, tbl_status.status');
        $builder->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_nilai.id_transaksi');
        $builder->join('tbl_status', 'tbl_status.id_status = tbl_nilai.id_status');
        $builder->where('tbl_nilai.kode_akun3', 1101); // Akun Kas

        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $builder->where('tbl_transaksi.tanggal >=', $tgl_awal);
            $builder->where('tbl_transaksi.tanggal <=', $tgl_akhir);
        }

        $builder->orderBy('tbl_transaksi.tanggal', 'ASC');
        $query = $builder->get();
        $kasRows = $query->getResult();

        $operasionalMasuk  = [];
        $operasionalKeluar = [];
        $investasiMasuk    = [];
        $investasiKeluar   = [];

        foreach ($kasRows as $r) {
            if ($r->id_status == 1) { // Penerimaan
                $operasionalMasuk[] = ['deskripsi' => $r->deskripsi, 'nilai' => $r->debit];
            } elseif ($r->id_status == 2) { // Pengeluaran
                $operasionalKeluar[] = ['deskripsi' => $r->deskripsi, 'nilai' => $r->kredit];
            } elseif ($r->id_status == 3) { // Investasi Masuk
                $investasiMasuk[] = ['deskripsi' => $r->deskripsi, 'nilai' => $r->debit];
            } elseif ($r->id_status == 4) { // Investasi Keluar
                $investasiKeluar[] = ['deskripsi' => $r->deskripsi, 'nilai' => $r->kredit];
            }
        }

        $data = [
            'tgl_awal'          => $tgl_awal,
            'tgl_akhir'         => $tgl_akhir,
            'operasionalMasuk'  => $operasionalMasuk,
            'operasionalKeluar' => $operasionalKeluar,
            'investasiMasuk'    => $investasiMasuk,
            'investasiKeluar'   => $investasiKeluar,
        ];

        return view('laporan/arus_kas', $data);
    }
}
