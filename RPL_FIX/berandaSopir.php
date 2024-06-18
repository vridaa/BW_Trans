<?php 
session_start();
if (empty($_SESSION['id'])) {
    header("location:berandaAwal.php?pesan=belum_login");
    exit(); // Tambahkan exit setelah header location
}
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>fix beranda</title>
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

/*--------------------------------------------------------------
# TABLE DATA
--------------------------------------------------------------*/

.tabel_data table {
    margin-left: 100px;
    width: 80%;
    border-collapse: collapse;
}

.tabel_data th,
.tabel_data td {
    text-align: center;
    vertical-align: middle;
    padding: 20px;
    border: 1px solid #dee2e6;
    font-size: 16px;
}

.tabel_data th {
    background-color: #e6f3fa;
}

/* CSS untuk memperbesar tombol dalam tabel */
.tabel_data button {
    padding: 5px 15px;
}

    </style>

</head>
<body>
<?php 
include 'koneksi.php';

// Dapatkan ID sopir dari sesi
$id_sopir = $id;

// Query untuk mendapatkan jadwal sopir
$query_jadwal = mysqli_query($connect, "SELECT k.tanggal, p.kota_tujuan, a.nama_Armada, j.ID_pesanan
FROM jadwal_sopir j
INNER JOIN pemesanan p ON j.ID_pesanan = p.ID_pesanan
INNER JOIN jadwal k ON p.ID_jadwal = k.ID_jadwal
INNER JOIN armada a ON k.Id_armada = a.ID_armada
WHERE j.ID_sopir = '$id_sopir'");

// Query untuk mendapatkan informasi sopir
$query_sopir = mysqli_query($connect, "SELECT * FROM sopir WHERE ID_sopir = '$id_sopir'");
$data_sopir = mysqli_fetch_array($query_sopir);
?>

<div class="container-5">
    <div class="header" style="width: 1500px;">
        <div class="logo-lerna">
            <strong><p>Bw Trans</p></strong>
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
            <div class="gradient">
                <div class="profile-dropdown">
                    <div onclick="toggle()" class="profile-dropdown-btn">
                        <span><?php echo htmlspecialchars($data_sopir['Nama_sopir']); ?> <i class="fa-solid fa-angle-down"></i></span>
                    </div>
                    <div class="disini">
                        <ul class="profile-dropdown-list" style="background: #ffffff">
                            <li class="profile-dropdown-list-item">
                                <a href="profilSopir.php">
                                    <i class="fa-regular fa-user" style="padding-top:5px;"></i> Profile Anda
                                </a>
                            </li>
                            <li class="profile-dropdown-list-item">
                                <a href="berandaSopir.php" class="disabled-link">
                                    <i class="fa-solid fa-book" style="padding-top:7px;"></i> Beranda
                                </a>
                            </li>
                            <hr />
                            <li class="profile-dropdown-list-item">
                                <a href="logout.php">
                                    <i class="fa-solid fa-arrow-right-from-bracket" style="padding-top:7px; padding-left:2px;"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="tabel_data" style="margin-top: 20px;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kota Tujuan</th>
                        <th>Armada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($query_jadwal) > 0) {
                        while ($data = mysqli_fetch_assoc($query_jadwal)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($data['tanggal']); ?></td>
                                <td><?php echo htmlspecialchars($data['kota_tujuan']); ?></td>
                                <td><?php echo htmlspecialchars($data['nama_Armada']); ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada jadwal untuk sopir ini.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
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


