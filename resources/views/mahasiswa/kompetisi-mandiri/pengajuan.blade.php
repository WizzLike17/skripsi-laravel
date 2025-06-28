@extends('layout.app')

@section('title', 'Ajukan Kompetisi Mandiri')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow rounded-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bx bx-edit-alt me-2"></i>Form Pengajuan Kompetisi Mandiri</h5>
                </div>

                <div class="card-body mt-3">
                    @if (!$periode)
                        <div class="alert alert-warning">
                            <strong>Periode pengajuan tidak tersedia.</strong><br>
                            Saat ini tidak ada periode aktif untuk pengajuan Kompetisi Mandiri.
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
                        <form action="{{ route('kompetisi-mandiri.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                <input type="text" name="nama_kegiatan" class="form-control"
                                    value="{{ old('nama_kegiatan') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="link_penyelenggara" class="form-label">Link Penyelenggara</label>
                                <input type="url" name="link_penyelenggara" class="form-control"
                                    value="{{ old('link_penyelenggara') }}">
                            </div>

                            <div class="mb-3">
                                <label for="dospem" class="form-label">Dosen Pembimbing</label>
                                <input type="text" name="dospem" class="form-control"
                                    value="{{ old('dospem') }}">
                            </div>

                            <div class="mb-3">
                                <label for="capaian_prestasi" class="form-label">Capaian Prestasi</label>
                                <input type="text" name="capaian_prestasi" class="form-control"
                                    value="{{ old('capaian_prestasi') }}">
                            </div>

                            <div class="mb-3">
                                <label for="sertifikat" class="form-label">Sertifikat (PDF/JPG/PNG, maks 2MB)</label>
                                <input type="file" name="sertifikat" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="foto_penyerahan" class="form-label">Foto Penyerahan (PDF/JPG/PNG, maks
                                    2MB)</label>
                                <input type="file" name="foto_penyerahan" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="surat_tugas" class="form-label">Surat Tugas (PDF/JPG/PNG, maks 2MB)</label>
                                <input type="file" name="surat_tugas" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kepesertaan" class="form-label">Jenis Kepesertaan</label>
                                <input type="text" name="jenis_kepesertaan" class="form-control"
                                    value="{{ old('jenis_kepesertaan') }}">
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_pelaksanaan" class="form-label">Tanggal Pelaksanaan</label>
                                <input type="date" name="tanggal_pelaksanaan" class="form-control"
                                    value="{{ old('tanggal_pelaksanaan') }}">
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control"
                                    value="{{ old('tanggal_selesai') }}">
                            </div>

                            <div class="mb-3">
                                <label for="jumlah_anggota" class="form-label">Jumlah Anggota</label>
                                <input type="number" name="jumlah_anggota" class="form-control"
                                    value="{{ old('jumlah_anggota') }}">
                            </div>

                            <div class="mb-3">
                                <label for="nidn_nidk" class="form-label">NIDN/NIDK</label>
                                <input type="text" name="nidn_nidk" class="form-control"
                                    value="{{ old('nidn_nidk') }}">
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
