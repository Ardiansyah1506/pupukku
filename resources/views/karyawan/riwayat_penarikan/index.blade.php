@extends('layout.app')

@section('title')
    <title>Daftar Karyawan</title>
@endsection

@section('css-custom')
<style>
    .bukti{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 20px;
    }
</style>
@endsection
@section('content')

    <div class="dashboard-container">
        <main class="main-content">
            <h1>Riwayat Pengajuan gaji</h1>
            <table class="employee-table">
                <thead>
                    <tr>
                        <th>NAMA</th>
                        <th>TOTAL PENGAJUAN</th>
                        <th>NO REKENING</th>
                        <th>BANK</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->total_pengajuan }}</td>
                            <td>{{ $item->no_rekening }}</td>
                            <td>{{ $item->bank }}</td>
                            <td>
                                <button class="detail-button {{ $item->status == 0 ? 'inactive' : '' }}"
                                    {{ $item->status == 0 ? 'disabled' : '' }} data-id="{{ $item->id }}">
                                    {{ $item->status == 0 ? 'Dalam Pengajuan' : 'Selesai' }}
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak ada data pengajuan gaji.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @include('partials.paginate')
        </main>
    </div>

    <!-- Modal Detail Karyawan -->
    <div id="employeeModal" class="modal hidden">
        <div class="modal-content">
            <h2>LAPORAN</h2>
            <div class="bukti">
            <img id="buktiImage" src="" alt="Bukti Transfer" style="width: 100px; height: auto;">
            <a id="buktiLink" href="#" target="_blank">Lihat Bukti</a>
            <button id="closeEmployeeModal" class="close-button">Close</button>
        </div>
    </div>
    </div>
@endsection


@section('js-custom')
    <script>
       document.addEventListener('DOMContentLoaded', function () {
    const detailButtons = document.querySelectorAll('.detail-button:not(.inactive)');
    const modal = document.getElementById('employeeModal');
    const closeModalButton = document.getElementById('closeEmployeeModal');

    // Elemen untuk data di modal
    const buktiImage = document.getElementById('buktiImage');
    const buktiLink = document.getElementById('buktiLink');

    // Event listener untuk tombol Detail
    if (detailButtons.length > 0) {
        detailButtons.forEach(button => {
            button.addEventListener('click', function () {
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
                        const filePath = `/storage/images/bukti_transfer/${data.file}`;

                        // Isi modal dengan data yang diterima dari server
                        buktiImage.src = filePath; // Tampilkan gambar
                        buktiImage.alt = `Bukti transfer untuk ID ${id}`;
                        buktiLink.href = filePath; // Tautkan gambar ke URL
                        buktiLink.textContent = 'Lihat Bukti';

                        // Tampilkan modal
                        modal.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        alert('Terjadi kesalahan saat mengambil data karyawan.');
                    });
            });
        });
    }

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

    </script>
@endsection
