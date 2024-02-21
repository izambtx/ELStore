<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>
<?php
$jumlah_data_transaksi = $countTransaksi;
$id_transaksi = $jumlah_data_transaksi + 1;
?>

<div class="container-fluid justify-content-center">

    <div class="card p-5 text-gray-900 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-10">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <h3 class="card-title text-uppercase font-weight-bold"><?= $title; ?></h3>
                            <h6 class="section-subheading text-capitalize">pilih metode pembayaran sebelum melakukan checkout</h6>
                        </div>
                        <form action="/Order/<?= $produk['id']; ?>" method="post">
                            <ul class="list-unstyled">
                                <input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
                                <input type="hidden" name="nama" value="<?= $produk['nama']; ?>">
                                <input type="hidden" name="harga_produk" value="<?= $produk['harga']; ?>">
                                <li class="media border p-3 rounded mb-3">
                                    <img src="<?= base_url(); ?>/img/<?= $produk['gambar']; ?>" width="150rem" class="mr-3" alt="...">
                                    <div class="media-body">
                                        <p class="mt-0 mb-1 font-weight-bold text-capitalize"><?= $produk['nama']; ?></p>
                                        <p class="my-0"><?= $produk['deskripsi']; ?></p>
                                        <h5 class="text-oren mt-1">
                                            <?= "Rp" . number_format($produk['harga'], 2, ',', '.'); ?>
                                        </h5>
                                        <p> + <?= "Rp" . number_format(15000, 2, ',', '.'); ?>
                                            <small>(Biaya Ongkir dan lain-lain)</small>
                                        </p>
                                    </div>
                                </li>
                                <?php if ($produk['id_kategori'] != 1) { ?>
                                    <div class="form-row mb-2">
                                        <div class="col-sm-12">
                                            <input type="datetime-local" name="tanggal_keperluan" id="tanggal_keperluan" class="form-control rounded-top" value="<?php if ($harga_produk) : ?><?= $tanggal_keperluan; ?><?php endif ?>" <?php if ($harga_produk) : ?>disabled<?php endif ?>>
                                            <small id="emailHelp" class="form-text text-muted ml-1">Tanggal Untuk Dilakukannya Jasa Makeup.</small>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <textarea class="form-control rounded-bottom" name="alamat" id="alamat" cols="30" rows="5" placeholder="Harap Isi dengan Alamat Lengkap Lokasi. Contoh : Alamat Rumah, Lokasi Acara, dan lain lain." <?php if ($harga_produk) : ?>disabled<?php endif ?>><?= user()->alamat; ?></textarea>
                                    </div>
                                    <div class="col-6">
                                        <textarea class="form-control rounded-bottom" name="catatan" id="catatan" cols="30" rows="5" placeholder="Harap Isi dengan Catatan Opsional" <?php if ($harga_produk) : ?>disabled<?php endif ?>><?php if ($harga_produk) : ?><?= $catatan; ?><?php endif ?></textarea>
                                    </div>
                                </div>
                            </ul>
                            <p class="py-3 mb-0"><i class="fas fa-info-circle px-1"></i> Pesanan akan diproses setelah pembayaran terkonfirmasi</p>
                            <?php if ($harga_produk) { ?>
                                <a href="https://app.sandbox.midtrans.com/snap/v2/vtweb/<?= $token; ?>" class="btn btn-oren btn-block py-2 rounded-sm">Pilih Metode Pembayaran</a>
                            <?php
                            } else {
                            ?>
                                <button type="submit" class="btn btn-success btn-block py-2 rounded-sm">Konfirmasi Pesanan</button>
                                <a href="/List-Rent-Services" class="btn btn-link btn-block text-gray-900">lanjutkan Belanja</a>
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>