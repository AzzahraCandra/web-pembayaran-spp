@extends('Layout.layout')

@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-row align-items-center justify-content-between py-2">
            <h1 class="h3 mb-2 text-gray-800"></h1>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (in_array(Auth::user()->level, ['admin', 'bendahara']))
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addModal">Tambah Data</button>
            @endif
        </div>
        <div class="card shadow mb-4">
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
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('cetakspp') }}">Cetak Data</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#ImportModal">Import Data</a>
                        <a class="dropdown-item" href="{{ url('exportspp') }}">Export Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success p-1" id="successMessage">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger p-1" id="successMessage">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tahun Ajaran</th>
                                <th scope="col">Nominal</th>
                                @if (in_array(Auth::user()->level, ['admin', 'bendahara']))
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spp as $index => $sppData)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $sppData->tahun }}</td>
                                    <td>{{ $sppData->nominal }}</td>
                                    @if (in_array(Auth::user()->level, ['admin', 'bendahara']))
                                        <td>

                                            <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#editModal{{ $sppData->id_spp }}"><i
                                                    class="fas fa-edit"></i></button>
                                            @if (!$sppData->is_used)
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal{{ $sppData->id_spp }}"><i
                                                        class="fas fa-trash"></i></button>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                                <div class="modal fade" id="editModal{{ $sppData->id_spp }}" tabindex="-1"
                                    aria-labelledby="editModal{{ $sppData->id_spp }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModal{{ $sppData->id_spp }}Label">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('dashboard-spp-edit/' . $sppData->id_spp) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="">
                                                    <div class="row">
                                                        {{-- <div class="col-12">
                                                        <label for="id_spp">ID SPP</label>
                                                        <input type="text" name="id_spp" class="form-control"
                                                            id="id_spp" value="{{ $sppData->id_spp }}" readonly>
                                                    </div> --}}
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="tahun">Tahun</label>
                                                            <select name="tahun" id="tahun" class="form-control">
                                                                @php
                                                                    $startYear = 1999;
                                                                    $currentYear = date('Y');
                                                                @endphp
                                                                @for ($year = $startYear; $year <= $currentYear; $year++)
                                                                    <option value="{{ $year }}"
                                                                        {{ $year == $sppData->tahun ? 'selected' : '' }}>
                                                                        {{ $year }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="nominal">Nominal</label>
                                                            <input type="number" name="nominal" class="form-control"
                                                                id="nominal" value="{{ $sppData->nominal }}">
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
                                <div class="modal fade" id="deleteModal{{ $sppData->id_spp }}" tabindex="-1"
                                    aria-labelledby="deleteModal{{ $sppData->id_spp }}Label" aria-hidden="true">
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
                                                <form action="{{ url('dashboard-delete-spp', $sppData->id_spp) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-dismiss="modal">Batal</button>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Yakin</button>
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

    <div class="modal fade" id="ImportModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Import Data CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="excel-csv-import-form" method="POST" action="{{ url('importspp') }}"
                        accept-charset="utf-8" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" name="file" placeholder="Choose file">
                                </div>
                                @error('file')
                                    <div class="alert alert-danger mt-1 mb-1">
                                        {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data SPP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dashboard-spp-tambah') }}" method="post">
                        @csrf
                        {{-- <div class="form-group">
                            <label for="id_spp">ID SPP</label>
                            <input type="text" name="id_spp" class="form-control" id="id_spp"
                                placeholder="Masukkan ID SPP">
                        </div> --}}
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                                @php
                                    $startYear = 1999;
                                    $currentYear = date('Y');
                                @endphp
                                @for ($year = $startYear; $year <= $currentYear; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="number" name="nominal" class="form-control" id="nominal"
                                placeholder="Masukkan Nominal">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
