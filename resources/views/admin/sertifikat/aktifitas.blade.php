<h5 class="mt-4 mb-3 border-bottom pb-2">Detail Aktivitas</h5>
<div class="row g-3">
    <div class="col-md-3">
        <p><strong>Nama Kegiatan</strong></p>
        <p><strong>Peserta</strong></p>
        <p><strong>Dosen Pembimbing</strong></p>
        <p><strong>Keterlibatan Dospem</strong></p>
        <p><strong>Surat Tugas</strong></p>
        <p><strong>Sertifikat</strong></p>
        <p><strong>Dokumentasi</strong></p>
        <p><strong>Deskripsi</strong></p>
        <p><strong>Link Penyelenggara</strong></p>
    </div>
    <div class="col-md-7">
        <p>: {{ $data->nama_kegiatan ?? '-' }}</p>
        <p>: {{ $data->peserta ?? '-' }}</p>
        <p>: {{ $data->dospem ?? '-' }}</p>
        <p>: {{ $data->keterlibatan_dospem ?? '-' }}</p>
        <p>:
            @if (!empty($data->surat_tugas))
                @php
                    $suratExt = pathinfo($data->surat_tugas, PATHINFO_EXTENSION);
                    $suratUrl = asset('storage/' . $data->surat_tugas);
                @endphp
                <a href="#" data-bs-toggle="modal" data-bs-target="#suratModal" class="text-decoration-underline">
                    <i class="fas fa-eye"></i> Lihat Surat
                </a>
            @else
                -
            @endif
        </p>
        <p>:
            @if (!empty($data->sertifikat))
                @php
                    $sertifikatExt = pathinfo($data->sertifikat, PATHINFO_EXTENSION);
                    $sertifikatUrl = asset('storage/' . $data->sertifikat);
                @endphp
                <a href="#" data-bs-toggle="modal" data-bs-target="#sertifikatModal" class="text-decoration-underline">
                    <i class="fas fa-eye"></i> Lihat Sertifikat
                </a>
            @else
                -
            @endif
        </p>
        <p>:
            @if (!empty($data->dokumentasi))
                @php
                    $dokumentasiExt = pathinfo($data->dokumentasi, PATHINFO_EXTENSION);
                    $dokumentasiUrl = asset('storage/' . $data->dokumentasi);
                @endphp
                <a href="#" data-bs-toggle="modal" data-bs-target="#dokumentasiModal" class="text-decoration-underline">
                    <i class="fas fa-eye"></i> Lihat Dokumentasi
                </a>
            @else
                -
            @endif
        </p>
        <p>: {{ $data->deskripsi ?? '-' }}</p>
        <p>:
            @if (!empty($data->link_penyelenggara))
                <a href="{{ $data->link_penyelenggara }}" target="_blank" class="text-decoration-underline">
                    <i class="fas fa-external-link-alt"></i> {{ $data->link_penyelenggara }}
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

{{-- Modal Sertifikat --}}
@if (!empty($data->sertifikat))
<div class="modal fade" id="sertifikatModal" tabindex="-1" aria-labelledby="sertifikatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
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
                    <p>File tidak bisa ditampilkan. <a href="{{ $sertifikatUrl }}" target="_blank">Unduh file</a></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

{{-- Modal Dokumentasi --}}
@if (!empty($data->dokumentasi))
<div class="modal fade" id="dokumentasiModal" tabindex="-1" aria-labelledby="dokumentasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dokumentasiModalLabel">Pratinjau Dokumentasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                @if (in_array(strtolower($dokumentasiExt), ['jpg', 'jpeg', 'png']))
                    <img src="{{ $dokumentasiUrl }}" alt="Dokumentasi" class="img-fluid">
                @elseif (strtolower($dokumentasiExt) === 'pdf')
                    <iframe src="{{ $dokumentasiUrl }}" width="100%" height="600px" style="border:none;"></iframe>
                @else
                    <p>File tidak bisa ditampilkan. <a href="{{ $dokumentasiUrl }}" target="_blank">Unduh file</a></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
