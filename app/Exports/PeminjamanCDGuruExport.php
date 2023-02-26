<?php

namespace App\Exports;

use App\Models\TransaksiGuru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class PeminjamanCDGuruExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function query()
    {
        return TransaksiGuru::query()->where('status', 'Dipinjam')->where('jenis', 'cd');
    }
    public function map($pinjam): array
    {
        return [
            $pinjam->guru->nama ?? 'N/A',
            $pinjam->cd->judul_cd ?? 'N/A',
            $pinjam->getCreatedAttribute(),
            $pinjam->getTenggatWaktu($pinjam->lama),
            $pinjam->lama,
        ];
    }
           

    public function headings(): array
    {
        return [
            'NAMA',
            'JUDUL CD',
            'TANGGAL PINJAM',
            'BATAS KEMBALI',
            'LAMA(HARI)',
        ];
    }
}
