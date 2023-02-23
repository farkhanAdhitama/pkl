<?php

namespace App\Http\Controllers;

use App\Models\CD;
use App\Models\Buku;
use App\Models\Guru;
use App\Models\Anggota;
use App\Models\Majalah;
use App\Models\Jenisbuku;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiGuru;
use App\Models\TransaksiSiswa;
use Illuminate\Support\Facades\DB;

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
        $jumlah_cd = CD::count();
        $jumlah_majalah = Majalah::count();          
        $jumlah_anggota_aktif = Anggota::where("status","Aktif")->count();
        $jumlah_anggota_nonaktif = Anggota::where("status","NonAktif")->count();
        $jumlah_guru_aktif = Guru::where("status","Aktif")->count();
        $jumlah_guru_nonaktif = Guru::where("status","NonAktif")->count();
        $jumlah_jenis = Jenisbuku::count();
        $jumlah_pinjam_siswa = TransaksiSiswa::where('status', 'Dipinjam')->count();
        $jumlah_kembali_siswa = TransaksiSiswa::where('status', 'Dikembalikan')->count();
        $jumlah_pinjam_guru = TransaksiGuru::where('status', 'Dipinjam')->count();
        $jumlah_kembali_guru = TransaksiGuru::where('status', 'Dikembalikan')->count();
        return view('home', compact('jumlah_buku', 'jumlah_cd', 'jumlah_majalah',
         'jumlah_guru_aktif', 'jumlah_guru_nonaktif', 'jumlah_anggota_aktif', 'jumlah_anggota_nonaktif',
         'jumlah_jenis', 'jumlah_pinjam_siswa', 'jumlah_kembali_siswa', 'jumlah_pinjam_guru', 'jumlah_kembali_guru'));
    }
    
}
