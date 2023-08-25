<?php
header('Content-Type: application/json');
require '../config/app.php';

$query = select("SELECT * FROM barang");

echo json_encode(['data_barang' => $query], JSON_PRETTY_PRINT);
