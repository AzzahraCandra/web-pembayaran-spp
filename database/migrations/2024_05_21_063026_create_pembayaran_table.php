<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('petugas');
            $table->string('nisn');
            $table->date('tgl_byr');
            $table->string('bulan_awal');
            $table->string('bulan_akhir');
            $table->year('tahun_dibayar');
            $table->integer('jumlah_bayar');
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
