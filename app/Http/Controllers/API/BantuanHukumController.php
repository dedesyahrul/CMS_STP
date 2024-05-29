<?php

namespace App\Http\Controllers\API;

use App\Models\BantuanHukum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BantuanHukumController extends Controller
{
    public function index()
    {
        $bantuanHukum = BantuanHukum::all();
        return response()->json($bantuanHukum);
    }

    public function store(Request $request)
    {
        $request->validate([
            'instansi' => 'required',
            'perihal' => 'required',
            'unggah_file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $unggahFile = $request->file('unggah_file');
        $fileExtension = $unggahFile->getClientOriginalExtension();
        $fileName = time() . '.' . $fileExtension;
        $unggahFile->move(public_path('files').'/bantuanhukum/', $fileName);

        $bantuanHukum = BantuanHukum::create([
            'user_id' => auth()->user()->id,
            'instansi' => $request->instansi,
            'perihal' => $request->perihal,
            'unggah_file' => $fileName,
        ]);

        return response()->json($bantuanHukum, 201);
    }

    public function show(BantuanHukum $bantuanHukum)
    {
        return response()->json($bantuanHukum);
    }

    public function update(Request $request, BantuanHukum $bantuanHukum)
    {
        $request->validate([
            'instansi' => 'required',
            'perihal' => 'required',
            'unggah_file' => 'sometimes|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('unggah_file')) {
            $unggahFile = $request->file('unggah_file');
            $fileExtension = $unggahFile->getClientOriginalExtension();
            $fileName = time() . '.' . $fileExtension;
            $unggahFile->move(public_path('files').'/bantuanhukum/', $fileName);

            if ($bantuanHukum->unggah_file && file_exists(public_path('files/bantuanhukum/' . $bantuanHukum->unggah_file))) {
                unlink(public_path('files/bantuanhukum/' . $bantuanHukum->unggah_file));
            }

            $bantuanHukum->unggah_file = $fileName;
        }

        $bantuanHukum->update([
            'instansi' => $request->instansi,
            'perihal' => $request->perihal,
        ]);

        return response()->json($bantuanHukum);
    }

    public function destroy(BantuanHukum $bantuanHukum)
    {
        if ($bantuanHukum->unggah_file && file_exists(public_path('files/bantuanhukum/' . $bantuanHukum->unggah_file))) {
            unlink(public_path('files/bantuanhukum/' . $bantuanHukum->unggah_file));
        }

        $bantuanHukum->delete();

        return response()->json(null, 204);
    }
}
