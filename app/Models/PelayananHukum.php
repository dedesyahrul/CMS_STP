<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class PelayananHukum extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pelayanan_hukum';
    public $primaryKey = 'id';
    protected $fillable = ['nik', 'nama', 'pertanyaan', 'nomor_hp', 'id_pelayanan_hukum'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tambahkan method berikut
    public static function boot()
    {
        parent::boot();

        // event saat pelayanan_hukum dihapus secara permanen
        static::deleted(function ($pelayanan) {
            // Ambil id pelayanan_hukum yang baru
            $newId = PelayananHukum::withTrashed()->max('id') + 1;

            // Update id_pelayanan_hukum pada pelayanan_hukum yang dihapus
            $pelayanan->id_pelayanan_hukum = 'P' . str_pad($newId, 4, '0', STR_PAD_LEFT);

            // Simpan pelayanan_hukum yang dihapus dengan id_pelayanan_hukum yang baru
            $pelayanan->save();
        });
    }
}
