<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgWisata extends Model
{
    protected $fillable=[
        'foto',
        'wisata_id'
    ];
    use HasFactory;
}
