// Menambahkan event listener untuk setiap tombol prev dan next pada setiap card
document.querySelectorAll(".card .prev").forEach(function (prevBtn, index) {
  prevBtn.addEventListener("click", function () {
    showSlideInCard(index + 1, -1);
  });
});

document.querySelectorAll(".card .next").forEach(function (nextBtn, index) {
  nextBtn.addEventListener("click", function () {
    showSlideInCard(index + 1, 1);
  });
});

// Menambahkan event listener untuk setiap dot pada setiap card
document.querySelectorAll(".card .dot").forEach(function (dot, index) {
  dot.addEventListener("click", function () {
    dotslide(index + 1);
  });
});

// Fungsi untuk menampilkan slide pada card tertentu
function showSlideInCard(cardIndex, n) {
  var slides = document.querySelectorAll(
    ".card:nth-of-type(" + cardIndex + ") .imgslide"
  );
  var dots = document.querySelectorAll(
    ".card:nth-of-type(" + cardIndex + ") .dot"
  );

  // Periksa apakah ada slide dan dot di kartu tersebut
  if (slides.length === 0 || dots.length === 0) return;

  slideIndex[cardIndex - 1] += n;

  // Pastikan slideIndex tidak melampaui jumlah slide atau kurang dari 1
  if (slideIndex[cardIndex - 1] > slides.length) {
    slideIndex[cardIndex - 1] = 1;
  }
  if (slideIndex[cardIndex - 1] < 1) {
    slideIndex[cardIndex - 1] = slides.length;
  }

  // Sembunyikan semua slide dan hilangkan kelas "active" dari semua dot
  for (var i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (var i = 0; i < dots.length; i++) {
    dots[i].classList.remove("active");
  }

  // Tampilkan slide yang sesuai dan tambahkan kelas "active" pada dot yang sesuai
  slides[slideIndex[cardIndex - 1] - 1].style.display = "block";
  dots[slideIndex[cardIndex - 1] - 1].classList.add("active");
}

// Inisialisasi slideIndex untuk setiap card
var slideIndex = [];
var cardElements = document.getElementsByClassName("card");
for (var i = 0; i < cardElements.length; i++) {
  slideIndex.push(1); // Menambahkan nilai awal 1 untuk setiap card
}

document.querySelectorAll(".openPopup").forEach(function (button) {
  button.addEventListener("click", function () {
    var dataTitle = this.getAttribute("data-title");
    var dataTipe = this.getAttribute("data-tipe");
    var dataHarga = this.getAttribute("data-harga");
    var dataKursi = this.getAttribute("data-kursi");
    var dataDeskripsi = this.getAttribute("data-deskripsi");
    var dataFasilitas = this.getAttribute("data-fasilitas");

    document.getElementById("dataTitle").textContent = dataTitle;
    document.getElementById("dataTipe").textContent = dataTipe;
    document.getElementById("dataHargaPopup").textContent = dataHarga; // Menggunakan ID yang diperbarui
    document.getElementById("dataKursiPopup").textContent = dataKursi; // Menggunakan ID yang diperbarui

    // Membuat daftar untuk deskripsi
    var deskripsiList = document.getElementById("dataDeskripsi");
    deskripsiList.innerHTML = "";
    var deskripsiItems = dataDeskripsi.split(/\n+/);
    deskripsiItems.forEach(function (item) {
      var listItem = document.createElement("li");
      listItem.textContent = item.trim();
      deskripsiList.appendChild(listItem);
    });

    // Membuat daftar untuk fasilitas
    var fasilitasList = document.getElementById("dataFasilitas");
    fasilitasList.innerHTML = "";
    var fasilitasItems = dataFasilitas.split(";");
    fasilitasItems.forEach(function (item) {
      var listItem = document.createElement("li");
      listItem.textContent = item.trim();
      fasilitasList.appendChild(listItem);
    });

    document.getElementById("popupContainer").style.display = "block";
  });
});

document.getElementById("closePopup").addEventListener("click", function () {
  document.getElementById("popupContainer").style.display = "none";
});

// Mengambil semua tombol dengan kelas "btn-exit"
var closeButtonList = document.querySelectorAll(".btn-exit");

// Menambah event listener untuk setiap tombol "Tutup"
closeButtonList.forEach(function (button) {
  button.addEventListener("click", function () {
    // Mengambil elemen notifikasi popup dan menutupnya
    var popupContainer = document.getElementById("popupContainer");
    popupContainer.style.display = "none";
  });
});

// Menampilkan slide pertama pada setiap card saat halaman dimuat
document.querySelectorAll(".card").forEach(function (card) {
  var firstSlide = card.querySelector(".imgslide:first-of-type");
  if (firstSlide) {
    firstSlide.style.display = "block";
  }
});

// Dapatkan elemen popup
var popup = document.getElementById("popup");

// Dapatkan elemen yang digunakan untuk menutup popup
var span = document.getElementsByClassName("close")[0];

// Ketika elemen dengan class "gradient" diklik, tampilkan popup
document.querySelector(".gradient").onclick = function () {
  popup.style.display = "block";
};

// Ketika tombol 'x' diklik, sembunyikan popup
span.onclick = function () {
  popup.style.display = "none";
};

// Ketika pengguna mengklik di luar popup, sembunyikan popup
window.onclick = function (event) {
  if (event.target == popup) {
    popup.style.display = "none";
  }
};

// profil
// let profileDropdownList = document.querySelector(".profile-dropdown-list");
// let btn = document.querySelector(".profile-dropdown-btn");

// let classList = profileDropdownList.classList;

// const toggle = () => classList.toggle("active");

// window.addEventListener("click", function (e) {
//   if (!btn.contains(e.target)) classList.remove("active");
// });

// Mengambil elemen profil dropdown
let profileDropdownList = document.querySelector(".profile-dropdown-list");
let profileDropdownBtn = document.querySelector(".profile-dropdown-btn");

// Fungsi untuk menampilkan atau menyembunyikan dropdown
const toggleDropdown = () => {
  profileDropdownList.classList.toggle("active");
};

// Menambahkan event listener pada tombol profil dropdown
profileDropdownBtn.addEventListener("click", toggleDropdown);

// Menutup dropdown saat mengklik di luar dropdown atau tombol profil
window.addEventListener("click", (event) => {
  if (
    !profileDropdownBtn.contains(event.target) &&
    !profileDropdownList.contains(event.target)
  ) {
    profileDropdownList.classList.remove("active");
  }
});
