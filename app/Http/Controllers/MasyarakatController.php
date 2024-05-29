<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;

class MasyarakatController extends Controller
{
    public function index()
    {
        $masyarakat = Masyarakat::all();
        return view('masyarakat.index', compact('masyarakat'));
    }

    public function create()
    {
        return view('masyarakat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:masyarakat',
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:masyarakat',
            'password' => 'required|min:6',
        ]);

        Masyarakat::create($request->all());
        return redirect()->route('masyarakat.index')->with('success', 'Masyarakat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        return view('masyarakat.edit', compact('masyarakat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:masyarakat,email,' . $id,
        ]);

        $masyarakat = Masyarakat::findOrFail($id);
        $masyarakat->update($request->all());

        return redirect()->route('masyarakat.index')->with('success', 'Masyarakat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        $masyarakat->delete();

        return redirect()->route('masyarakat.index')->with('success', 'Masyarakat berhasil dihapus.');
    }
}
