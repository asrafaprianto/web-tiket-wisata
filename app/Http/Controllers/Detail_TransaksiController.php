<?php

namespace App\Http\Controllers;

use App\Exports\Detail_TransaksiExport;
use App\Models\Detail_Transaksi;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Detail_TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detail__transaksi = Detail_Transaksi::query();
        
        $sort = request('sort_val') ?? 'DESC';
        if(request('sort_name')=='detail_transaksi_id'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $detail__transaksi->orderBy('detail_transaksi_id', request('sort_val'));
}

if(request('sort_name')=='transaksi_id'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $detail__transaksi->orderBy('transaksi_id', request('sort_val'));
}

if(request('sort_name')=='produk_id'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $detail__transaksi->orderBy('produk_id', request('sort_val'));
}

if(request('sort_name')=='qty'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $detail__transaksi->orderBy('qty', request('sort_val'));
}

if(request('sort_name')=='harga'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $detail__transaksi->orderBy('harga', request('sort_val'));
}

if(request('sort_name')=='total'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $detail__transaksi->orderBy('total', request('sort_val'));
}


        if(request('cari')){
    $detail__transaksi->where(function($q){
        $q->where('detail_transaksi_id','LIKE','%'.request('cari').'%')
->orWhere('transaksi_id','LIKE','%'.request('cari').'%')
->orWhere('produk_id','LIKE','%'.request('cari').'%')
->orWhere('qty','LIKE','%'.request('cari').'%')
->orWhere('harga','LIKE','%'.request('cari').'%')
->orWhere('total','LIKE','%'.request('cari').'%');
    });
}

        $detail__transaksi = $detail__transaksi->orderBy('created_at', $sort)->paginate()->withQueryString();

        return view('pages.detail__transaksi.list', [
            'data' => $detail__transaksi->withPath('detail__transaksi'),
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
        return view('pages.detail__transaksi.add',[]);
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
    'detail_transaksi_id' => 'required',
'transaksi_id' => 'required',
'produk_id' => 'required',
'qty' => 'required',
'harga' => 'required',
'total' => 'required'
];

$messages = [
    'detail_transaksi_id.required' => 'ID Wajib terisi!',
'transaksi_id.required' => 'Transaksi Wajib terisi!',
'produk_id.required' => 'Produk Wajib terisi!',
'qty.required' => 'Jumlah Wajib terisi!',
'harga.required' => 'Harga Wajib terisi!',
'total.required' => 'Total Wajib terisi!'
];


        $request->validate($rules, $messages);
        $datarow = $request->all();

        

        Detail_Transaksi::create($datarow);

        return redirect('detail__transaksi')->with('success', 'Success create data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Detail_Transaksi $detail__transaksi)
    {
        return view('pages.detail__transaksi.detail', [
            'data' => $detail__transaksi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail_Transaksi $detail__transaksi)
    {
        return view('pages.detail__transaksi.edit', [
            'data' => $detail__transaksi,
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail_Transaksi $detail__transaksi)
    {
        $rules =[
    'detail_transaksi_id' => 'required',
'transaksi_id' => 'required',
'produk_id' => 'required',
'qty' => 'required',
'harga' => 'required',
'total' => 'required'
];

$messages = [
    'detail_transaksi_id.required' => 'ID Wajib terisi!',
'transaksi_id.required' => 'Transaksi Wajib terisi!',
'produk_id.required' => 'Produk Wajib terisi!',
'qty.required' => 'Jumlah Wajib terisi!',
'harga.required' => 'Harga Wajib terisi!',
'total.required' => 'Total Wajib terisi!'
];


        $request->validate($rules, $messages);
        $datarow = $request->all();

        

        $detail__transaksi->update($datarow);

        return redirect('detail__transaksi')->with('success', 'Success update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail_Transaksi $detail__transaksi)
    {
        
        $detail__transaksi->delete();
        return redirect('detail__transaksi')->with('success', 'Success delete data');
    }

    public function export()
    {
        return Excel::download(new Detail_TransaksiExport, 'detail__transaksis.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new Detail_TransaksiImport, $request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);

        return redirect('/detail__transaksi')->with('success', 'All good!');
    }
}
