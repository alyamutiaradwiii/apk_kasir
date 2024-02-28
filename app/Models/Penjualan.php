<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    protected $guarded  = ['$id'];
    use HasFormatRupiah;
    
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
