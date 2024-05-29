<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\DataPerkara;
use App\Models\BarangBukti;

use Illuminate\Http\Request;

class DataPerkaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10); // Default 10 entries

        // Menggunakan paginate dan dengan relasi barangBukti
        $dataPerkaras = DataPerkara::with('barangBukti')->orderBy('created_at', 'desc')->paginate($entries);

        return view('data_perkara.index', compact('dataPerkaras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_perkara.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'no_putusan_perkara' => 'required|string',
            'tanggal_putusan' => 'required|date',
            'nama_tersangka' => 'required|string',
        ]);

        // Simpan data_perkaras
        $dataPerkara = DataPerkara::create([
            'no_putusan_perkara' => $request->no_putusan_perkara,
            'tanggal_putusan' => $request->tanggal_putusan,
            'nama_tersangka' => $request->nama_tersangka,
        ]);

        // Redirect ke formulir tambah barang bukti dengan menyertakan ID data perkara yang baru saja ditambahkan
        return redirect()->route('data-perkaras.index', ['dataPerkaraId' => $dataPerkara->id])->with('success', 'Data perkara berhasil disimpan. Silakan tambahkan barang bukti.');
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
        return view('data_perkara.show', compact('dataPerkara'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Temukan data perkara berdasarkan ID
        $dataPerkara = DataPerkara::findOrFail($id);

        // Temukan barang bukti yang terkait dengan data perkara
        $barangBukti = BarangBukti::where('data_perkara_id', $dataPerkara->id)->first();

        // Return the view for editing data perkara and barang bukti
        return view('data_perkara.edit', compact('dataPerkara', 'barangBukti'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDataPerkara(Request $request, $id)
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
        return redirect()->route('data-perkaras.show', $dataPerkara->id)->with('success', 'Data Perkara berhasil diperbarui.');

        // return redirect()->route('data-perkaras.index')->with('success', 'Data Perkara berhasil diperbarui.');
    }

    


    //  public function update(Request $request, $id)
    //  {
    //      $request->validate([
    //          'no_putusan_perkara' => 'required|string',
    //          'tanggal_putusan' => 'required|date',
    //          'nama_tersangka' => 'required|string',
    //          'nama_pemilik_barang_bukti' => 'required|string',
    //          'barang_bukti' => 'required|string',
    //          'lokasi_barang_bukti' => 'required|string',
    //          'foto_barang_bukti' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //      ]);

    //      // Temukan data_perkara yang akan diupdate
    //      $dataPerkara = DataPerkara::findOrFail($id);

    //      // Update data_perkara
    //      $dataPerkara->update([
    //          'no_putusan_perkara' => $request->no_putusan_perkara,
    //          'tanggal_putusan' => $request->tanggal_putusan,
    //          'nama_tersangka' => $request->nama_tersangka,
    //      ]);

    //      // Temukan barang_bukti yang terkait dengan data_perkara
    //      $barangBukti = BarangBukti::where('data_perkara_id', $dataPerkara->id)->first();

    //      // Update barang_bukti
    //      $barangBukti->update([
    //          'nama_pemilik_barang_bukti' => $request->nama_pemilik_barang_bukti,
    //          'barang_bukti' => $request->barang_bukti,
    //          'lokasi_barang_bukti' => $request->lokasi_barang_bukti,
    //      ]);

    //      // Cek apakah ada file foto_barang_bukti yang diupload
    //      if ($request->hasFile('foto_barang_bukti')) {
    //          // Hapus foto_barang_bukti yang lama (jika ada)
    //          if (file_exists(public_path('foto_barang_bukti/' . $barangBukti->foto_barang_bukti))) {
    //              unlink(public_path('foto_barang_bukti/' . $barangBukti->foto_barang_bukti));
    //          }

    //          // Mengunggah foto_barang_bukti yang baru dan mendapatkan nama file
    //          $fileName = $request->file('foto_barang_bukti')->getClientOriginalName();
    //          $request->file('foto_barang_bukti')->move(public_path('foto_barang_bukti'), $fileName);

    //          // Update path foto_barang_bukti pada barang_bukti
    //          $barangBukti->update([
    //              'foto_barang_bukti' => $fileName,
    //          ]);
    //      }

    //      // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
    //      return redirect()->route('data-perkaras.index')->with('success', 'Data berhasil diperbarui.');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan data perkara berdasarkan ID
        $dataPerkara = DataPerkara::findOrFail($id);

        // Lakukan proses penghapusan data perkara
        $dataPerkara->delete();

        // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
        return redirect()->route('data-perkaras.index')->with('success', 'Data berhasil dihapus.');
    }
}
