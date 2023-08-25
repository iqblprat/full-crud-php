<?php
header('Content-Type: application/json');

require '../config/app.php';

parse_str(file_get_contents('php://input'), $delete);

$id_barang = $delete['id_barang'];

$query = "DELETE FROM barang WHERE id_barang = $id_barang";
mysqli_query($db, $query);

if ($query) {
    echo json_encode(['pesan' => 'Data Barang Berhasil Dihapus']);
} else {
    echo json_encode(['pesan' => 'Data Gagal Berhasil Dihapus']);
}
