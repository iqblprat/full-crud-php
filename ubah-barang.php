<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
            document.location.href = 'login.php';
          </script>";
    exit;
}

$title = "Ubah Data Barang";

include 'layout/header.php';

//mengambil id_barang dari url
$id_barang = (int)$_GET['id_barang'];

$barang = select("SELECT * FROM barang WHERE id_barang = $id_barang")[0];

if (isset($_POST['ubah'])) {
    if (update_barang($_POST) > 0) {
        echo "<script>
                alert('Data Barang Berhasil Diubah');
                document.location.href = 'index.php';
                </script>";
    } else {
        echo "<script>
                alert('Data Barang Gagal Diubah');
                document.location.href = 'index.php';
                </script>";
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container mt-5">
        <h1>Ubah Data Barang</h1>
        <hr>
        <form action="" method="post">
            <input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" value="<?= $barang['nama']; ?>" id="nama" name="nama" placeholder="Nama Barang..." required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" value="<?= $barang['jumlah']; ?>" name="jumlah" placeholder="Jumlah Barang..." required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Barang</label>
                <input type="number" class="form-control" id="harga" value="<?= $barang['harga']; ?>" name="harga" placeholder="Harga Barang..." required>
            </div>
            <button type="submit" name="ubah" class="btn btn-primary" style="float: right;">Simpan</button>
        </form>
    </div>
</div>
<?php include 'layout/footer.php'; ?>