<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$id = $_POST['id'];
$qty = $_POST['qty'];

$query = mysqli_query(
$conn,
"UPDATE keranjang
SET qty='$qty'
WHERE id='$id'"
);

echo json_encode([
    "success"=>$query
]);

?>