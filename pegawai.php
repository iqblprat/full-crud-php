<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
            document.location.href = 'login.php';
          </script>";
    exit;
}

if ($_SESSION['level'] != 1 and $_SESSION['level'] != 3) {
    echo "<script>
            alert('Anda tidak memiliki hak akses.');
            document.location.href = 'index.php';
          </script>";
    exit;
}

$title = "Data Pegawai (Realtime)";

include 'layout/header.php';

//menampilkan data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
?>

<div class="content-wrapper">
    <div class="container mt-5 mb-3">
        <h1><i class="fas fa-user-tie"></i> Data Pegawai (Realtime)</h1>
        <hr>
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody id="liveData">
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $('document').ready(function() {
        setInterval(function() {
            getPegawai()
        }, 1000)
    });

    function getPegawai() {
        $.ajax({
            url: "realtime-pegawai.php",
            type: "GET",
            success: function(response) {
                $('#liveData').html(response)
            }
        });
    }
</script>

<?php include 'layout/footer.php'; ?>