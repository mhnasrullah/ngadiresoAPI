<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqWis extends Model
{
    protected $fillable = [
        'wisata_id',
        'quest',
        'ans'
    ];
    use HasFactory;
}
