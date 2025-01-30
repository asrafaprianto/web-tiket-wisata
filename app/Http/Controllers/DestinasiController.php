<?php

namespace App\Http\Controllers;

use App\Exports\DestinasiExport;
use App\Models\Destinasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DestinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $destinasi = Destinasi::query();

    // Default sorting value
    $sort = request('sort_val') ?? 'DESC';

    // Sorting based on request parameters
    if (request('sort_name')) {
        $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
        $destinasi->orderBy(request('sort_name'), $sort);
    }

    // Search functionality
    if (request('cari')) {
        $destinasi->where(function ($q) {
            $q->where('destinasi_id', 'LIKE', '%' . request('cari') . '%')
                ->orWhere('nama', 'LIKE', '%' . request('cari') . '%')
                ->orWhere('gambar', 'LIKE', '%' . request('cari') . '%')
                ->orWhere('alamat', 'LIKE', '%' . request('cari') . '%')
                ->orWhere('kontak', 'LIKE', '%' . request('cari') . '%')
                ->orWhere('peraturan', 'LIKE', '%' . request('cari') . '%');
        });
    }

    // Final ordering and pagination
    $destinasi = $destinasi->orderBy('created_at', $sort)->paginate(10)->withQueryString();

    return view('pages.destinasi.list', [
        'destinasis' => $destinasi, // Pastikan variabel ini sesuai dengan yang digunakan di view
        'sort' => $sort
    ]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.destinasi.add',[]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =[
            'nama' => 'required',
            'gambar' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
            'peraturan' => 'required'
        ];

        $messages = [
            'nama.required' => 'Nama Wajib terisi!',
            'gambar.required' => 'Gambar Wajib terisi!',
            'alamat.required' => 'Alamat Wajib terisi!',
            'kontak.required' => 'Kontak Wajib terisi!',
            'peraturan.required' => 'Peraturan Wajib terisi!'
        ];

        $request->validate($rules, $messages);
        $datarow = $request->all();

        // Isi nilai destinasi_id secara otomatis dengan format unik
        $datarow['destinasi_id'] = $this->generateDestinasiId();

        if($request->file('gambar')){
            $path = $request->file('gambar')->store('upload','public');
            $datarow['gambar'] = $path;
        }

        Destinasi::create($datarow);

        return redirect('destinasi')->with('success', 'Success create data');
    }

    /**
     * Generate a unique destinasi_id with format DST-001, DST-002, etc.
     *
     * @return string
     */
    private function generateDestinasiId()
    {
        $lastDestinasi = Destinasi::orderBy('destinasi_id', 'desc')->first();
        if (! $lastDestinasi) {
            $number = 1;
        } else {
            $lastId = $lastDestinasi->destinasi_id;
            $number = intval(substr($lastId, 4)) + 1;
        }
        return 'DST-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Destinasi $destinasi)
    {
        return view('pages.destinasi.detail', [
            'data' => $destinasi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    // Mengambil data destinasi berdasarkan ID
    $destinasi = Destinasi::findOrFail($id);

    // Mengirim data ke view edit.blade.php
    return view('pages.destinasi.edit', compact('destinasi'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required',
            'gambar' => 'sometimes|nullable|image',
            'alamat' => 'required',
            'kontak' => 'required',
            'peraturan' => 'required'
        ];
    
        $messages = [
            'nama.required' => 'Nama Wajib terisi!',
            'gambar.image' => 'Gambar harus berupa file gambar!',
            'alamat.required' => 'Alamat Wajib terisi!',
            'kontak.required' => 'Kontak Wajib terisi!',
            'peraturan.required' => 'Peraturan Wajib terisi!'
        ];
    
        $request->validate($rules, $messages);
        $datarow = $request->all();
    
        // Mengambil data destinasi berdasarkan ID
        $destinasi = Destinasi::findOrFail($id);
    
        // Mengupdate data destinasi
        if ($request->file('gambar')) {
            // Menghapus gambar lama jika ada
            if ($destinasi->gambar) {
                Storage::delete('public/' . $destinasi->gambar);
            }
            // Menyimpan gambar baru
            $path = $request->file('gambar')->store('upload', 'public');
            $datarow['gambar'] = $path;
        } else {
            // Jika gambar tidak diubah, hapus dari array data
            unset($datarow['gambar']);
        }
    
        $destinasi->update($datarow);
    
        return redirect('destinasi')->with('success', 'Success update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destinasi $destinasi)
    {
        if($destinasi->gambar) {
            Storage::disk('public')->delete($destinasi->gambar);
        }

        $destinasi->delete();
        return redirect('destinasi')->with('success', 'Success delete data');
    }

    public function export()
    {
        return Excel::download(new DestinasiExport, 'destinasis.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new DestinasiImport, $request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);

        return redirect('/destinasi')->with('success', 'All good!');
    }
}