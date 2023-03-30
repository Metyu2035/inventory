<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang Keluar <?= dateindo($tanggalAwal) ?> - <?= dateindo($tanggalAkhir) ?></title>

    <!-- Logo Samping Link -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/laporan.css') ?>">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body onload="print()">
    <div class="eduhoster">
        <!-- Perusahaan -->
        <div class="judul-perusahaan">
            <h1 style="font-weight: bold; font-size: 30px;">
                <img src="<?= base_url('assets/img/logo1.png') ?>" alt="Logo Perusahaan"> Victory Blessings Indonesia
            </h1>
        </div>
        <hr>

        <!-- Judul Laporan -->
        <div class="judul-cetak">
            <h3 style="font-size: 18px;"><u> LAPORAN BARANG KELUAR </u></h3>
            <p style="font-size: 12px;">Dari Tanggal <?= dateindo($tanggalAwal) ?> s/d Tanggal <?= dateindo($tanggalAkhir) ?></p>
        </div>

        <!-- Isi Data -->
        <div class="isi">
            <table class="table table-bordered border-dark">
                <tr style="font-size: smaller; color: black;">
                    <th>No</th>
                    <th>Tanggal Masuk</th>
                    <th>No Order</th>
                    <th>Barang</th>
                    <th>Customer</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
                <?php $no = 0;
                $total = 0;
                foreach ($cetak as $row) : $no++;
                    $total += $row['jumlah'] ?>
                    <tr style="font-size: small;">
                        <td><?= $no ?></td>
                        <td><?= dateindo($row['tanggal_keluar']) ?></td>
                        <td><?= $row['no_order'] ?></td>
                        <td><?= $row['nama_barang'] ?></td>
                        <td><?= $row['customer'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td><?= $row['jumlah'] ?></td>
                    </tr>
                <?php endforeach ?>
                <!-- <tr border="1" style="font-size: small;">
                    <td colspan="6" style="font-weight: bold; text-align: center;">Total Barang Keluar</td>
                    <td style="font-weight: bold; text-align: center;"><?= $total ?></td>
                </tr> -->
            </table>
        </div>
    </div>

    <div class="tanda-tangan">
        <div class="isittd">
            <p class="text-center">Tanda Tangan</p>
            <br>
            <p class="text-center">.......................................................</p>
            <p class="text-center">Cikarang, <?= date('d F Y') ?></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>