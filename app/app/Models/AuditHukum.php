<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditHukum extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'instansi', 'perihal', 'unggah_file'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
