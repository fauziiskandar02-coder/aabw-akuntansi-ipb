<?= $this->extend('layout/backend') ?>
<?php /** @var object $user */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Detail Pengguna</title>

<section class="section">
    <div class="section-header">
        <h1>User Detail</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Users</a></div>
            <div class="breadcrumb-item active"><?= $user->username ?></div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-7">
                <div class="card author-box card-primary">
                    <div class="card-body">
                        <div class="author-box-left">
                            <img alt="image" src="<?= base_url() ?>/template/assets/img/avatar/<?= $user->user_img ?? 'avatar-1.png' ?>" class="rounded-circle author-box-picture" width="100">
                            <div class="clearfix"></div>
                            <div class="mt-2 text-center">
                                <?php if ($user->role == 'admin') : ?>
                                    <span class="badge badge-danger">Admin</span>
                                <?php else : ?>
                                    <span class="badge badge-success">User</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="author-box-details">
                            <div class="author-box-name">
                                <a href="#"><?= $user->fullname ?? $user->username ?></a>
                            </div>
                            <div class="author-box-job text-muted mb-2">@<?= $user->username ?></div>

                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item px-0">
                                    <strong>Email:</strong> <?= $user->email ?>
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>Hak Akses:</strong> <?= ucfirst($user->role ?? 'user') ?>
                                </li>
                                <li class="list-group-item px-0">
                                    <strong>Status Akun:</strong> <span class="badge badge-primary">Aktif</span>
                                </li>
                            </ul>

                            <div class="w-100 float-right mt-2">
                                <a href="<?= site_url('admin') ?>" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar User
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
