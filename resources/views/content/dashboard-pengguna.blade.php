@extends('Layout.layout')

@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-row align-items-center justify-content-between py-2">
            <h1 class="h3 mb-2 text-gray-800">Daftar Pengguna</h1>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addModal">Tambah Data</button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Nama Pengguna</th>
                            <th scope="col">Email</th>
                            <th scope="col">Level</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->level }}</td>
                                @if(auth()->user()->id != $user->id)
                                <td>

                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#editModal{{ $user->id }}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#deleteModal{{ $user->id }}"><i class="fas fa-trash"></i></button>
                                </td>
                                @endif
                            </tr>

                            <!-- Modal Edit User -->
                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit Pengguna
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('dashboard-pengguna-edit/' . $user->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="name{{ $user->id }}">Nama</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="name{{ $user->id }}" value="{{ $user->name }}"
                                                            required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="email{{ $user->id }}">Email</label>
                                                        <input type="email" name="email" class="form-control"
                                                            id="email{{ $user->id }}" value="{{ $user->email }}"
                                                            required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="level{{ $user->id }}">Level</label>
                                                        <select name="level" class="form-select"
                                                            id="level{{ $user->id }}" required>
                                                            <option value="kepsek"
                                                                @if ($user->level == 'kepsek') selected @endif>Kepala
                                                                Sekolah</option>
                                                            <option value="admin"
                                                                @if ($user->level == 'admin') selected @endif>Admin
                                                            </option>
                                                            <option value="bendahara"
                                                                @if ($user->level == 'bendahara') selected @endif>Bendahara
                                                            </option>
                                                            <option value="siswa"
                                                                @if ($user->level == 'siswa') selected @endif>Siswa
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Delete User -->
                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
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
                                            <form action="{{ url('dashboard-delete-pengguna', $user->id) }}"
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

    <!-- Modal Add User -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Pengguna Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dashboard-pengguna-tambah') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="name">Nama</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Enter Name" required>
                            </div>
                            <div class="col-12">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter Email" required>
                            </div>
                            <div class="col-12">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Enter Password" required>
                            </div>
                            <div class="col-12">
                                <label for="level">Level</label>
                                <select name="level" class="form-select" required>
                                    <option value="kepsek">Kepala Sekolah</option>
                                    <option value="admin">Admin</option>
                                    <option value="bendahara">Bendahara</option>
                                    <option value="siswa">Siswa</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
