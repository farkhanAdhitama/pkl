<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnggotaExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function query()
    {
        return Anggota::query();
    }

    public function map($anggota): array
    {
        return [
            $anggota->nama,
            $anggota->nis,
            $anggota->email,
            $anggota->angkatan,
            $anggota->kelas,  
            $anggota->jurusan,
            $anggota->masa_berlaku,
            $anggota->status,
        ];
    }

    public function headings(): array
    {
        return [
            'NAMA',
            'NIS',
            'EMAIL',
            'ANGKATAN',
            'KELAS',
            'JURUSAN',
            'MASA BERLAKU',
            'STATUS',
        ];
    }
}