<?php

namespace App\Controllers;

use App\Models\ModelTransaksi;
use App\Models\ModelNilai;
use App\Models\ModelStatus;
use App\Models\ModelAkun3;
use CodeIgniter\RESTful\ResourceController;

class Transaksi extends ResourceController
{
    protected ModelTransaksi $objTransaksi;
    protected ModelNilai $objNilai;
    protected ModelStatus $objStatus;
    protected ModelAkun3 $objAkun3;
    /** @var \CodeIgniter\Database\BaseConnection */
    protected $db;

    public function __construct()
    {
        $this->objTransaksi = new ModelTransaksi();
        $this->objNilai     = new ModelNilai();
        $this->objStatus    = new ModelStatus();
        $this->objAkun3     = new ModelAkun3();
        $this->db           = \Config\Database::connect();
    }

    public function index()
    {
        $data['dttransaksi'] = $this->objTransaksi->ambilrelasi();
        return view('transaksi/index', $data);
    }

    public function show($id = null)
    {
        $transaksi = $this->objTransaksi->find($id);
        if (!$transaksi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['transaksi'] = $transaksi;
        $data['dtnilai']   = $this->objNilai->ambilrelasi($id);
        return view('transaksi/detail', $data);
    }

    public function new()
    {
        $data['kwitansi'] = $this->objTransaksi->noKwitansi();
        $data['dtakun3']  = $this->objAkun3->orderBy('kode_akun3', 'ASC')->findAll();
        $data['dtstatus'] = $this->objStatus->findAll();
        return view('transaksi/new', $data);
    }

    public function create()
    {
        $dataTransaksi = [
            'kwitansi'  => $this->request->getVar('kwitansi'),
            'tanggal'   => $this->request->getVar('tanggal'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'ketjurnal' => $this->request->getVar('ketjurnal'),
        ];
        $this->db->table('tbl_transaksi')->insert($dataTransaksi);
        $id_transaksi = $this->db->insertID();

        $kode_akun3 = $this->request->getVar('kode_akun3');
        $debit      = $this->request->getVar('debit');
        $kredit     = $this->request->getVar('kredit');
        $id_status  = $this->request->getVar('id_status');

        if (!empty($kode_akun3)) {
            $dataNilai = [];
            foreach ($kode_akun3 as $i => $kode) {
                if (!empty($kode)) {
                    $dataNilai[] = [
                        'id_transaksi' => $id_transaksi,
                        'kode_akun3'   => $kode,
                        'debit'        => $debit[$i] ?? 0,
                        'kredit'       => $kredit[$i] ?? 0,
                        'id_status'    => $id_status[$i] ?? 5,
                        'created_at'   => date('Y-m-d H:i:s'),
                        'updated_at'   => date('Y-m-d H:i:s'),
                    ];
                }
            }
            if (!empty($dataNilai)) {
                $this->db->table('tbl_nilai')->insertBatch($dataNilai);
            }
        }

        return redirect()->to(site_url('transaksi'))->with('success', 'Data Transaksi Berhasil Disimpan');
    }

    public function edit($id = null)
    {
        $transaksi = $this->objTransaksi->find($id);
        if (!$transaksi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['transaksi'] = $transaksi;
        $data['dtnilai']   = $this->objNilai->where('id_transaksi', $id)->findAll();
        $data['dtakun3']   = $this->objAkun3->orderBy('kode_akun3', 'ASC')->findAll();
        $data['dtstatus']  = $this->objStatus->findAll();
        return view('transaksi/edit', $data);
    }

    public function update($id = null)
    {
        $dataTransaksi = [
            'kwitansi'  => $this->request->getVar('kwitansi'),
            'tanggal'   => $this->request->getVar('tanggal'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'ketjurnal' => $this->request->getVar('ketjurnal'),
        ];
        $this->db->table('tbl_transaksi')->where('id_transaksi', $id)->update($dataTransaksi);

        // Delete existing tbl_nilai records for this transaction
        $this->db->table('tbl_nilai')->where('id_transaksi', $id)->delete();

        // Re-insert tbl_nilai records
        $kode_akun3 = $this->request->getVar('kode_akun3');
        $debit      = $this->request->getVar('debit');
        $kredit     = $this->request->getVar('kredit');
        $id_status  = $this->request->getVar('id_status');

        if (!empty($kode_akun3)) {
            $dataNilai = [];
            foreach ($kode_akun3 as $i => $kode) {
                if (!empty($kode)) {
                    $dataNilai[] = [
                        'id_transaksi' => $id,
                        'kode_akun3'   => $kode,
                        'debit'        => $debit[$i] ?? 0,
                        'kredit'       => $kredit[$i] ?? 0,
                        'id_status'    => $id_status[$i] ?? 5,
                        'created_at'   => date('Y-m-d H:i:s'),
                        'updated_at'   => date('Y-m-d H:i:s'),
                    ];
                }
            }
            if (!empty($dataNilai)) {
                $this->db->table('tbl_nilai')->insertBatch($dataNilai);
            }
        }

        return redirect()->to(site_url('transaksi'))->with('success', 'Data Transaksi Berhasil Diupdate');
    }

    public function delete($id = null)
    {
        $this->db->table('tbl_nilai')->where('id_transaksi', $id)->delete();
        $this->db->table('tbl_transaksi')->where('id_transaksi', $id)->delete();
        return redirect()->to(site_url('transaksi'))->with('success', 'Data Transaksi Berhasil Dihapus');
    }

    public function akun3()
    {
        $data = $this->objAkun3->orderBy('kode_akun3', 'ASC')->findAll();
        return $this->response->setJSON($data);
    }

    public function status()
    {
        $data = $this->objStatus->findAll();
        return $this->response->setJSON($data);
    }
}
