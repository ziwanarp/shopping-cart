<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function index()
    {
        return view('frontend.register.index', [
            'title' => 'Register',
        ]);
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ];

        // Validasi Inputan dari user
        $validatedData = $request->validate($rules);
        //Set role = user
        $validatedData['role'] = 'user';
        // encryp password
        $validatedData['password'] = Hash::make($validatedData['password']);
        // create data ke database
        $result = User::create($validatedData);
        // jika tidak ada data yang ditambahkan ke database maka munculkan error
        if ($result === false) {
            return redirect('/register')->with('error', 'Registrasi Gagal, Ulangi lagi !!');
        }
        // jika ada data yang dimasukan ke database maka tampilkan success
        return redirect('/register')->with('success', 'Registrasi berhasil, Silahkan login !!');
    }
}
