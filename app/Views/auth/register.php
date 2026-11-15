<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; SIA AABW</title>

    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico?v=2.3.9') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('favicon.png?v=2.3.9') ?>">
    <link rel="shortcut icon" href="<?= base_url('favicon.ico?v=2.3.9') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/components.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/assets/css/cyber_theme.css?v=2.3.9') ?>">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                        <div class="login-brand">
                            <h4>AKUNTANSI WEB (AABW)</h4>
                        </div>

                        <div class="card card-primary">
                            <div class="card-header"><h4>New User Registration</h4></div>

                            <div class="card-body">
                                <?php if (session()->getFlashdata('error')) : ?>
                                    <div class="alert alert-danger alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                            <?= session()->getFlashdata('error') ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="<?= site_url('register') ?>">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="fullname">Full Name</label>
                                        <input id="fullname" type="text" class="form-control" name="fullname" required autofocus placeholder="Your full name">
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="username">Username</label>
                                            <input id="username" type="text" class="form-control" name="username" required placeholder="Unique username">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" class="form-control" name="email" required placeholder="email@example.com">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" required placeholder="Min. 6 characters">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="pass_confirm" class="d-block">Confirm Password</label>
                                            <input id="pass_confirm" type="password" class="form-control" name="pass_confirm" required placeholder="Repeat password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            <i class="fas fa-user-plus"></i> Register
                                        </button>
                                    </div>
                                </form>

                                <div class="text-center text-muted mt-3">
                                    Already have an account? <a href="<?= site_url('login') ?>">Sign in here</a>
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
