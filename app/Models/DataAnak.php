<?php

namespace App\Models;

use App\Models\DataIbuHamil;
use App\Models\DataImunisasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataAnak extends Model
{
    use HasFactory;

    protected $table = 'data_anaks';
    
    protected $fillable =  [
        'tanggal',
        'nama_ibu',
        'id_ibu',
        'nama_anak',
        'tanggal_lahir',
        'umur',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
    ];

    public function imunisasi()
    {
        return $this->hasMany(DataImunisasi::class, 'nama_anak');
    }

    public function ibuHamil()
    {
        return $this->belongsTo(DataIbuHamil::class, 'nama_ibu');
    }
}
