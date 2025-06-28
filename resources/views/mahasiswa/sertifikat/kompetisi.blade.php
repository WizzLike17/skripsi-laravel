<h5 class="mt-4 mb-3 border-bottom pb-2">Edit Kompetisi Mandiri</h5>

<div class="col-md-8">
    <form action="{{ route('kompetisi-mandiri.update', $kompetisi->id_kompetisi) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan', $kompetisi->nama_kegiatan) }}" required>
        </div>

        <div class="mb-3">
            <label for="link_penyelenggara" class="form-label">Link Penyelenggara</label>
            <input type="url" name="link_penyelenggara" class="form-control" value="{{ old('link_penyelenggara', $kompetisi->link_penyelenggara) }}">
        </div>

        <div class="mb-3">
            <label for="dospem" class="form-label">Dosen Pembimbing</label>
            <input type="text" name="dospem" class="form-control" value="{{ old('dospem', $kompetisi->dospem) }}">
        </div>

        <div class="mb-3">
            <label for="capaian_prestasi" class="form-label">Capaian Prestasi</label>
            <input type="text" name="capaian_prestasi" class="form-control" value="{{ old('capaian_prestasi', $kompetisi->capaian_prestasi) }}">
        </div>

        <div class="mb-3">
            <label for="sertifikat" class="form-label">Sertifikat (PDF/JPG/PNG, maks 2MB)</label>
            <input type="file" name="sertifikat" class="form-control">

            @if (!empty($kompetisi->sertifikat))
                @php
                    $sertifikatExt = pathinfo($kompetisi->sertifikat, PATHINFO_EXTENSION);
                    $sertifikatUrl = asset('storage/' . $kompetisi->sertifikat);
                @endphp
                <small class="form-text text-muted">File saat ini: 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#sertifikatModal">Lihat Sertifikat</a>
                </small>
            @endif
        </div>

        <div class="mb-3">
            <label for="foto_penyerahan" class="form-label">Foto Penyerahan (PDF/JPG/PNG, maks 2MB)</label>
            <input type="file" name="foto_penyerahan" class="form-control">

            @if (!empty($kompetisi->foto_penyerahan))
                @php
                    $fotoExt = pathinfo($kompetisi->foto_penyerahan, PATHINFO_EXTENSION);
                    $fotoUrl = asset('storage/' . $kompetisi->foto_penyerahan);
                @endphp
                <small class="form-text text-muted">File saat ini: 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#fotoPenyerahanModal">Lihat Foto</a>
                </small>
            @endif
        </div>

        <div class="mb-3">
            <label for="surat_tugas" class="form-label">Surat Tugas (PDF/JPG/PNG, maks 2MB)</label>
            <input type="file" name="surat_tugas" class="form-control">

            @if (!empty($kompetisi->surat_tugas))
                @php
                    $suratExt = pathinfo($kompetisi->surat_tugas, PATHINFO_EXTENSION);
                    $suratUrl = asset('storage/' . $kompetisi->surat_tugas);
                @endphp
                <small class="form-text text-muted">File saat ini: 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#suratTugasModal">Lihat Surat</a>
                </small>
            @endif
        </div>

        <div class="mb-3">
            <label for="jenis_kepesertaan" class="form-label">Jenis Kepesertaan</label>
            <input type="text" name="jenis_kepesertaan" class="form-control" value="{{ old('jenis_kepesertaan', $kompetisi->jenis_kepesertaan) }}">
        </div>

        <div class="mb-3">
            <label for="tanggal_pelaksanaan" class="form-label">Tanggal Pelaksanaan</label>
            <input type="date" name="tanggal_pelaksanaan" class="form-control" value="{{ old('tanggal_pelaksanaan', $kompetisi->tanggal_pelaksanaan) }}">
        </div>

        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $kompetisi->tanggal_selesai) }}">
        </div>

        <div class="mb-3">
            <label for="jumlah_anggota" class="form-label">Jumlah Anggota</label>
            <input type="number" name="jumlah_anggota" class="form-control" value="{{ old('jumlah_anggota', $kompetisi->jumlah_anggota) }}">
        </div>

        <div class="mb-3">
            <label for="nidn_nidk" class="form-label">NIDN/NIDK</label>
            <input type="text" name="nidn_nidk" class="form-control" value="{{ old('nidn_nidk', $kompetisi->nidn_nidk) }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" name="status" class="form-control" value="{{ old('status', $kompetisi->status) }}">
        </div>

        <div class="text-end">
            <a href="{{ route('kompetisi-mandiri.index') }}" class="btn btn-light me-2">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

{{-- Modals --}}
@if (!empty($kompetisi->sertifikat))
<div class="modal fade" id="sertifikatModal" tabindex="-1" aria-labelledby="sertifikatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sertifikatModalLabel">Pratinjau Sertifikat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                @if (in_array(strtolower($sertifikatExt), ['jpg', 'jpeg', 'png']))
                    <img src="{{ $sertifikatUrl }}" alt="Sertifikat" class="img-fluid">
                @elseif (strtolower($sertifikatExt) === 'pdf')
                    <iframe src="{{ $sertifikatUrl }}" width="100%" height="600px" style="border:none;"></iframe>
                @else
                    <p>File tidak dapat ditampilkan. <a href="{{ $sertifikatUrl }}" target="_blank">Unduh file</a>.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

@if (!empty($kompetisi->foto_penyerahan))
<div class="modal fade" id="fotoPenyerahanModal" tabindex="-1" aria-labelledby="fotoPenyerahanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fotoPenyerahanModalLabel">Pratinjau Foto Penyerahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                @if (in_array(strtolower($fotoExt), ['jpg', 'jpeg', 'png']))
                    <img src="{{ $fotoUrl }}" alt="Foto Penyerahan" class="img-fluid">
                @elseif (strtolower($fotoExt) === 'pdf')
                    <iframe src="{{ $fotoUrl }}" width="100%" height="600px" style="border:none;"></iframe>
                @else
                    <p>File tidak dapat ditampilkan. <a href="{{ $fotoUrl }}" target="_blank">Unduh file</a>.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

@if (!empty($kompetisi->surat_tugas))
<div class="modal fade" id="suratTugasModal" tabindex="-1" aria-labelledby="suratTugasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suratTugasModalLabel">Pratinjau Surat Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                @if (in_array(strtolower($suratExt), ['jpg', 'jpeg', 'png']))
                    <img src="{{ $suratUrl }}" alt="Surat Tugas" class="img-fluid">
                @elseif (strtolower($suratExt) === 'pdf')
                    <iframe src="{{ $suratUrl }}" width="100%" height="600px" style="border:none;"></iframe>
                @else
                    <p>File tidak dapat ditampilkan. <a href="{{ $suratUrl }}" target="_blank">Unduh file</a>.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
