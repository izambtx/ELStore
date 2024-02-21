<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="card p-5 text-gray-900">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <h5 class="mt-5 bg-primary text-white p-3">Listed</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <div class="d-flex justify-content-between px-5">
                    <p class=" align-middle my-auto">1. Cras justo odio</p>
                    <button class="btn btn-outline-danger align-middle my-auto"><i class="fas fa-times"></i></button>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between px-5">
                    <p class=" align-middle my-auto">2. Dapibus ac facilisis in</p>
                    <button class="btn btn-outline-danger align-middle my-auto"><i class="fas fa-times"></i></button>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between px-5">
                    <p class=" align-middle my-auto">3. Vestibulum at eros</p>
                    <button class="btn btn-outline-danger align-middle my-auto"><i class="fas fa-times"></i></button>
                </div>
            </li>
        </ul>
        <h5 class="mt-5 bg-abu p-3">Unlisted</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <div class="d-flex justify-content-between px-5">
                    <p class=" align-middle my-auto">1. Cras justo odio</p>
                    <button class="btn btn-outline-primary align-middle my-auto"><i class="fas fa-plus"></i></button>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between px-5">
                    <p class=" align-middle my-auto">2. Dapibus ac facilisis in</p>
                    <button class="btn btn-outline-primary align-middle my-auto"><i class="fas fa-plus"></i></button>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between px-5">
                    <p class=" align-middle my-auto">3. Vestibulum at eros</p>
                    <button class="btn btn-outline-primary align-middle my-auto"><i class="fas fa-plus"></i></button>
                </div>
            </li>
        </ul>
        <div class="card-body d-flex justify-content-center mt-5">
            <a href="https://api.whatsapp.com/send/?phone=6281288894914" target="_blank" class="card-link btn btn-outline-primary rounded-sm align-middle my-auto"><i class="fab fa-whatsapp"></i></a>
            <a href="#" class="card-link btn btn-outline-primary rounded-sm ml-3 px-5 py-2">Add To Cart</i></a>
            <a href="#" class="card-link btn btn-primary ml-3 px-5 py-2 rounded-sm">Buy Directly Now</a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>