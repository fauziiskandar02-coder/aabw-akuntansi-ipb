<?php

namespace App\Controllers;

use App\Models\ModelTransaksi;
use CodeIgniter\Controller;
use TCPDF;

class NeracaLajur extends Controller
{
    protected ModelTransaksi $objTransaksi;

    public function __construct()
    {
        $this->objTransaksi = new ModelTransaksi();
    }

    public function index()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal') ?? '';
        $tgl_akhir = $this->request->getVar('tgl_akhir') ?? '';

        $data['tgl_awal']  = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['dtlajur']   = $this->objTransaksi->getNeracaLajur($tgl_awal, $tgl_akhir);

        return view('neraca_lajur/index', $data);
    }

    public function cetak()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal') ?? '';
        $tgl_akhir = $this->request->getVar('tgl_akhir') ?? '';

        $data['tgl_awal']  = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['dtlajur']   = $this->objTransaksi->getNeracaLajur($tgl_awal, $tgl_akhir);

        $html = view('neraca_lajur/neraca_lajur_pdf', $data);

        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('SIA AABW');
        $pdf->SetAuthor('AABW Admin');
        $pdf->SetTitle('Laporan Neraca Lajur (10 Kolom)');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');
        $pdf->Output('Neraca_Lajur.pdf', 'I');
        exit;
    }
}
