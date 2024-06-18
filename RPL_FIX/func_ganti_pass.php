<?php
session_start();
include 'koneksi.php';
$id = $_SESSION['id'];
$old_pass = $_POST['op'];
$new_pass = $_POST['np'];

$query = mysqli_query($connect, "SELECT * FROM sopir WHERE ID_sopir = '$id' AND password = '$old_pass'");
$cek_data = mysqli_num_rows($query);

if($cek_data == 0){
    header("location:ganti_password.php?info=tidakada");
    exit();
} else {
    $query2 = mysqli_query($connect, "UPDATE sopir SET password = '$new_pass' WHERE ID_sopir = '$id'");
    if($query2){
        header("location:profilSopir.php?info=berhasil");
        exit();
    } else {
        header("location:ganti_password_sopir.php?info=gagal");
        exit();
    }
}
?>