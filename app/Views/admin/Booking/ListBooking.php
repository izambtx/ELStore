<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <div class="card text-gray-900 shadow">

        <!-- Page Heading -->
        <div class="row my-4 mx-3">
            <div class="col-auto mr-auto my-auto">
                <h6 class="text-uppercase align-middle"><b><?= $title; ?></b></h6>
            </div>

            <div class="col-auto my-auto">
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post" action="">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Berdasarkan Nama" aria-label="Search" aria-describedby="basic-addon2" id="keyword" name="keyword">
                        <div class="input-group-append">
                            <button class="btn btn-oren" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" style="width: 700%;" aria-labelledby="searchDropdown">
                    <form class="mr-auto w-100 navbar-search" method="post" action="">
                        <div class="form-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Berdasarkan Nama" aria-label="Search" aria-describedby="basic-addon2" id="keyword" name="keyword">
                            <div class="input-group-append">
                                <button class="btn btn-oren btn-block" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        </div>

        <table class="table table-hover text-gray-900 text-center">
            <thead class="font-weight-bold">
                <tr>
                    <td scope="col">No</td>
                    <td scope="col">Atas Nama</td>
                    <td scope="col">Jadwal Booking</td>
                    <td scope="col">Status</td>
                    <td scope="col">Dibuat Pada</td>
                    <td scope="col">Diperbarui Pada</td>
                    <td scope="col" colspan="2">Action</td>
                </tr>
            </thead>
            <tbody class="text-gray-900">
                <?php $i = 1; ?>
                <?php foreach ($booking as $b) : ?>
                    <tr>
                        <td class="align-middle" scope="row"><?= $i++; ?></td>
                        <td class="align-middle text-capitalize"><?= $b['atas_nama']; ?></td>
                        <td class="align-middle text-capitalize"><?= $b['jadwal_booking']; ?></td>
                        <td class="align-middle text-capitalize">
                            <?php if ($b['status'] == 'Created') : ?>
                                <span class="badge badge-primary"><?= $b['status']; ?></span>
                            <?php elseif ($b['status'] == 'Updated') : ?>
                                <span class="badge badge-warning"><?= $b['status']; ?></span>
                            <?php elseif ($b['status'] == 'Returned') : ?>
                                <span class="badge badge-danger"><?= $b['status']; ?></span>
                            <?php elseif ($b['status'] == 'Confirmed') : ?>
                                <span class="badge badge-success"><?= $b['status']; ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="align-middle"><?= $b['created_at']; ?></td>
                        <td class="align-middle"><?= $b['updated_at']; ?></td>
                        <td class="align-middle">
                            <a href="/admin/detail/bookings/<?= $b['id']; ?>" class="text-decoration-none text-secondary my-auto" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                        <!-- <td class="align-middle">
                            <a href="<?= base_url('/admin/bookings/' . $b['id']) ?>" class="btn btn-sm rounded-circle">
                                <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/alzqexpi.json" trigger="hover" style="width:25px;height:25px">
                                </lord-icon>
                            </a>
                        </td>
                        <td class="align-middle">
                            <form action="<?= base_url('/admin/bookings/' . $b['id']) ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn" onclick="return confirm('apakah anda yakin?');">
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/exkbusmy.json" trigger="hover" colors="outline:#121331,primary:#646e78,secondary:#e83a30,tertiary:#ebe6ef" style="width:25px;height:25px">
                                    </lord-icon>
                                </button>
                            </form>
                        </td> -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'pager'); ?>
    </div>

</div>
<?= $this->endSection(); ?>