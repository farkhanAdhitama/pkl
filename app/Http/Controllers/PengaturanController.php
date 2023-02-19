<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PengaturanController extends Controller
{
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showPengaturan(Request $request, $id)
    {
        $profil = User::find($id);
        return view('.pengaturan', compact('profil'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
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

    public function ubahPassword(Request $request, $id)
    {
        $rules = [
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ];

        $message = [
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal terdiri dari 4 karakter.',
            'password.confirmed' => 'Password tidak sesuai.',
        ];
        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return redirect()
                ->back()
                ->with('update_fails', 'Data Gagal Diubah.')
                ->withErrors($validasi);
        } else {
            $request['password'] = Hash::make($request->password);
            $data = User::find($id);
            $data->update($request->all());

            return redirect()
                ->back()
                ->with('update_success', 'Data Berhasil Diubah.');
        }
    }
}
