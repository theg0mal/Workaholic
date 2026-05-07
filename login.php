<?php
include 'koneksi.php';
header('Content-Type: application/json');
session_start();

$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    echo json_encode(["status" => "error", "pesan" => "Email dan password wajib diisi!"]);
    exit;
}

$sql  = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    // Login berhasil, simpan session
    $_SESSION['user_id']   = $user['id'];
    $_SESSION['user_nama'] = $user['nama'];
    echo json_encode(["status" => "ok", "nama" => $user['nama']]);
} else {
    echo json_encode(["status" => "error", "pesan" => "Email atau password salah!"]);
}
?>