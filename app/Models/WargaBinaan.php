<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WargaBinaan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi Laravel (opsional, tapi bagus)
    protected $table = 'warga_binaan';

    // Tentukan kolom yang boleh diisi
    protected $fillable = [
        'nama_lengkap',
        'nomor_registrasi',
        'blok_kamar',
        'status',
    ];
    // Buka app/Models/WargaBinaan.php
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
