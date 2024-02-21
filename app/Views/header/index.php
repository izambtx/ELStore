<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EL Salon Store</title>

    <link rel="icon" type="img/x-icon" href="/img/favicon.ico">
    <!-- Custom fonts for this template-->
    <link href="<?php base_url(); ?>/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <link type="text/css" href="<?php base_url(); ?>/css/sb-admin-2.css" rel="stylesheet">
</head>

<body id="page-top" onload="autoClick();">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light bg-white accordion shadow-no-bottom" style="z-index: 1;" id="accordionSidebar">
            <div class="sticky-top text-gray-900">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand rounded-bottom-lg d-flex align-items-center justify-content-center" href="/Home">
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">EL Shop</div>
                    <!-- <div class="sidebar-brand-text mx-3">Home</div> -->
                </a>

                <?php if (!in_groups('user')) : ?>
                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php base_url(); ?>/Dashboard">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                        <div id="collapseTwo" class="collapse pb-1" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header text-gray-900">Kategori :</h6>
                                <a class="collapse-item" href="<?php base_url(); ?>/Dashboard-Transaksi">Dashboard Transaksi</a>
                                <a class="collapse-item" href="<?php base_url(); ?>/Dashboard-Booking">Dashboard Booking</a>
                            </div>
                        </div>
                    </li> -->
                <?php endif; ?>

                <!-- Divider -->
                <hr class="sidebar-divider">
                </hr>

                <?php if (in_groups('user')) : ?>

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Interface
                    </div>

                    <!-- Nav Item - Booking Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-calendar-day"></i>
                            <span>Booking Appointment</span>
                        </a>
                        <div id="collapseOne" class="collapse pb-1" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header text-gray-900">Kategori :</h6>
                                <a class="collapse-item" href="<?php base_url(); ?>/Form-Create-Booking">Book us</a>
                                <a class="collapse-item" href="<?php base_url(); ?>/History-List-Booking">History Booking</a>
                            </div>
                        </div>
                    </li>

                    <!-- Nav Item - Produk Kecantikan Menu -->

                    <li class="nav-item">
                        <a class="nav-link" href="<?php base_url(); ?>/List-Produk">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Buy Product</span>
                        </a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Beauty Product</span>
                        </a>
                        <div id="collapseTwo" class="collapse pb-1" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header text-gray-900">Kategori :</h6>
                                <a class="collapse-item text-gray-900" href="<?php base_url(); ?>/List-Produk">Buy Product</a>
                                <a class="collapse-item text-gray-900" href="<?php base_url(); ?>/List-History-Produk">History Product</a>
                            </div>
                        </div>
                    </li> -->

                    <!-- Nav Item - Jasa Makeup Menu -->

                    <li class="nav-item">
                        <a class="nav-link" href="<?php base_url(); ?>/List-Rent-Services">
                            <i class="fas fa-spray-can"></i>
                            <span>Rent Services</span>
                        </a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            <i class="fas fa-spray-can"></i>
                            <span>Makeup Services</span>
                        </a>
                        <div id="collapseThree" class="collapse pb-1" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header text-gray-900">Kategori :</h6>
                                <a class="collapse-item text-gray-900" href="<?php base_url(); ?>/List-Rent-Services">Rent Services</a>
                                <a class="collapse-item text-gray-900" href="<?php base_url(); ?>/List-History-Makeup">History Rent Services</a>
                            </div>
                        </div>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link" href="<?php base_url(); ?>/List-History-Transaction">
                            <i class="fas fa-history"></i>
                            <span>History Transaction</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" target="_blank" href="<?php base_url(); ?>/List-Rent-Services">
                            <i class="fas fa-spray-can"></i>
                            <span>Makeup Services</span>
                        </a>
                    </li> -->

                <?php elseif (in_groups('manager')) : ?>

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Approval
                    </div>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php base_url(); ?>/Approve-List-Form-CSR">
                            <i class="fas fa-file-signature"></i>
                            <span>Form CSR</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php base_url(); ?>/History-List-Form-CSR">
                            <i class="fas fa-history"></i>
                            <span>History Form CSR</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (in_groups('admin')) : ?>

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Interface
                    </div>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php base_url(); ?>/Admin-List-Transaksi">
                            <i class="fas fa-file-signature"></i>
                            <span>All Transactions</span>
                        </a>
                    </li>

                    <?php if (user_id() == 3) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php base_url(); ?>/Admin-History-List-Form-CSR">
                                <i class="fas fa-history"></i>
                                <span>History Form CSR</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (user_id() == 4) : ?>

                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                <i class="fas fa-cogs"></i>
                                <span>Managements</span>
                            </a>
                            <div id="collapseThree" class="collapse pb-1" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header text-gray-900">Kategori :</h6>
                                    <a class="collapse-item" href="<?= base_url('admin'); ?>">Users Management</a>
                                    <a class="collapse-item" href="<?= base_url('admin/bookings'); ?>">Bookings Management</a>
                                    <a class="collapse-item" href="<?= base_url('admin/products'); ?>">Products Management</a>
                                    <a class="collapse-item" href="<?= base_url('admin/categories'); ?>">Categories Management</a>
                                    <a class="collapse-item" href="<?= base_url('admin/suppliers'); ?>">Suppliers Management</a>
                                    <a class="collapse-item" href="<?= base_url('admin/services'); ?>">Services Management</a>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Support
                </div>

                <!-- Nav Item - Tutorial & Penjelasan -->
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="https://youtu.be/yD6iZcPYOL8">
                        <i class="fas fa-video"></i>
                        <span>Tutorial & Penjelasan</span>
                    </a>
                </li>

                <!-- Nav Item - Whatsapp -->
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="https://api.whatsapp.com/send/?phone=6281288894914">
                        <i class="fab fa-whatsapp fa-lg"></i>
                        <span>Contact Us</span>
                    </a>
                </li>

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center mt-4">
                    <button class="rounded-circle border-0 bg-gradient-oren text-gray-900" id="sidebarToggle"></button>
                </div>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="background-color: #eaeaea;">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-gradient-oren topbar mb-5 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- <h3 class="font-weight-bold text-gray-900 my-auto ml-4">
                    <span class="">Izin Akses Fasilitas Emergency</span>
                </h3> -->

                <!-- <span class="h3 font-weight-bold text-gray-900 my-auto ml-4"><?= $title; ?></span> -->


                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-oren" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <?php if (!in_groups('admin')) : ?>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1 my-auto">
                            <a class="nav-link dropdown-toggle font-weight-bold text-gray-900" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i>
                                <!-- Counter - Messages -->
                                <?php if ($keranjangTotal >= 1) : ?>
                                    <span class="badge badge-merah badge-counter"><?= $keranjangTotal; ?></span>
                                <?php else : ?>
                                <?php endif; ?>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in rounded" aria-labelledby="messagesDropdown">
                                <div class="pt-3 px-3 pb-2 d-flex justify-content-between">
                                    <h6>Keranjang (<?= $keranjangTotal; ?>)</h6>

                                    <?php if ($keranjangTotal >= 1) : ?>
                                        <a href="/Cart" class="text-decoration-none text-oren font-weight-bold">Lihat Sekarang</a>
                                    <?php else : ?>
                                        <p class="text-decoration-none text-oren font-weight-bold">Keranjang Kosong</p>
                                    <?php endif; ?>
                                </div>
                                <hr class="p-0 m-0">
                                <?php if ($keranjangTotal >= 1) : ?>
                                    <div class="overflow-auto" style="height: 25rem;">
                                        <?php foreach ($keranjang as $k) : ?>
                                            <input type="hidden" name="id_produk_keranjang" id="id_produk_keranjang" value="<?= $k['id_produk']; ?>">
                                            <a href="/Cart" class="dropdown-item d-flex align-items-center">
                                                <div class="dropdown-list-image mr-3">
                                                    <img class="rounded-circle" src="<?= base_url(); ?>/img/<?= $k['gambar']; ?>" alt="...">
                                                    <div class="status-indicator bg-success"></div>
                                                </div>
                                                <div class="font-weight-bold">
                                                    <div class="text-truncate h6 text-capitalize"><?= $k['nama']; ?></div>
                                                    <div class="d-flex justify-content-between">
                                                        <button type="button" class="btn p-0 align-middle my-auto" style="font-size: 1.2rem;" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <div class="small text-gray-900 form-group align-middle my-auto mx-3">
                                                            <div class="form-row">
                                                                <div class="form-group col-sm-12 align-middle my-auto">
                                                                    <input type="text" readonly value="<?= $k['jumlah']; ?>" class="form-control form-control-sm rounded-sm text-center" min="1" max="100" maxlength="3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-gray-900 my-1"><?= "Rp" . number_format($k['harga'], 0, ',', '.'); ?></div>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="d-flex align-items-center my-auto align-middle text-center">
                                        <h4 class="text-center p-5">Keranjang Masih Kosong</h4>
                                    </div>
                                <?php endif; ?>
                                <?php if ($keranjangTotal >= 1) : ?>
                                    <!-- <a href="/Order" class="dropdown-item text-gray-900 border"> -->
                                    <a href="/Cart" class="dropdown-item text-gray-900 border">
                                        <div class="d-flex justify-content-between">
                                            <p class="align-middle my-auto mr-3">
                                                <span class="small">Total Dikeranjang : </span>
                                                <br>
                                                <span class="font-weight-bold"><?= $keranjangTotal; ?> Barang</span>
                                            </p>
                                            <button class="btn btn-sm align-middle my-auto px-4 rounded-sm btn-oren">Beli</button>
                                        </div>
                                    </a>
                                <?php else : ?>
                                    <div class="text-gray-900 border p-3">
                                        <div class="d-flex justify-content-between">
                                            <p class="align-middle my-auto mr-3">
                                                <span class="small">Total Dikeranjang : </span>
                                                <br>
                                                <span class="font-weight-bold"><?= $keranjangTotal; ?> Barang</span>
                                            </p>
                                            <button class="btn btn-sm align-middle my-auto px-4 rounded-sm btn-oren">Beli</button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php else : ?>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/msetysan.json" trigger="hover" colors="primary:#000000" style="width:25px;height:25px">
                                </lord-icon>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-merah badge-counter"></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header bg-gradient-oren border-secondary">
                                    Notifications
                                </h6>

                                <a class="dropdown-item d-flex align-items-center" href="/ListPengetahuanDasar/Status/<?= user_id(); ?>">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-secondary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?= date('l, d F Y'); ?></div>
                                        <span class="font-weight-bold">new returned OPL <span class="font-weight-bold text-success">Pengetahuan Dasar</span> is waiting your update!</span>
                                    </div>
                                </a>
                                <p class="mt-3 text-center small text-gray-900 font-weight-bold">There is no OPL to updated yet</p>
                            </div>
                        </li>
                    <?php endif; ?>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow my-auto">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline font-weight-bold text-gray-900 small"><?= user()->fullname; ?></span>
                            <img class="img-profile rounded-circle" src="<?php base_url(); ?>/img/<?= user()->user_image; ?>">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="/view_profile">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-600"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="/change-profile">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-600"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="/change-password">
                                <i class="fas fa-lock mr-2 text-gray-600"></i>
                                Change Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <?= $this->renderSection('page-content'); ?>
                <!-- /.container-fluid -->




            </div>
            <!-- End of Main Content -->
        </div>

    </div>
    <!-- End of Content Wrapper -->
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; elsalon.shop 2023</span>
                <span class="d-flex justify-content-end">V1.0</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <div class="loader-wrapper row align-items-center justify-content-center">
        <div class="loader">
            <div class="loadingio-spinner-pulse-lnfzrh0t7il">
                <div class="ldio-wsvc9404z3i">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <span>Loading...</span>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded-circle" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded">
                <button class="close d-flex justify-content-end mt-3 mr-3" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <img class="img-profile rounded-circle mx-auto d-block w-25" src="<?php base_url(); ?>/img/logout.gif">
                <div class="modal-body h4 text-center mb-0 font-weight-bold text-gray-900">Ready to Leave?</div>
                <h6 class="text-center mt-0 mb-4">You are going to logout from here</h6>
                <a class="btn btn-danger py-2 rounded mx-5 mt-2" href="<?= base_url('logout'); ?>">Yes, Logout</a>
                <button class="btn text-danger border-0 py-2 rounded mx-5 mt-2 mb-4" type="button" data-dismiss="modal">Keep Login</button>
            </div>
        </div>
    </div>

    <!-- MODAL PROMO CART ATAU KERANJANG -->
    <div class="modal fade" id="modalPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded text-gray-900">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Pakai Promo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded-sm" id="message-text" placeholder="Masukan kode promo"></input>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-oren text-center rounded-sm font-weight-bold ml-3">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php base_url(); ?>/js/script.js"></script>
    <script src="<?php base_url(); ?>/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="<?php base_url(); ?>/js/sweetalert2.min.css">

    <!-- Bootstrap core JavaScript-->
    <script src="<?php base_url(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php base_url(); ?>/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php base_url(); ?>/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php base_url(); ?>/js/demo/chart-area-demo.js"></script>
    <script src="<?php base_url(); ?>/js/demo/chart-pie-demo.js"></script>
    <script src="<?php base_url(); ?>/js/demo/chart-bar-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>

    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="<?php base_url(); ?>/js/myalert.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js" integrity="sha512-01CJ9/g7e8cUmY0DFTMcUw/ikS799FHiOA0eyHsUWfOetgbx/t6oV4otQ5zXKQyIrQGTHSmRVPIgrgLcZi/WMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/g/filesaver.js"></script>
    <!-- SMOOTH SCROLL -->
    <script src="<?php base_url(); ?>/js/smooth-scroll.js"></script>

    <script>
        $(document).ready(function() {
            $("#downloadTransaksi").click(function() {
                domtoimage.toBlob(document.getElementById('contentTransaksi')).then(function(blob) {
                    window.saveAs(blob, "Bukti-Transaksi-EL-Salon.png")
                })
                let timerInterval
                Swal.fire({
                    title: 'Downloading Content...',
                    html: 'Loading in <b></b> milliseconds.',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('Closed by the timer')
                    }
                })
            })
        })
    </script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <!-- <script>
        $(document).ready(function() {
            $('#distribusi').change(function(e) {
                var distribusi = $("#distribusi").val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Users/distribusiUsers'); ?>",
                    data: {
                        distribusi: distribusi
                    },
                    success: function(response) {
                        $("#users").html(response);
                    }
                })
            })
        });
    </script> -->

    <script>
        const tombolError = document.querySelector('#tombolError');
        tombolError.addEventListener('click', function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data CSR Yang Akan di Export Masih Kosong',
                showConfirmButton: false,
                timer: 2500,
                customClass: 'animated tada rounded-md'
            });
        });
    </script>
    <script>
        const tombolSuccess = document.querySelector('#tombolSuccess');
        tombolSuccess.addEventListener('click', function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data CSR Yang Akan di Export Masih Kosong',
                showConfirmButton: false,
                timer: 2500,
                customClass: 'animated tada rounded-md'
            });
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', 'nav ol li', function() {
            $(this).addClass('active bg-success rounded-sm px-2').siblings().removeClass('active bg-success rounded-sm px-2')
        })
    </script>

    <?php for ($i = 1; $i <= 10; $i++) : ?>
        <script>
            function preview_sebelum<?= $i; ?>() {
                counter += 1;
                const foto_sebelum = document.querySelector('#foto_sebelum<?= $i; ?>');
                const foto_sebelum_label = document.querySelector('#label_sebelum<?= $i; ?>');
                const foto_sebelum_preview = document.querySelector('.sebelum-preview<?= $i; ?>');

                foto_sebelum_label.textContent = foto_sebelum.files[0].name;

                const file_foto_sebelum = new FileReader();
                file_foto_sebelum.readAsDataURL(foto_sebelum.files[0]);

                file_foto_sebelum.onload = function(e) {
                    foto_sebelum_preview.src = e.target.result;
                }
            }
        </script>
    <?php endfor; ?>
    <script>
        function preview_sesudah() {
            const foto_sesudah = document.querySelector('#foto_sesudah');
            const foto_sesudah_label = document.querySelector('#label_sesudah');
            const foto_sesudah_preview = document.querySelector('.sesudah-preview');

            foto_sesudah_label.textContent = foto_sesudah.files[0].name;

            const file_foto_sesudah = new FileReader();
            file_foto_sesudah.readAsDataURL(foto_sesudah.files[0]);

            file_foto_sesudah.onload = function(e) {
                foto_sesudah_preview.src = e.target.result;
            }
        }
    </script>
    <script>
        function preview_foto3() {
            const foto3 = document.querySelector('#foto3');
            const foto3_label = document.querySelector('#label_foto3');
            const foto3_preview = document.querySelector('.foto3-preview');

            foto3_label.textContent = foto3.files[0].name;

            const file_foto3 = new FileReader();
            file_foto3.readAsDataURL(foto3.files[0]);

            file_foto3.onload = function(e) {
                foto3_preview.src = e.target.result;
            }
        }
    </script>
    <script>
        function preview_gambar() {
            const gambar = document.querySelector('#gambar');
            const gambar_label = document.querySelector('#label_gambar');
            const gambar_preview = document.querySelector('#img-preview');

            gambar_label.textContent = gambar.files[0].name;

            const file_gambar = new FileReader();
            file_gambar.readAsDataURL(gambar.files[0]);

            file_gambar.onload = function(e) {
                gambar_preview.src = e.target.result;
            }
        }
    </script>
    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
        });
    </script>

</body>

</html>