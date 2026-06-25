<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'] ?? '';
    $password = md5($_POST['password'] ?? '');

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users
         WHERE email='$email'
         AND password='$password'"
    );

    $data = mysqli_fetch_assoc($query);

    if ($data) {

        echo json_encode([
            "success" => true,
            "user" => $data
        ]);

    } else {

        echo json_encode([
            "success" => false,
            "message" => "Login gagal"
        ]);

    }

} else {

    echo json_encode([
        "success" => false,
        "message" => "Gunakan metode POST"
    ]);

}
?>