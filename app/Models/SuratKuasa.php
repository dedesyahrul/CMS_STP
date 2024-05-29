<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKuasa extends Model
{
    use HasFactory;

    protected $table = 'surat_kuasa';

    protected $fillable = [
        'file_name',
        'file_path',
    ];
}
