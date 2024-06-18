document.addEventListener('DOMContentLoaded', function () {
    // Ambil tombol "Input Data"
    const inputDataButton = document.getElementById('inputDataButton');
    // Ambil formbox
    const formbox = document.getElementById('formInputArmada');


    // Tambahkan event listener untuk mengatur tampilan pop-up saat tombol diklik
    inputDataButton.addEventListener('click', function () {
        // Tampilkan formbox
        formbox.style.display = 'block';
    });
});
