<?php

namespace App\Http\Controllers;

use App\Models\Jenisbuku;
use App\Http\Requests\StoreJenisbukuRequest;
use App\Http\Requests\UpdateJenisbukuRequest;
use Illuminate\Http\Request;


class JenisbukuController extends Controller
{
    public function index()
    {   
        $jenisbukus = Jenisbuku::all();
        
        return view('datajenisbuku', compact('jenisbukus'));
    }

    /**
     * Display tambah jenis buku page
     */
    public function showTambahJenisBuku()
    {  
        return view('tambahjenisbuku');
    }
    

    /**
     * Insert Data
     *
     * @return \Illuminate\Http\Response
     */
    public function insertJenisbuku(Request $request)
    {   
        $validated = $request->validate([
            'nama' => 'required|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
        ]);

        $data = Jenisbuku::create($request->all());
        return redirect()->route('datajenisbuku')->with('insertsuccess', 'Jenis Buku Berhasil Ditambahkan');
    }

    //Delete Anggota
    public function deleteJenisbuku($id)
    {
        $data = Jenisbuku::find($id);
        $data->delete();
        return redirect()->route('datajenisbuku')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

    public function updateJenisBuku(Request $request, $id)
    {
        $data = Jenisbuku::find( $id);
        $data->update($request->all());
        return redirect()->route('datajenisbuku')->with('updatesuccess', 'Data Berhasil Diperbarui');

    }
}




