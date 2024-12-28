@extends('layout.app')

@section('title')
    <title>Daftar Penarikan Gaji</title>
@endsection

@section('css-custom')
@endsection
@section('content')
    <div class="dashboard-container">
        <main class="main-content">
            <h1>Daftar Penarikan Gaji</h1>
            <table class="salary-table">
                <thead>
                    <tr>
                        <th>NAMA</th>
                        <th>STATUS</th>
                        <th>RINCIAN</th>
                    </tr>
                </thead>
                <tbody id="salaryTableBody">
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>
                                {{ $item->status == 0 ? 'Meminta Penarikan' : 'Terbayar' }}
                            </td>
                            <td>
                                <button class="detail-button {{ $item->status == 0 ? 'inactive' : '' }}"
                                    {{ $item->status == 0 ? '' : 'disabled' }} data-id="{{ $item->id }}">
                                    {{ $item->status == 0 ? 'detail' : 'selesai' }}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>

    <!-- Modal Detail Penarikan -->
    <div id="withdrawalModal" class="modal hidden">
        <div class="modal-content">
            <h2>RINCIAN</h2>
            <p><strong>Nama:</strong> <span id="nama"></span></p>
            <p><strong>Bank:</strong> <span id="bank"></span></p>
            <p><strong>No. Rek.:</strong> <span id="norek"></span></p>
            <p><strong>Gaji:</strong> <span id="gaji"></span></p>
            <button id="closeModalButton" class="close-button">Close</button>
            <button id="confirmButton" class="confirm-button">Kirim</button>
        </div>
    </div>
    {{-- 
<!-- Popup Success -->
<div id="successPopup" class="popup hidden">
    <div class="popup-content">
        <span class="popup-icon">✔</span>
        <h2>SUCCESS!</h2>
        <p>Proses Pengiriman Upah Berhasil</p>
        <button id="continueButton">Continue</button>
    </div>
</div> --}}
@endsection


@section('js-custom')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            // Klik tombol Detail
            detailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id'); // Ambil ID pekerjaan aktif

                    // Ambil data detail dari server
                    fetch(`/riwayat-penarikan/${id}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Data tidak ditemukan');
                            }
                            return response.json();
                        })
                        .then(data => {
                            namaSpan.textContent = data.nama;
                            bankSpan.textContent = data.bank;
                            norekSpan.textContent = data.norek;
                            gajiSpan.textContent = data.gaji;

                            // Tampilkan modal
                            withdrawalModal.classList.remove('hidden');
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                            alert('Terjadi kesalahan saat mengambil data karyawan.');
                        });
                });
            });


            // Klik tombol Close
            closeModalButton.addEventListener('click', function() {
                withdrawalModal.classList.add('hidden');
            });

            // Klik tombol Kirim
            confirmButton.addEventListener('click', function() {
                withdrawalModal.classList.add('hidden');
                successPopup.classList.remove('hidden');

                // Hapus baris dari tabel setelah kirim
                const rowToRemove = document.querySelector(`.detail-button[data-id="${selectedId}"]`)
                    .closest('tr');
                rowToRemove.remove();
            });

            // Klik tombol Continue
            continueButton.addEventListener('click', function() {
                successPopup.classList.add('hidden');
            });
        });
    </script>
@endsection
