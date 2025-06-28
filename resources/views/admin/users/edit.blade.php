@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h2>Edit User</h2>

    {{-- Menampilkan pesan sukses atau error --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Menampilkan error validasi jika ada --}}
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

    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input 
                type="text" 
                class="form-control" 
                id="nama" 
                name="nama" 
                value="{{ old('nama', $user->nama) }}" 
                required
            >
        </div>

        {{-- NIM --}}
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input 
                type="text" 
                class="form-control" 
                id="nim" 
                name="nim" 
                value="{{ old('nim', $user->nim) }}" 
                required
            >
        </div>

        {{-- Role --}}
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="validator" {{ old('role', $user->role) == 'validator' ? 'selected' : '' }}>Validator</option>
                <option value="mahasiswa" {{ old('role', $user->role) == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
            </select>
        </div>

        {{-- Foto Profil --}}
        <div class="mb-3">
            <label for="photo" class="form-label">Foto Profil</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
            @if ($user->photo)
                <div class="mt-2">
                    <img src="{{ asset($user->photo) }}" alt="Foto Profil" class="img-thumbnail" width="150">
                    <p class="mt-1">Foto Profil Saat Ini</p>
                </div>
            @endif
        </div>

        {{-- Tombol Kembali dan Update --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali ke Daftar User</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
