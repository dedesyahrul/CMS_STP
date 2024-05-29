<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiTokenController extends Controller
{

    // public function index()
    // {
    //     // Ambil data token dari model User
    //     $tokens = auth()->user()->tokens;

    //     // Tampilkan halaman dengan daftar token
    //     return view('api.index', compact('tokens'));
    // }

    public function index()
    {
        // Ambil data token dari model User
        $tokens = auth()->user()->tokens;

        // Tampilkan halaman dengan daftar token
        return view('api.index', compact('tokens'));
    }
}
