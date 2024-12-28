document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (username && password) {
        alert(`Selamat datang, ${username}!`);
    } else {
        alert('Harap isi username dan password!');
    }
});

/* ------------- Page Tambah Pekerjaan Baru ------------- */

document.addEventListener('DOMContentLoaded', function () {
    const addJobForm = document.getElementById('addJobForm');
    const successPopup = document.getElementById('successPopup');
    const continueButton = document.getElementById('continueButton');

    // Tambahkan pengecekan null
    if (!addJobForm || !successPopup || !continueButton) {
        console.error('Satu atau lebih elemen tidak ditemukan:', {
            addJobForm,
            successPopup,
            continueButton
        });
        return;
    }

    // Debugging log
    console.log('Elemen ditemukan:', addJobForm, successPopup, continueButton);

    // Tangani pengiriman form
    addJobForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Mencegah reload halaman
        successPopup.classList.remove('hidden'); // Tampilkan pop-up
    });

    // Tangani tombol "Continue"
    continueButton.addEventListener('click', function () {
        successPopup.classList.add('hidden'); // Sembunyikan pop-up
        addJobForm.reset(); // Reset form
    });
});

/* ------------- Page Riwayat Pengiriman Pupuk -------------
document.addEventListener('DOMContentLoaded', function () {
    const detailLinks = document.querySelectorAll('.detail-link');
    const modalLaporan = document.getElementById('modalLaporan');
    const closeModalButton = document.getElementById('closeModalButton');
    const reportContent = document.getElementById('reportContent');

    console.log('Script berjalan');

    // Event listener untuk link "Detail"
    detailLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            console.log('Detail link diklik');

            // Data statis untuk pengujian
            const data = {
                totalPupukTerjual: 100,
                uangMakan: 50000,
                uangBensin: 150000,
                uangTol: 150000,
                upahSupir: 100000
            };

            // Kosongkan isi tabel sebelumnya
            reportContent.innerHTML = '';
            console.log('Sebelum pengisian:', reportContent.innerHTML);

            // Masukkan data ke modal
            reportContent.innerHTML = `
                <tr>
                    <td>Total Pupuk Terjual</td>
                    <td>${data.totalPupukTerjual}</td>
                </tr>
                <tr>
                    <td>Uang Makan</td>
                    <td>Rp. ${data.uangMakan}</td>
                </tr>
                <tr>
                    <td>Uang Bensin</td>
                    <td>Rp. ${data.uangBensin}</td>
                </tr>
                <tr>
                    <td>Uang Tol</td>
                    <td>Rp. ${data.uangTol}</td>
                </tr>
                <tr>
                    <td>Upah Supir</td>
                    <td>Rp. ${data.upahSupir}</td>
                </tr>
            `;
            console.log('Setelah pengisian:', reportContent.innerHTML);

            // Tampilkan modal
            modalLaporan.classList.remove('hidden');
        });
    });

    // Event listener untuk tombol "Close"
    closeModalButton.addEventListener('click', function () {
        console.log('Tombol Close diklik');
        modalLaporan.classList.add('hidden'); // Sembunyikan modal
    });

    // Tutup modal jika klik di luar modal
    window.addEventListener('click', function (event) {
        if (event.target === modalLaporan) {
            console.log('Klik di luar modal');
            modalLaporan.classList.add('hidden');
        }
    });
});
*/