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

$sql = "SELECT * FROM armada";
$result = $connect->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Armada</title>

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

    <!-- Hero section start -->
    <section class="hero" id="hero">
      <img src="img/Mask group.png" alt="gambar" />
    </section>
    <!-- Hero section end -->

    <!-- Menu section start -->
    <section id="menu" class="menu">
      <!-- <div class="kiri">
        <div class="p1">
          <p>Data Kamu</p>
        </div>

        <div class="row">
          <form action="">
            <p>Atas Nama</p>
            <div class="input-group">
              <i class="ikon" data-feather="user"></i>
              <input type="text" placeholder="nama" />
            </div>
            <p>Asal</p>
            <div class="input-group">
              <i class="ikon" data-feather="map-pin"></i>
              <input type="text" placeholder="asal" />
            </div>
            <p>Tujuan</p>
            <div class="input-group">
              <i class="ikon" data-feather="map-pin"></i>
              <select name="tujuan" required>
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
                  <input type="date" placeholder="tanggal" />
                </div>
              </div>
              <div class="row4">
                <p>Tipe Bus</p>
                <div class="input-group">
                  <i class="ikon" data-feather="menu"></i>
                  <select id="tipe" name="tipe">
                    <option value="ac">AC</option>
                    <option value="non-ac">Non-AC</option>
                  </select>
                </div>
              </div>
            </div>
            <p>Jenis Kendaraan</p>
            <div class="input-group">
              <i class="ikon" data-feather="list"></i>
              <select name="jenis_kendaraan" required>
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
                <?php
                // Mengambil data supir dari database
                $sql = "SELECT * FROM sopir";
                $result = $connect->query($sql);
                if ($result && $result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['ID_sopir'] . '">' . $row['Nama_sopir'] . '</option>';
                  }
                }
                ?>
              </select>
            </div>
            <input class="btn" type="submit" value="Booking" />
            <input class="btn" type="submit" value="Reset" />
          </form>
        </div>
      </div> -->
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

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<div class="content-slide">';

                    // Ubah tabel foto menjadi array gambar
                    $foto = explode(",", $row["foto"]);

                    for ($i = 0; $i < count($foto); $i++) {
                        echo '<div class="imgslide fade">';
                        echo '<div class="numberslide">'.($i + 1).' / '.count($foto).'</div>';
                        echo '<img src="'.$foto[$i].'" alt="">';
                        echo '<div class="text">Tampak '.($i + 1).'</div>';
                        echo '</div>';
                    }

                    echo '<a class="prev" onClick="nextslide(-1)">&#10094;</a>';
                    echo '<a class="next" onClick="nextslide(1)">&#10095;</a>';
                    echo '</div>';

                    echo '<div class="page">';
                    echo '<p>'.$row["jumlah_kursi"].' Kursi</p>';
                    echo '<h3>'.$row["nama_Armada"].'</h3>';
                    echo '<p>Rp. '.number_format($row["estimasi_harga"], 0, ",", ".").'</p>';
                    echo '<span class="dot" onClick="dotslide(1)"></span>';
                    echo '<span class="dot" onClick="dotslide(2)"></span>';
                    echo '<span class="dot" onClick="dotslide(3)"></span>';
                    echo '</div>';

                    echo '<div class="row-btn">';
                    echo '<button class="openPopup" data-title="'.$row["nama_Armada"].'" data-tipe="'.$row["deskripsi"].'" data-harga="Rp. '.number_format($row["estimasi_harga"], 0, ",", ".").'" data-kursi="Jumlah Kursi '.$row["jumlah_kursi"].' Seat" data-deskripsi="'.$row["deskripsi"].'" data-fasilitas="'.$row["fasilitas"].'">Selengkapnya</button>';
                    echo '<button class="btn">Pilih</button>';
                    echo '</div>';

                    echo '</div>';
                }
            } else {
                echo "0 results";
            }

            $connect->close();
        ?>         
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
