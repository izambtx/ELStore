<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <!-- Content Card -->
    <div class="card text-gray-900 shadow p-5">
        <div class="media">
            <img src="<?= base_url(); ?>/img/<?= $produk['gambar']; ?>" class="align-self-start mr-3 col-sm-5">
            <div class="media-body">
                <h5 class="mt-0 text-capitalize"><b><?= $produk['nama']; ?></b></h5>
                <div class="d-flex justify-content-around">
                    <p class="text-capitalize text-gray-600"><i class="fas fa-copyright"></i> <?= $produk['nama_supplier']; ?></p>
                    <p class="text-capitalize text-gray-600">&#x2022</p>
                    <p class="text-capitalize text-gray-600">Tersisa <?= $produk['stok']; ?></p>
                    <p class="text-capitalize text-gray-600">&#x2022</p>
                    <p class="text-capitalize text-gray-600">Terjual 8 rb+</p>
                </div>
                <h4>
                    <b><?= "Rp" . number_format($produk['harga'], 2, ',', '.'); ?></b>
                </h4>
                <div class="row my-4">
                    <div class="col-sm-8">
                        <form action="/List-Produk/Detail/keranjang/<?= $produk['id']; ?>" method="post">
                            <input type="hidden" name="id_produk" value="<?= $produk['id']; ?>">
                            <?php if (!empty($keranjang_produk['id_produk'])) : ?>
                                <input type="hidden" name="id_produk_keranjang" value="<?= $keranjang_produk['id_produk']; ?>">
                                <input type="hidden" name="keranjang_id" value="<?= $keranjang_produk['keranjang_id']; ?>">
                                <input type="hidden" name="jumlah_produk_keranjang" value="<?= $keranjang_produk['jumlah']; ?>">
                            <?php endif; ?>
                            <button type="submit" <?php if ($produk['stok'] <= 0) : ?>disabled<?php endif ?> class="btn btn-oren btn-block"><i class="fas fa-plus-circle"></i> Masukan Keranjang</button>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <?php if ($produk['stok'] <= 0) : ?>
                            <button type="button" class="btn btn-outline-dark btn-block" disabled>Beli Langsung</button>
                        <?php else : ?>
                            <a href="/Konfirmasi/<?= $produk['id']; ?>" class="btn btn-outline-dark btn-block">Beli Langsung</a>
                        <?php endif; ?>
                    </div>
                </div>
                <p class="text-oren mb-4">
                    <span class="border-bottom-oren px-3 py-2">Detail</span>
                </p>
                <p class="text-capitalize"><?= $produk['deskripsi']; ?></p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>