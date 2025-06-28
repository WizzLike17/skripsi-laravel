@extends('layout.app')
@section('title', 'Validasi Pengajuan')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form method="GET" action="{{ route('sertifikat.hasil') }}" class="p-3">
            <div class="row g-2">
                <div class="col-md-2">
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari Mahasiswa / Kegiatan / Validator" value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-control">
                        <option value="">-- Semua Status --</option>
                        <option value="terima" {{ request('status') == 'terima' ? 'selected' : '' }}>Diterima</option>
                        <option value="tolak" {{ request('status') == 'tolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="revisi" {{ request('status') == 'revisi' ? 'selected' : '' }}>Revisi</option>

                    </select>
                </div>

                <div class="col-md-3">
                    <form method="GET" action="{{ route('sertifikat.hasil') }}"> <!-- Tambahkan method GET -->
                        <select name="periode_id" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Semua Periode --</option>
                            @foreach ($periodes as $periode)
                                <option value="{{ $periode->periode_id }}"
                                    {{ request('periode_id') == $periode->periode_id ? 'selected' : '' }}>
                                    {{ $periode->nama_periode }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bx bx-search"></i> Cari
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('sertifikat.hasil') }}" class="btn btn-secondary w-100">
                        <i class="bx bx-reset"></i> Reset
                    </a>
                </div>
            </div>
        </form>
        <div class="card">
            <h5 class="card-header">Daftar Validasi Pengajuan</h5>
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Kegiatan</th>
                            <th>Status</th>
                            <th>Nilai</th>
                            <th>Validator</th>
                            <th>Periode</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($sertifikat as $s)
                            <tr>
                                <td>{{ $s->mahasiswa->nama ?? '-' }}</td>
                                <td>{{ $s->mahasiswa->nim ?? '-' }}</td>
                                <td>
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
                                    <i class="icon-base bx {{ $icon }} icon-md {{ $color }} me-2"></i>
                                    <span>{{ $s->nama_kegiatan ?? '-' }}</span>
                                </td>
                                <td>
                                    @php
                                        $badgeClass = match ($s->status) {
                                            'pending' => 'bg-label-warning',
                                            'terima' => 'bg-label-success',
                                            'tolak' => 'bg-label-danger',
                                            'revisi' => 'bg-label-info',
                                            default => 'bg-label-secondary',
                                        };
                                    @endphp

                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($s->status) }}</span>
                                </td>
                                <td>{{ $s->nilai ?? '-' }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                            <img src="{{ asset('aa/assets/img/avatars/1.png') }}"
                                                alt="{{ $s->validator->nama ?? 'Validator' }}"
                                                class="w-px-40 h-auto rounded-circle">
                                        </div>
                                        <span>{{ $s->validator->nama ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>{{ $s->periode->nama_periode ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data pengajuan yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $sertifikat->links('pagination::bootstrap-5') }}
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('total') }}" class="btn btn-outline-success">
                <i class="bx bx-bar-chart-alt-2"></i> Lihat Hasil Total Sertifikat Tervalidasi
            </a>
        </div>
    </div>
@endsection
