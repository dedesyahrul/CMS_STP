<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataPerkara;

class DataPerkaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPerkaras = DataPerkara::with('barangBukti')->orderBy('created_at', 'desc')->get();

        return response()->json(['dataPerkaras' => $dataPerkaras], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_putusan_perkara' => 'required|string',
            'tanggal_putusan' => 'required|date',
            'nama_tersangka' => 'required|string',
        ]);

        $dataPerkara = DataPerkara::create([
            'no_putusan_perkara' => $request->no_putusan_perkara,
            'tanggal_putusan' => $request->tanggal_putusan,
            'nama_tersangka' => $request->nama_tersangka,
        ]);

        return response()->json(['message' => 'Data perkara berhasil disimpan.', 'dataPerkara' => $dataPerkara], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataPerkara = DataPerkara::findOrFail($id);
        return response()->json(['dataPerkara' => $dataPerkara], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_putusan_perkara' => 'required|string',
            'tanggal_putusan' => 'required|date',
            'nama_tersangka' => 'required|string',
        ]);

        $dataPerkara = DataPerkara::findOrFail($id);

        $dataPerkara->update([
            'no_putusan_perkara' => $request->no_putusan_perkara,
            'tanggal_putusan' => $request->tanggal_putusan,
            'nama_tersangka' => $request->nama_tersangka,
        ]);

        return response()->json(['message' => 'Data perkara berhasil diperbarui.', 'dataPerkara' => $dataPerkara], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataPerkara = DataPerkara::findOrFail($id);
        $dataPerkara->delete();
        return response()->json(['message' => 'Data perkara berhasil dihapus.'], 200);
    }
}
