<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * 
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->string('nis');
            $table->string('nama');
            $table->string('id_kelas');
            $table->string('id_spp');
            $table->string('alamat');
            $table->string('no_telp');
            $table->timestamps();

            // $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('cascade');
            // $table->foreign('id_spp')->references('id')->on('spp')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * 
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
