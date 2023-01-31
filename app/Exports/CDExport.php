<?php

namespace App\Exports;

use App\Models\CD;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class CDExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    use Exportable;

    public function query()
    {
        return CD::query();
    }
    public function map($cd): array
    {
        return [
            $cd->kode_kelompok,
            $cd->judul_cd,
            $cd->perolehan,
            $cd->jumlah,
        ];
    }

    public function headings(): array
    {
        return [
            'KODE KELOMPOK',
            'JUDUL',
            'PEROLEHAN',
            'JUMLAH',
        ];
    }
}
