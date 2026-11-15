<?= $this->extend('layout/backend') ?>
<?php /** @var array $users */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; User Management</title>

<section class="section">
    <div class="section-header">
        <h1>User Management</h1>
    </div>

    <div class="section-body">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    <?= session()->getFlashdata('success') ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    <?= session()->getFlashdata('error') ?>
                </div>
            </div>
        <?php endif; ?>

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
                                <th style="width: 15%">Role</th>
                                <th class="text-center" style="width: 25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $currentUid = function_exists('user_id') ? user_id() : (function_exists('user') ? user()->id : null);
                            foreach ($users as $i => $u) : 
                                $isSelf = ($currentUid && (int)$u->userid === (int)$currentUid);
                            ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <img alt="image" src="<?= base_url() ?>/template/assets/img/avatar/<?= $u->user_img ?? 'avatar-1.png' ?>" class="rounded-circle mr-2" width="30">
                                        <?= esc($u->username) ?>
                                    </td>
                                    <td><?= esc($u->email) ?></td>
                                    <td>
                                        <?php if ($u->role == 'admin') : ?>
                                            <span class="badge badge-danger">Administrator</span>
                                        <?php else : ?>
                                            <span class="badge badge-success">User</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= site_url('admin/' . $u->userid) ?>" class="btn btn-info btn-sm mr-1">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <?php if (!$isSelf) : ?>
                                            <form action="<?= site_url('admin/' . $u->userid) ?>" method="post" id="del-<?= $u->userid ?>" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="button" class="btn btn-danger btn-sm" data-confirm="Delete User?|Are you sure you want to delete user '<?= esc($u->username) ?>'?" data-confirm-yes="hapus(<?= $u->userid ?>)">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        <?php else : ?>
                                            <span class="badge badge-secondary px-2 py-1 small" title="Current Active Administrator"><i class="fas fa-user-check"></i> You</span>
                                        <?php endif; ?>
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
