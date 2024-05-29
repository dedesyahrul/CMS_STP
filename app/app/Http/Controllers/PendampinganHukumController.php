<?php

namespace App\Http\Controllers;

use App\Models\PendampinganHukum;
use Illuminate\Http\Request;

class PendampinganHukumController extends Controller
{
    public function index()
    {
        $pendampinganHukum = PendampinganHukum::all();
        return view('pendampingan_hukum.index', compact('pendampinganHukum'));
    }

    public function create()
    {
        return view('pendampingan_hukum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'instansi' => 'required',
            'perihal' => 'required',
            'unggah_file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        // Simpan file yang diunggah ke folder "files" pada direktori public
        $unggahFile = $request->file('unggah_file');
        $fileExtension = $unggahFile->getClientOriginalExtension();
        $fileName = time() . '.' . $fileExtension;
        $unggahFile->move(public_path('files').'/pendampinganhukum/', $fileName);

        // Buat data bantuan hukum
        PendampinganHukum::create([
            'user_id' => auth()->user()->id,
            'instansi' => $request->instansi,
            'perihal' => $request->perihal,
            'unggah_file' => $fileName,
        ]);

        return redirect()->route('pendampingan_hukum.index')
            ->with('success', 'Bantuan Hukum berhasil ditambahkan.');
    }

    public function edit(PendampinganHukum $pendampinganHukum)
    {
        return view('pendampingan_hukum.edit', compact('pendampinganHukum'));
    }

    public function update(Request $request, PendampinganHukum $pendampinganHukum)
    {
        $request->validate([
            'instansi' => 'required',
            'perihal' => 'required',
            'unggah_file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        // Jika ada file yang diunggah, simpan file baru dan hapus file lama
        if ($request->hasFile('unggah_file')) {
            $unggahFile = $request->file('unggah_file');
            $fileExtension = $unggahFile->getClientOriginalExtension();
            $fileName = time() . '.' . $fileExtension;
            $unggahFile->move(public_path('files').'/pendampinganhukum/', $fileName);

            // Hapus file lama
            if ($pendampinganHukum->unggah_file && file_exists(public_path('files/'.'/pendampinganhukum/'. $pendampinganHukum->unggah_file))) {
                unlink(public_path('files/'.'/pendampinganhukum/'. $pendampinganHukum->unggah_file));
            }

            $pendampinganHukum->unggah_file = $fileName;
        }

        $pendampinganHukum->update([
            'instansi' => $request->instansi,
            'perihal' => $request->perihal,
        ]);

        return redirect()->route('pendampingan_hukum.index')
            ->with('success', 'Bantuan Hukum berhasil diperbarui.');
    }

    public function destroy(PendampinganHukum $pendampinganHukum)
    {
        if ($pendampinganHukum->unggah_file && file_exists(public_path('files/'.'/pendampinganhukum/'. $pendampinganHukum->unggah_file))) {
            unlink(public_path('files/'.'/pendampinganhukum/'. $pendampinganHukum->unggah_file));
        }

        $pendampinganHukum->delete();

        return redirect()->route('pendampingan_hukum.index')
            ->with('success', 'Bantuan Hukum berhasil dihapus.');
    }
}
