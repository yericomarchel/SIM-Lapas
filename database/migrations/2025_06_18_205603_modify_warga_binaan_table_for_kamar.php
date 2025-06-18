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
        Schema::table('warga_binaan', function (Blueprint $table) {
        // 1. Tambah kolom baru 'kamar_id' sebagai foreign key
        // Kolom ini boleh null, mungkin ada warga binaan yang belum ditempatkan
            $table->foreignId('kamar_id')->nullable()->after('id')->constrained('kamar')->onDelete('set null');

        // 2. Hapus kolom lama 'blok_kamar'
            $table->dropColumn('blok_kamar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warga_binaan', function (Blueprint $table) {
            $table->dropForeign(['kamar_id']);
            $table->dropColumn('kamar_id');
            $table->string('blok_kamar')->after('nomor_registrasi');
        });
    }
};
