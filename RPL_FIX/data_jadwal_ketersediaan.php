<?php
session_start();

// Pastikan session 'id' telah ter-set sebelum digunakan
if (empty($_SESSION['id'])) {
    header("location: berandaCuss.php?pesan=belum_login");
    exit();
}

include 'koneksi.php'; // Menggunakan koneksi database

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Perjalanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- font open sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,300;0,700;1,400;1,700&display=swap"
        rel="stylesheet" />
    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- font open sans -->
    <link rel="stylesheet" href="css/style_data_armada.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container-5">
        <div class="header" style="width: 1500px;">
            <div class="logo-lerna">
                <strong>
                    <p>BW Trans</p>
                </strong>
            </div>
            <div class="navbar">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="berandaAdmin.php">
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
                    <button type="submit" class="btn custom-btn3" id="tombolMasuk" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <a class="logout" href="logout.php" style="color: white; text-decoration: none;">
                            <p style="padding-top:6px;">Logout</p>
                        </a>
                    </button>
            </div>
        </div>
        <div class="container-7">
            <div class="mask-group">
                <div class="container">

                    <div class="judul">
                        <p class="judul-text">Jadwal Ketersediaan</p>
                    </div>

                </div>

                <div class="tabel_data">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Jadwal</th>
                                <th>Tanggal</th>
                                <th>Sopir</th>
                                <th>Armada</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                // Query untuk mengambil data jadwal beserta nama sopir dan armada
                                $query = "SELECT j.ID_jadwal, j.tanggal, s.Nama_sopir, a.nama_Armada 
                                          FROM jadwal j 
                                          JOIN sopir s ON j.Id_sopir = s.ID_sopir 
                                          JOIN armada a ON j.Id_armada = a.ID_Armada";

                                $result = mysqli_query($connect, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($data = mysqli_fetch_array($result)) {
                            ?>

                            <tr>
                                <td><?php echo $data['ID_jadwal'] ?></td>
                                <td><?php echo $data['tanggal'] ?></td>
                                <td><?php echo $data['Nama_sopir'] ?></td>
                                <td><?php echo $data['nama_Armada'] ?></td>
                                
                                <td>
                                    <a href="editdata_jadwalketersediaan.php?ID_jadwal=<?php echo $data['ID_jadwal']; ?>" class="btn btn-success">Edit</a>
                                    <a href="hapusdata_jadwalketersediaan.php?ID_jadwal=<?php echo $data['ID_jadwal']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>

                            <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="5">Tidak ada data</td></tr>';
                                }
                            ?>

                        </tbody>
                    </table>
                </div>

                <div class="tombol-tombol">
                    <a href="berandaAdmin.php" class="btn btn-primary" style="width: 100px; height: 38px; text-align: center; line-height: 30px;">Back</a>
                    <button type="button" class="btn btn-primary" id="inputDataButton" style="width: 100px; height: 38px; text-align: center; line-height: 25px; background-color:#4503fc;">Input Data</button>
                </div>

                <div class="formbox" id="formInputArmada">
    <div class="title">
        <p class="title-text">Input Data Jadwal Ketersediaan</p>
    </div>
    <form method="POST" action="prosesinput_jadwalketersediaan.php" id="InputDataArmada" class="form">
        <table>
            <tr>
                <td>Tanggal</td>
                <td><input required type="date" name="Tanggal" id="Tanggal" class="form-control" placeholder="Input Tanggal"></td>
            </tr>
            <tr>
                <td>Sopir</td>
                <td>
                    <select required name="ketersediaan_sopir" id="ketersediaan_sopir" class="form-control">
                        <option value="">Pilih Sopir</option>
                        <?php
                            // Query untuk mengambil data sopir yang tersedia
                            $query_sopir = "SELECT * FROM sopir";
                            $result_sopir = mysqli_query($connect, $query_sopir);

                            while ($sopir = mysqli_fetch_assoc($result_sopir)) {
                                echo '<option value="' . $sopir['ID_sopir'] . '">' . $sopir['Nama_sopir'] . '</option>';
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Armada</td>
                <td>
                    <select required name="ketersediaan_armada" id="ketersediaan_armada" class="form-control">
                        <option value="">Pilih Armada</option>
                        <?php
                            // Query untuk mengambil data armada yang tersedia
                            $query_armada = "SELECT * FROM armada";
                            $result_armada = mysqli_query($connect, $query_armada);

                            while ($armada = mysqli_fetch_assoc($result_armada)) {
                                echo '<option value="' . $armada['ID_Armada'] . '">' . $armada['nama_Armada'] . '</option>';
                            }
                        ?>
                    </select>
                </td>
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
        

    <script src="script.js"></script>
</body>

</html>
