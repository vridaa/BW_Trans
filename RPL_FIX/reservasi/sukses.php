<?php
session_start();
if (empty($_SESSION['id'])) {
    header("location:../berandaAwal.php?pesan=belum_login");
    exit(); // Ensure exit after header redirect
}
$id = $_SESSION['id'];
?>

<?php
include '../koneksi.php';

// Ensure id_pesanan is set and valid
if (isset($_GET['id_pemesanan'])) {
    $id_pesanan = $_GET['id_pemesanan'];

    // Query to fetch booking details
    $sql_pemesanan = "SELECT p.ID_pesanan, p.ID_jadwal, j.ID_Armada, j.ID_sopir, p.kota_tujuan,
                  j.Tanggal, a.nama_Armada, s.Nama_sopir 
                  FROM pemesanan p
                  JOIN detail_pemesanan d ON p.ID_pesanan = d.ID_pesanan
                  JOIN jadwal j ON p.ID_jadwal = j.ID_jadwal
                  JOIN armada a ON j.ID_Armada = a.ID_Armada
                  JOIN sopir s ON j.ID_sopir = s.ID_sopir
                  WHERE p.ID_pesanan = '$id_pesanan'";

        $result_pemesanan = $connect->query($sql_pemesanan);
      if (!$result_pemesanan) {
          echo "Error: " . $connect->error;
          exit();
      }


    if ($result_pemesanan && $result_pemesanan->num_rows > 0) {
      $row = $result_pemesanan->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
    
} else {
    echo "ID pesanan tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Klinik UPN Veteran Yogyakarta</title>

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
    <link rel="stylesheet" href="css/style2.css" />

    

  </head>

  <body>
    <!-- Navbar start -->
    <nav class="navbar">
      <div class="logo-lerna">
        <strong><p class="bold-text">Bw Trans</p></strong>
      </div>

      <div class="navbar-nav">
        <div class="kamu">
          <a href="index.html"><p>Home</p></a>
        </div>
        <div class="kamu">
          <a href="reservation.html"><p>Reservation</p></a>
        </div>
        <div class="kamu">
          <a href="tentang.html"><p>Layanan Kami</p></a>
        </div>
        <div class="kamu">
          <a href="tentang.html"><p>Kontak</p></a>
        </div>
      </div>

      <div class="gradient">
        <div class="profile-dropdown">
          <div onclick="toggle()" class="profile-dropdown-btn">
            <span
              ><i class="fa-solid fa-user"></i>
              <i class="fa-solid fa-angle-down"></i>
            </span>
          </div>

          <ul class="profile-dropdown-list">
            <li class="profile-dropdown-list-item">
              <a href="#">
                <i class="fa-regular fa-user"></i>
                Profile Anda
              </a>
            </li>

            <li class="profile-dropdown-list-item">
              <a href="#proses_reserv.php">
                <i class="fa-regular fa-pen-to-square"></i>
                Booking Bus
              </a>
            </li>

            <li class="profile-dropdown-list-item">
              <a href="#">
                <i class="fa-solid fa-book"></i>
                Riwayat Transaksi
              </a>
            </li>
            <hr />

            <li class="profile-dropdown-list-item">
              <a href="#">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Log out
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <!-- Navbar end -->



    <!-- Menu section start -->
    <section id="menu" class="menu">
      <div class="kiri">
        <div class="p1">
          <p>Detail Pemesanan</p>
        </div>

        <div class="row">

        <table>
            <tr>
                <th>Atas Nama</th>
                <td><strong>: </strong><?php echo $row['atas_nama']; ?></td>
            </tr>
            <tr>
                <th>Asal</th>
                <td><strong>: </strong><?php echo $row['asal']; ?></td>
            </tr>
            <tr>
                <th>Nama Armada</th>
                <td><strong>: </strong><?php echo $row['nama_Armada']; ?></td>
            </tr>
            <tr>
                <th>Nama Sopir</th>
                <td><strong>: </strong><?php echo $row['Nama_sopir']; ?></td>
            </tr>
            <tr>
                <th>Kota Tujuan</th>
                <td><strong>: </strong><?php echo $row['kota_tujuan']; ?></td>
            </tr>
            <tr>
                <th>Tanggal Berangkat</th>
                <td><strong>: </strong><?php echo $row['Tanggal']; ?></td>
            </tr>
            <tr>
                <th>Lama Sewa</th>
                <td><strong>: </strong><?php echo $row['Lama_sewa']; ?> hari</td>
            </tr>
            <tr>
                <th>Jumlah Sopir</th>
                <td><strong>: </strong><?php echo $row['Jumlah_sopir']; ?></td>
            </tr>
            <tr>
                <th>Jumlah Bis</th>
                <td><strong>: </strong><?php echo $row['Jumlah_bis']; ?></td>
            </tr>
            <tr>
                <th>Total Pembayaran</th>
                <td><strong>: </strong>Rp <?php echo $row['harga']; ?></td>
            </tr>
        </table>
        <td colspan="2">
        <form action="proses_bayar.php?id_pesanan=<?php echo $row['ID_pesanan']; ?>" method="post">
            <button type="submit" class="btn">Bayar</button>
        </form>
        </td>
        </div>
      </div>
      
    </section>
    <!-- Menu section end -->

    <footer id="kontaknih" style="margin-top: 25rem">
      <div class="kontak">
        <h1>Follow For More Information</h1>
      </div>
      <div class="socials">
        <a href=""><img src="../assets/images/whatsapp1.png" alt="" /></a>
      </div>
      <div class="credit">
        <p>&copy 2024 by Bw Trans. | All rights reserved.</p>
      </div>
    </footer>
    <!-- Feather icons -->
    <script>
      feather.replace();
    </script>

    

    <!-- Javascript -->
    <script src="js/script.js"></script>
  </body>
</html>
