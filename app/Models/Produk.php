<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    use HasFormatRupiah;


    protected $guarded = ['$id'];

    public function detail()
    {
        return $this->hasMany(Detail_penjualan::class);
    }
}
