<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil semua data profil
        $profiles = Profile::all();

        return view('profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('profiles.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'description' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload gambar
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null; // Jika tidak ada gambar yang diunggah, set nilai gambar menjadi null
        }

        // Buat data profil baru
        Profile::create([
            'user_id' => auth()->user()->id,
            'address' => $request->address,
            'phone' => $request->phone,
            'description' => $request->description,
            'profile_image' => $imageName, // Simpan nama file gambar ke dalam kolom 'profile_image'
        ]);

        return redirect()->route('profiles.index')->with('success', 'Profil berhasil dibuat');
    }


    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }


    public function update(Request $request, Profile $profile)
    {
        // Validasi inputan
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'description' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update data profil
        $profile->address = $request->address;
        $profile->phone = $request->phone;
        $profile->description = $request->description;

        if ($request->hasFile('profile_image')) {
            // Hapus gambar lama jika ada
            if ($profile->profile_image) {
                $oldImagePath = public_path('images') . '/' . $profile->profile_image;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            // Upload gambar baru
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $profile->profile_image = $imageName;
        }

        $profile->save();

        return redirect()->route('profiles.index')->with('success', 'Profil berhasil diperbarui');
    }


    public function destroy(Profile $profile)
    {
        // Hapus data profil
        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Profil berhasil dihapus');
    }
}
