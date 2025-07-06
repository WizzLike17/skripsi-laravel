@extends('layout.app')

@section('title', 'Pengajuan Penghargaan')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="card shadow border-0">
                <h2 class="card-header text-white bg-secondary d-flex align-items-center mb-3">
                    <i class="bx bx-award bx-sm me-2"></i>
                    <span>Pengajuan Penghargaan</span>
                </h2>

                <div class="row g-4">
                    {{-- Kartu: Hibah KEMENDIKBUD --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-3">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bxs-graduation bx-lg text-info me-3"></i>
                                    <h5 class="mb-0">Hibah KEMENDIKBUD</h5>
                                </div>
                                <p class="text-muted">
                                    Untuk mengajukan prestasi terkait hibah dari Kementerian Pendidikan dan Kebudayaan.
                                </p>
                                <a href="{{ route('kemendikbud.create') }}"
                                    class="btn btn-info btn-sm text-white mt-auto">Ajukan Sekarang</a>
                            </div>
                        </div>
                    </div>


                    {{-- Kartu: Kegiatan MBKM --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-3">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bxs-book-open bx-lg text-success me-3"></i>
                                    <h5 class="mb-0">Kegiatan MBKM</h5>
                                </div>
                                <p class="text-muted">
                                    Pengajuan kegiatan Merdeka Belajar Kampus Merdeka (MBKM).
                                </p>
                                <a href="{{ route('mbkm.create') }}" class="btn btn-success btn-sm mt-auto">Ajukan
                                    Sekarang</a>
                            </div>
                        </div>
                    </div>

                    {{-- Kartu: Kompetisi Mandiri --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-3">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bxs-trophy bx-lg text-warning me-3"></i>
                                    <h5 class="mb-0">Kompetisi Mandiri</h5>
                                </div>
                                <p class="text-muted">
                                    Pengajuan prestasi dari kompetisi yang diikuti secara mandiri oleh mahasiswa.
                                </p>
                                <a href="{{ route('kompetisi-mandiri.create') }}" class="btn btn-warning btn-sm mt-auto">Ajukan Sekarang</a>
                            </div>
                        </div>
                    </div>

                    {{-- Kartu: Aktivitas Mahasiswa --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-3">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bxs-flag-checkered bx-lg text-primary me-3"></i>
                                    <h5 class="mb-0">Aktivitas Mahasiswa</h5>
                                </div>
                                <p class="text-muted">
                                    Pengajuan aktivitas non-kompetitif yang diakui sebagai prestasi.
                                </p>
                                <a href="{{ route('aktifitas.create') }}" class="btn btn-primary btn-sm text-white mt-auto">Ajukan Sekarang</a>
                            </div>
                        </div>
                    </div>

                    {{-- Kartu: Rekognisi --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-3">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bx-badge-check bx-lg text-danger me-3"></i>
                                    <h5 class="mb-0">Rekognisi</h5>
                                </div>
                                <p class="text-muted">
                                    Untuk pengajuan sertifikat yang diakui sebagai pencapaian akademik atau
                                    non-akademik.
                                </p>
                                <a href="{{ route('rekognisi.create') }}" class="btn btn-danger btn-sm text-white mt-auto">Ajukan Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div> {{-- End row --}}
            </div>
        </div>
    </div>
@endsection
