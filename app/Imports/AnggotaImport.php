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
            'email' => $row[3],
            'angkatan' => $row[4],
            'kelas' => $row[5],
            'masa_berlaku' => $row[6],

        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
