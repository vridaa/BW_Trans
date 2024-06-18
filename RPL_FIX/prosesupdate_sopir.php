<?php

    include 'koneksi.php';

    $ID_sopir = $_POST['ID_sopir'];
    $Nama_sopir = $_POST['Nama_sopir'];
    $Email_sopir = $_POST['Email_sopir'];
    $Kontak_sopir = $_POST['Kontak_sopir'];
    $Alamat_sopir = $_POST['Alamat_sopir'];

    $query = mysqli_query($connect,"UPDATE sopir SET Nama_sopir='$Nama_sopir',Email_sopir='$Email_sopir', Kontak_sopir='$Kontak_sopir', Alamat_sopir='$Alamat_sopir' WHERE ID_sopir='$ID_sopir'")or die(mysqli_error($connect));

    if($query)
    {
        header("Location: data_sopir.php");
        exit();
    }

    else
    {
        echo "Proses Update Data Gagal";
    }

?>