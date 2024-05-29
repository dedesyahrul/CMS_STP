<?php

namespace App\Http\Controllers;
use App\Models\DataPerkara;
use App\Models\BarangBukti;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BarangBuktiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(DataPerkara $dataPerkara)
    {
        return view('barang_bukti.create', compact('dataPerkara'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, DataPerkara $dataPerkara)
    {
        // Validasi data yang diterima dari formulir jika diperlukan
        $request->validate([
            'nama_pemilik_barang_bukti' => 'required|string',
            'barang_bukti' => 'required|string',
            'foto_barang_bukti' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lokasi_barang_bukti' => 'required|string',
        ]);

        // Simpan foto barang bukti ke folder yang ditentukan
        $fotoBarangBukti = $request->file('foto_barang_bukti');
        $originalFileName = $fotoBarangBukti->getClientOriginalName();
        $token = Str::random(10);
        $date = Carbon::now()->format('Ymd');
        $newFileName = $token . '_' . $date . '_' . $originalFileName;
        $fotoBarangBukti->move(public_path('foto_barang_bukti'), $newFileName);

        // Simpan data barang bukti yang terkait dengan data perkara
        $dataPerkara->barangBuktis()->create([
            'nama_pemilik_barang_bukti' => $request->nama_pemilik_barang_bukti,
            'barang_bukti' => $request->barang_bukti,
            'foto_barang_bukti' => $newFileName,
            'lokasi_barang_bukti' => $request->lokasi_barang_bukti,
        ]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('data-perkaras.show', $dataPerkara->id)->with('success', 'Barang bukti berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        // Temukan barang bukti berdasarkan ID
        $barangBukti = BarangBukti::findOrFail($id);

        // Kembalikan view untuk mengedit barang bukti
        return view('barang_bukti.edit', compact('barangBukti'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBarangBukti(Request $request, $id)
    {
        $request->validate([
            'nama_pemilik_barang_bukti' => 'required|string',
            'barang_bukti' => 'required|string',
            'lokasi_barang_bukti' => 'required|string',
            'foto_barang_bukti' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $barangBukti = BarangBukti::findOrFail($id);

        $barangBukti->update([
            'nama_pemilik_barang_bukti' => $request->nama_pemilik_barang_bukti,
            'barang_bukti' => $request->barang_bukti,
            'lokasi_barang_bukti' => $request->lokasi_barang_bukti,
        ]);

        if ($request->hasFile('foto_barang_bukti')) {
            if (file_exists(public_path('foto_barang_bukti/' . $barangBukti->foto_barang_bukti))) {
                unlink(public_path('foto_barang_bukti/' . $barangBukti->foto_barang_bukti));
            }

            $fotoBarangBukti = $request->file('foto_barang_bukti');
            $originalFileName = $fotoBarangBukti->getClientOriginalName();
            $token = Str::random(10);
            $date = Carbon::now()->format('Ymd');
            $newFileName = $token . '_' . $date . '_' . $originalFileName;
            $fotoBarangBukti->move(public_path('foto_barang_bukti'), $newFileName);

            $barangBukti->update([
                'foto_barang_bukti' => $newFileName,
            ]);
        }

        // Redirect kembali ke halaman show data perkara dengan menyertakan ID data perkara
        return redirect()->route('data-perkaras.show', $barangBukti->data_perkara_id)->with('success', 'Barang Bukti berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
