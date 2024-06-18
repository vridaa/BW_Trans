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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin</title>
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
    <link rel="stylesheet" href="css/style_beranda_owner.css" />

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
                        <a class="nav-link" aria-current="page" href="data_admin.php">
                            <p>Tambah Admin</p>
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
                        <p class="judul-text">Admin Home Page</p>
                    </div>
                </div>

                <!-- ======= Services Section ======= -->
                <section id="services" class="services" style="padding-left: 40px; padding-right: 40px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="icon-box">
                                    <i class="bi bi-bus-front"></i>
                                    <h4><a href="data_armada.php">Data Armada</a></h4>
                                    <p>Pada laman ini Anda dapat menginput, mengedit, dan menghapus data armada yang berada di PO BIS Anda</p>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="icon-box">
                                    <i class="bi bi-card-checklist"></i>
                                    <h4><a href="data_sopir.php">Data dan Jadwal Sopir</a></h4>
                                    <p>Pada laman ini Anda dapat menginput, mengedit, dan menghapus data sopir dan jadwal sopir yang bekerja di PO BIS Anda</p>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="icon-box">
                                    <i class="bi bi-clipboard-fill"></i>
                                    <h4><a href="data_laporan.php">Laporan Pemesanan</a></h4>
                                    <p>Pada laman ini Anda dapat melihat laporan pemesanan yang telah dilakukan oleh customer</p>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="icon-box">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <h4><a href="data_jadwal_ketersediaan.php">Jadwal Ketersediaan</a></h4>
                                    <p>Pada laman ini Anda dapat menginput, mengedit, dan menghapus jadwal ketersediaan di PO BIS Anda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- End Services Section -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Feather Icons initialization -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pZNVW3rKHPB6+LVFgIqT9QhbC9a6RDf0TV2dOJR9KTbsKJKH6/8JJUub+1W7B8yR"
        crossorigin="anonymous"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>