@extends('layouts.app')

@section('css')


@endsection

@section('content')

<div class="container" style="max-width: 1350px;">
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-3 ps-3 pe-3">
            <h2 class="mt-3">Profile</h2>
            <a href="{{ route('profile.edit') }}" class="btn btn-warning">Edit</a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label"><strong>Nama</strong></label>
                <p class="form-control">{{ $profile->name }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Alamat</strong></label>
                <p class="form-control">{{ $profile->address }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Kontak</strong></label>
                <p class="form-control">{{ $profile->contact }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Peraturan</strong></label>
                <p class="form-control">{{ $profile->legal_info }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Logo</strong></label><br>
                @if($profile->logo)
                <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo" style="max-width: 250px;">
                @else
                <p class="text-muted">Belum ada logo.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection