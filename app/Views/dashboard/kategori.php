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
                    <h1 class="text-bold"><i style="color: black;" class="nav-icon fas fa-book"></i> <?= $subjudul ?></h1>
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
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($kategori as $row) : $no++; ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td>
                                                <div class="row ml-2">
                                                    <button id="aksi" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUbah<?= $row['id_kategori'] ?>">
                                                        <i class="nav-icon fas fa-edit"></i>
                                                    </button>
                                                    <button id="aksi" class="btn btn-danger ml-5" data-toggle="modal" data-target="#modalHapus<?= $row['id_kategori'] ?>">
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
                <h5 class="modal-title" style="font-weight: bold;">FORM TAMBAH KATEGORI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: white;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('dashboard/tambahKategori') ?>" method="post">
                <div class="modal-body">
                    <!-- Nama Kategori -->
                    <h6 style="font-weight: bold; font-size: large;">
                        Nama Kategori :
                    </h6>
                    <div class="input-group mb-3">
                        <input autofocus placeholder="Nama Kategori" id="border-edu" name="nama" type="text" class="form-control">
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-list-alt"></span>
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
<?php foreach ($kategori as $row) : ?>
    <div class="modal fade" id="modalUbah<?= $row['id_kategori'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">FORM UBAH KATEGORI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dashboard/ubahKategori') ?>" method="post">
                    <div class="modal-body">
                        <input hidden type="text" name="id" value="<?= $row['id_kategori'] ?>">

                        <!-- Nama Kategori -->
                        <h6 style="font-weight: bold; font-size: large;">
                            Nama Kategori :
                        </h6>
                        <div class="input-group mb-3">
                            <input autofocus value="<?= $row['nama'] ?>" id="border-edu" name="nama" type="text" class="form-control">
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-list-alt"></span>
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
<?php foreach ($kategori as $row) : ?>
    <div class="modal fade" id="modalHapus<?= $row['id_kategori'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">FORM HAPUS KATEGORI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dashboard/hapusKategori') ?>" method="post">
                    <div class="modal-body">
                        <input hidden type="text" name="id" value="<?= $row['id_kategori'] ?>">

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