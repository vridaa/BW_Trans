<?php

    include 'koneksi.php';

    $ID_Armada = $_POST['ID_Armada'];
    $nama_Armada = $_POST['nama_Armada'];
    $jumlah_kursi = $_POST['jumlah_kursi'];
    $estimasi_harga = $_POST['estimasi_harga'];

    $query = mysqli_query($connect,"UPDATE armada SET nama_Armada='$nama_Armada',jumlah_kursi='$jumlah_kursi', estimasi_harga='$estimasi_harga'
    WHERE ID_Armada='$ID_Armada'");

    if($query)
    {
        header("Location: data_armada.php");
        exit();
    }

    else
    {
        echo "Proses Update Data Gagal";
    }

?>