<?php

//fungsi menampilkan (read)
function select($query)
{
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


//fungsi menambahkan (create)
function create_barang($post)
{
    global $db;

    $nama   = strip_tags($post['nama']);
    $jumlah = strip_tags($post['jumlah']);
    $harga  = strip_tags($post['harga']);
    $barcode = rand(100000, 999999);

    //query tambah data
    $query = "INSERT INTO barang VALUES(null, '$nama', '$jumlah', '$harga', '$barcode', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi mengubah (update)
function update_barang($post)
{
    global $db;

    $id_barang = $post['id_barang'];
    $nama      = strip_tags($post['nama']);
    $jumlah    = strip_tags($post['jumlah']);
    $harga     = strip_tags($post['harga']);
    $barcode = rand(100000, 999999);

    $query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga', barcode = '$barcode' WHERE id_barang = '$id_barang'";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menghapus (delete)
function delete_barang($id_barang)
{
    global $db;

    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menambah data mahasiswa (create)
function create_mahasiswa($post)
{
    global $db;

    $nama    = strip_tags($post['nama']);
    $prodi   = strip_tags($post['prodi']);
    $jk      = strip_tags($post['jk']);
    $telepon = strip_tags($post['telepon']);
    $alamat  = $post['alamat'];
    $email   = strip_tags($post['email']);
    $foto    = upload_file();

    if (!$foto) {
        return false;
    }

    $query = "INSERT INTO mahasiswa VALUES(null, '$nama', '$prodi', '$jk', '$telepon', '$alamat', '$email', '$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function update_mahasiswa($post)
{
    global $db;

    $id_mahasiswa = strip_tags($post['id_mahasiswa']);
    $nama    = strip_tags($post['nama']);
    $prodi   = strip_tags($post['prodi']);
    $jk      = strip_tags($post['jk']);
    $telepon = strip_tags($post['telepon']);
    $alamat  = $post['alamat'];
    $email   = strip_tags($post['email']);
    $fotoLama = $post['foto'];

    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload_file();
    }

    $query = "UPDATE mahasiswa SET nama = '$nama', prodi = '$prodi', jk = '$jk', telepon = '$telepon', alamat = '$alamat', email = '$email', foto = '$foto' WHERE id_mahasiswa = '$id_mahasiswa'";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi mengupload file
function upload_file()
{
    $namaFile   = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name'];

    //check file yang diupload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile      = explode('.', $namaFile);
    $extensifile      = strtolower(end($extensifile));

    //check format file
    if (!in_array($extensifile, $extensifileValid)) {
        //pesan gagal
        echo "<script>
                alert('Format file tidak sesuai');
                document.location.href = 'tambah-mahasiswa.php';
              </script>";
        die();
    }

    //check ukuran file
    if ($ukuranFile > 2048000) {
        //pesan gagal
        echo "<script>
                alert('Ukuran File Maksimal 2 MB');
                document.location.href = 'tambah-mahasiswa.php';
              </script>";
        die();
    }

    //generate nama file baru
    $namaFileBaru  = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru);
    return $namaFileBaru;
}


//fungsi hapus data mahasiswa
function delete_mahasiswa($id_mahasiswa)
{
    global $db;

    $foto = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
    unlink("assets/img/" . $foto['foto']);

    $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi tambah akun
function create_akun($post)
{
    global $db;

    $nama     = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $email    = strip_tags($post['email']);
    $password = strip_tags($post['password']);
    $level    = strip_tags($post['level']);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$email', '$password', '$level')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi ubah akun
function update_akun($post)
{
    global $db;

    $id_akun  = strip_tags($post['id_akun']);
    $nama     = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $email    = strip_tags($post['email']);
    $password = strip_tags($post['password']);
    $level    = strip_tags($post['level']);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi hapus data akun
function delete_akun($id_akun)
{
    global $db;

    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
