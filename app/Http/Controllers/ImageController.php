<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::paginate(5);
        return view('image.index', compact('images'));

    }

    public function create()
    {
        return view('image.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('file/imageslider'), $imageName);

        Image::create([
            'user_id' => auth()->id(), // Menggunakan auth()->id() langsung
            'image' => $imageName,
            'link' => $request->link,
            'description' => $request->description,
        ]);

        return redirect()->route('image.index')->with('success', 'Image created successfully.');
    }


    public function edit(Image $image)
    {
        return view('image.edit', compact('image'));
    }

    public function update(Request $request, Image $image)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            // Hapus file gambar lama jika ada
            if ($image->image && file_exists(public_path('file/imageslider/' . $image->image))) {
                unlink(public_path('file/imageslider/' . $image->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('file/imageslider'), $imageName);

            $image->update([
                'user_id' => auth()->user()->id,
                'image' => $imageName,
                'link' => $request->link,
                'description' => $request->description,
            ]);
        } else {
            $image->update([
                'user_id' => auth()->user()->id,
                'link' => $request->link,
                'description' => $request->description,
            ]);
        }

        return redirect()->route('image.index')->with('success', 'Image updated successfully.');
    }




    public function destroy(Image $image)
    {
        // Hapus file yang terkait sebelum menghapus data image
        if ($image->image && file_exists(public_path('file/imageslider/' . $image->image))) {
            unlink(public_path('file/imageslider/' . $image->image));
        }

        $image->delete();

        return redirect()->route('image.index')->with('success', 'Image deleted successfully.');
    }
}
