<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
    <?php

    $id = $makeup['id_transaksi'];
    $token_db = $makeup['token'];
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
                            <?php if (empty($makeup['status'])) : ?>
                                <h5><span class="badge badge-info font-weight-bold my-auto">PAYED</span></h5>
                            <?php else : ?>
                                <?php if ($makeup['status'] == 'Dalam Pengiriman') : ?>
                                    <h5><span class="badge badge-primary font-weight-bold my-auto"><?= $makeup['status']; ?></span></h5>
                                <?php else : ?>
                                    <h5><span class="badge badge-success font-weight-bold my-auto"><?= $makeup['status']; ?></span></h5>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php elseif ($hasil['status_code'] == 201) : ?>
                            <h5><span class="badge badge-warning font-weight-bold my-auto">CANCELED</span></h5>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="card-text font-weight-bold text-gray-600">No. Invoice</p>
                        <p class="text-oren font-weight-bold"><?= $makeup['id_transaksi']; ?></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="card-text font-weight-bold text-gray-600">Tanggal Pembelian</p>
                        <p class=""><?= $makeup['created_at']; ?></p>
                    </div>
                    <?php if ($makeup['id_kategori'] == 1) : ?>
                        <div class="d-flex justify-content-between">
                            <p class="card-text font-weight-bold text-gray-600">No. Resi Pengiriman Sicepat</p>
                            <p class="font-weight-bold"><?= $makeup['noResi']; ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="card-text font-weight-bold text-gray-600">Waktu Submit Pengiriman</p>
                            <p><?= $makeup['waktu_submit_resi']; ?></p>
                        </div>
                    <?php endif; ?>
                    <hr>
                    <a <?php if ($makeup['id_kategori'] == 1) : ?> href="/List-Produk/Detail/<?= $makeup['id_produk']; ?>" <?php else : ?> href="/List-Rent-Services" <?php endif ?> class="text-decoration-none text-gray-900">
                        <div class="media border rounded p-3">
                            <img src="<?= base_url(); ?>/img/<?= $makeup['gambar']; ?>" class="mr-3" width="100rem">
                            <div class="media-body">
                                <h5 class="mt-0 ml-1 text-capitalize font-weight-bold"><?= $makeup['nama']; ?></h5>
                                <p class="text-gray-600 m-1"><?= $makeup['jumlah_barang']; ?> x <?= "Rp" . number_format($makeup['harga'], 2, ',', '.'); ?></p>
                                <div class="d-flex justify-content-end">
                                    <p class="m-1 my-auto">Total Harga : </p>
                                    <h5 class="ml-1 my-auto"><b><?= "Rp" . number_format($makeup['harga'], 2, ',', '.'); ?></b></h5>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php if ($hasil['status_code'] == '404') : ?>
                        <form action="" method="POST">
                            <input type="hidden" name="id_transaksi" value="<?= $makeup['id_transaksi']; ?>">
                            <input type="hidden" name="harga_transaksi" value="<?= $makeup['total_harga']; ?>">
                            <button type="submit" class="btn btn-primary btn-block mt-5 py-3 rounded">Bayar Sekarang</button>
                        </form>
                    <?php elseif ($hasil['status_code'] == '201') : ?>
                    <?php elseif ($hasil['status_code'] == '200') : ?>
                        <?php if ($makeup['status'] == 'Dalam Pengiriman') : ?>
                            <form action="/Detail-Terima-Transaksi/<?= $makeup['id_transaksi']; ?>" method="POST">
                                <input type="hidden" name="id_transaksi" value="<?= $makeup['id_transaksi']; ?>">
                                <button type="submit" class="btn btn-block btn-success mt-3 rounded p-3">TERIMA BARANG</button>
                            </form>
                        <?php endif; ?>
                        <button type="button" id="downloadTransaksi" class="btn btn-block btn-outline-success mt-3 rounded p-3"><i class="fas fa-print"></i> &nbsp; CETAK LAPORAN</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>