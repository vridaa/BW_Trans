<?php 
session_start();
if (empty($_SESSION['id'])) {
    header("location: berandaAwal.php?pesan=belum_login");
    exit(); // Tambahkan exit setelah header location
}
$id = $_SESSION['id'];

include 'koneksi.php';

// Query untuk mengambil laporan pemesanan
$query_laporan = "SELECT p.ID_pesanan, p.tanggal_reservasi, s.Nama_sopir, c.Nama_customer, a.nama_Armada
                  FROM laporan_po_new l
                  INNER JOIN pemesanan p ON l.ID_pesanan = p.ID_pesanan
                  INNER JOIN jadwal j ON p.ID_jadwal = j.ID_jadwal
                  INNER JOIN sopir s ON s.ID_sopir = j.ID_sopir
                  INNER JOIN customer c ON p.ID_customer = c.ID_customer
                  INNER JOIN armada a ON j.ID_armada = a.ID_Armada
                  WHERE l.ID_admin = $id";
$result_laporan = mysqli_query($connect, $query_laporan);

// Tangani error query
if (!$result_laporan) {
    die("Query failed: " . mysqli_error($connect));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- Font Open Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,300;0,700&display=swap"
          rel="stylesheet" />
    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- CSS Custom -->
    <link rel="stylesheet" href="css/style_data_armada.css" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container-5">
        <div class="header" style="width: 1500px;">
            <div class="logo-lerna">
                <strong>
                    <p>BW Trans</p>
                </strong>
            </div>
            <div class="navbar">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <p>Layanan Kami</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontaknih">
                            <p>Kontak</p>
                        </a>
                    </li>
                </ul>
                <div>
                    <!-- Tombol Logout -->
                    <button type="submit" class="btn custom-btn3" id="tombolMasuk" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <a class="logout" href="logout.php" style="color: white; text-decoration: none;">
                            <p style="padding-top:6px;">Logout</p>
                        </a>
                    </button>
                </div>
            </div>
        </div>
        <div class="container-7">
            <div class="mask-group">
                <div class="container">
                    <div class="judul">
                        <p class="judul-text">Laporan Pemesanan</p>
                    </div>
                </div>
                <div class="tabel_data">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Pemesanan</th>
                                <th>Tanggal Sewa</th>
                                <th>Penyewa</th>
                                <th>Sopir</th>
                                <th>Armada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop untuk menampilkan data laporan pemesanan
                            while ($data = mysqli_fetch_array($result_laporan)) {
                                ?>
                                <tr>
                                    <td><?php echo $data['ID_pesanan'] ?></td>
                                    <td><?php echo $data['tanggal_reservasi'] ?></td>
                                    <td><?php echo $data['Nama_customer'] ?></td>
                                    <td><?php echo $data['Nama_sopir'] ?></td>
                                    <td><?php echo $data['nama_Armada'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tombol-tombol">
                    <a href="berandaAdmin.php" class="btn btn-primary" style="width: 90px; height: 36px; text-align: center; line-height: 25px;">Back</a>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
