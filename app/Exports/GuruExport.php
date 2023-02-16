<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GuruExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function query()
    {
        return Guru::query();
    }

    public function map($anggota): array
    {
        return [
            $anggota->nama,
            $anggota->nik,
            $anggota->email,
            $anggota->jabatan,
            $anggota->masa_berlaku,
            $anggota->status,
        ];
    }

    public function headings(): array
    {
        return [
            'NAMA',
            'NIK',
            'EMAIL',
            'JABATAN',
            'BERLAKU SAMPAI',
            'STATUS',
        ];
    }
}