<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<?php
$harga = $produk['harga'];
$jumlah = $produk['jumlah'];
$ongkir = 15000;
$total_harga = $harga * $jumlah;
$total_belanja = $total_harga + $ongkir;

$jumlah_data_transaksi = $countTransaksi;
$id_transaksi = $jumlah_data_transaksi + 1;
?>

<div class="container-fluid justify-content-center">

    <div class="card p-5 text-gray-900">
        <div class="row">
            <div class="col-sm-7">
                <div class="overflow-auto card" style="height: 25rem;">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold my-auto">Checkout</h5>
                        <p class="font-weight-bold text-gray-900 mt-4">Alamat Pengiriman</p>
                        <hr>
                        <ul class="list-unstyled mb-0">
                            <li class="media">
                                <div class="media-body">
                                    <div class="mt-0 mb-1 text-decoration-none text-gray-900">
                                        <b>
                                            <?= user()->fullname; ?>
                                        </b>
                                        <span class="badge badge-success">
                                            Utama
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-0">
                                        <p><?= user()->noHP; ?></p>
                                        <!-- <a href="/change-profile" class="btn p-0 m-0"><i class="fas fa-edit"></i> Edit</a> -->
                                    </div>
                                    <p class="text-gray-600 small">
                                        <?= user()->alamat; ?>
                                    </p>
                                </div>
                                <div class="form-group col-md-4">
                                    <small class=""><b>Kurir Pilihan</b></small>
                                    <br>
                                    <small class="">Sicepat Reg</small>
                                    <br>
                                    <small class="">Estimasi tiba <?= date('d '), '- ', date('d '), date('M'); ?></small>
                                </div>
                            </li>
                            <hr>
                            <ul class="list-unstyled mb-0">
                                <li class="media">
                                    <img src="<?= base_url(); ?>/img/<?= $produk['gambar']; ?>" class="mr-3" width="64px">
                                    <div class="media-body">
                                        <h6 class="my-0 text-capitalize"><?= $produk['nama']; ?></h6>
                                        <small><?= $produk['jumlah']; ?> Barang</small>
                                        <p class="font-weight-bold mb-0"><?= "Rp" . number_format($harga, 2, ',', '.'); ?></p>
                                    </div>
                                </li>
                                <!-- <hr> -->
                                <!-- <li class="media">
                                    <div class="media-body">
                                        <div class="mt-0 mb-1 text-decoration-none text-gray-900">
                                            <b>
                                                Metode Pembayaran
                                            </b>
                                            <p class="pt-2">Virtual Account</p>
                                            <div class="card">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div class="custom-control custom-radio d-flex justify-content-between">
                                                            <div class="align-middle my-auto">
                                                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" style="cursor: pointer;">
                                                                <label class="custom-control-label" for="customRadio1" style="cursor: pointer;">BCA Virtual Account</label>
                                                            </div>
                                                            <img src="../img/bca.png" class="text-left img-fluid" width="64px">
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="custom-control custom-radio d-flex justify-content-between">
                                                            <div class="align-middle my-auto">
                                                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" style="cursor: pointer;">
                                                                <label class="custom-control-label" for="customRadio2" style="cursor: pointer;">MANDIRI Virtual Account</label>
                                                            </div>
                                                            <img src="../img/mandiri.png" class="text-left img-fluid" width="64px">
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="custom-control custom-radio d-flex justify-content-between">
                                                            <div class="align-middle my-auto">
                                                                <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input" style="cursor: pointer;">
                                                                <label class="custom-control-label" for="customRadio4" style="cursor: pointer;">BNI Virtual Account</label>
                                                            </div>
                                                            <img src="../img/bni.png" class="text-left img-fluid" width="64px">
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="custom-control custom-radio d-flex justify-content-between">
                                                            <div class="align-middle my-auto">
                                                                <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input" style="cursor: pointer;">
                                                                <label class="custom-control-label" for="customRadio5" style="cursor: pointer;">PERMATA Virtual Account</label>
                                                            </div>
                                                            <img src="../img/permata.png" class="text-left img-fluid" width="64px">
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="custom-control custom-radio d-flex justify-content-between">
                                                            <div class="align-middle my-auto">
                                                                <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" style="cursor: pointer;">
                                                                <label class="custom-control-label" for="customRadio3" style="cursor: pointer;">Bank Lainnya</label>
                                                            </div>
                                                            <img src="../img/lain.png" class="text-left img-fluid" width="50px">
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <br> -->
                                <!-- <div class="d-flex justify-content-between">
                                    <b class="my-auto">Subtotal</b>
                                    <div class="accordion" id="accordionExample">
                                        <div class="text-center" id="headingOne">
                                            <h2 class="mb-1 px-1 small">
                                                <button type="button" class="btn btn-sm" data-toggle="collapse" data-target="#collapseOther" aria-expanded="true" aria-controls="collapseOther">
                                                    <b class="text-gray-900 pr-2 align-middle my-auto">
                                                        Rp35.000
                                                    </b>
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseOther" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="d-flex justify-content-between small">
                                        <p class="my-0">Harga (1 Barang)</p>
                                        <b class="text-gray-900 pr-2 align-middle my-auto">
                                            Rp35.000
                                        </b>
                                    </div>
                                    <div class="d-flex justify-content-between small">
                                        <p class="my-0">Ongkos Kirim</p>
                                        <b class="text-gray-900 pr-2 align-middle my-auto">
                                            Rp35.000
                                        </b>
                                    </div>
                                    <br>
                                </div> -->
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-body text-center pb-1 align-middle">
                        <!-- <div class="btn btn-outline-dark font-weight-bold rounded-sm my-auto align-middle" data-toggle="modal" data-target="#modalPromo">
                            Promo Berhasil Ditambahkan <i class="fas fa-check-circle"></i>
                        </div> -->
                        <button type="button" class="btn btn-outline-dark font-weight-bold py-3 rounded" data-toggle="modal" data-target="#modalPromo">
                            <i class="fas fa-percent align-middle mr-2"></i>Makin Hemat Pakai Promo <i class="fas fa-angle-right align-middle ml-2"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="card-body pt-0">
                        <h5 class="card-title font-weight-bold">Ringkasan Belanja</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text m-0 p-0">Total Harga (<?= $jumlah; ?> Barang)</p>
                            <p class="card-text m-0 p-0"><?= "Rp" . number_format($total_harga, 0, ',', '.'); ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="card-text m-0 p-0">Diskon Barang</p>
                            <p class="card-text m-0 p-0">Rp0</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="card-text m-0 p-0">Biaya Ongkir dan Lain-Lain</p>
                            <p class="card-text m-0 p-0"><?= "Rp" . number_format($ongkir, 0, ',', '.'); ?></p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between my-2">
                            <h5 class="card-title font-weight-bold">Total Belanja</h5>
                            <h5 class="card-title font-weight-bold"><?= "Rp" . number_format($total_belanja, 2, ',', '.'); ?></h5>
                        </div>
                        <form action="" method="POST">
                            <input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
                            <input type="hidden" name="jumlah_barang" id="jumlah_barang" value="<?= $jumlah; ?>">
                            <input type="hidden" name="total_harga" id="total_harga" value="<?= $total_harga; ?>">
                            <input type="hidden" name="id_produk" id="id_produk" value="<?= $produk['id']; ?>">
                            <input type="hidden" name="harga_produk" id="harga_produk" value="<?= $harga; ?>">
                            <input type="hidden" name="id_keranjang" id="id_keranjang" value="<?= $produk['id']; ?>">
                            <!-- <a href="/Order" class="btn btn-block btn-oren font-weight-bold rounded-sm py-2">Pilih Metode Pembayaran</a> -->
                            <button type="submit" class="btn btn-block btn-oren font-weight-bold rounded-sm py-2">Pilih Metode Pembayaran</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var scroll = new SmoothScroll('a[href*="#"]');
</script>

<script>
    function changeText() {
        if (document.getElementById("eye").value === "Tampilkan Semua") {
            document.getElementById("eye").value = "Tampilkan Lebih Sedikit";
        } else {
            document.getElementById("eye").value = "Tampilkan Semua";
        }
    }
</script>

<?= $this->endSection(); ?>