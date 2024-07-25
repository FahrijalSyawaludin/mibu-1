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
        Schema::create('data_nifas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_ibu');
            $table->string('kunjungan_nifas');
            $table->string('hasil_periksa_payudara');
            $table->string('hasil_periksa_pendarahan');
            $table->string('hasil_periksa_jalan_lahir');
            $table->string('vitamin_a');
            $table->string('masalah');
            $table->string('tindakan');
            $table->bigInteger('id_ibu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_nifas');
    }
};
