<?php 
session_start();
if (empty($_SESSION['id'])) {
    header("location:berandaCuss.php?pesan=belum_login");
    exit();
}
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reservasi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="css/style_cus.css" />

    <style>
     .navbar .navbar-nav {
  width: 500px;
  margin-left: 30rem;
}


.table {
    width: 80%;
    margin-left: 100px;
    border-collapse: collapse;
    margin-top: 30px;
    font-size: 1rem; /* Adjust font size as needed */
}

.table th, .table td {
    border: 1px solid #ddd; /* Border style */
    padding: 8px; /* Padding inside table cells */
    text-align: left; /* Align text to the left within cells */
}

.table th {
    background-color: #e6f3fa;
    color: #333; /* Header text color */
    font-size:18px;
    font-weight: bold; /* Bold font for headers */
    text-align: center;
}

.table tbody tr:hover {
    background-color: #f5f5f5; /* Hover background color for rows */
}

.table td {
    background-color: white; /* Light blue background color */
}

    </style>
  </head>

<body>
<?php 
include 'koneksi.php';

$query = mysqli_query($connect, "SELECT * FROM customer WHERE ID_customer = '$id'");
$data_customer = mysqli_fetch_array($query);
?>

<!-- Navbar start -->
<nav class="navbar">
      <div class="logo-lerna">
        <strong><p class="bold-text">Bw Trans</p></strong>
      </div>

      <div class="navbar-nav">
        <div class="navbar-nav-kamu"></div>
          <div class="kamu">
            <a href="berandaAwal.php"><p style="padding-left: 50px;">Home</p></a>
          </div>
          <div class="kamu">
            <a href="Reservasi.php"><p style="padding-left: 50px;">Reservasi</p></a>
          </div>
          <div class="kamu">
            <a href="#kontaknih"><p style="padding-left: 50px;">Kontak</p></a>
          </div>
        </div>
      </div>

      <div class="gradient">
        <div class="profile-dropdown">

        <div onclick="toggle()" class="profile-dropdown-btn">
                <span><?php echo htmlspecialchars($data_customer['Nama_customer']); ?> <i class="fa-solid fa-angle-down"></i></span>
            </div>

          <ul class="profile-dropdown-list">
            <li class="profile-dropdown-list-item">
              <a href="profilCustomer.php">
                <i class="fa-regular fa-user" style="padding-top: 8px;"></i>
                Profile Anda
              </a>
            </li>

            <li class="profile-dropdown-list-item">
              <a href="Reservasi.php">
                <i class="fa-regular fa-pen-to-square" style="padding-top: 8px;"></i>
                Booking Bus
              </a>
            </li>

            <li class="profile-dropdown-list-item">
              <a href="Riwayat.php">
                <i class="fa-solid fa-book" style="padding-top: 8px;"></i>
                Riwayat Transaksi
              </a>
            </li>

            <li class="profile-dropdown-list-item">
              <a href="logout.php">
                <i class="fa-solid fa-arrow-right-from-bracket" style="padding-top: 8px;"></i>
                Log out
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<!-- Navbar end -->

<form method="GET" action="" style="margin-top:150px; margin-left:100px;">
    <label for="tanggal" style="font-size:20px;">Pilih Tanggal : </label>
    <input type="date" id="tanggal" name="tanggal" style="font-size:20px;" required>
    <button class="btn btn-dark" type="submit" style="margin-left: 20px; background-color: black; color:white; font-weight:bold;">Submit</button>
</form>

<?php
if (isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];

    // Query to fetch data from jadwal table based on the input date
    $sql = "SELECT j.ID_jadwal, a.nama_Armada, s.Nama_sopir, a.estimasi_harga
            FROM jadwal j
            JOIN armada a ON j.Id_armada = a.ID_Armada
            JOIN sopir s ON j.Id_sopir = s.ID_sopir
            LEFT JOIN pemesanan p ON j.ID_jadwal = p.ID_jadwal
            WHERE j.tanggal = ? AND p.ID_jadwal IS NULL";

    // Prepare the statement
    $stmt = $connect->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error preparing the query: " . $connect->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("s", $tanggal);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Display the data in the table
        echo '<table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Armada</th>
                    <th scope="col">Sopir</th>
                    <th scope="col">Estimasi Harga</th>
                    <th scope="col">Pilih</th>
                  </tr>
                </thead>
                <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <th scope="row">' . htmlspecialchars($row['ID_jadwal']) . '</th>
                    <td>' . htmlspecialchars($row['nama_Armada']) . '</td>
                    <td>' . htmlspecialchars($row['Nama_sopir']) . '</td>
                    <td>' . htmlspecialchars($row['estimasi_harga']) . '</td>
                    <td>
                        <form action="pesan.php" method="POST">
                            <input type="hidden" name="id_jadwal" value="' . htmlspecialchars($row['ID_jadwal']) . '" />
                            <button type="submit" class="btn">Pilih</button>
                        </form>
                    </td>
                  </tr>';
        }

        echo '</tbody>
            </table>';
    } else {
        echo '<div class="no-schedule-message" style="margin-left:100px; margin-top:15px;">Tidak ada jadwal yang tersedia untuk tanggal tersebut.</div>';
    }

    // Close the statement and the connection
    $stmt->close();
    $connect->close();
}
?>

<footer id="kontaknih" style="margin-top: 180px;">
    <div class="kontak">
        <h1>Follow For More Information</h1>
    </div>
    <div class="socials">
        <a href=""><img src="assets/images/whatsapp1.png" alt="" /></a>
    </div>
    <div class="credit">
        <p>&copy 2024 by Bw Trans. | All rights reserved.</p>
    </div>
</footer>

<script>
    feather.replace();
</script>
<script src="fix_reservasi/js/script.js"></script>
</body>
</html>

