<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center align-middle">

        <div class=" col-md-6">

            <div class="rounded-md o-hidden border-0 shadow-lg mb-5">
                <div class=" p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row-register">
                        <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                        <div class="col-lg-12">
                            <div class="px-5 pt-5 pb-3 my-4">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900 font-weight-bold">Create</h1>
                                    <hr class="my-2 mx-5">
                                    <small class="small font-weight-bold text-gray-900">Create Product / Makeup Services</small>
                                </div>

                                <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

                                <form class="user" action="<?= base_url() ?>/admin/save/products" method="post" enctype="multipart/form-data">
                                    <?= csrf_field() ?>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user rounded <?php if (session('validation.nama')) : ?>is-invalid<?php endif ?>" name="nama" id="nama" placeholder="Nama" autofocus>
                                        <div class="invalid-feedback">
                                            <?= session('validation.nama') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" onkeypress="return /[0-9]/i.test(event.key)" class="form-control form-control-user rounded <?php if (session('validation.harga')) : ?>is-invalid<?php endif ?>" name="harga" id="harga" placeholder="Harga">
                                        <div class="invalid-feedback">
                                            <?= session('validation.harga') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" onkeypress="return /[0-9]/i.test(event.key)" class="form-control form-control-user rounded <?php if (session('validation.stok')) : ?>is-invalid<?php endif ?>" name="stok" id="stok" placeholder="Jumlah Stok">
                                        <div class="invalid-feedback">
                                            <?= session('validation.stok') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user rounded <?php if (session('validation.deskripsi')) : ?>is-invalid<?php endif ?>" name="deskripsi" id="deskripsi" placeholder="Deskripsi">
                                        <div class="invalid-feedback">
                                            <?= session('validation.deskripsi') ?>
                                        </div>
                                    </div>
                                    <select class="custom-select rounded-sm mb-3" id="kategori" name="kategori">
                                        <option selected hidden>Kategori</option>
                                        <?php foreach ($kategori as $k) : ?>
                                            <option value="<?= $k['id'];  ?>" <?= old('kategori') == $k['id'] ? 'selected' : '' ?>><?= $k['nama_kategori'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <select class="custom-select rounded-sm" id="supplier" name="supplier">
                                        <option selected hidden>Supplier</option>
                                        <?php foreach ($supplier as $s) : ?>
                                            <option value="<?= $s['id'];  ?>" <?= old('supplier') == $s['id'] ? 'selected' : '' ?>><?= $s['nama_supplier'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="row my-3">
                                        <div class="col-sm-3">
                                            <img src="<?= base_url(); ?>/img/default.jpg" class="img-thumbnail p-0" id="img-preview" alt="" srcset="">
                                        </div>
                                        <div class="col-sm-9 custom-file rounded-sm my-auto">
                                            <input type="file" accept="image/*" onchange="preview_gambar()" class="custom-file-input <?php if (session('validation.gambar')) : ?>is-invalid<?php endif ?>" id="gambar" name="gambar">
                                            <div class="invalid-feedback">
                                                <?= session('validation.gambar') ?>
                                            </div>
                                            <label class="custom-file-label" for="gambar" id="label_gambar">Pilih Gambar</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="font-weight-bold btn btn-success btn-user btn-block">
                                        Save
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>