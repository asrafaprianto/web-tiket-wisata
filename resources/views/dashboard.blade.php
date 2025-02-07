@extends('layouts.app')
@section('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
    rel="stylesheet">
@endsection

@section('content')
<div class="container" style="max-width: 1350px;">
    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            </ol>
        </nav>
    </div>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="d-flex align-items-center">
            <input type="date" class="form-control form-control-sm me-2" value="{{ now()->toDateString() }}">
            <a href="/transaksi/tambah"><button class="btn btn-primary ">Transaksi</button></a>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row mb-4">
        <!-- Total Retribusi Masuk -->
        <div class="col-md-6">
            <div class="card border-light shadow-sm w-100 text-bg-success">
                <div class="card-body text-center ">
                    <h5 class="card-title text-light">Total Retribusi Masuk</h5>
                    <p class="card-text text-light"
                        style="font-family: 'Nunito', sans-serif; font-weight: 700; font-size:2.5rem">
                        RP.
                        {{ number_format($totalRetribusi, 0, ',', '.') }}</p>
                    <small id="retribusiTime" class="text-light"></small>
                </div>
            </div>
        </div>
        <!-- Total Terjual -->
        <div class="col-md-6">
            <div class="card border-light shadow-sm w-100 text-bg-warning">
                <div class="card-body text-center">
                    <h5 class="card-title text-dark">Total Terjual</h5>
                    <p class="card-text text-dark"
                        style="font-family: 'Nunito', sans-serif; font-weight: 700; font-size:2.5rem">
                        {{ $totalTerjual }}</p>
                    <small id="terjualTime" class="text-dark"></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekap Destinasi Wisata -->
    <h2 class="h5 mb-3">Rekap Destinasi Wisata</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <!-- <th scope="col">No</th> -->
                    <th scope="col">Nama Destinasi</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach($rekapDestinasi as $nama_destinasi => $produkList)
                <tr>
                    <!-- <td rowspan="{{ count($produkList) }}">{{ $no++ }}</td> -->
                    <td rowspan="{{ count($produkList) }}">{{ $nama_destinasi }}</td>
                    @php $first = true; @endphp
                    @foreach($produkList as $nama_produk => $data)
                    @if(!$first)
                <tr>
                    @endif
                    <td>{{ $nama_produk }}</td>
                    <td>{{ $data['qty'] }}</td>
                    <td>RP. {{ number_format($data['total'], 0, ',', '.') }}</td>
                </tr>
                @php $first = false; @endphp
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

</div>


@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
</script>
<script src="/js/dashboard.js"></script>
<script>
// Function to update real-time clock
function updateClock() {
    const now = new Date();
    const formattedTime = now.toLocaleString('id-ID', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    document.getElementById('retribusiTime').textContent = formattedTime;
    document.getElementById('terjualTime').textContent = formattedTime;
}

// Update clock every second
setInterval(updateClock, 1000);
// Initialize clock immediately
updateClock();
</script>
@endsection