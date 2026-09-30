                        <li class="menu-header">Dashboard</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-layer-group"></i><span>Account Codes</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= site_url('akun1') ?>"><i class="fas fa-wallet"></i> <span>Account 1</span></a></li>
                                <li><a class="nav-link" href="<?= site_url('akun2') ?>"><i class="fas fa-coins"></i> <span>Account 2</span></a></li>
                                <li><a class="nav-link" href="<?= site_url('akun3') ?>"><i class="fas fa-calculator"></i> <span>Account 3</span></a></li>
                            </ul>
                        </li>
                        <li class="menu-header">Activities</li>
                        <li class="#"><a class="nav-link" href="<?= site_url('jurnalumum') ?>"><i class="fas fa-book"></i> <span>General Journal</span></a></li>
                        <li class="#"><a class="nav-link" href="<?= site_url('posting') ?>"><i class="fas fa-exchange-alt"></i> <span>Ledger Posting</span></a></li>
                        <li class="#"><a class="nav-link" href="<?= site_url('neracasaldo') ?>"><i class="fas fa-clipboard-check"></i> <span>Trial Balance</span></a></li>
                        <li class="#"><a class="nav-link" href="<?= site_url('neracalajur') ?>"><i class="fas fa-table"></i> <span>Worksheet (10-Col)</span></a></li>


                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-invoice"></i> <span>Transactions</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= site_url('transaksi') ?>"><i class="fas fa-receipt"></i> <span>Journal Entries</span></a></li>
                                <li><a class="nav-link" href="<?= site_url('penyesuaian') ?>"><i class="fas fa-sliders-h"></i> <span>Adjusting Entries</span></a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-chart-pie"></i> <span>Financial Reports</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= site_url('labarugi') ?>"><i class="fas fa-chart-line"></i> <span>Income Statement</span></a></li>
                                <li><a class="nav-link" href="<?= site_url('laporan/perubahan-modal') ?>"><i class="fas fa-landmark"></i> <span>Owner's Equity</span></a></li>
                                <li><a class="nav-link" href="<?= site_url('laporan/neraca') ?>"><i class="fas fa-balance-scale"></i> <span>Balance Sheet</span></a></li>
                                <li><a class="nav-link" href="<?= site_url('laporan/arus-kas') ?>"><i class="fas fa-money-bill-wave"></i> <span>Cash Flow</span></a></li>
                            </ul>
                        </li>

                        <li class="menu-header">Settings</li>
                        <li class="#"><a class="nav-link" href="<?= site_url('about') ?>"><i class="fas fa-satellite-dish"></i> <span>System Dossier</span></a></li>
                        <li class="#"><a class="nav-link" href="<?= site_url('admin') ?>"><i class="fas fa-user-shield"></i> <span>User Management</span></a></li>