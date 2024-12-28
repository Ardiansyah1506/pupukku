@extends('layout.app')

@section('title')
    <title>Dashboard</title>
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
@if(session('warning'))
<div id="successPopup" class="popup">
    <div class="popup-content">
        <span class="popup-icon">!</span>
        <h2>Warning</h2>
        <p>{{ session('warning') }}</p>
        <button id="continueButton" type="button">Continue</button>
    </div>
</div>
@endif


<div class="dashboard-container">
    <main class="main-content">
        <div class="home-container">
            <img src="{{ asset('styles/images/avatar.png') }}" alt="Avatar" class="avatar">
            <h2>Halo, Selamat Datang!</h2>
            <p>Saldo Upah Anda:</p>
            <h3 id="saldo">Rp. {{ $data->total_gaji ?? '-' }}</h3>
            <button id="requestButton" class="request-button">Permintaan Penarikan</button>
        </div>
    </main>
</div>

<div id="withdrawalFormModal" class="modal hidden">
    <div class="modal-content">
        <form action="{{ route('dashboard.PengajuanGaji') }}" method="post">
            @csrf
            <h2>RINCIAN</h2>
            <label for="bank">Bank</label>
            <input type="text" id="bank" name="bank" placeholder="Masukkan Nama Bank" required>
        
            <label for="no_rekening">Nomor Rekening</label>
            <input type="text" id="norek" name="no_rekening" placeholder="Masukkan Nomor Rekening" required pattern="^[0-9]+$" title="Hanya angka yang diperbolehkan">
        
            <label for="name">Nama</label>
            <input type="text" name="nama" id="name" placeholder="Masukkan Nama" required>
        
            <label for="amount">Jumlah</label>
            <input type="number" name="total_pengajuan" id="amount" placeholder="Masukkan Jumlah" required min="0">
        
            <button id="closeFormButton" type="button" class="close-button">Close</button>
            <button type="submit" class="confirm-button">Kirim</button>
        </form>
        
       
    </div>
</div>
@endsection


@section('js-custom')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const requestButton = document.getElementById('requestButton');
    const withdrawalFormModal = document.getElementById('withdrawalFormModal');
    const successPopup = document.getElementById('successPopup');
    const closeFormButton = document.getElementById('closeFormButton');
    const sendRequestButton = document.getElementById('sendRequestButton');
    const continueButton = document.getElementById('continueButton');
    const saldoElement = document.getElementById('saldo');
  
    // Tampilkan Form Penarikan
    requestButton.addEventListener('click', function() {
      withdrawalFormModal.classList.remove('hidden');
    });
  
    // Tutup Form Penarikan
    closeFormButton.addEventListener('click', function() {
      withdrawalFormModal.classList.add('hidden');
    });
  
 
  
    // Tutup Popup Success
    continueButton.addEventListener('click', function() {
      successPopup.classList.add('hidden');
    });
  
  });
  </script>
@endsection
