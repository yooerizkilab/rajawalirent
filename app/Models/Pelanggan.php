<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $guarded = [];

    protected $append = ['poinused'];

    public function mutasi()
    {
        return $this->hasMany(MutasiPoin::class);
    }

    public function getPoinusedAttribute()
    {
        return $this->mutasi->sum(function ($item) {
            if ($item->type == 0) {
                return $item->poin;
            }
            return 0;
        });
    }
}
