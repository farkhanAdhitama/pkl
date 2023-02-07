<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\TransaksiSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanBukuSiswaExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
      /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function query()
    {
        return TransaksiSiswa::query()->where('status', 'Dipinjam')->where('jenis', 'buku');
    }
    public function map($pinjam): array
    {
        return [
            $pinjam->anggota->nama ?? 'N/A',
            $pinjam->anggota->kelas ?? 'N/A',
            $pinjam->buku->judul_buku ?? 'N/A',
            $pinjam->getCreatedAttribute(),
            $pinjam->getTenggatWaktu($pinjam->lama),
            $pinjam->lama,
        ];
    }
           

    public function headings(): array
    {
        return [
            'NAMA',
            'KELAS',
            'JUDUL',
            'TANGGAL PINJAM',
            'BATAS KEMBALI',
            'LAMA',
        ];
    }
}
