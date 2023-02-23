<?php

namespace App\Exports;

use App\Models\Majalah;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MajalahExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
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
        return Majalah::query()->whereBetween('created_at', [$this->tgl_awal_excel,$this->tgl_akhir_excel]);
    }
    public function map($majalah): array
    {
        return [
            $majalah->nama,
            $majalah->getTanggalTerbit(),
            $majalah->nomor,
            $majalah->volume,
            $majalah->tahun,
            $majalah->issn,
            $majalah->topik,
            $majalah->jumlah,

        ];
    }

    public function headings(): array
    {
        return [
            'NAMA',
            'TANGGAL TERBIT',
            'NOMOR',
            'VOLUME',
            'TAHUN',
            'ISSN',
            'TOPIK UTAMA',
            'JUMLAH',
        ];
    }
}
