document.addEventListener('DOMContentLoaded', () => {
    const selesaiBtns = document.querySelectorAll('.selesai-btn');
    const konfirmasiPopup = document.getElementById('konfirmasi-popup');
    const formPopup = document.getElementById('form-popup');
    const suksesPopup = document.getElementById('sukses-popup');

    // Tombol Selesai di klik
    selesaiBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            konfirmasiPopup.style.display = 'flex';
        });
    });

    // Tombol Batal di Popup Konfirmasi
    document.getElementById('batal-btn').addEventListener('click', () => {
        konfirmasiPopup.style.display = 'none';
    });

    // Tombol Ya di Popup Konfirmasi
    document.getElementById('ya-btn').addEventListener('click', () => {
        konfirmasiPopup.style.display = 'none';
        formPopup.style.display = 'flex';
    });

    // Tombol Batal di Form
    document.getElementById('form-batal-btn').addEventListener('click', () => {
        formPopup.style.display = 'none';
    });

    // Tombol Ya di Form
    document.getElementById('form-ya-btn').addEventListener('click', () => {
        formPopup.style.display = 'none';
        suksesPopup.style.display = 'flex';
    });

    // Tombol Continue di Popup Sukses
    document.getElementById('continue-btn').addEventListener('click', () => {
        suksesPopup.style.display = 'none';
        document.querySelector('tbody').innerHTML = ''; // Hapus baris pekerjaan
    });
});