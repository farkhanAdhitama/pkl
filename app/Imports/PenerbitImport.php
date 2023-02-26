<?php

namespace App\Imports;

use App\Models\Penerbit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PenerbitImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        return new Penerbit([

            'nama_penerbit' => $row[1],
            'alamat' => $row[2],
            'kota' => $row[3],

        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
