<?php
session_start();
if (empty($_SESSION['id'])) {
    header("location:../berandaAwal.php?pesan=belum_login");
    exit();
}
$id = $_SESSION['id'];

include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $id_jadwal = $_POST['tanggal']; // ID_jadwal yang dipilih oleh pengguna
    $lama_sewa = $_POST['lama_sewa'];
    $jumlah_sopir = 1;
    $jumlah_bis = 1;
    $id_customer = $_SESSION['id'];
    // Generate a unique booking code
    $kode_booking = uniqid('BOOK-');

    $tanggal_reservasi = date("Y-m-d H:i:s");
    // Define the default status as "Belum Bayar"
    $status_pesanan = "Belum Bayar";    

    // Get the ID_armada from jadwal table based on selected ID_jadwal
    $sql_jadwal = "SELECT ID_armada FROM jadwal WHERE ID_jadwal = '$id_jadwal'";
    $result_jadwal = $connect->query($sql_jadwal);

    if ($result_jadwal && $result_jadwal->num_rows > 0) {
        $row_jadwal = $result_jadwal->fetch_assoc();
        $id_armada = $row_jadwal['ID_armada'];

        // Now you can proceed to query armada table to get estimasi_harga
        $sql_armada = "SELECT estimasi_harga FROM armada WHERE ID_Armada = '$id_armada'";
        $result_armada = $connect->query($sql_armada);
        
        if ($result_armada && $result_armada->num_rows > 0) {
            $row_armada = $result_armada->fetch_assoc();
            $estimasi_harga = $row_armada['estimasi_harga'];

            // Calculate total payment
            $harga = $estimasi_harga * $lama_sewa;

            // Proceed with inserting into pemesanan and other tables
            // Insert data into pemesanan
            $sql_pemesanan = "INSERT INTO pemesanan ( ID_customer, ID_jadwal, kota_tujuan, tanggal_reservasi, harga, status_pesanan)
            VALUES ('$id_customer', '$id_jadwal', '$tujuan', '$tanggal_reservasi', '$harga', '$status_pesanan')";

            if ($connect->query($sql_pemesanan) === TRUE) {
                $id_pesanan = $connect->insert_id; // Get the last inserted ID

                // Insert data into detail_pemesanan
                $sql_detail_pemesanan = "INSERT INTO detail_pemesanan (ID_pesanan, Lama_sewa, Jumlah_sopir, Jumlah_bis, kode_booking, atas_nama, asal)
                        VALUES ('$id_pesanan', '$lama_sewa',  '$jumlah_sopir', '$jumlah_bis', '$kode_booking', '$nama', '$asal')";
                if ($connect->query($sql_detail_pemesanan) === TRUE) {
                    // Insert data into laporan_po_new
                    $sql_laporan = "INSERT INTO laporan_po_new (ID_pesanan, ID_admin)
                                    VALUES ('$id_pesanan', 1)";

                    if ($connect->query($sql_laporan) === TRUE) {
                        // Get the ID_sopir related to the ID_jadwal
                        $query_sopir = "SELECT ID_sopir FROM jadwal WHERE ID_jadwal = '$id_jadwal'";
                        $result_sopir = $connect->query($query_sopir);

                        if ($result_sopir && $result_sopir->num_rows > 0) {
                            $row_sopir = $result_sopir->fetch_assoc();
                            $id_sopir = $row_sopir['ID_sopir'];

                            // Insert data into jadwal_sopir table
                            $sql_jadwal_sopir = "INSERT INTO jadwal_sopir (ID_sopir, ID_pesanan)
                                                VALUES ('$id_sopir', '$id_pesanan')";
                            if ($connect->query($sql_jadwal_sopir) === TRUE) {
                                // Redirect to the customer dashboard after successful reservation
                                header("Location: sukses.php?id_pesanan=$id_pesanan");
                                exit();
                            } else {
                                echo "Error: " . $sql_jadwal_sopir . "<br>" . $connect->error;
                            }
                        } else {
                            echo "Error: ID_sopir not found for the given ID_jadwal";
                        }
                    } else {
                        echo "Error: " . $sql_laporan . "<br>" . $connect->error;
                    }
                } else {
                    echo "Error: " . $sql_detail_pemesanan . "<br>" . $connect->error;
                }
            } else {
                echo "Error: " . $sql_pemesanan . "<br>" . $connect->error;
            }
        } else {
            echo "Error: No record found in armada table for ID_Armada = $id_armada";
        }
    } else {
        echo "Error: No record found in jadwal table for ID_jadwal = $id_jadwal";
    }

    $connect->close();
}

?>
