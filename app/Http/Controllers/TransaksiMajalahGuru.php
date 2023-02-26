<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Majalah;
use Illuminate\Http\Request;
use App\Models\TransaksiGuru;

class TransaksiMajalahGuru extends Controller
{
    // MAJALAH
    public function showPeminjamanMajalahGuru()
    {
        $peminjaman_majalah = TransaksiGuru::with('majalah','guru')->where('status', 'Dipinjam')->where('jenis', 'majalah')->paginate(99999);
        $majalahs = Majalah::all()->where('jumlah','>', 0);
        $gurus = Guru::all()->where('status', 'Aktif');
        return view('transaksi-guru.peminjaman_majalah_guru', compact('peminjaman_majalah','majalahs', 'gurus'));
    }

     public function tambah_peminjaman_majalah_guru(Request $request)
    {   
        $data = TransaksiGuru::create($request->all());
        Majalah::where('id', $data->buku_id)->decrement('jumlah',1);
        return redirect()->route('majalah_guru_pinjam')->with('insertsuccess', 'Peminjaman Berhasil');
    }

    public function kembalikan_majalah_guru(Request $request,$id,$id_majalah)
    {   
        TransaksiGuru::where('id', $id)->where('jenis', 'majalah')->update(['status' => "Dikembalikan"]);
        Majalah::where('id', $id_majalah)->increment('jumlah',1);
        return redirect()->route('majalah_guru_pinjam')->with('succeskembalikan', 'Majalah Berhasil Dikembalikan');
    }

    public function perpanjang_majalah_guru(Request $request,$id)
    {   
        TransaksiGuru::where('id', $id)->where('jenis', 'majalah')->increment('lama',7);
        return redirect()->route('majalah_guru_pinjam')->with('succeskembalikan', 'Majalah Berhasil Dikembalikan');
    }
}
