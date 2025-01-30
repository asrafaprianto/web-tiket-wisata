@extends('layouts.app')

@section('css')

@endsection

@section('content')

<div class="container" style="max-width: 1350px">

    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="/transaksi">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Transaksi</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Tambah Transaksi</h2>
        <a href="{{ route('transaksi.index') }}" class="btn btn-warning">Kembali</a>
    </div>

    <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi">
        @csrf
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <!-- Card Informasi -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h6>Informasi</h6>
                        <table class="table table-bordered">
                            <tr>
                                <th>Destinasi</th>
                                <td>Kawasan Wisata Kasap</td>
                            </tr>
                            <tr>
                                <th>Petugas</th>
                                <td><span class="fs-6 text-capitalize">{{ Auth::user()->name }}</span></td>
                            </tr>
                            <tr>
                                <th>No. Telp</th>
                                <td>081234567890</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ date('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th>Jam</th>
                                <td id="currentTime"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Card Produk -->
                <div class="card">
                    <div class="card-body">
                        <h6>Pilih Produk</h6>
                        <div class="mb-3">
                            <label for="produk">Pilih Produk</label>
                            <select id="produk" class="form-select">
                                <option value="">-- Pilih Produk --</option>
                                @foreach($produks as $produk)
                                <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">
                                    {{ $produk->nama_produk }} - Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" id="qty" class="form-control" placeholder="Jumlah tiket">
                            <button type="button" class="btn btn-success" id="addProduk">+</button>
                        </div>
                        <table class="table table-bordered" id="produkTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <!-- Card Produk Ringkasan -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h6>Produk</h6>
                        <table class="table table-bordered">
                            <thead class="table-secondary">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ringkasanProduks as $index => $produk)
                                <tr>
                                    <td>{{ $ringkasanProduks->firstItem() + $index }}</td>
                                    <td>{{ $produk->nama_produk }}</td>
                                    <td>Rp{{ number_format($produk->harga, 2, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <p class="text-muted mb-0">
                                Showing {{ $ringkasanProduks->firstItem() ?? 0 }} to
                                {{ $ringkasanProduks->lastItem() ?? 0 }} of
                                {{ $ringkasanProduks->total() ?? 0 }} entries
                            </p>
                            {{ $ringkasanProduks->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
                <!-- Card Total dan Proses -->
                <div class="card">
                    <div class="card-body">
                        <h6>Ringkasan</h6>
                        <div class="mb-3">
                            <label for="totalTiket">Total Pembelian Tiket</label>
                            <input type="number" name="total_tiket" id="totalTiket" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="totalHarga">Total Harga</label>
                            <input type="number" name="total_harga" id="totalHarga" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="dibayar">Dibayar</label>
                            <input type="number" name="dibayar" id="dibayar" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="kembalian">Kembalian</label>
                            <input type="number" name="kembalian" id="kembalian" class="form-control" readonly>
                        </div>
                        <input type="hidden" name="produk" id="produkInput">
                        <input type="hidden" name="tanggal" value="{{ date('Y-m-d') }}"> <!-- Tambahan -->
                        <button type="button" class="btn btn-secondary" id="reset">Reset</button>
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
let produkList = [];

// Menambahkan produk
document.getElementById('addProduk').addEventListener('click', () => {
    const produkSelect = document.getElementById('produk');
    const qty = parseInt(document.getElementById('qty').value);

    if (!produkSelect.value || qty <= 0) {
        alert('Pilih produk dan masukkan jumlah yang valid.');
        return;
    }

    const nama = produkSelect.options[produkSelect.selectedIndex].text;
    const hargaSatuan = parseInt(produkSelect.options[produkSelect.selectedIndex].dataset.harga);
    const harga = hargaSatuan * qty;

    produkList.push({
        nama,
        qty,
        harga
    });
    renderProdukTable();
    updateSummary();
});

// Render tabel produk
function renderProdukTable() {
    const tbody = document.querySelector('#produkTable tbody');
    tbody.innerHTML = '';
    produkList.forEach((produk, index) => {
        tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${produk.nama}</td>
                <td>${produk.qty}</td>
                <td>${produk.harga}</td>
            </tr>`;
    });
    document.getElementById('produkInput').value = JSON.stringify(produkList);
}

// Validasi sebelum submit
document.getElementById('formTransaksi').addEventListener('submit', (e) => {
    if (produkList.length === 0) {
        e.preventDefault(); // Mencegah form terkirim
        alert('Produk belum ditambahkan ke daftar!');
    }
});

// Mengupdate ringkasan
function updateSummary() {
    const totalTiket = produkList.reduce((sum, produk) => sum + produk.qty, 0);
    const totalHarga = produkList.reduce((sum, produk) => sum + produk.harga, 0);

    document.getElementById('totalTiket').value = totalTiket;
    document.getElementById('totalHarga').value = totalHarga;
}

// Menghitung kembalian
document.getElementById('dibayar').addEventListener('input', () => {
    const totalHarga = parseInt(document.getElementById('totalHarga').value) || 0;
    const dibayar = parseInt(document.getElementById('dibayar').value) || 0;
    document.getElementById('kembalian').value = dibayar - totalHarga;
});

// Reset form
document.getElementById('reset').addEventListener('click', () => {
    produkList = [];
    document.getElementById('produk').value = '';
    document.getElementById('qty').value = '';
    renderProdukTable();
    updateSummary();
    document.getElementById('dibayar').value = '';
    document.getElementById('kembalian').value = '';
});

// Menampilkan jam real-time
function updateClock() {
    const now = new Date();
    const formattedTime = now.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    });
    document.getElementById('currentTime').textContent = formattedTime;
}

// Memperbarui jam setiap detik
setInterval(updateClock, 1000);
updateClock(); // Memastikan jam langsung muncul saat halaman dimuat
</script>
@endsection