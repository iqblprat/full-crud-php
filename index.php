<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
            alert('Silakan Login terlebih dahulu.');
            document.location.href = 'login.php';
          </script>";
    exit;
}


if ($_SESSION['level'] != 1 and $_SESSION['level'] != 2) {
    echo "<script>
            alert('Anda tidak memiliki hak akses.');
            document.location.href = 'index.php';
          </script>";
    exit;
}

$title = "Data Barang";

include 'layout/header.php';

if (isset($_POST['filter'])) {
    $tglAwal = strip_tags($_POST['tglAwal'] . " 00:00:00");
    $tglAkhir = strip_tags($_POST['tglAkhir'] . " 23:59:59");

    $data_barang = select("SELECT * FROM barang WHERE tanggal BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY id_barang DESC");
} else {
    // pagination
    $jumlahDataPerhalaman = 4;
    $jumlahData           = count(select("SELECT * FROM barang"));
    $jumlahHalaman        = ceil($jumlahData / $jumlahDataPerhalaman);
    $halamanAktif         = (isset($_GET['halaman']) ? $_GET['halaman'] : 1);
    $awalData             = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

    $data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC LIMIT $awalData, $jumlahDataPerhalaman");
}

$data_mahasiswa = select("SELECT * FROM mahasiswa");
$data_akun = select("SELECT * FROM akun");
$data_pegawai = select("SELECT * FROM pegawai");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $totalBarang = count(select("SELECT * FROM barang"));
                            ?>
                            <h3><?= $totalBarang; ?></h3>

                            <p>Data Barang</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <a href="index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            $totalMahasiswa = count($data_mahasiswa);
                            ?>
                            <h3><?= $totalMahasiswa; ?></h3>

                            <p>Data Mahasiswa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <a href="mahasiswa.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            $totalAkun = count($data_akun);
                            ?>
                            <h3><?= $totalAkun; ?></h3>

                            <p>Data Akun</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="akun.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php
                            $totalPegawai = count($data_pegawai);
                            ?>
                            <h3><?= $totalPegawai; ?></h3>

                            <p>Data Pegawai</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="pegawai.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Barang</h3>
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body">
                                    <a href="tambah-barang.php" class="btn btn-primary btn-sm mb-2"><i class="fas fa-plus"></i> Tambah Barang</a>
                                    <button type="button" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#modalFilter">
                                        <i class="fas fa-search"></i> Filter Data
                                    </button>
                                    <table id="" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Barcode</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_barang as $barang) : ?>
                                                <tr>
                                                    <td><?= $awalData += 1; ?></td>
                                                    <td><?= $barang['nama']; ?></td>
                                                    <td><?= $barang['jumlah']; ?></td>
                                                    <td>Rp. <?= number_format($barang['harga'], 0, ',', '.'); ?></td>
                                                    <td class="text-center">
                                                        <img src="barcode.php?codetype=Code128&size=20&text=<?= $barang['barcode']; ?>&print=true" alt="<?= $barang['barcode']; ?>">
                                                    </td>
                                                    <td><?= date("d/m/Y | H:i:s", strtotime($barang['tanggal'])); ?></td>
                                                    <td width="20%" class="text-center">
                                                        <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-success"><i class="fas fa-edit"></i> Ubah</a>
                                                        <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger" onclick="return confirm('Yakin Data Barang akan Dihapus?')"><i class="fas fa-trash"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div class="mt-3 justify-content-end d-flex">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <?php if ($halamanAktif) : ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="?halaman<?= $halamanAktif - 1 ?>" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                                    <?php if ($i == $halamanAktif) : ?>
                                                        <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                                                    <?php else : ?>
                                                        <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                                                    <?php endif; ?>
                                                <?php endfor; ?>

                                                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- Modal Tambah -->
            <div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Filter Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="tglAwal">Tanggal Awal</label>
                                    <input type="date" name="tglAwal" id="tglAwal" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tglAkhir">Tanggal Akhir</label>
                                    <input type="date" name="tglAkhir" id="tglAkhir" class="form-control">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" name="filter" class="btn btn-success">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.content-wrapper -->
            <?php include 'layout/footer.php'; ?>