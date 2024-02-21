<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php
        $hour = date('H');
        $dayTerm = ($hour > 17) ? "Evening" : (($hour > 12) ? "Afternoon" : "Morning");
        ?>
        <h1 class="h3 ml-5 mb-3 text-gray-900">Good <?= $dayTerm; ?> <span class="font-weight-bold"><?= user()->fullname; ?></span></h1>
    </div>

    <!-- Content Row -->
    <?php if (in_groups('admin')) : ?>
        <div class="row mb-5">

            <!-- Pie Chart -->
            <div class="col-sm-12 my-0" style="border-radius: 50px;">
                <div class="card shadow rounded">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header rounded-top-lg border-bottom-0 pt-4 d-flex flex-row align-items-center justify-content-between bg-white">
                        <?php if (in_groups('admin')) : ?>
                            <h6 class="m-0 font-weight-bold text-gray-900">Seluruh Data Transaksi</h6>
                        <?php else : ?>
                            <h6 class="m-0 font-weight-bold text-gray-900"><span class="text-success"><?= user()->username; ?></span>'s Transaction By Category</h6>
                        <?php endif; ?>
                        <?php if (!in_groups('pembuat')) : ?>
                            <!-- <div class="dropdown no-arrow">
                                <a href="<?php base_url() ?>/transaksi/export" class="download-button dropdown-toggle">
                                    <div class="docs py-0"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line y2="13" x2="8" y1="13" x1="16"></line>
                                            <line y2="17" x2="8" y1="17" x1="16"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                        Download .XLSX
                                    </div>
                                    <div class="download">
                                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="7 10 12 15 17 10"></polyline>
                                            <line y2="3" x2="12" y1="15" x1="12"></line>
                                        </svg>
                                    </div>
                                </a>
                            </div> -->
                        <?php endif; ?>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body rounded-bottom-lg">
                        <div class="card-columns">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-danger font-weight-bold">TOTAL PENGGUNA</h5>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="h3 my-auto mb-0 font-weight-bold text-gray-800"><?= $usersTotal; ?></div>
                                        </div>
                                        <div class="col-sm-2 text-gray-400">
                                            <h3 class="my-auto"><i class="fas fa-users fa-lg"></i></h3>
                                        </div>
                                    </div>
                                    <p class="card-text text-justify mt-3">Total pengguna disini adalah sudah termasuk pengguna untuk yang berstatuskan pelanggan maupun admin.</p>
                                </div>
                            </div>
                            <div class="card h-100 py-2">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Pesanan Produk Kecantikan
                                    </div>
                                    <div class="row no-gutters align-items-center mt-4">
                                        <div class="col">
                                            <div class="mb-0 text-gray-800">
                                                <h3 class=" font-weight-bold"><?= $produkTotal; ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 text-gray-400">
                                            <h3 class="my-auto"><i class="fas fa-file-invoice-dollar fa-lg"></i></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card h-100 py-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                TOTAL STOK PRODUK
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $stokTotal['stok']; ?> / <?= $produkStokTotal * 10; ?></div>
                                        </div>
                                        <div class="col-sm-2 text-gray-400">
                                            <h3 class="my-auto"><i class="fas fa-truck-loading fa-lg"></i></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card bg-success text-white text-center p-3">
                                <blockquote class="blockquote mb-0">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        Total Pendapatan
                                    </div>
                                    <div class="row text-success mt-3">
                                        <h3 class="col-sm-1"><i class="fas fa-dollar-sign fa-lg"></i></h3>
                                        <h4 class="col-sm-10 font-weight-bold text-white"><?= "Rp" . number_format($transaksiTotal['total_harga'], 0, ',', '.'); ?></h4>
                                    </div>
                                </blockquote>
                                <p class="card-text"><small class="">Semua Pesanan</small></p>
                            </div>
                            <div class="card h-100 py-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Booking Appointment
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $bookingTotal; ?></div>
                                        </div>
                                        <div class="col-sm-2 text-gray-400">
                                            <h3 class="my-auto"><i class="fas fa-file-contract fa-lg"></i></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-danger font-weight-bold">TOTAL KERANJANG</h5>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="h3 my-auto mb-0 font-weight-bold text-gray-800"><?= $keranjangTotal; ?></div>
                                        </div>
                                        <div class="col-sm-2 text-gray-400">
                                            <h3 class="my-auto"><i class="fas fa-shopping-cart fa-lg"></i></h3>
                                        </div>
                                    </div>
                                    <p class="card-text text-justify mt-3">Total keranjang keseluruhan terhadap pelanggan yang masih menyimpan produknya di keranjang.</p>
                                </div>
                            </div>
                            <div class="card h-100 py-2">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Pesanan Jasa Makeup
                                    </div>
                                    <div class="row no-gutters align-items-center mt-4">
                                        <div class="col">
                                            <div class="mb-0 text-gray-800">
                                                <h3 class="font-weight-bold"><?= $weddingTotal + $graduationTotal; ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 text-gray-400">
                                            <h3 class="my-auto"><i class="fas fa-file-alt fa-lg"></i></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chart-bar py-1 my-5">
                            <canvas id="myBarChart"></canvas>
                        </div>
                        <div class="my-5 text-center small">
                            <span class="mr-2 text-dark">
                                <i class="fas fa-circle text-oren"></i> Penghasilan EL Salon Per Tahun
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Pie Chart -->
            <div class="col-sm-12 my-0" style="border-radius: 50px;">
                <div class="card shadow rounded">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header rounded-top-lg border-bottom-0 pt-4 d-flex flex-row align-items-center justify-content-between bg-white">
                        <?php if (in_groups('admin')) : ?>
                            <h6 class="m-0 font-weight-bold text-gray-900">Seluruh Data Berdasarkan Menu Pengelolaan</h6>
                        <?php else : ?>
                            <h6 class="m-0 font-weight-bold text-gray-900"><span class="text-success"><?= user()->username; ?></span>'s Transaction By Category</h6>
                        <?php endif; ?>
                        <?php if (!in_groups('pembuat')) : ?>
                            <!-- <div class="dropdown no-arrow">
                                <a href="<?php base_url() ?>/transaksi/export" class="download-button dropdown-toggle">
                                    <div class="docs py-0"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line y2="13" x2="8" y1="13" x1="16"></line>
                                            <line y2="17" x2="8" y1="17" x1="16"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                        Download .XLSX
                                    </div>
                                    <div class="download">
                                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="7 10 12 15 17 10"></polyline>
                                            <line y2="3" x2="12" y1="15" x1="12"></line>
                                        </svg>
                                    </div>
                                </a>
                            </div> -->
                        <?php endif; ?>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body rounded-bottom-lg">

                        <div class="col-sm-12">

                            <div class="row">
                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-sm-4 mb-4">
                                    <div class="card border-left-primary h-100 py-1">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Kategori
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $kategori; ?></div>
                                                </div>
                                                <div class="col-sm-2 text-gray-400">
                                                    <h3 class="my-auto"><i class="fas fa-file-invoice-dollar fa-lg"></i></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-sm-4 mb-4">
                                    <div class="card border-left-info h-100 py-1">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Pelayanan
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $pelayanan; ?></div>
                                                </div>
                                                <div class="col-sm-2 text-gray-400">
                                                    <h3 class="my-auto"><i class="fas fa-file-contract fa-lg"></i></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4 mb-4">
                                    <div class="card border-left-success h-100 py-1">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Produk Kecantikan
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $produk; ?></div>
                                                </div>
                                                <div class="col-sm-2 text-gray-400">
                                                    <h3 class="my-auto"><i class="fas fa-file-invoice fa-lg"></i></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-sm-6 mb-4">
                                    <div class="card border-left-warning h-100 py-1">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Jasa Makeup
                                                    </div>
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Total : <?= $jasa; ?></div>
                                                </div>
                                                <div class="col-sm-2 text-gray-400">
                                                    <h3 class="my-auto"><i class="fas fa-file-alt fa-lg"></i></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pending Returned Card Example -->
                                <div class="col mb-4">
                                    <div class="card border-left-danger h-100 py-1">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        Supplier Produk Kecantikan
                                                    </div>
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Total : <?= $supplier; ?></div>
                                                </div>
                                                <div class="col-sm-2 text-gray-400">
                                                    <h3 class="my-auto"><i class="fas fa-file-medical-alt fa-lg"></i></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chart-pie py-1 my-5">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="my-5 pt-5 text-center small">
                            <span class="mr-2 text-dark">
                                <i class="fas fa-circle text-primary"></i> Kategori
                            </span>
                            <span class="mr-2 text-dark">
                                <i class="fas fa-circle text-info"></i> Pelayanan
                            </span>
                            <span class="mr-2 text-dark">
                                <i class="fas fa-circle text-success"></i> Produk Kecantikan
                            </span>
                            <span class="mr-2 text-dark">
                                <i class="fas fa-circle text-warning"></i> Jasa Makeup
                            </span>
                            <span class="mr-2 text-dark">
                                <i class="fas fa-circle text-danger"></i> Supplier Produk
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else : ?>
        <div class="row">

            <!-- Pie Chart -->
            <div class="col-sm-12 my-0" style="border-radius: 50px;">
                <div class="card shadow rounded">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header rounded-top-lg border-bottom-0 pt-4 d-flex flex-row align-items-center justify-content-between bg-white">
                        <?php if (in_groups('admin')) : ?>
                            <h6 class="m-0 font-weight-bold text-gray-900">Seluruh Data Berdasarkan Kategori</h6>
                        <?php else : ?>
                            <h6 class="m-0 font-weight-bold text-gray-900">Seluruh Transaksi <span class="text-success"><?= user()->username; ?></span> Berdasarkan Kategori</h6>
                        <?php endif; ?>
                        <?php if (!in_groups('pembuat')) : ?>
                            <!-- <div class="dropdown no-arrow">
                                <a href="<?php base_url() ?>/transaksi/export" class="download-button dropdown-toggle">
                                    <div class="docs py-0"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line y2="13" x2="8" y1="13" x1="16"></line>
                                            <line y2="17" x2="8" y1="17" x1="16"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                        Download .XLSX
                                    </div>
                                    <div class="download">
                                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="7 10 12 15 17 10"></polyline>
                                            <line y2="3" x2="12" y1="15" x1="12"></line>
                                        </svg>
                                    </div>
                                </a>
                            </div> -->
                        <?php endif; ?>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body rounded-bottom-lg">

                        <div class="col-sm-12">

                            <div class="row">
                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-sm-4 mb-4">
                                    <div class="card border-left-primary h-100 py-1">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Total Transaksi
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $transaksiTotal; ?></div>
                                                </div>
                                                <div class="col-sm-2 text-gray-400">
                                                    <h3 class="my-auto"><i class="fas fa-file-invoice-dollar fa-lg"></i></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-sm-4 mb-4">
                                    <div class="card border-left-info h-100 py-1">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Booking Appointment
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $bookingTotal; ?></div>
                                                </div>
                                                <div class="col-sm-2 text-gray-400">
                                                    <h3 class="my-auto"><i class="fas fa-file-contract fa-lg"></i></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4 mb-4">
                                    <div class="card border-left-success h-100 py-1">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Produk Kecantikan
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $produkTotal; ?></div>
                                                </div>
                                                <div class="col-sm-2 text-gray-400">
                                                    <h3 class="my-auto"><i class="fas fa-file-invoice fa-lg"></i></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-sm-6 mb-4">
                                    <div class="card border-left-warning h-100 py-1">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Jasa Makeup Wedding
                                                    </div>
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Total : <?= $weddingTotal; ?></div>
                                                </div>
                                                <div class="col-sm-2 text-gray-400">
                                                    <h3 class="my-auto"><i class="fas fa-file-alt fa-lg"></i></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pending Returned Card Example -->
                                <div class="col mb-4">
                                    <div class="card border-left-danger h-100 py-1">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        Jasa Makeup Graduation
                                                    </div>
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Total : <?= $graduationTotal; ?></div>
                                                </div>
                                                <div class="col-sm-2 text-gray-400">
                                                    <h3 class="my-auto"><i class="fas fa-file-medical-alt fa-lg"></i></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chart-pie py-1 my-5">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                        <div class="my-5 pt-5 text-center small">
                            <span class="mr-2 text-dark">
                                <i class="fas fa-circle text-primary"></i> Total Transaksi
                            </span>
                            <span class="mr-2 text-dark">
                                <i class="fas fa-circle text-info"></i> Booking Appointment
                            </span>
                            <span class="mr-2 text-dark">
                                <i class="fas fa-circle text-success"></i> Produk Kecantikan
                            </span>
                            <span class="mr-2 text-dark">
                                <i class="fas fa-circle text-warning"></i> Jasa Makeup Wedding
                            </span>
                            <span class="mr-2 text-dark">
                                <i class="fas fa-circle text-danger"></i> Jasa Makeup Graduation
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>

<?php if (in_groups('admin')) : ?>

    <input id="CP" type="hidden" value="<?= $kategori; ?>"></input>
    <input id="CH" type="hidden" value="<?= $pelayanan; ?>"></input>
    <input id="CS" type="hidden" value="<?= $jasa; ?>"></input>
    <input id="CF" type="hidden" value="<?= $supplier; ?>"></input>
    <input id="CD" type="hidden" value="<?= $produk; ?>"></input>

    <input id="CB0" type="hidden" value="<?= $penghasilan2017['total_harga']; ?>"></input>
    <input id="CB1" type="hidden" value="<?= $penghasilan2018['total_harga']; ?>"></input>
    <input id="CB2" type="hidden" value="<?= $penghasilan2019['total_harga']; ?>"></input>
    <input id="CB3" type="hidden" value="<?= $penghasilan2020['total_harga']; ?>"></input>
    <input id="CB4" type="hidden" value="<?= $penghasilan2021['total_harga']; ?>"></input>
    <input id="CB5" type="hidden" value="<?= $penghasilan2022['total_harga']; ?>"></input>
    <input id="CB6" type="hidden" value="<?= $penghasilan2023['total_harga']; ?>"></input>
    <input id="CB7" type="hidden" value="<?= $penghasilan2024['total_harga']; ?>"></input>
    <input id="CB8" type="hidden" value="<?= $penghasilan2025['total_harga']; ?>"></input>
    <input id="CB9" type="hidden" value="<?= $penghasilan2026['total_harga']; ?>"></input>
    <input id="max_omset" type="hidden" value="<?= $penghasilanMax['total_harga']; ?>"></input>

<?php else : ?>

    <input id="CP" type="hidden" value="<?= $transaksiTotal; ?>"></input>
    <input id="CH" type="hidden" value="<?= $bookingTotal; ?>"></input>
    <input id="CS" type="hidden" value="<?= $produkTotal; ?>"></input>
    <input id="CF" type="hidden" value="<?= $weddingTotal; ?>"></input>
    <input id="CD" type="hidden" value="<?= $graduationTotal; ?>"></input>

    <input id="CP2" type="hidden" value="<?= $transaksiLastTotal; ?>"></input>
    <input id="CH2" type="hidden" value="<?= $bookingLastTotal; ?>"></input>
    <input id="CS2" type="hidden" value="<?= $produkLastTotal; ?>"></input>
    <input id="CF2" type="hidden" value="<?= $weddingLastTotal; ?>"></input>
    <input id="CD2" type="hidden" value="<?= $graduationLastTotal; ?>"></input>

<?php endif; ?>

<?= $this->endSection(); ?>