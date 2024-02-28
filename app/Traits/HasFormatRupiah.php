<?php

namespace App\Traits;

trait HasFormatRupiah
{
    function formatRupiah($field, $prefik = null)
    {
        $prefix = $prefik ? $prefik : 'Rp. ';
        $nominal = $this->attributes[$field];
        return $prefix . number_format($nominal, 0, ',', '.');
    }
}

?>