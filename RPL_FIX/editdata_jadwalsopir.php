<?php 
session_start();
if (empty($_SESSION['id'])) {
    header("location:berandaAwal.php?pesan=belum_login");
    exit; // Ensure no further execution after redirect
}
$ID_admin = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Sopir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- Font Open Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,300;0,700&display=swap" rel="stylesheet" />
    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="css/style_data_armada.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .sopirdata {
            margin-left: 50px;
        }
        .datasopir {
            padding-left: 250px;
        }
        .sopirdata p {
            margin: 5px 0;
            font-size: 16px;
            font-weight: bolder;
            color: black;
        }
    </style>
</head>

<body>
    <div class="container-5">
        <div class="header">
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
                        <a class="nav-link" href="#reservasinih">
                            <p>Reservasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <p>Tentang Kami</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontaknih">
                            <p>Kontak</p>
                        </a>
                    </li>
                </ul>
                <div>
                    <button type="submit" class="btn custom-btn3" id="tombolMasuk" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <a class="login" href="logout.php">
                            <p>Logout</p>
                        </a>
                    </button>
                </div>
            </div>
        </div>

        <div class="container-7">
            <div class="mask-group">
                <div class="container">
                    <?php
                    // Ambil ID sopir dan ID pesanan dari parameter URL
                    $ID_sopir = isset($_GET['ID_sopir']) ? $_GET['ID_sopir'] : null;
                    $ID_pesanan = isset($_GET['ID_pesanan']) ? $_GET['ID_pesanan'] : null;

                    include 'koneksi.php';
                    // Query untuk mengambil informasi sopir dan jadwal yang akan diedit
                    $query_sopir = mysqli_query($connect, "SELECT s.ID_sopir, s.Nama_sopir FROM sopir s WHERE s.ID_sopir = '$ID_sopir'");
                    if (!$query_sopir) {
                        die("Error query sopir: " . mysqli_error($connect));
                    }
                    $data_sopir = mysqli_fetch_assoc($query_sopir);

                    $query_jadwal = mysqli_query($connect, "SELECT j.ID_pesanan, k.tanggal, p.kota_tujuan, a.nama_Armada, p.ID_jadwal
                        FROM jadwal_sopir j
                        INNER JOIN pemesanan p ON j.ID_pesanan = p.ID_pesanan
                        INNER JOIN jadwal k ON p.ID_jadwal = k.ID_jadwal
                        INNER JOIN armada a ON k.Id_armada = a.ID_armada
                        WHERE j.ID_sopir = '$ID_sopir' AND j.ID_pesanan = '$ID_pesanan'");
                    if (!$query_jadwal) {
                        die("Error query jadwal: " . mysqli_error($connect));
                    }
                    $data_jadwal = mysqli_fetch_assoc($query_jadwal);
                    ?>
                    <div class="sopirdata">
                        <div class="datasopir">
                            <p>ID Sopir : <?php echo htmlspecialchars($data_sopir['ID_sopir']); ?></p>
                            <p>Nama Sopir : <?php echo htmlspecialchars($data_sopir['Nama_sopir']); ?></p>
                        </div>
                    </div>

                    <div class="formbox" id="formEditJadwalSopir">
                        <div class="title">
                            <p class="title-text">Edit Data Jadwal Sopir</p>
                        </div>
                        <form method="POST" action="prosesedit_jadwalsopir.php" id="EditJadwalSopir" class="form">
                            <input type="hidden" name="ID_sopir" value="<?php echo htmlspecialchars($data_sopir['ID_sopir']); ?>">
                            <input type="hidden" name="ID_pesanan" value="<?php echo htmlspecialchars($data_jadwal['ID_pesanan']); ?>">
                            <table>
                                <tr>
                                    <td>Tanggal</td>
                                    <td><input type="text" class="form-control" name="tanggal" value="<?php echo htmlspecialchars($data_jadwal['tanggal']); ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>Kota Tujuan</td>
                                    <td><input type="text" class="form-control" name="kota_tujuan" value="<?php echo htmlspecialchars($data_jadwal['kota_tujuan']); ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>Nama Armada</td>
                                    <td><input type="text" class="form-control" name="nama_Armada" value="<?php echo htmlspecialchars($data_jadwal['nama_Armada']); ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>ID Jadwal</td>
                                    <td><input type="text" class="form-control" name="ID_jadwal" value="<?php echo htmlspecialchars($data_jadwal['ID_jadwal']); ?>" readonly></td>
                                </tr>
                            </table>
                            <div class="submit-button">
                                <button type="submit" class="btn btn-warning" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('EditJadwalSopir').addEventListener('submit', function (event) {
                event.preventDefault();
                var form = this;
                var formData = new FormData(form);

                fetch(form.action, {
                    method: form.method,
                    body: formData
                }).then(response => {
                    if (response.ok) {
                        return response.text();
                    }
                    throw new Error('Network response was not ok.');
                }).then(result => {
                    console.log(result);
                    // Handle success and redirect if necessary
                    // Example:
                    // window.location.href = 'somepage.php';
                }).catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    </script>
</body>

</html>
