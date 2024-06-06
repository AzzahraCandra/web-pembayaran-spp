@extends('Layout.layout')

@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-row align-items-center justify-content-between py-2">
            <h1 class="h3 mb-2 text-gray-800"></h1>
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
                        <a class="dropdown-item" href="{{ url('cetakdatapembayaran') }}">Cetak Data</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#ImportModal">Import Data</a>
                        <a class="dropdown-item" href="{{ url('exportpembayaran') }}">Export Data</a>
                        {{-- <a class="dropdown-item" href="#">Kembalikan Data</a> --}}
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
                                <th scope="col">Petugas</th>
                                <th scope="col">NISN</th>
                                <th scope="col">Tanggal Bayar</th>
                                <th scope="col">Bulan Awal</th>
                                <th scope="col">Bulan Akhir</th>
                                <th scope="col">Tahun Dibayar</th>
                                <th scope="col">Jumlah Bayar</th>
                                @if (in_array(Auth::user()->level, ['admin', 'bendahara']))
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $pb)
                                <tr>
                                    <td>{{ $pb->petugas }}</td>
                                    <td>{{ $pb->nisn }} - {{ optional($pb->siswa)->nama }}</td>
                                    <td>{{ $pb->tgl_byr }}</td>
                                    <td>{{ date('F', mktime(0, 0, 0, $pb->bulan_awal, 1)) }}</td>
                                    <td>{{ date('F', mktime(0, 0, 0, $pb->bulan_akhir, 1)) }}</td>
                                    <td>{{ $pb->tahun_dibayar }}</td>
                                    <td>{{ $pb->jumlah_bayar }}</td>
                                    @if (in_array(Auth::user()->level, ['admin', 'bendahara']))
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#editModal{{ $pb->id }}"><i
                                                    class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#deleteModal{{ $pb->id }}"><i
                                                    class="fas fa-trash"></i></button>
                                        </td>
                                    @endif
                                </tr>


                                {{-- Edit Modals --}}
                                <div class="modal fade" id="editModal{{ $pb->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $pb->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $pb->id }}">Edit Data
                                                    Pembayaran</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('dashboard-pembayaran-edit/' . $pb->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="petugas_edit{{ $pb->id }}">Petugas</label>
                                                        <input type="text" name="petugas" class="form-control"
                                                            id="petugas_edit{{ $pb->id }}"
                                                            value="{{ Auth::user()->name }} ({{ ucfirst(Auth::user()->level) }})"
                                                            readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nisn_edit{{ $pb->id }}">NISN</label>
                                                        <select name="nisn" class="form-control"
                                                            id="nisn_edit{{ $pb->id }}">
                                                            @foreach ($siswa as $sw)
                                                                <option value="{{ $sw->nisn }}"
                                                                    data-nominal="{{ optional($sw->spp)->nominal }}"
                                                                    @if ($sw->nisn == $pb->nisn) selected @endif>
                                                                    {{ $sw->nisn }} - {{ $sw->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group d-none">
                                                        <label for="nominal_edit{{ $pb->id }}">Nominal</label>
                                                        <input type="number" name="nominal" class="form-control"
                                                            id="nominal_edit{{ $pb->id }}"
                                                            value="{{ optional(optional($pb->siswa)->spp)->nominal }}"
                                                            readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tgl_byr_edit{{ $pb->id }}">Tanggal Bayar</label>
                                                        <input type="date" name="tgl_byr" class="form-control"
                                                            id="tgl_byr_edit{{ $pb->id }}"
                                                            value="{{ $pb->tgl_byr }}"
                                                            placeholder="Masukkan Tanggal Bayar">
                                                    </div>
                                                    <div class="d-flex flex-row">
                                                        <div class="form-group mr-2 flex-fill">
                                                            <label for="bulan_awal_edit{{ $pb->id }}">Bulan
                                                                Awal</label>
                                                            <select name="bulan_awal"
                                                                id="bulan_awal_edit{{ $pb->id }}"
                                                                class="form-control">
                                                                @for ($month = 1; $month <= 12; $month++)
                                                                    <option value="{{ $month }}"
                                                                        @if ($month == $pb->bulan_awal) selected @endif>
                                                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="form-group flex-fill">
                                                            <label for="bulan_akhir_edit{{ $pb->id }}">Bulan
                                                                Akhir</label>
                                                            <select name="bulan_akhir"
                                                                id="bulan_akhir_edit{{ $pb->id }}"
                                                                class="form-control">
                                                                @for ($month = 1; $month <= 12; $month++)
                                                                    <option value="{{ $month }}"
                                                                        @if ($month == $pb->bulan_akhir) selected @endif>
                                                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tahun_dibayar_edit{{ $pb->id }}">Tahun
                                                            Dibayar</label>
                                                        <select name="tahun_dibayar"
                                                            id="tahun_dibayar_edit{{ $pb->id }}"
                                                            class="form-control">
                                                            @php
                                                                $startYear = 1999;
                                                                $currentYear = date('Y');
                                                            @endphp
                                                            @for ($year = $startYear; $year <= $currentYear; $year++)
                                                                <option value="{{ $year }}"
                                                                    @if ($year == $pb->tahun_dibayar) selected @endif>
                                                                    {{ $year }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="form-group d-none">
                                                        <label for="jarak_bulan_edit{{ $pb->id }}">Jarak Antar
                                                            Bulan</label>
                                                        <input type="text" id="jarak_bulan_edit{{ $pb->id }}"
                                                            class="form-control" name="jarak_bulan" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jumlah_bayar_edit{{ $pb->id }}">Jumlah
                                                            Bayar</label>
                                                        <input type="text" name="jumlah_bayar" class="form-control"
                                                            id="jumlah_bayar_edit{{ $pb->id }}"
                                                            value="{{ $pb->jumlah_bayar }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modals -->
                                <div class="modal fade" id="deleteModal{{ $pb->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $pb->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $pb->id }}">
                                                    Konfirmasi
                                                    Hapus Data Pembayaran
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data pembayaran ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <form action="{{ url('dashboard-delete-pembayaran', $pb->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
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
                        <form method="POST" action="{{ url('importpembayaran') }}" accept-charset="utf-8"
                            enctype="multipart/form-data">
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

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Data Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('dashboard-pembayaran-tambah') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="petugas">Petugas</label>
                                <input type="text" name="petugas" class="form-control" id="petugas"
                                    value="{{ Auth::user()->name }} ({{ ucfirst(Auth::user()->level) }})" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nisn">NISN</label>
                                <select name="nisn" class="form-control" id="nisn">
                                    @foreach ($siswa as $sw)
                                        <option value="{{ $sw->nisn }}"
                                            data-nominal="{{ optional($sw->spp)->nominal }}">
                                            {{ $sw->nisn }} - {{ $sw->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group d-none">
                                <label for="nominal">Nominal</label>
                                <input type="hidden" name="nominal" class="form-control" id="nominal_tambah" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tgl_byr">Tanggal Bayar</label>
                                <input type="date" name="tgl_byr" class="form-control" id="tgl_byr"
                                    placeholder="Masukkan Tanggal Bayar">
                            </div>
                            <div class="d-flex flex-row">
                                <div class="form-group mr-2 flex-fill">
                                    <label for="bulan_awal">Bulan Awal</label>
                                    <select name="bulan_awal" id="bulan_awal_tambah" class="form-control">
                                        @for ($month = 1; $month <= 12; $month++)
                                            <option value="{{ $month }}">
                                                {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group flex-fill">
                                    <label for="bulan_akhir">Bulan Akhir</label>
                                    <select name="bulan_akhir" id="bulan_akhir_tambah" class="form-control">
                                        @for ($month = 1; $month <= 12; $month++)
                                            <option value="{{ $month }}">
                                                {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tahun_dibayar">Tahun Dibayar</label>
                                <select name="tahun_dibayar" id="tahun_dibayar" class="form-control">
                                    @php
                                        $startYear = 1999;
                                        $currentYear = date('Y');
                                    @endphp
                                    @for ($year = $startYear; $year <= $currentYear; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group d-none">
                                <label for="jarak_bulan">Jarak Antar Bulan</label>
                                <input type="text" id="jarak_bulan" class="form-control" name="jarak_bulan" readonly>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_bayar">Jumlah Bayar</label>
                                <input type="text" name="jumlah_bayar" class="form-control" id="jumlah_bayar_tambah">
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


        <script src="js/bayar.js"></script>
    @endsection
