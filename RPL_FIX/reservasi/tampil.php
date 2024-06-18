<?php 
session_start();
if (empty($_SESSION['id'])) {
    header("location:../berandaAwal.php?pesan=belum_login");
    exit(); // Tambahkan exit setelah header location
}
$id = $_SESSION['id'];
?>

<?php
include '../koneksi.php';

// Memastikan bahwa ID pesanan telah dikirim melalui URL
if (isset($_GET['id_pesanan'])) {
    $id_pesanan = $_GET['id_pesanan'];

    // Mengambil data kode_booking dari tabel detail_pemesanan
    $sql_kode_booking = "SELECT kode_booking FROM detail_pemesanan WHERE ID_pesanan = ?";
    $stmt = $connect->prepare($sql_kode_booking);
    $stmt->bind_param("i", $id_pesanan);
    $stmt->execute();
    $result_kode_booking = $stmt->get_result();

    if ($result_kode_booking && $result_kode_booking->num_rows > 0) {
        $row = $result_kode_booking->fetch_assoc();
        $kode_booking = $row['kode_booking'];
    } else {
        echo "Kode booking tidak ditemukan.";
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
    <link rel="stylesheet" href="css/style3.css" />

    

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
          <h1>Selamat Pesanan Anda Telah Dibayar</h1>
        </div>
        <div class="row">
        <table>
            <tr>
                <th>Kode Booking</th>
                <td><strong>: </strong><?php echo $row['kode_booking']; ?></td>
            </tr>
        </table>
        <a href="../cus/berandaCuss.php"><button  class="btn">Kembali</button></a>
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
