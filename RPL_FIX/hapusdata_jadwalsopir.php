<?php
include 'koneksi.php';

// Ambil ID_sopir dan ID_pesanan dari parameter URL
$ID_sopir = isset($_GET['ID_sopir']) ? $_GET['ID_sopir'] : null;
$ID_pesanan = isset($_GET['ID_pesanan']) ? $_GET['ID_pesanan'] : null;

// Periksa apakah ID_sopir dan ID_pesanan tidak kosong
if ($ID_sopir && $ID_pesanan) {
    $query = mysqli_query($connect, "DELETE FROM jadwal_sopir WHERE ID_sopir='$ID_sopir' AND ID_pesanan='$ID_pesanan'");

    if ($query) {
        header("Location: data_jadwal_sopir.php?ID_sopir=" . urlencode($ID_sopir));
        exit();
    } else {
        echo "Proses Delete gagal";
    }
} else {
    echo "ID_sopir atau ID_pesanan tidak ditemukan.";
}
?>
