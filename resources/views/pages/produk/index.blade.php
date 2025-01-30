@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="container" style="max-width: 1350px;">
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-4 pt-3 ps-3 pe-3">
            <h2 class="h4">Produk</h2>
            <a href="{{ route('produk.create') }}" class="btn btn-primary me-2">
                <span data-feather="plus"></span> Tambah
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Produk ID</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produks as $produk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $produk->produk_id }}</td>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>Rp{{ number_format($produk->harga, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('produk.edit', $produk->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <p class="text-muted mb-0">
                    Showing {{ $produks->firstItem() ?? 0 }} to {{ $produks->lastItem() ?? 0 }} of
                    {{ $produks->total() ?? 0 }} entries
                </p>
                {{ $produks->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection