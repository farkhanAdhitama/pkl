<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showPengaturan()
    {
        $profil = User::all();
        return view('pengaturan', compact('profil'));
    }
}
