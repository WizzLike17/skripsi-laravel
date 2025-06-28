<h5 class="mt-4 mb-3 border-bottom pb-2">Detail Kegiatan Kemendikbud</h5>
<div class="row g-3">
    <div class="col-md-3">
        <p><strong>Nama Kegiatan</strong></p>
        <p><strong>Tanggal</strong></p>
        <p><strong>Ketua</strong></p>
        <p><strong>Anggota</strong></p>
        <p><strong>Dosen Pembimbing</strong></p>
        <p><strong>Keterlibatan Dospem</strong></p>
        <p><strong>Prestasi</strong></p>
        <p><strong>Sertifikat</strong></p>
        <p><strong>Surat</strong></p>
        <p><strong>Lingkup Kegiatan</strong></p>
        <p><strong>Sumber Biaya</strong></p>
        <p><strong>Biaya</strong></p>
        <p><strong>Lokasi Kegiatan</strong></p>
        <p><strong>Status</strong></p>
    </div>
    <div class="col-md-7">
        <p>: {{ $data->nama_kegiatan ?? '-' }}</p>
        <p>: {{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') ?? '-' }}</p>
        <p>: {{ $data->ketua ?? '-' }}</p>
        <p>: {{ $data->anggota ?? '-' }}</p>
        <p>: {{ $data->dospem ?? '-' }}</p>
        <p>: {{ $data->keterlibatan_dospem ?? '-' }}</p>
        <p>: {{ $data->prestasi ?? '-' }}</p>

        {{-- Pratinjau Sertifikat --}}
        <p>:
            @if (!empty($data->sertifikat))
                @php
                    $ext = pathinfo($data->sertifikat, PATHINFO_EXTENSION);
                    $sertifikatUrl = asset('storage/uploads/sertifikat/' . $data->sertifikat);
                @endphp
                <a href="#" data-bs-toggle="modal" data-bs-target="#sertifikatModal">
                    <i class="fas fa-eye"></i> Lihat Sertifikat
                </a>
            @else
                -
            @endif
        </p>

        {{-- Pratinjau Surat --}}
        <p>:
            @if (!empty($data->surat))
                @php
                    $extSurat = pathinfo($data->surat, PATHINFO_EXTENSION);
                    $suratUrl = asset('storage/uploads/surat/' . $data->surat);
                @endphp
                <a href="#" data-bs-toggle="modal" data-bs-target="#suratModal">
                    <i class="fas fa-eye"></i> Lihat Surat
                </a>
            @else
                -
            @endif
        </p>

        <p>: {{ $data->lingkup_kegiatan ?? '-' }}</p>
        <p>: {{ $data->sumber_biaya ?? '-' }}</p>
        <p>: {{ $data->biaya ? 'Rp ' . number_format($data->biaya, 0, ',', '.') : '-' }}</p>
        <p>: {{ $data->lokasi_kegiatan ?? '-' }}</p>
        <p>: {{ $data->status ?? '-' }}</p>
    </div>
</div>

<!-- Modal Sertifikat -->
@if (!empty($data->sertifikat))
    <div class="modal fade" id="sertifikatModal" tabindex="-1" aria-labelledby="sertifikatModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sertifikatModalLabel">Pratinjau Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center">
                    @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                        <img src="{{ $sertifikatUrl }}" alt="Sertifikat" class="img-fluid">
                    @elseif (strtolower($ext) === 'pdf')
                        <iframe src="{{ $sertifikatUrl }}" width="100%" height="600px" style="border:none;"></iframe>
                    @else
                        <p>File tidak bisa ditampilkan. <a href="{{ $sertifikatUrl }}" target="_blank">Unduh file</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Modal Surat -->
@if (!empty($data->surat))
    <div class="modal fade" id="suratModal" tabindex="-1" aria-labelledby="suratModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="suratModalLabel">Pratinjau Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center">
                    @if (in_array(strtolower($extSurat), ['jpg', 'jpeg', 'png']))
                        <img src="{{ $suratUrl }}" alt="Surat" class="img-fluid">
                    @elseif (strtolower($extSurat) === 'pdf')
                        <iframe src="{{ $suratUrl }}" width="100%" height="600px" style="border:none;"></iframe>
                    @else
                        <p>File tidak bisa ditampilkan. <a href="{{ $suratUrl }}" target="_blank">Unduh file</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
