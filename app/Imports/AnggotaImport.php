<?php

namespace App\Imports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class AnggotaImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Anggota([
            'nama' => $row[1],
            'nis' => $row[2],
            'angkatan' => $row[3],
            'kelas' => $row[4],
            'masa_berlaku' => $row[5],

        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
