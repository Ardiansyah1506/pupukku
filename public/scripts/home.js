document.addEventListener('DOMContentLoaded', function() {
    const requestButton = document.getElementById('requestButton');
    const withdrawalFormModal = document.getElementById('withdrawalFormModal');
    const successPopup = document.getElementById('successPopup');
    const closeFormButton = document.getElementById('closeFormButton');
    const sendRequestButton = document.getElementById('sendRequestButton');
    const continueButton = document.getElementById('continueButton');
    const saldoElement = document.getElementById('saldo');
    let saldo = 500000;
  
    // Tampilkan Form Penarikan
    requestButton.addEventListener('click', function() {
      withdrawalFormModal.classList.remove('hidden');
    });
  
    // Tutup Form Penarikan
    closeFormButton.addEventListener('click', function() {
      withdrawalFormModal.classList.add('hidden');
    });
  
    // Kirim Permintaan Penarikan
    sendRequestButton.addEventListener('click', function() {
      const amount = document.getElementById('amount').value;
      if (amount && parseInt(amount) <= saldo) {
        saldo -= parseInt(amount);
        // Tampilkan saldo dengan format mata uang (Rp.)
        saldoElement.textContent = "Rp. " + saldo.toLocaleString();
        withdrawalFormModal.classList.add('hidden');
        successPopup.classList.remove('hidden');
      } else {
        alert('Jumlah tidak valid atau melebihi saldo!');
      }
    });
  
    // Tutup Popup Success
    continueButton.addEventListener('click', function() {
      successPopup.classList.add('hidden');
    });
  
    // Inisialisasi tampilan saldo awal
    saldoElement.textContent = "Rp. " + saldo.toLocaleString();
  });