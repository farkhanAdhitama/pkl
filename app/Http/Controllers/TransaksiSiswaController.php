<?php

namespace App\Http\Controllers;

use App\Models\CD;
use App\Mail\SendEmail;
use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Majalah;
use Illuminate\Http\Request;
use App\Models\TransaksiSiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PeminjamanExport;
use App\Exports\PengembalianExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanCDSiswaExport;
use App\Exports\PeminjamanBukuSiswaExport;
use App\Exports\PengembalianCDSiswaExport;
use App\Exports\PengembalianBukuSiswaExport;
use App\Exports\PeminjamanMajalahSiswaExport;
use App\Exports\PengembalianMajalahSiswaExport;
use App\Http\Requests\StoreTransaksiSiswaRequest;
use App\Http\Requests\UpdateTransaksiSiswaRequest;
use App\Models\BatasPinjam;
use App\Models\User;

class TransaksiSiswaController extends Controller
{
    //buku
    public function showPeminjaman()
    {
        $peminjaman = TransaksiSiswa::with('buku','anggota')->where('status', 'Dipinjam')->where('jenis', 'buku')->paginate(99999);
        $bukus = Buku::all()->where('jumlah','>', 0);
        $anggotas = Anggota::all()->where('status', 'Aktif');
        $batas_pinjam = BatasPinjam::first();
        $petugas = User::all();
        return view('transaksi-siswa.peminjaman', compact('peminjaman','bukus', 'anggotas', 'batas_pinjam', 'petugas'));
    }


    public function tambah_peminjaman(Request $request)
    {   
         $validated = $request->validate([
            'buku_id' => 'required',
            'anggota_id' => 'required',
        ],[
            'buku_id.required'=> 'Buku Harus Diisi',
            'anggota_id.required'=> 'Peminjam Harus Diisi',

        ]);
        $batas = BatasPinjam::first()->batas_siswa;
        $jumlah = TransaksiSiswa::where('anggota_id', $request->anggota_id)->where('status','Dipinjam')->where('jenis', 'buku')->count();
        // dd($jumlah);
        if($jumlah >= $batas){
             return redirect()->route('peminjaman_buku')->with('insertgagal', 'Peminjaman Gagal');
        }else{
            $data = TransaksiSiswa::create($request->all());
            Buku::where('id', $data->buku_id)->decrement('jumlah',1);
            return redirect()->route('peminjaman_buku')->with('insertsuccess', 'Peminjaman Berhasil');
        }
    }

    public function kembalikan(Request $request,$id,$id_buku)
    {   
        TransaksiSiswa::where('id', $id)->update(['status' => "Dikembalikan"]);
        Buku::where('id', $id_buku)->increment('jumlah',1);
        return redirect()->route('peminjaman_buku')->with('succeskembalikan', 'Buku Berhasil Dikembalikan');

    }

    public function perpanjang(Request $request,$id)
    {   

        TransaksiSiswa::where('id', $id)->where('jenis', 'buku')->increment('lama',7);
        return redirect()->route('peminjaman_buku')->with('succeskembalikan', 'Buku Berhasil Dikembalikan');

    }

    public function exportexcel_peminjaman(){
        return Excel::download(new PeminjamanBukuSiswaExport, 'Data Peminjaman Buku Siswa.xlsx');
    }

    public function exportexcel_pengembalian(){
        return Excel::download(new PengembalianBukuSiswaExport, 'Data Pengembalian Buku Siswa.xlsx');
    }

    public function exportpdf_peminjaman(){
        $data = TransaksiSiswa::all()->where('status', 'Dipinjam')->where('jenis', 'buku');
        $anggotas = Anggota::all();
        $bukus = Buku::all();
        view()->share('data', $data, $anggotas, $bukus);
        $pdf = PDF::loadview('transaksi-siswa.data-peminjaman-pdf');
        return $pdf->download('Data Peminjaman Buku Siswa.pdf');
    }

    public function exportpdf_pengembalian(){
        $data = TransaksiSiswa::all()->where('status', 'Dikembalikan')->where('jenis', 'buku');
        $anggotas = Anggota::all();
        $bukus = Buku::all();
        view()->share('data', $data, $anggotas, $bukus);
        $pdf = PDF::loadview('transaksi-siswa.data-pengembalian-pdf');
        return $pdf->download('Data Pengembalian Buku Siswa.pdf');
    }

    public function showPengembalian()
    {
        $peminjaman = TransaksiSiswa::with('buku','anggota')->where('status', 'Dikembalikan')->where('jenis', 'buku')->paginate(99999);
        $bukus = Buku::all();
        $anggotas = Anggota::all();
        return view('transaksi-siswa.pengembalian', compact('peminjaman','bukus', 'anggotas'));
    }

    public function deletePengembalianBukuSiswa($id)
    {
        $data = TransaksiSiswa::find($id);
        $data->delete();
        return redirect()->route('pengembalian_buku')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

    //MAJALAH
    public function showPeminjamanMajalah()
    {
        $peminjaman = TransaksiSiswa::with('majalah','anggota')->where('status', 'Dipinjam')->where('jenis', 'majalah')->paginate(99999);
        $majalahs = Majalah::all()->where('jumlah','>', 0);
        $anggotas = Anggota::all()->where('status', 'Aktif');
        $batas_pinjam = BatasPinjam::first();
        return view('transaksi-siswa.peminjaman_majalah_siswa', compact('peminjaman','majalahs', 'anggotas', 'batas_pinjam'));
    }


    public function tambah_peminjaman_majalah(Request $request)
    {   
         $validated = $request->validate([
            'majalah_id' => 'required',
            'anggota_id' => 'required',
        ],[
            'majalah_id.required'=> 'Majalah Harus Diisi',
            'anggota_id.required'=> 'Peminjam Harus Diisi',
        ]);

        $batas = BatasPinjam::first()->batas_siswa;
        $jumlah = TransaksiSiswa::where('anggota_id', $request->anggota_id)->where('status','Dipinjam')->where('jenis', 'majalah')->count();
        // dd($jumlah);
        if($jumlah >= $batas){
             return redirect()->route('peminjaman_majalah')->with('insertgagal', 'Peminjaman Gagal');
        }else{
            $data = TransaksiSiswa::create($request->all());
            Majalah::where('id', $data->majalah_id)->decrement('jumlah',1);
            return redirect()->route('peminjaman_majalah')->with('insertsuccess', 'Peminjaman Berhasil');
        }
       
    }

    public function kembalikan_majalah(Request $request,$id,$id_majalah)
    {   
        TransaksiSiswa::where('id', $id)->update(['status' => "Dikembalikan"]);
        Majalah::where('id', $id_majalah)->increment('jumlah',1);
        return redirect()->route('peminjaman_majalah')->with('succeskembalikan', 'Majalah Berhasil Dikembalikan');

    }

    public function perpanjang_majalah(Request $request,$id)
    {   
        TransaksiSiswa::where('id', $id)->where('jenis', 'majalah')->increment('lama',7);
        return redirect()->route('peminjaman_majalah')->with('succeskembalikan', 'Majalah Berhasil Dikembalikan');
    }

    public function exportexcel_peminjaman_majalah(){
        return Excel::download(new PeminjamanMajalahSiswaExport, 'Data Peminjaman Majalah Siswa.xlsx');
    }

    public function exportexcel_pengembalian_majalah(){
        return Excel::download(new PengembalianMajalahSiswaExport, 'Data Pengembalian Majalah Siswa.xlsx');
    }

    public function exportpdf_peminjaman_majalah(){
        $data = TransaksiSiswa::all()->where('status', 'Dipinjam')->where('jenis', 'majalah');
        $anggotas = Anggota::all();
        $majalahs = Majalah::all();
        view()->share('data', $data, $anggotas, $majalahs);
        $pdf = PDF::loadview('transaksi-siswa.data-peminjaman-majalah-siswa-pdf');
        return $pdf->download('Data Peminjaman Majalah Siswa.pdf.pdf');
    }

    public function exportpdf_pengembalian_majalah(){
        $data = TransaksiSiswa::all()->where('status', 'Dikembalikan')->where('jenis', 'majalah');
        $anggotas = Anggota::all();
        $majalahs = Majalah::all();
        view()->share('data', $data, $anggotas, $majalahs);
        $pdf = PDF::loadview('transaksi-siswa.data-pengembalian-majalah-siswa-pdf');
        return $pdf->download('Data Pengembalian Majalah Siswa.pdf');
    }

    public function showPengembalianMajalah()
    {
        $peminjaman = TransaksiSiswa::with('majalah','anggota')->where('status', 'Dikembalikan')->where('jenis', 'majalah')->paginate(99999);
        $majalahs = Majalah::all();
        $anggotas = Anggota::all();
        return view('transaksi-siswa.pengembalian_majalah', compact('peminjaman','majalahs', 'anggotas'));
    }

    public function deletePengembalianMajalahSiswa($id_majalah)
    {
        $data = TransaksiSiswa::find($id_majalah);
        $data->delete();
        return redirect()->route('pengembalian_majalah')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

    //CD
    public function showPeminjamanCD()
    {
        $peminjaman = TransaksiSiswa::with('cd','anggota')->where('status', 'Dipinjam')->where('jenis', 'cd')->paginate(99999);
        $cds = CD::all()->where('jumlah','>', 0);
        $anggotas = Anggota::all()->where('status', 'Aktif');
        $batas_pinjam = BatasPinjam::first();
        return view('transaksi-siswa.peminjaman_cd_siswa', compact('peminjaman','cds', 'anggotas', 'batas_pinjam'));
    }


    public function tambah_peminjaman_cd(Request $request)
    {   
        $validated = $request->validate([
            'cd_id' => 'required', 
            'anggota_id' => 'required',
        ],[
            'cd_id.required'=> 'Cd  Harus Diisi',
            'anggota_id.required'=> 'Peminjam Harus Diisi',

        ]);
        $batas = BatasPinjam::first()->batas_siswa;
        $jumlah = TransaksiSiswa::where('anggota_id', $request->anggota_id)->where('status','Dipinjam')->where('jenis', 'cd')->count();
        // dd($jumlah);
        if($jumlah >= $batas){
             return redirect()->route('peminjaman_cd')->with('insertgagal', 'Peminjaman Gagal');
        }else{
             $data = TransaksiSiswa::create($request->all());
            CD::where('id', $data->cd_id)->decrement('jumlah',1);
            return redirect()->route('peminjaman_cd')->with('insertsuccess', 'Peminjaman Berhasil');
        }
    }

    public function kembalikan_cd(Request $request,$id,$id_cd)
    {   
        TransaksiSiswa::where('id', $id)->update(['status' => "Dikembalikan"]);
        CD::where('id', $id_cd)->increment('jumlah',1);
        return redirect()->route('peminjaman_cd')->with('succeskembalikan', 'CD Berhasil Dikembalikan');

    }

    public function perpanjang_cd(Request $request,$id)
    {   
        TransaksiSiswa::where('id', $id)->where('jenis', 'cd')->increment('lama',7);
        return redirect()->route('peminjaman_cd')->with('succeskembalikan', 'CD Berhasil Dikembalikan');
    }

    public function exportexcel_peminjaman_cd(){
        return Excel::download(new PeminjamanCDSiswaExport, 'Data Peminjaman CD Siswa.xlsx');
    }

    public function exportexcel_pengembalian_cd(){
        return Excel::download(new PengembalianCDSiswaExport, 'Data Pengembalian CD Siswa.xlsx');
    }

    public function exportpdf_peminjaman_cd(){
        $data = TransaksiSiswa::all()->where('status', 'Dipinjam')->where('jenis', 'cd');
        $anggotas = Anggota::all();
        $cds = CD::all();
        view()->share('data', $data, $anggotas, $cds);
        $pdf = PDF::loadview('transaksi-siswa.data-peminjaman-cd-siswa-pdf');
        return $pdf->download('Data Peminjaman CD Siswa.pdf');
    }

    public function exportpdf_pengembalian_cd(){
        $data = TransaksiSiswa::all()->where('status', 'Dikembalikan')->where('jenis', 'cd');
        $anggotas = Anggota::all();
        $cds = CD::all();
        view()->share('data', $data, $anggotas, $cds);
        $pdf = PDF::loadview('transaksi-siswa.data-pengembalian-cd-siswa-pdf');
        return $pdf->download('Data Pengembalian CD Siswa.pdf');
    }

    public function showPengembalianCD()
    {
        $peminjaman = TransaksiSiswa::with('cd','anggota')->where('status', 'Dikembalikan')->where('jenis', 'cd')->paginate(99999);
        $cds = CD::all();
        $anggotas = Anggota::all();
        return view('transaksi-siswa.pengembalian_cd', compact('peminjaman','cds', 'anggotas'));
    }

    public function deletePengembalianCDSiswa($id)
    {
        $data = TransaksiSiswa::find($id);
        $data->delete();
        return redirect()->route('pengembalian_cd')->with('deletesuccess', 'Data Berhasil Dihapus');

    }


}
