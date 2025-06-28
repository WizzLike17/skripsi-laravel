<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KompetisiMandiri extends Model
{
    protected $table = 'kompetisi_mandiri';
    protected $primaryKey = 'id_kompetisi';

    protected $fillable = [
        'mahasiswa_id', 'status', 'nama_kegiatan', 'link_penyelenggara', 'dospem', 'capaian_prestasi',
        'sertifikat', 'foto_penyerahan', 'surat_tugas', 'jenis_kepesertaan', 'tanggal_pelaksanaan',
        'tanggal_selesai', 'jumlah_anggota', 'NIDN_NIDK'
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
        return $this->hasOne(Sertifikat::class, 'id_kompetisi', 'id_kompetisi');
    }
}
