<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
    @auth
        <style>
            .popup {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }

            .popup.hidden {
                display: none;
            }

            .popup-content {
                background-color: #fff;
                padding: 30px;
                border-radius: 10px;
                text-align: center;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                max-width: 300px;
                width: 90%;
            }

            .popup-icon {
                font-size: 3em;
                color: #7B2CBF;
                margin-bottom: 15px;
                display: block;
            }

            .popup-content button {
                padding: 10px 20px;
                background-color: #7B2CBF;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
        </style>
    @endauth
    @yield('css-custom')
</head>

<body>
    @yield('content')


    @auth
        <footer class="bottom-menu">
            <div class="menu-grid">
                @if (Auth::user()->role == 'pegawai')
                    <div
                        class="menu-item {{ Route::currentRouteName() == 'dashboard.index' ? 'active' : '' }}">
                        <a href="{{ route('dashboard.index') }}">Home</a>
                    </div>
                    <div
                        class="menu-item {{ Route::currentRouteName() == 'RiwayatPenarikan.index' ? 'active' : '' }}">
                        <a href="{{ route('RiwayatPenarikan.index') }}">Riwayat Penarikan Gaji</a>
                    </div>
                    <div
                        class="menu-item {{ Route::currentRouteName() == 'pekerjaan.DaftarPekerjaanBaru' ? 'active' : '' }}">
                        <a href="{{ route('pekerjaan.DaftarPekerjaanBaru') }}">Daftar Pekerjaan Baru</a>
                    </div>
                    <div class="menu-item {{ Route::currentRouteName() == 'pekerjaanAktif.index' ? 'active' : '' }}">
                        <a href="{{ route('pekerjaanAktif.index') }}">Pekerjaan Aktif</a>
                    </div>
                @elseif(Auth::user()->role == 'owner')
                    <div class="menu-item {{ Route::currentRouteName() == 'pekerjaan.index' ? 'active' : '' }}">
                        <a href="{{ route('pekerjaan.index') }}">Tambah Pekerjaan Baru</a>
                    </div>
                    <div class="menu-item {{ Route::currentRouteName() == 'laporan.index' ? 'active' : '' }}">
                        <a href="{{ route('laporan.index') }}">Riwayat Pengiriman Pupuk</a>
                    </div>
                    <div class="menu-item {{ Route::currentRouteName() == 'laporan.daftarKaryawan' ? 'active' : '' }}">
                        <a href="{{ Route('laporan.daftarKaryawan') }}">Daftar Karyawan</a>
                    </div>
                    <div class="menu-item {{ Route::currentRouteName() == 'daftar.penarikan.gaji' ? 'active' : '' }}">
                        <a href="">Daftar Penarikan Gaji</a>
                    </div>
                @endif

            </div>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-button">
                    <img src="{{ asset('styles/images/logout.png') }}" alt="Logout">
                </button>
            </form>
            
        </footer>
    @endauth
    <script src="{{ asset('scripts/script.js') }}"></script>
    @yield('js-custom')
</body>

</html>