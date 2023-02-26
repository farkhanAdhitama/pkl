<?php

namespace App\Imports;

use App\Models\TempatTerbit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TempatTerbitImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        return new TempatTerbit([
            'kota' => $row[1],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
