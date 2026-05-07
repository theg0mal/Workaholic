<?php
include 'koneksi.php';
header('Content-Type: application/json');

$nama     = $_POST['nama'] ?? '';
$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$no_hp    = $_POST['no_hp'] ?? '';
$kota     = $_POST['kota'] ?? '';

// Validasi tidak boleh kosong
if (!$nama || !$email || !$password) {
    echo json_encode(["status" => "error", "pesan" => "Data tidak lengkap!"]);
    exit;
}

// Cek email sudah terdaftar belum
$cek = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
if (mysqli_num_rows($cek) > 0) {
    echo json_encode(["status" => "error", "pesan" => "Email sudah terdaftar!"]);
    exit;
}

// Enkripsi password
$hash = password_hash($password, PASSWORD_DEFAULT);

// Simpan ke database
$sql = "INSERT INTO users (nama, email, password, no_hp, kota)
        VALUES ('$nama', '$email', '$hash', '$no_hp', '$kota')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "ok", "pesan" => "Registrasi berhasil!"]);
} else {
    echo json_encode(["status" => "error", "pesan" => "Gagal menyimpan data!"]);
}
?>