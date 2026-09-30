<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/akun1', 'Akun1::index');
$routes->get('/akun1/new', 'Akun1::new');
$routes->get('akun1/edit/(:segment)', 'Akun1::edit/$1');
$routes->post('/akun1', 'Akun1::store');
$routes->put('/akun1/edit/(:any)', 'Akun1::update/$1');
$routes->delete('akun1/(:segment)', 'Akun1::destroy/$1');

$routes->get('/akun2', 'Akun2::index');
$routes->get('/akun2/new', 'Akun2::new');
$routes->get('akun2/edit/(:segment)', 'Akun2::edit/$1');
$routes->post('/akun2', 'Akun2::create');
$routes->put('akun2/(:num)', 'Akun2::update/$1');
$routes->delete('akun2/(:num)', 'Akun2::delete/$1');

$routes->get('/akun3', 'Akun3::index');
$routes->get('/akun3/new', 'Akun3::new');
$routes->get('akun3/edit/(:segment)', 'Akun3::edit/$1');
$routes->post('/akun3', 'Akun3::create');
$routes->put('akun3/(:num)', 'Akun3::update/$1');
$routes->delete('akun3/(:num)', 'Akun3::delete/$1');

$routes->get('transaksi/akun3', 'Transaksi::akun3');
$routes->get('transaksi/status', 'Transaksi::status');
$routes->get('transaksi', 'Transaksi::index');
$routes->get('transaksi/new', 'Transaksi::new');
$routes->get('transaksi/edit/(:num)', 'Transaksi::edit/$1');
$routes->get('transaksi/(:num)', 'Transaksi::show/$1');
$routes->post('transaksi', 'Transaksi::create');
$routes->put('transaksi/(:num)', 'Transaksi::update/$1');
$routes->delete('transaksi/(:num)', 'Transaksi::delete/$1');

$routes->get('penyesuaian', 'Penyesuaian::index');
$routes->get('penyesuaian/new', 'Penyesuaian::new');
$routes->get('penyesuaian/edit/(:num)', 'Penyesuaian::edit/$1');
$routes->get('penyesuaian/(:num)', 'Penyesuaian::show/$1');
$routes->post('penyesuaian', 'Penyesuaian::create');
$routes->put('penyesuaian/(:num)', 'Penyesuaian::update/$1');
$routes->delete('penyesuaian/(:num)', 'Penyesuaian::delete/$1');

$routes->match(['GET', 'POST'], 'jurnalumum', 'JurnalUmum::index');
$routes->post('jurnalumum/cetak', 'JurnalUmum::cetak');
$routes->get('jurnalumum/cetak', 'JurnalUmum::cetak');

$routes->match(['GET', 'POST'], 'posting', 'Posting::index');
$routes->post('posting/cetak', 'Posting::cetak');
$routes->get('posting/cetak', 'Posting::cetak');

$routes->match(['GET', 'POST'], 'neracasaldo', 'NeracaSaldo::index');
$routes->post('neracasaldo/cetak', 'NeracaSaldo::cetak');
$routes->get('neracasaldo/cetak', 'NeracaSaldo::cetak');

$routes->match(['GET', 'POST'], 'neracalajur', 'NeracaLajur::index');
$routes->post('neracalajur/cetak', 'NeracaLajur::cetak');
$routes->get('neracalajur/cetak', 'NeracaLajur::cetak');

// Laba Rugi
$routes->match(['GET', 'POST'], 'labarugi', 'LabaRugi::index');
$routes->post('labarugi/cetak', 'LabaRugi::cetak');
$routes->get('labarugi/cetak', 'LabaRugi::cetak');

// Laporan Keuangan (Perubahan Modal, Neraca, Arus Kas)
$routes->match(['GET', 'POST'], 'laporan/perubahan-modal', 'Laporan::perubahanModal');
$routes->match(['GET', 'POST'], 'laporan/neraca', 'Laporan::neraca');
$routes->match(['GET', 'POST'], 'laporan/arus-kas', 'Laporan::arusKas');

// Autentikasi User (Video 17)
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::attemptRegister');
$routes->get('logout', 'Auth::logout');

// Manajemen User (Video 18)
$routes->get('admin', 'Admin::index');
$routes->get('admin/(:num)', 'Admin::detail/$1');

// System Info & Academic Credits (SIA AKN SV-IPB)
$routes->get('about', 'Home::about');






