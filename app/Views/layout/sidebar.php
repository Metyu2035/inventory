<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #2B4865; color: white;">

    <a class="brand-link" style="background-color: #06283d; color: white;">
        <img src="<?= base_url('assets/img/logo1.png') ?>" alt="Logo Perusahaan" class="border brand-image img-circle">
        <span style="color: white;" class="brand-text font-weight-bold">VBI</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/img/profile.png') ?>" class="img-circle" alt="Foto User">
            </div>
            <div class="info">
                <h5 class="text-bold"><?= session('nama') ?></h5>
            </div>
        </div>

        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Cari Menu" aria-label="Search" style="font-weight: bold; background-color: white; color: #06283d;">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Menu Akses Halaman Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!-- Menu Admin -->
                <?php if (session('level') == 101) : ?>
                    <!-- Menu Akses Halaman Pengguna -->
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/pengguna') ?>" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                Pengguna
                            </p>
                        </a>
                    </li>
                <?php endif ?>

                <!-- Menu Kepala -->
                <?php if (session('level') == 102) : ?>
                    <!-- Menu Akses Halaman Barang -->
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/barang') ?>" class="nav-link">
                            <i class="fas fa-box nav-icon"></i>
                            <p>Barang</p>
                        </a>
                    </li>

                    <!-- Menu Akses Halaman Barang Masuk -->
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/barangmasuk') ?>" class="nav-link">
                            <i class="nav-icon fas fa-parachute-box"></i>
                            <p>
                                Barang Masuk
                            </p>
                        </a>
                    </li>

                    <!-- Menu Akses Halaman Barang Keluar -->
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/barangkeluar') ?>" class="nav-link">
                            <i class="nav-icon fas fa-truck-loading"></i>
                            <p>
                                Barang Keluar
                            </p>
                        </a>
                    </li>

                    <!-- Menu Akses Halaman Chart Tahunan -->
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/index') ?>" class="nav-link">
                            <i class="nav-icon fa-duotone fa-chart-simple"></i>
                            <p>
                                Chart
                            </p>
                        </a>
                    </li>

                    <!-- Menu Laporan Dropdown -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Laporan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <!-- Menu Akses Halaman Laporan Barang Masuk -->
                            <li class="nav-item">
                                <a href="<?= base_url('laporan/laporanMasuk') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-file-export"></i>
                                    <p>
                                        Laporan Barang Masuk
                                    </p>
                                </a>
                            </li>

                            <!-- Menu Akses Halaman Laporan Barang Keluar -->
                            <li class="nav-item">
                                <a href="<?= base_url('laporan/laporanKeluar') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-file-export"></i>
                                    <p>
                                        Laporan Barang Keluar
                                    </p>
                                </a>
                            </li>



                        </ul>
                    </li>
                <?php endif ?>

                <!-- Menu Staff -->
                <?php if (session('level') == 103) : ?>
                    <!-- Menu Data Master -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-server"></i>
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <!-- Menu Akses Halaman Barang -->
                            <li class="nav-item">
                                <a href="<?= base_url('dashboard/barang') ?>" class="nav-link">
                                    <i class="fas fa-box nav-icon"></i>
                                    <p>Barang</p>
                                </a>
                            </li>

                            <!-- Menu Akses Halaman Kategori -->
                            <li class="nav-item">
                                <a href="<?= base_url('dashboard/kategori') ?>" class="nav-link">
                                    <i class="fas fa-book nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>

                            <!-- Menu Akses Halaman Supplier -->
                            <li class="nav-item">
                                <a href="<?= base_url('dashboard/supplier') ?>" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p>Supplier</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <!-- Menu Akses Halaman Barang Masuk -->
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/barangmasuk') ?>" class="nav-link">
                            <i class="nav-icon fas fa-parachute-box"></i>
                            <p>
                                Barang Masuk
                            </p>
                        </a>
                    </li>

                    <!-- Menu Akses Halaman Barang Keluar -->
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/barangkeluar') ?>" class="nav-link">
                            <i class="nav-icon fas fa-truck-loading"></i>
                            <p>
                                Barang Keluar
                            </p>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </nav>

    </div>

</aside>