<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Jenisbuku;
use App\Exports\BukuExport;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Imports\BukuImport;
use App\Models\Penerbit;
use App\Models\TempatTerbit;
Use Barryvdh\DomPDF\Facade\Pdf;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $bukus = Buku::with('jenis','penerbit', 'tempat_terbit')->paginate(99999);
        $jen = Jenisbuku::all();
        $penerbit = Penerbit::all();
        $tempat_terbit = TempatTerbit::all();
        return view('databuku', compact('bukus'), compact('jen','penerbit', 'tempat_terbit'));
    }

    /**
     * Display tambah buku page
     */
    public function showTambahBuku()
    {  
        $jen = Jenisbuku::all();
        $penerbit = Penerbit::all();
        $tempat_terbit = TempatTerbit::all();
        return view('tambahbuku', compact('jen','penerbit', 'tempat_terbit'));;
    }
    

    /**
     * Insert Data
     *
     * @return \Illuminate\Http\Response
     */
    public function insertdata(Request $request)
    {   
        $validated = $request->validate([
            'judul_buku' => 'required|max:255',
            'isbn' => 'required|unique:bukus|numeric',
            'kategori' => 'required',
            'penulis' => 'required', 
            'penerbit_id' => 'required',
            'kategori' => 'required', 
            'bahasa' => 'required', 
            'perolehan' => 'required', 
            'tahun_terbit' => 'required|numeric|min:4',
            'jumlah' => 'required|numeric',
        ],[
            'judul_buku.required'=> 'Judul Buku Tidak Boleh Kosong',
            'isbn.unique' => 'Data Buku Sudah Ada, Silahkan Dicek Kembali',
            'isbn.numeric' => 'ISBN Harus Berisi Angka',
            'tahun_terbit.min' => 'Silahkan Isi dengan Format Tahun yang Tepat',
            'tahun_terbit.max' => 'Silahkan Isi dengan Format Tahun yang Tepat',
            'jumlah.numeric' => 'Jumlah Harus Berisi Angka',
            'kategori.required' => 'Kategori Harus Diisi',
            'bahasa.required' => 'Bahasa Harus Diisi',
            'perolehan.required' => 'Perolehan Harus Diisi',
            'penerbit_id.required' => 'Penerbit Harus Diisi',

        ]);
       
        $data = Buku::create($request->all());
        if($request->hasFile('sampul')){
            $request->file('sampul')->move('assets/images/sampul/', $request->file('sampul')->getClientOriginalName());
            $data->sampul = $request->file('sampul')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('databuku')->with('addsuccess', 'Buku Berhasil Ditambahkan');
    }

    //Delete Buku
    public function deletebuku($id)
    {
        $data = Buku::find($id);
        $data->delete();
        return redirect()->route('databuku')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

    public function updatebuku(Request $request, $id)
    {
        $data = Buku::find( $id);
        $data->update($request->all());
        if($request->hasFile('sampul')){
            $request->file('sampul')->move('assets/images/sampul/', $request->file('sampul')->getClientOriginalName());
            $data->sampul = $request->file('sampul')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('databuku')->with('updatesuccess', 'Data Berhasil Diperbarui');

    }

    public function exportexcel(){
        return Excel::download(new BukuExport, 'Data_Buku.xlsx');
    }


    public function importexcel(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('assets/data_buku_excel/', $namafile);

        Excel::import(new BukuImport, \public_path('/assets/data_buku_excel/'.$namafile));
        return \redirect()->back()->with('importsuccess', 'Data Berhasil Diimport');;

    }

    public function exportpdf_buku(){
        $data = Buku::all();
        $jen = Jenisbuku::all();
        view()->share('data', $data, $jen);
        $pdf = PDF::loadview('data_buku-pdf');
        return $pdf->download('data_buku.pdf');
    }




}
