<div class="col-md-8">
    <form action="{{ route('kemendikbud.update', $kemendikbud->id_kmdb) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control"
                value="{{ old('nama_kegiatan', $kemendikbud->nama_kegiatan) }}" required>
        </div>

        <div class="mb-3">
            <label for="ketua" class="form-label">Ketua Tim</label>
            <input type="text" name="ketua" class="form-control"
                value="{{ old('ketua', $kemendikbud->ketua) }}" required>
        </div>

        <div class="mb-3">
            <label for="anggota" class="form-label">Anggota Tim</label>
            <input type="text" name="anggota" class="form-control"
                value="{{ old('anggota', $kemendikbud->anggota) }}" required>
        </div>

        <div class="mb-3">
            <label for="dospem" class="form-label">Dosen Pembimbing</label>
            <input type="text" name="dospem" class="form-control"
                value="{{ old('dospem', $kemendikbud->dospem) }}" required>
        </div>

        <div class="mb-3">
            <label for="keterlibatan_dospem" class="form-label">Keterlibatan Dosen
                Pembimbing</label>
            <input type="text" name="keterlibatan_dospem" class="form-control"
                value="{{ old('keterlibatan_dospem', $kemendikbud->keterlibatan_dospem) }}"
                required>
        </div>

        <div class="mb-3">
            <label for="prestasi" class="form-label">Prestasi</label>
            <input type="text" name="prestasi" class="form-control"
                value="{{ old('prestasi', $kemendikbud->prestasi) }}" required>
        </div>

        <div class="mb-3">
            <label for="lokasi_kegiatan" class="form-label">Lokasi Kegiatan</label>
            <input type="text" name="lokasi_kegiatan" class="form-control"
                value="{{ old('lokasi_kegiatan', $kemendikbud->lokasi_kegiatan) }}" required>
        </div>

        <div class="mb-3">
            <label for="sumber_biaya" class="form-label">Sumber Biaya</label>
            <input type="text" name="sumber_biaya" class="form-control"
                value="{{ old('sumber_biaya', $kemendikbud->sumber_biaya) }}" required>
        </div>

        <div class="mb-3">
            <label for="biaya" class="form-label">Biaya</label>
            <input type="number" name="biaya" class="form-control"
                value="{{ old('biaya', $kemendikbud->biaya) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Kegiatan</label>
            <input type="date" name="tanggal" class="form-control"
                value="{{ old('tanggal', $kemendikbud->tanggal) }}" required>
        </div>

        <div class="mb-3">
            <label for="lingkup_kegiatan" class="form-label">Lingkup Kegiatan</label>
            <select name="lingkup_kegiatan"
                class="form-select @error('lingkup_kegiatan') is-invalid @enderror" required>
                <option value="">-- Pilih --</option>
                <option value="Lokal"
                    {{ old('lingkup_kegiatan', $kemendikbud->lingkup_kegiatan) == 'Lokal' ? 'selected' : '' }}>
                    Lokal</option>
                <option value="Nasional"
                    {{ old('lingkup_kegiatan', $kemendikbud->lingkup_kegiatan) == 'Nasional' ? 'selected' : '' }}>
                    Nasional</option>
                <option value="Internasional"
                    {{ old('lingkup_kegiatan', $kemendikbud->lingkup_kegiatan) == 'Internasional' ? 'selected' : '' }}>
                    Internasional</option>
            </select>
            @error('lingkup_kegiatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="surat" class="form-label">Surat Pendukung (PDF/JPG/PNG, maks
                2MB)</label>
            <input type="file" name="surat" class="form-control">

            @if ($kemendikbud->surat)
                @php
                    $fileExtension = pathinfo($kemendikbud->surat, PATHINFO_EXTENSION);
                    $fileUrl = asset('storage/uploads/surat/' . $kemendikbud->surat);
                @endphp

                <small class="form-text text-muted">File saat ini:
                    <a href="#" data-bs-toggle="modal"
                        data-bs-target="#previewModal">Lihat
                        Surat</a>
                </small>

                <!-- Modal untuk gambar/PDF -->
                <div class="modal fade" id="previewModal" tabindex="-1"
                    aria-labelledby="previewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="previewModalLabel">Pratinjau Surat
                                </h5>
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png']))
                                    <img src="{{ $fileUrl }}" alt="Surat Pendukung"
                                        class="img-fluid">
                                @elseif (strtolower($fileExtension) == 'pdf')
                                    <iframe src="{{ $fileUrl }}" width="100%"
                                        height="600px" style="border: none;"></iframe>
                                @else
                                    <p>File tidak dapat ditampilkan. <a
                                            href="{{ $fileUrl }}" target="_blank">Unduh
                                            file</a>.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>


        <div class="mb-3">
            <label for="sertifikat" class="form-label">Sertifikat (PDF/JPG/PNG, maks
                2MB)</label>
            <input type="file" name="sertifikat" class="form-control">

            @if ($kemendikbud->sertifikat)
                @php
                    $sertifikatExtension = pathinfo(
                        $kemendikbud->sertifikat,
                        PATHINFO_EXTENSION,
                    );
                    $sertifikatUrl = asset(
                        'storage/uploads/sertifikat/' . $kemendikbud->sertifikat,
                    );
                @endphp

                <small class="form-text text-muted">File saat ini:
                    <a href="#" data-bs-toggle="modal"
                        data-bs-target="#sertifikatModal">Lihat Sertifikat</a>
                </small>

                <!-- Modal Sertifikat -->
                <div class="modal fade" id="sertifikatModal" tabindex="-1"
                    aria-labelledby="sertifikatModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="sertifikatModalLabel">Pratinjau
                                    Sertifikat</h5>
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body text-center">
                                @if (in_array(strtolower($sertifikatExtension), ['jpg', 'jpeg', 'png']))
                                    <img src="{{ $sertifikatUrl }}" alt="Sertifikat"
                                        class="img-fluid">
                                @elseif (strtolower($sertifikatExtension) == 'pdf')
                                    <iframe src="{{ $sertifikatUrl }}" width="100%"
                                        height="600px" style="border: none;"></iframe>
                                @else
                                    <p>File tidak dapat ditampilkan. <a
                                            href="{{ $sertifikatUrl }}" target="_blank">Unduh
                                            file</a>.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="text-end">
            <a href="{{ route('kemendikbud.index') }}" class="btn btn-light me-2">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
