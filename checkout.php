<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");
include 'koneksi.php';

$user_id = $_POST['user_id'];
$total_harga = $_POST['total_harga'];

$no_resi =
"HM" .
date("YmdHis") .
rand(100,999);

$query = mysqli_query(

$conn,

"INSERT INTO transaksi
(user_id,total_harga,status,no_resi)

VALUES

('$user_id','$total_harga','Pending','$no_resi')"

);

if($query){

    mysqli_query(
    $conn,
    "DELETE FROM keranjang
    WHERE user_id='$user_id'"
    );

}

echo json_encode([

    "success"=>$query,
    "no_resi"=>$no_resi,
    "total"=>$total_harga

]);

?>