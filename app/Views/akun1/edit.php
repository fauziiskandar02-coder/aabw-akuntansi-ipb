<?= $this->extend('layout/backend') ?>
<?php /** @var array $dtakun1 */ ?>
<?php /** @var object $dtakun1 */ ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <!-- <h1>Blank Page</h1> -->
        <a href="<?= site_url('akun1') ?>" class="btn btn-primary"> Back</a>
    </div>

    <div class="section-body">
        <!-- dinamis -->
        <div class="card">
            <div class="card-header">
                <h4>Edit Data Akun 1</h4>
            </div>
            <div class="card-body p-5">
                <form action="<?= site_url('akun1/edit/' . $dtakun1->id_akun1) ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label>Kode Akun 1</label>
                        <input type="text" class="form-control" name="kode_akun1" placeholder="Kode Akun" required value="<?= $dtakun1->kode_akun1 ?>">
                    </div>
                    <div class="form-group">
                        <label>Nama Akun 1</label>
                        <input type="text" class="form-control" name="nama_akun1" placeholder="Nama Akun" required value="<?= $dtakun1->nama_akun1 ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Update</button>
                        <button type="reset" class="btn btn-secondary"> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>