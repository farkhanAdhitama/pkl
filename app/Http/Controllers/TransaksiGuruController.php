<?php

namespace App\Http\Controllers;

use App\Models\CD;
use App\Models\Buku;
use App\Models\Guru;
use App\Models\Anggota;
use App\Models\Majalah;
use Illuminate\Http\Request;
use App\Models\TransaksiGuru;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanCDGuruExport;
use App\Exports\PeminjamanBukuGuruExport;
use App\Exports\PengembalianCDGuruExport;
use App\Exports\PengembalianBukuGuruExport;
use App\Exports\PeminjamanMajalahGuruExport;
use App\Exports\PengembalianMajalahGuruExport;
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
        $validated = $request->validate([
            'buku_id' => 'required',
            'guru_id' => 'required',
        ],[
            'buku_id.required'=> 'Buku Harus Diisi',
            'guru_id.required'=> 'Peminjam Harus Diisi',

        ]);
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

     public function showPengembalianMajalahGuru()
    {
        $peminjaman = TransaksiGuru::with('majalah','guru')->where('status', 'Dikembalikan')->where('jenis', 'majalah')->paginate(99999);
        $majalahs = Majalah::all();
        $gurus = Guru::all();
        return view('transaksi-guru.pengembalian_majalah_guru', compact('peminjaman','majalahs', 'gurus'));
    }

     public function tambah_peminjaman_majalah_guru(Request $request)
    {   
        $validated = $request->validate([
            'majalah_id' => 'required',
            'guru_id' => 'required',
        ],[
            'majalah_id.required'=> 'Majalah Harus Diisi',
            'guru_id.required'=> 'Peminjam Harus Diisi',

        ]);
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
    public function exportexcel_pengembalian_majalah_guru(){
        return Excel::download(new PengembalianMajalahGuruExport, 'Data Pengembalian Majalah Guru.xlsx');
    }
    public function exportpdf_peminjaman_majalah_guru(){
        $data = TransaksiGuru::all()->where('status', 'Dipinjam')->where('jenis', 'majalah');
        $gurus = Guru::all();
        $majalahs = Majalah::all();
        view()->share('data', $data, $gurus, $majalahs);
        $pdf = PDF::loadview('transaksi-guru.data-peminjaman-majalah-guru-pdf');
        return $pdf->download('Data Peminjaman Majalah Guru.pdf');
    }

    public function exportpdf_pengembalian_majalah_guru(){
        $data = TransaksiGuru::all()->where('status', 'Dikembalikan')->where('jenis', 'majalah');
        $gurus = Guru::all();
        $majalahs = Majalah::all();
        view()->share('data', $data, $gurus, $majalahs);
        $pdf = PDF::loadview('transaksi-guru.data-pengembalian-majalah-guru-pdf');
        return $pdf->download('Data Pengembalian Majalah Guru.pdf');
    }

    public function deletePengembalianMajalah($id)
    {
        $data = TransaksiGuru::find($id);
        $data->delete();
        return redirect()->route('majalah_guru_kembali')->with('deletesuccess', 'Data Berhasil Dihapus');
    }


    // CD
    public function showPeminjamanCDGuru()
    {
        $peminjaman_cd = TransaksiGuru::with('cd','guru')->where('status', 'Dipinjam')->where('jenis', 'cd')->paginate(99999);
        $cds = CD::all()->where('jumlah','>', 0);
        $gurus = Guru::all()->where('status', 'Aktif');
        return view('transaksi-guru.peminjaman_cd_guru', compact('peminjaman_cd','cds', 'gurus'));
    }

     public function showPengembalianCDGuru()
    {
        $peminjaman = TransaksiGuru::with('cd','guru')->where('status', 'Dikembalikan')->where('jenis', 'cd')->paginate(99999);
        $cds = CD::all();
        $gurus = Guru::all();
        return view('transaksi-guru.pengembalian_cd_guru', compact('peminjaman','cds', 'gurus'));
    }

     public function tambah_peminjaman_cd_guru(Request $request)
    {   
        $validated = $request->validate([
            'cd_id' => 'required', 
            'guru_id' => 'required',
        ],[
            'cd_id.required'=> 'Cd  Harus Diisi',
            'guru_id.required'=> 'Peminjam Harus Diisi',

        ]);
        $data = TransaksiGuru::create($request->all());
        CD::where('id', $data->cd_id)->decrement('jumlah',1);
        return redirect()->route('cd_guru_pinjam')->with('insertsuccess', 'Peminjaman Berhasil');
    }

    public function kembalikan_cd_guru(Request $request,$id,$id_cd)
    {   
        TransaksiGuru::where('id', $id)->where('jenis', 'cd')->update(['status' => "Dikembalikan"]);
        CD::where('id', $id_cd)->increment('jumlah',1);
        return redirect()->route('cd_guru_pinjam')->with('succeskembalikan', 'CD Berhasil Dikembalikan');
    }

    public function perpanjang_cd_guru(Request $request,$id)
    {   
        TransaksiGuru::where('id', $id)->where('jenis', 'cd')->increment('lama',7);
        return redirect()->route('cd_guru_pinjam')->with('succeskembalikan', 'CD Berhasil Dikembalikan');
    }

    public function exportexcel_peminjaman_cd_guru(){
        return Excel::download(new PeminjamanCDGuruExport, 'Data Peminjaman CD Guru.xlsx');
    }
    public function exportexcel_pengembalian_cd_guru(){
        return Excel::download(new PengembalianCDGuruExport, 'Data Pengembalian CD Guru.xlsx');
    }
    public function exportpdf_peminjaman_cd_guru(){
        $data = TransaksiGuru::all()->where('status', 'Dipinjam')->where('jenis', 'cd');
        $gurus = Guru::all();
        $cds = CD::all();
        view()->share('data', $data, $gurus, $cds);
        $pdf = PDF::loadview('transaksi-guru.data-peminjaman-cd-guru-pdf');
        return $pdf->download('Data Peminjaman CD Guru.pdf');
    }

    public function exportpdf_pengembalian_cd_guru(){
        $data = TransaksiGuru::all()->where('status', 'Dikembalikan')->where('jenis', 'cd');
        $gurus = Guru::all();
        $cds = CD::all();
        view()->share('data', $data, $gurus, $cds);
        $pdf = PDF::loadview('transaksi-guru.data-pengembalian-cd-guru-pdf');
        return $pdf->download('Data Pengembalian CD Guru.pdf');
    }

    public function deletePengembalianCD($id)
    {
        $data = TransaksiGuru::find($id);
        $data->delete();
        return redirect()->route('cd_guru_kembali')->with('deletesuccess', 'Data Berhasil Dihapus');
    }


}
