@extends('layouts.app')

@section('breadcrumb')
<div class="mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Profile</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex align-content-center justify-content-between">
            <h4>Tambah Profile</h4>
            <a href="{{url(session('links')[1])}}" class="btn btn-warning">
                <span data-feather="arrow-left"></span> Kembali
            </a>
        </div>
        <form method="POST" class="" action="/profile" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="inputProfile_id" class="form-label">Profile_id</label>
                <input type="text" name="profile_id" value="{{old('profile_id')}}"
                    class="form-control @error('profile_id') is-invalid @enderror" id="inputprofile_id"
                    aria-describedby="profile_idHelp">
                @error('profile_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputNama" class="form-label">Nama</label>
                <input type="text" name="nama" value="{{old('nama')}}"
                    class="form-control @error('nama') is-invalid @enderror" id="inputnama" aria-describedby="namaHelp">
                @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputAlamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" value="{{old('alamat')}}"
                    class="form-control @error('alamat') is-invalid @enderror" id="inputalamat"
                    aria-describedby="alamatHelp">
                @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputPeraturan" class="form-label">Peraturan</label>
                <input type="text" name="peraturan" value="{{old('peraturan')}}"
                    class="form-control @error('peraturan') is-invalid @enderror" id="inputperaturan"
                    aria-describedby="peraturanHelp">
                @error('peraturan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputLogo" class="form-label">Logo</label>
                <input type="text" name="logo" value="{{old('logo')}}"
                    class="form-control @error('logo') is-invalid @enderror" id="inputlogo" aria-describedby="logoHelp">
                @error('logo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputKontak" class="form-label">Kontak</label>
                <input type="text" name="kontak" value="{{old('kontak')}}"
                    class="form-control @error('kontak') is-invalid @enderror" id="inputkontak"
                    aria-describedby="kontakHelp">
                @error('kontak')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection