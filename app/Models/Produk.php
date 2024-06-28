<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $guarded = [];

    protected $appends = ['unit_available'];

    protected $fillabe = [
        'varian',
        'merk',
        'plat',
        'gambar'
    ];

    public function list_harga()
    {
        return $this->hasMany(ProdukHarga::class, 'produk_id');
    }

    public function getUnitAvailableAttribute()
    {
        $taken = Transaksi::where('produk_id', $this->id)->whereIn('status', [0, 1])->count();
        return $this->unit - $taken;
    }
}
