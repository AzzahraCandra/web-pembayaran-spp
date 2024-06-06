<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran</title>
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
</head>

<body>
    <div class="container">
        <div class="head">
            <h1>Bukti Pembayaran SPP</h1>
            <h3>Siswa/i SMA PGRI 3 BANDUNG</h3>
        </div>

        <hr>

        <table>
            @foreach ($pembayaran as $pb)
                <tr>
                    <td class="row">NISN</td>
                    <td>: {{ $pb->nisn }}</td>
                </tr>
                <tr>
                    <td class="row">Nama Siswa</td>
                    <td>: {{ optional($pb->siswa)->nama }}</td>
                </tr>
                <tr>
                    <td class="row">Pembayaran Bulan</td>
                    <td>:
                        {{ date('F', mktime(0, 0, 0, $pb->bulan_awal, 1)) }} -
                        {{ date('F', mktime(0, 0, 0, $pb->bulan_akhir, 1)) }}
                    </td>
                </tr>
                <tr>
                    <td class="row">Jumlah Bayar</td>
                    <td>: Rp. {{ number_format($pb->jumlah_bayar, 0) }}</td>
                </tr>
                <tr>
                    <td class="row">Tanggal Bayar</td>
                    <td>: {{ $pb->tgl_byr }}</td>
                </tr>
                <tr>
                    <td class="row">Tahun</td>
                    <td>: {{ $pb->tahun_dibayar }}</td>
                </tr>
                <tr>
                    <td class="row">Nama Petugas</td>
                    <td>: {{ $pb->petugas }}</td>
                </tr>
        </table>

        <hr>

        <p>Berkas Cetak Ini Merupakan Bukti Resmi status pembayaran biaya spp siswa/i pada tanggal
            {{ $pb->tgl_byr }} telah <b>lunas</b></p>

        <p class="footer">
            &copy; SPP Digital SMA PGRI 3
        </p>
        @endforeach
    </div>
</body>

</html>
