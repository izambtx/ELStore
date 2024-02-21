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
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post" action="">
                            <div class="form-group">
                                <input type="date" class="form-control rounded-sm" id="waktu" name="waktu">
                                <select class="form-control rounded-sm mx-3" id="keyword" name="keyword">
                                    <option selected hidden disabled>Berdasarkan Kategori</option>
                                    <?php foreach ($kategori as $d) : ?>
                                        <option value="<?= $d['id'];  ?>" <?= old('kategori') == $d['id'] ? 'selected' : '' ?>><?= $d['nama_kategori'];  ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button class="btn btn-oren" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <?php if ($selectedWaktu || $selectedKategori) : ?>

                        <div class="col-sm-12 d-flex mt-3 justify-content-end">
                            <div class="form-inline rounded">
                                <h6 class="mx-3 align-middle mt-2"> Hasil Pencarian : </h6>
                                <?php if (empty($selectedWaktu)) : ?>
                                    <div class="input-group mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                        <span class="mt-1 align-middle">
                                            Tanggal Pembuatan
                                        </span>
                                    </div>
                                <?php else : ?>
                                    <div class="input-group mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                        <span class="mt-1 align-middle">
                                            <i class="fas fa-check mr-2"></i>
                                            <?= $selectedWaktu; ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?php if (empty($selectedKategori)) : ?>
                                    <div class="input-group mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                        <span class="mt-1 align-middle">
                                            Kategori Pesanan
                                        </span>
                                    </div>
                                <?php else : ?>
                                    <div class="input-group mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                        <span class="mt-1 align-middle">
                                            <i class="fas fa-check mr-2"></i>
                                            <?= $kategoriNama['nama_kategori']; ?>
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
                                <td class="font-weight-bold" scope="col">ID Transaksi</td>
                                <td class="font-weight-bold" scope="col">Total Harga</td>
                                <td class="font-weight-bold" scope="col">Kategori</td>
                                <td class="font-weight-bold" scope="col">Status</td>
                                <td class="font-weight-bold" scope="col">Tanggal Dibuat</td>
                                <td class="font-weight-bold" scope="col">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                            <?php foreach ($makeup as $m) :

                                $id = $m['id'];
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
                                    <td class="align-middle text-capitalize" style="max-width: 10rem;"><?= $m['id']; ?></td>
                                    <td class="align-middle text-capitalize" style="max-width: 10rem;"><?= "Rp" . number_format($m['total_harga'], 2, ',', '.'); ?></td>
                                    <td class="align-middle text-capitalize" style="max-width: 10rem;"><?= $m['nama_kategori']; ?></td>
                                    <?php if ($hasil['status_code'] == 404) : ?>
                                        <td class="align-middle"><span class="badge badge-secondary">SELECTING PAYMENT</span></td>
                                    <?php elseif ($hasil['status_code'] == 200) : ?>
                                        <?php if (empty($m['status'])) : ?>
                                            <td class="align-middle"><span class="badge badge-info">PAYED</span></td>
                                        <?php else : ?>
                                            <?php if ($m['status'] == 'Dalam Pengiriman' || $m['status'] == 'Terkonfirmasi') : ?>
                                                <td class="align-middle">
                                                    <h5><span class="badge badge-primary"><?= $m['status']; ?></span></h5>
                                                </td>
                                            <?php else : ?>
                                                <td class="align-middle">
                                                    <h5><span class="badge badge-success"><?= $m['status']; ?></span></h5>
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
                                    <td class="align-middle"><?= date('d M Y', strtotime($m['created_at'])); ?></td>
                                    <td class="align-middle d-flex justify-content-around">
                                        <a href="/Detail-Transaksi/<?= $m['id']; ?>" class="text-decoration-none text-secondary my-auto" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <!-- <form action="/List-History-Makeup/Status/<?= $m['id']; ?>" method="POST">
                                            <button type="submit" class="btn text-decoration-none text-secondary my-auto">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            /Detail-Transaksi-Makeup/<?= $m['id']; ?>
                                        </form> -->
                                        <!-- <a href="https://app.sandbox.midtrans.com/snap/v2/vtweb/<?= $token; ?>" class="btn text-oren"><i class="fas fa-money-check-alt"></i></a> -->
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