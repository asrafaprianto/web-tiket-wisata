<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
{
    $profile = Profile::first(); // Ambil data pertama
    return view('pages.profile.index', compact('profile')); // Path view diperbarui
}

public function edit()
{
    $profile = Profile::first();
    return view('pages.profile.edit', compact('profile')); // Path view diperbarui
}

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'legal_info' => 'required',
            'logo' => 'nullable|image|max:2048',
        ]);

        $profile = Profile::first();

        // Jika ada file logo yang diunggah
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $profile->logo = $logoPath;
        }

        $profile->update($request->except('logo'));

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }

    
}