@extends('layout.app')
@section('title', 'Daftar Periode')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h1>Daftar Periode</h1>

    <a href="{{ route('periodes.create') }}" class="btn btn-success mb-3">Tambah Periode</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Jenis Periode</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periodes as $periode)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($periode->tanggal_mulai)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($periode->tanggal_selesai)->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($periode->jenis_periode) }}</td>
                    <td>
                        <form action="{{ route('periodes.toggleStatus', $periode->periode_id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="statusSwitch{{ $periode->periode_id }}" 
                                    onchange="this.form.submit()" {{ $periode->status ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusSwitch{{ $periode->periode_id }}">
                                    {{ $periode->status ? 'Aktif' : 'Tidak Aktif' }}
                                </label>
                            </div>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('periodes.edit', $periode->periode_id) }}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
