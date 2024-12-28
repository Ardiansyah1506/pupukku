// Tunggu sampai dokumen selesai dimuat
(() => {
    // Fungsi inisialisasi yang akan dipanggil setelah DOM loaded
    function initializeModal() {
        // Ambil referensi elemen yang dibutuhkan
        const detailLinks = document.querySelectorAll('.detail-link');
        const modal = document.getElementById('modalLaporan');
        const closeBtn = document.getElementById('closeModalButton');
        const reportContent = document.getElementById('reportContent');
 
        // Pastikan semua elemen ditemukan
        if (!detailLinks.length || !modal || !closeBtn || !reportContent) {
            console.error('Beberapa elemen tidak ditemukan:', {
                detailLinksFound: !!detailLinks.length,
                modalFound: !!modal,
                closeBtnFound: !!closeBtn,
                reportContentFound: !!reportContent
            });
            return;
        }
 
        // Log untuk debugging
        console.log('Elements:', {
            detailLinks,
            modal,
            closeBtn,
            reportContent
        });
 
        // Handle detail links
        detailLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Detail clicked');
                
                // Data statis untuk testing
                const data = {
                    totalPupukTerjual: 100,
                    uangMakan: 50000,
                    uangBensin: 150000,
                    uangTol: 150000,
                    upahSupir: 100000
                };
 
                // Kosongkan dan isi konten
                reportContent.innerHTML = '';
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
 
                // Tampilkan modal
                modal.classList.remove('hidden');
                console.log('Modal should be visible now');
            });
        });
 
        // Handle close button
        closeBtn.addEventListener('click', function() {
            console.log('Close button clicked');
            modal.classList.add('hidden');
        });
 
        // Handle click outside modal
        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                console.log('Clicked outside modal');
                modal.classList.add('hidden');
            }
        });
    }
 
    // Panggil fungsi inisialisasi setelah DOM loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeModal);
    } else {
        initializeModal();
    }
 })();