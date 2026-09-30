<?= $this->extend('layout/backend') ?>
<?php /** @var array $dtpenyesuaian */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Adjusting Entries</title>

<section class="section">
    <div class="section-header">
        <a href="<?= site_url('penyesuaian/new') ?>" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Add Adjusting Entry</a>
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
                <h4>Adjusting Entries Data</h4>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-md" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th class="text-right">Value</th>
                                <th class="text-center">Period (Months)</th>
                                <th class="text-right">Adjusted Amount</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dtpenyesuaian as $key => $values) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= date('d/m/Y', strtotime($values->tanggal)) ?></td>
                                    <td><?= $values->deskripsi ?></td>
                                    <td class="text-right">Rp <?= number_format($values->nilai, 0, ',', '.') ?></td>
                                    <td class="text-center"><?= $values->waktu ?></td>
                                    <td class="text-right font-weight-bold">Rp <?= number_format($values->jumlah, 0, ',', '.') ?></td>
                                    <td class="text-center" style="width:20%">
                                        <a href="<?= site_url('penyesuaian/' . $values->id_penyesuaian) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                        <a href="<?= site_url('penyesuaian/edit/' . $values->id_penyesuaian) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        <form action="<?= site_url('penyesuaian/' . $values->id_penyesuaian) ?>" method="post" id="del-<?= $values->id_penyesuaian ?>" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-sm" data-confirm="Delete Adjusting Entry? | Are you sure...?" data-confirm-yes="hapus(<?= $values->id_penyesuaian ?>)"><i class="fas fa-trash"></i> Del</button>
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
