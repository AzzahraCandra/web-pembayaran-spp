<?php

namespace App\Imports;

use App\Models\Spp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class SppImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Spp([
            'tahun' => $row['tahun'],
            'nominal' => $row['nominal'],
        ]);
    }

    public function skippEmptyRows(): bool
    {
        return true;
    }
}
