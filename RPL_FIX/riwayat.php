<?php 
session_start();
if (empty($_SESSION['id'])) {
    header("location:berandaCuss.php?pesan=belum_login");
    exit();
}
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Css -->
    <link rel="stylesheet" href="css/style_cus.css" />
    <style>
     .navbar .navbar-nav {
  width: 500px;
  margin-left: 30rem;
}

.table {
    width: 80%;
    margin-left: 200px;
    border-collapse: collapse;
    margin-top: 30px;
    font-size: 1rem; /* Adjust font size as needed */
}

.table th, .table td {
    border: 1px solid #ddd; /* Border style */
    padding: 8px; /* Padding inside table cells */
    text-align: left; /* Align text to the left within cells */
}

.table th {
    background-color: #e6f3fa;
    color: #333; /* Header text color */
    font-size:18px;
    font-weight: bold; /* Bold font for headers */
    text-align: center;
}

.table tbody tr:hover {
    background-color: #f5f5f5; /* Hover background color for rows */
}

.table td {
    background-color: white; /* Light blue background color */
}
    </style>
  </head>

<body>
<?php 
include 'koneksi.php';

$query = mysqli_query($connect, "SELECT * FROM customer WHERE ID_customer = '$id'");
$data_customer = mysqli_fetch_array($query);
?>

<!-- Navbar start -->
<nav class="navbar">
      <div class="logo-lerna">
        <strong><p class="bold-text">Bw Trans</p></strong>
      </div>

      <div class="navbar-nav">
        <div class="navbar-nav-kamu"></div>
          <div class="kamu">
            <a href="cus/berandaCuss.php"><p style="padding-left: 50px;">Home</p></a>
          </div>
          <div class="kamu">
            <a href="reservasi/reservasi.php"><p style="padding-left: 50px;">Reservasi</p></a>
          </div>
          <div class="kamu">
            <a href="#kontaknih"><p style="padding-left: 50px;">Kontak</p></a>
          </div>
        </div>
      </div>

      <div class="gradient">
        <div class="profile-dropdown">

          <div onclick="toggle()" class="profile-dropdown-btn">
          <span><?php echo $data_customer['Nama_customer']; ?> <i class="fa-solid fa-angle-down"></i></span>
          </div>

          <ul class="profile-dropdown-list">
            <li class="profile-dropdown-list-item">
              <a href="profilCustomer.php">
                <i class="fa-regular fa-user" style="padding-top: 8px;"></i>
                Profile Anda
              </a>
            </li>

            <li class="profile-dropdown-list-item">
              <a href="Reservasi.php">
                <i class="fa-regular fa-pen-to-square" style="padding-top: 8px;"></i>
                Booking Bus
              </a>
            </li>

            <li class="profile-dropdown-list-item">
              <a href="Riwayat.php">
                <i class="fa-solid fa-book" style="padding-top: 8px;"></i>
                Riwayat Transaksi
              </a>
            </li>

            <li class="profile-dropdown-list-item">
              <a href="logout.php">
                <i class="fa-solid fa-arrow-right-from-bracket" style="padding-top: 8px;"></i>
                Log out
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Navbar end -->

    <div class="container mt-5" style="margin-top:150px;">
        <h2 style="font-size:50px; margin-left:600px;">Riwayat Transaksi</h2>

        <?php
        $sql = "SELECT p.ID_pesanan, j.tanggal, a.nama_Armada, s.Nama_sopir, p.harga 
                FROM pemesanan p
                JOIN jadwal j ON p.ID_jadwal = j.ID_jadwal
                JOIN armada a ON j.Id_armada = a.ID_Armada
                JOIN sopir s ON j.Id_sopir = s.ID_sopir
                WHERE p.ID_customer = ?";

        // Gunakan prepared statement untuk mencegah SQL Injection
        $stmt = $connect->prepare($sql);

        if ($stmt === false) {
            // Tambahkan penanganan kesalahan jika prepare() mengembalikan false
            die('Error dalam persiapan kueri: ' . $connect->error);
        }

        $stmt->bind_param("i", $id); // Mengikat parameter, asumsi ID_customer adalah integer

        $executeResult = $stmt->execute();

        if ($executeResult === false) {
            // Tambahkan penanganan kesalahan jika execute() mengembalikan false
            die('Error dalam eksekusi kueri: ' . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<table class="table">
                <thead>
                    <tr>
                        <th>ID Pemesanan</th>
                        <th>Tanggal</th>
                        <th>Armada</th>
                        <th>Sopir</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>';

            while ($row = $result->fetch_assoc()) {
                // Escape output dengan htmlspecialchars untuk menghindari XSS
                echo '<tr>
                        <td>' . htmlspecialchars($row['ID_pesanan']) . '</td>
                        <td>' . htmlspecialchars($row['tanggal']) . '</td>
                        <td>' . htmlspecialchars($row['nama_Armada']) . '</td>
                        <td>' . htmlspecialchars($row['Nama_sopir']) . '</td>
                        <td>' . htmlspecialchars($row['harga']) . '</td>
                    </tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>Anda belum memiliki riwayat transaksi.</p>';
        }

        // Tutup statement dan koneksi
        $stmt->close();
        $connect->close();

        ?>
        <center>
        <a href="cus/berandaCuss.php">kembali</a></center>
    </div>

<footer id="kontaknih" style="margin-top: 100px;">
    <div class="kontak">
        <h1>Follow For More Information</h1>
    </div>
    <div class="socials">
        <a href=""><img src="assets/images/whatsapp1.png" alt="" /></a>
    </div>
    <div class="credit">
        <p>&copy 2024 by Bw Trans. | All rights reserved.</p>
    </div>
</footer>

<script>
    feather.replace();
</script>
<script src="fix_reservasi/js/script.js"></script>
</body>
</html>
