<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail_penjualan extends Model
{
    use HasFormatRupiah;
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
