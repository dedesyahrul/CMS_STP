<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilanBarangBukti extends Model
{
    use HasFactory;
    protected $fillable = [
        'barang_bukti_id', 
        'nama_tersangka',
        'nama_pengambil_barang_bukti', 
        'nomor_hp',
        'metode_pengambilan', 
        'wilayah_pengantar', 
        'alamat_pengantaran', 
        'tanggal_pengantaran', 
        'foto_ktp_kk_sim', 
        'status', 
        'penerima_kuasa', 
        'surat_kuasa', 
        'penerima_surat_kuasa',
    ];
    

    public function barangBukti()
    {
        return $this->belongsTo(BarangBukti::class);
    }

}