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

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();
$activeWorksheet->setCellValue('A2', 'No');
$activeWorksheet->setCellValue('B2', 'Nama');
$activeWorksheet->setCellValue('C2', 'Program Studi');
$activeWorksheet->setCellValue('D2', 'Jenis Kelamin');
$activeWorksheet->setCellValue('E2', 'Nomor Telepon');
$activeWorksheet->setCellValue('F2', 'Email');
$activeWorksheet->setCellValue('G2', 'Foto');

$data_mahasiswa = select("SELECT * FROM mahasiswa");

$no = 1;
$start = 3;

foreach ($data_mahasiswa as $mahasiswa) {
    $activeWorksheet->setCellValue('A' . $start, $no++);
    $activeWorksheet->getColumnDimension('A')->setAutoSize(true);

    $activeWorksheet->setCellValue('B' . $start, $mahasiswa['nama']);
    $activeWorksheet->getColumnDimension('B')->setAutoSize(true);

    $activeWorksheet->setCellValue('C' . $start, $mahasiswa['prodi']);
    $activeWorksheet->getColumnDimension('C')->setAutoSize(true);

    $activeWorksheet->setCellValue('D' . $start, $mahasiswa['jk']);
    $activeWorksheet->getColumnDimension('D')->setAutoSize(true);

    $activeWorksheet->setCellValue('E' . $start, $mahasiswa['telepon']);
    $activeWorksheet->getColumnDimension('E')->setAutoSize(true);

    $activeWorksheet->setCellValue('F' . $start, $mahasiswa['email']);
    $activeWorksheet->getColumnDimension('F')->setAutoSize(true);

    $activeWorksheet->setCellValue('G' . $start, 'http://localhost/crud-php/assets/img/' . $mahasiswa['foto']);
    $activeWorksheet->getColumnDimension('G')->setAutoSize(true);


    $start++;
}

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$border = $start - 1;

$activeWorksheet->getStyle('A2:G' . $border)->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$writer->save('Laporan Data Mahasiswa.xlsx');
header('Content-Type: application/vnc.openxmlformats-officedocument.spreadsheet.sheet');
header('Content-Disposition: attachment;filename="Laporan Data Mahasiswa.xlsx"');
readfile('Laporan Data Mahasiswa.xlsx');
unlink('Laporan Data Mahasiswa.xlsx');
exit;
