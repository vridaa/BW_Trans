<?php 
session_start();
if (empty($_SESSION['id'])) {
    header("location:berandaAwal.php?pesan=belum_login");
}
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- font open sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,300;0,700;1,400;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- font open sans -->
    <link rel="stylesheet" href="css/style_beranda_sopir.css" />
    <style>
        .button-container {
    display: flex; /* Membuat elemen anak tampil dalam baris */
    justify-content: center; /* Menyelaraskan tombol ke tengah secara horizontal */
    gap: 1rem; /* Memberikan jarak di antara tombol */
    margin-top: 1rem; /* Margin atas untuk memberikan jarak dari elemen sebelumnya */
}

.button-container .btn {
    display: inline-block; /* Membuat elemen anchor tampil sebagai blok sebaris */
    background-color: blue; /* Warna latar belakang biru */
    color: white; /* Warna teks putih */
    padding: 0.5rem 1rem; /* Padding di sekitar teks tombol */
    text-decoration: none; /* Menghilangkan garis bawah pada tautan */
    border-radius: 5px; /* Sudut melengkung pada tombol */
    font-size: 1rem; /* Ukuran font */
    text-align: center; /* Menyelaraskan teks ke tengah */
    cursor: pointer; /* Mengubah kursor menjadi pointer saat di-hover */
}

.button-container .btn:hover {
    background-color: darkblue; /* Warna latar belakang sedikit lebih gelap saat di-hover */
}
    </style>
</head>
<body>
<?php 
            include 'koneksi.php';
            $query = mysqli_query($connect, "SELECT * FROM customer WHERE ID_customer = '$id'");
            $data = mysqli_fetch_array($query);
            ?>
    <div class="container-5">
        <div class="header" style="width: 1510px;">
            <div class="logo-lerna">
                <strong><p>Bw Trans</p></strong>
            </div>
            <div class="navbar">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="cus/berandaCuss.php"><p>Home</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="reservasi/reservasi.php"><p>Reservasi</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontaknih"><p>Kontak</p></a>
                    </li>
                </ul>
                <div>
                    <div class="gradient">
                        <div class="profile-dropdown">
                            <div onclick="toggle()" class="profile-dropdown-btn">
                                <span>Profile Anda </i></span>
                            </div>
                            <div class="disini">
                                <ul class="profile-dropdown-list" style="background: #ffffff">
                                <li class="profile-dropdown-list-item">
                            <a href="profilCustomer.php">
                                <i class="fa-regular fa-user" style="padding-top:5px;"></i>
                                Profile Anda
                            </a>
                            </li>

                            <li class="profile-dropdown-list-item">
                            <a href="reservasi/Reservasi.php">
                                <i class="fa-regular fa-pen-to-square" style="padding-top:7px;"></i>
                                Booking Bus
                            </a>
                            </li>

                            <li class="profile-dropdown-list-item">
                            <a href="Riwayat.php">
                                <i class="fa-solid fa-book" style="padding-top:7px;"></i>
                                Riwayat Transaksi
                            </a>
                            </li>

                            <li class="profile-dropdown-list-item">
                            <a href="logout.php">
                                <i class="fa-solid fa-arrow-right-from-bracket" style="padding-top:7px; padding-left:2px;"></i>
                                Log out
                            </a>
                            </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body" style="margin-left:50px; margin-right:50px;">
                    <h5 class="card-title" style="font-size: 30px; font-weight: bold;">Profil Saya</h5>
                    <p class="card-content">
                    
                    <div class="row mb-3 " style="margin-left: 100px; font-size: 15px;">
                    <label for="inputEmail3" class="col-sm-3 text-start">ID Customer
                    </label>
                    <label for="inputEmail3" class="col-sm-1 text-start">:</label>
                    <div class="col-sm-8 text-start">
                        <?php echo $data['ID_customer']; ?>
                    </div>
                    </div>
                    <div class="row mb-3 " style="margin-left: 100px; font-size: 15px;">
                    <label for="inputEmail3" class="col-sm-3 text-start">Nama </label>
                    <label for="inputEmail3" class="col-sm-1 text-start">:</label>
                    <div class="col-sm-8 text-start">
                        <?php echo $data['Nama_customer']; ?>
                    </div>
                    </div>
                    <div class="row mb-3" style="margin-left: 100px; font-size: 15px;">
                    <label for="inputEmail3" class="col-sm-3 text-start">Email</label>
                    <label for="inputEmail3" class="col-sm-1 text-start">:</label>
                    <div class="col-sm-8 text-start">
                        <?php echo $data['Email_customer']; ?>
                    </div>
                    </div>
                    <div class="row mb-3" style="margin-left: 100px; font-size: 15px;">
                        <label for="inputEmail3" class="col-sm-3 text-start">Telepon </label>
                        <label for="inputEmail3" class="col-sm-1 text-start">:</label>
                        <div class="col-sm-8 text-start">
                            <?php echo $data['Kontak_customer']; ?>
                        </div>
                    </div>
                    <div class="row mb-3" style="margin-left: 100px; font-size: 15px;">
                        <label for="inputEmail3" class="col-sm-3 text-start">Alamat </label>
                        <label for="inputEmail3" class="col-sm-1 text-start">:</label>
                        <div class="col-sm-8 text-start">
                            <?php echo $data['Alamat_customer']; ?>
                        </div>
                    </div>
                    </p>
                    <!-- <div class="button-container">
                        <a href="Editprofil.php" class="btn">Edit Profile</a>
                        <a href="ganti_password_customer.php" class="btn">Ganti Password</a>
                    </div> -->
                </div>
    </div>

    <script>
        feather.replace();
    </script>
    <script>
        function toggle() {
            const dropdown = document.querySelector('.profile-dropdown-list');
            dropdown.classList.toggle('active');
        }

        window.onclick = function(event) {
            if (!event.target.matches('.profile-dropdown-btn span')) {
                const dropdowns = document.querySelectorAll('.profile-dropdown-list');
                dropdowns.forEach(dropdown => {
                    if (dropdown.classList.contains('active')) {
                        dropdown.classList.remove('active');
                    }
                });
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>