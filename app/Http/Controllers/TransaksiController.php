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
        $peminjaman = Transaksi::with('buku','anggota')->where('status', 'Dipinjam')->paginate(99999);
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

    public function kembalikan(Request $request,$id)
    {
        $data = Transaksi::where('id', $id)->update(['status' => "Dikembalikan"]);
        return redirect()->route('peminjaman')->with('succeskembalikan', 'Buku Berhasil Dikembalikan');

    }



    public function showPengembalian()
    {
        $peminjaman = Transaksi::with('buku','anggota')->where('status', 'Dikembalikan')->paginate(99999);
        $bukus = Buku::all();
        $anggotas = Anggota::all();
        return view('transaksi.pengembalian', compact('peminjaman','bukus', 'anggotas'));
    }

    
}
