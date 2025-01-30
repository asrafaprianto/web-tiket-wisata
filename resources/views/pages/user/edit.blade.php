@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="container" style="max-width: 1350px;">
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/user">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-content-center justify-content-between">
                <h4>Ubah User</h4>
                <a href="/user" class="btn btn-warning">
                    <span data-feather="arrow-left"></span> Kembali
                </a>
            </div>
            <form method="POST" action="{{ route('user.update', $data->id) }}" id="formUser" novalidate>
                @method('PUT')
                <!-- Method override untuk update -->
                @csrf
                <!-- Token CSRF -->

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
                        class="form-control @error('password') is-invalid @enderror" id="password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Kosongi jika tidak ingin mengubah password</small>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

        </div>
    </div>
</div>

@endsection

@section('js')
@section('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Target input fields
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    // Kosongkan nilai yang diisi browser secara otomatis
    nameInput.value = "";
    emailInput.value = "";
    passwordInput.value = "";

    // Placeholder tetap ada
    nameInput.placeholder = "Masukkan nama pengguna";
    emailInput.placeholder = "Masukkan email pengguna";
    passwordInput.placeholder = "Kosongkan jika tidak ingin mengubah password";
});
</script>
@endsection