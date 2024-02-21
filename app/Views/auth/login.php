<?php $this->extend('auth/template/index'); ?>

<?php $this->section('content'); ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="rounded-md o-hidden border-0 shadow-lg my-5">
                <div class="p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row row-custom">
                        <div class="col-lg-12">
                            <div class="p-5 mt-4">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900 font-weight-bold"><?= lang('Auth.loginTitle') ?></h1>
                                    <hr class="my-2 mx-5">
                                    <small class="font-weight-bold text-gray-900">Login With a Registered NIK</small>
                                </div>

                                <?= view('Myth\Auth\Views\_message_block') ?>

                                <form class="user" action="<?= url_to('login') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light rounded-left border-right-0" id="basic-addon1">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control bg-light border-left-0 border-right-0 rounded-right form-control-user <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="NIK" aria-label="login" aria-describedby="basic-addon1">
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>

                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <button type="button" class="input-group-text rounded-left border-right-0 bg-abu text-dark" id="basic-addon1" onclick="showPassword()">
                                                <i id="eye" class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <input type="password" class="form-control bg-light border-left-0 border-right-0 rounded-right form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" id="password" placeholder="<?= lang('Auth.password') ?>" aria-label="password" aria-describedby="basic-addon1">
                                        <div class="invalid-feedback">
                                            <?= session('errors.password') ?>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-dark btn-user btn-block font-weight-bold">
                                        LOGIN
                                    </button>
                                </form>
                                <div class="text-center mt-3">
                                    <p class="m-0">
                                        <a class="small font-weight-bold text-gray-900" href="<?= url_to('register') ?>">
                                            Don't Have an Account? Sign Up
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        function showPassword() {
            var x = document.getElementById("password");
            var y = document.getElementById("eye");
            if (x.type === "password" && y.className === "fas fa-eye") {
                x.type = "text";
                y.className = "fas fa-eye-slash";
            } else {
                x.type = "password";
                y.className = "fas fa-eye";
            }
        }
    </script>

    <?php $this->endSection(); ?>