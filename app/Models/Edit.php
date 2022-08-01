<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edit extends Model
{
    protected $fillable=[
        'jumbotron',
        'tentangDesa',
        'imgTentangDesa',
        'imgKades',
        'sambutanKades',
        'namaKades',
        'jmlPria',
        'jmlWanita',
        'jmlPenduduk',
        'jmbtSejarah',
        'jmbtKabar',
        'jmbtFaq',
        'jmbtWisata',
        'jmbtSurat',
    ];
    
    use HasFactory;
}
