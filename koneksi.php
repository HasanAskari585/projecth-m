<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "hm_store";

$conn = mysqli_connect($host,$user,$pass,$db);

if(!$conn){
    die("Koneksi gagal");
}

?>