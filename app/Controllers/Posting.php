<?php

namespace App\Controllers;

use App\Models\ModelTransaksi;
use App\Models\ModelAkun3;
use CodeIgniter\Controller;
use TCPDF;

class Posting extends Controller
{
    protected ModelTransaksi $objTransaksi;
    protected ModelAkun3 $objAkun3;

    public function __construct()
    {
        $this->objTransaksi = new ModelTransaksi();
        $this->objAkun3     = new ModelAkun3();
    }

    public function index()
    {
        $tgl_awal   = $this->request->getVar('tgl_awal') ?? '';
        $tgl_akhir  = $this->request->getVar('tgl_akhir') ?? '';
        $kode_akun3 = $this->request->getVar('kode_akun3') ?? '';

        $data['tgl_awal']   = $tgl_awal;
        $data['tgl_akhir']  = $tgl_akhir;
        $data['kode_akun3'] = $kode_akun3;
        $data['dtakun3']    = $this->objAkun3->orderBy('kode_akun3', 'ASC')->findAll();
        $data['dtposting']  = $this->objTransaksi->getPosting($tgl_awal, $tgl_akhir, $kode_akun3);

        return view('posting/index', $data);
    }

    public function cetak()
    {
        $tgl_awal   = $this->request->getVar('tgl_awal') ?? '';
        $tgl_akhir  = $this->request->getVar('tgl_akhir') ?? '';
        $kode_akun3 = $this->request->getVar('kode_akun3') ?? '';

        $data['tgl_awal']   = $tgl_awal;
        $data['tgl_akhir']  = $tgl_akhir;
        $data['kode_akun3'] = $kode_akun3;
        $data['dtposting']  = $this->objTransaksi->getPosting($tgl_awal, $tgl_akhir, $kode_akun3);

        $html = view('posting/posting_pdf', $data);

        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('SIA AABW');
        $pdf->SetAuthor('AABW Admin');
        $pdf->SetTitle('Laporan Posting Buku Besar');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');
        $pdf->Output('Posting_Buku_Besar.pdf', 'I');
        exit;
    }
}
