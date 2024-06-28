<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiPoin extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'mutasi_poin';

    protected $appends = ['type_label'];

    public function getTypeLabelAttribute()
    {
        if ($this->type == 1) {
            return '<span class="badge badge-pill badge-success">+</span>';
        }
        return '<span class="badge badge-pill badge-danger">-</span>';
    }
}
