<?php
$currUri = uri_string();
$uriSegments = explode('/', trim($currUri, '/'));
$seg1 = $uriSegments[0] ?? '';
$seg2 = $uriSegments[1] ?? '';

$isAkun = in_array($seg1, ['akun1', 'akun2', 'akun3']);
$isTrans = in_array($seg1, ['transaksi', 'penyesuaian']);
$isLap = ($seg1 == 'labarugi' || ($seg1 == 'laporan' && in_array($seg2, ['perubahan-modal', 'neraca', 'arus-kas'])));
?>

<li class="menu-header">Dashboard</li>
<li class="nav-item dropdown <?= $isAkun ? 'active' : '' ?>">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-layer-group"></i><span>Account Codes</span></a>
    <ul class="dropdown-menu" <?= $isAkun ? 'style="display: block;"' : '' ?>>
        <li class="<?= $seg1 == 'akun1' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('akun1') ?>"><i class="fas fa-wallet"></i> <span>Account 1</span></a></li>
        <li class="<?= $seg1 == 'akun2' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('akun2') ?>"><i class="fas fa-coins"></i> <span>Account 2</span></a></li>
        <li class="<?= $seg1 == 'akun3' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('akun3') ?>"><i class="fas fa-calculator"></i> <span>Account 3</span></a></li>
    </ul>
</li>
<li class="menu-header">Activities</li>
<li class="<?= $seg1 == 'jurnalumum' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('jurnalumum') ?>"><i class="fas fa-book"></i> <span>General Journal</span></a></li>
<li class="<?= $seg1 == 'posting' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('posting') ?>"><i class="fas fa-exchange-alt"></i> <span>Ledger Posting</span></a></li>
<li class="<?= $seg1 == 'neracasaldo' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('neracasaldo') ?>"><i class="fas fa-clipboard-check"></i> <span>Trial Balance</span></a></li>
<li class="<?= $seg1 == 'neracalajur' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('neracalajur') ?>"><i class="fas fa-table"></i> <span>Worksheet (10-Col)</span></a></li>

<li class="nav-item dropdown <?= $isTrans ? 'active' : '' ?>">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-invoice"></i> <span>Transactions</span></a>
    <ul class="dropdown-menu" <?= $isTrans ? 'style="display: block;"' : '' ?>>
        <li class="<?= $seg1 == 'transaksi' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('transaksi') ?>"><i class="fas fa-receipt"></i> <span>Journal Entries</span></a></li>
        <li class="<?= $seg1 == 'penyesuaian' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('penyesuaian') ?>"><i class="fas fa-sliders-h"></i> <span>Adjusting Entries</span></a></li>
    </ul>
</li>
<li class="nav-item dropdown <?= $isLap ? 'active' : '' ?>">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-chart-pie"></i> <span>Financial Reports</span></a>
    <ul class="dropdown-menu" <?= $isLap ? 'style="display: block;"' : '' ?>>
        <li class="<?= $seg1 == 'labarugi' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('labarugi') ?>"><i class="fas fa-chart-line"></i> <span>Income Statement</span></a></li>
        <li class="<?= ($seg1 == 'laporan' && $seg2 == 'perubahan-modal') ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('laporan/perubahan-modal') ?>"><i class="fas fa-landmark"></i> <span>Owner's Equity</span></a></li>
        <li class="<?= ($seg1 == 'laporan' && $seg2 == 'neraca') ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('laporan/neraca') ?>"><i class="fas fa-balance-scale"></i> <span>Balance Sheet</span></a></li>
        <li class="<?= ($seg1 == 'laporan' && $seg2 == 'arus-kas') ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('laporan/arus-kas') ?>"><i class="fas fa-money-bill-wave"></i> <span>Cash Flow</span></a></li>
    </ul>
</li>

<li class="menu-header">Settings</li>
<li class="<?= $seg1 == 'about' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('about') ?>"><i class="fas fa-satellite-dish"></i> <span>System Dossier</span></a></li>
<li class="<?= $seg1 == 'admin' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('admin') ?>"><i class="fas fa-user-shield"></i> <span>User Management</span></a></li>
