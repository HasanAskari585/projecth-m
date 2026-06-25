<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");
include 'koneksi.php';

$user_id = $_GET['user_id'];

$data = [];

$query = mysqli_query(
$conn,

"SELECT *
FROM transaksi
WHERE user_id='$user_id'
ORDER BY id DESC"

);

while($row=mysqli_fetch_assoc($query)){
    $data[]=$row;
}

echo json_encode($data);

?>