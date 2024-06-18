<?php
// Start the session
session_start();

// Include the database connection file
include 'koneksi.php';

// Validate the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all inputs are set
    if (empty($_POST['tujuan']) || empty($_POST['tanggal']) || empty($_POST['id_jadwal'])) {
        // Redirect back to the reservation page with an error message
        header("Location: pesan.php?error=semua-input-harus-diisi");
        exit();
    }

    // Receive data from the form
    $tujuan = $_POST['tujuan'];
    $tanggal_sewa = $_POST['tanggal'];
    $id_jadwal = $_POST['id_jadwal'];

    // Validate the date
    $tanggal_hari_ini = date("Y-m-d");
    if ($tanggal_sewa < $tanggal_hari_ini) {
        // Redirect back to the reservation page with an error message
        header("Location: pesan.php?error=tanggal-tidak-valid");
        exit();
    }

    // Calculate the price based on the destination
    switch ($tujuan) {
        case 'dalam_provinsi':
            $harga_tujuan = 600000;
            break;
        case 'solo':
            $harga_tujuan = 750000;
            break;
        case 'semarang':
            $harga_tujuan = 900000;
            break;
        case 'jakarta':
            $harga_tujuan = 1300000;
            break;
        case 'bandung':
            $harga_tujuan = 1500000;
            break;
        default:
            // Handle if the destination is not valid
            header("Location: reservation.html?error=tujuan-tidak-valid");
            exit();
    }

    // Apply discount if the vehicle type is AC (example)
    // You should adjust this part based on your actual application logic
    $jenis_kendaraan = ''; // Example: You should get this value from your form or logic
    if (strpos(strtolower($jenis_kendaraan), 'ac') !== false) {
        $harga_tujuan *= 0.85; // 15% discount
    }

    // Get customer ID from session
    $id_customer = $_SESSION['id'];

    // Save the reservation data to the database
    $sql = "INSERT INTO pemesanan (ID_jadwal, ID_customer, kota_tujuan, tanggal_resrvasi, harga)
            VALUES ('$id_jadwal', '$id_customer', '$tujuan', '$tanggal_sewa', '$harga_tujuan')";

    if ($connect->query($sql) === TRUE) {
        // Save data to the laporan_po table
        $id_pemesanan = $connect->insert_id; // Get the last inserted ID
        $id_admin=1;
        $sql_laporan = "INSERT INTO laporan_po_new (ID_pesanan, ID_admin)
                        VALUES ('$id_pemesanan', 1)";

        if ($connect->query($sql_laporan) === TRUE) {
            // Get the ID_sopir related to the ID_jadwal
            $query_sopir = "SELECT ID_sopir FROM jadwal WHERE ID_jadwal = '$id_jadwal'";
            $result_sopir = $connect->query($query_sopir);

            if ($result_sopir->num_rows > 0) {
                $row_sopir = $result_sopir->fetch_assoc();
                $id_sopir = $row_sopir['ID_sopir'];

                // Insert data into jadwal_sopir table
                $sql_jadwal_sopir = "INSERT INTO jadwal_sopir (ID_sopir, ID_pesanan)
                                     VALUES ('$id_sopir', '$id_pemesanan')";

                if ($connect->query($sql_jadwal_sopir) === TRUE) {
                    // Redirect to the customer dashboard after successful reservation
                    header("Location: berandaCuss.php");
                    exit();
                } else {
                    // If there is an error in inserting data into jadwal_sopir
                    echo "Error: " . $sql_jadwal_sopir . "<br>" . $connect->error;
                }
            } else {
                // If no sopir found for the given jadwal
                echo "Error: ID_sopir not found for the given ID_jadwal";
            }
        } else {
            // If there is an error in inserting data into laporan_po
            echo "Error: " . $sql_laporan . "<br>" . $connect->error;
        }
    } else {
        // If an error occurs while saving the data to pemesanan table
        echo "Error: " . $sql . "<br>" . $connect->error;
    }

    // Close the connection
    $connect->close();
} else {
    // If the request method is not POST, redirect back to the reservation page with an error message
    header("Location: pesan.php?error=invalid-method");
    exit();
}
?>