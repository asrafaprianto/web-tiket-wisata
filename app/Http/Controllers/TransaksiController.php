<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::query();
    
        // Filter berdasarkan tanggal
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }
    
        // Filter berdasarkan nomor transaksi dengan case-insensitive
        if ($request->has('search') && $request->search !== null) {
            $query->whereRaw('LOWER(no_transaksi) LIKE ?', ['%' . strtolower($request->search) . '%']);
        }
    
        // Ambil data
        $transaksis = $query->orderBy('created_at', 'desc')->paginate(10);
    
        return view('pages.transaksi.index', compact('transaksis'));
    }
    
    public function update(Request $request, $id)
{
    // Cari data transaksi berdasarkan ID
    $transaksi = Transaksi::findOrFail($id);

    // Validasi input
    $request->validate([
        'total_tiket' => 'required|integer|min:1',
        'total_harga' => 'required|integer|min:1',
        'dibayar' => 'required|integer|min:0',
        'kembalian' => 'required|integer',
        'produk' => 'required|json', // Produk harus berupa JSON
    ]);

    // Perbarui data transaksi
    $transaksi->update([
        'tanggal' => $request->tanggal ?? $transaksi->tanggal, // Gunakan tanggal lama jika tidak diisi
        'total_tiket' => $request->total_tiket,
        'total_harga' => $request->total_harga,
        'dibayar' => $request->dibayar,
        'kembalian' => $request->kembalian,
        'produk' => $request->produk,
    ]);

    // Redirect ke halaman transaksi dengan pesan sukses
    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
}


public function cetak($id)
{
    $transaksi = Transaksi::findOrFail($id); // Ambil data transaksi berdasarkan ID

    $transaksi->produk = json_decode($transaksi->produk, true);

    // Load view cetak PDF dengan data transaksi
    $pdf = Pdf::loadView('pages.transaksi.cetak', compact('transaksi'));

    // Unduh file PDF
    return $pdf->download('Transaksi-' . $transaksi->no_transaksi . '.pdf');
}


public function create()
{
    $produks = Produk::all(); // Ambil semua data produk dari database untuk dropdown
    $ringkasanProduks = Produk::paginate(3); // Ambil data produk dengan pagination untuk ringkasan

    return view('pages.transaksi.create', compact('produks', 'ringkasanProduks'));
}

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'total_tiket' => 'required|integer|min:1',
            'total_harga' => 'required|integer|min:1',
            'dibayar' => 'required|integer|min:0',
            'kembalian' => 'required|integer',
            'produk' => 'required|json', // Produk harus berupa JSON
        ]);

        // generate no transaksi
        $noTransaksi = 'TRX-' . date('Ymd') . '-' . str_pad(Transaksi::count() + 1, 3, '0', STR_PAD_LEFT);

        // Simpan data ke database
        Transaksi::create([
            'no_transaksi' => $noTransaksi, // Buat nomor transaksi unik
            'tanggal' => now()->toDateString(),
            'total_tiket' => $request->input('total_tiket'),
            'total_harga' => $request->input('total_harga'),
            'dibayar' => $request->input('dibayar'),
            'kembalian' => $request->input('kembalian'),
            'produk' => $request->input('produk'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function destroy(Transaksi $transaksi)
    {
        
        $transaksi->delete();
        return redirect('transaksi')->with('success', 'Success delete data');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id); // Cari data transaksi berdasarkan ID
        $produks = Produk::all(); // Ambil semua data produk dari database
        return view('pages.transaksi.edit', compact('transaksi', 'produks')); // Tampilkan halaman edit
    }

public function dashboard()
{
    // Total retribusi masuk (total pemasukan)
    $totalRetribusi = Transaksi::sum('total_harga');

    // Total tiket terjual
    $totalTerjual = Transaksi::sum('total_tiket');

    // Rekap destinasi wisata
    $transaksiData = Transaksi::all();
    $rekapDestinasi = [];

    foreach ($transaksiData as $transaksi) {
        $produkList = is_string($transaksi->produk) ? json_decode($transaksi->produk, true) : $transaksi->produk;

        // Pastikan $produkList berupa array sebelum melakukan foreach
        if (is_array($produkList)) {
            foreach ($produkList as $produk) {
                $nama_destinasi = 'Kawasan Wisata Kasap'; // Nama destinasi tetap
                $nama_produk = $produk['nama'];
                $qty = $produk['qty'];
                $harga = $produk['harga'];

                if (!isset($rekapDestinasi[$nama_destinasi])) {
                    $rekapDestinasi[$nama_destinasi] = [];
                }

                if (!isset($rekapDestinasi[$nama_destinasi][$nama_produk])) {
                    $rekapDestinasi[$nama_destinasi][$nama_produk] = [
                        'qty' => 0,
                        'total' => 0
                    ];
                }

                $rekapDestinasi[$nama_destinasi][$nama_produk]['qty'] += $qty;
                $rekapDestinasi[$nama_destinasi][$nama_produk]['total'] += $harga;
            }
        }
    }

    return view('dashboard', compact(
        'totalRetribusi',
        'totalTerjual',
        'rekapDestinasi'
    ));
}

public function export()
    {
        return Excel::download(new TransaksiExport, 'transaksis.xlsx');
    }
}