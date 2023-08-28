<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
            document.location.href = 'login.php';
          </script>";
    exit;
}

$title = "Tambah Data Mahasiswa";

include 'layout/header.php';

if (isset($_POST['tambah'])) {
    if (create_mahasiswa($_POST) > 0) {
        echo "<script>
                alert('Data Mahasiswa Berhasil Ditambahkan');
                document.location.href = 'mahasiswa.php';
                </script>";
    } else {
        echo "<script>
                alert('Data Mahasiswa Gagal Ditambahkan');
                document.location.href = 'mahasiswa.php';
                </script>";
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container mt-5">
        <h1>Tambah Data Mahasiswa</h1>
        <hr>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa..." required>
            </div>

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <select name="prodi" id="prodi" class="form-control">
                        <option value="">-- pilih program studi --</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Teknik Mesin">Teknik Mesin</option>
                        <option value="Teknik Listrik">Teknik Listrik</option>
                    </select>
                </div>
                <div class="mb-3 col-6">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-control">
                        <option value="">-- pilih jenis kelamin --</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="telepon" class="form-label">Nomor Telepon</label>
                <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Nomor Telepon Mahasiswa..." required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea id="alamat" name="alamat" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email Mahasiswa..." required>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto Mahasiswa..." onchange="previewImg()">

                <img src="" alt="" class="img-thumbnail img-preview mt-3" width="100px">
            </div>

            <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>
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