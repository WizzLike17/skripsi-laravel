<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = 'sertifikat';

    protected $fillable = [
        'periode_id',
        'id_mbkm',
        'id_kmdb',
        'id_aktifitas',
        'id_kompetisi',
        'id_rekognisi',
        'mahasiswa_id',
        'nama_kegiatan',
        'validator_id',
        'revisi_alasan',
        'nilai',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->status === 'tolak') {
                $model->nilai = 0;
            }
        });
    }

    // Relasi ke Periode
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'periode_id');
    }

    public function aktifitas()
    {
        return $this->belongsTo(Aktifitas::class, 'id_aktifitas', 'id_aktifitas');
    }

    public function kompetisiMandiri()
    {
        return $this->belongsTo(KompetisiMandiri::class, 'id_kompetisi', 'id_kompetisi');
    }

    public function kemendikbud()
    {
        return $this->belongsTo(Kemendikbud::class, 'id_kmdb', 'id_kmdb');
    }

    public function mbkm()
    {
        return $this->belongsTo(Mbkm::class, 'id_mbkm', 'id_mbkm');
    }

    public function rekognisi()
    {
        return $this->belongsTo(Rekognisi::class, 'id_rekognisi', 'id_rekognisi');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id', 'user_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id', 'user_id');
    }

    // Accessor untuk mendapatkan status dari relasi terkait
    public function getStatusAttribute()
    {
        if ($this->kompetisiMandiri && $this->kompetisiMandiri->status) {
            return $this->kompetisiMandiri->status;
        }

        if ($this->aktifitas && $this->aktifitas->status) {
            return $this->aktifitas->status;
        }

        if ($this->kemendikbud && $this->kemendikbud->status) {
            return $this->kemendikbud->status;
        }

        if ($this->mbkm && $this->mbkm->status) {
            return $this->mbkm->status;
        }

        if ($this->rekognisi && $this->rekognisi->status) {
            return $this->rekognisi->status;
        }

        // Jika tidak ada status ditemukan
        return null;
    }
}
