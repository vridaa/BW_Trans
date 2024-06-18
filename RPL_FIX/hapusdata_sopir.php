<?php
    include 'koneksi.php';
    $ID_sopir = $_GET['ID_sopir'];

    $query = mysqli_query($connect, "DELETE FROM sopir WHERE ID_sopir=$ID_sopir");

    if($query)
    {
        header("Location: data_sopir.php");
        exit();

    }else {
        echo "Proses Delete gagal";
    }
?>