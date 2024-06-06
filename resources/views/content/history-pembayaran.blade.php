@extends('Layout.layout')

@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-row align-items-center justify-content-between py-2">
            <h1 class="h3 mb-2 text-gray-800"></h1>
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
                            <th scope="col">Tanggal Bayar</th>
                            <th scope="col">NISN</th>
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
                        @foreach ($pembayaran as $p)
                            <tr>
                                <td>{{ $p->tgl_byr }}</td>
                                <td>{{ $p->nisn }} - {{ optional($p->siswa)->nama }}</td>

                                <td>{{ date('F', mktime(0, 0, 0, $p->bulan_awal, 1)) }}</td>
                                <td>{{ date('F', mktime(0, 0, 0, $p->bulan_akhir, 1)) }}</td>
                                <td>{{ $p->tahun_dibayar }}</td>
                                <td>{{ $p->jumlah_bayar }}</td>
                                @if (in_array(Auth::user()->level, ['admin', 'bendahara']))
                                    <td>
                                        <a class="btn btn-sm btn-success" href="{{ url('cetakpembayaran/' . $p->id) }}"><i
                                                class="fas fa-print"></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
