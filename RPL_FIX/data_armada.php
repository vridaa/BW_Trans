<?php 
session_start();
if (empty($_SESSION['id'])) {
    header("location:berandaAwal.php?pesan=belum_login");
}
$ID_admin = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Armada</title>
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
                <div>
                    <button type="submit" class="btn custom-btn3" id="tombolMasuk" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <a class="logout" href="logout.php" style="color: white; text-decoration: none;">
                            <p style="padding-top:6px;">Logout</p>
                        </a>
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
                                    $query = mysqli_query($connect, "SELECT * FROM armada where ID_admin = '$ID_admin'");
                                    while ($data = mysqli_fetch_array($query)) {
                            ?>

                            <tr>
                                <td><?php echo $data['ID_Armada'] ?></td>
                                <td><?php echo $data['nama_Armada'] ?></td>
                                <td><?php echo $data['jumlah_kursi'] ?></td>
                                <td><?php echo $data['estimasi_harga'] ?></td>
                                
                                <td>
                                <!--<a href="editdata_armada.php?ID_Armada=<?php echo $data['ID_Armada']; ?>" id="editButton" class="btn btn-success" onclick="showEditPopup()">Edit</a>-->
                                <a href="editdata_armada.php?ID_Armada=<?php echo $data['ID_Armada']; ?>" class="btn btn-success">Edit</a>


                                        <a href="hapusdata_armada.php?ID_Armada=<?php echo $data['ID_Armada']; ?>"class="btn btn-danger">Delete</a>
                                </td>
                            </tr>

                            <?php
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
                        <p class="title-text">Input Data Armada</p>
                    </div>
                    <form method="POST" action="prosesinput_armada.php" id="InputDataArmada" class="form">
                        <table>
                            <tr>
                                <td>Nama & Tipe Armada</td>
                                <td><select class="form-select" name="nama_Armada" id="nama_Armada" aria-label="Default select example">
                                        <option disabled selected>Pilih Nama & Tipe Armada</option>
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
                                        <option disabled selected>Pilih Jumlah Kursi</option>
                                        <option value="29">29 Kursi</option>
                                        <option value="39">39 Kursi</option>
                                    </select></td>
                            </tr>

                            <tr>
                                <td>Estimasi Harga (/km)</td>
                                <td><input required type="text" name="estimasi_harga" id="estimasi_harga" class="form-control"
                                        placeholder="Input Estimasi Harga"></td>
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