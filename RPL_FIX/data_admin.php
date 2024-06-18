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
    <title>Data admin dan Jadwal admin</title>
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
    <?php
    include 'koneksi.php';
    $query = mysqli_query($connect, "SELECT * FROM admin");
    ?>
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
                        <p class="judul-text">Data dan Jadwal admin</p>
                    </div>
                </div>
                <div class="tabel_data">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID admin</th>
                                <th>Nama admin</th>
                                <th>Email admin</th>
                                <th>Kontak admin</th>
                                <th>Alamat admin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($data = mysqli_fetch_array($query)) {
                                echo "<tr>";
                                echo "<td>" . $data['ID_admin'] . "</td>";
                                echo "<td>" . $data['Nama_admin'] . "</td>";
                                echo "<td>" . $data['Email_admin'] . "</td>";
                                echo "<td>" . $data['Kontak_admin'] . "</td>";
                                echo "<td>" . $data['Alamat_admin'] . "</td>";
                                echo "<td>
                                    <a href='hapusdata_admin.php?ID_admin=" . $data['ID_admin'] . "' class='btn btn-danger'>Delete</a>
                                  </td>";
                                echo "</tr>";
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
                        <p class="title-text">Input Data admin</p>
                    </div>
                    <form method="POST" action="prosesinput_admin.php" id="InputDataadmin" class="form">
                        <table>
                            <tr>
                                <td>Nama admin</td>
                                <td><input required type="text" name="Nama_admin" id="Nama_admin" class="form-control" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Email admin</td>
                                <td><input required type="text" name="Email_admin" id="Email_admin" class="form-control" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Kontak admin</td>
                                <td><input required type="text" name="Kontak_admin" id="Kontak_admin" class="form-control" placeholder=""></td>
                            </tr>
                            <tr>
                                <td>Alamat admin</td>
                                <td><input required type="text" name="Alamat_admin" id="Alamat_admin" class="form-control" placeholder=""></td>
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

