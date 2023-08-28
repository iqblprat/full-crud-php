<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
            document.location.href = 'login.php';
          </script>";
    exit;
}

$title = "Ubah Data Mahasiswa";

include 'layout/header.php';

if (isset($_POST['ubah'])) {
    if (update_mahasiswa($_POST) > 0) {
        echo "<script>
                alert('Data Mahasiswa Berhasil Diubah');
                document.location.href = 'mahasiswa.php';
                </script>";
    } else {
        echo "<script>
                alert('Data Mahasiswa Gagal Diubah');
                document.location.href = 'mahasiswa.php';
                </script>";
    }
}

$id_mahasiswa = (int)$_GET['id_mahasiswa'];

$mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container mt-5">
        <h1>Ubah Data Mahasiswa</h1>
        <hr>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa']; ?>">
            <input type="hidden" name="fotoLama" value="<? $mahasiswa['foto']; ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa..." value="<?= $mahasiswa['nama']; ?>" required>
            </div>

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <select name="prodi" id="prodi" class="form-control">
                        <?php $prodi = $mahasiswa['prodi']; ?>
                        <option value="">-- pilih program studi --</option>
                        <option value="Teknik Informatika" <?= $prodi == 'Teknik Informatika' ? 'selected' : null ?>>Teknik Informatika</option>
                        <option value="Teknik Mesin" <?= $prodi == 'Teknik Mesin' ? 'selected' : null ?>>Teknik Mesin</option>
                        <option value="Teknik Listrik" <?= $prodi == 'Teknik Listrik' ? 'selected' : null ?>>Teknik Listrik</option>
                    </select>
                </div>
                <div class="mb-3 col-6">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-control">
                        <?php $jk = $mahasiswa['jk']; ?>
                        <option value="">-- pilih jenis kelamin --</option>
                        <option value="Laki-Laki" <?= $jk == 'Laki-Laki' ? 'selected' : null ?>>Laki-Laki</option>
                        <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="telepon" class="form-label">Nomor Telepon</label>
                <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Nomor Telepon Mahasiswa..." value="<?= $mahasiswa['telepon']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea id="alamat" name="alamat" placeholder="Alamat Mahasiswa..."><?= $mahasiswa['alamat']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email Mahasiswa..." value="<?= $mahasiswa['email']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto Mahasiswa..." onchange="previewImg()">

                <img src="assets/img/<?= $mahasiswa['foto']; ?>" alt="" class="img-thumbnail img-preview mt-3" width="100px">
            </div>

            <button type="submit" name="ubah" class="btn btn-primary" style="float: right;">Simpan</button>
        </form>
    </div>
</div>
<script>
    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?php include 'layout/footer.php'; ?>