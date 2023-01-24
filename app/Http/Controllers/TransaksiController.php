<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //
    public function showPeminjaman()
    {
        $peminjaman = Transaksi::with('buku','anggota')->paginate(99999);
        $bukus = Buku::all();
        $anggotas = Anggota::all();
        return view('transaksi.peminjaman', compact('peminjaman','bukus', 'anggotas'));
    }

    public function showTambahPeminjaman()
    {  
        $anggotas = Anggota::all();
        $bukus = Buku::all();
        return view('transaksi.tambah_peminjaman', compact('bukus','anggotas'));
    }

    public function tambah_peminjaman(Request $request)
    {   

        $data = Transaksi::create($request->all());
        return redirect()->route('peminjaman')->with('insertsuccess', 'Peminjaman Berhasil');
    }


    public function showPengembalian()
    {
        return view('transaksi.pengembalian');
    }

    
}
