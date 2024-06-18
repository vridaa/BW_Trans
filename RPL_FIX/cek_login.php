<?php
session_start();
include 'koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];
$kategori = $_POST['kategori'];

// Ubah query berdasarkan struktur tabel dan kolom yang Anda miliki
$query = "SELECT * FROM ";
if ($kategori == 'admin') {
    $query .= "admin WHERE Email_admin = ? AND password = ?";
    $id_column = 'ID_admin'; // Sesuaikan dengan nama kolom ID di tabel owner
} elseif ($kategori == 'supir') {
    $query .= "sopir WHERE Email_Sopir = ? AND password = ?";
    $id_column = 'ID_sopir'; // Sesuaikan dengan nama kolom ID di tabel sopir
} elseif ($kategori == 'pengguna') {
    $query .= "customer WHERE Email_Customer = ? AND password = ?";
    $id_column = 'ID_customer'; // Sesuaikan dengan nama kolom ID di tabel customer
} else {
    // Handle invalid kategori
    header("location: berandaAwal.php?pesan=invalid_kategori");
    exit();
}

if ($stmt = $connect->prepare($query)) {
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $cek = $result->num_rows;

    if ($cek > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row[$id_column]; // Ambil nilai ID dari kolom yang sesuai
        $_SESSION['status'] = "login";

        // Sesuaikan header location berdasarkan jenis kategori
        if ($kategori == 'admin') {
            header("location: berandaAdmin.php");
        } elseif ($kategori == 'supir') {
            header("location: berandaSopir.php");
        } elseif ($kategori == 'pengguna') {
            header("location: cus/berandaCuss.php");
        }
        exit();
    } else {
        header("location: berandaAwal.php?pesan=gagal");
        exit();
    }

    $stmt->close();
} else {
    // Handle error saat menyiapkan statement
    header("location: berandaAwal.php?pesan=error_database"); // Atau tampilkan pesan error yang lebih spesifik
    exit();
}
?>

