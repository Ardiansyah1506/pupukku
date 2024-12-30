@extends('layout.app')

@section('title')
    <title>Daftar Pekerjaan Aktif</title>
@endsection

@section('css-custom')
@endsection
@section('content')

@include('partials.modal')
    <div class="container">
        <div class="header">
            <h2>Daftar Pekerjaan Aktif</h2>
        </div>

        <table>
            <thead>
                <tr>
                    <th>TRUCK</th>
                    <th>NOPOL</th>
                    <th>ALAMAT KANDANG</th>
                    <th>LOKASI TUJUAN</th>
                    <th>TANGGAL</th>
                    <th>BANYAK/KARUNG</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $item->kendaraan }}</td>
                        <td>{{ $item->no_pol }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->total_karung }}</td>
                        <td>
                            <span class="selesai-btn" data-id="{{ $item->id }}">Selesai</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center">Data Tidak Tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        
        </table>
       @include('partials.paginate')
    </div>

    <!-- Popup Konfirmasi -->
    <div id="konfirmasi-popup" class="popup hidden">
        <div class="popup-content">
            <h3>Peringatan !!</h3>
            <p>Apakah Anda Sudah Yakin Pekerjaan Sudah Selesai?</p>
            <div class="popup-buttons">
                <button id="batal-btn">Batal</button>
                <button id="ya-btn">Ya</button>
            </div>
        </div>
    </div>

    <!-- Popup Form Biaya -->
    <div id="form-popup" class="popup hidden">
        <div class="popup-content">
            <form action="{{ Route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

            <h3>Form Biaya Operasional</h3>
            <input type="hidden" id="idPekerjaanAktif" name="id_pekerjaan">
            <div class="form-group">
                <label>Total Pupuk</label>
                <input type="text" value="" id="totalPupukInput" name="total_pupuk" disabled>
            </div>
            <div class="form-group">
                <label>Uang Makan</label>
                <input type="number" name="makan">
            </div>
            <div class="form-group">
                <label>Uang Bensin</label>
                <input type="number" name="bensin">
            </div>
            <div class="form-group">
                <label>Uang Tol</label>
                <input type="number" name="tol">
            </div>
            <div class="form-group">
                <label>Bukti Foto</label>
                <input type="file" name="file">
            </div>
            <div class="popup-buttons">
                <button id="form-batal-btn">Batal</button>
                <button type="submit">Ya</button>
            </div>
            </form>
        </div>
    </div>
@endsection


@section('js-custom')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Ambil elemen-elemen yang dibutuhkan
            const selesaiBtns = document.querySelectorAll('.selesai-btn'); // Tombol "Selesai"
            const formPopup = document.getElementById('form-popup'); // Popup form
            const konfirmasiPopup = document.getElementById('konfirmasi-popup'); // Popup konfirmasi
            const suksesPopup = document.getElementById('sukses-popup'); // Popup sukses
            const idInput = document.getElementById('idPekerjaanAktif'); // Input hidden untuk ID pekerjaan aktif
            const formBatalBtn = document.getElementById('form-batal-btn'); // Tombol "Batal" di form
            const batalKonfirmasiBtn = document.getElementById('batal-btn'); // Tombol "Batal" di popup konfirmasi
            const yaKonfirmasiBtn = document.getElementById('ya-btn'); // Tombol "Ya" di popup konfirmasi
            const continueBtn = document.getElementById('continueButton');
            
            // Event listener untuk tombol "Selesai"
            selesaiBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const row = btn.closest('tr'); 
                    const pekerjaanId = btn.dataset.id; // Ambil data-id dari tombol
                    const totalPupuk = row.querySelector('td:nth-child(6)').textContent; 
                    idInput.value = pekerjaanId; // Isi input hidden dengan ID pekerjaan
                    totalPupukInput.value = totalPupuk; 
                    konfirmasiPopup.style.display = 'flex'; // Tampilkan popup konfirmasi
                });
            });

            // Event listener untuk tombol "Batal" di popup konfirmasi
            batalKonfirmasiBtn.addEventListener('click', () => {
                konfirmasiPopup.style.display = 'none'; // Sembunyikan popup konfirmasi
            });

            // Event listener untuk tombol "Ya" di popup konfirmasi
            yaKonfirmasiBtn.addEventListener('click', () => {
                konfirmasiPopup.style.display = 'none'; // Sembunyikan popup konfirmasi
                formPopup.style.display = 'flex'; // Tampilkan popup form
            });

            // Event listener untuk tombol "Batal" di form
            formBatalBtn.addEventListener('click', () => {
                formPopup.style.display = 'none'; // Sembunyikan popup form
                idInput.value = ''; // Reset nilai input hidden
            });


            // Event listener untuk tombol "Continue" di popup sukses
            continueBtn.addEventListener('click', () => {
                suksesPopup.style.display = 'none'; // Sembunyikan popup sukses
            });
        });
    </script>
@endsection
