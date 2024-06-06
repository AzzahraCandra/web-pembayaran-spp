<?php

namespace App\Imports;

use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class KelasImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Validate the row data if necessary
        // For example, to ensure 'nama_kelas' is required and 'tahun_ajaran' is numeric
        // Uncomment the lines below and adjust as needed

        // $validator = Validator::make($row, [
        //     'nama_kelas' => 'required',
        //     'tahun_ajaran' => 'numeric',
        // ]);

        // if ($validator->fails()) {
        //     return null; // Skip the row on validation failure
        // }

        return new Kelas([
            'nama_kelas' => $row['nama_kelas'],      // 'nama_kelas' should match the column name in your Excel file
            'tahun_ajaran' => $row['tahun_ajaran'],  // 'tahun_ajaran' should match the column name in your Excel file
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
