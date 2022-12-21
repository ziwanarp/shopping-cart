<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function index()
    {
        return view('frontend.login.index', [
            'title' => 'Login',
        ]);
    }

    public function login(Request $request)
    {
        // validasi data login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        // jika login berhasil, alihkan ke home dan tampilkan pesan success
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')->with('success', 'Login Berhasil !');;
        }
        // jika login gagal, kembalikan ke halaman login dan tampilkan pesan error
        return back()->with('error', 'Email / Password salah !');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil !!');
    }

    public function redirect()
    {
        return redirect('/');
    }
}
