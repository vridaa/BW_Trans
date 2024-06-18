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
    <title>Edit Data Sopir</title>
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
        #formEditSopir {
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

        input[type="text"] {
            width: 100%; /* Lebar input 100% */
            padding: 8px; /* Padding 8px */
            border: 1px solid #ccc; /* Border 1px solid abu-abu */
            border-radius: 4px; /* Sudut melengkung 4px */
            box-sizing: border-box; /* Padding dan border included dalam ukuran total */
        }

        form table td {
            padding-bottom: 15px;
        }

        form table td:nth-child(2) {
            padding-left: 20px;
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
                        <p class="judul-text">Data dan Jadwal Sopir</p>
                    </div>

                </div>

                <div class="tabel_data">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Sopir</th>
                                <th>Nama Sopir</th>
                                <th>Email Sopir</th>
                                <th>Kontak Sopir</th>
                                <th>Alamat Sopir</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                include 'koneksi.php';
                                    $ID_sopir = $_GET['ID_sopir'];
                                    $query = mysqli_query($connect, "SELECT * FROM sopir");
                                    while ($data = mysqli_fetch_array($query)) {
                            ?>

                            <tr>
                                <td><?php echo $data['ID_sopir'] ?></td>
                                <td><?php echo $data['Nama_sopir'] ?></td>
                                <td><?php echo $data['Email_sopir'] ?></td>
                                <td><?php echo $data['Kontak_sopir'] ?></td>
                                <td><?php echo $data['Alamat_sopir'] ?></td>
                                
                                <td>
                                        <a href="editdata_sopir.php?ID_sopir=<?php echo $data['ID_sopir']; ?>"
                                            class="btn btn-success">Edit</a>
                                        <a href="hapusdata_sopir.php?ID_sopir=<?php echo $data['ID_sopir']; ?>"
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
                    <a href="berandaAdmin.php" class="btn btn-primary" style="width: 90px; height: 36px; text-align: center; line-height: 25px;">Back</a>
                    <button type="button" class="btn btn-secondary" id="inputDataButton">Input Data</button>
                </div>

                <div class="formbox" id="formEditSopir">
                    <div class="title">
                        <p class="title-text">Edit Data Sopir</p>
                    </div>

                    <?php
                        include 'koneksi.php';

                        // Ambil ID sopir dari URL
                        $ID_sopir = $_GET['ID_sopir'];

                        // Query untuk mengambil data sopir berdasarkan ID
                        $query = mysqli_query($connect, "SELECT * FROM sopir WHERE ID_sopir='$ID_sopir'");
                        $data = mysqli_fetch_array($query);
                    ?>

                    <form method="POST" action="prosesupdate_sopir.php">
                    <input type="hidden" name="ID_sopir" value="<?php echo $ID_sopir; ?>">
                        <table>
                            <tr>
                                <td>Nama Sopir</td>
                                <td><input required type="text" name="Nama_sopir" id="Nama_sopir" value="<?php echo $data['Nama_sopir']?>"
                                        class="form-control" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Email Sopir</td>
                                <td><input required type="text" name="Email_sopir" id="Email_sopir" value="<?php echo $data['Email_sopir']?>"
                                        class="form-control" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Kontak Sopir</td>
                                <td><input required type="text" name="Kontak_sopir" id="Kontak_sopir" value="<?php echo $data['Kontak_sopir']?>" class="form-control"
                                        placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Alamat Sopir</td>
                                <td><input required type="text" name="Alamat_sopir" id="Alamat_sopir" value="<?php echo $data['Alamat_sopir']?>" class="form-control"
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
            const formbox = document.getElementById('formEditSopir');
            // Tampilkan formbox
            formbox.style.display = 'block';
        }

        // Panggil fungsi showEditPopup setelah halaman dimuat
        window.onload = showEditPopup;
    </script>

</body>

</html>
