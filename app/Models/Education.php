<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $dates = ['start_year', 'end_year'];

    protected $fillable = [
        'user_id',
        'institution',
        'degree',
        'major',
        'start_year',
        'end_year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
