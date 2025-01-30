@extends('layouts.app')

@section('css')

@endsection

@section('content')

<div class="container" style="max-width: 1350px;">
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h3 class="mt-2 mb-3">Edit Profile</h3>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $profile->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea name="address" id="address" class="form-control"
                        required>{{ $profile->address }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Kontak</label>
                    <input type="text" name="contact" id="contact" class="form-control" value="{{ $profile->contact }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="legal_info" class="form-label">Peraturan</label>
                    <input type="text" name="legal_info" id="legal_info" class="form-control"
                        value="{{ $profile->legal_info }}" required>
                </div>
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" name="logo" id="logo" class="form-control">
                </div>
                <div class="d-flex justify-content-end">
                    <button type=" submit" class="btn btn-success">Save</button>
                </div>

            </form>
        </div>
    </div>

</div>

</div>
@endsection