<?php

namespace App\Http\Controllers\API;

use App\Models\BarangBukti;
use App\Models\DataPerkara;
use App\Models\PengambilanBarangBukti;
use App\Models\WilayahPengantar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PengambilanBarangBuktiController extends Controller
{
    public function index()
    {
        $pengambilanBarangBukti = PengambilanBarangBukti::all();
        return response()->json($pengambilanBarangBukti);
    }

    public function create($barangBuktiId)
    {
        $barangBukti = BarangBukti::findOrFail($barangBuktiId);
        $dataPerkara = DataPerkara::findOrFail($barangBukti->data_perkara_id);
        $namaTersangka = $dataPerkara->nama_tersangka;
        $wilayahPengantars = WilayahPengantar::all();

        return response()->json([
            'barangBukti' => $barangBukti,
            'namaTersangka' => $namaTersangka,
            'wilayahPengantars' => $wilayahPengantars
        ]);
    }

    public function getWilayahPengantar()
    {
        $wilayahPengantar = WilayahPengantar::all();
        return response()->json($wilayahPengantar);
    }


    public function store(Request $request, $barangBuktiId)
    {
    
        // Define validation rules
        $rules = [
            'nama_tersangka' => 'required|string',
            'nama_pengambil_barang_bukti' => 'required|string',
            'nomor_hp' => 'required|string',
            'metode_pengambilan' => 'required|string',
        ];
    
        // Additional rules based on metode_pengambilan
        if ($request->input('metode_pengambilan') === 'Diantar') {
            $rules = array_merge($rules, [
                'wilayah_pengantar' => 'required|string',
                'alamat_pengantaran' => 'required|string',
                'tanggal_pengantaran' => 'required|date',
                'foto_ktp_kk_sim' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        } elseif ($request->input('metode_pengambilan') === 'Ambil Sendiri') {
            $rules['tanggal_pengantaran'] = 'required|date';
            $rules['foto_ktp_kk_sim'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // For FormTidak
            $rules = array_merge($rules, [
                'wilayah_pengantar' => 'required|string',
                'alamat_pengantaran' => 'required|string',
                'tanggal_pengantaran' => 'required|date',
                'foto_ktp_kk_sim' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'penerima_kuasa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'surat_kuasa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'penerima_surat_kuasa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $data = $request->only([
            'nama_tersangka', 'nama_pengambil_barang_bukti', 'nomor_hp', 'metode_pengambilan',
            'wilayah_pengantar', 'alamat_pengantaran', 'tanggal_pengantaran'
        ]);
    
        if ($request->hasFile('foto_ktp_kk_sim')) {
            $fileName = time() . '_' . $request->file('foto_ktp_kk_sim')->getClientOriginalName();
            $request->file('foto_ktp_kk_sim')->move(public_path('uploads/ktp_kk_sim'), $fileName);
            $data['foto_ktp_kk_sim'] = $fileName;
        }
    
        if ($request->hasFile('penerima_kuasa')) {
            $fileName = time() . '_' . $request->file('penerima_kuasa')->getClientOriginalName();
            $request->file('penerima_kuasa')->move(public_path('uploads/penerima_kuasa'), $fileName);
            $data['penerima_kuasa'] = $fileName;
        }
    
        if ($request->hasFile('surat_kuasa')) {
            $fileName = time() . '_' . $request->file('surat_kuasa')->getClientOriginalName();
            $request->file('surat_kuasa')->move(public_path('uploads/surat_kuasa'), $fileName);
            $data['surat_kuasa'] = $fileName;
        }
    
        if ($request->hasFile('penerima_surat_kuasa')) {
            $fileName = time() . '_' . $request->file('penerima_surat_kuasa')->getClientOriginalName();
            $request->file('penerima_surat_kuasa')->move(public_path('uploads/penerima_surat_kuasa'), $fileName);
            $data['penerima_surat_kuasa'] = $fileName;
        }
    
        $data['barang_bukti_id'] = $barangBuktiId;
    
        $pengambilanBarangBukti = PengambilanBarangBukti::create($data);
    
        $barangBukti = BarangBukti::find($barangBuktiId);
        $barangBukti->status = 'Proses';
        $barangBukti->save();
    
        return response()->json($pengambilanBarangBukti, 201);
    }

    public function show($id)
    {
        $permohonan = PengambilanBarangBukti::findOrFail($id);
        return response()->json($permohonan);
    }

    public function showSelesaiForm($id)
    {
        $barangBukti = BarangBukti::find($id);
        if (!$barangBukti) {
            return response()->json(['error' => 'Barang Bukti not found'], 404);
        }

        return response()->json($barangBukti);
    }

    public function complete(Request $request, $id)
    {
        $barangBukti = BarangBukti::find($id);

        $request->validate([
            'ba_serah_terima' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'd_serah_terima' => 'required|file|mimes:pdf,jpg,jpeg,png',
        ]);

        if ($barangBukti) {
            if ($request->hasFile('ba_serah_terima')) {
                $fileName = time() . '_' . $request->file('ba_serah_terima')->getClientOriginalName();
                $request->file('ba_serah_terima')->move(public_path('uploads/ba_serah_terima'), $fileName);
                $barangBukti->ba_serah_terima = 'uploads/ba_serah_terima/' . $fileName;
            }

            if ($request->hasFile('d_serah_terima')) {
                $fileName = time() . '_' . $request->file('d_serah_terima')->getClientOriginalName();
                $request->file('d_serah_terima')->move(public_path('uploads/d_serah_terima'), $fileName);
                $barangBukti->d_serah_terima = 'uploads/d_serah_terima/' . $fileName;
            }

            $barangBukti->status = 'Selesai';
            $barangBukti->save();

            return response()->json($barangBukti);
        } else {
            return response()->json(['error' => 'Barang Bukti not found'], 404);
        }
    }
}
