<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratKuasa;
use Illuminate\Support\Facades\Storage;

class SuratKuasaApiController extends Controller
{
    public function index()
    {
        $suratKuasa = SuratKuasa::all();
        return response()->json($suratKuasa);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = 'files/surat-kuasa/' . $fileName;

            // Store the file
            $request->file('file')->move(public_path('files/surat-kuasa'), $fileName);

            $suratKuasa = SuratKuasa::create([
                'file_name' => $fileName,
                'file_path' => $filePath,
            ]);

            return response()->json([
                'success' => true,
                'data' => $suratKuasa,
                'message' => 'File telah berhasil diunggah.',
            ]);
        }

        return response()->json(['success' => false, 'message' => 'File upload failed.'], 400);
    }

    public function edit($id)
    {
        $suratKuasa = SuratKuasa::findOrFail($id);
        return response()->json($suratKuasa);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $suratKuasa = SuratKuasa::findOrFail($id);

        if ($request->file()) {
            // Delete old file
            if (file_exists(public_path($suratKuasa->file_path))) {
                unlink(public_path($suratKuasa->file_path));
            }

            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = 'files/surat-kuasa/' . $fileName;

            // Store new file
            $request->file('file')->move(public_path('files/surat-kuasa'), $fileName);

            // Update record
            $suratKuasa->update([
                'file_name' => $fileName,
                'file_path' => $filePath,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $suratKuasa,
            'message' => 'File telah berhasil diperbarui.',
        ]);
    }
}
