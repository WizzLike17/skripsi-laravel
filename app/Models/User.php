<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
protected $primaryKey = 'user_id'; // <-- Penting karena bukan 'id'
public $incrementing = true;

    protected $fillable = [
        'nama',
        'nim',
        'password',
        'photo',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function aktifitas()
    {
        return $this->hasMany(Aktifitas::class, 'mahasiswa_id');
    }

    public function sertifikats()
    {
        return $this->hasMany(Sertifikat::class, 'mahasiswa_id');
    }

    public function kompetisiMandiri()
    {
        return $this->hasMany(KompetisiMandiri::class, 'mahasiswa_id');
    }

    public function kemendikbud()
    {
        return $this->hasMany(Kemendikbud::class, 'mahasiswa_id');
    }

    public function mbkm()
    {
        return $this->hasMany(Mbkm::class, 'mahasiswa_id');
    }

    public function rekognisi()
    {
        return $this->hasMany(Rekognisi::class, 'mahasiswa_id');
    }
    public function validator()
    {
        return $this->hasMany(Sertifikat::class, 'validator_id');
    }

    public function setPhotoAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['photo'] = $value;
        } elseif ($value instanceof \Illuminate\Http\UploadedFile) {
            $this->attributes['photo'] = $value->store('photos', 'public');
        }
    }

    public function getNamaAttribute($value)
    {
        return ucwords(strtolower($value));
    }
    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = ucwords(strtolower($value));
    }
    public function getNimAttribute($value)
    {
        return strtoupper($value);
    }


public function getPhotoAttribute($value)
{
    if ($value && file_exists(public_path('storage/' . $value))) {
        return asset('storage/' . $value);
    }

    return asset('aa/assets/img/default.jpg'); // default avatar
}
}
