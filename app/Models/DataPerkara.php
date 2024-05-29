<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPerkara extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_putusan_perkara',
        'tanggal_putusan',
        'nama_tersangka',
    ];

    public function barangBuktis()
    {
        return $this->hasMany(BarangBukti::class);
    }
    public function barangBukti()
    {
        return $this->hasMany(BarangBukti::class);
    }
}