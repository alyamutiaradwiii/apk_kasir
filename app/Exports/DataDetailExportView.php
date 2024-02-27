<?php

namespace App\Exports;

use App\Models\Detail_penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataDetailExportView implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Detail_penjualan::all();
    }
}
