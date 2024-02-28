<?php

namespace App\Imports;

use App\Models\Penjualan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

HeadingRowFormatter::default('none');

class ImportDataPenjualanClass implements ToCollection, WithCalculatedFormulas
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
                // $Total_harga = isset($row[2][4]) ? $row[2][4] : '';
                // $pelanggan_id = isset($row[3][4]) ? $row[3][4] : '';
                // $tahun_terbit = isset($row[4][4]) ? $row[4][4] : '';
                $tanggal_penjualan=isset($row[1])?($row[1]):'';
                $Total_harga=isset($row[2])?($row[2]):'';
                $pelanggan_id=isset($row[3])?($row[3]):'';
      
                //READY REQUEST
                $trDt[$idx]['tanggal_penjualan'] = $tanggal_penjualan;
                $trDt[$idx]['Total_harga'] = $Total_harga;
                $trDt[$idx]['pelanggan_id'] = $pelanggan_id;

                $data = Penjualan::where('tanggal_penjualan', '=',''.$trDt[$idx]['tanggal_penjualan'].'')->first();
                if ($data) {//UPDATE DATA
                    $data->tanggal_penjualan        = $trDt[$idx]['tanggal_penjualan'];
                    $data->Total_harga         = $trDt[$idx]['Total_harga'];
                    $data->pelanggan_id->nama_pelanggan         = $trDt[$idx]['pelanggan_id'];
                    // SAVE THE DATA
                    if ($data->save()) {
                        // SUCCESS
                        ++$this->edit;
                    }
                } else {//INSERT DATA
                    if($trDt[$idx]['tanggal_penjualan']){
                        $data =  new Penjualan();
                        $data->tanggal_penjualan        = $trDt[$idx]['tanggal_penjualan'];
                        $data->Total_harga         = $trDt[$idx]['Total_harga'];
                        $data->pelanggan_id->nama_pelanggan        = $trDt[$idx]['pelanggan_id'];
                        // SAVE THE DATA
                        if ($data->save()) {
                            // SUCCESS
                            ++$this->insert;
                        }
                    }else{
                        // FAILED
                        ++$this->gagal;
                        $this->listgagal.="(".$trDt[$idx]['tanggal_penjualan']." - ".$trDt[$idx]['tanggal_penjualan']."),<br>";
                    }
                }
            }
        }
    }
}
