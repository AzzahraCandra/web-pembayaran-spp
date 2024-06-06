document.addEventListener('DOMContentLoaded', function () {
    // Common functions
    function updateNominal(nisnSelect, nominalInput) {
        const selectedOption = nisnSelect.options[nisnSelect.selectedIndex];
        const nominal = parseInt(selectedOption.getAttribute('data-nominal'));
        nominalInput.value = nominal;
    }

    function hitungJarakBulan(bulanAwalSelect, bulanAkhirSelect, jarakBulanInput, nominalInput, jumlahBayarInput) {
        const bulanAwal = parseInt(bulanAwalSelect.value);
        const bulanAkhir = parseInt(bulanAkhirSelect.value);
        let jarak = bulanAkhir - bulanAwal + 1;

        if (jarak < 0) {
            jarak += 12;
        }

        jarakBulanInput.value = jarak;

        // Calculate jumlah bayar
        const nominalSPP = parseInt(nominalInput.value);
        const jumlahBayar = jarak * nominalSPP;
        jumlahBayarInput.value = jumlahBayar.toFixed(2);
    }

    // Event listeners for add modal
    const nisnSelectAdd = document.getElementById('nisn');
    const nominalInputAdd = document.getElementById('nominal_tambah');
    const bulanAwalSelectAdd = document.getElementById('bulan_awal_tambah');
    const bulanAkhirSelectAdd = document.getElementById('bulan_akhir_tambah');
    const jarakBulanInputAdd = document.getElementById('jarak_bulan');
    const jumlahBayarInputAdd = document.getElementById('jumlah_bayar_tambah');

    if (nisnSelectAdd) {
        nisnSelectAdd.addEventListener('change', function () {
            updateNominal(nisnSelectAdd, nominalInputAdd);
            hitungJarakBulan(bulanAwalSelectAdd, bulanAkhirSelectAdd, jarakBulanInputAdd, nominalInputAdd, jumlahBayarInputAdd);
        });

        bulanAwalSelectAdd.addEventListener('change', function () {
            hitungJarakBulan(bulanAwalSelectAdd, bulanAkhirSelectAdd, jarakBulanInputAdd, nominalInputAdd, jumlahBayarInputAdd);
        });

        bulanAkhirSelectAdd.addEventListener('change', function () {
            hitungJarakBulan(bulanAwalSelectAdd, bulanAkhirSelectAdd, jarakBulanInputAdd, nominalInputAdd, jumlahBayarInputAdd);
        });

        // Initialize the nominal value on page load
        updateNominal(nisnSelectAdd, nominalInputAdd);
    }

    // Event listeners for edit modals
    document.querySelectorAll('[id^="editModal"]').forEach(modal => {
        const nisnSelectEdit = modal.querySelector('[id^="nisn_edit"]');
        const nominalInputEdit = modal.querySelector('[id^="nominal_edit"]');
        const bulanAwalSelectEdit = modal.querySelector('[id^="bulan_awal_edit"]');
        const bulanAkhirSelectEdit = modal.querySelector('[id^="bulan_akhir_edit"]');
        const jarakBulanInputEdit = modal.querySelector('[id^="jarak_bulan_edit"]');
        const jumlahBayarInputEdit = modal.querySelector('[id^="jumlah_bayar_edit"]');

        if (nisnSelectEdit) {
            nisnSelectEdit.addEventListener('change', function () {
                updateNominal(nisnSelectEdit, nominalInputEdit);
                hitungJarakBulan(bulanAwalSelectEdit, bulanAkhirSelectEdit, jarakBulanInputEdit, nominalInputEdit, jumlahBayarInputEdit);
            });

            bulanAwalSelectEdit.addEventListener('change', function () {
                hitungJarakBulan(bulanAwalSelectEdit, bulanAkhirSelectEdit, jarakBulanInputEdit, nominalInputEdit, jumlahBayarInputEdit);
            });

            bulanAkhirSelectEdit.addEventListener('change', function () {
                hitungJarakBulan(bulanAwalSelectEdit, bulanAkhirSelectEdit, jarakBulanInputEdit, nominalInputEdit, jumlahBayarInputEdit);
            });

            // Initialize the nominal value on modal load (optional, based on your requirement)
            updateNominal(nisnSelectEdit, nominalInputEdit);
        }
    });
});
