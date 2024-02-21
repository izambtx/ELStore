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
                                No. CSR
                            </td>
                            <td scope="col" class="align-middle border-abu border-left font-weight-bold border-top-0 py-1">
                                <?= $csr['csr_no']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="col" class="align-middle text-right border-abu border-right border-left font-weight-bold py-1">
                                Nama
                            </td>
                            <td scope="col" class="align-middle border-abu border-left font-weight-bold py-1">
                                <?= $csr['fullname']; ?>
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
                                <?= $csr['nama_bagian']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="max-width:5rem;" scope="col" class="align-middle text-left border-abu border-bottom border-right font-weight-bold py-1 pl-3">
                                Tema Improvement Cost Saving yang dilakukan
                            </td>
                            <td scope="col" colspan="3" class="align-middle border-abu border-bottom border-left font-weight-bold py-1">
                                <?= $csr['tema']; ?>
                            </td>
                        </tr>
                    </tbody>
                    <?php if ($csr['returned_at'] != null || $csr['rejected_at'] != null) : ?>
                        <tfoot>
                            <tr>
                                <td class="border border-abu border-left-0 align-middle">
                                    Alasan :
                                </td>
                                <td colspan="3" class="border border-abu align-middle" style="max-width: 30rem;">
                                    <?= $csr['alasan']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-abu border-left-0 align-middle">
                                    <?php if ($csr['returned_at']) : ?>
                                        Returned :
                                    <?php elseif ($csr['rejected_at']) : ?>
                                        Rejected :
                                    <?php endif; ?>
                                </td>
                                <td colspan="3" class="border border-abu align-middle">
                                    <?php if ($csr['returned_at']) : ?>
                                        <?= $csr3['fullname']; ?> - <?= date('d F Y h:i:s', strtotime($csr['returned_at'])); ?>
                                    <?php elseif ($csr['rejected_at']) : ?>
                                        <?= $csr4['fullname']; ?> - <?= date('d F Y h:i:s', strtotime($csr['rejected_at'])); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            </div>

            <div class="d-flex justify-content-around border border-top-0 border-abu">

                <div class="mb-5 mx-4 container">
                    <h5 class="text-gray-900 font-weight-bold mt-5">Sebelum Perbaikan</h5>
                    <i>(Jelaskan kondisi sebelum perbaikan)</i>
                    <p class="mb-4 mx-auto card-text text-justify text-gray-900 border border-abu rounded p-3">
                        <?= nl2br($csr['sebelum']); ?>
                    </p>
                </div>
            </div>

            <div class="d-flex justify-content-around border border-top-0 border-abu">

                <div class="container mb-5 mx-4">
                    <h5 class="text-gray-900 font-weight-bold mt-5">Sesudah Perbaikan</h5>
                    <i>(Jelaskan kondisi sesudah perbaikan)</i>
                    <p class="mb-4 mx-auto card-text text-justify text-gray-900 border border-abu rounded p-3">
                        <?= nl2br($csr['sesudah']); ?>
                    </p>
                </div>
            </div>

            <div class="d-flex justify-content-around border border-top-0 border-abu">

                <div class="container mb-5 mx-4">
                    <h5 class="text-gray-900 text-left font-weight-bold m-3 mt-5">Perhitungan Cost Saving</h5>
                    <div class="mb-4 mx-auto card-text text-justify text-gray-900 border border-abu rounded p-3">
                        <p><?= nl2br($csr['perhitungan']); ?></p>
                        <h6 class="text-gray-900 text-left font-weight-bold mt-5">Total Cost Saving</h6>
                        <p><?= "Rp " . number_format($csr['total'], 2, ',', '.'); ?></p>
                        <h6 class="text-gray-900 text-left font-weight-bold mt-5">Lampiran File Pendukung</h6>
                        <?php if ($csr['file']) : ?>
                            <a download="" class="text-primary" href="<?= base_url() ?>/file/<?= $csr['file']; ?>" data-toggle="tooltip" data-placement="left" title="Click to download">
                                <i class="fas fa-download"></i> &nbsp;<?= $csr['file']; ?>
                            </a>
                        <?php else : ?>
                            <i class="text-gray-600">Tidak ada file pendukung yang dilampirkan</i>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


            <h5 class="mt-4 text-gray-900 ">Lampiran Gambar : </h5>
            <div class="row my-5">
                <?php $x = 1; ?>
                <?php foreach ($foto_csr as $foto) : ?>
                    <?php if ($foto['nama_foto'] == 'default.jpg') : ?>
                    <?php else : ?>
                        <div class="col-sm-3 d-flex flex-wrap align-items-center mx-auto d-block">
                            <div class="card border-0 col-sm-12">
                                <img class="card-img-top img-fluid rounded p-0 m-0" style="object-fit: contain; height: 250px;" src="/img/<?= $foto['nama_foto'];  ?>" alt="Foto Trouble Shooting">
                                <div class="card-block">
                                    <h4 class="mt-4 text-center card-title font-weight-bold text-gray-900">Gambar <?= $x++; ?>.</h4>
                                    <p class="card-text text-center text-gray-900"><?= $foto['keterangan'];  ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="px-5 mb-5">
                <table class="table table-bordered text-gray-900 my-auto">
                    <tbody>
                        <tr>
                            <td colspan="2" rowspan="3" class="w-50 text-left">
                                <span class="font-weight-bold text-gray-900">Catatan : </span>
                                <span class=" text-gray-900"><?= nl2br($csr['catatan']); ?></span>
                            </td>
                            <td rowspan="3">
                                <span class="font-weight-bold text-gray-900">Dibuat Oleh</span>
                                <br>
                                <br>
                                <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($csr['created_at'])); ?></small>
                                <br>
                                <small class="font-weight-bold text-success"><?= date('H : i', strtotime($csr['created_at'])); ?></small>
                                <br>
                                <br>
                                <span class="font-weight-bold text-gray-900"><?= $csr['username']; ?></span>
                            </td>
                            <td rowspan="3">
                                <span class="font-weight-bold text-gray-900">Disetujui Oleh</span>
                                <?php if ($csr['status'] == 'Created' || $csr['status'] == 'Updated') : ?>
                                    <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                    <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                    <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                <?php elseif ($csr['status'] == 'Returned') : ?>
                                    <br>
                                    <br>
                                    <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                <?php elseif ($csr['status'] == 'Rejected') : ?>
                                    <br>
                                    <br>
                                    <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                <?php else : ?>
                                    <br>
                                    <br>
                                    <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($csr['approved_at'])); ?></small>
                                    <br>
                                    <small class="font-weight-bold text-success"><?= date('H : i', strtotime($csr['approved_at'])); ?></small>
                                    <br>
                                    <br>
                                    <span class="font-weight-bold text-gray-900"><?= $csr2['username']; ?></span>
                                <?php endif; ?>
                            </td>
                            <td rowspan="3">
                                <span class="font-weight-bold text-gray-900">Diperiksa Oleh</span>
                                <?php if ($csr['status'] == 'Approved' && $csr['approved_at']) : ?>
                                    <br>
                                    <br>
                                    <br>
                                    <h4 class="font-weight-bold text-gray-900">NA</h4>
                                <?php elseif ($csr['status'] == 'Returned FA') : ?>
                                    <br>
                                    <br>
                                    <span class="badge badge-warning p-2 font-weight-bold rotate-n-15 mt-3 mb-3">RETURNED</span>
                                <?php elseif ($csr['status'] == 'Rejected FA') : ?>
                                    <br>
                                    <br>
                                    <span class="badge badge-danger p-2 font-weight-bold rotate-n-15 mt-3 mb-3">REJECTED</span>
                                <?php else : ?>
                                    <?php if ($csr['checked_at']) : ?>
                                        <br>
                                        <br>
                                        <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($csr['checked_at'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-success"><?= date('H : i', strtotime($csr['checked_at'])); ?></small>
                                        <br>
                                        <br>
                                        <span class="font-weight-bold text-gray-900"><?= $csr5['username']; ?></span>
                                    <?php else : ?>
                                        <br>
                                        <br>
                                        <br>
                                        <h4 class="font-weight-bold text-gray-900">NA</h4>
                                    <?php endif; ?>
                                <?php endif; ?>
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

<!-- Start of Modal -->

<!-- Return Modal -->
<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-md">
            <div class="modal-header bg-warning rounded-top-lg">
                <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Return Cost Saving Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/img/caution.gif" class="w-25 mx-auto d-block">
                    <h4 class="text-center font-weight-bold text-gray-900">Sure Want To Return This CSR?</h4>
                    <h6 class="small text-center text-gray-900">Make Sure The Data is Correct!</h6>

                    <form action="/Detail-Form-CSR/return/<?= $csr['id']; ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group row mb-0 mt-5">
                            <label for="alasanReturn" class="col-sm-4 col-form-label">Reason Return </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" autofocus required id="alasanReturn" name="alasanReturn"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="returnopl" class="col-sm-4 col-form-label">Returned By </label>
                            <div class="col-sm-8">
                                <p class="form-control font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning px-4 mx-2 mt-5">Return</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-md">
            <div class="modal-header bg-danger rounded-top-lg">
                <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Reject Cost Saving Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/img/reject.gif" class="w-25 mx-auto d-block">
                    <h4 class="text-center font-weight-bold text-gray-900">Sure Want To Reject This CSR?</h4>
                    <h6 class="small text-center text-gray-900">Make Sure The Data is Correct!</h6>

                    <form action="/Detail-Form-CSR/reject/<?= $csr['id']; ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group row mb-0 mt-5">
                            <label for="alasanReject" class="col-sm-4 col-form-label">Reason Reject </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" autofocus required id="alasanReject" name="alasanReject"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="rejectopl" class="col-sm-4 col-form-label">Rejected By </label>
                            <div class="col-sm-8">
                                <p class="form-control font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger px-4 mx-2 mt-5">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Aprrove Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-md">
            <div class="modal-header bg-success rounded-top-lg">
                <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Approve Cost Saving Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/img/sending.gif" class="w-25 mx-auto d-block">
                    <h4 class="text-center font-weight-bold text-gray-900">Sure Want To Approve This CSR?</h4>
                    <h6 class="small text-center text-gray-900">Make Sure The Data Below is Correct</h6>

                    <form action="/Detail-Form-CSR/approve/<?= $csr['id']; ?>" method="post">
                        <?= csrf_field();  ?>
                        <div class="form-group row mb-1 mt-5">
                            <label for="nama" class="col-sm-4 col-form-label">Tema Project </label>
                            <div class="col-sm-8">
                                <p id="nama" name="nama" class="form-control font-weight-bold text-gray-900 border-0 bg-white"><?= $csr['tema']; ?></p>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="noCsr" class="col-sm-4 col-form-label">CSR No. </label>
                            <div class="col-sm-8">
                                <input type="text" id="noCsr" name="noCsr" readonly value="<?= $countCsrNo + 1; ?>/CS/<?= date("M"); ?><?= date("Y"); ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="namaApprove" class="col-sm-4 col-form-label">Approver </label>
                            <div class="col-sm-8">
                                <p id="namaApprove" name="namaApprove" class="form-control font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="catatan" class="col-sm-4 col-form-label">Catatan </label>
                            <div class="col-sm-8">
                                <textarea rows="3" id="catatan" name="catatan" class="form-control font-weight-bold text-gray-900"></textarea>
                            </div>
                        </div>
                        <input type="hidden" class="border-0 d-block" value="TRUE" id="statusrealisasi" name="statusrealisasi">
                        <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" id="tglapprove" name="tglapprove"></input>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-4 mx-2 mt-5">Approve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Detail Status Modal -->

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-md">
            <div class="modal-header">
                <h5 class="modal-title mt-1 ml-2" id="staticBackdropLabel">Detail Status</h5>
                <button type="button" class="close rounded-modal-x" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover text-center text-gray-900 mb-5">
                    <thead>
                        <tr class="font-weight-bold">
                            <td scope="col">#</td>
                            <td scope="col">Nama</td>
                            <td scope="col">Status</td>
                            <td scope="col">Catatan</td>
                            <td scope="col">Tanggal</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($detail_status as $s) : ?>
                            <tr>
                                <td class="align-middle" scope="row"><?= $i++; ?></td>
                                <td class="align-middle"><?= $s['username']; ?></td>
                                <?php if ($s['status'] == 'Created') : ?>
                                    <td class="align-middle"><span class="badge badge-primary"><?= $s['status'];  ?></span></td>
                                <?php elseif ($s['status'] == 'Updated') : ?>
                                    <td class="align-middle"><span class="badge badge-secondary"><?= $s['status'];  ?></span></td>
                                <?php elseif ($s['status'] == 'Approved') : ?>
                                    <td class="align-middle"><span class="badge badge-info"><?= $s['status'];  ?></span></td>
                                <?php elseif ($s['status'] == 'Done') : ?>
                                    <td class="align-middle"><span class="badge badge-success"><?= $s['status'];  ?></span></td>
                                <?php elseif ($s['status'] == 'Returned MGR' || $s['status'] == 'Returned FA') : ?>
                                    <td class="align-middle"><span class="badge badge-warning"><?= $s['status'];  ?></span></td>
                                <?php elseif ($s['status'] == 'Rejected MGR' || $s['status'] == 'Rejected FA') : ?>
                                    <td class="align-middle"><span class="badge badge-danger"><?= $s['status'];  ?></span></td>
                                <?php endif; ?>
                                <td class="align-middle" style="max-width: 15rem;">
                                    <?php if (empty($s['catatan'])) : ?>
                                        ~
                                    <?php else : ?>
                                        <?= $s['catatan']; ?>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle">
                                    <?php if (empty($s['created_at'])) : ?>
                                        ~
                                    <?php else : ?>
                                        <?= date('d M Y', strtotime($s['created_at'])); ?>
                                        <?= date('H : i : s', strtotime($s['created_at'])); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- End Of Modal -->

<?= $this->endSection(); ?>