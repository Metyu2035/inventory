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
                    <h1 class="text-bold"><i style="color: black;" class="nav-icon fas fa-parachute-box"></i> <?= $subjudul ?></h1>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 style="font-weight: bold; font-size: large;" class="card-title">
                                <?= $tabel ?>
                            </h6>
                        </div>
                        <div class="card-body">
                            <!-- Tombol Tambah -->
                            <div class="d-flex justify-content-end mb-3">

                                <?php if (session('jabatan') == "Staff Gudang") : ?>
                                    <button id="aksi" type="button" class="btn" data-toggle="modal" data-target="#modalTambah" style="background-color: #06283d; font-weight: bold; color: white;">
                                        Tambah
                                    </button>
                                <?php endif ?>
                            </div>
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Masuk</th>
                                        <th>No Order</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($barangmsk as $row) : $no++; ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= dateindo($row['tanggal_masuk']) ?></td>
                                            <td><?= $row['no_order'] ?></td>
                                            <td><?= $row['nama_barang'] ?></td>
                                            <td><?= $row['jumlah'] ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <button id="aksi" type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDetail<?= $row['id_masuk'] ?>" style="background-color: #06283d;">
                                                            <i class="nav-icon fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    <?php if (session('jabatan') == "Staff Gudang") : ?>
                                                        <div class="col-4">
                                                            <button id="aksi" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUbah<?= $row['id_masuk'] ?>">
                                                                <i class="nav-icon fas fa-edit"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-4">
                                                            <button id="aksi" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus<?= $row['id_masuk'] ?>">
                                                                <i class=" nav-icon fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #06283d; color: white;">
                <h5 class="modal-title" style="font-weight: bold;">FORM TAMBAH BARANG MASUK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: white;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('dashboard/tambahMasuk') ?>" method="post">
                <div class="modal-body">
                    <!-- Tanggal Masuk -->
                    <h6 style="font-weight: bold; font-size: large;">
                        Tanggal Masuk :
                    </h6>
                    <div class="input-group mb-3">
                        <input autofocus id="border-edu" name="tanggal" type="date" class="form-control">
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-calendar"></span>
                            </div>
                        </div>
                    </div>

                    <!-- No Order -->
                    <h6 style="font-weight: bold; font-size: large;">
                        No Order :
                    </h6>
                    <div class="input-group mb-3">
                        <input autofocus placeholder="No Order" id="border-edu" name="order" type="text" class="form-control">
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-exclamation-circle"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <!-- Barang -->
                            <h6 style="font-weight: bold; font-size: large;">
                                Barang :
                            </h6>
                            <div class="input-group mb-3">
                                <select autofocus class="form-control" name="nama" id="border-edu">
                                    <option value="">Nama Barang</option>
                                    <?php foreach ($barang as $row) : ?>
                                        <option value="<?= $row['id_barang'] ?>"><?= $row['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="input-group-append">
                                    <div style="width: 40px;" id="border-edu" class="input-group-text">
                                        <span class="fas fa-box"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- Supplier -->
                            <h6 style="font-weight: bold; font-size: large;">
                                Supplier :
                            </h6>
                            <div class="input-group mb-3">
                                <select autofocus class="form-control" name="supplier" id="border-edu">
                                    <option value="">Nama Supplier</option>
                                    <?php foreach ($supplier as $row) : ?>
                                        <option value="<?= $row['id_supplier'] ?>"><?= $row['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="input-group-append">
                                    <div style="width: 40px;" id="border-edu" class="input-group-text">
                                        <span class="fas fa-truck"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah -->
                    <h6 style="font-weight: bold; font-size: large;">
                        Jumlah :
                    </h6>
                    <div class="input-group mb-3">
                        <input autofocus placeholder="Jumlah" id="border-edu" name="jumlah" type="text" class="form-control">
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-sort-numeric-up"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <h6 style="font-weight: bold; font-size: large;">
                        Keterangan :
                    </h6>
                    <div class="input-group mb-3">
                        <textarea placeholder="Masukan kondisi barang yang masuk" name="keterangan" id="border-edu" class="form-control"></textarea>
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-keyboard"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-sm" style="color: white; font-weight: bold; font-size: large; background-color: #06283d;">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<?php foreach ($barangmsk as $row) : ?>
    <div class="modal fade" id="modalDetail<?= $row['id_masuk'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">DETAIL BARANG MASUK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dashboard/tambahMasuk') ?>" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <!-- Tanggal Masuk -->
                                <h6 style="font-weight: bold; font-size: large;">
                                    Tanggal Masuk :
                                </h6>
                                <div class="input-group mb-3">
                                    <input disabled id="border-edu" value="<?= $row['tanggal_masuk'] ?>" class="form-control">
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <!-- No Order -->
                                <h6 style="font-weight: bold; font-size: large;">
                                    No Order :
                                </h6>
                                <div class="input-group mb-3">
                                    <input disabled id="border-edu" value="<?= $row['no_order'] ?>" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-exclamation-circle"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <!-- Barang -->
                                <h6 style="font-weight: bold; font-size: large;">
                                    Barang :
                                </h6>
                                <div class="input-group mb-3">
                                    <input disabled id="border-edu" value="<?= $row['nama_barang'] ?>" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-box"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <!-- Suuplier -->
                                <h6 style="font-weight: bold; font-size: large;">
                                    Supplier :
                                </h6>
                                <div class="input-group mb-3">
                                    <input disabled id="border-edu" value="<?= $row['nama_supplier'] ?>" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-truck"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah -->
                        <h6 style="font-weight: bold; font-size: large;">
                            Jumlah :
                        </h6>
                        <div class="input-group mb-3">
                            <input disabled id="border-edu" value="<?= $row['jumlah'] ?>" type="text" class="form-control">
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-sort-numeric-up"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <h6 style="font-weight: bold; font-size: large;">
                            Keterangan :
                        </h6>
                        <div class="input-group mb-3">
                            <textarea disabled readonly id="border-edu" class="form-control"><?= $row['keterangan'] ?></textarea>
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-keyboard"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="font-weight: bold; font-size: large;">
                            Kembali
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal Detail -->
<?php foreach ($barangmsk as $row) : $id_supplier = $row['id_supplier'];
    $nama_supplier = $row['nama_supplier'];
    $jumlah = $row['jumlah'];
    $keterangan = $row['keterangan'];  ?>
    <div class="modal fade" id="modalUbah<?= $row['id_masuk'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">FORM UBAH BARANG MASUK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dashboard/ubahMasuk') ?>" method="post">
                    <input hidden value="<?= $row['id_masuk'] ?>" type="text" name="id">
                    <div class="modal-body">
                        <!-- Tanggal Masuk -->
                        <h6 style="font-weight: bold; font-size: large;">
                            Tanggal Masuk :
                        </h6>
                        <div class="input-group mb-3">
                            <input disabled value="<?= dateindo($row['tanggal_masuk']) ?>" id="border-edu" class="form-control">
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-calendar"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <!-- No Order -->
                                <h6 style="font-weight: bold; font-size: large;">
                                    No Order :
                                </h6>
                                <div class="input-group mb-3">
                                    <input autofocus value="<?= $row['no_order'] ?>" id="border-edu" name="order" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-exclamation-circle"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Barang -->
                                <div hidden class="input-group mb-3">
                                    <select class="form-control" name="nama" id="border-edu">
                                        <option value="<?= $row['id_barang'] ?>"><?= $row['nama_barang'] ?></option>
                                    </select>
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-box"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <!-- Jumlah -->
                                <h6 style="font-weight: bold; font-size: large;">
                                    Jumlah :
                                </h6>
                                <div class="input-group mb-3">
                                    <input autofocus value="<?= $jumlah ?>" id="border-edu" name="jumlah" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-sort-numeric-up"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Supplier -->
                                <div hidden class="input-group mb-3">
                                    <select autofocus class="form-control" name="supplier" id="border-edu">
                                        <option value="<?= $id_supplier ?>"><?= $nama_supplier ?></option>
                                    </select>
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-truck"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <h6 style="font-weight: bold; font-size: large;">
                            Keterangan :
                        </h6>
                        <div class="input-group mb-3">
                            <textarea name="keterangan" id="border-edu" class="form-control"><?= $keterangan ?></textarea>
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-keyboard"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-sm" style="color: white; font-weight: bold; font-size: large; background-color: #06283d;">
                            Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal Hapus -->
<?php foreach ($barangmsk as $row) : ?>
    <div class="modal fade" id="modalHapus<?= $row['id_masuk'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">FORM HAPUS BARANG MASUK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dashboard/hapusMasuk') ?>" method="post">
                    <div class="modal-body">
                        <input hidden type="text" name="id" value="<?= $row['id_masuk'] ?>">

                        <h5 style="color: #06283d; font-weight: bold;">Apakah anda yakin ingin menghapus data <?= $row['nama_barang'] ?> ?</h5>

                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn" style="background-color: #06283d; color: white; font-weight: bold;">
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>