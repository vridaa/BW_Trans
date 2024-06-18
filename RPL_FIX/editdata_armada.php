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
                                <th>ID Armada</th>
                                <th>Nama & Tipe Armada</th>
                                <th>Jumlah Kursi</th>
                                <th>Estimasi Harga (/KM)</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                include 'koneksi.php';
                                    $ID_Armada = $_GET['ID_Armada'];
                                    $query = mysqli_query($connect, "SELECT * FROM armada");
                                    while ($data = mysqli_fetch_array($query)) {
                            ?>

                            <tr>
                                <td><?php echo $data['ID_Armada'] ?></td>
                                <td><?php echo $data['nama_Armada'] ?></td>
                                <td><?php echo $data['jumlah_kursi'] ?></td>
                                <td><?php echo $data['estimasi_harga'] ?></td>
                                
                                <td>
                                        <a href="editdata_armada.php?ID_Armada=<?php echo $data['ID_Armada']; ?>"
                                            class="btn btn-success">Edit</a>
                                        <a href="hapusdata_armada.php?ID_Armada=<?php echo $data['ID_Armada']; ?>"
                                            class="btn btn-danger">Delete</a>
                                </td>
                            </tr>

                            <?php
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
                        $ID_Armada = $_GET['ID_Armada'];

                        // Query untuk mengambil data armada berdasarkan ID
                        $query = mysqli_query($connect, "SELECT * FROM armada WHERE ID_Armada = '$ID_Armada'");
                        $data = mysqli_fetch_array($query);
                    ?>

                    <form method="POST" action="prosesupdate_armada.php" id="EditDataArmada" class="form">
                    <input type="hidden" name="ID_Armada" value="<?php echo $ID_Armada; ?>">
                        <table>
                            <tr>
                                <td>Nama & Tipe Armada</td>
                                <td><select class="form-select" name="nama_Armada" id="nama_Armada" aria-label="Default select example">
                                        <option value="<?php echo $data['nama_Armada']; ?>" selected><?php echo $data['nama_Armada']; ?></option>
                                        <option value="Bus Ekonomi Tipe 1">Bus Ekonomi Tipe 1</option>
                                        <option value="Bus Ekonomi Tipe 2">Bus Ekonomi Tipe 2</option>
                                        <option value="Bus Ekonomi Tipe 3">Bus Ekonomi Tipe 3</option>
                                        <option value="Bus Ekonomi Tipe 4">Bus Ekonomi Tipe 4</option>
                                        <option value="Bus Ekonomi Tipe 5">Bus Ekonomi Tipe 5</option>
                                        <option value="Bus AC Ekonomi Tipe 1">Bus AC Ekonomi Tipe 1</option>
                                        <option value="Bus AC Ekonomi Tipe 2">Bus AC Ekonomi Tipe 2</option>
                                        <option value="Bus AC Ekonomi Tipe 3">Bus AC Ekonomi Tipe 3</option>
                                    </select></td>
                            </tr>

                            <tr>
                                <td>Jumlah Kursi</td>
                                <td><select class="form-select" name="jumlah_kursi" id="jumlah_kursi" aria-label="Default select example">
                                        <option value="<?php echo $data['jumlah_kursi']; ?>" selected><?php echo $data['jumlah_kursi']. ' Kursi'; ?></option>
                                        <option value="29">29 Kursi</option>
                                        <option value="39">39 Kursi</option>
                                    </select></td>
                            </tr>

                            <tr>
                                <td>Estimasi Harga</td>
                                <td><input required type="text" name="estimasi_harga" id="estimasi_harga" value="<?php echo $data['estimasi_harga']?>" class="form-control"
                                        placeholder=""></td>
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
