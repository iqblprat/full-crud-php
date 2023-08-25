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

require 'config/app.php';
require __DIR__ . '/vendor/autoload.php';

$data_mahasiswa = select("SELECT * FROM mahasiswa");

use Spipu\Html2Pdf\Html2Pdf;

$no = 1;
$start = 3;


$content = '
<style type="text/css">
    .gambar {
        width: 50px;
    }
</style>
';

$content .= '
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <h1>Laporan Data Mahasiswa</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Program Studi</th>
                <th>Jenis Kelamin</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
';

foreach ($data_mahasiswa as $mahasiswa) {
    $content .= '
            <tr>
                <td>' . $no++ . '</td>
                <td>' . $mahasiswa['nama'] . '</td>
                <td>' . $mahasiswa['prodi'] . '</td>
                <td>' . $mahasiswa['jk'] . '</td>
                <td>' . $mahasiswa['telepon'] . '</td>
                <td>' . $mahasiswa['email'] . '</td>
            </tr>
    ';
}


$content .= '
        </tbody>
    </table>
</body>
</html>
';

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
ob_start();
$html2pdf->output('laporan-data-mahasiswa.pdf');
