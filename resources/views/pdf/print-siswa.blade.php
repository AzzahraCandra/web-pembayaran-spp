<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Siswa</title>
    <style>
        .container {
            padding-top: 50px;
            margin: 0 50px 0 50px;
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

        table td.row {
            font-weight: bold;
            padding-right: 100px;
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
            <h1>Daftar Siswa/i</h1>
            <h3>SMA PGRI 3 BANDUNG</h3>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    {{-- <th scope="col">No</th> --}}
                    <th scope="col">NISN</th>
                    {{-- <th scope="col">NIS</th> --}}
                    <th scope="col">Nama</th>
                    <th scope="col">Kelas</th>
                    {{-- <th scope="col">Tahun Ajaran</th> --}}
                    <th scope="col">Alamat</th>
                    <th scope="col">No. Telp</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $siswa)
                    <tr>
                        {{-- <td>{{ $index + 1 }}</td> --}}
                        <td>{{ $siswa->nisn }}</td>
                        {{-- <td>{{ $siswa->nis }}</td> --}}
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->nama_kelas }} - {{ optional($siswa->kelas)->tahun_ajaran }}</td>
                        {{-- <td>{{ $siswa->tahun }}</td> --}}
                        <td>{{ $siswa->alamat }}</td>
                        <td>{{ $siswa->no_telp }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
