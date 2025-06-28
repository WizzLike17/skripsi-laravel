<h5 class="mt-4 mb-3 border-bottom pb-2">Detail Rekognisi</h5>
<div class="row g-3">
    <div class="col-md-3">
        <p><strong>Nama Kegiatan</strong></p>
        <p><strong>Ketua</strong></p>
        <p><strong>Anggota</strong></p>
        <p><strong>Dosen Pembimbing</strong></p>
        <p><strong>Deskripsi Karya</strong></p>
        <p><strong>Nama Lembaga Mitra</strong></p>
        <p><strong>No Surat Rekognisi</strong></p>
        <p><strong>Jenis Karya</strong></p>
        <p><strong>Link Acara</strong></p>
        <p><strong>Tahun</strong></p>
        <p><strong>Surat Tugas</strong></p>
        <p><strong>Bukti Penyerahan</strong></p>
    </div>
    <div class="col-md-7">
        <p>: {{ $data->nama_kegiatan ?? '-' }}</p>
        <p>: {{ $data->ketua ?? '-' }}</p>
        <p>: {{ $data->anggota ?? '-' }}</p>
        <p>: {{ $data->dospem ?? '-' }}</p>
        <p>: {{ $data->deskripsi_karya ?? '-' }}</p>
        <p>: {{ $data->nama_lembaga_mitra ?? '-' }}</p>
        <p>: {{ $data->no_surat_rekognisi ?? '-' }}</p>
        <p>: {{ $data->jenis_karya ?? '-' }}</p>
        <p>:
            @if (!empty($data->link_acara))
                <a href="{{ $data->link_acara }}" target="_blank" class="text-decoration-none">
                    {{ $data->link_acara }}
                </a>
            @else
                -
            @endif
        </p>
        <p>: {{ $data->tahun ?? '-' }}</p>

        {{-- Surat Tugas --}}
        <p>:
            @if (!empty($data->surat_tugas))
                @php
                    $suratExt = pathinfo($data->surat_tugas, PATHINFO_EXTENSION);
                    $suratUrl = asset('storage/uploads/surat_tugas/' . $data->surat_tugas);
                @endphp
                <a href="#" data-bs-toggle="modal" data-bs-target="#suratModal" class="text-decoration-underline">
                    <i class="fas fa-eye"></i> Lihat File
                </a>
            @else
                -
            @endif
        </p>

        {{-- Bukti Penyerahan --}}
        <p>:
            @if (!empty($data->bukti_penyerahan))
                @php
                    $buktiExt = pathinfo($data->bukti_penyerahan, PATHINFO_EXTENSION);
                    $buktiUrl = asset('storage/uploads/bukti_penyerahan/' . $data->bukti_penyerahan);
                @endphp
                <a href="#" data-bs-toggle="modal" data-bs-target="#buktiModal" class="text-decoration-underline">
                    <i class="fas fa-eye"></i> Lihat File
                </a>
            @else
                -
            @endif
        </p>
    </div>
</div>

{{-- Modal Surat Tugas --}}
@if (!empty($data->surat_tugas))
<div class="modal fade" id="suratModal" tabindex="-1" aria-labelledby="suratModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suratModalLabel">Pratinjau Surat Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                @if (in_array(strtolower($suratExt), ['jpg', 'jpeg', 'png']))
                    <img src="{{ $suratUrl }}" alt="Surat Tugas" class="img-fluid">
                @elseif (strtolower($suratExt) === 'pdf')
                    <iframe src="{{ $suratUrl }}" width="100%" height="600px" style="border:none;"></iframe>
                @else
                    <p>File tidak bisa ditampilkan. <a href="{{ $suratUrl }}" target="_blank">Unduh file</a></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

{{-- Modal Bukti Penyerahan --}}
@if (!empty($data->bukti_penyerahan))
<div class="modal fade" id="buktiModal" tabindex="-1" aria-labelledby="buktiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buktiModalLabel">Pratinjau Bukti Penyerahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                @if (in_array(strtolower($buktiExt), ['jpg', 'jpeg', 'png']))
                    <img src="{{ $buktiUrl }}" alt="Bukti Penyerahan" class="img-fluid">
                @elseif (strtolower($buktiExt) === 'pdf')
                    <iframe src="{{ $buktiUrl }}" width="100%" height="600px" style="border:none;"></iframe>
                @else
                    <p>File tidak bisa ditampilkan. <a href="{{ $buktiUrl }}" target="_blank">Unduh file</a></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
