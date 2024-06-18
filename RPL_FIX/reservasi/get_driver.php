<?php
include '../koneksi.php';

if (isset($_GET['selected_date'])) {
    $selectedDate = $_GET['selected_date'];

    // Query untuk mendapatkan sopir berdasarkan tanggal
    $sql = "SELECT * FROM sopir WHERE ID_sopir IN (SELECT ID_sopir FROM jadwal WHERE tanggal = '$selectedDate')";
    $result = $connect->query($sql);

    // Bangun opsi untuk dropdown sopir
    $options = '<option value="" disabled selected>Pilih Supir</option>';
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row['ID_sopir'] . '">' . $row['Nama_sopir'] . '</option>';
        }
    }

    // Mengembalikan opsi ke JavaScript
    echo $options;
}
?>
