<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; SIA AABW</title>

    <link rel="icon" type="image/jpeg" href="<?= base_url('template/assets/img/aabw_avatar.jpg') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/components.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/cyber_theme.css') ?>">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <h4>AKUNTANSI WEB (AABW)</h4>
                        </div>

                        <div class="card card-primary">
                            <div class="card-header"><h4>Login Pengguna</h4></div>

                            <div class="card-body">
                                <?php if (session()->getFlashdata('error')) : ?>
                                    <div class="alert alert-danger alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                            <?= session()->getFlashdata('error') ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (session()->getFlashdata('success')) : ?>
                                    <div class="alert alert-success alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                            <?= session()->getFlashdata('success') ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="<?= site_url('login') ?>">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="login">Username atau Email</label>
                                        <input id="login" type="text" class="form-control" name="login" tabindex="1" required autofocus placeholder="Masukkan username/email">
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required placeholder="Masukkan password">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            <i class="fas fa-sign-in-alt"></i> Login
                                        </button>
                                    </div>
                                </form>

                                <div class="text-center text-muted mt-3">
                                    Belum punya akun? <a href="<?= site_url('register') ?>">Daftar di sini</a>
                                </div>
                            </div>
                        </div>

                        <div class="simple-footer text-center">
                            Copyright &copy; 2026 Fauzi Iskandar &mdash; SIA SV-IPB
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('template/assets/js/scripts.js') ?>"></script>
</body>
</html>
