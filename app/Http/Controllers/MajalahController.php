<?php

namespace App\Http\Controllers;

use App\Models\Majalah;
use App\Http\Requests\StoreMajalahRequest;
use App\Http\Requests\UpdateMajalahRequest;
use Illuminate\Http\Request;



class MajalahController extends Controller
{
    public function index()
    {   
        $majalahs = Majalah::all();
        
        return view('majalah.data_majalah', compact('majalahs'));
    }

    /**
     * Display tambah jenis buku page
     */
    public function showTambahMajalah()
    {  
        return view('majalah.tambah_majalah');
    }
    

    /**
     * Insert Data
     *
     * @return \Illuminate\Http\Response
     */
    public function insertMajalah(Request $request)
    {   
        $validated = $request->validate([
            'nama' => 'required|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|unique:jenisbukus',
        ],[
            'nama.unique'=> 'Jenis Buku Sudah Ada',
            'nama.regex' => 'Jenis Buku Harus Berisi Alphabet',
        ]);

        $data = Majalah::create($request->all());
        return redirect()->route('tambahMajalah')->with('insertsuccess', 'Jenis Buku Berhasil Ditambahkan');
    }

    // //Delete Anggota
    // public function deleteJenisbuku($id)
    // {
    //     $data = Jenisbuku::find($id);
    //     $data->delete();
    //     return redirect()->route('datajenisbuku')->with('deletesuccess', 'Data Berhasil Dihapus');

    // }

    // public function updateJenisBuku(Request $request, $id)
    // {
    //     $data = Jenisbuku::find( $id);
    //     $data->update($request->all());
    //     return redirect()->route('datajenisbuku')->with('updatesuccess', 'Data Berhasil Diperbarui');

    // }

    // public function exportexcel_jenisbuku(){
    //     return Excel::download(new JenisbukuExport, 'Data_Jenisbuku.xlsx');
    // }

    // public function importexcel_jenisbuku(Request $request)
    // {
    //     $data = $request->file('file');
    //     $namafile = $data->getClientOriginalName();
    //     $data->move('assets/data_jenisbuku_excel/', $namafile);

    //     Excel::import(new JenisbukuImport, \public_path('/assets/data_jenisbuku_excel/'.$namafile));
    //     return \redirect()->back()->with('importsuccess', 'Data Berhasil Diimport');;

    // }

    // public function exportpdf_jenisbuku(){
    //     $data = Jenisbuku::all();
    //     view()->share('data', $data);
    //     $pdf = PDF::loadview('data_jenisbuku-pdf');
    //     return $pdf->download('data_jenisbuku.pdf');
    // }
}
