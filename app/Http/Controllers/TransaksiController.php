<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //
    public function showPeminjaman()
    {
        return view('transaksi.peminjaman');
    }

    public function showPengembalian()
    {
        return view('transaksi.pengembalian');
    }
}
