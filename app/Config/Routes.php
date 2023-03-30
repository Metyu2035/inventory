<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/registrasi', 'Home::registrasi');
$routes->get('/forgot', 'Home::forgot');
$routes->get('/reset', 'Home::resetpassword');
$routes->get('/home/login', 'Home::login');
$routes->get('/home/logout', 'Home::logout');

// Routes Post Login dan Registrasi
$routes->post('/home/login', 'Home::login');
$routes->post('/home/registrasi', 'Home::registrasi');

// Routes Post Forgot
$routes->post('/home/reset', 'Home::reset');
$routes->post('/home/prosesReset', 'Home::prosesReset');

// Routes Get Halaman Dashboard
$routes->get('/dashboard', 'Dashboard::index');

// Routes Get Halaman Pengguna
$routes->get('/dashboard/pengguna', 'Dashboard::pengguna');
$routes->get('/dashboard/tambahPengguna', 'Dashboard::pengguna');
$routes->get('/dashboard/ubahPengguna', 'Dashboard::pengguna');
$routes->get('/dashboard/hapusPengguna', 'Dashboard::pengguna');

// Routes Post Halaman Pengguna
$routes->post('/dashboard/tambahPengguna', 'Dashboard::tambahPengguna');
$routes->post('/dashboard/ubahPengguna', 'Dashboard::ubahPengguna');
$routes->post('/dashboard/hapusPengguna', 'Dashboard::hapusPengguna');

// Routes Get Halaman Barang
$routes->get('/dashboard/barang', 'Dashboard::barang');
$routes->get('/dashboard/tambahBarang', 'Dashboard::barang');
$routes->get('/dashboard/ubahBarang', 'Dashboard::barang');
$routes->get('/dashboard/hapusBarang', 'Dashboard::barang');

// Routes Post Halaman Barang
$routes->post('/dashboard/tambahBarang', 'Dashboard::tambahBarang');
$routes->post('/dashboard/ubahBarang', 'Dashboard::ubahBarang');
$routes->post('/dashboard/hapusBarang', 'Dashboard::hapusBarang');

// Routes Get Halaman Kategori
$routes->get('/dashboard/kategori', 'Dashboard::kategori');
$routes->get('/dashboard/tambahKategori', 'Dashboard::Kategori');
$routes->get('/dashboard/ubahKategori', 'Dashboard::Kategori');
$routes->get('/dashboard/hapusKategori', 'Dashboard::Kategori');

// Routes Post Halaman Kategori
$routes->post('/dashboard/tambahKategori', 'Dashboard::tambahKategori');
$routes->post('/dashboard/ubahKategori', 'Dashboard::ubahKategori');
$routes->post('/dashboard/hapusKategori', 'Dashboard::hapusKategori');

// Routes Get Halaman Supplier
$routes->get('/dashboard/supplier', 'Dashboard::supplier');
$routes->get('/dashboard/tambahSupplier', 'Dashboard::supplier');
$routes->get('/dashboard/ubahSupplier', 'Dashboard::supplier');
$routes->get('/dashboard/hapusSupplier', 'Dashboard::supplier');

// Routes Post Halaman Supplier
$routes->post('/dashboard/tambahSupplier', 'Dashboard::tambahSupplier');
$routes->post('/dashboard/ubahSupplier', 'Dashboard::ubahSupplier');
$routes->post('/dashboard/hapusSupplier', 'Dashboard::hapusSupplier');

// Routes Get Halaman Barang Masuk
$routes->get('/dashboard/barangmasuk', 'Dashboard::barangmasuk');
$routes->get('/dashboard/tambahMasuk', 'Dashboard::barangmasuk');
$routes->get('/dashboard/ubahMasuk', 'Dashboard::barangmasuk');
$routes->get('/dashboard/hapusMasuk', 'Dashboard::barangmasuk');

// Routes Post Halaman Barang Masuk
$routes->post('/dashboard/tambahMasuk', 'Dashboard::tambahMasuk');
$routes->post('/dashboard/ubahMasuk', 'Dashboard::ubahMasuk');
$routes->post('/dashboard/hapusMasuk', 'Dashboard::hapusMasuk');

// Routes Get Halaman Barang Keluar
$routes->get('/dashboard/barangkeluar', 'Dashboard::barangkeluar');
$routes->get('/dashboard/tambahKeluar', 'Dashboard::barangkeluar');
$routes->get('/dashboard/ubahKeluar', 'Dashboard::barangkeluar');
$routes->get('/dashboard/hapusKeluar', 'Dashboard::barangkeluar');

// Routes Post Halaman Barang keluar
$routes->post('/dashboard/tambahKeluar', 'Dashboard::tambahKeluar');
$routes->post('/dashboard/ubahKeluar', 'Dashboard::ubahKeluar');
$routes->post('/dashboard/hapusKeluar', 'Dashboard::hapusKeluar');

// Routes Get Halaman Laporan Barang Masuk
$routes->get('/laporan/laporanMasuk', 'Laporan::laporanMasuk');
$routes->post('/laporan/laporanMasuk', 'Laporan::cetakMasuk');

// Routes Get Halaman Laporan Barang Keluar
$routes->get('/laporan/laporanKeluar', 'Laporan::laporanKeluar');
$routes->post('/laporan/laporanKeluar', 'Laporan::cetakKeluar');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
