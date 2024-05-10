<?php

namespace App\Models;

use App\Models\DataAnak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataImunisasi extends Model
{
    use HasFactory;

    protected $table = 'data_imunisasis';
    
    protected $fillable =  [
        'tanggal',
        'id_anak',
        'imunisasi_dpt_hb_hib_1_polio_2',
        'imunisasi_dpt_hb_hib_2_polio_3',
        'imunisasi_dpt_hb_hib_3_polio_4',
        'imunisasi_campak',
        'imunisasi_dpt_hb_hib_1_dosis',
        'imunisasi_campak_rubella_1_dosis',
        'imunisasi_campak_rubella_dan_dt',
        'imunisasi_tetanus_diphteria_td',
        'nama_pemeriksa',
    ];

    public function anak()
    {
        return $this->belongsTo(DataAnak::class, 'id_anak');
    }
}
