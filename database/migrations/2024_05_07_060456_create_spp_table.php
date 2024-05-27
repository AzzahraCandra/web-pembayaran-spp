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
        Schema::create('spp', function (Blueprint $table) {
            $table->id('id_spp');
            $table->timestamps();
            // $table->string('id_spp');
            $table->year('tahun');
            $table->integer('nominal');

        });
    }

    /**
     * Reverse the migrations.
     *
     * 
     */
    public function down(): void
    {
        Schema::dropIfExists('spp');
    }
};
