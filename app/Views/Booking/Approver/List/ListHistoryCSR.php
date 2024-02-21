<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <div class="card">

        <!-- Page Heading -->
        <div class="row my-4 mx-3">
            <div class="col-auto mr-auto my-auto">

            </div>

            <div class="col-auto my-auto">
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post" action="">
                    <div class="input-group">
                        <input type="date" class="form-control rounded-sm" id="waktu" name="waktu">
                        <select class="custom-select rounded-sm col-sm-3 mx-3 " id="users" name="users">
                            <option selected disabled hidden>Pembuat</option>
                            <?php foreach ($users as $d) : ?>
                                <option value="<?= $d['id'];  ?>" <?= old('users') == $d['id'] ? 'selected' : '' ?>><?= $d['fullname'];  ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Berdasarkan Tema" aria-label="Search" aria-describedby="basic-addon2" id="keyword" name="keyword">
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
                            <input type="date" class="form-control rounded-sm" id="waktu" name="waktu">
                            <select class="custom-select rounded-sm col-sm-3 mx-3 " id="users" name="users">
                                <option selected disabled hidden>Pembuat</option>
                                <?php foreach ($users as $d) : ?>
                                    <option value="<?= $d['id'];  ?>" <?= old('users') == $d['id'] ? 'selected' : '' ?>><?= $d['fullname'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Berdasarkan Tema" aria-label="Search" aria-describedby="basic-addon2" id="keyword" name="keyword">
                            <div class="input-group-append">
                                <button class="btn btn-oren btn-block" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <?php if ($selectedTema || $selectedUser || $selectedWaktu) : ?>

                <div class="col-sm-12 d-flex mt-3 justify-content-end">
                    <div class="form-inline rounded">
                        <h6 class="mx-3 align-middle mt-2"> Hasil Pencarian : </h6>
                        <?php if (empty($selectedWaktu)) : ?>
                            <div class="input-group mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                <span class="mt-1 align-middle">
                                    Waktu
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="input-group mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-check mr-2"></i> <?= date('d M Y', strtotime($selectedWaktu)); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($selectedUser)) : ?>
                            <div class="input-group mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                <span class="mt-1 align-middle">
                                    pembuat
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="input-group mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-check mr-2"></i><?= $usersNama['fullname']; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($selectedTema)) : ?>
                            <div class="input-group mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                <span class="mt-1 align-middle">
                                    Tema
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="input-group mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-check mr-2"></i>
                                    <?= $selectedTema; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <table class="table table-hover text-gray-900 text-center">
            <thead>
                <tr>
                    <td class="font-weight-bold" scope="col">No.</td>
                    <td class="font-weight-bold" scope="col">Tema</td>
                    <td class="font-weight-bold" scope="col">Pembuat</td>
                    <td class="font-weight-bold" scope="col">Status</td>
                    <td class="font-weight-bold" scope="col">Tanggal Dibuat</td>
                    <td class="font-weight-bold" scope="col">Action</td>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                <?php foreach ($csr as $b) : ?>
                    <tr>
                        <td class="align-middle" scope="row"><?= $i++; ?></td>
                        <td class="align-middle" style="max-width: 10rem;"><?= $b['tema']; ?></td>
                        <td class="align-middle"><?= $b['username']; ?></td>
                        <?php if ($b['status'] == 'Created') : ?>
                            <td class="align-middle"><span class="badge badge-primary"><?= $b['status'];  ?></span></td>
                        <?php elseif ($b['status'] == 'Updated') : ?>
                            <td class="align-middle"><span class="badge badge-warning"><?= $b['status'];  ?></span></td>
                        <?php elseif ($b['status'] == 'Approved') : ?>
                            <td class="align-middle"><span class="badge badge-info"><?= $b['status'];  ?></span></td>
                        <?php elseif ($b['status'] == 'Done') : ?>
                            <td class="align-middle"><span class="badge badge-success"><?= $b['status'];  ?></span></td>
                        <?php elseif ($b['status'] == 'Returned MGR' || $b['status'] == 'Returned FA') : ?>
                            <td class="align-middle"><span class="badge badge-warning"><?= $b['status'];  ?></span></td>
                        <?php elseif ($b['status'] == 'Rejected MGR' || $b['status'] == 'Rejected FA') : ?>
                            <td class="align-middle"><span class="badge badge-danger"><?= $b['status'];  ?></span></td>
                        <?php endif; ?>
                        <td class="align-middle"><?= date('d M Y', strtotime($b['created_at'])); ?></td>
                        <td class="align-middle">
                            <a href="/Detail-Approve-Form-CSR/<?= $b['id']; ?>">
                                <?php if ($b['status'] == 'Returned') : ?>
                                    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/alzqexpi.json" trigger="hover" style="width:25px;height:25px">
                                    </lord-icon>
                                <?php else : ?>
                                    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/mrjuyheh.json" trigger="hover" colors="outline:#000000,primary:#000000,secondary:#000000,tertiary:#ffffff" style="width:25px;height:25px">
                                    </lord-icon>
                                <?php endif; ?>
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