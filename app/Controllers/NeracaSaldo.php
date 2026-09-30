<?php

namespace App\Controllers;

use App\Models\ModelTransaksi;
use CodeIgniter\Controller;
use TCPDF;

class NeracaSaldo extends Controller
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
        $data['dtneraca']  = $this->objTransaksi->getNeracaSaldo($tgl_awal, $tgl_akhir);

        return view('neraca_saldo/index', $data);
    }

    public function cetak()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal') ?? '';
        $tgl_akhir = $this->request->getVar('tgl_akhir') ?? '';

        $data['tgl_awal']  = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['dtneraca']  = $this->objTransaksi->getNeracaSaldo($tgl_awal, $tgl_akhir);

        $html = view('neraca_saldo/neraca_saldo_pdf', $data);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('SIA AABW');
        $pdf->SetAuthor('AABW Admin');
        $pdf->SetTitle('Laporan Neraca Saldo');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');
        $pdf->Output('Neraca_Saldo.pdf', 'I');
        exit;
    }
}
