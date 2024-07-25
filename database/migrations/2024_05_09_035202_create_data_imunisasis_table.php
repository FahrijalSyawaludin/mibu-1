<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_imunisasis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_anak');
            $table->string('imunisasi_dpt_hb_hib_1_polio_2');
            $table->string('imunisasi_dpt_hb_hib_2_polio_3');
            $table->string('imunisasi_dpt_hb_hib_3_polio_4');
            $table->string('imunisasi_campak');
            $table->string('imunisasi_dpt_hb_hib_1_dosis');
            $table->string('imunisasi_campak_rubella_1_dosis');
            $table->string('imunisasi_campak_rubella_dan_dt');
            $table->string('imunisasi_tetanus_diphteria_td');
            $table->string('nama_pemeriksa');
            $table->bigInteger('id_anak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_imunisasis');
    }
};
