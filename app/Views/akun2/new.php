<?= $this->extend('layout/backend') ?>
<?php /** @var array $dtakun1 */ ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <!-- <h1>Blank Page</h1> -->
        <a href="<?= site_url('akun2') ?>" class="btn btn-primary"> Back</a>
    </div>

    <div class="section-body">
        <!-- dinamis -->
        <div class="card">
            <div class="card-header">
                <h4>Add Account 2 Data</h4>
            </div>
            <div class="card-body p-5">
                <form action="<?= site_url('akun2') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>Account Code 1</label>
                        <select class="form-control" name="kode_akun1">
                            <?php foreach ($dtakun1 as $key => $value) : ?>
                                <option value="<?= $value->kode_akun1 ?>"><?= $value->nama_akun1 ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Account Code 2</label>
                        <input type="text" class="form-control" name="kode_akun2" placeholder="Account Code 2" required>
                    </div>
                    <div class="form-group">
                        <label>Account Name 2</label>
                        <input type="text" class="form-control" name="nama_akun2" placeholder="Account Name 2" required>
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