<?php

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db = getenv("MYSQL_DATABASE");
$port = getenv("MYSQLPORT");

$conn = mysqli_connect($host, $user, $pass, $db, (int)$port);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>