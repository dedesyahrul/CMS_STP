<?php

namespace App\Http\Controllers;

use App\Models\PelayananHukum;
use App\Models\Masyarakat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelayananHukumController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pelayananHukum = PelayananHukum::where('user_id', $user->id)->get();
        // $pelayananHukum = PelayananHukum::all();
        return view('pelayanan_hukum.index', compact('pelayananHukum'));
    }

    public function create()
    {
        // Ambil data masyarakats untuk mendapatkan NIK
        $masyarakats = Masyarakat::all(['nik']);

        $maxId = PelayananHukum::withTrashed()->max('id_pelayanan_hukum');
        $maxNum = (int)substr($maxId, 1); // ambil angka dari id_pelayanan_hukum terakhir
        $newIdNum = $maxNum + 1; // tambahkan 1 untuk membuat id_pelayanan_hukum baru
        $newId = 'P' . sprintf("%04d", $newIdNum); // format nomor baru menjadi string PXXXX

        return view('pelayanan_hukum.create', compact('newId','masyarakats'));
    }

    public function store(Request $request)
        {
            // Validasi input form
            $validatedData = $request->validate([
                'nik' => 'required',
                'nama' => 'required',
                'pertanyaan' => 'required',
                'nomor_hp' => 'required',
            ]);

            // Ambil data masyarakat berdasarkan user_id
            $masyarakat = Masyarakat::where('user_id', Auth::id())->first();

            $pelayananHukum = new PelayananHukum();
            $pelayananHukum->nik = $masyarakat->nik;
            $pelayananHukum->nama = $request->nama;
            $pelayananHukum->pertanyaan = $request->pertanyaan;
            $pelayananHukum->nomor_hp = $request->nomor_hp;
            $pelayananHukum->id_pelayanan_hukum = $request->id_pelayanan_hukum;
            $pelayananHukum->user_id = Auth::id();

            $pelayananHukum->save();

            return redirect()->route('pelayanan_hukum.index')
                ->with('success', 'Data Pelayanan Hukum berhasil ditambahkan.');
        }

    public function storec(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'pertanyaan' => 'required',
            'nomor_hp' => 'required',
            'id_pelayanan_hukum' => 'required',
        ]);

        PelayananHukum::create($request->all());

        return redirect()->route('pelayanan_hukum.index')
            ->with('success', 'Data Pelayanan Hukum berhasil ditambahkan.');
    }

    public function edit(PelayananHukum $pelayananHukum)
    {
        return view('pelayanan_hukum.edit', compact('pelayananHukum'));
    }

    public function update(Request $request, PelayananHukum $pelayananHukum)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'pertanyaan' => 'required',
            'nomor_hp' => 'required',
            'id_pelayanan_hukum' => 'required',
        ]);

        $pelayananHukum->update($request->all());

        return redirect()->route('pelayanan_hukum.index')
            ->with('success', 'Data Pelayanan Hukum berhasil diperbarui.');
    }

    public function destroy(PelayananHukum $pelayananHukum)
    {
        $pelayananHukum->delete();

        return redirect()->route('pelayanan_hukum.index')
            ->with('success', 'Data Pelayanan Hukum berhasil dihapus.');
    }
}
