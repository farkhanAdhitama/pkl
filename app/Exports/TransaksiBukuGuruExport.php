<?php

namespace App\Exports;

use App\Models\TransaksiGuru;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransaksiBukuGuruExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TransaksiGuru::all();
    }
}
