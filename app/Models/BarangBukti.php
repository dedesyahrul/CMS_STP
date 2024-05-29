<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangBukti extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_perkara_id',
        'nama_pemilik_barang_bukti',
        'barang_bukti',
        'lokasi_barang_bukti',
        'foto_barang_bukti',
        'status',
        'ba_serah_terima',
        'd_serah_terima',
    ];

    public function dataPerkara()
    {
        return $this->belongsTo(DataPerkara::class);
    }

    public function pengambilanBarangBuktis()
    {
        return $this->hasMany(PengambilanBarangBukti::class);
    }
}
