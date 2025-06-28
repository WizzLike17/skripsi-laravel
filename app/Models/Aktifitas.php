<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aktifitas extends Model
{
    protected $table = 'aktifitas';
    protected $primaryKey = 'id_aktifitas';

    protected $fillable = [
        'mahasiswa_id', 'status', 'nama_kegiatan', 'peserta', 'dospem', 'keterlibatan_dospem',
        'surat_tugas', 'sertifikat', 'dokumentasi', 'deskripsi', 'link_penyelenggara'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id');
    }

        public function sertifikatRel()
    {
        return $this->hasOne(Sertifikat::class, 'id_aktifitas', 'id_aktifitas');
    }
}
