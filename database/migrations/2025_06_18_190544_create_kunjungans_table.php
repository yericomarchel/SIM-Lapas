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
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();

            // Kolom penghubung (Foreign Keys)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('warga_binaan_id')->constrained('warga_binaan')->onDelete('cascade');
            $table->foreignId('approved_by_id')->nullable()->constrained('users')->onDelete('set null');

            // Detail Kunjungan
            $table->date('tanggal_kunjungan');
            $table->string('sesi_kunjungan'); // cth: "Sesi Pagi (09:00 - 11:00)"
            $table->text('nama_pengikut')->nullable();
            $table->string('path_ktp'); // Untuk menyimpan lokasi file KTP yang di-upload
            $table->enum('status', ['Menunggu Persetujuan', 'Disetujui', 'Ditolak', 'Selesai'])->default('Menunggu Persetujuan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};
