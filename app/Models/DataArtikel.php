<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataArtikel extends Model
{
    use HasFactory;

    protected $table = 'data_artikels';
    
    protected $fillable =  [
        'tanggal',
        'judul',
        'isi',
        'author',
        'foto',
    ];
}
