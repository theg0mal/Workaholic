<?php
include 'koneksi.php';
header('Content-Type: application/json');
session_start();

// Cek sudah login belum
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "login", "pesan" => "Harus login dulu!"]);
    exit;
}

$user_id      = $_SESSION['user_id'];
$lowongan_id  = $_POST['lowongan_id'] ?? 0;
$nama         = $_POST['nama'] ?? '';
$email        = $_POST['email'] ?? '';
$no_hp        = $_POST['no_hp'] ?? '';
$kota         = $_POST['kota'] ?? '';
$pendidikan   = $_POST['pendidikan'] ?? '';
$pengalaman   = $_POST['pengalaman'] ?? '';
$gaji         = $_POST['gaji'] ?? '';
$cover_letter = $_POST['cover_letter'] ?? '';

$sql = "INSERT INTO lamaran 
        (user_id, lowongan_id, nama_lengkap, email, no_hp, kota, pendidikan, pengalaman, gaji_ekspektasi, cover_letter)
        VALUES 
        ('$user_id','$lowongan_id','$nama','$email','$no_hp','$kota','$pendidikan','$pengalaman','$gaji','$cover_letter')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "ok", "pesan" => "Lamaran berhasil dikirim!"]);
} else {
    echo json_encode(["status" => "error", "pesan" => "Gagal mengirim lamaran!"]);
}
?>