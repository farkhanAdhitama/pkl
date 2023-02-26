<?php

namespace App\Exports;

use App\Models\TransaksiGuru;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class PeminjamanMajalahGuruExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function query()
    {
        return TransaksiGuru::query()->where('status', 'Dipinjam')->where('jenis', 'majalah');
    }
    public function map($pinjam): array
    {
        return [
            $pinjam->guru->nama ?? 'N/A',
            $pinjam->majalah->nama ?? 'N/A',
            $pinjam->getCreatedAttribute(),
            $pinjam->getTenggatWaktu($pinjam->lama),
            $pinjam->lama,
        ];
    }
           

    public function headings(): array
    {
        return [
            'NAMA',
            'JUDUL MAJALAH',
            'TANGGAL PINJAM',
            'BATAS KEMBALI',
            'LAMA(HARI)',
        ];
    }
}
