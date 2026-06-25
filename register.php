<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

include 'koneksi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = md5($_POST['password']);

$query = mysqli_query(
$conn,
"INSERT INTO users(nama,email,password)
VALUES('$nama','$email','$password')"
);

if($query){
    echo json_encode([
        "success"=>true,
        "message"=>"Registrasi berhasil"
    ]);
}else{
    echo json_encode([
        "success"=>false,
        "message"=>"Registrasi gagal"
    ]);
}

?>