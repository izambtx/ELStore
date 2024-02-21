<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <div class="card p-5 text-gray-900">
        <div class="card-body mb-4">
            <div class="text-center">
                <h3 class="section-heading text-uppercase"><b><?= $title; ?></b></h3>
                <h6 class="section-subheading text-capitalize">experience our makeup services with a ease of customization</h6>
            </div>
        </div>
        <div class="row">
            <?php foreach ($produk as $p) : ?>
                <?php $id_produk = base64_encode($p['id'] . ":"); ?>
                <div class="col-lg-3 mb-4">
                    <a href="/List-Produk/Detail/<?= $p['id']; ?>" class="text-gray-900 text-decoration-none">
                        <div class="card text-gray-900 shadow rounded">
                            <img src="<?= base_url(); ?>/img/<?= $p['gambar']; ?>" class="card-img-top rounded-top" style="background-size:auto;height:12rem;">
                            <div class="card-body">
                                <p class="card-text text-truncate text-capitalize"><?= $p['nama']; ?></p>
                                <h5 class="card-title">
                                    <b><?= "Rp" . number_format($p['harga'], 2, ',', '.'); ?></b>
                                </h5>
                                <p class="card-text text-truncate text-capitalize"><i class="fas fa-copyright"></i> <?= $p['nama_supplier']; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>