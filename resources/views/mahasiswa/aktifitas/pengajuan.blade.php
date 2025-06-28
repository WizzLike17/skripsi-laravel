@extends('layout.app')

@section('title', 'Ajukan Aktifitas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow rounded-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bx bx-edit-alt me-2"></i>Form Pengajuan Aktifitas'</h5>
                </div>

                <div class="card-body mt-3">
                    @if (!$periode)
                        <div class="alert alert-warning">
                            <strong>Periode pengajuan tidak tersedia.</strong><br>
                            Saat ini tidak ada periode aktif untuk pengajuan Aktifitas'.
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
                        <form action="{{ route('aktifitas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                <input type="text" name="nama_kegiatan" class="form-control"
                                    value="{{ old('nama_kegiatan') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="peserta" class="form-label">Peserta</label>
                                <input type="text" name="peserta" class="form-control"
                                    value="{{ old('peserta') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="dospem" class="form-label">Dosen Pembimbing</label>
                                <input type="text" name="dospem" class="form-control"
                                    value="{{ old('dospem') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="keterlibatan_dospem" class="form-label">Keterlibatan Dosen Pembimbing</label>
                                <input type="text" name="keterlibatan_dospem" class="form-control"
                                    value="{{ old('keterlibatan_dospem') }}" required>
                            </div>

                            {{-- Surat Tugas --}}
                            <div class="mb-3">
                                <label for="surat_tugas" class="form-label">Surat Tugas</label>
                                <input type="file" name="surat_tugas" class="form-control">
                            </div>

                            {{-- Sertifikat --}}
                            <div class="mb-3">
                                <label for="sertifikat" class="form-label">Sertifikat</label>
                                <input type="file" name="sertifikat" class="form-control">
                            </div>

                            {{-- Dokumentasi --}}
                            <div class="mb-3">
                                <label for="dokumentasi" class="form-label">Dokumentasi</label>
                                <input type="file" name="dokumentasi" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="link_penyelenggara" class="form-label">Link Penyelenggara</label>
                                <input type="url" name="link_penyelenggara" class="form-control"
                                    value="{{ old('link_penyelenggara') }}">
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
