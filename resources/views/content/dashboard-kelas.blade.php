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
                            <th scope="col">No</th>
                            <th scope="col">Nama Kelas</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $index => $kls)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kls->nama_kelas }}</td>
                                <td>
                                    @if (!$kls->is_used)
                                        <button class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#editModal{{ $kls->id_kelas }}"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteModal{{ $kls->id_kelas }}"><i
                                                class="fas fa-trash"></i></button>
                                    @endif
                                </td>
                            </tr>
                            <div class="modal fade" id="editModal{{ $kls->id_kelas }}" tabindex="-1"
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
                                            <form action="{{ url('dashboard-kelas-edit/' . $kls->id_kelas) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" value="">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="id_kelas">ID Kelas</label>
                                                        <input type="text" name="id_kelas" class="form-control"
                                                            id="id_kelas" value="{{ $kls->id_kelas }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="nama_kelas">Tahun</label>
                                                        <input type="text" name="nama_kelas" class="form-control"
                                                            id="nama_kelas" value="{{ $kls->nama_kelas }}">
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
                            <div class="modal fade" id="deleteModal{{ $kls->id_kelas }}" tabindex="-1"
                                aria-labelledby="deleteModal{{ $kls->id_kelas }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda Yakin ingin menghapus data ini?</p>
                                            <form action="{{ url('dashboard-delete-kelas', $kls->id_kelas) }}"
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
                    <h5 class="modal-title" id="addModalLabel">Add New Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dashboard-kelas-tambah') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_kelas">
                        {{-- <div class="row">
                            <div class="col-12">
                                <label for="id_kelas">ID Kelas</label>
                                <input type="text" name="id_kelas" class="form-control" id="id_kelas"
                                    placeholder="Masukkan ID Kelas ">
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-12">
                                <label for="nama_kelas">Nama Kelas</label>
                                <input type="text" name="nama_kelas" class="form-control" id="nama_kelas"
                                    placeholder="Masukkan Nama Kelas">
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
