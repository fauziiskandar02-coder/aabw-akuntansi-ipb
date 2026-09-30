<?php

namespace App\Controllers;

use App\Models\ModelAkun3;
use CodeIgniter\RESTful\ResourceController;

class Akun3 extends ResourceController
{
    protected ModelAkun3 $objAkun3;
    /** @var \CodeIgniter\Database\BaseConnection */
    protected $db;

    public function __construct()
    {
        $this->objAkun3 = new ModelAkun3();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data['dtakun3'] = $this->objAkun3->ambilrelasi();
        return view('akun3/index', $data);
    }

    public function show($id = null)
    {
        //
    }

    public function new()
    {
        $data['dtakun1'] = $this->db->table('akun1s')->get()->getResult();
        $data['dtakun2'] = $this->db->table('akun2s')->get()->getResult();
        return view('akun3/new', $data);
    }

    public function create()
    {
        $data = [
            'kode_akun3' => $this->request->getVar('kode_akun3'),
            'nama_akun3' => $this->request->getVar('nama_akun3'),
            'kode_akun1' => $this->request->getVar('kode_akun1'),
            'kode_akun2' => $this->request->getVar('kode_akun2'),
        ];
        $this->db->table('akun3s')->insert($data);
        return redirect()->to(site_url('akun3'))->with('success', 'Data Berhasil di Simpan');
    }

    public function edit($id = null)
    {
        $akun3 = $this->objAkun3->find($id);
        if (is_object($akun3)) {
            $data['dtakun3'] = $akun3;
            $data['dtakun1'] = $this->db->table('akun1s')->get()->getResult();
            $data['dtakun2'] = $this->db->table('akun2s')->get()->getResult();
            return view('akun3/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id = null)
    {
        $data = [
            'kode_akun3' => $this->request->getVar('kode_akun3'),
            'nama_akun3' => $this->request->getVar('nama_akun3'),
            'kode_akun1' => $this->request->getVar('kode_akun1'),
            'kode_akun2' => $this->request->getVar('kode_akun2'),
        ];
        $this->db->table('akun3s')->where(['id_akun3' => $id])->update($data);
        return redirect()->to(site_url('akun3'))->with('success', 'Data Berhasil di Update');
    }

    public function delete($id = null)
    {
        $this->db->table('akun3s')->where(['id_akun3' => $id])->delete();
        return redirect()->to(site_url('akun3'))->with('success', 'Data Berhasil di Hapus');
    }
}
