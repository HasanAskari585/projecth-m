<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

include 'koneksi.php';

$nama_produk = $_POST['nama_produk'] ?? '';
$kategori = $_POST['kategori'] ?? '';
$harga = $_POST['harga'] ?? '';
$stok = $_POST['stok'] ?? '';
$gambar = $_POST['gambar'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';

$query = mysqli_query(
    $conn,
    "INSERT INTO produk
    (nama_produk,kategori,harga,stok,gambar,deskripsi)
    VALUES
    ('$nama_produk','$kategori','$harga','$stok','$gambar','$deskripsi')"
);

echo json_encode([
    "success" => $query
]);

?>