<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" id="nisn" name="nisn">
                    </div>
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" id="nis" name="nis">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="id-spp">ID SPP</label>
                        <select id="id-spp" name="id-spp" class="custom-select">
                            <option value="1">112</option>
                            <option value="2">113</option>
                            <option value="3">114</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id-kelas">ID Kelas</label>
                        <select id="id-kelas" name="id-kelas" class="custom-select">
                            <option value="A">10 A</option>
                            <option value="B">11 A</option>
                            <option value="C">12 A</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat">
                    </div>
                    <div class="form-group">
                        <label for="no-telp">No. Telp</label>
                        <input type="text" id="no-telp" name="no-telp">
                    </div>
                    <input type="submit" value="Simpan perubahan">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>