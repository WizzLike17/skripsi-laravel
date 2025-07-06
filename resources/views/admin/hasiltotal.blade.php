@extends('layout.app')
@section('title', 'Hasil Total Sertifikat')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form id="filterForm" method="GET" action="{{ route('total') }}" class="p-3">
            <form method="GET" action="{{ route('total') }}" class="p-3">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama atau NIM"
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="periode_id" class="form-control">
                            <option value="" disabled selected>-- Semua Periode --</option>

                            @foreach ($periodes as $periode)
                                <option value="{{ $periode->periode_id }}"
                                    {{ request('periode_id', $periodeAktif->periode_id ?? '') == $periode->periode_id ? 'selected' : '' }}>
                                    {{ $periode->nama_periode }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bx bx-search"></i> Cari
                        </button>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('total') }}" class="btn btn-secondary w-100">
                            <i class="bx bx-reset"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </form>

        <div class="card mt-4">
            <h5 class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <span class="mb-2 mb-md-0">Hasil Total Sertifikat Mahasiswa</span>
            </h5>

            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Kegiatan</th>
                            <th>Nilai</th>
                            <th>Total Nilai</th>
                            <th>Hasil (Total Nilai / 5)</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($mahasiswaSertifikat as $item)
                            <tr>
                                <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                                <td>{{ $item->mahasiswa->nim ?? '-' }}</td>
                                <td>
                                    @foreach ($item->sertifikat as $s)
                                        @php
                                            $icon = 'bxs-file';
                                            $color = 'text-secondary';

                                            if ($s->kompetisiMandiri) {
                                                $icon = 'bxs-trophy';
                                                $color = 'text-warning';
                                            } elseif ($s->aktifitas) {
                                                $icon = 'bxs-flag-checkered';
                                                $color = 'text-primary';
                                            } elseif ($s->kemendikbud) {
                                                $icon = 'bxs-graduation';
                                                $color = 'text-info';
                                            } elseif ($s->mbkm) {
                                                $icon = 'bxs-book-open';
                                                $color = 'text-success';
                                            } elseif ($s->rekognisi) {
                                                $icon = 'bx-badge-check';
                                                $color = 'text-danger';
                                            }
                                        @endphp
                                        <div class="d-flex align-items-center mb-1">
                                            <i
                                                class="icon-base bx {{ $icon }} icon-md {{ $color }} me-2"></i>
                                            <span>{{ $s->nama_kegiatan ?? '-' }}</span>
                                        </div>
                                    @endforeach

                                    @if ($item->sertifikat->isEmpty())
                                        <span>-</span>
                                    @endif
                                </td>
                                <td>
                                    @foreach ($item->sertifikat as $s)
                                        <div class="mb-1">
                                            {{ $s->nilai ?? '-' }}
                                        </div>
                                    @endforeach

                                    @if ($item->sertifikat->isEmpty())
                                        <span>-</span>
                                    @endif
                                </td>
                                <td>{{ $item->total_nilai ?? '0' }}</td>
                                <td><span>{{ number_format($item->hasil, 2) }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data total sertifikat mahasiswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $mahasiswaSertifikat->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>

            <div class="mt-3 ms-3">
                <a href="{{ route('sertifikat.hasil') }}" class="btn btn-outline-secondary mb-3 ms-3">
                    <i class="bx bx-left-arrow-alt"></i> Kembali ke Daftar Pengajuan
                </a>
                <a href="{{ route('sertifikat.export') }}" class="btn btn-success mb-3 ms-3">
                    <i class="bx bx-export me-1"></i> Export Excel
                </a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('filterForm').addEventListener('submit', function(e) {
            const url = new URL(window.location.href);
            url.searchParams.delete('page'); // Hapus page parameter
            window.history.replaceState({}, document.title, url.toString()); // Update URL tanpa reload
        });
    </script>

@endsection
