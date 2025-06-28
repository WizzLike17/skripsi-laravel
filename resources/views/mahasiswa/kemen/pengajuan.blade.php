@extends('layout.app')

@section('title', 'Ajukan Hibah KEMENDIKBUD')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow rounded-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bx bx-edit-alt me-2"></i>Form Pengajuan Hibah KEMENDIKBUD</h5>
                </div>

                <div class="card-body mt-3">
                    @if (!$periode)
                        <div class="alert alert-warning">
                            <strong>Periode pengajuan tidak tersedia.</strong><br>
                            Saat ini tidak ada periode aktif untuk pengajuan hibah KEMENDIKBUD.
                        </div>
                    @else
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Terjadi kesalahan saat mengisi form:</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-warning">{{ session('error') }}</div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif


                        <form action="{{ route('kemendikbud.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Nama Kegiatan --}}
                            <div class="mb-3">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                <input type="text" name="nama_kegiatan"
                                    class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                    value="{{ old('nama_kegiatan') }}" required>
                                @error('nama_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggal --}}
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Kegiatan</label>
                                <input type="date" name="tanggal"
                                    class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}"
                                    required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Ketua --}}
                            <div class="mb-3">
                                <label for="ketua" class="form-label">Ketua Tim</label>
                                <input type="text" name="ketua"
                                    class="form-control @error('ketua') is-invalid @enderror" value="{{ old('ketua') }}"
                                    required>
                                @error('ketua')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Anggota --}}
                            <div class="mb-3">
                                <label for="anggota" class="form-label">Anggota Tim</label>
                                <input type="text" name="anggota"
                                    class="form-control @error('anggota') is-invalid @enderror"
                                    value="{{ old('anggota') }}" required>
                                @error('anggota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Dosen Pembimbing --}}
                            <div class="mb-3">
                                <label for="dospem" class="form-label">Dosen Pembimbing</label>
                                <input type="text" name="dospem"
                                    class="form-control @error('dospem') is-invalid @enderror" value="{{ old('dospem') }}"
                                    required>
                                @error('dospem')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Keterlibatan Dospem --}}
                            <div class="mb-3">
                                <label for="keterlibatan_dospem" class="form-label">Keterlibatan Dosen Pembimbing</label>
                                <input type="text" name="keterlibatan_dospem"
                                    class="form-control @error('keterlibatan_dospem') is-invalid @enderror"
                                    value="{{ old('keterlibatan_dospem') }}" required>
                                @error('keterlibatan_dospem')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Prestasi --}}
                            <div class="mb-3">
                                <label for="prestasi" class="form-label">Capaian / Prestasi</label>
                                <input type="text" name="prestasi"
                                    class="form-control @error('prestasi') is-invalid @enderror"
                                    value="{{ old('prestasi') }}" required>
                                @error('prestasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Lingkup Kegiatan --}}
                            <div class="mb-3">
                                <label for="lingkup_kegiatan" class="form-label">Lingkup Kegiatan</label>
                                <select name="lingkup_kegiatan"
                                    class="form-select @error('lingkup_kegiatan') is-invalid @enderror" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Lokal" {{ old('lingkup_kegiatan') == 'Lokal' ? 'selected' : '' }}>Lokal
                                    </option>
                                    <option value="Nasional" {{ old('lingkup_kegiatan') == 'Nasional' ? 'selected' : '' }}>
                                        Nasional</option>
                                    <option value="Internasional"
                                        {{ old('lingkup_kegiatan') == 'Internasional' ? 'selected' : '' }}>Internasional
                                    </option>
                                </select>
                                @error('lingkup_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Lokasi --}}
                            <div class="mb-3">
                                <label for="lokasi_kegiatan" class="form-label">Lokasi Kegiatan</label>
                                <input type="text" name="lokasi_kegiatan"
                                    class="form-control @error('lokasi_kegiatan') is-invalid @enderror"
                                    value="{{ old('lokasi_kegiatan') }}" required>
                                @error('lokasi_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Sumber Biaya --}}
                            <div class="mb-3">
                                <label for="sumber_biaya" class="form-label">Sumber Biaya</label>
                                <input type="text" name="sumber_biaya"
                                    class="form-control @error('sumber_biaya') is-invalid @enderror"
                                    value="{{ old('sumber_biaya') }}" required>
                                @error('sumber_biaya')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Biaya --}}
                            <div class="mb-3">
                                <label for="biaya" class="form-label">Total Biaya (Rp)</label>
                                <input type="number" name="biaya"
                                    class="form-control @error('biaya') is-invalid @enderror"
                                    value="{{ old('biaya') }}" required>
                                @error('biaya')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Surat Undangan --}}
                            <div class="mb-3">
                                <label for="surat" class="form-label">Unggah Surat Undangan</label>
                                <input type="file" name="surat"
                                    class="form-control @error('surat') is-invalid @enderror"
                                    accept=".pdf,.jpg,.png,.jpeg" required>
                                <small class="text-muted">Format: PDF/JPG/PNG, Max: 2MB</small>
                                @error('surat')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Sertifikat --}}
<div class="mb-3">
    <label for="sertifikat" class="form-label">Unggah Sertifikat</label>
    <input type="file" name="sertifikat"
        class="form-control @error('sertifikat') is-invalid @enderror"
        accept=".pdf,.jpg,.png,.jpeg" required>
    <small class="text-muted">Format: PDF/JPG/PNG, Max: 2MB</small>
    @error('sertifikat')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

                            {{-- Tombol --}}
                            <div class="text-end">
                                <a href="{{ route('kemendikbud.index') }}" class="btn btn-light">Batal</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-upload"></i> Ajukan
                                </button>
                            </div>
                        </form>
                    @endif {{-- <-- Ini yang kurang --}}

                </div>
            </div>
        </div>
    </div>
@endsection
