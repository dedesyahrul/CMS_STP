<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKuasa;
use Illuminate\Support\Facades\Storage;

class SuratKuasaController extends Controller
{
    public function index()
    {
        $suratKuasa = SuratKuasa::all();
        return view('surat_kuasa.index', compact('suratKuasa'));
    }

    public function create()
    {
        return view('surat_kuasa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = public_path('files/surat-kuasa');

            // Move the file to the public/uploads directory
            $request->file('file')->move($filePath, $fileName);

            SuratKuasa::create([
                'file_name' => $fileName,
                'file_path' => 'files/surat-kuasa/' . $fileName
            ]);

            return back()
                ->with('success','File telah berhasil diunggah.')
                ->with('file', $fileName);
        }
    }

    public function edit($id)
    {
        $suratKuasa = SuratKuasa::findOrFail($id);
        return view('surat_kuasa.edit', compact('suratKuasa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $suratKuasa = SuratKuasa::findOrFail($id);

        if ($request->file()) {
            // Hapus file lama
            if (file_exists(public_path($suratKuasa->file_path))) {
                unlink(public_path($suratKuasa->file_path));
            }

            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = public_path('files/surat-kuasa');

            // Pindahkan file ke direktori files/surat-kuasa
            $request->file('file')->move($filePath, $fileName);

            // Update data
            $suratKuasa->update([
                'file_name' => $fileName,
                'file_path' => 'files/surat-kuasa/' . $fileName
            ]);
        }

        return redirect()->route('surat_kuasa.index')
            ->with('success', 'File telah berhasil diperbarui.');
    }
}
