<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sertifikat;

class Mbkm extends Model
{
    use HasFactory;

    protected $table = 'mbkm';
    protected $primaryKey = 'id_mbkm';
    public $timestamps = true;

    protected $fillable = ['mahasiswa_id', 'validator_id', 'status', 'nama_kegiatan', 'ketua', 'anggota', 'dospem', 'keterlibatan_dospem', 'sumber_biaya', 'sertifikat', 'nama_mitra', 'lokasi_mitra', 'surat_kerja_sama', 'tanggal_pelaksanaan', 'tanggal_selesai'];

    // Relasi ke User (mahasiswa)
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id', 'user_id');
    }

    // Relasi ke User (validator)
    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id', 'user_id');
    }

    public function sertifikatRel()
    {
        return $this->hasOne(Sertifikat::class, 'id_mbkm', 'id_mbkm');
    }
}
