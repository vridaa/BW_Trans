<?php 
 session_start();
 if (empty($_SESSION['id'])) {
     header("location:berandaCuss.php?pesan=belum_login");
     exit(); // Tambahkan exit setelah header location
 }
 $id = $_SESSION['id'];
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beranda Customer</title>

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
            <a href="berandaAwal.php"><p style="padding-left: 50px;">Home</p></a>
          </div>
          <div class="kamu">
            <a href="Reservasi.php"><p style="padding-left: 50px;">Reservasi</p></a>
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

    <!-- Hero section start -->
    <section class="hero" id="hero">
    <div class="about-img">
    <img src="assets/images/1.png" width="450rem" alt="" />
    
    </div>
    <div class="about-text">
      <h3>
        Ayo Nikmati Perjalanan <br>
        Bersama kami
      </h3>
      <p>
        Nikmati perjalanan istimewa dan luar biasa, namun
        harga tetap bersahabat. Kami Menyediakan Pelayanan yang Maksimal, 
        Sehingga Anda akan Selalu Menjadikannya KEnangan Istimewa.
      </p>
      <a href="Reservasi.php" class="btn">Reservasi</a>
    </div>
      
    </section>
    <!-- Hero section end -->

    <!-- Menu section start -->
    <section id="menu" class="menu">
    
      <div id="popupContainer" class="popup-container">
        <div class="popup-content">
          <span id="closePopup" class="close">&times;</span>
          <h2 id="dataTitle">Nama kendaraan</h2>
          <p id="dataTipe">Tipe kendaraan</p>
          <p class="desk">Deskripsi</p>
          <hr />
          <div class="kotak">
            <p id="dataHargaPopup">Harga</p>
            <p id="dataKursiPopup">Jumlah kursi</p>
            <ul id="dataDeskripsi">
              <li>Item 1</li>
              <li>Item 2</li>
              <li>Item 3</li>
            </ul>
            <p class="fas">Fasilitas:</p>
            <ul id="dataFasilitas">
              <li>Item 1</li>
              <li>Item 2</li>
              <li>Item 3</li>
            </ul>
          </div>
          <button class="btn">Pilih</button>
          <button class="btn-exit">Tutup</button>
        </div>
      </div>
    </section>
    <!-- Menu section end -->

    <footer id="kontaknih" style="margin-top: 60px;">
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
    <!-- Feather icons -->
    <script>
      feather.replace();
    </script>

    <!-- Javascript -->
     <!-- Feather icons -->
<script>
  feather.replace();
</script>

<!-- Javascript -->
<script src="fix_reservasi/js/script.js"></script>

<script>
  // Function to toggle the dropdown menu
  function toggleDropdown() {
    const dropdownList = document.querySelector('.profile-dropdown-list');
    dropdownList.classList.toggle('show');
  }

  // Add event listener to the dropdown button
  const dropdownBtn = document.querySelector('.profile-dropdown-btn');
  dropdownBtn.addEventListener('click', toggleDropdown);

  // Close the dropdown if clicked outside
  window.onclick = function(event) {
    if (!event.target.matches('.profile-dropdown-btn')) {
      const dropdowns = document.querySelectorAll('.profile-dropdown-list');
      dropdowns.forEach(dropdown => {
        if (dropdown.classList.contains('show')) {
          dropdown.classList.remove('show');
        }
      });
    }
  }
</script>

    <script src="fix_reservasi/js/script.js"></script>
  </body>
</html>
