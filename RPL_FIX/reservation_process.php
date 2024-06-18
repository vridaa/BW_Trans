<?php
// Validasi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cek apakah semua input telah diisi
    if (empty($_POST['nama']) || empty($_POST['tujuan']) || empty($_POST['tanggal']) || empty($_POST['jenis_kendaraan']) || empty($_POST['supir'])) {
        // Redirect kembali ke halaman reservasi dengan pesan error
        header("Location: reservation.html?error=semua-input-harus-diisi");
        exit();
    }

    // Validasi tanggal
    $tanggal_sewa = $_POST['tanggal'];
    $tanggal_hari_ini = date("Y-m-d");
    if ($tanggal_sewa < $tanggal_hari_ini) {
        // Redirect kembali ke halaman reservasi dengan pesan error
        header("Location: reservation.html?error=tanggal-tidak-valid");
        exit();
    }

    // Terima data dari formulir
    $nama = $_POST['nama'];
    $tujuan = $_POST['tujuan'];
    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    $supir = $_POST['supir'];

    // Lakukan perhitungan harga
    switch ($tujuan) {
        case 'dalam_provinsi':
            $harga_tujuan = ($tipe == 'ac') ? 600000 * 0.15 : 600000;
            break;
        case 'solo':
            $harga_tujuan = ($tipe == 'ac') ? 750000 * 0.15 : 750000;
            break;
        case 'semarang':
            $harga_tujuan = ($tipe == 'ac') ? 900000 * 0.15 : 900000;
            break;
        case 'jakarta':
            $harga_tujuan = ($tipe == 'ac') ? 1300000 * 0.15 : 1300000;
            break;
        case 'bandung':
            $harga_tujuan = ($tipe == 'ac') ? 1500000 * 0.15 : 1500000;
            break;
        default:
            // Handle jika tujuan tidak valid
            header("Location: reservation.html?error=tujuan-tidak-valid");
            exit();
    }

    // Simpan data ke database
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "bw_trans";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk menyimpan data reservasi ke tabel pemesanan
    $sql = "INSERT INTO pemesanan (nama, tipe, tujuan, tanggal_sewa, ID_jadwal, ID_Armada, ID_sopir)
            VALUES ('$nama', '$tipe', '$tujuan', '$tanggal_sewa', '$jenis_kendaraan', '$supir')";

    if ($conn->query($sql) === TRUE) {
        // Berikan feedback kepada pengguna bahwa reservasi berhasil
        echo "Reservasi berhasil!";
    } else {
        // Jika terjadi kesalahan saat menyimpan data ke database, berikan pesan error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika bukan metode POST, redirect kembali ke halaman reservasi dengan pesan error
    header("Location: reservation.html?error=invalid-method");
    exit();
}
?>
