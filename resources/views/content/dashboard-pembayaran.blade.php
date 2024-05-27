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
                            <th scope="col">Petugas</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Tanggal Bayar</th>
                            <th scope="col">Bulan Awal</th>
                            <th scope="col">Bulan Akhir</th>
                            <th scope="col">Tahun Dibayar</th>
                            <th scope="col">Jumlah Bayar</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayaran as $pembayaran)
                            <tr>
                                <td>{{ $pembayaran->petugas }}</td>
                                {{-- <td>{{ $pembayaran->nisn }}</td> --}}
                                <td>{{ $pembayaran->nisn }} - {{ optional($pembayaran->siswa)->nama }}</td>
                                <td>{{ $pembayaran->tgl_byr }}</td>
                                <td>{{ date('F', mktime(0, 0, 0, $pembayaran->bulan_awal, 1)) }}</td>
                                <td>{{ date('F', mktime(0, 0, 0, $pembayaran->bulan_akhir, 1)) }}</td>
                                <td>{{ $pembayaran->tahun_dibayar }}</td>
                                <td>{{ $pembayaran->jumlah_bayar }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#editModal{{ $pembayaran->id }}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#deleteModal{{ $pembayaran->id }}"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="editModal{{ $pembayaran->id }}" tabindex="-1"
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
                                            <form action="{{ url('dashboard-pembayaran-edit/' . $pembayaran->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" value="">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="petugas">Petugas</label>
                                                        @if(Route::is('dashboard-pembayaran-edit'))
                                                            <input type="text" name="petugas" class="form-control" id="petugas" value="{{ $pembayaran->petugas }}">
                                                        @else
                                                            <input type="text" name="petugas" class="form-control" id="petugas" value="{{ Auth::user()->name }} (admin)" readonly>
                                                        @endif
                                                    </div>
                                                </div>                                                
                                                
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="nisn">NISN</label>
                                                        <select name="nisn" class="form-control" id="nisn">
                                                            @foreach($siswa as $sw)
                                                                @if($sw->nisn === $pembayaran->nisn)
                                                                    <option value="{{ $sw->nisn }}" selected>{{ $sw->nisn }} - {{ $sw->nama }}</option>
                                                                @else
                                                                    <option value="{{ $sw->nisn }}">{{ $sw->nisn }} - {{ $sw->nama }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                

                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="tgl_byr">Tanggal Bayar</label>
                                                        <input type="date" name="tgl_byr" class="form-control"
                                                            id="tgl_byr" value="{{ $pembayaran->tgl_byr }}">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="bulan_awal">Bulan Awal</label>
                                                            <select name="bulan_awal" id="bulan_awal" class="form-control">
                                                                @for ($month = 1; $month <= 12; $month++)
                                                                    <option value="{{ $month }}"
                                                                        {{ $pembayaran->bulan_awal == $month ? 'selected' : '' }}>
                                                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="bulan_akhir">Bulan Akhir</label>
                                                            <select name="bulan_akhir" id="bulan_akhir"
                                                                class="form-control">
                                                                @for ($month = 1; $month <= 12; $month++)
                                                                    <option value="{{ $month }}"
                                                                        {{ $pembayaran->bulan_akhir == $month ? 'selected' : '' }}>
                                                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="tahun_dibayar">Tahun Dibayar</label>
                                                        <input type="year" name="tahun_dibayar" class="form-control"
                                                            id="tahun_dibayar" value="{{ $pembayaran->tahun_dibayar }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="jumlah_bayar">Jumlah Bayar</label>
                                                        <input type="text" name="jumlah_bayar" class="form-control"
                                                            id="jumlah_bayar" value="{{ $pembayaran->jumlah_bayar }}">
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
                            <div class="modal fade" id="deleteModal{{ $pembayaran->id }}" tabindex="-1"
                                aria-labelledby="deleteModal{{ $pembayaran->id }}Label" aria-hidden="true">
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
                                            <form action="{{ url('dashboard-delete-pembayaran', $pembayaran->id) }}"
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
                    <h5 class="modal-title" id="addModalLabel">Add New pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dashboard-pembayaran-tambah') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="petugas">Petugas</label>
                                <input type="text" name="petugas" class="form-control" id="petugas"
                                    value="{{ Auth::user()->name }} ({{ ucfirst(Auth::user()->level) }})" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="nisn">NISN</label>
                                <select name="nisn" class="form-control" id="nisn">
                                    @foreach($siswa as $sw)
                                        <option value="{{ $sw->nisn }}">{{ $sw->nisn }} - {{ $sw->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="tgl_byr">Tanggal Bayar</label>
                                <input type="date" name="tgl_byr" class="form-control" id="tgl_byr"
                                    placeholder="Masukkan Tanggal Bayar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bulan_awal">Bulan Awal</label>
                            <select name="bulan_awal" id="bulan_awal" class="form-control">
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bulan_akhir">Bulan Akhir</label>
                            <select name="bulan_akhir" id="bulan_akhir" class="form-control">
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun_dibayar">Tahun dibayar</label>
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
                        <div class="row">
                            <div class="col-12">
                                <label for="jumlah_bayar">Jumlah Bayar</label>
                                <input type="text" name="jumlah_bayar" class="form-control" id="jumlah_bayar"
                                    placeholder="Masukkan Jumlah Bayar">
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-12">
                                <label for="id_siswa">NISN</label>
                                <select class="custom-select" name="id_siswa" id="id_siswa">
                                    <option selected>Pilih Kelas</option>
                                    @foreach ($siswa as $siswa)
                                        <option value="{{ $s->id_siswa }}">
                                            {{ $kls->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
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
                        </div> --}}
                        {{-- </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="id_spp">Tahun Ajaran</label>
                                <select class="custom-select" name="id_spp" id="id_spp"> --}}

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
