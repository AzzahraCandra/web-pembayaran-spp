<?php

namespace App\Imports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class PembayaranImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Cari siswa berdasarkan NISN
        $siswa = Siswa::where('nisn', $row['nisn'])->first();

        // Jika siswa tidak ditemukan, tambahkan data siswa baru (opsional, sesuaikan dengan kebutuhan)
        if (!$siswa) {
            $siswa = new Siswa([
                'nisn' => $row['nisn'],
                'nis' => $row['nis'],
                'nama' => $row['nama'],
                'id_kelas' => $row['id_kelas'],
                'id_spp' => $row['id_spp'],
                'alamat' => $row['alamat'],
                'no_telp' => $row['no_telp'],
                // Tambahkan informasi lain yang diperlukan
            ]);
            $siswa->save();
        }

        // Tambahkan pembayaran
        return new Pembayaran([
            'petugas' => Auth::user()->name,
            'nisn' => $row['nisn'],
            'tgl_byr' => $row['tgl_byr'],
            'bulan_awal' => $row['bulan_awal'],
            'bulan_akhir' => $row['bulan_akhir'],
            'tahun_dibayar' => $row['tahun_dibayar'],
            'jumlah_bayar' => $row['jumlah_bayar'],
        ]);
    }
}
