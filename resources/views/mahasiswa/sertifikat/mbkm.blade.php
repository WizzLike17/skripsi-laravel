<div class="col-md-8">
    <form action="{{ route('mbkm.update', $mbkm->id_mbkm) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- Judul Form --}}

        {{-- Nama Kegiatan --}}
        <div class="mb-3">
            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
            <input type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-control"
                value="{{ old('nama_kegiatan', $mbkm->nama_kegiatan) }}" required>
        </div>

        {{-- Ketua Tim --}}
        <div class="mb-3">
            <label for="ketua" class="form-label">Ketua Tim</label>
            <input type="text" id="ketua" name="ketua" class="form-control"
                value="{{ old('ketua', $mbkm->ketua) }}" required>
        </div>

        {{-- Anggota Tim --}}
        <div class="mb-3">
            <label for="anggota" class="form-label">Anggota Tim</label>
            <input type="text" id="anggota" name="anggota" class="form-control"
                value="{{ old('anggota', $mbkm->anggota) }}" required>
        </div>

        {{-- Dosen Pembimbing --}}
        <div class="mb-3">
            <label for="dospem" class="form-label">Dosen Pembimbing</label>
            <input type="text" id="dospem" name="dospem" class="form-control"
                value="{{ old('dospem', $mbkm->dospem) }}" required>
        </div>

        {{-- Keterlibatan Dospem --}}
        <div class="mb-3">
            <label for="keterlibatan_dospem" class="form-label">Keterlibatan Dosen Pembimbing</label>
            <input type="text" id="keterlibatan_dospem" name="keterlibatan_dospem" class="form-control"
                value="{{ old('keterlibatan_dospem', $mbkm->keterlibatan_dospem) }}" required>
        </div>

        {{-- Sumber Biaya --}}
        <div class="mb-3">
            <label for="sumber_biaya" class="form-label">Sumber Biaya</label>
            <input type="text" id="sumber_biaya" name="sumber_biaya" class="form-control"
                value="{{ old('sumber_biaya', $mbkm->sumber_biaya) }}" required>
        </div>

        {{-- Sertifikat --}}
        <div class="mb-3">
            <label for="sertifikat" class="form-label">Sertifikat (PDF/JPG/PNG, maks 2MB)</label>
            <input type="file" id="sertifikat" name="sertifikat" class="form-control"
                accept=".pdf,.jpg,.jpeg,.png">
            @if ($mbkm->sertifikat)
                <small class="form-text text-muted">
                    File saat ini:
                    <a href="#" data-bs-toggle="modal" data-bs-target="#sertifikatModal">Lihat Sertifikat</a>
                </small>
            @endif
        </div>

        {{-- Nama Mitra --}}
        <div class="mb-3">
            <label for="nama_mitra" class="form-label">Nama Mitra</label>
            <input type="text" id="nama_mitra" name="nama_mitra" class="form-control"
                value="{{ old('nama_mitra', $mbkm->nama_mitra) }}" required>
        </div>

        {{-- Lokasi Mitra --}}
        <div class="mb-3">
            <label for="lokasi_mitra" class="form-label">Lokasi Mitra</label>
            <input type="text" id="lokasi_mitra" name="lokasi_mitra" class="form-control"
                value="{{ old('lokasi_mitra', $mbkm->lokasi_mitra) }}" required>
        </div>

        {{-- Surat Kerja Sama --}}
        <div class="mb-3">
            <label for="surat_kerja_sama" class="form-label">Surat Kerja Sama (PDF/JPG/PNG, maks 2MB)</label>
            <input type="file" id="surat_kerja_sama" name="surat_kerja_sama" class="form-control"
                accept=".pdf,.jpg,.jpeg,.png">
            @if ($mbkm->surat_kerja_sama)
                <small class="form-text text-muted">
                    File saat ini:
                    <a href="#" data-bs-toggle="modal" data-bs-target="#suratModal">Lihat Surat</a>
                </small>
            @endif
        </div>

        {{-- Tanggal Pelaksanaan --}}
        <div class="mb-3">
            <label for="tanggal_pelaksanaan" class="form-label">Tanggal Pelaksanaan</label>
            <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" class="form-control"
                value="{{ old('tanggal_pelaksanaan', $mbkm->tanggal_pelaksanaan) }}" required>
        </div>

        {{-- Tanggal Selesai --}}
        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control"
                value="{{ old('tanggal_selesai', $mbkm->tanggal_selesai) }}" required>
        </div>

        {{-- Modal Preview Sertifikat --}}
        @if ($mbkm->sertifikat)
            @php
                $sertifikatExt = pathinfo($mbkm->sertifikat, PATHINFO_EXTENSION);
                $sertifikatUrl = asset('storage/uploads/sertifikat/' . $mbkm->sertifikat);
            @endphp

            <div class="modal fade" id="sertifikatModal" tabindex="-1" aria-labelledby="sertifikatModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pratinjau Sertifikat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body text-center">
                            @if (in_array(strtolower($sertifikatExt), ['jpg', 'jpeg', 'png']))
                                <img src="{{ $sertifikatUrl }}" alt="Sertifikat" class="img-fluid">
                            @elseif (strtolower($sertifikatExt) === 'pdf')
                                <iframe src="{{ $sertifikatUrl }}" width="100%" height="600px" style="border: none;"></iframe>
                            @else
                                <p>File tidak dapat ditampilkan. <a href="{{ $sertifikatUrl }}" target="_blank">Unduh file</a>.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Modal Preview Surat --}}
        @if ($mbkm->surat_kerja_sama)
            @php
                $suratExt = pathinfo($mbkm->surat_kerja_sama, PATHINFO_EXTENSION);
                $suratUrl = asset('storage/uploads/surat_kerja_sama/' . $mbkm->surat_kerja_sama);
            @endphp

            <div class="modal fade" id="suratModal" tabindex="-1" aria-labelledby="suratModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pratinjau Surat Kerja Sama</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body text-center">
                            @if (in_array(strtolower($suratExt), ['jpg', 'jpeg', 'png']))
                                <img src="{{ $suratUrl }}" alt="Surat Kerja Sama" class="img-fluid">
                            @elseif (strtolower($suratExt) === 'pdf')
                                <iframe src="{{ $suratUrl }}" width="100%" height="600px" style="border: none;"></iframe>
                            @else
                                <p>File tidak dapat ditampilkan. <a href="{{ $suratUrl }}" target="_blank">Unduh file</a>.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Tombol Aksi --}}
        <div class="text-end">
            <a href="{{ route('mbkm.index') }}" class="btn btn-light">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
