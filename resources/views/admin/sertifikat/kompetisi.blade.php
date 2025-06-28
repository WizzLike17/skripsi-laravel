<h5 class="mt-4 mb-3 border-bottom pb-2">Detail Kompetisi Mandiri</h5>
<div class="row g-3">
    <div class="col-md-3">
        <p><strong>Nama Kegiatan</strong></p>
        <p><strong>Link Penyelenggara</strong></p>
        <p><strong>Dosen Pembimbing</strong></p>
        <p><strong>Capaian Prestasi</strong></p>
        <p><strong>Sertifikat</strong></p>
        <p><strong>Foto Penyerahan</strong></p>
        <p><strong>Surat Tugas</strong></p>
        <p><strong>Jenis Kepesertaan</strong></p>
        <p><strong>Tanggal Pelaksanaan</strong></p>
        <p><strong>Tanggal Selesai</strong></p>
        <p><strong>Jumlah Anggota</strong></p>
        <p><strong>NIDN/NIDK</strong></p>
        <p><strong>Status</strong></p>
    </div>
    <div class="col-md-7">
        <p>: {{ $data->nama_kegiatan ?? '-' }}</p>
        <p>:
            @if (!empty($data->link_penyelenggara))
                <a href="{{ $data->link_penyelenggara }}" target="_blank" class="text-decoration-underline">
                    <i class="fas fa-external-link-alt"></i> {{ $data->link_penyelenggara }}
                </a>
            @else
                -
            @endif
        </p>
        <p>: {{ $data->dospem ?? '-' }}</p>
        <p>: {{ $data->capaian_prestasi ?? '-' }}</p>

        {{-- Sertifikat --}}
        <p>:
            @if (!empty($data->sertifikat))
                @php
                    $sertifikatExt = pathinfo($data->sertifikat, PATHINFO_EXTENSION);
                    $sertifikatUrl = asset('storage/uploads/sertifikat/' . $data->sertifikat);
                @endphp
                <a href="#" data-bs-toggle="modal" data-bs-target="#sertifikatModal" class="text-decoration-underline">
                    <i class="fas fa-eye"></i> Lihat Sertifikat
                </a>
            @else
                -
            @endif
        </p>

        {{-- Foto Penyerahan --}}
        <p>:
            @if (!empty($data->foto_penyerahan))
                @php
                    $fotoExt = pathinfo($data->foto_penyerahan, PATHINFO_EXTENSION);
                    $fotoUrl = asset('storage/uploads/foto_penyerahan/' . $data->foto_penyerahan);
                @endphp
                <a href="#" data-bs-toggle="modal" data-bs-target="#fotoModal" class="text-decoration-underline">
                    <i class="fas fa-eye"></i> Lihat Foto
                </a>
            @else
                -
            @endif
        </p>

        {{-- Surat Tugas --}}
        <p>:
            @if (!empty($data->surat_tugas))
                @php
                    $suratExt = pathinfo($data->surat_tugas, PATHINFO_EXTENSION);
                    $suratUrl = asset('storage/uploads/surat_tugas/' . $data->surat_tugas);
                @endphp
                <a href="#" data-bs-toggle="modal" data-bs-target="#suratModal" class="text-decoration-underline">
                    <i class="fas fa-eye"></i> Lihat Surat Tugas
                </a>
            @else
                -
            @endif
        </p>

        <p>: {{ $data->jenis_kepesertaan ?? '-' }}</p>
        <p>: {{ $data->tanggal_pelaksanaan ?? '-' }}</p>
        <p>: {{ $data->tanggal_selesai ?? '-' }}</p>
        <p>: {{ $data->jumlah_anggota ?? '-' }}</p>
        <p>: {{ $data->nidn_nidk ?? '-' }}</p>
        <p>: {{ $data->status ?? '-' }}</p>
    </div>
</div>

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

{{-- Modal Foto Penyerahan --}}
@if (!empty($data->foto_penyerahan))
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fotoModalLabel">Pratinjau Foto Penyerahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                @if (in_array(strtolower($fotoExt), ['jpg', 'jpeg', 'png']))
                    <img src="{{ $fotoUrl }}" alt="Foto Penyerahan" class="img-fluid">
                @elseif (strtolower($fotoExt) === 'pdf')
                    <iframe src="{{ $fotoUrl }}" width="100%" height="600px" style="border:none;"></iframe>
                @else
                    <p>File tidak bisa ditampilkan. <a href="{{ $fotoUrl }}" target="_blank">Unduh file</a></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

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
