<?php
include 'koneksi.php';

// Pastikan data terkirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $Tanggal = $_POST['Tanggal'];
    $ketersediaan_sopir = $_POST['ketersediaan_sopir'];
    $ketersediaan_armada = $_POST['ketersediaan_armada'];

    // Validasi bahwa Tanggal, Sopir, dan Armada tidak kosong
    if (empty($Tanggal) || empty($ketersediaan_sopir) || empty($ketersediaan_armada)) {
        echo '<script>alert("Mohon lengkapi semua kolom!");';
        echo 'window.location.href = "data_jadwal_ketersediaan.php";</script>';
        exit();
    }

    // Validasi apakah jadwal dengan id_sopir dan id_armada yang sama sudah ada pada tanggal tersebut
    $query_check = "SELECT COUNT(*) AS count FROM jadwal WHERE tanggal = ? AND Id_sopir = ? AND Id_armada = ?";
    $stmt_check = $connect->prepare($query_check);
    $stmt_check->bind_param("sss", $Tanggal, $ketersediaan_sopir, $ketersediaan_armada);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row = $result_check->fetch_assoc();

    if ($row['count'] > 0) {
        echo '<script>alert("Jadwal dengan Sopir atau Armada tersebut pada tanggal yang sama sudah ada.");';
        echo 'window.location.href = "data_jadwal_ketersediaan.php";</script>';
        exit();
    }

    // Gunakan prepared statement untuk memasukkan data ke database
    $query_insert = "INSERT INTO jadwal (tanggal, Id_sopir, Id_armada) VALUES (?, ?, ?)";
    $stmt_insert = $connect->prepare($query_insert);
    $stmt_insert->bind_param("sss", $Tanggal, $ketersediaan_sopir, $ketersediaan_armada);

    if ($stmt_insert->execute()) {
        header("Location: data_jadwal_ketersediaan.php");
        exit();
    } else {
        echo '<script>alert(" "Proses Input Data Gagal: " . $stmt_insert->error;);';
        echo 'window.location.href = "data_jadwal_ketersediaan.php";</script>';
    }

    // Tutup statement dan koneksi
    $stmt_insert->close();
    $connect->close();
} else {
    echo "Metode pengiriman data tidak valid.";
}
?>
