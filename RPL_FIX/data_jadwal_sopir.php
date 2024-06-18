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
    <title>Jadwal Sopir</title>
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
        .datasopir {
            padding-left: 100px;
        }

        .sopirdata p {
            margin: 5px 0;
            font-size: 16px;
            font-weight: bolder;
            color: black;
        }

        .tabel_data table {
            margin-left: 100px;
            width: 80%; /* Mengatur lebar tabel menjadi 100% dari container */
            border-collapse: collapse; /* Menyatukan batas sel menjadi satu */
        }

    </style>
</head>

<body>
    <div class="container-5">
        <div class="header" style="width: 1515px;">
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
                    <?php
                    // Ambil ID sopir dari parameter URL
                    $ID_sopir = isset($_GET['ID_sopir']) ? $_GET['ID_sopir'] : null;

                    include 'koneksi.php';
                    // 1. Query untuk mengambil informasi sopir dan penanganan kesalahan
                    $query_sopir = mysqli_query($connect, "SELECT s.* FROM sopir s WHERE s.ID_sopir = '$ID_sopir'");
                    if (!$query_sopir) {
                        die("Error query sopir: " . mysqli_error($connect));
                    }

                    if ($data_sopir = mysqli_fetch_assoc($query_sopir)) {
                    ?>
                        <div class="sopirdata">
                            <div class="datasopir">
                                <p>ID Sopir : <?php echo htmlspecialchars($data_sopir['ID_sopir']); ?></p>
                                <p>Nama Sopir : <?php echo htmlspecialchars($data_sopir['Nama_sopir']); ?></p>
                            </div>
                        </div>
                    <?php
                    }

                    // 2. Query untuk mengambil jadwal sopir
                    if (isset($_GET['pesan']) && $_GET['pesan'] == 'input_berhasil') {
                        echo "<div class='alert alert-success'>Data berhasil ditambahkan.</div>";
                    }

                    $query_jadwal = mysqli_query($connect, "SELECT k.tanggal, p.kota_tujuan, a.nama_Armada, j.ID_pesanan
                        FROM jadwal_sopir j
                        INNER JOIN pemesanan p ON j.ID_pesanan = p.ID_pesanan
                        INNER JOIN jadwal k ON p.ID_jadwal = k.ID_jadwal
                        INNER JOIN armada a ON k.Id_armada = a.ID_armada
                        WHERE j.ID_sopir = '$ID_sopir'");

                    if (!$query_jadwal) {
                        die("Error query jadwal: " . mysqli_error($connect));
                    }
                    ?>
                    <div class="tabel_data" style="margin-top: 20px;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kota Tujuan</th>
                                    <th>Armada</th>
                                    <!-- <th>Action</th> -->
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
                                            <!-- <td>
                                                <a href="editdata_jadwalsopir.php?ID_sopir=<?php echo urlencode($ID_sopir); ?>&ID_pesanan=<?php echo urlencode($data['ID_pesanan']); ?>" class="btn btn-success">Edit</a>
                                                <a href="hapusdata_jadwalsopir.php?ID_sopir=<?php echo urlencode($ID_sopir); ?>&ID_pesanan=<?php echo urlencode($data['ID_pesanan']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                                            </td> -->
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

                    <div class="tombol-tombol">
                        <a href="data_sopir.php" class="btn btn-primary" style="width: 100px; height: 38px; text-align: center; line-height: 30px; margin-left:100px;">Back</a>
                        <!-- <button type="button" class="btn btn-primary" id="inputDataButton" style="width: 100px; height: 38px; text-align: center; line-height: 25px; background-color:#4503fc;">Input Data</button> -->
                    </div>

                    <div class="formbox" id="formInputArmada" style="display: none;">
                        <div class="title">
                            <p class="title-text">Input Data Jadwal Sopir</p>
                        </div>
                        <form method="POST" action="prosesinput_jadwalsopir.php" id="InputJadwalSopir" class="form">
                            <input type="hidden" name="ID_sopir" value="<?php echo htmlspecialchars($data_sopir['ID_sopir']); ?>">
                            <table>
                                <tr>
                                    <td>Nama Sopir</td>
                                    <td><?php echo htmlspecialchars($data_sopir['Nama_sopir']); ?></td>
                                </tr>
                                <tr>
                                    <td>ID Pesanan</td>
                                    <td>
                                        <select class="form-select" name="ID_pesanan" id="ID_pesanan" aria-label="Default select example" onchange="updateIDs(this.value)">
                                            <option disabled selected>Pilih ID Pesanan</option>
                                            <?php
                                            $query_pesanan = mysqli_query($connect, "SELECT ID_pesanan, ID_sopir, ID_armada, ID_jadwal FROM pemesanan");
                                            while ($pesanan = mysqli_fetch_assoc($query_pesanan)) {
                                                echo "<option value='{$pesanan['ID_pesanan']}' data-sopir='{$pesanan['ID_sopir']}' data-armada='{$pesanan['ID_armada']}' data-jadwal='{$pesanan['ID_jadwal']}'>{$pesanan['ID_pesanan']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ID Armada</td>
                                    <td>
                                        <input type="text" class="form-control" name="ID_Armada" id="ID_Armada" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ID Jadwal</td>
                                    <td>
                                        <input type="text" class="form-control" name="ID_jadwal" id="ID_jadwal" readonly>
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
    </div>

    <script>
        document.getElementById('inputDataButton').addEventListener('click', function () {
            var form = document.getElementById('formInputArmada');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        });

        function updateIDs(selectedPesanan) {
            const selectedOption = document.querySelector(`#ID_pesanan option[value="${selectedPesanan}"]`);
            document.getElementById('ID_Armada').value = selectedOption.dataset.armada;
            document.getElementById('ID_jadwal').value = selectedOption.dataset.jadwal;
        }

        // Initial call to set values if a schedule is already assigned
        const initialPesanan = document.getElementById('ID_pesanan').value;
        if (initialPesanan) {
            updateIDs(initialPesanan);
        }
    </script>
</body>

</html>
