<?php

namespace App\Http\Controllers;

use App\Models\AuditHukum;
use Illuminate\Http\Request;

class AuditHukumController extends Controller
{
    public function index()
    {
        $auditHukum = AuditHukum::all();
        return view('audit_hukum.index', compact('auditHukum'));
    }

    public function create()
    {
        return view('audit_hukum.create');
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
        $unggahFile->move(public_path('files').'/audithukum/', $fileName);

        // Buat data bantuan hukum
        AuditHukum::create([
            'user_id' => auth()->user()->id,
            'instansi' => $request->instansi,
            'perihal' => $request->perihal,
            'unggah_file' => $fileName,
        ]);

        return redirect()->route('audit_hukum.index')
            ->with('success', 'Bantuan Hukum berhasil ditambahkan.');
    }

    public function edit(AuditHukum $auditHukum)
    {
        return view('audit_hukum.edit', compact('auditHukum'));
    }

    public function update(Request $request, AuditHukum $auditHukum)
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
            $unggahFile->move(public_path('files').'/audithukum/', $fileName);

            // Hapus file lama
            if ($auditHukum->unggah_file && file_exists(public_path('files/'.'/audithukum/'. $auditHukum->unggah_file))) {
                unlink(public_path('files/'.'/audithukum/'. $auditHukum->unggah_file));
            }

            $auditHukum->unggah_file = $fileName;
        }

        $auditHukum->update([
            'instansi' => $request->instansi,
            'perihal' => $request->perihal,
        ]);

        return redirect()->route('audit_hukum.index')
            ->with('success', 'Bantuan Hukum berhasil diperbarui.');
    }

    public function destroy(AuditHukum $auditHukum)
    {
        if ($auditHukum->unggah_file && file_exists(public_path('files/'.'/audithukum/'. $auditHukum->unggah_file))) {
            unlink(public_path('files/'.'/audithukum/'. $auditHukum->unggah_file));
        }

        $auditHukum->delete();

        return redirect()->route('audit_hukum.index')
            ->with('success', 'Audit Hukum berhasil dihapus.');
    }
}
