<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="base-url" content="<?= site_url() ?>">

    <?= $this->renderSection('title') ?>


    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('template/node_modules/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/node_modules/@fortawesome/fontawesome-free/css/all.css') ?>">

    <!-- Google Fonts (Space Grotesk, JetBrains Mono, Plus Jakarta Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('template/assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/components.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/custom.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/cyber_theme.css?v=2.3.5') ?>">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        <div class="search-backdrop"></div>
                        <div class="search-result">
                            <div class="search-header">
                                Histories
                            </div>
                            <div class="search-item">
                                <a href="#">How to hack NASA using CSS</a>
                                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                            </div>
                            <div class="search-item">
                                <a href="#">Kodinger.com</a>
                                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                            </div>
                            <div class="search-item">
                                <a href="#">#Stisla</a>
                                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                            </div>
                            <div class="search-header">
                                Result
                            </div>
                            <div class="search-item">
                                <a href="#">
                                    <img class="mr-3 rounded" width="30" src="<?= base_url() ?>/template/assets/img/products/product-3-50.png" alt="product">
                                    oPhone S9 Limited Edition
                                </a>
                            </div>
                            <div class="search-item">
                                <a href="#">
                                    <img class="mr-3 rounded" width="30" src="<?= base_url() ?>/template/assets/img/products/product-2-50.png" alt="product">
                                    Drone X2 New Gen-7
                                </a>
                            </div>
                            <div class="search-item">
                                <a href="#">
                                    <img class="mr-3 rounded" width="30" src="<?= base_url() ?>/template/assets/img/products/product-1-50.png" alt="product">
                                    Headphone Blitz
                                </a>
                            </div>
                            <div class="search-header">
                                Projects
                            </div>
                            <div class="search-item">
                                <a href="#">
                                    <div class="search-icon bg-danger text-white mr-3">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    Stisla Admin Template
                                </a>
                            </div>
                            <div class="search-item">
                                <a href="#">
                                    <div class="search-icon bg-primary text-white mr-3">
                                        <i class="fas fa-laptop"></i>
                                    </div>
                                    Create a new Homepage Design
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Messages
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-message">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image" src="<?= base_url() ?>/template/assets/img/avatar/avatar-1.png" class="rounded-circle">
                                        <div class="is-online"></div>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b>
                                        <p>Hello, Bro!</p>
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image" src="<?= base_url() ?>/template/assets/img/avatar/avatar-2.png" class="rounded-circle">
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Dedik Sugiharto</b>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image" src="<?= base_url() ?>/template/assets/img/avatar/avatar-3.png" class="rounded-circle">
                                        <div class="is-online"></div>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Agung Ardiansyah</b>
                                        <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image" src="<?= base_url() ?>/template/assets/img/avatar/avatar-4.png" class="rounded-circle">
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Ardian Rahardiansyah</b>
                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                                        <div class="time">16 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image" src="<?= base_url() ?>/template/assets/img/avatar/avatar-5.png" class="rounded-circle">
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Alfa Zulkarnain</b>
                                        <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Template update is available now!
                                        <div class="time text-primary">2 Min Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Low disk space. Let's clean it!
                                        <div class="time">17 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Welcome to Stisla template!
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url() ?>/template/assets/img/avatar/<?= user()->user_img ?? 'avatar-1.png' ?>" class="rounded-circle mr-2" style="border: 2px solid var(--cyan-bright); box-shadow: 0 0 10px var(--cyan-glow);">
                            <div class="d-sm-none d-lg-inline-block font-monospace">
                                <span class="badge badge-primary px-2 py-1 mr-1" style="font-size: 10px; font-weight: 700; letter-spacing: 0.5px;">
                                    <span class="status-indicator"></span>OPERATOR
                                </span>
                                <span class="cyber-glitch font-weight-bold" data-text="Bakpauu" style="color: var(--cyan-bright); font-size: 13.5px;">Bakpauu</span> 
                                <span class="text-cyan small ml-1">// [PILOT: 016]</span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">[PILOT TERMINAL // Bakpauu]</div>
                            <a href="<?= site_url('admin/' . user()->id) ?>" class="dropdown-item has-icon">
                                <i class="fas fa-id-badge"></i> Operator Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= site_url('logout') ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-power-off"></i> Disconnect / Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="<?= site_url() ?>" class="d-flex align-items-center justify-content-center">
                            <span class="cyber-brand-logo mr-2">
                                <i class="fas fa-atom text-cyan"></i>
                            </span>
                            <span class="cyber-glitch" data-text="WEB ACCOUNTING">WEB ACCOUNTING</span>
                        </a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="<?= site_url() ?>" class="d-flex align-items-center justify-content-center">
                            <span class="cyber-brand-logo">
                                <i class="fas fa-atom text-cyan"></i>
                            </span>
                        </a>
                    </div>

                    <ul class="sidebar-menu">
                        <!-- ini untuk manggil menu -->
                        <?= $this->include("layout/menu") ?>
                    </ul>

                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <a href="<?= site_url('about') ?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
                            <i class="fas fa-rocket"></i> SIA AKN SV-IPB
                        </a>
                    </div>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('content') ?>
            </div>

            <footer class="main-footer">
                <div class="footer-left font-monospace">
                    SYSTEM &copy; 2026 <div class="bullet"></div> SIA AKN SV-IPB &bull; OPERATOR: <span class="cyber-glitch" data-text="Bakpauu" style="color: var(--cyan-bright); font-weight: 700;">Bakpauu</span> // [CODE: 016]
                </div>
                <div class="footer-right font-monospace">
                    NODE: [AABW-016] // SYSTEM: <span style="color: #10b981;">ONLINE</span> // VER: 2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- Hiro 3D Interactive Cyber-HUD Widget -->
    <div id="hiro-widget-container">
        <div id="hiro-speech-bubble" class="hiro-speech-bubble"></div>
        <div id="hiro-badge-hud" class="hiro-badge-hud" title="Click to interact with Hiro (Code: 016)">
            <div id="hiro-canvas-box" class="hiro-canvas-box"></div>
            <div class="hiro-info-hud">
                <div class="pilot-name">HIRO // CODE: 016</div>
                <div class="pilot-meta"><span class="status-indicator"></span>SYNC: 100% // READY</div>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url('template/node_modules/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('template/node_modules/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('template/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('template/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('template/node_modules/nicescroll/dist/jquery.nicescroll.min.js') ?>"></script>

    <script src="<?= base_url('template/assets/js/stisla.js') ?>"></script>

    <!-- Three.js 3D Engine, fflate, FBXLoader, MeshoptDecoder & GLTFLoader -->
    <script src="<?= base_url('template/assets/js/three.min.js') ?>"></script>
    <script src="<?= base_url('template/assets/js/fflate.min.js?v=2.3.5') ?>"></script>
    <script src="<?= base_url('template/assets/js/FBXLoader.js?v=2.3.5') ?>"></script>
    <script src="<?= base_url('template/assets/js/meshopt_decoder.js?v=2.3.5') ?>"></script>
    <script src="<?= base_url('template/assets/js/GLTFLoader.js?v=2.3.5') ?>"></script>
    <script src="<?= base_url('template/assets/js/hiro_3d.js?v=2.3.5') ?>"></script>

    <!-- Dynamic Moving Background & Diamond Shutter Page Transition -->
    <script src="<?= base_url('template/assets/js/cyber_bg.js') ?>"></script>
    <script src="<?= base_url() ?>/template/assets/js/cyber_transition.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/template/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>