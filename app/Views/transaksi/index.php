<?= $this->extend('layout/backend') ?>
<?php /** @var array $dttransaksi */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Transaction Data</title>

<section class="section">
    <div class="section-header">
        <a href="<?= site_url('transaksi/new') ?>" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Add New Transaction</a>
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
                <h4>Transaction Data</h4>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-md" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Receipt No</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Journal Note</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dttransaksi as $key => $values) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><span class="badge badge-light font-weight-bold"><?= $values->kwitansi ?></span></td>
                                    <td><?= date('d/m/Y', strtotime($values->tanggal)) ?></td>
                                    <td><?= $values->deskripsi ?></td>
                                    <td><?= $values->ketjurnal ?></td>
                                    <td class="text-center" style="width:20%">
                                        <a href="<?= site_url('transaksi/' . $values->id_transaksi) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                        <a href="<?= site_url('transaksi/edit/' . $values->id_transaksi) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        <form action="<?= site_url('transaksi/' . $values->id_transaksi) ?>" method="post" id="del-<?= $values->id_transaksi ?>" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-sm" data-confirm="Delete Transaction? | Are you sure...?" data-confirm-yes="hapus(<?= $values->id_transaksi ?>)"><i class="fas fa-trash"></i> Del</button>
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
