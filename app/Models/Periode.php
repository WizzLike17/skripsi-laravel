<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Periode extends Model
{
    protected $table = 'periodes';
    protected $primaryKey = 'periode_id';

    protected $fillable = [
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'jenis_periode',
    ];

    // Menambahkan properti casts untuk memastikan tanggal diubah menjadi objek Carbon
    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    // Relasi ke sertifikat
    public function sertifikats()
    {
        return $this->hasMany(Sertifikat::class, 'periode_id');
    }

    // Accessor untuk status boolean
    public function getStatusLabelAttribute()
    {
        return $this->status ? 'Aktif' : 'Tidak Aktif';
    }

    public function getNamaPeriodeAttribute()
    {
        $tahunMulai = $this->tanggal_mulai->format('Y');
        $tahunSelesai = $this->tanggal_selesai->format('Y');
        $jenisPeriode = ucfirst($this->jenis_periode); // Ganjil atau Genap

        return "{$tahunMulai}/{$tahunSelesai} - {$jenisPeriode}";
    }

    
}
