<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <?= view('Myth\Auth\Views\_message_block') ?>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card text-gray-900 shadow">
                <div class="card-body">
                    <div class="text-center mt-3">
                        <h3 class="section-heading text-uppercase"><b><?= $title; ?></b></h3>
                        <h6 class="section-subheading text-capitalize">when do you want to experience our services</h6>
                    </div>
                    <form method="post" action="/Form-Update-Booking/<?= $booking['id']; ?>" enctype="multipart/form-data">
                        <?php csrf_field(); ?>

                        <div class="row">
                            <div class="col">
                                <input type="text" class="<?php if (session('validation.nama')) : ?>is-invalid<?php endif ?> form-control mt-4 rounded-sm" placeholder="Nama Lengkap" name="nama" id="nama" value="<?= $booking['atas_nama']; ?>">
                                <div class="invalid-feedback">
                                    <?= session('validation.nama') ?>
                                </div>

                                <select id="layanan1" name="layanan1" class="<?php if (session('validation.layanan1')) : ?>is-invalid<?php endif ?> form-control mt-4 rounded-sm">
                                    <option selected hidden>Pilih Pelayanan</option>
                                    <?php foreach ($layanan as $l) : ?>
                                        <option value="<?= $l['id'];  ?>" <?= $booking['id_layanan1'] == $l['id'] ? 'selected' : '' ?>><?= $l['nama_layanan'];  ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= session('validation.layanan1') ?>
                                </div>

                                <select id="layanan2" name="layanan2" class="<?php if (session('validation.layanan2')) : ?>is-invalid<?php endif ?> form-control mt-4 rounded-sm">
                                    <option selected hidden>Pilih Pelayanan 2 (Optional)</option>
                                    <?php foreach ($layanan as $l) : ?>
                                        <option value="<?= $l['id'];  ?>" <?= $booking['id_layanan2'] == $l['id'] ? 'selected' : '' ?>><?= $l['nama_layanan'];  ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= session('validation.layanan2') ?>
                                </div>
                            </div>
                            <div class="col">
                                <input type="datetime-local" class="<?php if (session('validation.tanggal')) : ?>is-invalid<?php endif ?> form-control mt-4 rounded-sm" id="tanggal" name="tanggal" value="<?= $booking['jadwal_booking']; ?>">
                                <div class="invalid-feedback">
                                    <?= session('validation.tanggal') ?>
                                </div>

                                <select id="petugas" name="petugas" class="<?php if (session('validation.petugas')) : ?>is-invalid<?php endif ?> form-control mt-4 rounded-sm">
                                    <option selected hidden>Pilih Petugas</option>
                                    <?php foreach ($petugas as $p) : ?>
                                        <option value="<?= $p['id'];  ?>" <?= $booking['id_petugas'] == $p['id'] ? 'selected' : '' ?>><?= $p['fullname'];  ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= session('validation.petugas') ?>
                                </div>

                                <select id="layanan3" name="layanan3" class="<?php if (session('validation.layanan3')) : ?>is-invalid<?php endif ?> form-control mt-4 rounded-sm">
                                    <option selected hidden>Pilih Pelayanan 3 (Optional)</option>
                                    <?php foreach ($layanan as $l) : ?>
                                        <option value="<?= $l['id'];  ?>" <?= $booking['id_layanan3'] == $l['id'] ? 'selected' : '' ?>><?= $l['nama_layanan'];  ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= session('validation.layanan3') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea class="form-control mt-4 rounded-sm" placeholder="Catatan Keperluan (Optional)" id="catatan" name="catatan"><?= $booking['catatan']; ?></textarea>
                                <div class="invalid-feedback">
                                    <?= session('validation.catatan') ?>
                                </div>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Tulis Penjelasan Detail Mengenai Apa Saja (Contoh : cat rambut warna merah)
                                </small>
                            </div>
                            <div class="col">
                                <textarea class="form-control mt-4 rounded-sm" placeholder="Catatan Keperluan (Optional)" id="alamat" name="alamat" disabled>Jl. Perumahan, Jl. Raya Pd. Ungu Permai Sektor 5 No.13, Bahagia, Kec. Babelan, Kabupaten Bekasi, Jawa Barat 17612</textarea>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Berikut Merupakan Alamat EL Salon Berada. <b><a href="https://maps.app.goo.gl/pjXc1VYvo2BwdFN38" target="_blank">Lihat di Gmaps</a></b>
                                </small>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-oren" type="submit">Submit form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>