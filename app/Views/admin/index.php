<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <div class="card">

        <!-- Page Heading -->
        <div class="row my-4 mx-3">
            <div class="col-auto mr-auto my-auto">
                <a href="/admin/create" type="button" class="icon-btn add-btn">
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
                    <td scope="col">NIK</td>
                    <td scope="col">Fullname</td>
                    <td scope="col">Role</td>
                    <td scope="col">Action</td>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="align-middle" scope="row"><?= $i++; ?></td>
                        <td class="align-middle"><?= $user->NIK; ?></td>
                        <td class="align-middle"><?= $user->fullname; ?></td>
                        <?php if ($user->name == 'user') : ?>
                            <td class="align-middle">
                                <h5><span class="badge badge-primary"><?= $user->name; ?></span></h5>
                            </td>
                        <?php elseif ($user->name == 'admin') : ?>
                            <td class="align-middle">
                                <h5><span class="badge badge-danger"><?= $user->name;  ?></span></h5>
                            </td>
                        <?php elseif ($user->name == 'manager') : ?>
                            <td class="align-middle">
                                <h5><span class="badge badge-success"><?= $user->name;  ?></span></h5>
                            </td>
                        <?php elseif ($user->name == 'engineer') : ?>
                            <td class="align-middle">
                                <h5><span class="badge badge-warning"><?= $user->name;  ?></span></h5>
                            </td>
                        <?php endif; ?>
                        <td class="align-middle">
                            <a href="<?= base_url('admin/' . $user->UI) ?>" class="btn btn-sm rounded-circle">
                                <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/mrjuyheh.json" trigger="hover" colors="outline:#121331,primary:#231e2d,secondary:#545454,tertiary:#ebe6ef" style="width:25px;height:25px">
                                </lord-icon>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'pager'); ?>
    </div>
</div>

<?= $this->endSection(); ?>