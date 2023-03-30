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
                    <h1 class="text-bold"><i style="color: #06283d;" class="nav-icon fas fa-chalkboard-teacher"></i> Dashboard <?= session('jabatan') ?></h1>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php if (session('level') == 101) : ?>
                    <!-- Card Pengguna -->
                    <div class="col-lg-4 col-6">
                        <div class="small-box" style="background-color: #2D4059;">
                            <div class="inner">
                                <h4 style="font-weight: bold; color: white;">PENGGUNA</h4>
                                <p style="font-weight: bold;">
                                    Data Pengguna : <?= $totPengguna ?>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-users-cog"></i>
                            </div>
                            <a href="<?= base_url('dashboard/pengguna') ?>" class="small-box-footer">More Info ! <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                <?php endif ?>

                <?php if (session('level') == 103 || session('level') == 102) : ?>
                    <!-- Card Barang -->
                    <div class="col-lg-4 col-6">
                        <div class="small-box" style="background-color: #143F6B;">
                            <div class="inner">
                                <h4 style="font-weight: bold; color: white;">BARANG</h4>
                                <p style="font-weight: bold;">
                                    Data Barang : <?= $totBarang ?>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-box"></i>
                            </div>
                            <a href="<?= base_url('dashboard/barang') ?>" class="small-box-footer">More Info ! <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <?php if (session('level') == 103) : ?>
                        <!-- Card Kategori -->
                        <div class="col-lg-4 col-6">
                            <div class="small-box" style="background-color: #EA5455;">
                                <div class="inner">
                                    <h4 style="font-weight: bold; color: white;">KATEGORI</h4>
                                    <p style="font-weight: bold;">
                                        Data Kategori : <?= $totKategori ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-book"></i>
                                </div>
                                <a href="<?= base_url('dashboard/kategori') ?>" class="small-box-footer">More Info ! <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- Card Supplier -->
                        <div class="col-lg-4 col-6">
                            <div class="small-box" style="background-color: #FFD460;">
                                <div class="inner">
                                    <h4 style="font-weight: bold; color: white;">SUPPLIER</h4>
                                    <p style="font-weight: bold;">
                                        Data Supplier : <?= $totSupplier ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-truck"></i>
                                </div>
                                <a href="<?= base_url('dashboard/supplier') ?>" class="small-box-footer">More Info ! <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    <?php endif ?>

                    <!-- Card Barang Masuk -->
                    <div class="col-lg-4 col-6">
                        <div class="small-box" style="background-color: #52734D;">
                            <div class="inner">
                                <h4 style="font-weight: bold; color: white;">BARANG MASUK</h4>
                                <p style="font-weight: bold;">
                                    Data Barang Masuk : <?= $totMasuk ?>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-parachute-box"></i>
                            </div>
                            <a href="<?= base_url('dashboard/barangmasuk') ?>" class="small-box-footer">More Info ! <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Card Barang Keluar -->
                    <div class="col-lg-4 col-6">
                        <div class="small-box" style="background-color: #F5B461;">
                            <div class="inner">
                                <h4 style="font-weight: bold; color: white;">BARANG KELUAR</h4>
                                <p style="font-weight: bold;">
                                    Data Barang Keluar : <?= $totKeluar ?>
                                </p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-truck-loading"></i>
                            </div>
                            <a href="<?= base_url('dashboard/barangkeluar') ?>" class="small-box-footer">More Info ! <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div hidden class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Area Chart</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>

                            </div>

                            <div hidden class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Donut Chart</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>

                            </div>

                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Penermaan Barang VS Return Barang</h3>
                                    <div class="card-tools">
                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"> -->
                                            <!-- <i class="fas fa-minus"></i> -->
                                        <!-- </button> -->
                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"> -->
                                            <!-- <i class="fas fa-times"></i> -->
                                        <!-- </button> -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div hidden class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Line Chart</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>

                            </div>

                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Pembelian Barang Selama 1 Tahun</h3>
                                    <div class="card-tools">
                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"> -->
                                            <!-- <i class="fas fa-minus"></i> -->
                                        <!-- </button> -->
                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"> -->
                                            <!-- <i class="fas fa-times"></i> -->
                                        <!-- </button> -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div hidden class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Stacked Bar Chart</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                <?php endif ?>
            </div>

            <hr>

            <h4 class="text-bold text-center">Selamat Datang Di Sistem Informasi Manajemen Inventory</h4>
            <div style="text-align: justify; color: black;">
                <a>
                    Sistem manajemen inventaris (inventory) berguna dalam proses pendataan barang, karena dapat meningkatkan efisiensi dan kecepatan dalam pengelolaan inventarisasi. Dengan adanya sistem ini, proses pendataan barang dapat dilakukan secara lebih terstruktur dan terotomatisasi, sehingga meminimalkan kesalahan manusia dan mempercepat waktu pengolahan data.
                </a>
            </div>
        </div>
</div>
</section>

</div>