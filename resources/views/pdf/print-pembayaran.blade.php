<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Pembayaran</title>
    <style>
        .container {
            padding: 50px 20px 0;
            margin: 0px;
        }

        .head {
            width: 100%;
            text-align: center;
            line-height: 10px;
        }

        hr {
            height: 2px;
            background-color: black;
        }

        .table-wrapper {
            display: flex;
            justify-content: center;
        }

        table {
            width: 100%;
            max-width: 1000px;
            /* Adjust this value as needed */
        }

        .footer {
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="head">
            <h1>Daftar Pembayaran</h1>
        </div>
        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Petugas</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Tanggal Bayar</th>
                            <th scope="col">Bulan Awal</th>
                            <th scope="col">Bulan Akhir</th>
                            {{-- <th scope="col">Tahun Dibayar</th> --}}
                            <th scope="col">Jumlah Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayaran as $index => $pb)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pb->petugas }}</td>
                                <td>{{ $pb->nisn }} - {{ optional($pb->siswa)->nama }}</td>
                                <td>{{ $pb->tgl_byr }}</td>
                                <td>{{ date('F', mktime(0, 0, 0, $pb->bulan_awal, 1)) }}</td>
                                <td>{{ date('F', mktime(0, 0, 0, $pb->bulan_akhir, 1)) }}</td>
                                {{-- <td>{{ $pb->tahun_dibayar }}</td> --}}
                                <td>{{ $pb->jumlah_bayar }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
