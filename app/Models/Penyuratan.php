<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyuratan extends Model
{
    protected $fillable = [
        'nama',
        'link'
    ];
    use HasFactory;
}
