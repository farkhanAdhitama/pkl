<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class DataPenggunaController extends Controller
{
    public function index()
    {   
        $users = User::paginate(99999);
        
        return view('pengguna.data_pengguna', compact('users'));
    }

    // /**
    //  * Display tambah cd
    //  */
    // public function showTambahCD()
    // {  
    //     return view('cd.tambah_cd');
    // }
    

    /**
     * Insert Data
     *
     * @return \Illuminate\Http\Response
     */
    public function insertPengguna(Request $request)
    {   
         $validated = $request->validate([
            'name' => 'required|max:255|string',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:4', 
            'level' => 'required',
        ],[
            'name.required'=> 'Nama Harus Diisi',
            'username.required'=> 'Username Harus Diisi',
            'email.required'=> 'Email Harus Diisi',
            'password.required'=> 'Password Harus Diisi',
            'level.required'=> 'Level Harus Diisi',
            'username.unique'=> 'Username Sudah Ada',
            'email.unique'=> 'Email Sudah Ada',
            'password.min'=> 'Password Harus Lebih Dari 4 Karakter',
            'password.confirmed'=> 'Password Tidak Cocok'

        ]);
        $data = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'level' => $request->level,
                'password' => Hash::make($request->password),
                'username' => $request->username,
            ]);
        return redirect()->route('data_pengguna')->with('insertsuccess', 'Pengguna Berhasil Ditambahkan');
    }
}
