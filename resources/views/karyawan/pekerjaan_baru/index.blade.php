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


    
    <!-- Pop-up Sukses -->
    <div id="pop-up-sukses" class="modal hidden">
        <div class="modal-content">
          <h3>Sukses!</h3>
          <p>Pekerjaan berhasil diambil!</p>
          <button id="tutup-sukses" class="confirm-button">Continue</button>
        </div>
      </div>
    </div>
@endsection


@section('js-custom')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const daftarPekerjaan = document.getElementById('daftar-pekerjaan');
            const rincianPekerjaan = document.getElementById('rincian-pekerjaan');
            const peringatan = document.getElementById('peringatan');
            const popUpSukses = document.getElementById('pop-up-sukses');
            const pekerjaanBaruList = document.getElementById('pekerjaan-baru-list');
            const detailPekerjaan = document.getElementById('detail-pekerjaan');

            let selectedRow = null;

            pekerjaanBaruList.addEventListener('click', (event) => {
                if (event.target.classList.contains('btn-verify')) {
                    const row = event.target.closest('tr');
                    selectedRow = row;
                    const pekerjaanId = event.target.dataset.id;

                    const detailsHTML = `
            <p>Kendaraan: ${row.cells[0].innerText}</p>
            <p>Nopol: ${row.cells[1].innerText}</p>
            <p>Alamat Kandang: ${row.cells[2].innerText}</p>
            <p>Lokasi Tujuan: ${row.cells[3].innerText}</p>
            <p>Tanggal: ${row.cells[4].innerText}</p>
            <p>Banyak/Karung: ${row.cells[5].innerText}</p>
        `;
                    detailPekerjaan.innerHTML = detailsHTML;

                    // Simpan ID pekerjaan di atribut data untuk pengiriman
                    detailPekerjaan.dataset.pekerjaanId = pekerjaanId;

                    rincianPekerjaan.classList.remove('hidden');
                }
            });


            document.getElementById('ambil-pekerjaan').addEventListener('click', () => {
                rincianPekerjaan.classList.add('hidden');
                peringatan.classList.remove('hidden');
            });

            document.getElementById('batal').addEventListener('click', () => {
                peringatan.classList.add('hidden');
            });

            document.getElementById('ya').addEventListener('click', () => {
                const pekerjaanId = detailPekerjaan.dataset.pekerjaanId;

                // Kirim data ke controller melalui fetch
                fetch('{{ Route('pekerjaan.ambilPekerjaan') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            id: pekerjaanId
                        }) // Kirim hanya ID
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            popUpSukses.classList.remove('hidden');
                            peringatan.classList.add('hidden');
                            rincianPekerjaan.classList.add('hidden');
                        } else {
                            alert('Terjadi kesalahan: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            document.getElementById('tutup-sukses').addEventListener('click', () => {
                window.location.reload(); // Segarkan halaman
            });

        });
    </script>
@endsection
