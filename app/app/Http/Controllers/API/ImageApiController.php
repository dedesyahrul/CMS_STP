<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageApiController extends Controller
{

    public function index()
    {
        $images = Image::all();
        return response()->json($images);
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

        $image = Image::create([
            'user_id' => auth()->id(),
            'image' => $imageName,
            'link' => $request->link,
            'description' => $request->description,
        ]);

        return response()->json($image, 201);
    }

    public function update(Request $request, Image $image)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
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

        return response()->json($image);
    }

    public function destroy(Image $image)
    {
        if ($image->image && file_exists(public_path('file/imageslider/' . $image->image))) {
            unlink(public_path('file/imageslider/' . $image->image));
        }

        $image->delete();

        return response()->json(['message' => 'Image deleted successfully.']);
    }

}
