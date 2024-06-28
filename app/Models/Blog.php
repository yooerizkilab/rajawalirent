<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $fillable = [
        'title',
        'content',
        'author',
        'published_at',
        'views',
        'category',
        'slug',
        'tag',
        'thumbnail', // Tambahkan ini jika belum ada
        'image'
    ];

    protected $dates = [
        'published_at',
    ];
}
