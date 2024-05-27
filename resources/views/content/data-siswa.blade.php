@extends('Layout.layout')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>

    <div class="row" style="margin-bottom: 20px;">
        <div>
            <h3>DATA SISWA</h3>
            <div>
                <table class="table" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>ID Kelas</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>123456</td>
                            <td>112233</td>
                            <td>Ipin</td>
                            <td>11 A</td>
                            <td>Cibiru</td>
                            <td>08123456789</td>
                            <td>
                                <div>
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-danger ml-2">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

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
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection