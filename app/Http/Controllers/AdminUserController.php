<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $user = User::all();

        return view('backend.user.index', [
            'title' => 'Users',
            'users' => $user,
        ]);
    }

    public function create()
    {
        return view('backend.user.create', [
            'title' => 'Register',
        ]);
    }

    public function edit(User $user)
    {
        return view('backend.user.edit', [
            'title' => 'Edit User',
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        // set validasi
        $rules = [
            'name' => 'required|min:5',
            'role' => 'required',
        ];
        // set validasi email ketika email diubah
        if ($request->email != $user->email) {
            $rules['email'] = 'required|unique:users|min:5|max:255';
        }
        //set validasi password ketika ada new password
        if ($request->password) {
            $rules['password'] = 'required|min:5|max:255';
        }
        // validasi
        $validatedData = $request->validate($rules);
        // update data 
        $result = User::where('id', $user->id)->update($validatedData);
        // tapilkan pesan sukses / error
        if ($result > 0) {
            return redirect('/admin/user')->with('success', 'User berhasil diubah !!');
        } else {
            return redirect('/admin/user')->with('error', 'User gagal diubah !!');
        }
    }

    public function store(Request $request)
    {
        // set validasi
        $rules = [
            'name' => 'required|max:255',
            'role' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ];
        // Validasi
        $validatedData = $request->validate($rules);
        // encryp password
        $validatedData['password'] = Hash::make($validatedData['password']);
        // create data ke database
        $result = User::create($validatedData);
        // jika tidak ada data yang ditambahkan ke database maka munculkan error
        if ($result === false) {
            return redirect('/admin/user')->with('error', 'User gagal ditambahkan !');
        }
        // jika ada data yang dimasukan ke database maka tampilkan success
        return redirect('/admin/user')->with('success', 'User berhasil ditambahkan !');
    }

    public function destroy(User $user)
    {
        // hapus user berdasarkan id
        User::destroy($user->id);

        return redirect('/admin/user')->with('success', 'User behasil dihapus !');
    }
}
