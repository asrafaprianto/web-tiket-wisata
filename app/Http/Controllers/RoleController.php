<?php

namespace App\Http\Controllers;

use App\Exports\RoleExport;
use App\Models\Role;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::query();
        
        $sort = request('sort_val') ?? 'DESC';
        if(request('sort_name')=='role_id'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $role->orderBy('role_id', request('sort_val'));
}

if(request('sort_name')=='nama'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $role->orderBy('nama', request('sort_val'));
}


        if(request('cari')){
    $role->where(function($q){
        $q->where('role_id','LIKE','%'.request('cari').'%')
->orWhere('nama','LIKE','%'.request('cari').'%');
    });
}

        $role = $role->orderBy('created_at', $sort)->paginate()->withQueryString();

        return view('pages.role.list', [
            'data' => $role->withPath('role'),
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
        return view('pages.role.add',[]);
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
    'role_id' => 'required',
'nama' => 'required'
];

$messages = [
    'role_id.required' => 'ID Wajib terisi!',
'nama.required' => 'Nama Wajib terisi!'
];


        $request->validate($rules, $messages);
        $datarow = $request->all();

        

        Role::create($datarow);

        return redirect('role')->with('success', 'Success create data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('pages.role.detail', [
            'data' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('pages.role.edit', [
            'data' => $role,
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $rules =[
    'role_id' => 'required',
'nama' => 'required'
];

$messages = [
    'role_id.required' => 'ID Wajib terisi!',
'nama.required' => 'Nama Wajib terisi!'
];


        $request->validate($rules, $messages);
        $datarow = $request->all();

        

        $role->update($datarow);

        return redirect('role')->with('success', 'Success update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        
        $role->delete();
        return redirect('role')->with('success', 'Success delete data');
    }

    public function export()
    {
        return Excel::download(new RoleExport, 'roles.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new RoleImport, $request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);

        return redirect('/role')->with('success', 'All good!');
    }
}
