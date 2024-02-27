<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_penjualan extends Model
{
    protected $guarded = ['id'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
