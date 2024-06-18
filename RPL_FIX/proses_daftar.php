<?php 
include "koneksi.php";

session_start(); // Mulai sesi

$namalengkap = $_POST['namalengkap'];
$noHP = $_POST['noHP'];
$email = $_POST['email'];
$password = $_POST['password']; // Hashing password for security

// Insert the new customer into the database
$query = mysqli_query($connect, "INSERT INTO customer (Nama_customer, Email_customer, Kontak_customer, password) VALUES ('$namalengkap', '$email', '$noHP', '$password')") 
or die(mysqli_error($connect));

// Retrieve the ID of the newly inserted customer
$id_customer = mysqli_insert_id($connect);

// Set session for the admin with ID
$_SESSION['id'] = $id_customer;
$_SESSION['kategori'] = 'pengguna';

// Redirect to berandaCuss.php
header("location:cus/berandaCuss.php");
?>

