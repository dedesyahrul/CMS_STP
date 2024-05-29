<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Masyarakat;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterApiController extends Controller
{
    public function index()
    {
        // Ambil semua data pendaftaran Masyarakat dan Admin dari database
        $masyarakat = Masyarakat::all();
        $user = User::all();
        $admin = User::where('role', 'admin')->get();

        return response()->json([
            'masyarakat' => $masyarakat,
            'admin' => $admin,
            'user' => $user,
        ]);
    }

    // Metode untuk mendaftarkan Masyarakat
    public function registerMasyarakat(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'masyarakat',
        ]);

        $masyarakat = Masyarakat::create([
            'user_id' => $user->id,
            'nik' => $request->nik,
            'nama_lengkap' => $request->name,
        ]);

        $user->masyarakat()->save($masyarakat);

        Auth::login($user);

        return response()->json(['message' => 'Registration successful. Redirect to beranda.']);
    }

    // Metode untuk mendaftarkan Admin
    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        Auth::login($user);

        return response()->json(['message' => 'Registration successful. Redirect to dashboard.']);
    }

}
