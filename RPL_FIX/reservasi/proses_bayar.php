<?php
include '../koneksi.php';

if (isset($_GET['id_pesanan'])) {
    $id_pesanan = $_GET['id_pesanan'];

    // Mulai transaksi
    $connect->begin_transaction();

    try {
        // Update status menjadi "Sudah dibayar"
        $sql_update = "UPDATE pemesanan SET status_pesanan = 'Sudah dibayar' WHERE ID_pesanan = ?";
        $stmt_update = $connect->prepare($sql_update);
        $stmt_update->bind_param("i", $id_pesanan);

        if ($stmt_update->execute()) {
            if ($stmt_update->affected_rows > 0) {
                // Ambil jumlah total dari pemesanan
                $sql_select = "SELECT harga FROM pemesanan WHERE ID_pesanan = ?";
                $stmt_select = $connect->prepare($sql_select);
                $stmt_select->bind_param("i", $id_pesanan);
                $stmt_select->execute();
                $stmt_select->bind_result($harga);
                $stmt_select->fetch();
                $stmt_select->close();

                // Masukkan data ke dalam pembayaran
                $tanggal_pembayaran = date("Y-m-d H:i:s");
                $uang_muka = null; // Asumsikan uang_muka NULL sesuai permintaan Anda

                $sql_insert = "INSERT INTO pembayaran (ID_pesanan, tanggal_pembayaran, uang_muka, TotalPesanan)
                                VALUES (?, ?, ?, ?)";
                $stmt_insert = $connect->prepare($sql_insert);
                $stmt_insert->bind_param("isii", $id_pesanan, $tanggal_pembayaran, $uang_muka, $harga);
                if ($stmt_insert->execute()) {
                    // Commit transaksi
                    $connect->commit();
                    header("Location: tampil.php?id_pesanan=" . $id_pesanan);
                } else {
                    // Rollback transaksi jika gagal memasukkan
                    $connect->rollback();
                    echo "Error: " . $sql_insert . "<br>" . $connect->error;
                }
                $stmt_insert->close();
            } else {
                echo "Error: Tidak ada baris yang diperbarui untuk ID_pesanan = $id_pesanan";
            }
        } else {
            // Rollback transaksi jika gagal memperbarui
            $connect->rollback();
            echo "Error saat memperbarui status pemesanan: " . $stmt_update->error;
        }
        $stmt_update->close();
    } catch (Exception $e) {
        // Rollback transaksi pada pengecualian
        $connect->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>
