<?php

namespace App\Http\Controllers;

use App\Models\BantuanHukum;
use Illuminate\Http\Request;

class BantuanHukumController extends Controller
{
    public function index()
    {
        $bantuanHukum = BantuanHukum::all();
        return view('bantuan_hukum.index', compact('bantuanHukum'));
    }

    public function create()
    {
        return view('bantuan_hukum.create');
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
        $unggahFile->move(public_path('files').'/bantuanhukum/', $fileName);

        // Buat data bantuan hukum
        BantuanHukum::create([
            'user_id' => auth()->user()->id,
            'instansi' => $request->instansi,
            'perihal' => $request->perihal,
            'unggah_file' => $fileName,
        ]);

        return redirect()->route('bantuan_hukum.index')
            ->with('success', 'Bantuan Hukum berhasil ditambahkan.');
    }

    public function edit(BantuanHukum $bantuanHukum)
    {
        return view('bantuan_hukum.edit', compact('bantuanHukum'));
    }

    public function update(Request $request, BantuanHukum $bantuanHukum)
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
            $unggahFile->move(public_path('files').'/bantuanhukum/', $fileName);

            // Hapus file lama
            if ($bantuanHukum->unggah_file && file_exists(public_path('files/'.'/bantuanhukum/'. $bantuanHukum->unggah_file))) {
                unlink(public_path('files/'.'/bantuanhukum/'. $bantuanHukum->unggah_file));
            }

            $bantuanHukum->unggah_file = $fileName;
        }

        // Update data bantuan hukum
        $bantuanHukum->update([
            'instansi' => $request->instansi,
            'perihal' => $request->perihal,
        ]);

        return redirect()->route('bantuan_hukum.index')
            ->with('success', 'Bantuan Hukum berhasil diperbarui.');
    }

    public function destroy(BantuanHukum $bantuanHukum)
    {
        // Hapus file yang terkait sebelum menghapus data bantuan hukum
        if ($bantuanHukum->unggah_file && file_exists(public_path('files/'.'/bantuanhukum/'. $bantuanHukum->unggah_file))) {
            unlink(public_path('files/'.'/bantuanhukum/'. $bantuanHukum->unggah_file));
        }

        $bantuanHukum->delete();

        return redirect()->route('bantuan_hukum.index')
            ->with('success', 'Bantuan Hukum berhasil dihapus.');
    }
}
