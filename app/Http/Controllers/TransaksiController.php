<?php

namespace App\Http\Controllers;

use App\Exports\PeminjamanExport;
use App\Exports\PengembalianExport;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

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

    public function perpanjang(Request $request,$id)
    {   

        $data = Transaksi::where('id', $id)->increment('lama',7);
        return redirect()->route('peminjaman')->with('succeskembalikan', 'Buku Berhasil Dikembalikan');

    }

    public function exportexcel_peminjaman(){
        return Excel::download(new PeminjamanExport, 'Data_Peminjaman.xlsx');
    }

    public function exportexcel_pengembalian(){
        return Excel::download(new PengembalianExport, 'Data_Pengembalian.xlsx');
    }

    public function exportpdf_peminjaman(){
        $data = Transaksi::all()->where('status', 'Dipinjam');
        $anggotas = Anggota::all();
        $bukus = Buku::all();
        view()->share('data', $data, $anggotas, $bukus);
        $pdf = PDF::loadview('transaksi.data-peminjaman-pdf');
        return $pdf->download('data-peminjaman.pdf');
    }

    public function exportpdf_pengembalian(){
        $data = Transaksi::all()->where('status', 'Dikembalikan');
        $anggotas = Anggota::all();
        $bukus = Buku::all();
        view()->share('data', $data, $anggotas, $bukus);
        $pdf = PDF::loadview('transaksi.data-pengembalian-pdf');
        return $pdf->download('data-pengembalian.pdf');
    }



    public function showPengembalian()
    {
        $peminjaman = Transaksi::with('buku','anggota')->where('status', 'Dikembalikan')->paginate(99999);
        $bukus = Buku::all();
        $anggotas = Anggota::all();
        return view('transaksi.pengembalian', compact('peminjaman','bukus', 'anggotas'));
    }

    public function deletePengembalian($id)
    {
        $data = Transaksi::find($id);
        $data->delete();
        return redirect()->route('pengembalian')->with('deletesuccess', 'Data Berhasil Dihapus');

    }


    // Guru
    public function showPeminjamanGuru()
    {
        $peminjaman = Transaksi::with('buku','anggota')->where('status', 'Dipinjam')->paginate(99999);
        $bukus = Buku::all();
        $anggotas = Anggota::all();
        
        return view('transaksi-guru.peminjaman', compact('peminjaman','bukus', 'anggotas'));
    }


    public function showPengembalianGuru()
    {
        $peminjaman = Transaksi::with('buku','anggota')->where('status', 'Dikembalikan')->paginate(99999);
        $bukus = Buku::all();
        $anggotas = Anggota::all();
        return view('transaksi-guru.pengembalian', compact('peminjaman','bukus', 'anggotas'));
    }

    
}
