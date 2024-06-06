<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Kelas</title>
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

        /* table td.row {
            font-weight: bold;
            padding-right: 100px;
        } */

        .footer {
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="head">
            <h1>Daftar Kelas</h1>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Tahun Ajaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $index => $kls)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kls->nama_kelas }}</td>
                        <td>{{ $kls->tahun_ajaran }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
