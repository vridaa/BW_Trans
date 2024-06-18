<?php
session_start(); // Start the session at the beginning
include 'koneksi.php';

if (isset($_POST['submit'])) {
    // Validasi input
    $id_sopir = mysqli_real_escape_string($connect, $_POST['ID_sopir']);
    $id_armada = mysqli_real_escape_string($connect, $_POST['ID_Armada']);
    $id_pesanan = mysqli_real_escape_string($connect, $_POST['id_pesanan']); // Use 'id_pesanan' (consistent with form)
    $id_jadwal = mysqli_real_escape_string($connect, $_POST['ID_jadwal']); // Assuming you have this in the form

    // Query INSERT with prepared statements
    $stmt = mysqli_prepare($connect, "INSERT INTO jadwal_sopir (ID_sopir, ID_Armada, ID_pesanan, ID_jadwal) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iiii", $id_sopir, $id_armada, $id_pesanan, $id_jadwal); // 4 integers

    if (mysqli_stmt_execute($stmt)) {
        // Success: Redirect and set success message
        $_SESSION['pesan_sukses'] = "Data berhasil ditambahkan.";
        header("Location: data_jadwal_sopir.php?ID_sopir=$id_sopir&pesan=input_berhasil");
        exit(); 
    } else {
        // Error: Log the error for debugging and redirect with error message
        error_log("Error inserting data: " . mysqli_error($connect)); // Log to error log
        $_SESSION['pesan_error'] = "Terjadi kesalahan saat menambahkan data.";
        header("Location: data_jadwal_sopir.php?ID_sopir=$id_sopir"); 
        exit();
    }

    // Close statement and connection (good practice)
    mysqli_stmt_close($stmt);
    mysqli_close($connect);
}
?>
