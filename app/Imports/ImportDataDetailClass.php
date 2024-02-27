<?php

namespace App\Imports;

use App\Models\Detail_penjualan;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportDataDetailClass implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Detail_penjualan([
            //
        ]);
    }
}
