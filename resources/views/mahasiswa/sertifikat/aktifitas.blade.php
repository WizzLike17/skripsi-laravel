<div class="col-md-8">
    <form action="{{ route('aktifitas.update', $aktifitas->id_aktifitas) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan', $aktifitas->nama_kegiatan) }}" required>
        </div>

        <div class="mb-3">
            <label for="peserta" class="form-label">Peserta</label>
            <input type="text" name="peserta" class="form-control" value="{{ old('peserta', $aktifitas->peserta) }}" required>
        </div>

        <div class="mb-3">
            <label for="dospem" class="form-label">Dosen Pembimbing</label>
            <input type="text" name="dospem" class="form-control" value="{{ old('dospem', $aktifitas->dospem) }}" required>
        </div>

        <div class="mb-3">
            <label for="keterlibatan_dospem" class="form-label">Keterlibatan Dosen Pembimbing</label>
            <input type="text" name="keterlibatan_dospem" class="form-control" value="{{ old('keterlibatan_dospem', $aktifitas->keterlibatan_dospem) }}" required>
        </div>

        {{-- Surat Tugas --}}
        <div class="mb-3">
            <label for="surat_tugas" class="form-label">Surat Tugas</label>
            <input type="file" name="surat_tugas" class="form-control">
            @if ($aktifitas->surat_tugas)
                @php
                    $suratExt = pathinfo($aktifitas->surat_tugas, PATHINFO_EXTENSION);
                    $suratUrl = asset('storage/' . $aktifitas->surat_tugas);
                @endphp
                <small class="form-text text-muted">
                    File saat ini: <a href="#" data-bs-toggle="modal" data-bs-target="#suratTugasModal">Lihat Surat</a>
                </small>

                <div class="modal fade" id="suratTugasModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pratinjau Surat Tugas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body text-center">
                                @if (in_array(strtolower($suratExt), ['jpg', 'jpeg', 'png']))
                                    <img src="{{ $suratUrl }}" class="img-fluid" alt="Surat Tugas">
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
        </div>

        {{-- Sertifikat --}}
        <div class="mb-3">
            <label for="sertifikat" class="form-label">Sertifikat</label>
            <input type="file" name="sertifikat" class="form-control">
            @if ($aktifitas->sertifikat)
                @php
                    $sertifikatExt = pathinfo($aktifitas->sertifikat, PATHINFO_EXTENSION);
                    $sertifikatUrl = asset('storage/' . $aktifitas->sertifikat);
                @endphp
                <small class="form-text text-muted">
                    File saat ini: <a href="#" data-bs-toggle="modal" data-bs-target="#sertifikatModal">Lihat Sertifikat</a>
                </small>

                <div class="modal fade" id="sertifikatModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pratinjau Sertifikat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body text-center">
                                @if (in_array(strtolower($sertifikatExt), ['jpg', 'jpeg', 'png']))
                                    <img src="{{ $sertifikatUrl }}" class="img-fluid" alt="Sertifikat">
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
        </div>

        {{-- Dokumentasi --}}
        <div class="mb-3">
            <label for="dokumentasi" class="form-label">Dokumentasi</label>
            <input type="file" name="dokumentasi" class="form-control">
            @if ($aktifitas->dokumentasi)
                @php
                    $dokumentasiExt = pathinfo($aktifitas->dokumentasi, PATHINFO_EXTENSION);
                    $dokumentasiUrl = asset('storage/' . $aktifitas->dokumentasi);
                @endphp
                <small class="form-text text-muted">
                    File saat ini: <a href="#" data-bs-toggle="modal" data-bs-target="#dokumentasiModal">Lihat Dokumentasi</a>
                </small>

                <div class="modal fade" id="dokumentasiModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pratinjau Dokumentasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body text-center">
                                @if (in_array(strtolower($dokumentasiExt), ['jpg', 'jpeg', 'png']))
                                    <img src="{{ $dokumentasiUrl }}" class="img-fluid" alt="Dokumentasi">
                                @elseif (strtolower($dokumentasiExt) === 'pdf')
                                    <iframe src="{{ $dokumentasiUrl }}" width="100%" height="600px" style="border:none;"></iframe>
                                @else
                                    <p>File tidak dapat ditampilkan. <a href="{{ $dokumentasiUrl }}" target="_blank">Unduh file</a>.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $aktifitas->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="link_penyelenggara" class="form-label">Link Penyelenggara</label>
            <input type="url" name="link_penyelenggara" class="form-control" value="{{ old('link_penyelenggara', $aktifitas->link_penyelenggara) }}">
        </div>

        <div class="text-end">
            <a href="{{ route('aktifitas.index') }}" class="btn btn-light me-2">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
