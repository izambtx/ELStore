<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <?= view('Myth\Auth\Views\_message_block') ?>

    <?php

    $id = $transaksi['id_transaksi'];
    $token_db = $transaksi['token'];
    $token = base64_encode("SB-Mid-server-HrJZLgI6Ak4AUG2NOamr2BlK:");
    // echo $id;
    $url = "https://api.sandbox.midtrans.com/v2/" . $id . "/status";
    $header = array(
        'Accept: application/json',
        'Authorization: Basic ' . $token,
        'Content-Type: application/json'
    );
    $method = 'GET';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_POSTFIELDS, false);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $hasil = json_decode($result, true);

    ?>

    <!-- Content Card -->
    <div class="card shadow p-3" id="contentTransaksi">
        <div class="card-body text-gray-900">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-8">
                    <h5 class="card-title font-weight-bold py-2"><?= $title; ?></h5>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p class="card-text font-weight-bold text-gray-600">Status</p>
                        <?php if ($hasil['status_code'] == '404') : ?>
                            <h5><span class="badge badge-secondary font-weight-bold my-auto">PENDING</span></h5>
                        <?php elseif ($hasil['status_code'] == 200) : ?>
                            <?php if (empty($transaksi['status'])) : ?>
                                <h5><span class="badge badge-info font-weight-bold my-auto">PAYED</span></h5>
                            <?php else : ?>
                                <h5><span class="badge badge-primary font-weight-bold my-auto"><?= $transaksi['status']; ?></span></h5>
                            <?php endif; ?>
                        <?php elseif ($hasil['status_code'] == 201) : ?>
                            <h5><span class="badge badge-warning font-weight-bold my-auto">CANCELED</span></h5>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="card-text font-weight-bold text-gray-600">No. Invoice</p>
                        <p class="text-oren font-weight-bold"><?= $transaksi['id_transaksi']; ?></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="card-text font-weight-bold text-gray-600">Tanggal Pembelian</p>
                        <p class=""><?= $transaksi['created_at']; ?></p>
                    </div>
                    <?php if ($transaksi['id_kategori'] == 1) : ?>
                        <div class="d-flex justify-content-between">
                            <p class="card-text font-weight-bold text-gray-600">No. Resi Pengiriman Sicepat</p>
                            <p class="font-weight-bold"><?= $transaksi['noResi']; ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="card-text font-weight-bold text-gray-600">Waktu Submit Pengiriman</p>
                            <p><?= $transaksi['waktu_submit_resi']; ?></p>
                        </div>
                    <?php endif; ?>
                    <hr>
                    <a <?php if ($transaksi['id_kategori'] == 1) : ?> href="/List-Produk/Detail/<?= $transaksi['id_produk']; ?>" <?php else : ?> href="/List-Rent-Services" <?php endif ?> class="text-decoration-none text-gray-900">
                        <div class="media border rounded p-3">
                            <img src="<?= base_url(); ?>/img/<?= $transaksi['gambar']; ?>" class="mr-3" width="100rem">
                            <div class="media-body">
                                <h5 class="mt-0 ml-1 text-capitalize font-weight-bold"><?= $transaksi['nama']; ?></h5>
                                <p class="text-gray-600 m-1"><?= $transaksi['jumlah_barang']; ?> x <?= "Rp" . number_format($transaksi['harga'], 2, ',', '.'); ?></p>
                                <div class="d-flex justify-content-end">
                                    <p class="m-1 my-auto">Total Harga : </p>
                                    <h5 class="ml-1 my-auto"><b><?= "Rp" . number_format($transaksi['harga'], 2, ',', '.'); ?></b></h5>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php if ($hasil['status_code'] == '404' || $hasil['status_code'] == '201') : ?>
                    <?php elseif ($hasil['status_code'] == '200') : ?>
                        <?php if (empty($transaksi['status'])) : ?>
                            <form action="<?= base_url(); ?>/Admin-Check-Transaksi/<?= $transaksi['id_transaksi']; ?>" method="POST">
                                <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>">
                                <input type="hidden" name="harga_transaksi" value="<?= $transaksi['total_harga']; ?>">
                                <input type="hidden" name="stok_produk" value="<?= $transaksi['stok']; ?>">
                                <input type="hidden" name="id_produk" value="<?= $transaksi['id_produk']; ?>">
                                <button type="submit" class="btn btn-primary btn-block mt-3 py-3 rounded" onclick="return confirm('apakah anda yakin?');">KONFIRMASI PEMBAYARAN</button>
                            </form>
                        <?php elseif ($transaksi['status'] == 'Terkonfirmasi') : ?>
                            <?php if ($transaksi['id_kategori'] == 1) : ?>
                                <button type="button" class="btn btn-block btn-oren mt-3 rounded p-3" data-toggle="modal" data-target="#exampleModal">INPUT RESI PENGIRIMAN</button>

                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Input Resi Pengiriman</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="<?= base_url(); ?>/Admin-Resi-Transaksi/<?= $transaksi['id_transaksi']; ?>">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="noResi" class="col-form-label">Nomor Resi</label>
                                                        <input type="text" class="<?php if (session('validation.noResi')) : ?>is-invalid<?php endif ?> form-control" id="noResi" name="noResi">
                                                        <div class="invalid-feedback">
                                                            <?= session('validation.noResi') ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="waktuResi" class="col-form-label">Waktu Submit</label>
                                                        <input type="datetime-local" class="<?php if (session('validation.waktuResi')) : ?>is-invalid<?php endif ?> form-control" id="waktuResi" name="waktuResi">
                                                        <div class="invalid-feedback">
                                                            <?= session('validation.waktuResi') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-oren px-4">Submit Resi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <button type="button" id="downloadTransaksi" class="btn btn-block btn-outline-success mt-3 rounded p-3"><i class="fas fa-print"></i> &nbsp; CETAK LAPORAN</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>