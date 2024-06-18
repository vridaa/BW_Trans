<?php
    include 'koneksi.php';
    $ID_jadwal = $_GET['ID_jadwal'];

    $query = mysqli_query($connect, "DELETE FROM jadwal WHERE ID_jadwal=$ID_jadwal");

    if($query)
    {
        header("Location: data_jadwal_ketersediaan.php");
        exit();

    }else {
        echo "Proses Delete gagal";
    }
?>