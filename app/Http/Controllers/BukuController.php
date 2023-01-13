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

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $bukus = Buku::with('jenis')->paginate(5);
        $jen = Jenisbuku::all();
        return view('databuku', compact('bukus'), compact('jen'));
    }

    /**
     * Display tambah buku page
     */
    public function showTambahBuku()
    {  
       $jen = Jenisbuku::all();
        return view('tambahbuku', compact('jen'));
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
        return Excel::download(new BukuExport, 'databuku.xlsx');
    }




}
