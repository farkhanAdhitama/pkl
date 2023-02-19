<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

        public function deleteUser($id)
    {   
        $data = User::find($id);
        if ($data->foto_profil != 'person.png') {
            if (File::exists(public_path('assets/images/foto_profil/' . $data->foto_profil))) {
                File::delete(public_path('assets/images/foto_profil/' . $data->foto_profil));
            }
        }
        $data->delete();
        return redirect()->route('data_pengguna')->with('deletesuccess', 'Data Berhasil Dihapus');
    }

    public function updateUser(Request $request, $id)
    {
         $rules = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', ],
            'email' => ['required', 'string', 'email', 'max:255'],
        ];

        $message = [
            'name.required' => 'Nama harus diisi.',
            'username.required' => 'Username harus diisi.',
            'email.required' => 'E-mail harus diisi.',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return back()
                ->with('add_fails', 'Data Gagal Ditambahkan.')
                ->withInput($request->except('key'))
                ->withErrors($validasi);
        } else {
            $data = User::find( $id);
            $data->update($request->all());
            if($request->hasFile('foto_profil')){
                $request->file('foto_profil')->move('assets/images/foto_profil/', $request->file('foto_profil')->getClientOriginalName());
                $data->foto_profil = $request->file('foto_profil')->getClientOriginalName();
                $data->save();
            }
            return redirect()
                ->back()
                ->with('updatesuccess', 'Data Berhasil Ditambahkan.');

        }
}
}