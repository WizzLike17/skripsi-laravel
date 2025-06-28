@extends('layout.app')

@section('title', 'Edit Kompetisi Mandiri')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow rounded-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bx bx-edit me-2"></i>Edit Pengajuan Kompetsi Mandiri</h5>
                </div>
                <div class="card-body mt-3">
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

                    <div class="row">
                        {{-- Kolom Form --}}
                        @include('mahasiswa.sertifikat.kompetisi', ['kompetisi' => $kompetisi])

                        {{-- Kolom Detail --}}

                        <div class="col-md-4">
                            @if ($kompetisi->sertifikatRel && $kompetisi->sertifikatRel->revisi_alasan)
                                <div class="card shadow-sm border-0 mb-3" style="border-radius: 1rem; overflow: hidden;">
                                    <div class="card-header bg-dark text-white d-flex align-items-center"
                                        style="border-bottom: none;">
                                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                                        <strong>Keterangan Revisi</strong>
                                    </div>
                                    <div class="card-body" style="background-color: #f8f9fa;">
                                        <p class="mb-0 text-dark" style="white-space: pre-wrap;">
                                            {{ $kompetisi->sertifikatRel->revisi_alasan }}
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-light border text-center shadow-sm" role="alert">
                                    <i class="bi bi-info-circle me-1"></i> Tidak ada alasan revisi.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
