<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Guru;
use App\Models\Anggota;
use App\Models\Majalah;
use Illuminate\Http\Request;
use App\Models\TransaksiGuru;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanBukuGuruExport;
use App\Exports\PengembalianBukuGuruExport;
use App\Exports\PeminjamanMajalahGuruExport;
use App\Http\Requests\StoreTransaksiGuruRequest;
use App\Http\Requests\UpdateTransaksiGuruRequest;

class TransaksiGuruController extends Controller
{

    public function showPeminjamanGuru()
    {
        $peminjaman = TransaksiGuru::with('buku','guru')->where('status', 'Dipinjam')->where('jenis', 'buku')->paginate(99999);
        $bukus = Buku::all()->where('jumlah','>', 0);
        $gurus = Guru::all()->where('status', 'Aktif');
        return view('transaksi-guru.peminjaman_buku_guru', compact('peminjaman','bukus', 'gurus'));
    }


    public function showPengembalianGuru()
    {
        $peminjaman = TransaksiGuru::with('buku','guru')->where('status', 'Dikembalikan')->where('jenis', 'buku')->paginate(99999);
        $bukus = Buku::all();
        $gurus = Guru::all();
        return view('transaksi-guru.pengembalian_buku_guru', compact('peminjaman','bukus', 'gurus'));
    }

    public function tambah_peminjaman_buku_guru(Request $request)
    {   
        $data = TransaksiGuru::create($request->all());
        Buku::where('id', $data->buku_id)->decrement('jumlah',1);
        return redirect()->route('guru_pinjam')->with('insertsuccess', 'Peminjaman Berhasil');
    }

    public function kembalikan_buku_guru(Request $request,$id,$id_buku)
    {   
        TransaksiGuru::where('id', $id)->where('jenis', 'buku')->update(['status' => "Dikembalikan"]);
        Buku::where('id', $id_buku)->increment('jumlah',1);
        return redirect()->route('guru_pinjam')->with('succeskembalikan', 'Buku Berhasil Dikembalikan');

    }

    public function perpanjang_buku(Request $request,$id)
    {   
        TransaksiGuru::where('id', $id)->where('jenis', 'buku')->increment('lama',7);
        return redirect()->route('guru_pinjam')->with('succeskembalikan', 'Buku Berhasil Dikembalikan');

    }

    public function exportexcel_peminjaman_buku_guru(){
        return Excel::download(new PeminjamanBukuGuruExport, 'Data Peminjaman Buku Guru.xlsx');
    }

    public function exportexcel_pengembalian_buku_guru(){
        return Excel::download(new PengembalianBukuGuruExport, 'Data Pengembalian Buku Guru.xlsx');
    }

    public function exportpdf_peminjaman_buku_guru(){
        $data = TransaksiGuru::all()->where('status', 'Dipinjam')->where('jenis', 'buku');
        $gurus = Guru::all();
        $bukus = Buku::all();
        view()->share('data', $data, $gurus, $bukus);
        $pdf = PDF::loadview('transaksi-guru.data-peminjaman-buku-guru-pdf');
        return $pdf->download('Data Peminjaman Buku Guru.pdf');
    }

    public function exportpdf_pengembalian_buku_guru(){
        $data = TransaksiGuru::all()->where('status', 'Dikembalikan')->where('jenis', 'buku');
        $gurus = Guru::all();
        $bukus = Buku::all();
        view()->share('data', $data, $gurus, $bukus);
        $pdf = PDF::loadview('transaksi-guru.data-pengembalian-buku-guru-pdf');
        return $pdf->download('Data Pengembalian Buku Guru.pdf');
    }


    public function deletePengembalianBuku($id)
    {
        $data = TransaksiGuru::find($id);
        $data->delete();
        return redirect()->route('guru_kembali')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

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
        Majalah::where('id', $data->majalah_id)->decrement('jumlah',1);
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

    public function exportexcel_peminjaman_majalah_guru(){
        return Excel::download(new PeminjamanMajalahGuruExport, 'Data Peminjaman Majalah Guru.xlsx');
    }
    public function exportpdf_peminjaman_majalah_guru(){
        $data = TransaksiGuru::all()->where('status', 'Dipinjam')->where('jenis', 'majalah');
        $gurus = Guru::all();
        $majalahs = Majalah::all();
        view()->share('data', $data, $gurus, $majalahs);
        $pdf = PDF::loadview('transaksi-guru.data-peminjaman-majalah-guru-pdf');
        return $pdf->download('Data Peminjaman Majalah Guru.pdf');
    }

}
