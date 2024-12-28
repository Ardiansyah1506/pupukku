@extends('layout.app')

@section('title')
    <title>Manajemen Pegawai</title>
@endsection

@section('css-custom')
<style>
    .main-header{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
@endsection

@section('content')
    @include('partials.modal')
    <div class="dashboard-container">
        <main class="main-content">
            <div class="main-header">
                <h1>Manajemen Pegawai</h1>
                <button id="openFormButton">Tambah</button>
            </div>
            <table class="salary-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                    </tr>
                </thead>
                <tbody id="salaryTableBody">
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->username }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>

    <!-- Modal Form Tambah User -->
    <div id="withdrawalFormModal" class="modal hidden">
        <div class="modal-content">
            <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>

                <button id="closeFormButton" type="button" class="close-button">Tutup</button>
                <button type="submit" class="confirm-button">Kirim</button>
            </form>
        </div>
    </div>
@endsection

@section('js-custom')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openFormButton = document.getElementById('openFormButton');
            const withdrawalFormModal = document.getElementById('withdrawalFormModal');
            const closeFormButton = document.getElementById('closeFormButton');

            // Klik tombol "Tambah" untuk membuka modal
            openFormButton.addEventListener('click', function() {
                withdrawalFormModal.classList.remove('hidden');
            });

            // Klik tombol "Tutup" untuk menutup modal
            closeFormButton.addEventListener('click', function() {
                withdrawalFormModal.classList.add('hidden');
            });
        });
    </script>
@endsection
