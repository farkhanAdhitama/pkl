<?php

namespace App\Imports;

use App\Models\Jenisbuku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class JenisbukuImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Jenisbuku([

            'nama' => $row[1],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}