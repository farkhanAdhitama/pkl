<?php

namespace App\Exports;

use App\Models\TransaksiSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class PengembalianCDSiswaExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings

{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function query()
    {
        return TransaksiSiswa::query()->where('status', 'Dikembalikan')->where('jenis', 'cd');
    }
    public function map($pinjam): array
    {
        return [
            $pinjam->anggota->nama ?? 'N/A',
            $pinjam->anggota->kelas ?? 'N/A',
            $pinjam->cd->judul_cd ?? 'N/A',
            $pinjam->getCreatedAttribute(),
            $pinjam->getTanggalKembali(),
            $pinjam->lama_peminjaman(),
        ];
    }
           

    public function headings(): array
    {
        return [
            'NAMA',
            'KELAS',
            'JUDUL CD',
            'TANGGAL PINJAM',
            'TANGGAL KEMBALI',
            'TOTAL(HARI)',
        ];
    }
}
