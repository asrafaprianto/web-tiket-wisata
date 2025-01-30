@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="container" style="max-width: 1350px">
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/user">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-content-center justify-content-between">
                <h4>Tambah User</h4>
                <a href="/user" class="btn btn-warning">
                    <span data-feather="arrow-left"></span> Kembali
                </a>
            </div>
            <!-- <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi"></form> -->
            <form method="POST" action="{{ route('user.store') }}" id="formUser">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" id="name">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" value="" placeholder="Masukkan email Anda"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" value="" placeholder="Masukkan password Anda"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Target input fields
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    // Set placeholder
    emailInput.placeholder = "Masukkan email Anda";
    passwordInput.placeholder = "Masukkan password Anda";

    // Kosongkan value saat halaman dimuat
    emailInput.value = "";
    passwordInput.value = "";

    document.getElementById('email').value = "";
    document.getElementById('password').value = "";
});
</script>


@endsection