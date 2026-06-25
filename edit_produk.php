<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");
include 'koneksi.php';

$id = $_POST['id'] ?? '';
$nama_produk = $_POST['nama_produk'] ?? '';
$kategori = $_POST['kategori'] ?? '';
$harga = $_POST['harga'] ?? '';
$stok = $_POST['stok'] ?? '';
$gambar = $_POST['gambar'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';

$query = mysqli_query(
    $conn,
    "UPDATE produk SET
    nama_produk='$nama_produk',
    kategori='$kategori',
    harga='$harga',
    stok='$stok',
    gambar='$gambar',
    deskripsi='$deskripsi'
    WHERE id='$id'"
);

echo json_encode([
    "success" => $query
]);

?>