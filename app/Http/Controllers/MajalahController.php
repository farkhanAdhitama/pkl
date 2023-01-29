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
        $majalahs = Majalah::paginate(99999);
        
        return view('majalah.data_majalah', compact('majalahs'));
    }

    /**
     * Display tambah majalah
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

        $data = Majalah::create($request->all());
        return redirect()->route('dataMajalah')->with('insertsuccess', 'Majalah Berhasil Ditambahkan');
    }

    //Delete Anggota
    public function deleteMajalah($id)
    {
        $data = Majalah::find($id);
        $data->delete();
        return redirect()->route('dataMajalah')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

    public function updateMajalah(Request $request, $id)
    {
        $data = Majalah::find( $id);
        $data->update($request->all());
        return redirect()->route('dataMajalah')->with('updatesuccess', 'Data Berhasil Diperbarui');

    }

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
