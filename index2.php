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

$data_barang = select("SELECT * FROM barang");
?>

<div class="container mt-5">
    <h1><i class="fas fa-box"></i> Data Barang</h1>
    <hr>
    <a href="tambah-barang.php" class="btn btn-primary mb-1"><i class="fas fa-plus-circle"></i> Tambah</a>
    <table class="table table-bordered table-striped" id="table" style="margin-bottom: 50px;">
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
            <?php $no = 1; ?>
            <?php foreach ($data_barang as $barang) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $barang['nama']; ?></td>
                    <td><?= $barang['jumlah']; ?></td>
                    <td>Rp. <?= number_format($barang['harga'], 0, ',', '.'); ?></td>
                    <td class="text-center">
                        <img src="barcode.php?codetype=Code128&size=20&text<?= $barang['barcode']; ?>&print=true" alt="<?= $barang['barcode']; ?>">
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
</div>

<?php include 'layout/footer.php'; ?>