<?php

namespace App\Http\Controllers;

use App\Models\PendapatHukum;
use Illuminate\Http\Request;

class PendapatHukumController extends Controller
{
    public function index()
    {
        $pendapatHukum = PendapatHukum::all();
        return view('pendapat_hukum.index', compact('pendapatHukum'));
    }

    public function create()
    {
        return view('pendapat_hukum.create');
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
        $unggahFile->move(public_path('files').'/pendapathukum/', $fileName);

        // Buat data bantuan hukum
        PendapatHukum::create([
            'user_id' => auth()->user()->id,
            'instansi' => $request->instansi,
            'perihal' => $request->perihal,
            'unggah_file' => $fileName,
        ]);

        return redirect()->route('pendapat_hukum.index')
            ->with('success', 'Bantuan Hukum berhasil ditambahkan.');
    }

    public function edit(PendapatHukum $pendapatHukum)
    {
        return view('pendapat_hukum.edit', compact('pendapatHukum'));
    }

    public function update(Request $request, PendapatHukum $pendapatHukum)
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
            $unggahFile->move(public_path('files').'/pendapathukum/', $fileName);

            // Hapus file lama
            if ($pendapatHukum->unggah_file && file_exists(public_path('files/'.'/pendapathukum/'. $pendapatHukum->unggah_file))) {
                unlink(public_path('files/'.'/pendapathukum/'. $pendapatHukum->unggah_file));
            }

            $pendapatHukum->unggah_file = $fileName;
        }

        $pendapatHukum->update([
            'instansi' => $request->instansi,
            'perihal' => $request->perihal,
        ]);

        return redirect()->route('pendapat_hukum.index')
            ->with('success', 'Bantuan Hukum berhasil diperbarui.');
    }

    public function destroy(PendapatHukum $pendapatHukum)
    {
        if ($pendapatHukum->unggah_file && file_exists(public_path('files/'.'/pendapathukum/'. $pendapatHukum->unggah_file))) {
            unlink(public_path('files/'.'/pendapathukum/'. $pendapatHukum->unggah_file));
        }

        $pendapatHukum->delete();

        return redirect()->route('pendapat_hukum.index')
            ->with('success', 'Pendapat Hukum berhasil dihapus.');
    }
}
