<?= $this->extend('layout/backend') ?>
<?php /** @var array $dtakun3 */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Account 3</title>

<section class="section">
    <div class="section-header">
        <a href="<?= site_url('akun3/new') ?>" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Add New Account 3</a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                <?= session()->getFlashdata('error') ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Account 3 Data</h4>
            </div>
            <div class="card-body p-5">
                <div class="table-responsive">
                    <table class="table table-striped table-md" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Account Code 3</th>
                                <th>Account Name 3</th>
                                <th>Account Name 2</th>
                                <th>Account Name 1</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dtakun3 as $key => $values) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $values->kode_akun3 ?></td>
                                    <td><?= $values->nama_akun3 ?></td>
                                    <td><?= $values->nama_akun2 ?></td>
                                    <td><?= $values->nama_akun1 ?></td>
                                    <td class="text-center" style="width:15%">
                                        <a href="<?= site_url('akun3/edit/' . $values->id_akun3) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        <form action="<?= site_url('akun3/' . $values->id_akun3) ?>" method="post" id="del-<?= $values->id_akun3 ?>" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-sm" data-confirm="Hapus Data...? | Apakah Anda Yakin...?" data-confirm-yes="hapus(<?= $values->id_akun3 ?>)"><i class="fas fa-trash"></i> Del</button>
                                        </form>
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
