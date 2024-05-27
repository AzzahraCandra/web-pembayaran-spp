var inputTanggal = document.getElementById('tahun');
inputTanggal.addEventListener('change', function () {
    var tanggal = new Date(inputTanggal.value);
    var tahun = tanggal.getFullYear();
    document.getElementById('hasil').innerText = tahun;
});