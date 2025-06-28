<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id_aktifitas
 * @property int $mahasiswa_id
 * @property int|null $validator_id
 * @property string $status
 * @property string $nama_kegiatan
 * @property string $peserta
 * @property string $dospem
 * @property string $keterlibatan_dospem
 * @property string $surat_tugas
 * @property string $sertifikat
 * @property string $dokumentasi
 * @property string $deskripsi
 * @property string $link_penyelenggara
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $mahasiswa
 * @property-read \App\Models\Sertifikat|null $sertifikatRel
 * @property-read \App\Models\User|null $validator
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas query()
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereDokumentasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereDospem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereIdAktifitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereKeterlibatanDospem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereLinkPenyelenggara($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereMahasiswaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereNamaKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas wherePeserta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereSertifikat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereSuratTugas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Aktifitas whereValidatorId($value)
 */
	class Aktifitas extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_kmdb
 * @property int $mahasiswa_id
 * @property int|null $validator_id
 * @property string $status
 * @property string $nama_kegiatan
 * @property string $surat
 * @property string $tanggal
 * @property string $ketua
 * @property string $anggota
 * @property string $dospem
 * @property string $keterlibatan_dospem
 * @property string $prestasi
 * @property string $sertifikat
 * @property string $lingkup_kegiatan
 * @property string $sumber_biaya
 * @property int $biaya
 * @property string $lokasi_kegiatan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $mahasiswa
 * @property-read \App\Models\Sertifikat|null $sertifikatRel
 * @property-read \App\Models\User|null $validator
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereAnggota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereBiaya($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereDospem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereIdKmdb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereKeterlibatanDospem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereKetua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereLingkupKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereLokasiKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereMahasiswaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereNamaKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud wherePrestasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereSertifikat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereSumberBiaya($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereSurat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kemendikbud whereValidatorId($value)
 */
	class Kemendikbud extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_kompetisi
 * @property int $mahasiswa_id
 * @property int|null $validator_id
 * @property string $status
 * @property string $nama_kegiatan
 * @property string $link_penyelenggara
 * @property string $dospem
 * @property string $capaian_prestasi
 * @property string $sertifikat
 * @property string $foto_penyerahan
 * @property string $surat_tugas
 * @property string $jenis_kepesertaan
 * @property string $tanggal_pelaksanaan
 * @property string $tanggal_selesai
 * @property int $jumlah_anggota
 * @property string $nidn_nidk
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $mahasiswa
 * @property-read \App\Models\Sertifikat|null $sertifikatRel
 * @property-read \App\Models\User|null $validator
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri query()
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereCapaianPrestasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereDospem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereFotoPenyerahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereIdKompetisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereJenisKepesertaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereJumlahAnggota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereLinkPenyelenggara($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereMahasiswaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereNamaKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereNidnNidk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereSertifikat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereSuratTugas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereTanggalPelaksanaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereTanggalSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KompetisiMandiri whereValidatorId($value)
 */
	class KompetisiMandiri extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_mbkm
 * @property int $mahasiswa_id
 * @property int|null $validator_id
 * @property string $nama_kegiatan
 * @property string $ketua
 * @property string $anggota
 * @property string $dospem
 * @property string $keterlibatan_dospem
 * @property string $sumber_biaya
 * @property string $sertifikat
 * @property string $nama_mitra
 * @property string $lokasi_mitra
 * @property string $surat_kerja_sama
 * @property string $tanggal_pelaksanaan
 * @property string $tanggal_selesai
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $mahasiswa
 * @property-read \App\Models\Sertifikat|null $sertifikatRel
 * @property-read \App\Models\User|null $validator
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereAnggota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereDospem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereIdMbkm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereKeterlibatanDospem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereKetua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereLokasiMitra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereMahasiswaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereNamaKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereNamaMitra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereSertifikat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereSumberBiaya($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereSuratKerjaSama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereTanggalPelaksanaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereTanggalSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mbkm whereValidatorId($value)
 */
	class Mbkm extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $periode_id
 * @property \Illuminate\Support\Carbon $tanggal_mulai
 * @property \Illuminate\Support\Carbon $tanggal_selesai
 * @property int $status
 * @property string $jenis_periode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $nama_periode
 * @property-read mixed $status_label
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sertifikat> $sertifikats
 * @property-read int|null $sertifikats_count
 * @method static \Illuminate\Database\Eloquent\Builder|Periode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Periode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Periode query()
 * @method static \Illuminate\Database\Eloquent\Builder|Periode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode whereJenisPeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode wherePeriodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode whereTanggalMulai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode whereTanggalSelesai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode whereUpdatedAt($value)
 */
	class Periode extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id_rekognisi
 * @property int $mahasiswa_id
 * @property int|null $validator_id
 * @property string $nama_kegiatan
 * @property string $ketua
 * @property string $anggota
 * @property string $surat_tugas
 * @property string $dospem
 * @property string $deskripsi_karya
 * @property string $nama_lembaga_mitra
 * @property string $no_surat_rekognisi
 * @property string $jenis_karya
 * @property string $link_acara
 * @property string $tahun
 * @property string $bukti_penyerahan
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $mahasiswa
 * @property-read \App\Models\Sertifikat|null $sertifikatRel
 * @property-read \App\Models\User|null $validator
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereAnggota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereBuktiPenyerahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereDeskripsiKarya($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereDospem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereIdRekognisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereJenisKarya($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereKetua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereLinkAcara($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereMahasiswaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereNamaKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereNamaLembagaMitra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereNoSuratRekognisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereSuratTugas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereTahun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekognisi whereValidatorId($value)
 */
	class Rekognisi extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $periode_id
 * @property int|null $id_aktifitas
 * @property int|null $id_kompetisi
 * @property int|null $id_kmdb
 * @property int|null $id_mbkm
 * @property int|null $id_rekognisi
 * @property int $mahasiswa_id
 * @property int|null $validator_id
 * @property string|null $revisi_alasan
 * @property float|null $nilai
 * @property string $nama_kegiatan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Aktifitas|null $aktifitas
 * @property-read mixed $status
 * @property-read \App\Models\Kemendikbud|null $kemendikbud
 * @property-read \App\Models\KompetisiMandiri|null $kompetisiMandiri
 * @property-read \App\Models\User $mahasiswa
 * @property-read \App\Models\Mbkm|null $mbkm
 * @property-read \App\Models\Periode $periode
 * @property-read \App\Models\Rekognisi|null $rekognisi
 * @property-read \App\Models\User|null $validator
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereIdAktifitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereIdKmdb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereIdKompetisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereIdMbkm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereIdRekognisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereMahasiswaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereNamaKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereNilai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat wherePeriodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereRevisiAlasan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sertifikat whereValidatorId($value)
 */
	class Sertifikat extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $user_id
 * @property string $nama
 * @property string $nim
 * @property string $password
 * @property string|null $photo
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Aktifitas> $aktifitas
 * @property-read int|null $aktifitas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Kemendikbud> $kemendikbud
 * @property-read int|null $kemendikbud_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\KompetisiMandiri> $kompetisiMandiri
 * @property-read int|null $kompetisi_mandiri_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Mbkm> $mbkm
 * @property-read int|null $mbkm_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rekognisi> $rekognisi
 * @property-read int|null $rekognisi_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sertifikat> $sertifikats
 * @property-read int|null $sertifikats_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sertifikat> $validator
 * @property-read int|null $validator_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserId($value)
 */
	class User extends \Eloquent {}
}

