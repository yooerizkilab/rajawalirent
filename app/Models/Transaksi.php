<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $guarded = [];

    protected $appends = ['status_label'];

    protected $dates = ['tgl_pinjam', 'tgl_kembali'];

    public function getStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return '<span class="badge badge-secondary">Booking</span>';
        } elseif ($this->status == 1) {
            return '<span class="badge badge-warning">Dipinjam</span>';
        } elseif ($this->status == 2) {
            return '<span class="badge badge-success">Dikembalikan</span>';
        }
        return '<span class="badge badge-danger">Dibatalkan</span>';
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaksi) {
            // Create Invoice
            $latestTransaction = Transaksi::orderBy('created_at', 'DESC')->first();
            $invoiceNumber = $latestTransaction ? 'RP-' . ($latestTransaction->id + 1) : 'RP-1';

            $transaksi->faktur = $invoiceNumber;
        });
    }
}
