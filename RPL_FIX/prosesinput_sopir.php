<?php
session_start();

include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id'])) {
    header("Location: berandaAwal.php?pesan=belum_login");
    exit();
}

// Ambil id_admin dari sesi
$id_admin = $_SESSION['id'];

// Ambil data dari POST
$Nama_sopir = mysqli_real_escape_string($connect, $_POST['Nama_sopir']);
$Email_sopir = mysqli_real_escape_string($connect, $_POST['Email_sopir']);
$Kontak_sopir = mysqli_real_escape_string($connect, $_POST['Kontak_sopir']);
$Alamat_sopir = mysqli_real_escape_string($connect, $_POST['Alamat_sopir']);

// Query untuk menambahkan data ke tabel sopir
$query = "INSERT INTO sopir (Nama_sopir, Email_sopir, Kontak_sopir, Alamat_sopir, ID_admin) VALUES ('$Nama_sopir', '$Email_sopir', '$Kontak_sopir', '$Alamat_sopir', '$id_admin')";

$result = mysqli_query($connect, $query);

// Periksa apakah query berhasil
if ($result) {
    header("Location: data_sopir.php");
    exit();
} else {
    echo "Proses Input Data Gagal: " . mysqli_error($connect);
}

?>
