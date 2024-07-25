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
        Schema::create('data_kesehatans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_ibu');
            $table->string('keluhan');
            $table->integer('tekanan_darah');
            $table->integer('berat_badan');
            $table->string('umur_kehamilan');
            $table->integer('tinggi_fundus');
            $table->string('letak_janin');
            $table->integer('denyut_jantung_janin');
            $table->string('hasil_lab');
            $table->string('tindakan');
            $table->string('kaki_bengkak');
            $table->string('nasihat');
            $table->bigInteger('id_ibu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kesehatans');
    }
};
