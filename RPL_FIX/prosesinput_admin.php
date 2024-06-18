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
$Nama_admin = mysqli_real_escape_string($connect, $_POST['Nama_admin']);
$Email_admin = mysqli_real_escape_string($connect, $_POST['Email_admin']);
$Kontak_admin = mysqli_real_escape_string($connect, $_POST['Kontak_admin']);
$Alamat_admin = mysqli_real_escape_string($connect, $_POST['Alamat_admin']);

// Query untuk menambahkan data ke tabel admin
$query = "INSERT INTO admin (Nama_admin, Email_admin, Kontak_admin, Alamat_admin) VALUES ('$Nama_admin', '$Email_admin', '$Kontak_admin', '$Alamat_admin')";

$result = mysqli_query($connect, $query);

// Periksa apakah query berhasil
if ($result) {
    header("Location: data_admin.php");
    exit();
} else {
    echo "Proses Input Data Gagal: " . mysqli_error($connect);
}

?>
