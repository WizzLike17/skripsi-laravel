<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekognisi extends Model
{
    use HasFactory;

    protected $table = 'rekognisi';
    protected $primaryKey = 'id_rekognisi';
    public $timestamps = true;

    protected $fillable = [
        'mahasiswa_id',
        'validator_id',
        'status',
        'nama_kegiatan',
        'ketua',
        'anggota',
        'surat_tugas',
        'dospem',
        'deskripsi_karya',
        'nama_lembaga_mitra',
        'no_surat_rekognisi',
        'jenis_karya',
        'link_acara',
        'tahun',
        'bukti_penyerahan',
    ];

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
        return $this->hasOne(Sertifikat::class, 'id_rekognisi', 'id_rekognisi');
    }
}
