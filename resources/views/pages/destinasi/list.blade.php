@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="container" style="max-width: 1350px;">
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Destinasi</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-4 pt-3 ps-3 pe-3">
            <h2 class="h4">Destinasi</h2>
            <a href="/destinasi/create" class="btn btn-primary me-2">
                <span data-feather="plus"></span> Tambah
            </a>
        </div>
        <div class="card-body">

            <!-- Filter -->
            <div class="d-flex flex-wrap align-items-center mb-4">
                <div class="me-3">
                    <label for="startDate" class="form-label mb-1">Dari Tanggal</label>
                    <input type="date" id="startDate" class="form-control form-control-sm"
                        value="{{ now()->toDateString() }}">
                </div>
                <div class="me-3">
                    <label for="endDate" class="form-label mb-1">Sampai Tanggal</label>
                    <input type="date" id="endDate" class="form-control form-control-sm"
                        value="{{ now()->toDateString() }}">
                </div>
                <div class="me-3">
                    <label for="entries" class="form-label mb-1">Show</label>
                    <select id="entries" class="form-select form-select-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="ms-auto">
                    <label for="search" class="form-label mb-1">Search</label>
                    <input type="search" id="search" class="form-control form-control-sm" placeholder="Cari data...">
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kontak</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($destinasis as $destinasi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $destinasi->nama }}</td>
                            <td>{{ $destinasi->alamat }}</td>
                            <td>{{ $destinasi->kontak }}</td>
                            <td>
                                <a href="{{ route('destinasi.edit', $destinasi->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('destinasi.destroy', $destinasi->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No data available in table</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <p class="text-muted mb-0">Showing {{ $destinasis->firstItem() }} to {{ $destinasis->lastItem() }} of
                    {{ $destinasis->total() }} entries</p>
                {{ $destinasis->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
// Tambahkan JavaScript jika perlu untuk interaksi tabel/filter
</script>
@endsection