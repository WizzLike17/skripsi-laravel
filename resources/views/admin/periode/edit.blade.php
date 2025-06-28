@extends('layout.app')
@section('title', 'Edit Periode')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2>Edit Periode</h2>

        {{-- Tampilkan error validasi jika ada --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('periodes.update', $periode) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            {{-- Tanggal Mulai --}}
            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                    value="{{ old('tanggal_mulai', $periode->tanggal_mulai ? $periode->tanggal_mulai->format('Y-m-d') : '') }}">
                <div class="invalid-feedback">Tanggal mulai wajib diisi.</div>
            </div>

            {{-- Tanggal Selesai --}}
            <div class="mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                    value="{{ old('tanggal_selesai', $periode->tanggal_selesai ? $periode->tanggal_selesai->format('Y-m-d') : '') }}">
                <div class="invalid-feedback">Tanggal selesai wajib diisi dan harus setelah tanggal mulai.</div>
            </div>

            {{-- Jenis Periode --}}
            <div class="mb-3">
                <label for="jenis_periode" class="form-label">Jenis Periode</label>
                <select name="jenis_periode" id="jenis_periode" class="form-select" required>
                    <option value="" disabled
                        {{ old('jenis_periode', $periode->jenis_periode) == null ? 'selected' : '' }}>
                        -- Pilih Jenis --
                    </option>
                    <option value="ganjil"
                        {{ old('jenis_periode', $periode->jenis_periode) == 'ganjil' ? 'selected' : '' }}>
                        Ganjil
                    </option>
                    <option value="genap" {{ old('jenis_periode', $periode->jenis_periode) == 'genap' ? 'selected' : '' }}>
                        Genap
                    </option>
                </select>
                <div class="invalid-feedback">Jenis periode wajib dipilih.</div>
            </div>

            {{-- Status Aktif --}}
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                    {{ old('status', $periode->status) ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Aktifkan Periode Ini</label>
            </div>

            {{-- Tombol Kembali dan Update --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('periodes.index') }}" class="btn btn-secondary">Kembali ke Daftar Periode</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>



    <script>
        // Bootstrap 5 form validation
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })();
    </script>
@endsection
