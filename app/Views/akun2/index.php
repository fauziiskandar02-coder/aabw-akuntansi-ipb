<?= $this->extend('layout/backend') ?>
<?php /** @var array $dtakun2 */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Account 2</title>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <a href="<?= site_url('akun2/new') ?>" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Add New Account 2</a>
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
                <h4>Account 2 Data</h4>
            </div>
            <div class="card-body p-5">
                <div class="table-responsive">
                    <table class="table table-striped table-md" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Account Code 2</th>
                                <th>Account Name 2</th>
                                <th>Account Name 1</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dtakun2 as $key => $values) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $values->kode_akun2 ?></td>
                                    <td><?= $values->nama_akun2 ?></td>
                                    <td><?= $values->nama_akun1 ?></td>
                                    <td class="text-center" style="width:15%">
                                        <a href="<?= site_url('akun2/edit/' . $values->id_akun2) ?>" class="btn btn-warning"><i class="fas fa-pencil-alt btn-small"></i> Edit</a>
                                        <!-- <a href="" class="btn btn-danger"><i class="fas fa-trash btn-small"></i>Delete</a> -->
                                        <form action="<?= site_url('akun2/' . $values->id_akun2) ?>" method="post" id="del-<?= $values->id_akun2 ?>" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-small" data-confirm="Hapus Data...? | Apakah Anda Yakin...?" data-confirm-yes="hapus(<?= $values->id_akun2 ?>)"><i class="fas fa-trash"></i> Del </button>

                                        </form>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
            </div>
            <!-- <div class="card-footer text-right">
                <nav class="d-inline-block">
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div> -->
        </div>
    </div>

</section>

<?= $this->endSection() ?>