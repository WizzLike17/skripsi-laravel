@extends('layout.app')
@section('title', 'Daftar Pengajuan')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">
                    <i class="bx bxs-book-open text-success me-2 bx-lg" style="margin-left: 10px;margin-top: 10px;"></i>
                    Daftar Pengajuan MBKM
                </h5>
            </div>

            <div class="mb-3 ms-3 mt-3">
                <a href="{{ route('pengajuan') }}" class="btn btn-outline-secondary text-black">
                    <i class="bx bx-arrow-back"></i> Kembali
                </a>
                <a href="{{ route('mbkm.create') }}" class="btn btn-primary ">
                    <i class="bx bx-plus"></i> Tambah Pengajuan
                </a>
            </div>

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
                            <th>Status</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($mbkm as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <i class="bx bxs-book-open text-success me-2"></i>
                                    {{ $item->nama_kegiatan }}
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
                                            $statusBadge = 'bg-label-info text-dark';
                                            $statusText = 'Revisi';
                                        }
                                    @endphp
                                    <span class="badge {{ $statusBadge }}">{{ $statusText }}</span>
                                </td>
                                <td>{{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}</td>
                                <td class="d-flex gap-1">
                                    @if(in_array($item->status, ['pending', 'revisi']))
                                        <a href="{{ route('mbkm.edit', $item->id_mbkm) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bx bx-edit"></i> Revisi
                                        </a>
                                    @endif

                                    <form action="{{ route('mbkm.destroy', $item->id_mbkm) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bx bx-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bx bx-info-circle"></i> Belum ada pengajuan MBKM.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
