<?php

namespace App\Http\Controllers;

use App\Models\KebijakanPrivasi;
use Illuminate\Http\Request;

class KebijakanPrivasiController extends Controller
{
    public function index()
    {
        $kebijakanPrivasis = KebijakanPrivasi::all();
        return view('kebijakan_privasis.index', compact('kebijakanPrivasis'));
    }

    public function index_show()
    {
        $kebijakanPrivasis = KebijakanPrivasi::all();
        return view('kebijakan_privasis.show', compact('kebijakanPrivasis'));
    }

    public function create()
    {
        return view('kebijakan_privasis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);

        KebijakanPrivasi::create([
            'user_id' => auth()->user()->id,
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('kebijakan_privasis.index')
            ->with('success', 'Kebijakan Privasi berhasil ditambahkan.');
    }

    public function show(KebijakanPrivasi $kebijakanPrivasi)
    {
        return view('kebijakan_privasis.show', compact('kebijakanPrivasi'));
    }

    public function edit(KebijakanPrivasi $kebijakanPrivasi)
    {
        return view('kebijakan_privasis.edit', compact('kebijakanPrivasi'));
    }

    public function update(Request $request, KebijakanPrivasi $kebijakanPrivasi)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);

        $kebijakanPrivasi->update([
            'user_id' => auth()->user()->id,
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('kebijakan_privasis.index')
            ->with('success', 'Kebijakan Privasi berhasil diperbarui.');
    }

    public function destroy(KebijakanPrivasi $kebijakanPrivasi)
    {
        $kebijakanPrivasi->delete();

        return redirect()->route('kebijakan_privasis.index')
            ->with('success', 'Kebijakan Privasi berhasil dihapus.');
    }

}
