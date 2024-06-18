<?php

    include 'koneksi.php';

    $ID_jadwal = $_POST['ID_jadwal'];
    $Tanggal = $_POST['Tanggal'];
    $ketersediaan_sopir = $_POST['ketersediaan_sopir'];
    $ketersediaan_armada = $_POST['ketersediaan_armada'];

    $query = mysqli_query($connect,"UPDATE jadwal SET Tanggal='$Tanggal',ketersediaan_sopir='$ketersediaan_sopir', ketersediaan_armada='$ketersediaan_armada'
    WHERE ID_jadwal='$ID_jadwal'");

    if($query)
    {
        header("Location: data_jadwal_ketersediaan.php");
        exit();
    }

    else
    {
        echo "Proses Update Data Gagal";
    }

?>