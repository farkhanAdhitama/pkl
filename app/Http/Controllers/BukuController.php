<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $bukus = Buku::all();
        
        return view('databuku', compact('bukus'));
    }

    /**
     * Display tambah buku page
     */
    public function showTambahBuku()
    {  
        return view('tambahbuku');
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
        return redirect()->route('tambahbuku')->with('success', 'Buku Berhasil Ditambahkan');
    }

    //Delete Buku
    public function deletebuku($id)
    {
        $data = Buku::find($id);
        $data->delete();
        return redirect()->route('databuku')->with('success', 'Data Berhasil Dihapus');

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




}
