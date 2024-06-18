<?php
session_start();
if (empty($_SESSION['id'])) {
    header("location:berandaAwal.php?pesan=belum_login");
}
$ID_owner = $_SESSION['id'];

include 'koneksi.php';

if (isset($_POST['submit'])) {
    $ID_sopir = $_POST['ID_sopir'];
    $ID_pesanan = $_POST['ID_pesanan'];
    $hari = $_POST['hari'];
    $tanggal_sewa = $_POST['tanggal_sewa'];

    // Update data jadwal sopir
    $query = "UPDATE jadwal_sopir SET hari = '$hari', tanggal_sewa = '$tanggal_sewa' WHERE ID_sopir = '$ID_sopir' AND ID_pesanan = '$ID_pesanan'";

    if (mysqli_query($connect, $query)) {
        header("location:jadwal_sopir.php?ID_sopir=$ID_sopir&pesan=edit_berhasil");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
}
?>
