<?= $this->extend('layout/backend') ?>
<?php /** @var array $users */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; User Management</title>

<section class="section">
    <div class="section-header">
        <h1>User Management</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Application Users Directory</h4>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-md" id="mytable">
                        <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 25%">Username</th>
                                <th style="width: 30%">Email</th>
                                <th style="width: 20%">Role</th>
                                <th class="text-center" style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $i => $u) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <img alt="image" src="<?= base_url() ?>/template/assets/img/avatar/<?= $u->user_img ?? 'avatar-1.png' ?>" class="rounded-circle mr-2" width="30">
                                        <?= $u->username ?>
                                    </td>
                                    <td><?= $u->email ?></td>
                                    <td>
                                        <?php if ($u->role == 'admin') : ?>
                                            <span class="badge badge-danger">Administrator</span>
                                        <?php else : ?>
                                            <span class="badge badge-success">User</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= site_url('admin/' . $u->userid) ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
