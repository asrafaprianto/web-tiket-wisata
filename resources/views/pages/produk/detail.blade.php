@extends('layouts.app')

@section('breadcrumb')
<div class="mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/produk">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex align-content-center justify-content-between">
            <h4>Detail Produk</h4>
            <a href="{{url(session('links')[1])}}" class="btn btn-warning">
                <span data-feather="arrow-left"></span> Kembali
            </a>
        </div>
        <table class="table">
            <tr>
                <th>Produk_id</th>
                <td>{{$data->produk_id}}</td>
            </tr>

            <tr>
                <th>Destinasi_id</th>
                <td>{{$data->destinasi_id}}</td>
            </tr>

            <tr>
                <th>Nama</th>
                <td>{{$data->nama}}</td>
            </tr>

            <tr>
                <th>Harga</th>
                <td>{{$data->harga}}</td>
            </tr>

            <tr>
                <th>Catatan</th>
                <td>{{$data->catatan}}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>{{$data->status}}</td>
            </tr>


        </table>
    </div>
</div>
@endsection