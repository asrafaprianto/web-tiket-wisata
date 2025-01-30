@extends('layouts.app')

@section('breadcrumb')
<div class="mt-4">

</div>
@endsection

@section('content')

<div class="container" style="max-width: 1350px;">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/destinasi">Destinasi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="card">
        <!-- Header Form -->
        <div class="d-flex justify-content-between align-items-center mb-4 pt-3 ps-3 pe-3">
            <h2 class="h4">Edit Destinasi</h2>
            <a href="/destinasi" class="btn btn-warning btn-sm">
                <span data-feather="arrow-left"></span> Kembali
            </a>
        </div>
        <div class="card-body">
            <!-- Form Input -->
            <form method="POST" action="{{ route('destinasi.update', $destinasi->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <!-- Input Nama -->
                        <div class="mb-3">
                            <label for="inputNama" class="form-label">Nama</label>
                            <input type="text" name="nama" value="{{ old('nama', $destinasi->nama) }}"
                                class="form-control @error('nama') is-invalid @enderror" id="inputNama">
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Kontak -->
                        <div class="mb-3">
                            <label for="inputKontak" class="form-label">Kontak</label>
                            <input type="text" name="kontak" value="{{ old('kontak', $destinasi->kontak) }}"
                                class="form-control @error('kontak') is-invalid @enderror" id="inputKontak">
                            @error('kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Alamat -->
                        <div class="mb-3">
                            <label for="inputAlamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="inputAlamat"
                                class="form-control @error('alamat') is-invalid @enderror"
                                rows="3">{{ old('alamat', $destinasi->alamat) }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Gambar -->
                        <div class="mb-3">
                            <label for="inputGambar" class="form-label">Gambar</label>
                            <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror"
                                id="inputGambar" accept="image/*">
                            @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if ($destinasi->gambar)
                            <img src="{{ asset('storage/' . $destinasi->gambar) }}" alt="{{ $destinasi->nama }}"
                                class="img-thumbnail mt-3" style="max-width: 200px;">
                            @endif
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <!-- Input Peraturan -->
                        <div class="mb-3">
                            <label for="inputPeraturan" class="form-label">Peraturan</label>
                            <textarea name="peraturan" id="inputPeraturan"
                                class="form-control @error('peraturan') is-invalid @enderror"
                                rows="10">{{ old('peraturan', $destinasi->peraturan) }}</textarea>
                            @error('peraturan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                <span data-feather="save"></span> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="mt-5 text-center">
    <p class="text-muted">2025 © Sentana Teknologi</p>
    <p>
        <a href="#" class="text-decoration-none">About</a> |
        <a href="#" class="text-decoration-none">Support</a> |
        <a href="#" class="text-decoration-none">Contact Us</a>
    </p>
</footer>
@endsection

@section('js')
<script>
// Tambahkan JavaScript jika perlu untuk interaksi tabel/filter
</script>
@endsection