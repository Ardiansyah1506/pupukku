document.addEventListener('DOMContentLoaded', function () {
    const detailButtons = document.querySelectorAll('.detail-button:not(.inactive)');
    const modal = document.getElementById('employeeModal');
    const closeModalButton = document.getElementById('closeEmployeeModal');

    // Elemen untuk data di modal
    const pupukSpan = document.getElementById('pupuk');
    const kendaraanSpan = document.getElementById('kendaraan');
    const tujuanSpan = document.getElementById('tujuan');
    const statusSpan = document.getElementById('status');

    // Data statis karyawan
    const employeeData = {
        1: { pupuk: 50, kendaraan: 'L300', tujuan: 'Ungaran', status: 'Dalam Perjalanan' },
        2: { pupuk: 0, kendaraan: '-', tujuan: '-', status: 'Tidak Aktif' }
    };

    // Event listener untuk tombol Detail
    detailButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const data = employeeData[id];

            // Isi modal dengan data karyawan
            pupukSpan.textContent = data.pupuk;
            kendaraanSpan.textContent = data.kendaraan;
            tujuanSpan.textContent = data.tujuan;
            statusSpan.textContent = data.status;

            // Tampilkan modal
            modal.classList.remove('hidden');
        });
    });

    // Tutup modal
    closeModalButton.addEventListener('click', function () {
        modal.classList.add('hidden');
    });

    // Tutup modal jika klik di luar konten
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
});
