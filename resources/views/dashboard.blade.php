@extends('layout.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            {{-- Welcome Card --}}
            <div class="mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                <h3 class="card-title text-primary mb-3">Welcome, {{ auth()->user()->nama }}! 🎉</h3>
                                <p class="mb-0">Kamu telah mengumpulkan
                                    <span class="fw-bold">{{ $sertifikat->count() }}</span> sertifikat dari berbagai
                                    kegiatan. Berikut adalah status sertifikatmu:
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card-body">
                                <ul class="list-unstyled mb-4">
                                    <li><strong>Sertifikat Pending:</strong> {{ $sertifikatPending }}</li>
                                    <small>menunggu verivikasi dari validator </small>
                                    <li><strong>Sertifikat Revisi:</strong> {{ $sertifikatRevisi }}</li>
                                    <small>kamu harus memperbaiki sertifikat yang belum di terima</small>
                                    <li><strong>Sertifikat Diterima:</strong> {{ $sertifikatDiterima }}</li>
                                    <small>selamat sertifikat kamu sudah di terima</small>
                                    <li><strong>Sertifikat Ditolak:</strong> {{ $sertifikatDitolak }}</li>
                                    <small>kamu harus memperbaiki sertifikat yang di tolak</small>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card-body">
                                <div id="pieChart" style="height: 300px;"></div>
                            </div>
                        </div>
                        <div class="col-sm-4 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">

                                <img src="{{ asset('aa/assets/img/illustrations/man-with-laptop-light.png') }}"
                                    height="140" alt="User Illustration"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Alert Periode Aktif --}}
            @if ($periodeAktif)
                @php
                    $tanggalSelesai = \Carbon\Carbon::parse($periodeAktif->tanggal_selesai);
                    $hariTersisa = now()->diffInDays($tanggalSelesai, false);
                @endphp

                <div class="alert alert-info">
                    📢 Pengumpulan pada semester <strong>{{ $periodeAktif->nama_periode }}</strong> akan berakhir pada
                    <strong>{{ $tanggalSelesai->translatedFormat('d F Y') }}</strong> dan tersisa
                    <strong>
                        @if ($hariTersisa >= 0)
                            {{ $hariTersisa }} hari lagi.
                        @else
                            sudah lewat {{ abs($hariTersisa) }} hari yang lalu.
                        @endif
                    </strong>
                </div>
            @endif

            {{-- Summary Cards --}}
            <div class="col-lg-12 col-md-4 ">
                <div class="row">
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
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class="bx {{ $card['icon'] }} bx-sm {{ $card['color'] }}"
                                                style="white-space: nowrap;">{{ $card['title'] }}</i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ $card['route'] }}">Lihat Semua</a>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{ $card['count'] }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Riwayat Kegiatan --}}
        <div class="row mt-4">
            <div class="col-12">
                <h4 class="mb-3">Riwayat Kegiatan Terbaru</h4>
                @forelse ($items as $item)
                    @php
                        $icon = 'bxs-file';
                        $color = 'text-secondary';
                        $label = 'Umum';

                        switch ($item->type) {
                            case 'kompetisiMandiri':
                                $icon = 'bxs-trophy';
                                $color = 'text-warning';
                                $label = 'Kompetisi Mandiri';
                                break;
                            case 'aktifitas':
                                $icon = 'bxs-flag-checkered';
                                $color = 'text-primary';
                                $label = 'Aktivitas';
                                break;
                            case 'kemendikbud':
                                $icon = 'bxs-graduation';
                                $color = 'text-info';
                                $label = 'Kemendikbud';
                                break;
                            case 'mbkm':
                                $icon = 'bxs-book-open';
                                $color = 'text-success';
                                $label = 'MBKM';
                                break;
                            case 'rekognisi':
                                $icon = 'bx-badge-check';
                                $color = 'text-danger';
                                $label = 'Rekognisi';
                                break;
                        }
                    @endphp

                    <div class="card mb-3 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx {{ $icon }} bx-lg me-3 {{ $color }}"></i>
                            <div>
                                <h5 class="mb-1">{{ $item->nama_kegiatan ?? 'Tanpa Nama' }}</h5>
                                <small class="text-muted">Kategori: {{ $label }} | Tanggal:
                                    {{ $item->created_at->format('d M Y') }}</small>
                            </div>
                            <div class="ms-auto">
                                <h6 class="mb-0">
                                    @if ($item->status == 'pending')
                                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                                    @elseif ($item->status == 'terima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif ($item->status == 'revisi')
                                        <span class="badge bg-info">Revisi</span>
                                    @elseif ($item->status == 'tolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">Status Tidak Diketahui</span>
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">Belum ada riwayat kegiatan.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ApexCharts --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'pie',
                    height: 300,
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800
                    }
                },
                labels: ['Pending', 'Revisi', 'Diterima', 'Ditolak'],
                series: [
                    {{ $sertifikatPending }},
                    {{ $sertifikatRevisi }},
                    {{ $sertifikatDiterima }},
                    {{ $sertifikatDitolak }}
                ],
                colors: ['#FFB74D', '#4FC3F7', '#81C784', '#E57373'],
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Sertifikat"
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#pieChart"), options);
            chart.render();
        });
    </script>
@endsection
