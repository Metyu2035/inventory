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
                    <h1 class="text-bold"><i style="color: black;" class="nav-icon fas fa-truck"></i> <?= $subjudul ?></h1>
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

                                <button id="aksi" type="button" class="btn" data-toggle="modal" data-target="#modalTambah" style="background-color: #06283d; font-weight: bold; color: white;">
                                    Tambah
                                </button>
                            </div>
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Supplier</th>
                                        <th>Kota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="width: fit-content;">
                                    <?php $no = 0;
                                    foreach ($supplier as $row) : $no++; ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['kota'] ?></td>
                                            <td>
                                                <div class="row ml-2" style="gap: 20px;">
                                                    <button id="aksi" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUbah<?= $row['id_supplier'] ?>">
                                                        <i class="nav-icon fas fa-edit"></i>
                                                    </button>
                                                    <button id="aksi" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus<?= $row['id_supplier'] ?>">
                                                        <i class=" nav-icon fas fa-trash"></i>
                                                    </button>
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
                <h5 class="modal-title" style="font-weight: bold;">FORM TAMBAH SUPPLIER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: white;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('dashboard/tambahSupplier') ?>" method="post">
                <div class="modal-body">
                    <!-- Nama Supplier -->
                    <h6 style="font-weight: bold; font-size: large;">
                        Nama Supplier :
                    </h6>
                    <div class="input-group mb-3">
                        <input autofocus placeholder="Nama Supplier" id="border-edu" name="nama" type="text" class="form-control">
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-list-alt"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Kota -->
                    <h6 style="font-weight: bold; font-size: large;">
                        Kota :
                    </h6>
                    <div class="input-group mb-3">
                        <input autofocus placeholder="Kota Asal" id="border-edu" name="kota" type="text" class="form-control">
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-city"></span>
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

<!-- Modal Ubah -->
<?php foreach ($supplier as $row) : ?>
    <div class="modal fade" id="modalUbah<?= $row['id_supplier'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">FORM UBAH SUPPLIER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dashboard/ubahSupplier') ?>" method="post">
                    <div class="modal-body">
                        <input hidden type="text" name="id" value="<?= $row['id_supplier'] ?>">

                        <!-- Nama Supplier -->
                        <h6 style="font-weight: bold; font-size: large;">
                            Nama Supplier :
                        </h6>
                        <div class="input-group mb-3">
                            <input autofocus value="<?= $row['nama'] ?>" id="border-edu" name="nama" type="text" class="form-control">
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-list-alt"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Kota -->
                        <h6 style="font-weight: bold; font-size: large;">
                            Kota :
                        </h6>
                        <div class="input-group mb-3">
                            <input autofocus value="<?= $row['kota'] ?>" id="border-edu" name="kota" type="text" class="form-control">
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-city"></span>
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
<?php foreach ($supplier as $row) : ?>
    <div class="modal fade" id="modalHapus<?= $row['id_supplier'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">FORM HAPUS SUPPLIER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dashboard/hapusSupplier') ?>" method="post">
                    <div class="modal-body">
                        <input hidden type="text" name="id" value="<?= $row['id_supplier'] ?>">

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