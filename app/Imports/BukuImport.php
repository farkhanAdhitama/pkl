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
            'peruntukan'=> $row[1],
            'isbn' => $row[2],
            'judul_buku' => $row[3],
            'judul_asli' => $row[4],
            'kategori' => $row[5],
            'jenis_id' => $row[6],
            'bahasa' => $row[7],
            'perolehan' => $row[8],
            'subyek' => $row[9],
            'penerjemah' => $row[10],
            'penulis' => $row[11],
            'penerbit_id' => $row[12],
            'tahun_terbit' => $row[13],
            'tempat_terbit_id'=> $row[14],
            'jumlah'=> $row[15],
            'edisi'=> $row[16],
            'jilid'=> $row[17],
            'cetakan'=> $row[18],
            'halaman'=> $row[19],
            'panjang'=> $row[20],
            'lebar'=> $row[21],
            'rak'=> $row[22],
            'harga'=> $row[23],
          
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
