<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;
    protected $table = 'kunjungan'; // Nama tabel
    protected $fillable = [
        'user_id',
        'warga_binaan_id',
        'approved_by_id',
        'tanggal_kunjungan',
        'sesi_kunjungan',
        'nama_pengikut',
        'path_ktp',
        'status',
    ];
    // TAMBAHKAN METHOD INI
    public function wargaBinaan()
    {
        return $this->belongsTo(WargaBinaan::class);
    }

    // Nanti kita juga akan butuh relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }
}
