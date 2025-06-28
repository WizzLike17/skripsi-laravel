@extends('layout.app')
@section('title', 'Validasi Pengajuan')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Daftar Validasi Pengajuan</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead class="table-dark text-center">
                        <thead class="table-dark text-center">
                            <tr>
                                <th class="border-end">Nama Mahasiswa</th>
                                <th class="border-end">Kegiatan</th>
                                <th class="border-end">Status</th>
                                <th class="border-end">Nilai</th>
                                <th class="border-end">Validator</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($sertifikat as $s)
                            @php
                                // Default icon and color
                                $icon = 'bxs-file';
                                $color = 'text-secondary';
                                $status = null;

                                if ($s->kompetisiMandiri) {
                                    $icon = 'bxs-trophy';
                                    $color = 'text-warning';
                                    $status = $s->kompetisiMandiri->status ?? null;
                                } elseif ($s->aktifitas) {
                                    $icon = 'bxs-flag-checkered';
                                    $color = 'text-primary';
                                    $status = $s->aktifitas->status ?? null;
                                } elseif ($s->kemendikbud) {
                                    $icon = 'bxs-graduation';
                                    $color = 'text-info';
                                    $status = $s->kemendikbud->status ?? null;
                                } elseif ($s->mbkm) {
                                    $icon = 'bxs-book-open';
                                    $color = 'text-success';
                                    $status = $s->mbkm->status ?? null;
                                } elseif ($s->rekognisi) {
                                    $icon = 'bx-badge-check';
                                    $color = 'text-danger';
                                    $status = $s->rekognisi->status ?? null;
                                }

                                $statusText = ucfirst($status ?? 'Unknown');
                                $badgeClass = 'bg-label-secondary';

                                switch ($status) {
                                    case 'pending':
                                        $badgeClass = 'bg-label-warning';
                                        break;
                                    case 'approved':
                                    case 'terima':
                                        $badgeClass = 'bg-label-success';
                                        $statusText = 'Approved';
                                        break;
                                    case 'rejected':
                                    case 'tolak':
                                        $badgeClass = 'bg-label-danger';
                                        $statusText = 'Rejected';
                                        break;
                                    case 'revisi':
                                        $badgeClass = 'bg-label-info';
                                        break;
                                }
                            @endphp
                            <tr>
                                <td>{{ $s->mahasiswa->nama ?? '-' }}</td>
                                <td>
                                    <i class="icon-base bx {{ $icon }} icon-md {{ $color }} me-2"></i>
                                    {{ $s->nama_kegiatan }}
                                </td>
                                <td>
                                    <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
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
                                <td>
                                    @if (in_array($status, ['pending']))
                                        <a href="{{ route('sertifikat.show', $s->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bx bx-check-circle"></i> Validasi
                                        </a>
                                    @elseif ($status === 'revisi')
                                        <span class="text-success">Revisi</span>
                                    @else
                                        <span class="text-primary">Divalidasi</span>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Data pengajuan tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
