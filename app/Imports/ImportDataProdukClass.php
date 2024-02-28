<?php

namespace App\Imports;

use App\Models\Produk;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

HeadingRowFormatter::default('none');

class ImportDataProdukClass implements ToCollection, WithCalculatedFormulas
{
    /**
    * @param Collection $row
    * @return MsHdCashflow
    */
    public  $insert;
    public  $edit;
    public  $gagal;
    public  $listgagal;

    public function collection(Collection $rows)
    {
        $trDt = [];
        $this->insert = 0;
        $this->edit = 0; 
        $this->gagal = 0; 
        $this->listgagal = "";

        foreach ($rows as $idx => $row) {
            if ($idx > 0) {
                //DECLARE REQUEST
                $no=isset($row[0])?($row[0]):'';
                // $judul = isset($row[1][4]) ? $row[1][4] : '';
                // $harga = isset($row[2][4]) ? $row[2][4] : '';
                // $stok = isset($row[3][4]) ? $row[3][4] : '';
                // $tahun_terbit = isset($row[4][4]) ? $row[4][4] : '';
                $nama_produk=isset($row[1])?($row[1]):'';
                $harga=isset($row[2])?($row[2]):'';
                $stok=isset($row[3])?($row[3]):'';
      
                //READY REQUEST
                $trDt[$idx]['nama_produk'] = $nama_produk;
                $trDt[$idx]['harga'] = $harga;
                $trDt[$idx]['stok'] = $stok;

                $data = Produk::where('nama_produk', '=',''.$trDt[$idx]['nama_produk'].'')->first();
                if ($data) {//UPDATE DATA
                    $data->nama_produk        = $trDt[$idx]['nama_produk'];
                    $data->harga         = $trDt[$idx]['harga'];
                    $data->stok         = $trDt[$idx]['stok'];
                    // SAVE THE DATA
                    if ($data->save()) {
                        // SUCCESS
                        ++$this->edit;
                    }
                } else {//INSERT DATA
                    if($trDt[$idx]['nama_produk']){
                        $data =  new Produk();
                        $data->nama_produk        = $trDt[$idx]['nama_produk'];
                        $data->harga         = $trDt[$idx]['harga'];
                        $data->stok         = $trDt[$idx]['stok'];
                        // SAVE THE DATA
                        if ($data->save()) {
                            // SUCCESS
                            ++$this->insert;
                        }
                    }else{
                        // FAILED
                        ++$this->gagal;
                        $this->listgagal.="(".$trDt[$idx]['nama_produk']." - ".$trDt[$idx]['nama_produk']."),<br>";
                    }
                }
            }
        }
    }
}
