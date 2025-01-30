@extends('layouts.app')

@section('breadcrumb')
<div class="mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/transaksi">Transaksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex align-content-center justify-content-between">
            <h4>Detail Transaksi</h4>
            <a href="{{url(session('links')[1])}}" class="btn btn-warning">
                <span data-feather="arrow-left"></span> Kembali
            </a>
        </div>
        <table class="table">
            <tr>
                <th>Transaksi_id</th>
                <td>{{$data->transaksi_id}}</td>
            </tr>

            <tr>
                <th>No_transaksi</th>
                <td>{{$data->no_transaksi}}</td>
            </tr>

            <tr>
                <th>Tanggal</th>
                <td>{{$data->tanggal}}</td>
            </tr>

            <tr>
                <th>Subtotal</th>
                <td>{{$data->subtotal}}</td>
            </tr>

            <tr>
                <th>Diskon</th>
                <td>{{$data->diskon}}</td>
            </tr>

            <tr>
                <th>Total</th>
                <td>{{$data->total}}</td>
            </tr>

            <tr>
                <th>Dibayar</th>
                <td>{{$data->dibayar}}</td>
            </tr>

            <tr>
                <th>Kembalian</th>
                <td>{{$data->kembalian}}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>{{$data->status}}</td>
            </tr>


        </table>
    </div>
</div>
@endsection