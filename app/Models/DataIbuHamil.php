<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\VerifyEmail;

class DataIbuHamil extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'data_ibu_hamils';
    
    protected $fillable =  [
        'id',
        'nama_ibu',
        'umur_ibu',
        'alamat',
        'email',
        'nik',
        'no_telepon',
        'kehamilan_ke',
        'nama_suami',
        'umur_suami',
        'password',
        'profile_photo',
        'no_jkn_faskes_tk_1',
        'no_jkn_rujukan',
        'gol_darah',
        'pekerjaan',
        'tanggal_hpl',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
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


    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new VerifyEmail);
    // }
}
