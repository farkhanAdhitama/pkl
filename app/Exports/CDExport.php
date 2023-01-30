<?php

namespace App\Exports;

use App\Models\CD;
use Maatwebsite\Excel\Concerns\FromCollection;

class CDExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CD::all();
    }
}
