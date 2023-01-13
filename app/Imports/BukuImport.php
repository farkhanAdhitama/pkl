<?php

namespace App\Imports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BukuImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Buku([

            'judul_buku' => $row[1],
            'isbn' => $row[2],
            'penulis' => $row[3],
            'penerbit' => $row[4],
            'tahun_terbit' => $row[5],
            'kategori' => $row[6],
            'jenis_id' => $row[7],
            'jumlah'=> $row[8],
          
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
