<?php

namespace App\Http\Controllers;

use App\Models\BantuanHukum;
use Illuminate\Http\Request;

class KelolaBantuanHukumController extends Controller
{
    // public function index()
    // {
    //     $bantuanHukum = BantuanHukum::all();
    //     return view('kelola_bantuan_hukum.index', compact('bantuanHukum'));
    // }

    // public function index()
    // {
    //     $entries = BantuanHukum::all(); // Mengambil semua data bantuan hukum

    //     return view('kelola_bantuan_hukum.index', compact('entries'));
    // }

    // public function index()
    // {
    //     $bantuanHukum = BantuanHukum::paginate(10);
    //     return view('kelola_bantuan_hukum.index', compact('bantuanHukum'));
    // }

    // public function index()
    // {
    //     $entries = 10; // Contoh nilai default untuk jumlah data per halaman
    //     $bantuanHukum = BantuanHukum::paginate($entries);
    //     return view('kelola_bantuan_hukum.index', compact('bantuanHukum', 'entries'));
    // }

    public function index(Request $request)
    {
        $entries = $request->input('entries', 10); // Mengambil nilai entries dari parameter request atau gunakan nilai default 10 jika tidak ada
        $bantuanHukum = BantuanHukum::paginate($entries);
        return view('kelola_bantuan_hukum.index', compact('bantuanHukum', 'entries'));
    }



    public function destroy(BantuanHukum $bantuanHukum)
    {
        // Hapus file yang terkait sebelum menghapus data bantuan hukum
        if ($bantuanHukum->unggah_file && file_exists(public_path('files/'.'/bantuanhukum/'. $bantuanHukum->unggah_file))) {
            unlink(public_path('files/'.'/bantuanhukum/'. $bantuanHukum->unggah_file));
        }

        $bantuanHukum->delete();

        return redirect()->route('kelola_bantuan_hukum.index')
            ->with('success', 'Bantuan Hukum berhasil dihapus.');
    }

}
