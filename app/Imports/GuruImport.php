<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GuruImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Guru([
            'nama' => $row[1],
            'nik' => $row[2],
            'email' => $row[3],
            'jabatan' => $row[4],
            'masa_berlaku' => $row[5],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
