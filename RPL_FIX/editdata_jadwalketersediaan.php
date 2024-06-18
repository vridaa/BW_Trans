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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Armada</title>
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

    <style>
        #formEditArmada {
            display: none; /* Mulai formbox dalam keadaan tersembunyi */
            position: fixed; /* Tetapkan posisi formbox */
            top: 50%; /* Posisikan di tengah vertikal */
            left: 50%; /* Posisikan di tengah horizontal */
            transform: translate(-50%, -50%); /* Pusatkan formbox */
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5);
            z-index: 999; /* Atur indeks z untuk menampilkan di atas elemen lain */
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
                    <button type="submit" class="btn custom-btn3" id="tombolMasuk" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <p class="login">Login</p>
                    </button>
                </div>
            </div>
        </div>
        <div class="container-7">
            <div class="mask-group">
                <div class="container">

                    <div class="judul">
                        <p class="judul-text">Data Armada</p>
                    </div>

                </div>

                <div class="tabel_data">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Jadwal</th>
                                <th>Tanggal</th>
                                <th>Ketersediaan Sopir</th>
                                <th>Ketersediaan Armada</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            include 'koneksi.php';
                            $ID_jadwal = $_GET['ID_jadwal'];
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
                    <a href="beranda_owner.html" class="btn btn-primary" style="width: 90px; height: 36px; text-align: center; line-height: 25px;">Back</a>
                    <button type="button" class="btn btn-secondary" id="inputDataButton">Input Data</button>
                </div>

                <div class="formbox" id="formEditArmada">
    <div class="title">
        <p class="title-text">Edit Data Armada</p>
    </div>

    <?php
    include 'koneksi.php';

    // Ambil ID Armada dari URL
    $ID_jadwal = $_GET['ID_jadwal'];

    // Query untuk mengambil data armada berdasarkan ID
    $ID_jadwal = $_GET['ID_jadwal'];

                    // Query untuk mengambil data armada berdasarkan ID
                    $query_edit = "SELECT j.ID_jadwal, j.tanggal, s.Nama_sopir, a.nama_Armada 
                                   FROM jadwal j 
                                   JOIN sopir s ON j.Id_sopir = s.ID_sopir 
                                   JOIN armada a ON j.Id_armada = a.ID_Armada
                                   WHERE j.ID_jadwal = '$ID_jadwal'";
                    $result_edit = mysqli_query($connect, $query_edit);
                    $data = mysqli_fetch_assoc($result_edit);
                    
    ?>

    <form method="POST" action="prosesupdate_jadwalketersediaan.php" id="EditDataArmada" class="form">
        <input type="hidden" name="ID_jadwal" value="<?php echo $ID_jadwal; ?>">
        <table>
            <tr>
                <td>Tanggal</td>
                <td><input required type="date" name="Tanggal" id="Tanggal" value="<?php echo $data['tanggal']; ?>" class="form-control" placeholder=""></td>
            </tr>
            <tr>
                <td>Sopir</td>
                <td>
                    <select required name="ketersediaan_sopir" id="ketersediaan_sopir" class="form-control">
                        <option value="<?php echo $data['Id_sopir']; ?>"><?php echo $data['Nama_sopir']; ?></option>
                        <?php
                        // Query untuk mengambil data sopir yang tersedia
                        $query_sopir = "SELECT * FROM sopir";
                        $result_sopir = mysqli_query($connect, $query_sopir);

                        while ($sopir = mysqli_fetch_assoc($result_sopir)) {
                            // Menandai opsi yang dipilih berdasarkan data yang sudah ada
                            if ($sopir['ID_sopir'] != $data['Id_sopir']) {
                                echo '<option value="' . $sopir['ID_sopir'] . '">' . $sopir['Nama_sopir'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Armada</td>
                <td>
                    <select required name="ketersediaan_armada" id="ketersediaan_armada" class="form-control">
                        <option value="<?php echo $data['Id_armada']; ?>"><?php echo $data['nama_Armada']; ?></option>
                        <?php
                        // Query untuk mengambil data armada yang tersedia
                        $query_armada = "SELECT * FROM armada";
                        $result_armada = mysqli_query($connect, $query_armada);

                        while ($armada = mysqli_fetch_assoc($result_armada)) {
                            // Menandai opsi yang dipilih berdasarkan data yang sudah ada
                            if ($armada['ID_Armada'] != $data['Id_armada']) {
                                echo '<option value="' . $armada['ID_Armada'] . '">' . $armada['nama_Armada'] . '</option>';
                            }
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

    <!--
        <footer id="kontaknih">
            <div class="kontak">
                <h1>Follow For More Information</h1>
            </div>
            <div class="socials">
                <a href="#"><i data-feather="youtube"></i></a>
                <a href="#"><i data-feather="instagram"></i></a>
                <a href="#"><i data-feather="twitter"></i></a>
                <a href="#"><i data-feather="facebook"></i></a>
            </div>
            <div class="credit">
                <p>&copy 2024 by Pw Trans. | All rights reserved.</p>
            </div>
        </footer>
        -->
    </div>

    <script>
        // Fungsi untuk menampilkan pop-up saat halaman dimuat
        function showEditPopup() {
            // Ambil formbox
            const formbox = document.getElementById('formEditArmada');
            // Tampilkan formbox
            formbox.style.display = 'block';
        }

        // Panggil fungsi showEditPopup setelah halaman dimuat
        window.onload = showEditPopup;
    </script>

</body>

</html>
