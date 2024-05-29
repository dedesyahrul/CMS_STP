<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Masyarakat;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // Metode untuk mendaftarkan Masyarakat
    public function register_masyarakat(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Validasi email pada tabel users
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name, // Menyimpan nilai name
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'masyarakat', // Mengatur peran sebagai masyarakat
        ]);

        $masyarakat = Masyarakat::create([
            'user_id' => $user->id,
            'nik' => $request->nik,
            'nama_lengkap' => $request->name, // Menyimpan nilai name
        ]);

        $user->masyarakat()->save($masyarakat); // Menyimpan relasi antara user dan masyarakat

        Auth::login($user);

        return redirect('/beranda');
    }

    // Metode untuk mendaftarkan Admin
    public function register_admin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Validasi email pada tabel users
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name, // Menyimpan nilai name
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Mengatur peran sebagai admin
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    // Metode untuk menampilkan form registrasi Masyarakat
    public function showRegistrationFormMasyarakat()
    {
        return view('register_masyarakat');
    }

    // Metode untuk menampilkan form registrasi Admin
    public function showRegistrationFormAdmin()
    {
        return view('register_admin');
    }
}
