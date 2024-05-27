@extends('Layout.layout')

@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-row align-items-center justify-content-between py-2">
            <h1 class="h3 mb-2 text-gray-800"></h1>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addModal">Tambah Data</button>
        </div>
        {{-- <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Opsi:</div>
                        <a class="dropdown-item" href="#">Cetak Data</a>
                        <a class="dropdown-item" href="#">Import Data</a>
                        <a class="dropdown-item" href="#">Export Data</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Kembalikan Data</a>
                    </div>
                </div>
            </div> --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">NISN</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Tahun Ajaran</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No. Telp</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $siswa)
                            <tr>
                                <td>{{ $siswa->nisn }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->nama_kelas }}</td>
                                <td>{{ $siswa->tahun }}</td>
                                <td>{{ $siswa->alamat }}</td>
                                <td>{{ $siswa->no_telp }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#editModal{{ $siswa->id }}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#deleteModal{{ $siswa->id }}"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="editModal{{ $siswa->id }}" tabindex="-1"
                                aria-labelledby="editModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModal">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('dashboard-siswa-edit/' . $siswa->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" value="">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="nisn">NISN</label>
                                                        <input type="text" name="nisn" class="form-control"
                                                            id="nisn" value="{{ $siswa->nisn }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="nis">NIS</label>
                                                        <input type="text" name="nis" class="form-control"
                                                            id="nis" value="{{ $siswa->nis }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" name="nama" class="form-control"
                                                            id="nama" value="{{ $siswa->nama }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="id_kelas">Kelas</label>
                                                        <select class="custom-select" name="id_kelas" id="id_kelas">
                                                            <option selected>Pilih Kelas</option>
                                                            @foreach ($kelas as $kls)
                                                                <option value="{{ $kls->id_kelas }}">
                                                                    {{ $kls->nama_kelas }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="id_spp">Tahun Ajaran</label>
                                                        <select class="custom-select" name="id_spp" id="id_spp">
                                                            <option selected>Pilih Tahun Ajaran</option>
                                                            @foreach ($spp as $dtspp)
                                                                <option value="{{ $dtspp->id_spp }}">
                                                                    {{ $dtspp->tahun }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="alamat">Alamat</label>
                                                        <input type="text" name="alamat" class="form-control"
                                                            id="alamat" value="{{ $siswa->alamat }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="no_telp">No. Telp</label>
                                                        <input type="text" name="no_telp" class="form-control"
                                                            id="no_telp" value="{{ $siswa->no_telp }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <input type="submit" class="btn btn-success mt-3">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteModal{{ $siswa->id }}" tabindex="-1"
                                aria-labelledby="deleteModal{{ $siswa->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda Yakin ingin menghapus data ini?</p>
                                            <form action="{{ url('dashboard-delete-siswa', $siswa->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-sm btn-danger">Yakin</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dashboard-siswa-tambah') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="nisn">NISN</label>
                                <input type="text" name="nisn" class="form-control" id="nisn"
                                    placeholder="Masukkan NISN">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="nis">NIS</label>
                                <input type="text" name="nis" class="form-control" id="nis"
                                    placeholder="Masukkan NIS">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama"
                                    placeholder="Masukkan Nama">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="id_kelas">Kelas</label>
                                <select class="custom-select" name="id_kelas" id="id_kelas">
                                    <option selected>Pilih Kelas</option>
                                    @foreach ($kelas as $kls)
                                        <option value="{{ $kls->id_kelas }}">
                                            {{ $kls->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="id_spp">Tahun Ajaran</label>
                                <select class="custom-select" name="id_spp" id="id_spp">
                                    <option selected>Pilih Tahun Ajaran</option>
                                    @foreach ($spp as $dtspp)
                                        <option value="{{ $dtspp->id_spp }}">
                                            {{ $dtspp->tahun }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat"
                                    placeholder="Masukkan Alamat">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="no_telp">No. Telp</label>
                                <input type="text" name="no_telp" class="form-control" id="no_telp"
                                    placeholder="Masukkan No. Telepon">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
