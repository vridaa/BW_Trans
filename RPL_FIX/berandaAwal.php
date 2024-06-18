<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Beranda Awal</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <!-- font open sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,300;0,700;1,400;1,700&display=swap"
      rel="stylesheet"
    />
    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tampilkan modal saat halaman dimuat
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal1'));
        myModal.show();
    });
    </script> -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    // Periksa apakah parameter 'pesan' ada dalam URL
    var urlParams = new URLSearchParams(window.location.search);
    var pesan = urlParams.get('pesan');
    
    // Tampilkan modal berdasarkan nilai parameter 'pesan'
    if (pesan === "gagal" || pesan === "logout" || pesan === "belum_login") {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal1'));
        myModal.show();
    }
});
</script>

    <!-- font open sans -->
    <link rel="stylesheet" href="css/style_beranda.css" />
  </head>


  <body>
    <div class="container-5 nol">

      <div class="header" style="width: 1500px;">
        <div class="logo-lerna">
          <strong> <p>Bw Trans</p></strong>
        </div>
      
        <div class="navbar">
          <ul class="nav justify-content-end">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#"><p>Home</p></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#layanan"><p>Layanan Kami</p></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#kontaknih"><p>Kontak</p></a>
            </li>
          </ul>
          <div>
            <button
              type="submit"
              class="btn custom-btn3"
              id="tombolMasuk"
              data-bs-toggle="modal"
              data-bs-target="#exampleModal"
            >
              <p class="login">Login</p>
            </button>
          </div>
        </div>
      </div>


      <div class="miu">
        <div class="container px-4 px-lg-5 awal">
          <div class="row gx-4 gx-lg-5 align-items-center my-5 lanjut">
            <div class="col-lg-7">
              <img
                class="img-fluid rounded mb-4 mb-lg-0"
                src="./assets/images/6.png"
                alt=""
              />
            </div>
            <div class="col-lg-5 ayo">
              <h1 class="font-weight-light"><strong>Ayo Warnai Perjalananmu</strong></h1>
              <p>
                Bw Trans adalah perusahaan jasa sewa bus beserta supir dan
                pelayanan lainnya. Perusahaan kami telah dipercaya oleh custumer
                sejak tahun 1999 hingga saat ini.
              </p>
              <a class="btn custom-btn5" href="cus/berandaCuss.php"
                ><p style="padding-top:3px;">Yuk Reservasi!</p></a
              >
            </div>
          </div>
          <!-- index.html#about -->
        </div>
      </div>

      <div class="container-7" style="width: 1518px; margin-right: 0rem; margin-top: 60px;">
        <div class="container-1">
          <div class="layanan-kami" id="layanan">
            <div class="layanan-kami-1" style="margin-top: 5px;">Layanan Kami</div>
            <div class="container-3">
              <div class="block-1">
                <div class="fasilitas-terbaik">
                  Fasilitas<br />
                  Terbaik
                </div>
                <span class="Fasilitas">
                  Perusahaan kami mengedepankan fasilitas terbaik untuk
                  memastikan pengalaman perjalanan yang nyaman dan berkesan bagi
                  setiap pelanggan
                </span>
              </div>
              <div class="block-2">
                <div class="pelayanan-sepenuh-hati">Pelayanan Sepenuh Hati</div>
                <span class="pelayanan">
                  Pelayanan sepenuh hati adalah landasan utama yang kami anut.
                  Kami berkomitmen untuk menyajikan layanan yang hangat, ramah,
                  dan responsif kepada setiap pelanggan kami.
                </span>
              </div>
              <div class="block-3">
                <div class="harga-yang-bersahabat">Harga yang Bersahabat</div>
                <span class="harga">
                  Kami bangga memberikan harga bersahabat tanpa mengorbankan
                  kualitas. Komitmen kami terhadap kesetiaan pelanggan berarti
                  kami selalu berusaha untuk memberikan nilai terbaik untuk
                  setiap perjalanan.
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer id="kontaknih">
        <div class="kontak">
          <h1>Follow For More Information</h1>
        </div>
        <div class="socials">
          <a href=""><img src="assets/images/whatsapp1.png" alt=""></a>
        </div>
        <div class="credit">
          <p>&copy 2024 by Bw Trans. | All rights reserved.</p>
        </div>
      </footer>
    </div>

    <!-- Modal notif start -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pemberitahuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    // $message = "Selamat datang di Bw Trans.";
                    if (isset($_GET['pesan'])) {
                        if ($_GET['pesan'] == "gagal") {
                            $message = "Login gagal! username dan password salah!";
                        } else if ($_GET['pesan'] == "logout") {
                            $message = "Anda telah berhasil logout";
                        } else if ($_GET['pesan'] == "belum_login") {
                            $message = "Anda harus login untuk mengakses halaman admin";
                        }
                        echo $message;
                    }
                    
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal notif end -->

    <!-- Masuk start -->
    <div class="modal modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col pt-3" style="padding-left: 2.5rem">
            <div class="mask-group-1">
              <div class="teks-paragraf-anda-1">
                <img src="assets/images/login_daftar.png" alt="">
              </div>
            </div>
          </div>
          <div class="col mb-5 masukf">
            <h1>Welcome Back</h1>
            <p class="mb-4">Kami Sangat Senang Melihat Anda Kembali!</p>

            <form action="cek_login.php" method="POST">
              <div class="row">
                <label class="col-form-label"><b>Masukkan Email Anda</b></label>
                <div class="col-sm-12">
                  <input placeholder="Email" type="text" name="email" class="form-control" />
                </div>
              </div>

              <div class="row">
                <label class="col-form-label"><b>Masukkan Password Anda</b></label>
                <div class="col-sm-12">
                  <input placeholder="Password" type="password" name="password" class="form-control" />
                </div>
              </div>

              <div class="row">
                <label class="col-form-label"><b>Masuk Sebagai</b></label>
                <div class="col-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="kategori" id="admin" value="admin" />
                    <label class="form-check-label" for="admin">Admin</label>
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="kategori" id="supir" value="supir" />
                    <label class="form-check-label" for="supir">Supir</label>
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="kategori" id="pengguna" value="pengguna" />
                    <label class="form-check-label" for="pengguna">Pengguna</label>
                  </div>
                </div>
              </div>
              
              <div class="d-grid gap-2">
                <button type="submit" class="mt-4 btn custom-btn4">Login</button>
              </div>
              <div class="text-center text-custom3 mt-4">
                Belum Punya Akun?
                <a href="DAFTAR" data-bs-toggle="modal" data-bs-target="#Modaldaftar">Daftar </a>disini.
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <!-- Masuk End -->

    <!-- Daftar Start -->
    <form action="proses_daftar.php" method="POST"> 
    <div
      class="modal modal-xl"
      id="Modaldaftar"
      tabindex="-1"
      aria-labelledby="ModaldaftarLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="row mb-3">
              <div class="col pt-3" style="padding-left: 2.5rem">
                <div class="mask-group-1">
                  <div class="teks-paragraf-anda-1">
                    <img src="../assets/images/login_daftar.png" alt="" />
                  </div>
                </div>
              </div>
              <div class="col mb-5 daftarf">
                <h1>Let's Join Us</h1>
                <p class="mb-4">
                  Kami Sangat Senang Anda Bergabung Bersama Kami!
                </p>

                <form action="proses_daftar.php" method="POST">
                  <div class="row">
                    <label class="col-form-label"
                      ><b>Masukan Nama Lengkap Anda</b></label
                    >
                    <div class="col-sm-12">
                      <input
                        placeholder="Nama Lengkap"
                        type="text"
                        name="namalengkap"
                        class="form-control"
                      />
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-form-label"
                      ><b>Masukan No.HP anda</b></label
                    >
                    <div class="col-sm-12">
                      <input
                        placeholder="Nomor HP"
                        type="text"
                        name="noHP"
                        class="form-control"
                      />
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-form-label"
                      ><b>Masukan Email</b></label
                    >
                    <div class="col-sm-12">
                      <input
                        placeholder="Email"
                        type="text"
                        name="email"
                        class="form-control"
                      />
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-form-label"
                      ><b>Masukan Password</b></label
                    >
                    <div class="col-sm-12">
                      <input
                        placeholder="Password"
                        type="password"
                        name="password"
                        class="form-control"
                      />
                    </div>
                  </div>

                  <!-- <div class="row">
                    <label class="col-form-label"><b>Daftar Sebagai</b></label>
                    <div class="col-3">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="kategori"
                          id="admin"
                          value="admin"
                        />
                        <label class="form-check-label" for="admin"
                          >Admin</label
                        >
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="kategori"
                          id="supir"
                          value="supir"
                        />
                        <label class="form-check-label" for="supir"
                          >Supir</label
                        >
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="kategori"
                          id="pengguna"
                          value="pengguna"
                        />
                        <label class="form-check-label" for="pengguna"
                          >Pengguna</label
                        >
                      </div>
                    </div>
                  </div> -->

                  <div class="d-grid gap-2">
                    <button type="submit" class="mt-4 btn custom-btn4">
                      Daftar
                    </button>
                  </div>
                  <div class="text-center text-custom3 mt-4">
                    Sudah Punya Akun?
                    <a
                      href="MASUK"
                      data-bs-toggle="modal"
                      data-bs-target="#exampleModal"
                      >Masuk </a
                    >disini.
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
    <!-- Daftar End -->

    <!-- Feather Icon -->
    <script>
      feather.replace();
    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    
    <script src="js/script.js"></script>
  </body>
</html>
