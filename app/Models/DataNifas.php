<?php

namespace App\Models;

use App\Models\DataIbuHamil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataNifas extends Model
{
    use HasFactory;

    protected $table = 'data_nifas';
    
    protected $fillable =  [
        'tanggal',
        'nama_ibu',
        'id_ibu',
        'kunjungan_nifas',
        'hasil_periksa_payudara',
        'hasil_periksa_pendarahan',
        'hasil_periksa_jalan_lahir',
        'vitamin_a',
        'masalah',
        'tindakan',
    ];

    public function ibuHamil()
    {
        return $this->belongsTo(DataIbuHamil::class, 'nama_ibu');
    }
}
