<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card text-gray-900 shadow">

                <!-- Page Heading -->
                <div class="card-body">
                    <div class="text-center mt-5">
                        <h3 class="section-heading text-uppercase"><b><?= $title; ?></b></h3>
                        <h6 class="section-subheading text-capitalize">experience our makeup services with a ease of customization</h6>
                    </div>
                    <div class="row">
                        <?php $i = 1; ?>
                        <div class="col-sm-6 mt-5">
                            <div class="card">
                                <div class="card-img-top">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active" data-interval="3000">
                                                <img src="img/wedding_1.JPG" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item" data-interval="3000">
                                                <img src="img/wedding_2.JPG" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item" data-interval="3000">
                                                <img src="img/wedding_3.JPG" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item" data-interval="3000">
                                                <img src="img/wedding_4.JPG" class="d-block w-100" alt="...">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Wedding</h4>
                                    <p class="card-text">Jasa makeup wedding adalah layanan profesional yang mencakup periasan khusus untuk calon pengantin pada hari pernikahan, termasuk desain tata rias wajah yang disesuaikan dengan gaya dan preferensi mereka.</p>
                                </div>
                                <div class="accordion" id="accordionExample">
                                    <?php foreach ($wedding as $w) : ?>
                                        <?php $j = $i++; ?>
                                        <div class="card rounded-0">
                                            <div class="card-header bg-white rounded-0 border-0" id="headingOne">
                                                <h6 class="mb-0">
                                                    <a href="#collapseCard<?= $j; ?>" class="d-block text-decoration-none py-1 bg-white text-gray-900" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardOne">
                                                        <div class="d-flex justify-content-between mx-3">
                                                            <b class="text-capitalize"><?= $w['nama']; ?></b>
                                                            <i class="fas fa-angle-down"></i>
                                                        </div>
                                                    </a>
                                                </h6>
                                            </div>

                                            <div class="collapse" id="collapseCard<?= $j; ?>">
                                                <hr class="mx-5 my-0">
                                                <div class="card-body">
                                                    <p>
                                                        <span class="align-middle ml-2"><?= $w['deskripsi']; ?></span>
                                                    </p>
                                                    <!-- <form action="/Create-Rent-Services/Cart/<?= $w['id']; ?>" method="post"> -->
                                                    <input type="hidden" name="id_paket" value="<?= $w['id']; ?>">
                                                    <a href="/Konfirmasi/<?= $w['id']; ?>" class="card-link btn btn-outline-oren pt-1 px-4 ml-2">
                                                        Pesan Sekarang
                                                    </a>
                                                    <!-- </form> -->
                                                    <!-- <a href="/Create-Rent-Services/Customize-Service" class="card-link btn btn-primary ml-1">Customize Package</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-5">
                            <div class="card">
                                <div class="card-img-top">
                                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                                            <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                                            <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                                            <li data-target="#carouselExampleIndicators2" data-slide-to="3"></li>
                                            <li data-target="#carouselExampleIndicators2" data-slide-to="4"></li>
                                            <li data-target="#carouselExampleIndicators2" data-slide-to="5"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active" data-interval="3000">
                                                <img src="img/graduation_1.JPG" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item" data-interval="3000">
                                                <img src="img/graduation_2.JPG" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item" data-interval="3000">
                                                <img src="img/graduation_3.JPG" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item" data-interval="3000">
                                                <img src="img/graduation_4.JPG" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item" data-interval="3000">
                                                <img src="img/graduation_5.JPG" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item" data-interval="3000">
                                                <img src="img/graduation_6.JPG" class="d-block w-100" alt="...">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators2  " role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Graduation</h4>
                                    <p class="card-text">Jasa makeup graduation adalah layanan profesional untuk merias wajah dan rambut individu dalam acara perayaan kelulusan agar tampil sempurna di momen istimewa tersebut.</p>
                                </div>
                                <div class="accordion mt-4" id="accordionExample">
                                    <?php foreach ($graduation as $g) : ?>
                                        <?php $j = $i++; ?>
                                        <div class="card rounded-0">
                                            <div class="card-header bg-white rounded-0 border-0" id="headingFour">
                                                <h6 class="mb-0">
                                                    <a href="#collapseCard<?= $j; ?>" class="d-block text-decoration-none py-1 bg-white text-gray-900" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard<?= $j; ?>">
                                                        <div class="d-flex justify-content-between mx-3">
                                                            <b class="text-capitalize"><?= $g['nama']; ?></b>
                                                            <i class="fas fa-angle-down"></i>
                                                        </div>
                                                    </a>
                                                </h6>
                                            </div>

                                            <div class="collapse" id="collapseCard<?= $j; ?>">
                                                <hr class="mx-5 my-0">
                                                <div class="card-body">
                                                    <p>
                                                        <span class="align-middle ml-2"><?= $g['deskripsi']; ?></span>
                                                    </p>
                                                    <!-- <form action="/Create-Rent-Services/Cart/<?= $g['id']; ?>" method="post"> -->
                                                    <input type="hidden" name="id_paket" value="<?= $g['id']; ?>">
                                                    <a href="/Konfirmasi/<?= $g['id']; ?>" class="card-link btn btn-outline-oren pt-1 px-4 ml-2">
                                                        Pesan Sekarang
                                                    </a>
                                                    <!-- </form> -->
                                                    <!-- <a href="/Create-Rent-Services/Customize-Service" class="card-link btn btn-primary ml-1">Customize Package</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>