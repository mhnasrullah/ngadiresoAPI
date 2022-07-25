<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $fillable = [
        'slug',
        'nama',
        'deskripsi',
        'tiket',
        'alamat',
        'waktu',
        'map',
        'video'
    ];
    use HasFactory;
}
