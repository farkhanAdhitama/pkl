<?php

namespace App\Imports;

use App\Models\Majalah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MajalahImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Majalah([

            'nama' => $row[1],
            'tanggal_terbit' => $row[2],
            'nomor' => $row[3],
            'volume' => $row[4],
            'tahun' => $row[5],
            'issn' => $row[6],
            'topik' => $row[7],
            'jumlah' => $row[8],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
