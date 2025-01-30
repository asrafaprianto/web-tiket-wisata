<!DOCTYPE html>
<html>

<head>
    <title>Cetak Transaksi</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        /* background-color: #f9f9f9; */
    }


    .header {
        text-align: center;
        background-color: #f0f0f0;


        /* Warna latar belakang sementara untuk debugging */
    }

    .header img {
        width: 80px;
        margin-bottom: 10px;
    }

    .header h2 {
        margin: 0;
        font-size: 18px;
    }

    .header p {
        margin: 0;
        font-size: 12px;
    }

    .content {
        margin-top: 20px;
    }

    .content p {
        margin: 5px 0;
        font-size: 12px;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 12px;
    }

    .product-table th,
    .product-table td {
        padding: 5px;
        text-align: left;
    }

    .product-table th {
        border-bottom: 1px solid #ddd;
    }

    .product-table td {
        border-bottom: 1px dotted #ddd;
    }

    .footer {
        margin-top: 20px;
        text-align: center;
        font-size: 12px;
        color: #888;
    }

    .total {
        margin-top: 10px;
        font-weight: bold;
        font-size: 12px;
    }

    .receipt {
        width: 300px;
        margin: auto;
        background: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .content {
        display: flex;
        flex-direction: column;
        justify-content: start;
        text-align: start;
        column-gap: 10px;
    }

    .hero {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .content-detail {
        display: flex;
        flex-direction: column;
        justify-content: start;
        text-align: start;
    }

    .product-table {
        justify-content: center;

    }
    </style>
</head>

<body>
    <div class="receipt">


        <div class="content">
            <div class="hero">
                <img src="/resources/views/pages/transaksi/logo_hero.png" width="100px" height="100px" alt="">
                <p style="text-align: center; font-weight:700;">Kawasan Wisata Kasap</p><br>
            </div>
            <div class="content-detail">
                <p>Desa Watukaraung, Kec. Pringkuku, Kab. Pacitan</p>
                <p>Telepon: 08123456789</p>
                <p><strong>Nomor Transaksi:</strong> {{ $transaksi->no_transaksi }}</p>
                <p><strong>Tanggal:</strong> {{ $transaksi->tanggal }}</p>
                <p class="total"><strong>Total Harga:</strong> Rp
                    {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                </p>
                <p><strong>Dibayar:</strong> Rp {{ number_format($transaksi->dibayar, 0, ',', '.') }}</p>
                <p><strong>Kembalian:</strong> Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</p>
                <p class="fs-6 text-capitalize"><strong>Petugas: </strong><span class="text-capitalize"
                        style="text-transform: capitalize;">{{ Auth::user()->name }}</span></p>

            </div>

            <div class="table">
                <h4 class="table-title">Produk</h4>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi->produk as $index => $produk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $produk['nama'] }}</td>
                            <td>{{ $produk['qty'] }}</td>
                            <td>Rp {{ number_format($produk['harga'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <div class="footer">
            <p>Terima kasih telah berkunjung :)</p>
        </div>
    </div>
</body>

</html>