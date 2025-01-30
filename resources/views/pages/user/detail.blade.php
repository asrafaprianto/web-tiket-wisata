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
                <li class="breadcrumb-item active" aria-current="page">Show</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-content-center justify-content-between">
                <h4>Detail User</h4>
                <a href="/user" class="btn btn-warning">
                    <span data-feather="arrow-left"></span> Kembali
                </a>
            </div><br>
            <table class="table">
                <tr>
                    <th>Nama</th>
                    <td>{{$data->name}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$data->email}}</td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>{{$data->password}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@endsection

@section('js')
@endsection