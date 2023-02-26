<?php

namespace App\Exports;

use App\Models\Jenisbuku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class JenisbukuExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function query()
    {
        return Jenisbuku::query();
    }
    public function map($jenisbuku): array
    {
        return [
            $jenisbuku->id,
            $jenisbuku->nama,
        ];
    }

    public function headings(): array
    {
        return [
            'KODE JENIS BUKU',
            'JENIS BUKU',
        ];
    }
}
