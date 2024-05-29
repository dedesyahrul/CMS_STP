<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Metode untuk menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Metode untuk mengirimkan data login dan melakukan autentikasi
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil
            return redirect('/beranda');
        } else {
            // Autentikasi gagal
            return back()->withErrors([
                'email' => 'Email atau password salah',
            ]);
        }
    }

    // Metode untuk logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
