<?= $this->extend('layout/backend') ?>
<?php /** @var string $kwitansi */ ?>
<?php /** @var array $dtakun3 */ ?>
<?php /** @var array $dtstatus */ ?>

<?= $this->section('content') ?>
<title>SIA-IPB &mdash; Input Transaksi</title>

<section class="section">
    <div class="section-header">
        <a href="<?= site_url('transaksi') ?>" class="btn btn-primary"> Back</a>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Input Data Transaksi</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= site_url('transaksi') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>No. Kwitansi</label>
                                <input type="text" class="form-control" name="kwitansi" value="<?= $kwitansi ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tanggal Transaksi</label>
                                <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Keterangan Jurnal</label>
                                <input type="text" class="form-control" name="ketjurnal" placeholder="Keterangan Jurnal" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi Transaksi" required>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-md" id="tableLoop">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="width: 5%">No</th>
                                    <th style="width: 35%">Kode Akun</th>
                                    <th style="width: 20%">Debit</th>
                                    <th style="width: 20%">Kredit</th>
                                    <th style="width: 15%">Status</th>
                                    <th class="text-center" style="width: 5%">
                                        <button type="button" class="btn btn-primary btn-sm" id="BarisBaru"><i class="fas fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Baris 1: Default Debit -->
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>
                                        <select class="form-control select2-akun" name="kode_akun3[]" required>
                                            <option value="">-- Pilih Akun --</option>
                                            <?php foreach ($dtakun3 as $akun) : ?>
                                                <option value="<?= $akun->kode_akun3 ?>"><?= $akun->kode_akun3 ?> - <?= $akun->nama_akun3 ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="number" step="any" class="form-control debit" name="debit[]" value="0" required></td>
                                    <td><input type="number" step="any" class="form-control kredit" name="kredit[]" value="0" required></td>
                                    <td>
                                        <select class="form-control select2-status" name="id_status[]" required>
                                            <option value="">-- Status --</option>
                                            <?php foreach ($dtstatus as $st) : ?>
                                                <option value="<?= $st->id_status ?>"><?= $st->status ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm" id="HapusBaris"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- Baris 2: Default Kredit -->
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>
                                        <select class="form-control select2-akun" name="kode_akun3[]" required>
                                            <option value="">-- Pilih Akun --</option>
                                            <?php foreach ($dtakun3 as $akun) : ?>
                                                <option value="<?= $akun->kode_akun3 ?>"><?= $akun->kode_akun3 ?> - <?= $akun->nama_akun3 ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="number" step="any" class="form-control debit" name="debit[]" value="0" required></td>
                                    <td><input type="number" step="any" class="form-control kredit" name="kredit[]" value="0" required></td>
                                    <td>
                                        <select class="form-control select2-status" name="id_status[]" required>
                                            <option value="">-- Status --</option>
                                            <?php foreach ($dtstatus as $st) : ?>
                                                <option value="<?= $st->id_status ?>"><?= $st->status ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm" id="HapusBaris"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-light font-weight-bold">
                                    <td colspan="2" class="text-right">Total:</td>
                                    <td id="totalDebit">0</td>
                                    <td id="totalKredit">0</td>
                                    <td colspan="2" id="balanceStatus" class="text-center">
                                        <span class="badge badge-secondary">Belum Terisi</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success" id="btnSubmit"><i class="fas fa-paper-plane"></i> Save</button>
                        <button type="reset" class="btn btn-secondary"> Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
