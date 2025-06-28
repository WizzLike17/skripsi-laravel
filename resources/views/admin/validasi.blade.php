@extends('layout.app')

@section('title', 'Detail Sertifikat')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h1 class="mb-4">📄 Detail Sertifikat</h1>

        {{-- Alert sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        {{-- Alert error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form validasi jika status pending atau revisi --}}
        @if (in_array($sertifikat->status, ['pending', 'revisi']))
            <div class="card border border-success shadow-sm bg-light text-dark mt-4 rounded-3">
                <div class="card-header bg-success text-white rounded-top">
                    <h5 class="mb-0">🛠️ Form Validasi Sertifikat</h5>
                </div>
                <div class="card-body">
                    <div class="mt-3 p-3 border rounded bg-white text-dark shadow-sm"
                        style="min-height: 280px; overflow-wrap: break-word;">
                        @if ($sertifikat->aktifitas)
                            @include('admin.sertifikat.aktifitas', ['data' => $sertifikat->aktifitas])
                        @elseif ($sertifikat->kompetisiMandiri)
                            @include('admin.sertifikat.kompetisi', ['data' => $sertifikat->kompetisiMandiri,])
                        @elseif ($sertifikat->kemendikbud)
                            @include('admin.sertifikat.kemendikbud', ['data' => $sertifikat->kemendikbud])
                        @elseif ($sertifikat->mbkm)
                            @include('admin.sertifikat.mbkm', ['data' => $sertifikat->mbkm])
                        @elseif ($sertifikat->rekognisi)
                            @include('admin.sertifikat.rekognisi', ['data' => $sertifikat->rekognisi])
                        @else
                            <p class="text-muted">Tidak ada data yang tersedia.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <div class="row g-4 mt-4">
            {{-- Informasi Mahasiswa --}}
            <div class="col-md-6">
                <div class="card shadow-sm bg-light rounded-3">
                    <div class="card-header bg-primary text-white rounded-top">
                        <h5 class="mb-0">👤 Informasi Mahasiswa</h5>
                    </div>
                    <div class="card-body text-dark">
                        <div class="mt-3 p-3 border rounded bg-white text-dark shadow-sm"
                            style="min-height: 280px; overflow-wrap: break-word;">
                            <p><strong>Nama:</strong> {{ $sertifikat->mahasiswa->nama ?? '-' }}</p>
                            <p><strong>NIM:</strong> {{ $sertifikat->mahasiswa->nim ?? '-' }}</p>

                            <p>
                                <strong>Periode:</strong>
                                @if ($sertifikat->periode)
                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill" style="font-size: 0.9rem;">
                                        {{ ucfirst($sertifikat->periode->jenis_periode) }}
                                        ({{ \Carbon\Carbon::parse($sertifikat->periode->tanggal_mulai)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($sertifikat->periode->tanggal_selesai)->format('d M Y') }})
                                    </span>
                                @else
                                    -
                                @endif
                            </p>

                            <p>
                                <strong>Jenis Kegiatan:</strong>
                                @php
                                    if ($sertifikat->aktifitas) {
                                        $relationName = 'Aktifitas';
                                    } elseif ($sertifikat->kompetisiMandiri) {
                                        $relationName = 'Kompetisi Mandiri';
                                    } elseif ($sertifikat->kemendikbud) {
                                        $relationName = 'Kemendikbud';
                                    } elseif ($sertifikat->mbkm) {
                                        $relationName = 'MBKM';
                                    } elseif ($sertifikat->rekognisi) {
                                        $relationName = 'Rekognisi';
                                    } else {
                                        $relationName = '-';
                                    }
                                @endphp
                                <span class="badge bg-info text-dark px-3 py-2 rounded-pill" style="font-size: 0.9rem;">
                                    {{ $relationName }}
                                </span>
                            </p>

                            <p>
                                <strong>Status:</strong>
                                @php
                                    $statusClass = 'bg-secondary text-white';
                                    switch ($sertifikat->status) {
                                        case 'pending':
                                            $statusClass = 'bg-warning text-dark';
                                            break;                                       
                                        case 'revisi':
                                            $statusClass = 'bg-info text-white';
                                            break;
                                    }
                                @endphp
                                <span class="badge px-3 py-2 rounded-pill {{ $statusClass }}" style="font-size: 0.9rem;">
                                    {{ ucfirst($sertifikat->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail Sertifikat --}}
            <div class="col-md-6">
                <div class="card shadow-sm bg-light rounded-3">
                    <div class="card-header bg-secondary text-white rounded-top">
                        <h5 class="mb-0">📝 Detail Sertifikat</h5>
                    </div>
                    <div class="card-body">
                        @if (in_array($sertifikat->status, ['pending', 'revisi']))
                            <form action="{{ route('sertifikat.validasi', $sertifikat->id) }}" method="POST"
                                id="form-validasi">
                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="terima"
                                            {{ old('status', $sertifikat->status) == 'terima' ? 'selected' : '' }}>Terima
                                        </option>
                                        <option value="tolak"
                                            {{ old('status', $sertifikat->status) == 'tolak' ? 'selected' : '' }}>Tolak
                                        </option>
                                        <option value="revisi"
                                            {{ old('status', $sertifikat->status) == 'revisi' ? 'selected' : '' }}>Revisi
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3" id="revisi_alasan_div"
                                    style="display: {{ old('status', $sertifikat->status) == 'revisi' ? 'block' : 'none' }};">

                                    <label for="alasan_revisi" class="form-label">Alasan</label>
                                    <textarea name="alasan_revisi" id="alasan_revisi" rows="3" class="form-control">{{ old('alasan_revisi', $sertifikat->revisi_alasan) }}</textarea>
                                </div>

                                <div class="mb-3" id="nilai_div">
                                    <label for="nilai" class="form-label">Nilai</label>
                                    <input type="string" name="nilai" id="nilai" class="form-control" min="0"
                                        max="100" value="{{ old('nilai', $sertifikat->nilai) }}" step="any">
                                </div>

                                <button type="submit" class="btn btn-success">Simpan Validasi</button>
                                <a href="{{ route('sertifikat.index') }}" class="btn btn-secondary ms-2">Batal</a>
                            </form>
                        @else
                            <p class="text-center text-muted">Validasi sudah selesai untuk sertifikat ini.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk toggle alasan revisi --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const statusSelect = document.getElementById('status');
                const revisiDiv = document.getElementById('revisi_alasan_div');
                const revisiInput = document.getElementById('alasan_revisi');

                if (statusSelect && revisiDiv && revisiInput) {
                    function toggleRevisiAlasan() {
                        if (statusSelect.value === 'revisi') {
                            revisiDiv.style.display = 'block';
                        } else {
                            revisiDiv.style.display = 'none';
                            revisiInput.value = ''; // Kosongkan isinya
                        }
                    }

                    statusSelect.addEventListener('change', toggleRevisiAlasan);
                    toggleRevisiAlasan(); // Jalankan saat halaman diload
                }
            });
        </script>
    @endpush


@endsection
