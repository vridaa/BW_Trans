<?php
include '../koneksi.php';

if (isset($_GET['selected_date'])) {
    $selectedDate = $_GET['selected_date'];

    // Query untuk mendapatkan jenis kendaraan berdasarkan tanggal
    $sql = "SELECT * FROM armada WHERE ID_admin = 1 AND ID_Armada IN (SELECT Id_armada FROM jadwal WHERE tanggal = '$selectedDate')";
    $result = $connect->query($sql);

    // Bangun opsi untuk dropdown jenis kendaraan
    $options = '<option value="" disabled selected>Pilih Kendaraan</option>';
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row['ID_Armada'] . '">' . $row['nama_Armada'] . '</option>';
        }
    }

    // Mengembalikan opsi ke JavaScript
    echo $options;
}
?>
