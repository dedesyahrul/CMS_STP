<?php

namespace App\Http\Controllers;
use App\Models\BarangBukti;
use App\Models\DataPerkara;
use App\Models\PengambilanBarangBukti;
use App\Models\WilayahPengantar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PengambilanBarangBuktiController extends Controller
{
    public function create($barangBuktiId)
    {
        $barangBukti = BarangBukti::findOrFail($barangBuktiId);
        $dataPerkara = DataPerkara::findOrFail($barangBukti->data_perkara_id);
        $namaTersangka = $dataPerkara->nama_tersangka;
        $wilayahPengantars = WilayahPengantar::all();
        // dd($wilayahPengantars);

        return view('pengambilan_barang_bukti.create', compact('barangBukti', 'namaTersangka','wilayahPengantars'));
    }

    public function store(Request $request, $barangBuktiId)
    {
        $request->validate([
            'nama_tersangka' => 'required|string',
            'nama_pengambil_barang_bukti' => 'required_if:metode_pengambilan,Diantar|string',
            'nomor_hp' => 'required_if:metode_pengambilan,Diantar|string',
            'metode_pengambilan' => 'required|string',
            'tanggal_pengantaran' => 'required_if:metode_pengambilan,Diantar|date',
            'wilayah_pengantar' => 'required_if:metode_pengambilan,Diantar|string|nullable',
            'alamat_pengantaran' => 'required_if:metode_pengambilan,Diantar|string|nullable',
            'foto_ktp_kk_sim' => 'required_if:metode_pengambilan,Diantar|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penerima_kuasa' => 'required_if:metode_pengambilan,Diantar|image|mimes:jpeg,png,jpg,gif|max:2048',
            'surat_kuasa' => 'required_if:metode_pengambilan,Diantar|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penerima_surat_kuasa' => 'required_if:metode_pengambilan,Diantar|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $data = $request->only([
            'nama_tersangka', 'nama_pengambil_barang_bukti', 'nomor_hp', 'metode_pengambilan',
            'wilayah_pengantar', 'alamat_pengantaran', 'tanggal_pengantaran'
        ]);

        // Upload file 'foto_ktp_kk_sim' jika ada
        if ($request->hasFile('foto_ktp_kk_sim')) {
            $fileName = $request->file('foto_ktp_kk_sim')->getClientOriginalName();
            $request->file('foto_ktp_kk_sim')->move(public_path('uploads/ktp_kk_sim'), $fileName);
            $data['foto_ktp_kk_sim'] = $fileName;
        }

        // Upload file 'penerima_kuasa' jika ada
        if ($request->hasFile('penerima_kuasa')) {
            $fileName = $request->file('penerima_kuasa')->getClientOriginalName();
            $request->file('penerima_kuasa')->move(public_path('uploads/penerima_kuasa'), $fileName);
            $data['penerima_kuasa'] = $fileName;
        }

        // Upload file 'surat_kuasa' jika ada
        if ($request->hasFile('surat_kuasa')) {
            $fileName = $request->file('surat_kuasa')->getClientOriginalName();
            $request->file('surat_kuasa')->move(public_path('uploads/surat_kuasa'), $fileName);
            $data['surat_kuasa'] = $fileName;
        }

        // Upload file 'penerima_surat_kuasa' jika ada
        if ($request->hasFile('penerima_surat_kuasa')) {
            $fileName = $request->file('penerima_surat_kuasa')->getClientOriginalName();
            $request->file('penerima_surat_kuasa')->move(public_path('uploads/penerima_surat_kuasa'), $fileName);
            $data['penerima_surat_kuasa'] = $fileName;
        }

        $data['barang_bukti_id'] = $barangBuktiId;

        // Simpan data pengambilan barang bukti
        PengambilanBarangBukti::create($data);

        // Update status barang bukti
        $barangBukti = BarangBukti::find($barangBuktiId);
        $barangBukti->status = 'Proses';
        $barangBukti->save();

        $dataPerkaraId = $barangBukti->data_perkara_id;

        return redirect()->route('data-perkaras.show', $dataPerkaraId)->with('success', 'Permohonan pengambilan barang bukti berhasil diajukan.');
    }

    public function show($id)
    {
        $permohonan = PengambilanBarangBukti::findOrFail($id);
        $barangBukti = $permohonan->barangBukti;
        return view('pengambilan_barang_bukti.show', ['permohonan' => $permohonan, 'barangBukti' => $barangBukti]);
    }


    public function showSelesaiForm($id)
    {
        $barangBukti = BarangBukti::find($id);
        if (!$barangBukti) {
            // Tambahkan logika jika barang bukti tidak ditemukan
        }

        return view('barang_bukti.selesai', compact('barangBukti'));
    }

    public function complete(Request $request, $id)
    {
        $barangBukti = BarangBukti::find($id);

        // Validasi input
        $request->validate([
            'ba_serah_terima' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'd_serah_terima' => 'required|file|mimes:pdf,jpg,jpeg,png',
        ]);

        // Jika barang bukti ditemukan
        if ($barangBukti) {
            // Generate token dan tanggal
            $token = Str::random(10);
            $date = now()->format('Ymd');

            // Unggah berkas BA Serah Terima
            if ($request->hasFile('ba_serah_terima')) {
                $originalFileName = $request->file('ba_serah_terima')->getClientOriginalName();
                $fileName = $token . '_' . $date . '_' . $originalFileName;
                $request->file('ba_serah_terima')->move(public_path('uploads/ba_serah_terima'), $fileName);
                $barangBukti->ba_serah_terima = 'uploads/ba_serah_terima/' . $fileName;
            }

            // Unggah berkas D Serah Terima
            if ($request->hasFile('d_serah_terima')) {
                $originalFileName = $request->file('d_serah_terima')->getClientOriginalName();
                $fileName = $token . '_' . $date . '_' . $originalFileName;
                $request->file('d_serah_terima')->move(public_path('uploads/d_serah_terima'), $fileName);
                $barangBukti->d_serah_terima = 'uploads/d_serah_terima/' . $fileName;
            }

            $barangBukti->status = 'Selesai';
            $barangBukti->save();

            // Redirect ke halaman data perkara dengan pesan sukses
            return redirect()->route('data-perkaras.show', $barangBukti->data_perkara_id)->with('success', 'Pengambilan barang bukti berhasil diselesaikan.');
        }
    }

    public function downloadBeritaAcara($id)
    {
        $barangBukti = BarangBukti::findOrFail($id);
        $path = public_path($barangBukti->ba_serah_terima);
        
        if (file_exists($path)) {
            return response()->download($path);
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }

    public function downloadDokumentasi($id)
    {
        $barangBukti = BarangBukti::findOrFail($id);
        $path = public_path($barangBukti->d_serah_terima);
        
        if (file_exists($path)) {
            return response()->download($path);
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }



}
