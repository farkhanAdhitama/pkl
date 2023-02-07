<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Jenisbuku;
use App\Models\Transaksi;
use App\Models\TransaksiSiswa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlah_buku = Buku::count();
        $jumlah_anggota = Anggota::count();
        $jumlah_jenis = Jenisbuku::count();
        $jumlah_pinjam = TransaksiSiswa::where('status', 'Dipinjam')->count();
        $jumlah_kembali = TransaksiSiswa::where('status', 'Dikembalikan')->count();
        return view('home', compact('jumlah_buku', 'jumlah_anggota', 'jumlah_jenis', 'jumlah_pinjam', 'jumlah_kembali'));
    }
    
}
