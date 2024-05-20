<?php

namespace App\Models;

use App\Models\DataKesehatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataIbuHamil extends Model
{
    use HasFactory;

    protected $table = 'data_ibu_hamils';
    
    protected $fillable =  [
        'nama_ibu',
        'umur_ibu',
        'alamat',
        'email',
        'password',
        'nik',
        'no_telepon',
        'kehamilan_ke',
        'nama_suami',
        'umur_suami',
    ];

    public function kesehatan()
    {
        return $this->hasMany(DataKesehatan::class, 'nama_ibu');
    }

    public function nifas()
    {
        return $this->hasMany(DataKesehatan::class, 'nama_ibu');
    }

    public function anak()
    {
        return $this->hasMany(DataKesehatan::class, 'nama_ibu');
    }
}
