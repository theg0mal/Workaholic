<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "workaholic_db"; // ganti sesuai nama database kamu

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die(json_encode(["status" => "error", "pesan" => "Koneksi gagal!"]));
}
?>