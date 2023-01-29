<?php

namespace App\Exports;

use App\Models\Penerbit;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenerbitExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
   /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function query()
    {
        return Penerbit::query();
    }
    public function map($penerbit): array
    {
        return [
            $penerbit->id,
            $penerbit->nama_penerbit,
        ];
    }

    public function headings(): array
    {
        return [
            'KODE PENERBIT',
            'PENERBIT',
        ];
    }
}
