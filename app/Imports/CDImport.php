<?php

namespace App\Imports;

use App\Models\CD;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CDImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CD([

            'kode_kelompok' => $row[1],
            'judul_cd' => $row[2],
            'perolehan' => $row[3],
            'jumlah' => $row[4],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
