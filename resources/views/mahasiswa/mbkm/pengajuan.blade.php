@extends('layout.app')

@section('title', 'Ajukan MBKM')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow rounded-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bx bx-edit-alt me-2"></i>Form Pengajuan MBKM</h5>
                </div>

                <div class="card-body mt-3">
                    @if (!$periode)
                        <div class="alert alert-warning">
                            <strong>Periode pengajuan tidak tersedia.</strong><br>
                            Saat ini tidak ada periode aktif untuk pengajuan MBKM.
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
                        <form action="{{ route('mbkm.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Nama Kegiatan --}}
                            <div class="mb-3">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                <input type="text" name="nama_kegiatan" class="form-control"
                                    value="{{ old('nama_kegiatan') }}" required>
                            </div>

                            {{-- Ketua --}}
                            <div class="mb-3">
                                <label for="ketua" class="form-label">Ketua Tim</label>
                                <input type="text" name="ketua" class="form-control" value="{{ old('ketua') }}"
                                    required>
                            </div>

                            {{-- Anggota --}}
                            <div class="mb-3">
                                <label for="anggota" class="form-label">Anggota Tim</label>
                                <input type="text" name="anggota" class="form-control" value="{{ old('anggota') }}"
                                    required>
                            </div>

                            {{-- Dosen Pembimbing --}}
                            <div class="mb-3">
                                <label for="dospem" class="form-label">Dosen Pembimbing</label>
                                <input type="text" name="dospem" class="form-control" value="{{ old('dospem') }}"
                                    required>
                            </div>

                            {{-- Keterlibatan Dosen Pembimbing --}}
                            <div class="mb-3">
                                <label for="keterlibatan_dospem" class="form-label">Keterlibatan Dosen Pembimbing</label>
                                <input type="text" name="keterlibatan_dospem" class="form-control"
                                    value="{{ old('keterlibatan_dospem') }}" required>
                            </div>

                            {{-- Sumber Biaya --}}
                            <div class="mb-3">
                                <label for="sumber_biaya" class="form-label">Sumber Biaya</label>
                                <input type="text" name="sumber_biaya" class="form-control"
                                    value="{{ old('sumber_biaya') }}" required>
                            </div>

                            {{-- Sertifikat --}}
                            <div class="mb-3">
                                <label for="sertifikat" class="form-label">Unggah Sertifikat</label>
                                <input type="file" name="sertifikat" class="form-control" accept=".pdf,.jpg,.png,.jpeg"
                                    required>
                                <small class="text-muted">Format: PDF/JPG/PNG, Max: 2MB</small>
                            </div>

                            {{-- Nama Mitra --}}
                            <div class="mb-3">
                                <label for="nama_mitra" class="form-label">Nama Mitra</label>
                                <input type="text" name="nama_mitra" class="form-control"
                                    value="{{ old('nama_mitra') }}" required>
                            </div>

                            {{-- Lokasi Mitra --}}
                            <div class="mb-3">
                                <label for="lokasi_mitra" class="form-label">Lokasi Mitra</label>
                                <input type="text" name="lokasi_mitra" class="form-control"
                                    value="{{ old('lokasi_mitra') }}" required>
                            </div>

                            {{-- Surat Kerja Sama --}}
                            <div class="mb-3">
                                <label for="surat_kerja_sama" class="form-label">Unggah Surat Kerja Sama</label>
                                <input type="file" name="surat_kerja_sama" class="form-control"
                                    accept=".pdf,.jpg,.png,.jpeg" required>
                                <small class="text-muted">Format: PDF/JPG/PNG, Max: 2MB</small>
                            </div>

                            {{-- Tanggal Pelaksanaan --}}
                            <div class="mb-3">
                                <label for="tanggal_pelaksanaan" class="form-label">Tanggal Pelaksanaan</label>
                                <input type="date" name="tanggal_pelaksanaan" class="form-control"
                                    value="{{ old('tanggal_pelaksanaan') }}" required>
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div class="mb-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control"
                                    value="{{ old('tanggal_selesai') }}" required>
                            </div>

                            {{-- Tombol --}}
                            <div class="text-end">
                                <a href="{{ route('pengajuan') }}" class="btn btn-light">Batal</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-upload"></i> Ajukan
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
