<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

// class BukuExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Buku::all();
//     }
// }

class BukuExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function query()
    {
        return Buku::query();
    }
    public function map($buku): array
    {
        return [
            $buku->judul_buku,
            $buku->isbn,
            $buku->kategori,
            $buku->jenis->nama ?? 'N/A',
            $buku->penulis,
            $buku->penerbit,
            $buku->tahun_terbit,
            $buku->jumlah,
            $buku->created_at,
        ];
    }
           

    public function headings(): array
    {
        return [
            'JUDUL BUKU',
            'ISBN',
            'KATEGORI',
            'JENIS BUKU',
            'PENULIS',
            'PENERBIT',
            'TAHUN TERBIT',
            'JUMLAH',
            'DICATAT PADA',
        ];
    }
}