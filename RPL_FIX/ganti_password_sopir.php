<?php 
session_start();
if (empty($_SESSION['id'])) {
    header("location:berandaAwal.php?pesan=belum_login");
    exit();
}
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ganti Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="css/style_beranda_sopir.css" />
</head>

<body>
    <div class="container-5" style="margin-top:100px; margin-left:500px;">
        <?php 
        include 'koneksi.php';
        $query = mysqli_query($connect, "SELECT * FROM sopir WHERE ID_sopir = '$id'");
        $data = mysqli_fetch_assoc($query);
        ?>
        <div class="card-body">
            <form action="func_ganti_pass.php" method="post" onsubmit="return validate()">
                <h5 class="card-title text-center" style="font-size:25px; font-weight:bold; padding-bottom:20px;">Ganti Password</h5>

                <input type="hidden" name="ID_sopir" value="<?php echo $_SESSION['id'];?>">
                <div class="row mb-3">
                    <label for="op" class="col-sm-3 col-form-label">Password Lama</label>
                    <div class="col-sm-9">
                        <input required type="password" class="form-control w-75" name="op" placeholder="masukkan password lama">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="np" class="col-sm-3 col-form-label">Password Baru</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control w-75" name="np" id="password" placeholder="masukkan password baru">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="cnfrm-password" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-9">
                        <input type="password" onkeyup="checkPassword(this)" class="form-control w-75" id="cnfrm-password" placeholder="ulangi password baru">
                    </div>
                    <div id="alert" class="text-danger"></div>
                </div>
                <center>
                    <button type="submit" class="btn btn-primary">Ganti</button>
                    <button type="reset" class="btn btn-danger">Batal</button>
                    <a href="profilSopir.php" class="btn btn-secondary">Kembali</a>
                </center>
            </form>
        </div>
    </div>
    <script>
        feather.replace();
    </script>
    <script>
        var password = document.getElementById("password");
        var flag = 1;
        function checkPassword(elem) {
            if (elem.value.length > 0) {
                if (elem.value != password.value) {
                    document.getElementById('alert').innerText = "password tidak sama";
                    flag = 0;
                } else {
                    document.getElementById('alert').innerText = "";
                    flag = 1;
                }
            } else {
                document.getElementById('alert').innerText = "masukkan konfirmasi password";
                flag = 0;
            }
        }
        function validate() {
            return flag == 1;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>