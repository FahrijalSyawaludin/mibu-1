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
        Schema::create('data_layanan_kbs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_praktik');
            $table->string('nama_ibu');
            $table->integer('tekanan_darah');
            $table->integer('berat_badan');
            $table->string('jenis_kb');
            $table->date('tanggal_kembali');
            $table->bigInteger('id_ibu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_layanan_kbs');
    }
};
