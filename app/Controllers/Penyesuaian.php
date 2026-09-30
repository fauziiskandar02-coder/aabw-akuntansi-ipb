<?php

namespace App\Controllers;

use App\Models\ModelPenyesuaian;
use App\Models\ModelNilaiPenyesuaian;
use App\Models\ModelAkun3;
use App\Models\ModelStatus;
use CodeIgniter\RESTful\ResourceController;

class Penyesuaian extends ResourceController
{
    protected ModelPenyesuaian $objPenyesuaian;
    protected ModelNilaiPenyesuaian $objNilaiPenyesuaian;
    protected ModelAkun3 $objAkun3;
    protected ModelStatus $objStatus;
    /** @var \CodeIgniter\Database\BaseConnection */
    protected $db;

    public function __construct()
    {
        $this->objPenyesuaian      = new ModelPenyesuaian();
        $this->objNilaiPenyesuaian = new ModelNilaiPenyesuaian();
        $this->objAkun3            = new ModelAkun3();
        $this->objStatus           = new ModelStatus();
        $this->db                  = \Config\Database::connect();
    }

    public function index()
    {
        $data['dtpenyesuaian'] = $this->objPenyesuaian->ambilrelasi();
        return view('penyesuaian/index', $data);
    }

    public function show($id = null)
    {
        $penyesuaian = $this->objPenyesuaian->find($id);
        if (!$penyesuaian) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['penyesuaian'] = $penyesuaian;
        $data['dtnilai']     = $this->objNilaiPenyesuaian->ambilrelasi($id);
        return view('penyesuaian/detail', $data);
    }

    public function new()
    {
        $data['dtakun3']  = $this->objAkun3->orderBy('kode_akun3', 'ASC')->findAll();
        $data['dtstatus'] = $this->objStatus->findAll();
        return view('penyesuaian/new', $data);
    }

    public function create()
    {
        $dataHeader = [
            'tanggal'   => $this->request->getVar('tanggal'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'nilai'     => $this->request->getVar('nilai'),
            'waktu'     => $this->request->getVar('waktu'),
            'jumlah'    => $this->request->getVar('jumlah'),
        ];
        $this->db->table('tbl_penyesuaian')->insert($dataHeader);
        $id_penyesuaian = $this->db->insertID();

        $kode_akun3 = $this->request->getVar('kode_akun3');
        $debit      = $this->request->getVar('debit');
        $kredit     = $this->request->getVar('kredit');
        $id_status  = $this->request->getVar('id_status');

        if (!empty($kode_akun3)) {
            $dataNilai = [];
            foreach ($kode_akun3 as $i => $kode) {
                if (!empty($kode)) {
                    $dataNilai[] = [
                        'id_penyesuaian' => $id_penyesuaian,
                        'kode_akun3'     => $kode,
                        'debit'          => $debit[$i] ?? 0,
                        'kredit'         => $kredit[$i] ?? 0,
                        'id_status'      => $id_status[$i] ?? 5,
                        'created_at'     => date('Y-m-d H:i:s'),
                        'updated_at'     => date('Y-m-d H:i:s'),
                    ];
                }
            }
            if (!empty($dataNilai)) {
                $this->db->table('tbl_nilai_penyesuaian')->insertBatch($dataNilai);
            }
        }

        return redirect()->to(site_url('penyesuaian'))->with('success', 'Data Penyesuaian Berhasil Disimpan');
    }

    public function edit($id = null)
    {
        $penyesuaian = $this->objPenyesuaian->find($id);
        if (!$penyesuaian) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['penyesuaian'] = $penyesuaian;
        $data['dtnilai']     = $this->objNilaiPenyesuaian->where('id_penyesuaian', $id)->findAll();
        $data['dtakun3']     = $this->objAkun3->orderBy('kode_akun3', 'ASC')->findAll();
        $data['dtstatus']    = $this->objStatus->findAll();
        return view('penyesuaian/edit', $data);
    }

    public function update($id = null)
    {
        $dataHeader = [
            'tanggal'   => $this->request->getVar('tanggal'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'nilai'     => $this->request->getVar('nilai'),
            'waktu'     => $this->request->getVar('waktu'),
            'jumlah'    => $this->request->getVar('jumlah'),
        ];
        $this->db->table('tbl_penyesuaian')->where('id_penyesuaian', $id)->update($dataHeader);

        // Delete old details
        $this->db->table('tbl_nilai_penyesuaian')->where('id_penyesuaian', $id)->delete();

        // Insert new details
        $kode_akun3 = $this->request->getVar('kode_akun3');
        $debit      = $this->request->getVar('debit');
        $kredit     = $this->request->getVar('kredit');
        $id_status  = $this->request->getVar('id_status');

        if (!empty($kode_akun3)) {
            $dataNilai = [];
            foreach ($kode_akun3 as $i => $kode) {
                if (!empty($kode)) {
                    $dataNilai[] = [
                        'id_penyesuaian' => $id,
                        'kode_akun3'     => $kode,
                        'debit'          => $debit[$i] ?? 0,
                        'kredit'         => $kredit[$i] ?? 0,
                        'id_status'      => $id_status[$i] ?? 5,
                        'created_at'     => date('Y-m-d H:i:s'),
                        'updated_at'     => date('Y-m-d H:i:s'),
                    ];
                }
            }
            if (!empty($dataNilai)) {
                $this->db->table('tbl_nilai_penyesuaian')->insertBatch($dataNilai);
            }
        }

        return redirect()->to(site_url('penyesuaian'))->with('success', 'Data Penyesuaian Berhasil Diupdate');
    }

    public function delete($id = null)
    {
        $this->db->table('tbl_nilai_penyesuaian')->where('id_penyesuaian', $id)->delete();
        $this->db->table('tbl_penyesuaian')->where('id_penyesuaian', $id)->delete();
        return redirect()->to(site_url('penyesuaian'))->with('success', 'Data Penyesuaian Berhasil Dihapus');
    }
}
