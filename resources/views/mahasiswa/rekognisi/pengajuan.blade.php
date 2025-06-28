@extends('layout.app')

@section('title', 'Ajukan Rekognisi')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow rounded-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bx bx-edit-alt me-2"></i>Form Pengajuan Rekognisi</h5>
                </div>

                <div class="card-body mt-3">
                    @if (!$periode)
                        <div class="alert alert-warning">
                            <strong>Periode pengajuan tidak tersedia.</strong><br>
                            Saat ini tidak ada periode aktif untuk pengajuan Rekognisi.
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

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('rekognisi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Nama Kegiatan --}}
                            <div class="mb-3">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                <input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan') }}" required>
                            </div>

                            {{-- Ketua --}}
                            <div class="mb-3">
                                <label for="ketua" class="form-label">Ketua</label>
                                <input type="text" name="ketua" class="form-control" value="{{ old('ketua') }}" required>
                            </div>

                            {{-- Anggota --}}
                            <div class="mb-3">
                                <label for="anggota" class="form-label">Anggota</label>
                                <input type="text" name="anggota" class="form-control" value="{{ old('anggota') }}">
                            </div>

                            {{-- Dosen Pembimbing --}}
                            <div class="mb-3">
                                <label for="dospem" class="form-label">Dosen Pembimbing</label>
                                <input type="text" name="dospem" class="form-control" value="{{ old('dospem') }}" required>
                            </div>

                            {{-- Deskripsi Karya --}}
                            <div class="mb-3">
                                <label for="deskripsi_karya" class="form-label">Deskripsi Karya</label>
                                <textarea name="deskripsi_karya" class="form-control" rows="3">{{ old('deskripsi_karya') }}</textarea>
                            </div>

                            {{-- Nama Lembaga Mitra --}}
                            <div class="mb-3">
                                <label for="nama_lembaga_mitra" class="form-label">Nama Lembaga Mitra</label>
                                <input type="text" name="nama_lembaga_mitra" class="form-control" value="{{ old('nama_lembaga_mitra') }}">
                            </div>

                            {{-- No Surat Rekognisi --}}
                            <div class="mb-3">
                                <label for="no_surat_rekognisi" class="form-label">Nomor Surat Rekognisi</label>
                                <input type="text" name="no_surat_rekognisi" class="form-control" value="{{ old('no_surat_rekognisi') }}">
                            </div>

                            {{-- Jenis Karya --}}
                            <div class="mb-3">
                                <label for="jenis_karya" class="form-label">Jenis Karya</label>
                                <input type="text" name="jenis_karya" class="form-control" value="{{ old('jenis_karya') }}" required>
                            </div>

                            {{-- Link Acara --}}
                            <div class="mb-3">
                                <label for="link_acara" class="form-label">Link Acara</label>
                                <input type="url" name="link_acara" class="form-control" value="{{ old('link_acara') }}">
                            </div>

                            {{-- Tahun --}}
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" name="tahun" class="form-control" value="{{ old('tahun') }}" required>
                            </div>

                            {{-- Surat Tugas --}}
                            <div class="mb-3">
                                <label for="surat_tugas" class="form-label">Unggah Surat Tugas</label>
                                <input type="file" name="surat_tugas" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted">Format: PDF/JPG/JPEG/PNG, Maks: 2MB</small>
                            </div>

                            {{-- Bukti Penyerahan --}}
                            <div class="mb-3">
                                <label for="bukti_penyerahan" class="form-label">Unggah Bukti Penyerahan</label>
                                <input type="file" name="bukti_penyerahan" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted">Format: PDF/JPG/JPEG/PNG, Maks: 2MB</small>
                            </div>

                            {{-- Tombol --}}
                            <div class="text-end">
                                <a href="{{ route('rekognisi.index') }}" class="btn btn-light">Batal</a>
                                <button type="submit" class="btn btn-primary"><i class="bx bx-upload"></i> Ajukan</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
