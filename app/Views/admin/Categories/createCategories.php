<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center align-middle">

        <div class=" col-md-6">

            <div class="rounded-md o-hidden border-0 shadow-lg mb-5">
                <div class=" p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row-register">
                        <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                        <div class="col-lg-12">
                            <div class="px-5 pt-5 pb-3 my-4">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900 font-weight-bold">Create</h1>
                                    <hr class="my-2 mx-5">
                                    <small class="small font-weight-bold text-gray-900">Create Category of Product / Makeup Services</small>
                                </div>

                                <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

                                <form class="user" action="<?= base_url() ?>/admin/save/categories" method="post">
                                    <?= csrf_field() ?>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user rounded <?php if (session('validation.nama')) : ?>is-invalid<?php endif ?>" name="nama" id="nama" placeholder="Nama" autofocus>
                                        <div class="invalid-feedback">
                                            <?= session('validation.nama') ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="font-weight-bold btn btn-success btn-user btn-block">
                                        Save
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>