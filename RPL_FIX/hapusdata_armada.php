<?php
    include 'koneksi.php';
    $ID_Armada = $_GET['ID_Armada'];

    $query = mysqli_query($connect, "DELETE FROM armada WHERE ID_Armada=$ID_Armada");

    if($query)
    {
        header("Location: data_armada.php");
        exit();

    }else {
        echo "Proses Delete gagal";
    }
?>