<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card text-gray-900 shadow">

                <!-- Page Heading -->
                <div class="row my-4 mx-3">
                    <div class="col-auto mr-auto mt-3 align-middle">
                        <h6 class="text-uppercase align-middle"><b><?= $title; ?></b></h6>
                    </div>

                    <div class="col-auto my-auto">
                        <form class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100" method="post" action="">
                            <div class="input-group">
                                <input type="date" class="form-control rounded-left-sm" id="keyword" name="keyword">
                                <div class="input-group-append">
                                    <button class="btn btn-oren" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php if ($selectedTanggal) : ?>

                        <div class="col-sm-12 d-flex mt-3 justify-content-end">
                            <div class="form-inline rounded">
                                <h6 class="mx-3 align-middle mt-2"> Hasil Pencarian : </h6>
                                <?php if (empty($selectedTanggal)) : ?>
                                    <div class="input-group mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                        <span class="mt-1 align-middle">
                                            Tanggal Keperluan
                                        </span>
                                    </div>
                                <?php else : ?>
                                    <div class="input-group mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                        <span class="mt-1 align-middle">
                                            <i class="fas fa-check mr-2"></i>
                                            <?= $selectedTanggal; ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <table class="table table-hover text-gray-900 text-center">
                        <thead>
                            <tr>
                                <td class="font-weight-bold" scope="col">No.</td>
                                <td class="font-weight-bold" scope="col">Atas Nama </td>
                                <td class="font-weight-bold" scope="col">Tanggal Perjanjian</td>
                                <td class="font-weight-bold" scope="col">Status</td>
                                <td class="font-weight-bold" scope="col">Tanggal Dibuat</td>
                                <td class="font-weight-bold" scope="col">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                            <?php foreach ($booking as $b) : ?>
                                <tr>
                                    <td class="align-middle" scope="row"><?= $i++; ?></td>
                                    <td class="align-middle" style="max-width: 10rem;"><?= $b['atas_nama']; ?></td>
                                    <td class="align-middle"><?= date('d M Y H:i:s', strtotime($b['jadwal_booking'])); ?></td>
                                    <?php if ($b['status'] == 'Created') : ?>
                                        <td class="align-middle"><span class="badge badge-primary"><?= $b['status'];  ?></span></td>
                                    <?php elseif ($b['status'] == 'Updated') : ?>
                                        <td class="align-middle"><span class="badge badge-warning"><?= $b['status'];  ?></span></td>
                                    <?php elseif ($b['status'] == 'Approved') : ?>
                                        <td class="align-middle"><span class="badge badge-info"><?= $b['status'];  ?></span></td>
                                    <?php elseif ($b['status'] == 'Confirmed') : ?>
                                        <td class="align-middle"><span class="badge badge-success"><?= $b['status'];  ?></span></td>
                                    <?php elseif ($b['status'] == 'Returned') : ?>
                                        <td class="align-middle"><span class="badge badge-danger"><?= $b['status'];  ?></span></td>
                                    <?php endif; ?>
                                    <td class="align-middle"><?= date('d M Y', strtotime($b['created_at'])); ?></td>
                                    <td class="align-middle d-flex justify-content-around">
                                        <a href="/Form-Edit-Booking/<?= $b['id']; ?>" class="text-decoration-none text-secondary my-auto" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="/History-List-Booking/<?= $b['id']; ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn text-danger" onclick="return confirm('apakah anda yakin?');" data-toggle="tooltip" data-placement="bottom" title="Batalkan Jadwal"><i class="fas fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'pager'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>