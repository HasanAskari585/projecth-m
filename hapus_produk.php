<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");
include 'koneksi.php';

$id = $_POST['id'] ?? '';

$query = mysqli_query(
    $conn,
    "DELETE FROM produk WHERE id='$id'"
);

echo json_encode([
    "success" => $query
]);

?>