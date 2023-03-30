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
                    <h1 class="text-bold"><i style="color: black;" class="nav-icon fas fa-box"></i> <?= $subjudul ?></h1>
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
                            <h6 style="font-weight: bold; font-size: large;" class="card-title"><?= $tabel ?></h6>
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
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($barang as $row) : $no++; ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row['kode_barang'] ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['stok'] ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <button id="aksi" type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDetail<?= $row['id_barang'] ?>" style="background-color: #06283d;">
                                                            <i class="nav-icon fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    <?php if (session('jabatan') == "Staff Gudang") : ?>
                                                        <div class="col-4">
                                                            <button id="aksi" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUbah<?= $row['id_barang'] ?>">
                                                                <i class="nav-icon fas fa-edit"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-4">
                                                            <button id="aksi" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus<?= $row['id_barang'] ?>">
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
                <h5 class="modal-title" style="font-weight: bold;">FORM TAMBAH BARANG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: white;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('dashboard/tambahBarang') ?>" method="post">
                <div class="modal-body">
                    <!-- Nama Barang -->
                    <h6 style="font-weight: bold; font-size: large;">
                        Nama Barang :
                    </h6>
                    <div class="input-group mb-3">
                        <input autofocus placeholder="Nama Barang" id="border-edu" name="nama" type="text" class="form-control">
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-list-alt"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- Kode Barang -->
                            <h6 style="font-weight: bold; font-size: large;">
                                Kode Barang :
                            </h6>
                            <div class="input-group mb-3">
                                <input autofocus placeholder="Kode Barang" id="border-edu" name="kode" type="text" class="form-control">
                                <div class="input-group-append">
                                    <div style="width: 40px;" id="border-edu" class="input-group-text">
                                        <span class="fas fa-info-circle"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- Kategori -->
                            <h6 style="font-weight: bold; font-size: large;">
                                Kategori :
                            </h6>
                            <div class="input-group mb-3">
                                <select autofocus name="kategori" id="border-edu" class="form-control">
                                    <option value="">Kategori</option>
                                    <?php foreach ($kategori as $row) : ?>
                                        <option value="<?= $row['id_kategori'] ?>"><?= $row['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="input-group-append">
                                    <div style="width: 40px;" id="border-edu" class="input-group-text">
                                        <span class="fas fa-book"></span>
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
                        <textarea autofocus placeholder="Masukan Keterangan Berisi Keadaan Barang" id="border-edu" name="keterangan" class="form-control"></textarea>
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-keyboard"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Stok -->
                    <!-- <h6 style="font-weight: bold; font-size: large;">
                        Stok :
                    </h6> -->
                    <div hidden class="input-group mb-3">
                        <input value="0" id="border-edu" name="stok" type="text" class="form-control">
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Supplier -->
                    <h6 style="font-weight: bold; font-size: large;">
                        Supplier :
                    </h6>
                    <div class="input-group mb-3">
                        <select autofocus name="supplier" id="border-edu" class="form-control">
                            <option value="">Supplier</option>
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
<?php foreach ($barang as $row) : ?>
    <div class="modal fade" id="modalDetail<?= $row['id_barang'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">DETAIl BARANG</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dashboard/tambahBarang') ?>" method="post">
                    <div class="modal-body">
                        <!-- Nama Barang -->
                        <h6 style="font-weight: bold; font-size: large;">
                            Nama Barang :
                        </h6>
                        <div class="input-group mb-3">
                            <input disabled value="<?= $row['nama'] ?>" id="border-edu" name="nama" type="text" class="form-control">
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-list-alt"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <!-- Kode Barang -->
                                <h6 style="font-weight: bold; font-size: large;">
                                    Kode Barang :
                                </h6>
                                <div class="input-group mb-3">
                                    <input disabled value="<?= $row['kode_barang'] ?>" id="border-edu" name="kode" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-info-circle"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <!-- Kategori -->
                                <h6 style="font-weight: bold; font-size: large;">
                                    Kategori :
                                </h6>
                                <div class="input-group mb-3">
                                    <input disabled value="<?= $row['nama_kategori'] ?>" name="kategori" id="border-edu" class="form-control">
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-book"></span>
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
                            <textarea disabled readonly id="border-edu" name="keterangan" type="text" class="form-control"><?= $row['keterangan'] ?></textarea>
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-keyboard"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Stok -->
                        <!-- <h6 style="font-weight: bold; font-size: large;">
                        Stok :
                        </h6> -->
                        <div hidden class="input-group mb-3">
                            <input value="0" id="border-edu" name="stok" type="text" class="form-control">
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-id-card"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier -->
                        <h6 style="font-weight: bold; font-size: large;">
                            Supplier :
                        </h6>
                        <div class="input-group mb-3">
                            <input disabled value="<?= $row['nama_supplier'] ?>" id="border-edu" name="supplier" type="text" class="form-control">
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-truck"></span>
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

<!-- Modal Ubah -->
<?php foreach ($barang as $row) :
    $keterangan = $row['keterangan'];
    $id_supplier = $row['id_supplier'];
    $nama_supplier = $row['nama_supplier']; ?>
    <div class="modal fade" id="modalUbah<?= $row['id_barang'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">FORM UBAH BARANG</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dashboard/ubahBarang') ?>" method="post">
                    <div class="modal-body">
                        <input hidden name="id" type="text" value="<?= $row['id_barang'] ?>">
                        <!-- Nama Barang -->
                        <h6 style="font-weight: bold; font-size: large;">
                            Nama Barang :
                        </h6>
                        <div class="input-group mb-3">
                            <input autofocus value="<?= $row['nama'] ?>" id="border-edu" name="nama" type="text" class="form-control">
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-list-alt"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <!-- Kode Barang -->
                                <h6 style="font-weight: bold; font-size: large;">
                                    Kode Barang :
                                </h6>
                                <div class="input-group mb-3">
                                    <input autofocus value="<?= $row['kode_barang'] ?> " id="border-edu" name="kode" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-info-circle"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <!-- Kategori -->
                                <h6 style="font-weight: bold; font-size: large;">
                                    Kategori :
                                </h6>
                                <div class="input-group mb-3">
                                    <select autofocus name="kategori" id="border-edu" class="form-control">
                                        <option value="<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
                                        <?php foreach ($kategori as $row) : ?>
                                            <option value=" <?= $row['id_kategori'] ?>"><?= $row['nama'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-book"></span>
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
                            <textarea autofocus id="border-edu" name="keterangan" class="form-control"><?= $keterangan ?></textarea>
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-keyboard"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier -->
                        <h6 style="font-weight: bold; font-size: large;">
                            Supplier :
                        </h6>
                        <div class="input-group mb-3">
                            <select autofocus name="supplier" id="border-edu" class="form-control">
                                <option value="<?= $id_supplier ?>"><?= $nama_supplier ?></option>
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
<?php foreach ($barang as $row) : ?>
    <div class="modal fade" id="modalHapus<?= $row['id_barang'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">FORM HAPUS BARANG</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dashboard/hapusBarang') ?>" method="post">
                    <div class="modal-body">
                        <input hidden type="text" name="id" value="<?= $row['id_barang'] ?>">

                        <h5 style="color: #06283d; font-weight: bold;">Apakah anda yakin ingin menghapus data <?= $row['nama'] ?> ?</h5>

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