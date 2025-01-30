@extends('layouts.app')

@section('breadcrumb')
<div class="mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex align-content-center justify-content-between">
            <h4>Detail Profile</h4>
            <a href="{{url(session('links')[1])}}" class="btn btn-warning">
                <span data-feather="arrow-left"></span> Kembali
            </a>
        </div>
        <table class="table">
            <tr>
                <th>Profile_id</th>
                <td>{{$data->profile_id}}</td>
            </tr>

            <tr>
                <th>Nama</th>
                <td>{{$data->nama}}</td>
            </tr>

            <tr>
                <th>Alamat</th>
                <td>{{$data->alamat}}</td>
            </tr>

            <tr>
                <th>Peraturan</th>
                <td>{{$data->peraturan}}</td>
            </tr>

            <tr>
                <th>Logo</th>
                <td>{{$data->logo}}</td>
            </tr>

            <tr>
                <th>Kontak</th>
                <td>{{$data->kontak}}</td>
            </tr>


        </table>
    </div>
</div>
@endsection