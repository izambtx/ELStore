<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <!-- Content Card -->
    <div class="card text-center shadow">
        <div id="contentCSR" class="bg-white rounded">
            <div class="table-responsive">
                <table class="table text-gray-900 my-auto">
                    <tbody>
                        <tr>
                            <td scope="col" rowspan="5" class="align-middle text-left pl-5 border-abu border-right border-top-0">
                                <img src="/img/kalbe.png" width="150" height="60" alt="">
                            </td>
                            <td scope="col" rowspan="5" class="align-middle border-abu border-right border-left border-top-0">
                                <h3 class="font-weight-bold my-auto">Cost Saving Report</h3>
                            </td>
                        </tr>
                        <tr>
                            <td scope="col" class="align-middle text-right border-abu border-right border-left border-top-0 font-weight-bold py-1">
                                No. Booking
                            </td>
                            <td scope="col" class="align-middle border-abu border-left font-weight-bold border-top-0 py-1">

                            </td>
                        </tr>
                        <tr>
                            <td scope="col" class="align-middle text-right border-abu border-right border-left font-weight-bold py-1">
                                Nama
                            </td>
                            <td scope="col" class="align-middle border-abu border-left font-weight-bold py-1">

                            </td>
                        </tr>
                        <tr>
                            <td scope="col" class="align-middle text-right border-abu border-right border-left font-weight-bold py-1">
                                NIK
                            </td>
                            <td scope="col" class="align-middle border-abu border-left font-weight-bold py-1">
                                <?= user()->NIK; ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="col" class="align-middle text-right border-abu border-right border-left font-weight-bold py-1">
                                Bagian
                            </td>
                            <td scope="col" class="align-middle border-abu border-left font-weight-bold py-1">

                            </td>
                        </tr>
                        <tr>
                            <td style="max-width:5rem;" scope="col" class="align-middle text-left border-abu border-bottom border-right font-weight-bold py-1 pl-3">
                                Tema Improvement Cost Saving yang dilakukan
                            </td>
                            <td scope="col" colspan="3" class="align-middle border-abu border-bottom border-left font-weight-bold py-1">

                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <div class="d-flex justify-content-around border border-top-0 border-abu">

                <div class="mb-5 mx-4 container">
                    <h5 class="text-gray-900 font-weight-bold mt-5">Sebelum Perbaikan</h5>
                    <i>(Jelaskan kondisi sebelum perbaikan)</i>
                    <p class="mb-4 mx-auto card-text text-justify text-gray-900 border border-abu rounded p-3">

                    </p>
                </div>
            </div>

            <div class="d-flex justify-content-around border border-top-0 border-abu">

                <div class="container mb-5 mx-4">
                    <h5 class="text-gray-900 font-weight-bold mt-5">Sesudah Perbaikan</h5>
                    <i>(Jelaskan kondisi sesudah perbaikan)</i>
                    <p class="mb-4 mx-auto card-text text-justify text-gray-900 border border-abu rounded p-3">

                    </p>
                </div>
            </div>

            <div class="d-flex justify-content-around border border-top-0 border-abu">

                <div class="container mb-5 mx-4">
                    <h5 class="text-gray-900 text-left font-weight-bold m-3 mt-5">Perhitungan Cost Saving</h5>
                    <div class="mb-4 mx-auto card-text text-justify text-gray-900 border border-abu rounded p-3">
                        <p></p>
                        <h6 class="text-gray-900 text-left font-weight-bold mt-5">Total Cost Saving</h6>
                        <p></p>
                        <h6 class="text-gray-900 text-left font-weight-bold mt-5">Lampiran File Pendukung</h6>
                    </div>
                </div>
            </div>

            <h5 class="mt-4 text-gray-900 ">Lampiran Gambar : </h5>

            <div class="px-5 mb-5">
                <table class="table table-bordered text-gray-900 my-auto">
                    <tbody>
                        <tr>
                            <td colspan="2" rowspan="3" class="w-50 text-left">
                                <span class="font-weight-bold text-gray-900">Catatan : </span>
                                <span class=" text-gray-900"></span>
                            </td>
                            <td rowspan="3">
                                <span class="font-weight-bold text-gray-900">Dibuat Oleh</span>
                                <br>
                                <br>
                                <small class="font-weight-bold text-success"></small>
                                <br>
                                <small class="font-weight-bold text-success"></small>
                                <br>
                                <br>
                                <span class="font-weight-bold text-gray-900"></span>
                            </td>
                            <td rowspan="3">
                                <span class="font-weight-bold text-gray-900">Disetujui Oleh</span>
                                <br>
                                <br>
                                <br>
                                <h4 class="font-weight-bold text-gray-900">NA</h4>
                            </td>
                            <td rowspan="3">
                                <span class="font-weight-bold text-gray-900">Diperiksa Oleh</span>
                                <br>
                                <br>
                                <br>
                                <h4 class="font-weight-bold text-gray-900">NA</h4>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-auto mb-5">
            <button id="downloadCSR" class="download-button">
                <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line y2="13" x2="8" y1="13" x1="16"></line>
                        <line y2="17" x2="8" y1="17" x1="16"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg> Download .PNG</div>
                <div class="download">
                    <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line y2="3" x2="12" y1="15" x1="12"></line>
                    </svg>
                </div>
            </button>
            <button class="button-status" data-toggle="modal" data-target="#staticBackdrop">
                Detail Status
            </button>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>