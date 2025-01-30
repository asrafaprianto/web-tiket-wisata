<?php

namespace App\Http\Controllers;


use App\Exports\UserExport;
use App\Models\User;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::query();
        
        $sort = request('sort_val') ?? 'DESC';
        if(request('sort_name')=='name'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $user->orderBy('name', request('sort_val'));
}

if(request('sort_name')=='email'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $user->orderBy('email', request('sort_val'));
}

if(request('sort_name')=='email_verified_at'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $user->orderBy('email_verified_at', request('sort_val'));
}

if(request('sort_name')=='password'){
    $sort = $sort == 'DESC' ? 'ASC' : 'DESC';
    $user->orderBy('password', request('sort_val'));
}


        if(request('cari')){
    $user->where(function($q){
        $q->where('name','LIKE','%'.request('cari').'%')
->orWhere('email','LIKE','%'.request('cari').'%')
->orWhere('email_verified_at','LIKE','%'.request('cari').'%')
->orWhere('password','LIKE','%'.request('cari').'%');
    });
}

        $user = $user->orderBy('created_at', $sort)->paginate(10);


        return view('pages.user.index', [
            'data' => $user->withPath('user'),
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
        return view('pages.user.create',[]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ], [
        'name.required' => 'Nama wajib diisi!',
        'email.required' => 'Email wajib diisi!',
        'email.email' => 'Format email tidak valid!',
        'email.unique' => 'Email sudah digunakan!',
        'password.required' => 'Password wajib diisi!',
        'password.min' => 'Password minimal 6 karakter!',
    ]);

    // Simpan data ke database
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'email_verified_at' => now(), // Isi otomatis
        'password' => bcrypt($request->password), // Hash password
    ]);

    // Redirect ke halaman index dengan notifikasi sukses
    return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('pages.user.detail', [
            'data' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.user.edit', [
            'data' => $user,
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6',
    ], [
        'name.required' => 'Nama wajib diisi!',
        'email.required' => 'Email wajib diisi!',
        'email.email' => 'Format email tidak valid!',
        'email.unique' => 'Email sudah digunakan!',
        'password.min' => 'Password minimal 6 karakter!',
    ]);

    // Siapkan data yang akan diupdate
    $dataToUpdate = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // Jika password diisi, hash dan tambahkan ke data yang diupdate
    if ($request->password) {
        $dataToUpdate['password'] = bcrypt($request->password);
    }

    // Update data di database
    $user->update($dataToUpdate);

    // Redirect ke halaman index dengan notifikasi sukses
    return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
        $user->delete();
        return redirect('user')->with('success', 'Success delete data');
    }

    public function export()
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new UserImport, $request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);

        return redirect('/user')->with('success', 'All good!');
    }
}