<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <!-- Content Card -->
    <div class="card text-gray-900 shadow">
        <h5 class="card-header font-weight-bold text-center"><?= $title; ?></h5>
        <div class="card-body">
            <h5 class="card-title text-capitalize">
                <?= $booking['atas_nama']; ?> - <?= $booking['fullname']; ?>
                <?php if ($booking['status'] == 'Created') : ?>
                    <span class="badge badge-primary"><?= $booking['status']; ?></span>
                <?php elseif ($booking['status'] == 'Updated') : ?>
                    <span class="badge badge-warning"><?= $booking['status']; ?></span>
                <?php elseif ($booking['status'] == 'Confirmed') : ?>
                    <span class="badge badge-success"><?= $booking['status']; ?></span>
                <?php elseif ($booking['status'] == 'Returned') : ?>
                    <span class="badge badge-danger"><?= $booking['status']; ?></span>
                <?php endif; ?>
            </h5>
            <p>
                1. <?= $booking['nama_layanan']; ?>
                <?php if ($booking['id_layanan2'] != 1) : ?>
                    <br>2. <?= $booking2['nama_layanan']; ?>
                <?php endif; ?>
                <?php if ($booking['id_layanan3'] != 1) : ?>
                    <br>3. <?= $booking3['nama_layanan']; ?>
                <?php endif; ?>
            </p>
            <p class="card-text">Dibuat Oleh Akun : <b><?= $booking2['fullname']; ?></b></p>
            <p class="card-text"><?= $booking['jadwal_booking']; ?></p>
            <p class="card-text"><?= $booking['catatan']; ?></p>
        </div>
        <div class="card-footer text-muted d-flex justify-content-end">
            <?php if ($booking['status'] == 'Created' || $booking['status'] == 'Updated') : ?>
                <form action="/admin/detail/bookings/return/<?= $booking['id']; ?>" method="post">
                    <button type="submit" class="btn btn-warning px-4 mx-4">Return</button>
                </form>
                <form action="/admin/detail/bookings/confirm/<?= $booking['id']; ?>" method="post">
                    <button type="submit" class="btn btn-primary px-4">Confirm</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>