document.addEventListener('DOMContentLoaded', function () {
    const detailButtons = document.querySelectorAll('.detail-button');
    const withdrawalModal = document.getElementById('withdrawalModal');
    const successPopup = document.getElementById('successPopup');
    const salaryTableBody = document.getElementById('salaryTableBody');

    const closeModalButton = document.getElementById('closeModalButton');
    const confirmButton = document.getElementById('confirmButton');
    const continueButton = document.getElementById('continueButton');

    const namaSpan = document.getElementById('nama');
    const bankSpan = document.getElementById('bank');
    const norekSpan = document.getElementById('norek');
    const gajiSpan = document.getElementById('gaji');

    const employeeData = {
        1: { nama: "Slamet", bank: "Bank ABC", norek: "00012345", gaji: "Rp. 500,000" },
        2: { nama: "Tejo", bank: "Bank XYZ", norek: "00054321", gaji: "Rp. 450,000" }
    };

    let selectedId;

    // Klik tombol Detail
    detailButtons.forEach(button => {
        button.addEventListener('click', function () {
            selectedId = this.getAttribute('data-id');
            const data = employeeData[selectedId];

            namaSpan.textContent = data.nama;
            bankSpan.textContent = data.bank;
            norekSpan.textContent = data.norek;
            gajiSpan.textContent = data.gaji;

            withdrawalModal.classList.remove('hidden');
        });
    });

    // Klik tombol Close
    closeModalButton.addEventListener('click', function () {
        withdrawalModal.classList.add('hidden');
    });

    // Klik tombol Kirim
    confirmButton.addEventListener('click', function () {
        withdrawalModal.classList.add('hidden');
        successPopup.classList.remove('hidden');

        // Hapus baris dari tabel setelah kirim
        const rowToRemove = document.querySelector(`.detail-button[data-id="${selectedId}"]`).closest('tr');
        rowToRemove.remove();
    });

    // Klik tombol Continue
    continueButton.addEventListener('click', function () {
        successPopup.classList.add('hidden');
    });
});