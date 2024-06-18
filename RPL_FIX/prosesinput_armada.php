<?php
    session_start(); // Pastikan session_start() ada di bagian atas

    include 'koneksi.php';

    // Ambil nilai dari POST
    $nama_Armada = $_POST['nama_Armada'];
    $jumlah_kursi = $_POST['jumlah_kursi'];
    $estimasi_harga = $_POST['estimasi_harga'];

    // Ambil id_admin dari sesi
    $id_admin = $_SESSION['id'];

    // Query untuk menambahkan data termasuk id_admin
    $query = mysqli_query($connect,"INSERT INTO armada (nama_Armada, jumlah_kursi, estimasi_harga, id_admin) VALUES ('$nama_Armada', '$jumlah_kursi', '$estimasi_harga', '$id_admin')");

    // Periksa apakah query berhasil
    if($query) {
        header("Location: data_armada.php");
        exit();
    } else {
        echo "Proses Input Data Gagal";
    }
?>