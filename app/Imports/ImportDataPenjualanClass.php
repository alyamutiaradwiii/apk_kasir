<?php

namespace App\Imports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportDataPenjualanClass implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Penjualan([
            //
        ]);
    }
}
