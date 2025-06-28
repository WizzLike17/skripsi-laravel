@extends('layout.app')
@section('title', 'Dashboard Admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
            <label for="periode_id" class="form-label">Pilih Periode:</label>
            <select name="periode_id" id="periode_id" class="form-select" onchange="this.form.submit()">
                @foreach ($periodes as $periode)
                    <option value="{{ $periode->periode_id }}"
                        {{ $periodeAktif && $periodeAktif->periode_id == $periode->periode_id ? 'selected' : '' }}>
                        {{ $periode->nama_periode }}
                    </option>
                @endforeach
            </select>
        </form>

        {{-- Welcome Card --}}
        <div class="mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-primary mb-3">Selamat Datang, {{ auth()->user()->nama }}! 🎉</h3>
                    <p class="mb-0">
                        Anda sedang memantau <span class="fw-bold">{{ $totalSertifikat }}</span> pengajuan sertifikat
                        dari seluruh mahasiswa pada semester <strong>{{ $periodeAktif->nama_periode }}</strong>.
                        Berikut adalah ringkasan status pengajuan:
                    </p>
                    {{-- Status Summary Cards --}}
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-6 mb-2">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Pending</h5>
                                    <h3 class="text-warning">{{ $pending }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-2">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Revisi</h5>
                                    <h3 class="text-info">{{ $revisi }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-2">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Diterima</h5>
                                    <h3 class="text-success">{{ $diterima }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-2">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Ditolak</h5>
                                    <h3 class="text-danger">{{ $ditolak }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- Kategori Summary Cards --}}
        <div class="row mb-4">
            @php
                $summaryCards = [
                    [
                        'title' => 'Aktivitas',
                        'count' => $aktifitas->count(),
                        'icon' => 'bxs-flag-checkered',
                        'color' => 'text-primary',
                        'route' => route('aktifitas.index'),
                    ],
                    [
                        'title' => 'Kompetisi Mandiri',
                        'count' => $kompetisiMandiri->count(),
                        'icon' => 'bxs-trophy',
                        'color' => 'text-warning',
                        'route' => route('kompetisi-mandiri.index'),
                    ],
                    [
                        'title' => 'Kemendikbud',
                        'count' => $kemendikbud->count(),
                        'icon' => 'bxs-graduation',
                        'color' => 'text-info',
                        'route' => route('kemendikbud.index'),
                    ],
                    [
                        'title' => 'MBKM',
                        'count' => $mbkm->count(),
                        'icon' => 'bxs-book-open',
                        'color' => 'text-success',
                        'route' => route('mbkm.index'),
                    ],
                    [
                        'title' => 'Rekognisi',
                        'count' => $rekognisi->count(),
                        'icon' => 'bx-badge-check',
                        'color' => 'text-danger',
                        'route' => route('rekognisi.index'),
                    ],
                ];
            @endphp

            @foreach ($summaryCards as $card)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            {{-- Icon dan Judul di Samping --}}
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    <i class="bx {{ $card['icon'] }} bx-lg {{ $card['color'] }}"></i>
                                </div>
                                <h5 class="card-title mb-0" style="color: #000000;">{{ $card['title'] }}</h5>
                            </div>

                            {{-- Jumlah dan Deskripsi --}}
                            <h3 class="card-text mb-0 text-center">{{ $card['count'] }}</h3>
                            <small class="text-muted d-block text-center">Total pengajuan dalam kategori ini</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pie Chart --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Distribusi Status Pengajuan</h5>
                <div id="pieChart" style="height: 350px;"></div>
            </div>
        </div>

        {{-- Riwayat Pengajuan Terbaru --}}
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Riwayat Pengajuan Terbaru</h5>

                @if ($riwayat->count())
                    @foreach ($riwayat as $item)
                        <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                            <div>
                                <h6 class="mb-1">{{ $item->nama_kegiatan ?? 'Tanpa Nama' }}</h6>
                                <small class="text-muted">
                                    Diajukan oleh: {{ $item->mahasiswa->nama }} | Tanggal:
                                    {{ $item->created_at->format('d M Y') }}
                                </small>
                            </div>
                            <div>
                                @if ($item->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($item->status == 'revisi')
                                    <span class="badge bg-info">Revisi</span>
                                @elseif ($item->status == 'terima')
                                    <span class="badge bg-success">Diterima</span>
                                @elseif ($item->status == 'tolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Diketahui</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info mt-3">Belum ada riwayat pengajuan terbaru.</div>
                @endif
            </div>
        </div>

    </div>

    {{-- ApexCharts CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: ['Pending', 'Revisi', 'Diterima', 'Ditolak'],
                series: [{{ $pending }}, {{ $revisi }}, {{ $diterima }},
                    {{ $ditolak }}
                ],
                colors: ['#FFB74D', '#4FC3F7', '#81C784', '#E57373'],
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new ApexCharts(document.querySelector("#pieChart"), options);
            chart.render();
        });
    </script>
@endsection
