<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; SIA AABW</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico?v=2.3.9') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('favicon.png?v=2.3.9') ?>">
    <link rel="shortcut icon" href="<?= base_url('favicon.ico?v=2.3.9') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('favicon.png?v=2.3.9') ?>">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">

    <!-- Theme Styles -->
    <link rel="stylesheet" href="<?= base_url('template/assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/components.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/cyber_theme.css?v=2.3.9') ?>">

    <style>
        body {
            background-color: var(--bg-deep, #050811);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }
        #app {
            width: 100%;
            position: relative;
            z-index: 1;
        }
        .register-hero-container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        .register-card-tech {
            background: rgba(10, 16, 32, 0.94) !important;
            border: 1px solid var(--border-tech, rgba(56, 189, 248, 0.3)) !important;
            box-shadow: 0 0 35px rgba(0, 240, 255, 0.15), var(--neo-shadow, 0 10px 30px rgba(0, 0, 0, 0.5)) !important;
            border-radius: 6px;
            position: relative;
            backdrop-filter: blur(12px);
        }
        .tech-feature-item {
            padding: 12px 16px;
            background: rgba(12, 22, 42, 0.7);
            border: 1px solid rgba(56, 189, 248, 0.22);
            border-radius: 4px;
            margin-bottom: 12px;
            transition: all 0.25s ease;
        }
        .tech-feature-item:hover {
            border-color: var(--cyan-bright, #00f0ff);
            background: rgba(14, 28, 54, 0.85);
            transform: translateX(4px);
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="register-hero-container">
            <div class="row align-items-center">
                <!-- Left Column: Visual Brand, System Info & Onboarding Deck -->
                <div class="col-lg-6 col-md-12 mb-4 mb-lg-0 pr-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">
                        <span class="tech-tag tech-tag-cyan" style="font-size: 11px;">
                            <span class="status-indicator mr-2"></span>SYS_REGISTRY // ENROLLMENT
                        </span>
                        <span class="tech-tag tech-tag-green ml-2" style="font-size: 11px;">
                            <i class="fas fa-user-shield mr-1"></i> RBAC ENABLED
                        </span>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center mr-3" style="width: 52px; height: 52px; border-radius: 8px; background: rgba(0, 240, 255, 0.1); border: 1.5px solid var(--cyan-bright); box-shadow: 0 0 15px rgba(0, 240, 255, 0.3);">
                            <i class="fas fa-atom fa-2x text-cyan"></i>
                        </div>
                        <div>
                            <h2 class="font-weight-bold text-white mb-0 cyber-glitch" data-text="SIA AKN SV-IPB" style="letter-spacing: -0.5px; font-size: 28px;">
                                SIA AKN <span style="color: var(--cyan-bright);">&bull; SV-IPB</span>
                            </h2>
                            <span class="text-muted font-monospace small" style="letter-spacing: 0.8px;">
                                OPERATOR ONBOARDING PROTOCOL &bull; AABW
                            </span>
                        </div>
                    </div>

                    <p class="text-sub mb-4" style="line-height: 1.7; font-size: 14.5px;">
                        Enroll as a new system operator. New accounts are granted secure access to ledger accounting,
                        financial matrix worksheet, transaction monitoring, and financial statement exports.
                    </p>

                    <!-- Credentials Guidelines -->
                    <div class="mb-4">
                        <div class="tech-feature-item d-flex align-items-center">
                            <i class="fas fa-id-card text-cyan fa-lg mr-3" style="width: 24px;"></i>
                            <div>
                                <div class="text-white font-weight-bold font-monospace small">Operator Identity</div>
                                <div class="text-muted small">Enter your legitimate full name and a unique system callsign / username.</div>
                            </div>
                        </div>
                        <div class="tech-feature-item d-flex align-items-center">
                            <i class="fas fa-lock text-cyan fa-lg mr-3" style="width: 24px;"></i>
                            <div>
                                <div class="text-white font-weight-bold font-monospace small">Cryptographic Password</div>
                                <div class="text-muted small">Minimum 6 characters protected with Bcrypt hashing and CSRF tokens.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Telemetry Deck Footer -->
                    <div class="d-flex align-items-center text-muted font-monospace small">
                        <span class="mr-3"><i class="fas fa-university text-cyan mr-1"></i> SEKOLAH VOKASI IPB</span>
                        <span><i class="fas fa-user-astronaut text-cyan mr-1"></i> PILOT: BAKPAUU (016)</span>
                    </div>
                </div>

                <!-- Right Column: Registration Terminal Card -->
                <div class="col-lg-6 col-md-12">
                    <div class="card register-card-tech">
                        <!-- Corner Accent Brackets -->
                        <span class="tech-corner tech-tl"></span>
                        <span class="tech-corner tech-tr"></span>
                        <span class="tech-corner tech-bl"></span>
                        <span class="tech-corner tech-br"></span>

                        <div class="card-header pb-2 pt-4 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid var(--border-subtle);">
                            <div>
                                <h4 class="text-white mb-0 font-monospace cyber-glitch" data-text="[REGISTRY // NEW OPERATOR]" style="font-size: 16px;">
                                    <i class="fas fa-user-plus mr-2 text-cyan"></i>[REGISTRY // NEW OPERATOR]
                                </h4>
                                <div class="text-muted font-monospace small mt-1" style="font-size: 11px;">
                                    Create credentials for new system operator
                                </div>
                            </div>
                            <span class="tech-tag tech-tag-cyan" style="font-size: 10px;">REG_V2</span>
                        </div>

                        <div class="card-body p-4">
                            <?php if (session()->getFlashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible show fade font-monospace small">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                        <i class="fas fa-exclamation-triangle mr-1"></i> <?= session()->getFlashdata('error') ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="<?= site_url('register') ?>">
                                <?= csrf_field() ?>
                                <div class="form-group mb-3">
                                    <label for="fullname" class="text-cyan font-monospace small font-weight-bold">
                                        <i class="fas fa-user mr-1"></i> FULL NAME
                                    </label>
                                    <input id="fullname" type="text" class="form-control font-monospace" name="fullname" required autofocus placeholder="Your full name" style="background: rgba(6, 10, 20, 0.85); border-color: rgba(56, 189, 248, 0.3); color: #fff;">
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="username" class="text-cyan font-monospace small font-weight-bold">
                                            <i class="fas fa-id-badge mr-1"></i> USERNAME
                                        </label>
                                        <input id="username" type="text" class="form-control font-monospace" name="username" required placeholder="callsign" style="background: rgba(6, 10, 20, 0.85); border-color: rgba(56, 189, 248, 0.3); color: #fff;">
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="email" class="text-cyan font-monospace small font-weight-bold">
                                            <i class="fas fa-envelope mr-1"></i> EMAIL
                                        </label>
                                        <input id="email" type="email" class="form-control font-monospace" name="email" required placeholder="email@example.com" style="background: rgba(6, 10, 20, 0.85); border-color: rgba(56, 189, 248, 0.3); color: #fff;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="password" class="text-cyan font-monospace small font-weight-bold">
                                            <i class="fas fa-lock mr-1"></i> PASSWORD
                                        </label>
                                        <input id="password" type="password" class="form-control font-monospace" name="password" required placeholder="Min. 6 chars" style="background: rgba(6, 10, 20, 0.85); border-color: rgba(56, 189, 248, 0.3); color: #fff;">
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="pass_confirm" class="text-cyan font-monospace small font-weight-bold">
                                            <i class="fas fa-shield-alt mr-1"></i> CONFIRM
                                        </label>
                                        <input id="pass_confirm" type="password" class="form-control font-monospace" name="pass_confirm" required placeholder="Repeat password" style="background: rgba(6, 10, 20, 0.85); border-color: rgba(56, 189, 248, 0.3); color: #fff;">
                                    </div>
                                </div>

                                <div class="form-group mb-3 mt-2">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block font-monospace font-weight-bold" style="letter-spacing: 1px; font-size: 13px;">
                                        <i class="fas fa-user-plus mr-2"></i> COMPLETE REGISTRATION
                                    </button>
                                </div>
                            </form>

                            <div class="text-center font-monospace small mt-3 pt-2" style="border-top: 1px solid var(--border-subtle);">
                                <span class="text-muted">Already registered as an operator?</span><br>
                                <a href="<?= site_url('login') ?>" class="text-cyan font-weight-bold">
                                    <i class="fas fa-sign-in-alt mr-1"></i> Sign In to Existing Terminal
                                </a>
                            </div>
                        </div>

                        <div class="card-footer py-2 text-center font-monospace text-muted small" style="background: rgba(6, 10, 20, 0.6); border-top: 1px solid var(--border-subtle); font-size: 11px;">
                            Copyright &copy; 2026 Fauzi Iskandar &mdash; SIA SV-IPB
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('template/assets/js/scripts.js') ?>"></script>
    <!-- Dynamic Animated Background & Audio-Visual Engine -->
    <script defer src="<?= base_url('template/assets/js/cyber_bg.js?v=2.3.9') ?>"></script>
</body>
</html>
