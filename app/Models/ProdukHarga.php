<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukHarga extends Model
{
    use HasFactory;

    protected $table = 'produk_harga';

    protected $guarded = [];

    protected $appends = ['harga_format'];

    public function getHargaFormatAttribute()
    {
        return number_format($this->harga);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
