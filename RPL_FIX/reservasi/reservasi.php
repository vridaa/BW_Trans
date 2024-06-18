<?php
include '../koneksi.php';

$sql = "SELECT * FROM armada";
$result = $connect->query($sql);
?>
<?php 
session_start();
if (empty($_SESSION['id'])) {
    header("location:../berandaAwal.php?pesan=belum_login");
    exit(); // Tambahkan exit setelah header location
}
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reservasi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- font awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Css -->
    <link rel="stylesheet" href="css/style.css" />

    

  </head>

  <body>
    <!-- Navbar start -->
    <nav class="navbar">
      <div class="logo-lerna">
        <strong><p class="bold-text">Bw Trans</p></strong>
      </div>

      <div class="navbar-nav">
        <div class="kamu">
          <a href="../cus/berandaCuss.php"><p>Home</p></a>
        </div>
        <div class="kamu">
          <a href="reservation.php"><p>Reservation</p></a>
        </div>
        <!-- <div class="kamu">
          <a href="tentang.html"><p>Layanan Kami</p></a>
        </div> -->
        <div class="kamu">
          <a href="tentang.html"><p>Kontak</p></a>
        </div>
      </div>

      <!-- profil start -->
      <?php 
        include '../koneksi.php';

        $query = mysqli_query($connect, "SELECT * FROM customer WHERE ID_customer = '$id'");
        $data_customer = mysqli_fetch_array($query);

      ?>

      <div class="gradient">
        <div class="profile-dropdown">
          <div onclick="toggle()" class="profile-dropdown-btn">
            <span
              >
              <span><?php echo $data_customer['Nama_customer']; ?> <i class="fa-solid fa-angle-down"></i></span>  
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

    <!-- Hero section start -->
    <section class="hero" id="hero">
      <img src="img/Mask group.png" alt="gambar" />
    </section>
    <!-- Hero section end -->

    <!-- Menu section start -->
    <section id="menu" class="menu">
      <div class="kiri">
        <div class="p1">
          <p>Data Kamu</p>
        </div>

        <div class="row">
          <form action="reservation_process.php" method="POST">
            <p>Atas Nama</p>
            <div class="input-group">
              <i class="ikon" data-feather="user"></i>
              <input type="text" id="nama" name="nama" placeholder="nama" />
            </div>
            <p>Asal</p>
            <div class="input-group">
              <i class="ikon" data-feather="map-pin"></i>
              <input type="text" id="asal" name="asal" placeholder="asal" />
            </div>
            <p>Tujuan</p>
            <div class="input-group">
              <i class="ikon" data-feather="map-pin"></i>
              <select name="tujuan" required>
                    <option value="" disabled selected>Pilih tujuan</option>
                    <option value="dalam_provinsi">Dalam Provinsi</option>
                    <option value="solo">Solo</option>
                    <option value="semarang">Semarang</option>
                    <option value="jakarta">Jakarta</option>
                    <option value="bandung">Bandung</option>
                </select>
            </div>
            <div class="row2">
              <div class="row3">
                <p>Berangkat</p>
                <div class="input-group">
                  <i class="ikon" data-feather="calendar"></i>
                  <select id="tanggal" name="tanggal" required>
                    <option value="" disabled selected>Pilih Jadwal</option>
                    <?php
                      include '../koneksi.php';
                      $sql = "SELECT * FROM jadwal";
                      $result = $connect->query($sql);
                      if ($result && $result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                              echo '<option value="' . $row['ID_jadwal'] . '">' . $row['tanggal'] . '</option>';
                          }
                      }
                      ?>
                  </select>
                  
                </div>
              </div>
              
              <div class="row4">
                <p>Lama Sewa</p>
                <div class="input-group">
                  <i class="ikon" data-feather="clock"></i>
                    <input type="text" id="lama_Sewa" name="lama_sewa" placeholder="Lama Sewa" />
                </div>
              </div>
            </div>
            <!-- <div class="row2">
              <div class="row3">
                <p>Jumlah Supir</p>
                <div class="input-group">
                  <i class="ikon" data-feather="users"></i>
                  <input type="text" id="jumlah_sopir" name="jumlah_sopir" placeholder="Jumlah Sopir" />
                </div>
              </div>
              
              <div class="row4">
                <p>Jumlah Bis</p>
                <div class="input-group">
                  <i class="ikon" data-feather="truck"></i>
                    <input type="text" id="jumlah_bis" name="jumlah_bis" placeholder="Jumlah Bis" />
                </div>
              </div>
            </div> 
            <p>Jenis Kendaraan</p>
            <div class="input-group">
              <i class="ikon" data-feather="list"></i>
              <select name="jenis_kendaraan" required>
                <option value="" disabled selected>Pilih Kendaraan</option>
                <?php
                // Mengambil data armada dari database
                include '../koneksi.php';
                $sql = "SELECT * FROM armada";
                $result = $connect->query($sql);
                if ($result && $result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['ID_Armada'] . '">' . $row['nama_Armada'] . '</option>';
                  }
                }
                ?>
              </select>
            </div>
            <p>Pilih Supir</p>
            <div class="input-group">
              <i class="ikon" data-feather="menu"></i>
              <select name="supir" required>
                <option value="" disabled selected>Pilih supir</option>
                <?php
                // Mengambil data supir dari database
                $sql = "SELECT * FROM sopir";
                $result = $connect->query($sql);
                if ($result && $result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['ID_sopir'] . '">' . $row['Nama_sopir'] . ' </option>';
                  }
                }
                ?>
              </select>
            </div> -->
            <input class="btn" type="submit" value="Booking" />
            <input class="btn" type="reset" value="Reset"  />

            <script>
            document.getElementById("reset-btn").addEventListener("click", function() {
                const inputFields = document.querySelectorAll("input[type='date'], input[type='text'], textarea");
                inputFields.forEach(function(field) {
                field.value = "";
                });
            });
            </script>
          </form>
        </div>
      </div>
      <div class="kanan">
        <div class="input-group">
          <i class="ikon" data-feather="search"></i>
          <input type="text" placeholder="nama" />
          <input class="btn" type="submit" value="Search" />
        </div>
        <div class="row">
        <?php
            $sql = "SELECT * FROM armada";
            $result = $connect->query($sql);
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '  <div class="content-slide">';

                    // Assuming each `armada` has a single image, adapt if multiple images are used
                    echo '<div class="imgslide fade">';
                    echo '  <div class="numberslide">1 / 1</div>';
                    if ($row['foto']) {
                        echo '  <img src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" alt="' . $row['nama_Armada'] . '" />';
                    } else {
                        echo '  <img src="default_image_path" alt="Default Image" />';
                    }
                    echo '  <div class="text">Image of ' . $row['nama_Armada'] . '</div>';
                    echo '</div>';

                    echo '      <a class="prev" onClick="nextslide(-1)">&#10094;</a>';
                    echo '      <a class="next" onClick="nextslide(1)">&#10095;</a>';
                    echo '  </div>';
                    echo '  <div class="page">';
                    echo '      <p>Jumlah Kursi '. $row['jumlah_kursi'] . '</p>';
                    echo '      <h3>' . $row['nama_Armada'] . '</h3>';
                    echo '      <p>Rp. ' . number_format($row['estimasi_harga'], 0, ',', '.') . '</p>';
                    echo '      <span class="dot" onClick="dotslide(1)"></span>';
                    echo '  </div>';
                    echo '  <div class="row-btn">';
                    echo '      <button class="openPopup"';
                    echo '          data-title="' . $row['nama_Armada'] . '"';
                    echo '          data-tipe="' . $row['jumlah_kursi'] . '"';
                    echo '          data-harga="Rp. ' . number_format($row['estimasi_harga'], 0, ',', '.') . '"';
                    echo '          data-kursi="' . $row['jumlah_kursi'] . '"';
                    echo '          data-deskripsi="Harga sudah termasuk BBM & Driver, Belum termasuk biaya Tol, Parkir, Makan, Penginapan, Tip Driver & Co Driver.
                                                    Harga tersebut untuk pemakaian per hari.
                                                    Pemakaian per hari dalam kota maks 12 jam.
                                                    Pemakaian per hari luar kota maks 16 jam.
                                                    Jika Overtime akan dikenakan biaya Charge 10% per jam."';
                    echo '          data-fasilitas="Mineral Water; Snack; Toilet; Reclining Seat; Free Meal; Pillow; Blanket"';
                    echo '      >Selengkapnya</button>';
                    echo '      <button class="btn">Pilih</button>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }

            $connect->close();
            ?>
          </div>
                        
            </div>
      </div>

    </section>
    <!-- Menu section end -->

    <!-- Feather icons -->
    <script>
      feather.replace();
    </script>

    

    <!-- Javascript -->
    <script src="js/script.js"></script>
  </body>
</html>
