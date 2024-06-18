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
    <title>Pemesanan</title>

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

/* Style for input elements */
input[type="text"],
input[type="date"],
input[type="password"],
input[type="email"],
input[type="number"],
input[type="tel"],
input[type="url"],
select {
    display: block;
    width: 70%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

input[type="text"]:focus,
input[type="date"]:focus,
input[type="password"]:focus,
input[type="email"]:focus,
input[type="number"]:focus,
input[type="tel"]:focus,
input[type="url"]:focus,
select:focus {
    color: #495057;
    background-color: #fff;
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

button[type="submit"] {
    background-color: #007bff;
    color: white;
    padding: 0.375rem 0.75rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.15s ease-in-out;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Style for form elements */
.form-label {
    display: inline-block;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.form-control {
    display: block;
    width: 70%;
    height: calc(1.5em + 0.75rem + 2px);
    margin-bottom: 10px;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-select {
    display: block;
    width: 70%;
    height: calc(1.5em + 0.75rem + 2px);
    margin-bottom: 10px;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.container {
    background-color: #f8f9fa; /* Warna latar belakang */
    padding: 20px; /* Jarak dalam kotak */
    margin: 50px auto; /* Jarak luar kotak dan tengah secara horizontal */
    border-radius: 10px; /* Membuat sudut membulat */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek elevasi */
    max-width: 800px; /* Lebar maksimum kotak */
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jadwal = $_POST['id_jadwal'];

    $query = mysqli_query($connect, "SELECT j.*, a.nama_Armada, s.Nama_sopir 
                                     FROM jadwal j 
                                     JOIN armada a ON j.Id_armada = a.ID_Armada 
                                     JOIN sopir s ON j.Id_sopir = s.ID_sopir 
                                     WHERE ID_jadwal = '$id_jadwal'");
    $data_jadwal = mysqli_fetch_array($query);
}
?>

<div class="container" style="margin-top:150px;">
    <h2 style="margin-left:100px; font-size:30px;">Form Reservasi</h2>
    <form action="proses_pesan.php" method="POST" style="margin-left:100px;">
        <input type="hidden" name="id_jadwal" value="<?php echo htmlspecialchars($data_jadwal['ID_jadwal']); ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($data_customer['Nama_customer']); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <select class="form-select" id="tujuan" name="tujuan" required>
                <option value="dalam_provinsi">Dalam Provinsi</option>
                <option value="solo">Solo</option>
                <option value="semarang">Semarang</option>
                <option value="jakarta">Jakarta</option>
                <option value="bandung">Bandung</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Sewa</label>
            <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($data_jadwal['tanggal']); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
            <input type="text" class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" value="<?php echo htmlspecialchars($data_jadwal['nama_Armada']); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="supir" class="form-label">Supir</label>
            <input type="text" class="form-control" id="supir" name="supir" value="<?php echo htmlspecialchars($data_jadwal['Nama_sopir']); ?>" readonly>
        </div>
        <button type="submit" class="btn btn-primary" style="background-color: #504171; color:white; font-weight:bold; width:100px; height:35px;">Submit</button>
    </form>
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
