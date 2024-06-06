<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class SiswaImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Validasi data sebelum membuat model
        // $validator = Validator::make($row, [
        //     'nama_kelas' => 'required',
        //     'tahun' => 'required|integer',
        //     'nisn' => 'required',
        //     'nis' => 'required',
        //     'nama' => 'required',
        //     'id_kelas' => 'required|integer',
        //     'id_spp' => 'required|integer',
        //     'alamat' => 'required',
        //     'no_telp' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return null; // Skip the row on validation failure
        // }

        // Cari kelas berdasarkan nama_kelas dan tahun
        $kelas = Kelas::where('nama_kelas', $row['nama_kelas'])
                      ->get();

        // Jika kelas tidak ditemukan, tambahkan data kelas baru
        if (!$kelas) {
            $kelas = new Kelas([
                'nama_kelas' => $row['nama_kelas'],
                'tahun_ajaran' => $row['tahun'],
            ]);
            $kelas->save();
        }

        // Cari spp berdasarkan tahun
        $spp = Spp::where('tahun', $row['tahun'])->get();

        // Jika spp tidak ditemukan, tambahkan data spp baru
        if (!$spp) {
            $spp = new Spp([
                'tahun' => $row['tahun'],
                'nominal' => 0, // Anda bisa menyesuaikan dengan nilai default
            ]);
            $spp->save();
        }

        // Buat model siswa baru
        return new Siswa([
            'nisn' => $row['nisn'],
            'nis' => $row['nis'],
            'nama' => $row['nama'],
            'id_kelas' => $row['id_kelas'],
            'id_spp' => $row['id_spp'],
            'alamat' => $row['alamat'],
            'no_telp' => $row['no_telp'],
        ]);
    }

    /**
     * Skip empty rows
     */
    public function skippEmptyRows(): bool
    {
        return true;
    }
}
