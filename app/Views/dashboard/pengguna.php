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
                    <h1 class="text-bold"><i style="color: black;" class="nav-icon fas fa-users-cog"></i> <?= $subjudul ?></h1>
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

                                <button id="aksi" class="btn" style="background-color: #06283d;">
                                    <a href="<?= base_url('registrasi') ?>" style="font-weight:bold; color: white;">Registrasi</a>
                                </button>
                            </div>
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Hak Akses</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($pengguna as $row) : $no++; ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['username'] ?></td>
                                            <td><?= $row['hak_akses'] ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <button id="aksi" type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDetail<?= $row['id_user'] ?>" style="background-color: #06283d;">
                                                            <i class="nav-icon fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-4">
                                                        <button id="aksi" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUbah<?= $row['id_user'] ?>">
                                                            <i class="nav-icon fas fa-edit"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-4">
                                                        <button id="aksi" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus<?= $row['id_user'] ?>">
                                                            <i class=" nav-icon fas fa-trash"></i>
                                                        </button>
                                                    </div>
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

<!-- Modal Detail -->
<?php foreach ($pengguna as $row) : ?>
    <div class="modal fade" id="modalDetail<?= $row['id_user'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">DETAIL PENGGUNA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Nama -->
                    <h6 style="font-weight: bold; font-size: large;">Nama :</h6>
                    <div class="input-group mb-3">
                        <input disabled class="form-control" value="<?= $row['nama'] ?>">
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Jabatan -->
                    <h6 style="font-weight: bold; font-size: large;">Jabatan :</h6>
                    <div class="input-group mb-3">
                        <input disabled class="form-control" value="<?= $row['jabatan'] ?>">
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-user-tie"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <h6 style="font-weight: bold; font-size: large;">Email :</h6>
                    <div class="input-group mb-3">
                        <input disabled class="form-control" value="<?= $row['email'] ?>">
                        <div class="input-group-append">
                            <div style="width: 40px;" id="border-edu" class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <h6 style="font-weight: bold; font-size: large;">Username :</h6>
                        </div>
                        <div class="col-6">
                            <h6 style="font-weight: bold; font-size: large;">Hak Akses :</h6>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <input disabled class="form-control" value="<?= $row['username'] ?>">
                                <div class="input-group-append">
                                    <div style="width: 40px;" id="border-edu" class="input-group-text">
                                        <span class="fas fa-portrait"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <input disabled class="form-control" value="<?= $row['hak_akses'] ?>">
                                <div class="input-group-append">
                                    <div style="width: 40px;" id="border-edu" class="input-group-text">
                                        <span class="fas fa-users-cog"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="font-weight: bold; font-size: large;">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal Ubah -->
<?php foreach ($pengguna as $row) : ?>
    <div class="modal fade" id="modalUbah<?= $row['id_user'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">FORM UBAH PENGGUNA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dashboard/ubahPengguna') ?>" method="post">
                    <div class="modal-body">
                        <input hidden type="text" name="id" value="<?= $row['id_user'] ?>">

                        <!-- Nama -->
                        <h6 style="font-weight: bold; font-size: large;">Nama :</h6>
                        <div class="input-group mb-3">
                            <input type="text" name="nama" class="form-control" value="<?= $row['nama'] ?>">
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-id-card"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Jabatan -->
                        <h6 style="font-weight: bold; font-size: large;">Jabatan :</h6>
                        <div class="input-group mb-3">
                            <input type="text" name="jabatan" class="form-control" value="<?= $row['jabatan'] ?>">
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-user-tie"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <h6 style="font-weight: bold; font-size: large;">Email :</h6>
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" value="<?= $row['email'] ?>">
                            <div class="input-group-append">
                                <div style="width: 40px;" id="border-edu" class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-6">
                                <h6 style="font-weight: bold; font-size: large;">Username :</h6>
                            </div>
                            <div class="col-6">
                                <h6 style="font-weight: bold; font-size: large;">Hak Akses :</h6>
                            </div>

                            <!-- Username -->
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input disabled class="form-control" value="<?= $row['username'] ?>">
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-portrait"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hak Akses -->
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <select name="level" id="border-edu" class="form-control">
                                        <option value="<?= $row['id_level'] ?>"><?= $row['hak_akses'] ?></option>
                                        <option value="101">Administrator</option>
                                        <option value="102">Kepala Gudang</option>
                                        <option value="103">Staff Gudang</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div style="width: 40px;" id="border-edu" class="input-group-text">
                                            <span class="fas fa-users-cog"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn" style="background-color: #06283d; color: white; font-weight: bold;">
                            Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal Hapus -->
<?php foreach ($pengguna as $row) : ?>
    <div class="modal fade" id="modalHapus<?= $row['id_user'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #06283d; color: white;">
                    <h5 class="modal-title" style="font-weight: bold;">FORM HAPUS PENGGUNA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('dashboard/hapusPengguna') ?>" method="post">
                    <div class="modal-body">
                        <input hidden type="text" name="id" value="<?= $row['id_user'] ?>">

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