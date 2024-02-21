<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <div class="card p-5 text-gray-900 mb-5">
        <div class="row">
            <div class="col-sm-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title font-weight-bold my-auto">Keranjang</h5>
                            <form action="/Cart/All" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-inline">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1" onchange="document.getElementById('hapus').disabled = !this.checked;">
                                        <label class="custom-control-label" for="customSwitch1" style="cursor: pointer;" onchange="document.getElementById('hapus').disabled = !this.checked;">Pilih Semua</label>
                                    </div>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" disabled name="hapus" id="hapus" class="btn btn-circle ml-4 text-danger" style="font-size: 1.2rem;" onclick="return confirm('anda yakin ingin menghapus semua yang ada di keranjang anda?');">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <ul class="list-unstyled overflow-auto mb-0" style="height: 35rem;">
                            <?php if ($cart2['jumlah'] >= $cart2['stok']) : ?>
                                <hr>
                                <div class="alert alert-danger" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                    </svg>
                                    <span class="ml-3 align-middle text-gray-900 font-weight-bold">Yaah, ada barang yang tidak bisa diproses.</span>
                                    <!-- <a href="#cantProses" class="font-weight-bold align-middle">Lihat</a> -->
                                </div>
                            <?php endif; ?>
                            <?php foreach ($keranjang as $k) : ?>
                                <hr>
                                <li class="media">
                                    <div class="custom-control custom-checkbox my-auto ml-1 mr-4">
                                        <input type="checkbox" class="custom-control-input" name="customCheck<?= $k['id']; ?>" id="customCheck<?= $k['id']; ?>" value="<?= $k['id']; ?>">
                                        <label class="custom-control-label" for="customCheck<?= $k['id']; ?>" style="cursor: pointer;"></label>
                                    </div>
                                    <img src="<?= base_url(); ?>/img/<?= $k['gambar']; ?>" class="mr-3 my-auto" width="64px">
                                    <div class="media-body">
                                        <a href="#" class="mt-0 mb-1 text-decoration-none text-gray-900 text-capitalize"><?= $k['nama']; ?></a>
                                        <p class="font-weight-bold mb-0"><?= "Rp" . number_format($k['harga'], 2, ',', '.'); ?></p>
                                        <div class="d-flex justify-content-between my-1">
                                            <button type="button" class="btn p-0 align-middle my-auto" style="font-size: 1.2rem;" data-toggle="modal" data-target="#exampleModal<?= $k['id']; ?>" data-whatever="@mdo">
                                                <i class="fas fa-edit"></i>
                                                <small class="my-auto">Tulis Rincian Pesanan</small>
                                            </button>
                                            <div class="form-inline">
                                                <form action="/Cart/<?= $k['id']; ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-circle align-middle my-auto mr-5" style="font-size: 1.2rem;" onclick="return confirm('apakah anda yakin?');">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <div class="small text-gray-900 form-group align-middle my-auto mx-3">
                                                    <div class="form-row">
                                                        <div class="form-group col-sm-1 align-middle my-auto">
                                                            <input type="text" disabled value="<?= $k['jumlah']; ?>" class="font-weight-bold form-control form-control-sm rounded-sm text-center my-auto" min="1" max="100" maxlength="3" size="2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($k['jumlah'] <= $k['stok']) : ?>
                                            <a href="/Shipment/<?= $k['id_produk']; ?>" class="btn btn-oren font-weight-bold rounded-sm py-1 px-5 ">Beli Sekarang</a>
                                        <?php else : ?>
                                            <button disabled class="btn btn-oren font-weight-bold rounded-sm py-1 px-5 ">Stok Kosong</button>
                                        <?php endif; ?>
                                    </div>
                                </li>

                                <!-- MODAL CATATAN CART ATAU KERANJANG -->
                                <div class="modal fade" id="exampleModal<?= $k['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content rounded text-gray-900">
                                            <div class="modal-header">
                                                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Rincian Pesanan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex align-items-center my-0">
                                                    <div class="mr-3">
                                                        <img src="<?= base_url(); ?>/img/<?= $k['gambar']; ?>" alt="..." class="img-thumbnail border-0" width="64px">
                                                    </div>
                                                    <div class="font-weight-bold">
                                                        <div class="font-weight-normal text-gray-900 text-capitalize"><?= $k['nama']; ?></div>
                                                        <div class="small my-1 text-gray-600">Ini Pilihan Tipe Produk (Jika Ada)</div>
                                                    </div>
                                                </div>
                                                <form class="mt-3" action="/Cart/<?= $k['id']; ?>" method="post">
                                                    <input type="hidden" name="id_keranjang" value="<?= $k['id']; ?>">
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-6 col-form-label my-auto">Jumlah Produk Pesanan</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" name="jumlah" id="jumlah" class="form-control rounded-sm my-3" value="<?= $k['jumlah']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="form-control rounded-sm" id="catatan" name="catatan" placeholder="Catatan Tambahan untuk Setiap Transaksi yang Dilakukan"><?= $k['catatan']; ?></textarea>
                                                        <small class="form-text text-muted">Pastikan tidak ada data pribadi, ya</small>
                                                    </div>
                                                    <button type="submit" class="btn btn-block btn-oren text-center rounded-sm font-weight-bold">Simpan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <a href="https://app.sandbox.midtrans.com/snap/v2/vtweb/" class="btn btn-oren font-weight-bold rounded-sm py-2 px-5">Beli</a> -->
                            <?php endforeach; ?>
                            <hr>
                            <!-- <div id="cantProses">
                                <div class="card-title d-flex justify-content-between mb-0">
                                    <p class="font-weight-bold mb-0">Tidak Bisa Diproses (2)</p>
                                    <a href="/Cart" class="text-decoration-none text-oren font-weight-bold mr-4 mb-0">Hapus Semua</a>
                                </div>
                                <hr>
                                <p class="card-title text-danger font-weight-bold">Stok Habis</p>
                                <ul class="list-unstyled mb-0 text-muted">
                                    <li class="media text-muted">
                                        <img src="<?= base_url(); ?>/img/<?= $k['gambar']; ?>" class="mr-3 my-auto" width="64px">
                                        <div class="media-body">
                                            <a href="#" class="mt-0 mb-1 h6 text-decoration-none text-muted">Wedding Basic Package</a>
                                            <p class="font-weight-bold mb-0">Rp300.000</p>
                                        </div>
                                        <button type="button" class="btn btn-circle align-middle my-auto mr-5" style="font-size: 1.2rem;">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </li>
                                    <div class="accordion mt-2" id="accordionExample">
                                        <div id="collapseOther" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <hr>
                                            <ul class="list-unstyled mb-0 text-muted">
                                                <li class="media text-muted">
                                                    <img src="<?= base_url(); ?>/img/<?= $k['gambar']; ?>" class="mr-3 my-auto" width="64px">
                                                    <div class="media-body">
                                                        <a href="#" class="mt-0 mb-1 h6 text-decoration-none text-muted">Wedding Basic Package</a>
                                                        <p class="font-weight-bold mb-0">Rp300.000</p>
                                                    </div>
                                                    <button type="button" class="btn btn-circle align-middle my-auto mr-5" style="font-size: 1.2rem;">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                        <div class="text-center" id="headingOne">
                                            <h2 class="mb-1 px-1">
                                                <input class="btn btn-block btn-link text-decoration-none text-gray-900" onclick="changeText()" id="eye" value="Tampilkan Semua" type="button" data-toggle="collapse" data-target="#collapseOther" aria-expanded="true" aria-controls="collapseOther">
                                            </h2>
                                        </div>
                                    </div>
                                </ul>
                            </div> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body text-center pb-0 align-middle">
                        <h5 class="font-weight-bold">
                            Alamat Pengiriman
                        </h5>
                    </div>
                    <hr>
                    <div class="card-body pt-0">
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
                                <div class="d-flex justify-content-between mb-1">
                                    <p class=" my-auto"><?= user()->noHP; ?></p>
                                    <a href="/change-profile" class="btn p-0 m-0 my-auto"><i class="fas fa-edit"></i> Edit</a>
                                </div>
                                <p class="text-gray-600 small">
                                    <?= user()->alamat; ?>
                                </p>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-body">
                                <b>Kurir Pilihan</b>
                                <br>
                                <small class="">Sicepat Reg</small>
                            </div>
                            <div class="form-group col-md-5">
                                <?php
                                $tgl1 = date('d');
                                $tgl2 = date('d', strtotime('+3 days', strtotime($tgl1)));
                                $tgl3 = date('d', strtotime('+5 days', strtotime($tgl2)));
                                ?>
                                <small class="">Estimasi tiba <?= $tgl2, ' - ', $tgl3, date(' M'); ?></small>
                            </div>
                        </li>
                    </div>
                </div>
                <!-- <div class="card mt-3">
                    <div class="card-body text-center pb-1 align-middle">
                        <button type="button" class="btn btn-outline-dark font-weight-bold py-3 rounded" data-toggle="modal" data-target="#modalPromo">
                            <i class="fas fa-percent align-middle mr-2"></i>Makin Hemat Pakai Promo <i class="fas fa-angle-right align-middle ml-2"></i>
                        </button>
                    </div>
                    <hr>
                    <div class="card-body pt-0">
                        <h5 class="card-title font-weight-bold">Ringkasan Belanja</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text m-0 p-0">Total Harga (2 Barang)</p>
                            <p class="card-text m-0 p-0">Rp600.000</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="card-text m-0 p-0">Diskon Barang</p>
                            <p class="card-text m-0 p-0">Rp0.000</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="card-text m-0 p-0">Ongkos Kirim</p>
                            <p class="card-text m-0 p-0">Rp12.000</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="card-text m-0 p-0">Biaya Lain-Lain</p>
                            <p class="card-text m-0 p-0">Rp1.000</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between my-2">
                            <h5 class="card-title font-weight-bold">Total Belanja</h5>
                            <h5 class="card-title font-weight-bold">Rp613.000</h5>
                        </div>
                        <a href="/Shipment/All" class="btn btn-block btn-oren font-weight-bold rounded-sm py-2">Beli Semua</a>
                        <button type="submit" name="beli" class="btn btn-block btn-oren font-weight-bold rounded-sm py-2">Beli (2)</button>
                    </div>
                </div> -->
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