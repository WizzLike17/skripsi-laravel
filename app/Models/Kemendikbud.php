<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kemendikbud extends Model
{
    protected $table = 'kemendikbud';

    protected $primaryKey = 'id_kmdb';
    public $timestamps = true;
    protected $fillable = ['mahasiswa_id', 'validator_id', 'status', 'nama_kegiatan', 'surat', 'tanggal', 'ketua', 'anggota', 'dospem', 'keterlibatan_dospem', 'prestasi', 'sertifikat', 'lingkup_kegiatan', 'sumber_biaya', 'biaya', 'lokasi_kegiatan'];

    protected $dates = ['tanggal'];

    // Relasi contoh (jika perlu)
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id', 'user_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id', 'user_id');
    }

    public function sertifikatRel()
    {
        return $this->hasOne(Sertifikat::class, 'id_kmdb', 'id_kmdb');
    }
}
