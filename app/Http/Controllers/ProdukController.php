<?php

namespace App\Http\Controllers;

use App\Exports\ProdukExport;
use App\Models\Produk;
use App\Exports\TransaksiExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller {
    public function index() {
        $produks = Produk::paginate(10);
        return view('pages.produk.index', compact('produks'));
    }

    public function create() {
        return view('pages.produk.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric'
        ]);

        Produk::create([
            'produk_id' => Produk::generateProdukId(), // Produk ID unik
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id) {
        $produk = Produk::findOrFail($id);
        return view('pages.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric'
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id) {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
    public function export()
    {
        return Excel::download(new ProdukExport, 'produk.xlsx');
    }

    
}