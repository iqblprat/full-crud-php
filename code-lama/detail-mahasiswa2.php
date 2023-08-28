<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
            document.location.href = 'login.php';
          </script>";
    exit;
}

$title = "Detail Mahasiswa";

include 'layout/header.php';

$id_mahasiswa = (int)$_GET['id_mahasiswa'];

$mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
?>

<div class="container mt-5 mb-3">
    <h1>Detail <?= $mahasiswa['nama']; ?></h1>
    <hr>
    <table class="table table-bordered table-striped table-hover">
        <tbody>
            <tr>
                <td width="30%">Nama</td>
                <td><?= $mahasiswa['nama']; ?></td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td><?= $mahasiswa['prodi']; ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td><?= $mahasiswa['jk']; ?></td>
            </tr>
            <tr>
                <td>Nomor Telepon</td>
                <td><?= $mahasiswa['telepon']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?= $mahasiswa['alamat']; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= $mahasiswa['email']; ?></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td>
                    <a href="assets/img/<?= $mahasiswa['foto']; ?>">
                        <img src="assets/img/<?= $mahasiswa['foto']; ?>" alt="" width="50%">
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    <a href="mahasiswa.php" class="btn btn-secondary" style="float: right; margin-bottom: 50px;">Kembali</a>
</div>

<?php include 'layout/footer.php'; ?>