<?php

namespace App\Http\Controllers;

use App\Models\PelayananHukum;
use App\Models\Masyarakat;
use App\Models\User;
use Illuminate\Http\Request;

class KelolaPelayananHukumController extends Controller
{
    public function index()
    {
        $pelayananHukum = PelayananHukum::all();
        return view('kelola_pelayanan_hukum.index', compact('pelayananHukum'));
    }
}
