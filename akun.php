<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
            alert('Silakan Login terlebih dahulu.');
            document.location.href = 'login.php';
          </script>";
    exit;
}

$title = "Data Akun";

include 'layout/header.php';

$data_akun = select("SELECT * FROM akun");

$id_akun = $_SESSION['id_akun'];
$data_bylogin = select("SELECT * FROM akun WHERE id_akun = $id_akun");

if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
        alert('Data Akun Berhasil Ditambahkan');
        document.location.href = 'crud-modal.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Akun Gagal Ditambahkan');
        document.location.href = 'crud-modal.php';
        </script>";
    }
}

if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "<script>
        alert('Data Akun Berhasil Diubah');
        document.location.href = 'crud-modal.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Akun Gagal Diubah');
        document.location.href = 'crud-modal.php';
        </script>";
    }
}
?>

<div class="content-wrapper">
    <div class="container mt-5">
        <h1><i class="fas fa-user"></i> Data Akun</h1>
        <hr>
        <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</button>
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if ($_SESSION['level'] == 1) : ?>
                    <?php foreach ($data_akun as $akun) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $akun['nama']; ?></td>
                            <td><?= $akun['username']; ?></td>
                            <td><?= $akun['email']; ?></td>
                            <td>Password Ter-enkripsi</td>
                            <td class="text-center" width="20%">
                                <button type="button" class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#modalUbah<?= $akun['id_akun']; ?>"><i class="fas fa-edit"></i> Ubah</button>
                                <button type="button" class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#modalHapus<?= $akun['id_akun']; ?>"><i class="fas fa-trash"></i> Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php foreach ($data_bylogin as $akun) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $akun['nama']; ?></td>
                            <td><?= $akun['username']; ?></td>
                            <td><?= $akun['email']; ?></td>
                            <td>Password Ter-enkripsi</td>
                            <td class="text-center" width="15%">
                                <button type="button" class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#modalUbah<?= $akun['id_akun']; ?>"><i class="fas fa-edit"></i> Ubah</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required minlength="6">
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control" required>
                                <option value="">-- pilih level --</option>
                                <option value="1">Admin</option>
                                <option value="2">Operator Barang</option>
                                <option value="3">Operator Mahasiswa</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php foreach ($data_akun as $akun) : ?>
        <!-- Modal Ubah -->
        <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $akun['nama']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?= $akun['username']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= $akun['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <small>(Masukkan Password baru/lama)</small></label>
                                <input type="password" name="password" id="password" class="form-control" value="" required minlength="6">
                            </div>
                            <?php if ($_SESSION['level'] == 1) : ?>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select name="level" id="level" class="form-control" required>
                                        <?php $level = $akun['level']; ?>
                                        <option value="1" <?= $level == '1' ? 'selected' : ''; ?>>Admin</option>
                                        <option value="2" <?= $level == '2' ? 'selected' : ''; ?>>Operator Barang</option>
                                        <option value="3" <?= $level == '3' ? 'selected' : ''; ?>>Operator Mahasiswa</option>
                                    </select>
                                </div>
                            <?php else : ?>
                                <input type="hidden" name="level" value="<?= $_SESSION['level']; ?>">
                            <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button name="ubah" class="btn btn-success">Ubah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($data_akun as $akun) : ?>
        <!-- Modal Hapus -->
        <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin Ingin Menghapus Data Akun <?= $akun['nama']; ?>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <a href="hapus-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>

<?php include 'layout/footer.php'; ?>