@extends('layouts.app')

@section('css')
<!-- Tambahkan CSS jika diperlukan -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('content')
<div class="container" style="max-width: 1350px">
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Transaksi</h2>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">+ Tambah</a>
    </div>

    <!-- Filter dan Pencarian -->
    <form method="GET" action="{{ route('transaksi.index') }}" class="mb-3">
        <div class="row align-items-center">
            <div class="col-md-3">
                <label for="start_date" class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date" class="form-control"
                    value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-3">
                <label for="search" class="form-label">Cari Nomor Transaksi</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Cari nomor transaksi"
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3 mt-4">
                <button type="submit" class="btn btn-success">Filter</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <!-- Tabel Data Transaksi -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>No Transaksi</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaksi->tanggal }}</td>
                        <td>{{ $transaksi->no_transaksi }}</td>
                        <td>
                            {{ $transaksi->status }}
                            <button class="btn btn-success btn-sm" disabled>
                                <i class="fas fa-check-circle"></i> Selesai
                            </button>
                        </td>
                        <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('transaksi.cetak', $transaksi->id) }}" class="btn btn-sm"
                                style="background-color: #6f42c1; color: white;">
                                <i class="fas fa-print"></i> Cetak
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-end mt-3">
                {{ $transaksis->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection