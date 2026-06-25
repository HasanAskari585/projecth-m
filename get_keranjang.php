<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$user_id = $_GET['user_id'];

$data = [];

$query = mysqli_query(

$conn,

"SELECT

keranjang.id,
produk.nama_produk,
produk.harga,
keranjang.qty

FROM keranjang

INNER JOIN produk
ON keranjang.produk_id = produk.id

WHERE keranjang.user_id = '$user_id'"

);

while($row = mysqli_fetch_assoc($query)){

    $data[] = $row;

}

echo json_encode($data);

?>