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

    protected $tgl_awal_excel;
    protected $tgl_akhir_excel;

    function __construct($tgl_awal_excel,$tgl_akhir_excel) {
        $this->tgl_awal_excel = $tgl_awal_excel;
        $this->tgl_akhir_excel = $tgl_akhir_excel;
    }
    public function query()
    {
        return CD::query()->whereBetween('created_at', [$this->tgl_awal_excel,$this->tgl_akhir_excel]);
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
