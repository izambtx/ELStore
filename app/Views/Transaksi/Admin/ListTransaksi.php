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
                    <td scope="col">ID Transaksi</td>
                    <td scope="col">Nama Customer</td>
                    <td scope="col">Status</td>
                    <td scope="col">Dibuat Pada</td>
                    <td scope="col">Diperbarui Pada</td>
                    <td scope="col">Action</td>
                </tr>
            </thead>
            <tbody class="text-gray-900">
                <?php $i = 1; ?>
                <?php foreach ($transaksi as $t) :

                    $id = $t['id'];
                    $token = base64_encode("SB-Mid-server-HrJZLgI6Ak4AUG2NOamr2BlK:");
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
                    <tr>
                        <td class="align-middle" scope="row"><?= $i++; ?></td>
                        <td class="align-middle text-capitalize"><?= $t['id']; ?></td>
                        <td class="align-middle text-capitalize"><?= $t['fullname']; ?></td>
                        <?php if ($hasil['status_code'] == 404) : ?>
                            <td class="align-middle"><span class="badge badge-secondary">SELECTING PAYMENT</span></td>
                        <?php elseif ($hasil['status_code'] == 200) : ?>
                            <?php if (empty($t['status'])) : ?>
                                <td class="align-middle"><span class="badge badge-info">PAYED</span></td>
                            <?php else : ?>
                                <?php if ($t['status'] == 'Dalam Pengiriman' || $t['status'] == 'Terkonfirmasi') : ?>
                                    <td class="align-middle">
                                        <h5><span class="badge badge-primary"><?= $t['status']; ?></span></h5>
                                    </td>
                                <?php else : ?>
                                    <td class="align-middle">
                                        <h5><span class="badge badge-success"><?= $t['status']; ?></span></h5>
                                    </td>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php elseif ($hasil['status_code'] == 500) : ?>
                            <td class="align-middle"><span class="badge badge-warning">Internal Server Error</span></td>
                        <?php elseif ($hasil['status_code'] == 201 || $hasil['status_code'] == 407) : ?>
                            <td class="align-middle"><span class="badge badge-warning">CANCELED</span></td>
                        <?php else : ?>
                            <td class="align-middle"><span class="badge badge-warning"><?= $hasil['status_code']; ?></span></td>
                        <?php endif; ?>
                        <td class="align-middle"><?= $t['created_at']; ?></td>
                        <td class="align-middle"><?= $t['updated_at']; ?></td>
                        <td class="align-middle">
                            <a href="<?= base_url() ?>/Detail-Admin-Transaksi/<?= $t['id']; ?>" class="btn btn-sm rounded-circle">
                                <i class="fas fa-eye"></i>
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