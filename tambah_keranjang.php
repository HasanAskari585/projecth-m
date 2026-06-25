<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

include 'koneksi.php';

$user_id = $_POST['user_id'];
$produk_id = $_POST['produk_id'];
$qty = $_POST['qty'];

$cek = mysqli_query(
$conn,
"SELECT * FROM keranjang
WHERE user_id='$user_id'
AND produk_id='$produk_id'"
);

if(mysqli_num_rows($cek)>0){

    mysqli_query(

    $conn,

    "UPDATE keranjang

    SET qty = qty + $qty

    WHERE user_id='$user_id'
    AND produk_id='$produk_id'"

    );

}else{

    mysqli_query(

    $conn,

    "INSERT INTO keranjang
    (user_id,produk_id,qty)

    VALUES

    ('$user_id','$produk_id','$qty')"

    );

}

mysqli_query(

$conn,

"UPDATE produk

SET stok = stok - $qty

WHERE id='$produk_id'"

);

echo json_encode([
    "success"=>true
]);

?>