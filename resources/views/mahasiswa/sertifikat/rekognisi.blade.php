<h5 class="mt-4 mb-3 border-bottom pb-2">Edit Rekognisi</h5>

<div class="col-md-8">
    <form action="{{ route('rekognisi.update', $rekognisi->id_rekognisi) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan', $rekognisi->nama_kegiatan) }}" required>
        </div>

        <div class="mb-3">
            <label for="ketua" class="form-label">Ketua</label>
            <input type="text" name="ketua" class="form-control" value="{{ old('ketua', $rekognisi->ketua) }}">
        </div>

        <div class="mb-3">
            <label for="anggota" class="form-label">Anggota</label>
            <input type="text" name="anggota" class="form-control" value="{{ old('anggota', $rekognisi->anggota) }}">
        </div>

        <div class="mb-3">
            <label for="dospem" class="form-label">Dosen Pembimbing</label>
            <input type="text" name="dospem" class="form-control" value="{{ old('dospem', $rekognisi->dospem) }}">
        </div>

        <div class="mb-3">
            <label for="deskripsi_karya" class="form-label">Deskripsi Karya</label>
            <textarea name="deskripsi_karya" class="form-control" rows="3">{{ old('deskripsi_karya', $rekognisi->deskripsi_karya) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="nama_lembaga_mitra" class="form-label">Nama Lembaga Mitra</label>
            <input type="text" name="nama_lembaga_mitra" class="form-control" value="{{ old('nama_lembaga_mitra', $rekognisi->nama_lembaga_mitra) }}">
        </div>

        <div class="mb-3">
            <label for="no_surat_rekognisi" class="form-label">No Surat Rekognisi</label>
            <input type="text" name="no_surat_rekognisi" class="form-control" value="{{ old('no_surat_rekognisi', $rekognisi->no_surat_rekognisi) }}">
        </div>

        <div class="mb-3">
            <label for="jenis_karya" class="form-label">Jenis Karya</label>
            <input type="text" name="jenis_karya" class="form-control" value="{{ old('jenis_karya', $rekognisi->jenis_karya) }}">
        </div>

        <div class="mb-3">
            <label for="link_acara" class="form-label">Link Acara</label>
            <input type="url" name="link_acara" class="form-control" value="{{ old('link_acara', $rekognisi->link_acara) }}">
        </div>

        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $rekognisi->tahun) }}">
        </div>

        <div class="mb-3">
            <label for="surat_tugas" class="form-label">Surat Tugas (PDF/JPG/PNG, maks 2MB)</label>
            <input type="file" name="surat_tugas" class="form-control">

            @if (!empty($rekognisi->surat_tugas))
                @php
                    $suratExt = pathinfo($rekognisi->surat_tugas, PATHINFO_EXTENSION);
                    $suratUrl = asset('storage/' . $rekognisi->surat_tugas);

                @endphp
                <small class="form-text text-muted">File saat ini: 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#suratTugasModal">Lihat Surat</a>
                </small>
            @endif
        </div>

        <div class="mb-3">
            <label for="bukti_penyerahan" class="form-label">Bukti Penyerahan (PDF/JPG/PNG, maks 2MB)</label>
            <input type="file" name="bukti_penyerahan" class="form-control">

            @if (!empty($rekognisi->bukti_penyerahan))
                @php
                    $buktiExt = pathinfo($rekognisi->bukti_penyerahan, PATHINFO_EXTENSION);
                    $buktiUrl = asset('storage/' . $rekognisi->bukti_penyerahan);

                @endphp
                <small class="form-text text-muted">File saat ini: 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#buktiPenyerahanModal">Lihat Bukti</a>
                </small>
            @endif
        </div>

        <div class="text-end">
            <a href="{{ route('rekognisi.index') }}" class="btn btn-light me-2">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

{{-- Modals --}}
@if (!empty($rekognisi->surat_tugas))
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

@if (!empty($rekognisi->bukti_penyerahan))
<div class="modal fade" id="buktiPenyerahanModal" tabindex="-1" aria-labelledby="buktiPenyerahanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buktiPenyerahanModalLabel">Pratinjau Bukti Penyerahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                @if (in_array(strtolower($buktiExt), ['jpg', 'jpeg', 'png']))
                    <img src="{{ $buktiUrl }}" alt="Bukti Penyerahan" class="img-fluid">
                @elseif (strtolower($buktiExt) === 'pdf')
                    <iframe src="{{ $buktiUrl }}" width="100%" height="600px" style="border:none;"></iframe>
                @else
                    <p>File tidak dapat ditampilkan. <a href="{{ $buktiUrl }}" target="_blank">Unduh file</a>.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
