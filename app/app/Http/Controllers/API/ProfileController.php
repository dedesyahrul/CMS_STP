<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();

        return response()->json([
            'success' => true,
            'data' => $profiles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'description' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        $profile = Profile::create([
            'user_id' => auth()->user()->id,
            'address' => $request->address,
            'phone' => $request->phone,
            'description' => $request->description,
            'profile_image' => $imageName,
        ]);

        return response()->json([
            'success' => true,
            'data' => $profile,
            'message' => 'Profil berhasil dibuat'
        ]);
    }

    public function show(Profile $profile)
    {
        return response()->json([
            'success' => true,
            'data' => $profile
        ]);
    }

    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'description' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profile->address = $request->address;
        $profile->phone = $request->phone;
        $profile->description = $request->description;

        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image) {
                $oldImagePath = public_path('images') . '/' . $profile->profile_image;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $profile->profile_image = $imageName;
        }

        $profile->save();

        return response()->json([
            'success' => true,
            'data' => $profile,
            'message' => 'Profil berhasil diperbarui'
        ]);
    }

    public function destroy(Profile $profile)
    {
        if ($profile->profile_image) {
            $oldImagePath = public_path('images') . '/' . $profile->profile_image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }

        $profile->delete();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil dihapus'
        ]);
    }
}
