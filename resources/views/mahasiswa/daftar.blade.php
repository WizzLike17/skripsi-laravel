@extends('layout.app')
@section('title', 'Daftar Pengajuan')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Daftar Pengajuan Sertifikat</h5>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Jenis Sertifikat</th>
                            <th>Status</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Aksi</th> {{-- Kolom Aksi --}}
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($sertifikat as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    {{-- Ikon Kegiatan --}}
                                    @php
                                        $icon = 'bxs-file';
                                        $color = 'text-secondary';
                                        if ($item->kompetisiMandiri) {
                                            $icon = 'bxs-trophy';
                                            $color = 'text-warning';
                                        } elseif ($item->aktifitas) {
                                            $icon = 'bxs-flag-checkered';
                                            $color = 'text-primary';
                                        } elseif ($item->kemendikbud) {
                                            $icon = 'bxs-graduation';
                                            $color = 'text-info';
                                        } elseif ($item->mbkm) {
                                            $icon = 'bxs-book-open';
                                            $color = 'text-success';
                                        } elseif ($item->rekognisi) {
                                            $icon = 'bx-badge-check';
                                            $color = 'text-danger';
                                        }
                                    @endphp
                                    <i class="bx {{ $icon }} me-2 icon-base {{ $color }}"></i>
                                    {{ $item->nama_kegiatan }}
                                </td>
                                <td>
                                    @if ($item->kompetisiMandiri)
                                        Kompetisi Mandiri
                                    @elseif($item->aktifitas)
                                        Aktifitas Mahasiswa
                                    @elseif($item->kemendikbud)
                                        Hibah Kemendikbud
                                    @elseif($item->mbkm)
                                        MBKM
                                    @elseif($item->rekognisi)
                                        Rekognisi
                                    @else
                                        Lainnya
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $statusBadge = 'bg-label-warning text-dark';
                                        $statusText = 'Pending';
                                        if ($item->status == 'terima') {
                                            $statusBadge = 'bg-label-success';
                                            $statusText = 'Diterima';
                                        } elseif ($item->status == 'tolak') {
                                            $statusBadge = 'bg-label-danger';
                                            $statusText = 'Ditolak';
                                        } elseif ($item->status == 'revisi') {
                                            $statusBadge = 'bg-label-info';
                                            $statusText = 'Revisi';
                                        }
                                    @endphp
                                    <span class="badge {{ $statusBadge }}">{{ $statusText }}</span>
                                </td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>

                                {{-- Aksi: Tampilkan hanya jika status masih bisa diedit --}}
                                <td>
                                    @if (in_array($item->status, ['pending', 'revisi']))
                                        <form action="{{ route('hapus', $item->id) }}" method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bx bx-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">Tidak tersedia</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
