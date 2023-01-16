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
        $bukus = Buku::paginate(99999);
        // $jen = Jenisbuku::all();
        $jenisbukus = Jenisbuku::all();
        return view('databuku', compact('bukus'), compact('jenisbukus'));
    }

    /**
     * Display tambah buku page
     */
    public function showTambahBuku()
    {  
        //$jen = Jenisbuku::all();
        $bukus = Buku::paginate(99999);
        $jenisbukus = Jenisbuku::all();
        return view('tambahbuku', compact('jenisbukus'));
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
            'isbn' => 'required|min:13|max:13|',
            'kategori' => 'required',
            'penulis' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/', 
            'penerbit' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'tahun_terbit' => 'required|min:4|max:4|',
            'jumlah' => 'required|numeric',
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
        view()->share('data', $data);
        $pdf = PDF::loadview('data_buku-pdf');
        return $pdf->download('data_buku.pdf');
    }




}
