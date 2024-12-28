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
        const details = `
          <p>Kendaraan: ${row.cells[0].innerText}</p>
          <p>Nopol: ${row.cells[1].innerText}</p>
          <p>Alamat Kandang: ${row.cells[2].innerText}</p>
          <p>Lokasi Tujuan: ${row.cells[3].innerText}</p>
          <p>Tanggal: ${row.cells[4].innerText}</p>
          <p>Banyak/Karung: ${row.cells[5].innerText}</p>
        `;
        detailPekerjaan.innerHTML = details;
        daftarPekerjaan.classList.add('hidden');
        rincianPekerjaan.classList.remove('hidden');
      }
    });
  
    document.getElementById('ambil-pekerjaan').addEventListener('click', () => {
      rincianPekerjaan.classList.add('hidden');
      peringatan.classList.remove('hidden');
    });
  
    document.getElementById('batal').addEventListener('click', () => {
      peringatan.classList.add('hidden');
      daftarPekerjaan.classList.remove('hidden');
    });
  
    document.getElementById('ya').addEventListener('click', () => {
      peringatan.classList.add('hidden');
      popUpSukses.classList.remove('hidden');
    });
  
    document.getElementById('continue').addEventListener('click', () => {
      popUpSukses.classList.add('hidden');
      if (selectedRow) {
        selectedRow.remove();
        selectedRow = null;
      }
      daftarPekerjaan.classList.remove('hidden');
    });
  });
  