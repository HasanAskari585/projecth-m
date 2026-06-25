<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query(

$conn,

"UPDATE transaksi
SET status='$status'
WHERE id='$id'"

);

header("Location: pesanan.php");

?>