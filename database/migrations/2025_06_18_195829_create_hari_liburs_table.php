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
    Schema::create('hari_libur', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal')->unique(); // Tanggal libur, harus unik
        $table->string('keterangan');     // Keterangan libur, cth: "Hari Raya Idul Fitri"
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hari_liburs');
    }
};
