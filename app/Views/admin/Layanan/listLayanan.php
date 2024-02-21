<?php if (in_groups('admin')) : ?>
    <?= $this->extend('header/index'); ?>

    <?= $this->section('page-content'); ?>

    <div class="container-fluid mb-5 justify-content-center">

        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

        <div class="card">

            <!-- Page Heading -->
            <div class="row my-4 mx-3">
                <div class="col-auto mr-auto my-auto">
                    <a href="<?= base_url('/admin/create/services') ?>" type="button" class="icon-btn add-btn">
                        <div class="add-icon"></div>
                        <div class="btn-txt text-center font-weight-bold">Create New</div>
                    </a>
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
                        <td scope="col">Nama Supplier</td>
                        <td scope="col">Dibuat Pada</td>
                        <td scope="col">Diperbarui Pada</td>
                        <td scope="col" colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody class="text-gray-900">
                    <?php $i = 1; ?>
                    <?php foreach ($layanan as $l) : ?>
                        <tr>
                            <td class="align-middle" scope="row"><?= $i++; ?></td>
                            <td class="align-middle text-capitalize"><?= $l['nama_layanan']; ?></td>
                            <td class="align-middle"><?= $l['created_at']; ?></td>
                            <td class="align-middle"><?= $l['updated_at']; ?></td>
                            <td class="align-middle">
                                <a href="<?= base_url('/admin/services/' . $l['id']) ?>" class="btn btn-sm rounded-circle">
                                    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/alzqexpi.json" trigger="hover" style="width:25px;height:25px">
                                    </lord-icon>
                                </a>
                            </td>
                            <td class="align-middle">
                                <form action="<?= base_url('/admin/services/' . $l['id']) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn" onclick="return confirm('apakah anda yakin?');">
                                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                        <lord-icon src="https://cdn.lordicon.com/exkbusmy.json" trigger="hover" colors="outline:#121331,primary:#646e78,secondary:#e83a30,tertiary:#ebe6ef" style="width:25px;height:25px">
                                        </lord-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <?= $this->endSection(); ?>
<?php else : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <link rel="icon" type="img/x-icon" href="/img/favicon.ico">
        <link href="<?php base_url(); ?>/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="<?php base_url(); ?>/css/sb-admin-2.css" rel="stylesheet">
        <title>One Point Lesson</title>
    </head>

    <body style="margin:0;">
        <img draggable="false" src="/img/404.png" style="width: 100%; height: 100%; object-fit:cover; z-index: index 0; position:absolute;">
        <a class="btn btn-outline-light px-4 m-0 font-weight-bold" href="/<?php base_url() ?>" style="position:absolute;z-index:1;left:50%;top:70%; transform:translate(-50%, -50%)">GO HOME</a>
    </body>

    </html>
<?php endif; ?>