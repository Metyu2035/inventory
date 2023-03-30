<div class="content-wrapper">

    <div class="content-header">

        <!-- Notifikasi bila terdapat error -->
        <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                PERHATIAN !!!
                <div class="col-12">
                    <?php echo session()->getFlashdata('error'); ?>
                    <?php echo session()->remove('error'); ?>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <!-- Notifikasi bila terdapat pesan -->
        <?php if (!empty(session()->getFlashdata('pesan'))) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="col-12">
                    <strong>
                        <?php echo session()->getFlashdata('pesan'); ?>
                    </strong>
                    <?php echo session()->remove('pesan'); ?>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="text-center col-12">
                    <h1 class="text-bold">
                        <i style="color: #06283d;" class="nav-icon fas fa-file-export"></i> <?= $laporanmasuk ?>
                    </h1>
                </div>

            </div>
            <hr>

            <div class="row mb-2">
                <div class="col-12">
                    <div class="card m-4">
                        <div class="card-header text-center" style="background-color: #06283d;">
                            <h4 style="font-weight: bold; color: white;">FORM LAPORAN BARANG KELUAR</h4>
                        </div>
                        <form action="<?= base_url('laporan/laporanKeluar') ?>" target="_blank" method="post">
                            <div class="card-body">
                                <div class="row">

                                    <!-- Input Tanggal Awal -->
                                    <div class="col-6">
                                        <h5 style="font-weight: bold;">Tanggal Awal :</h5>
                                        <div class="input-group mb-3">
                                            <input type="date" name="tanggalAwal" class="form-control">
                                            <div class="input-group-append">
                                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                                    <span class="fas fa-calendar"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Input Tanggal Akhir -->
                                    <div class="col-6">
                                        <h5 style="font-weight: bold;">Tanggal Akhir :</h5>
                                        <div class="input-group mb-3">
                                            <input type="date" name="tanggalAkhir" class="form-control">
                                            <div class="input-group-append">
                                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                                    <span class="fas fa-calendar"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row justify-content-end mt-4">
                                    <button type="submit" name="tombolPrint" class="btn btn-primary mr-2">
                                        <span class="fas fa-print"></span>
                                        <strong> PRINT LAPORAN</strong>
                                    </button>
                                    <button type="submit" name="tombolExcel" class="btn btn-success mr-2">
                                        <span class="far fa-file-excel"></span>
                                        <strong> EXCEL LAPORAN</strong>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

        </div>
    </section>

</div>