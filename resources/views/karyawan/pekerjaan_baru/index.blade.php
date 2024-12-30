@extends('layout.app')

@section('title')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Pekerjaan Baru</title>
@endsection

@section('css-custom')
@endsection


@section('content')
    <div id="daftar-pekerjaan">
        <table class="table">
            <thead>
                <tr>
                    <th>TRUCK</th>
                    <th>NOPOL</th>
                    <th>ALAMAT KANDANG</th>
                    <th>LOKASI TUJUAN</th>
                    <th>TANGGAL</th>
                    <th>BANYAK / KARUNG</th>
                    <th>Verify</th>
                </tr>
            </thead>
            <tbody id="pekerjaan-baru-list">
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $item->kendaraan }}</td>
                        <td>{{ $item->no_pol }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->total_karung }}</td>
                        <td>
                            <button class="btn-verify" data-id="{{ $item->id }}">Ya</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center">Data Tidak Tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="rincian-pekerjaan" class="modal hidden">
        <div class="modal-content">
            <h3>Rincian</h3>
            <div id="detail-pekerjaan">
                <p>Detail pekerjaan akan ditampilkan di sini.</p>
            </div>
            <button id="ambil-pekerjaan" class="confirm-button">Ambil</button>
        </div>
    </div>

    <!-- Pop-up Peringatan -->
    <div id="peringatan" class="modal hidden">
        <div class="modal-content">
            <h3>Peringatan !!</h3>
            <p>Yakin ingin mengambil pekerjaan ini?</p>
            <div class="popup-actions">
                <button id="batal" class="close-button">Batal</button>
                <button id="ya" class="confirm-button">Ya</button>
            </div>
        </div>
    </div>


    <div id="successPopup" class="popup hidden">
        <div class="popup-content">
            <span class="popup-icon">✔</span>
            <h2>SUCCESS!</h2>
            <p id="successMessage"></p>
            <button id="continueSuccessButton" type="button">Continue</button>
        </div>
    </div>
    
    <div id="warningPopup" class="popup hidden">
        <div class="popup-content">
            <span class="popup-icon">!</span>
            <h2>Warning</h2>
            <p id="warningMessage"></p>
            <button id="continueWarningButton" type="button">Close</button>
        </div>
    </div>
    
@endsection


@section('js-custom')
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const pekerjaanBaruList = document.getElementById('pekerjaan-baru-list');
    const rincianPekerjaan = document.getElementById('rincian-pekerjaan');
    const detailPekerjaan = document.getElementById('detail-pekerjaan');
    const successPopup = document.getElementById('successPopup');
    const warningPopup = document.getElementById('warningPopup');
    const successMessage = document.getElementById('successMessage');
    const warningMessage = document.getElementById('warningMessage');
    const continueSuccessButton = document.getElementById('continueSuccessButton');
    const continueWarningButton = document.getElementById('continueWarningButton');

    // Tutup success pop-up
    continueSuccessButton.addEventListener('click', () => {
        successPopup.classList.add('hidden');
        window.location.reload();
    });

    // Tutup warning pop-up
    continueWarningButton.addEventListener('click', () => {
        warningPopup.classList.add('hidden');
    });

    pekerjaanBaruList.addEventListener('click', (event) => {
        if (event.target.classList.contains('btn-verify')) {
            const row = event.target.closest('tr');
            const pekerjaanId = event.target.dataset.id;

            // Tampilkan detail pekerjaan
            const detailsHTML = `
                <p>Kendaraan: ${row.cells[0].innerText}</p>
                <p>Nopol: ${row.cells[1].innerText}</p>
                <p>Alamat Kandang: ${row.cells[2].innerText}</p>
                <p>Lokasi Tujuan: ${row.cells[3].innerText}</p>
                <p>Tanggal: ${row.cells[4].innerText}</p>
                <p>Banyak/Karung: ${row.cells[5].innerText}</p>
            `;
            detailPekerjaan.innerHTML = detailsHTML;

            // Simpan ID pekerjaan untuk dikirim
            detailPekerjaan.dataset.pekerjaanId = pekerjaanId;
            rincianPekerjaan.classList.remove('hidden');
        }
    });

    document.getElementById('ambil-pekerjaan').addEventListener('click', () => {
        rincianPekerjaan.classList.add('hidden');
        const pekerjaanId = detailPekerjaan.dataset.pekerjaanId;

        // Kirim data ke server menggunakan fetch
        fetch('{{ route('pekerjaan.ambilPekerjaan') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id: pekerjaanId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                successMessage.innerText = data.message;
                successPopup.classList.remove('hidden'); // Tampilkan success pop-up
            } else {
                warningMessage.innerText = data.message;
                warningPopup.classList.remove('hidden'); // Tampilkan warning pop-up
            }
        })
        .catch(error => {
            console.error('Error:', error.message);
            alert('Terjadi kesalahan: ' + error.message);
        });
    });
});

</script>
@endsection
