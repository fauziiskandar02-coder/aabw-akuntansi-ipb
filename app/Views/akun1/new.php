<?= $this->extend('layout/backend') ?>
<?php /** @var array $dtakun1 */ ?>

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
                <h4>Add Account 1 Data</h4>
            </div>
            <div class="card-body p-5">
                <form action="<?= site_url('akun1') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>Account Code 1</label>
                        <input type="text" class="form-control" name="kode_akun1" placeholder="Account Code" required>
                    </div>
                    <div class="form-group">
                        <label>Account Name 1</label>
                        <input type="text" class="form-control" name="nama_akun1" placeholder="Account Name" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Save</button>
                        <button type="reset" class="btn btn-secondary"><i class="fas fa-undo"></i> Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>