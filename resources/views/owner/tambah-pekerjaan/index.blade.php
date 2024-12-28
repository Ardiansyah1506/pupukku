@extends('layout.app')

@section('title')
<title>Pupukku Login</title>
@endsection

@section('css-custom')

@endsection

@section('content')
@if(session('success'))
<div id="successPopup" class="popup">
    <div class="popup-content">
        <span class="popup-icon">✔</span>
        <h2>SUCCESS!</h2>
        <p>{{ session('success') }}</p>
        <button id="continueButton" type="button">Continue</button>
    </div>
</div>
@endif

<div class="dashboard-container">
    <main class="main-content">
        <h1>Tambah Pekerjaan Baru</h1>
        <form method="POST" action="{{ Route('pekerjaan.store') }}">
            @csrf
            <label for="kendaraan">Kendaraan</label>
            <input type="text" id="kendaraan" name="kendaraan" placeholder="Masukkan nama kendaraan" required>

            <label for="nopol">Nomor Polisi</label>
            <input type="text" id="nopol" name="no_pol" placeholder="Masukkan nomor polisi" required>

            <label for="alamat-kandang">Alamat Kandang</label>
            <input type="text" id="alamat-kandang" name="alamat" placeholder="Masukkan alamat kandang" required>

            <label for="alamat-tujuan">Alamat Tujuan</label>
            <input type="text" id="alamat-tujuan" name="lokasi" placeholder="Masukkan alamat tujuan" required>

            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="banyak">Banyak</label>
            <input type="number" id="banyak" name="total_karung" placeholder="Masukkan jumlah barang" required>

            <button type="submit">Upload</button>
        </form>
    </main>
</div>
@endsection

@section('js-custom')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('successPopup');
        const continueBtn = document.getElementById('continueButton');
        const form = document.querySelector('form');

        if (popup) {
            continueBtn.addEventListener('click', function() {
                popup.classList.add('hidden');
            });
        }
    });
</script>
@endsection
