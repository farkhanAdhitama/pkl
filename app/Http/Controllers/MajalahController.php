<?php

namespace App\Http\Controllers;

use App\Exports\MajalahExport;
use App\Models\Majalah;
use App\Http\Requests\StoreMajalahRequest;
use App\Http\Requests\UpdateMajalahRequest;
use App\Imports\MajalahImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
Use Barryvdh\DomPDF\Facade\Pdf;


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

        $validated = $request->validate([
            'issn' => 'required|unique:majalahs|numeric',
            'nomor' => 'required|numeric',
            'volume' => 'required|numeric', 
            'tahun' => 'required|numeric|min:4',
           
        ],[
            'issn.unique' => 'Data Majalah Sudah Ada, Silahkan Dicek Kembali',
            'isbn.numeric' => 'ISBN Harus Berisi Angka',
            'nomor.numeric' => 'Nomor Harus Berisi Angka',
            'volume.numeric' => 'Volume Harus Berisi Angka',
            'tahun.numeric' => 'Tahun Harus Berisi Angka',
            'tahun.min' => 'Format Tahun Salah',
        ]);

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

    public function exportexcel_majalah(){
        return Excel::download(new MajalahExport, 'Data_Majalah.xlsx');
    }

    public function importexcel_majalah(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('assets/data_majalah_excel/', $namafile);

        Excel::import(new MajalahImport, \public_path('/assets/data_majalah_excel/'.$namafile));
        return redirect()->back()->with('importsuccess', 'Data Berhasil Diimport');;

    }

    public function exportpdf_majalah(){
        $data = Majalah::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('majalah.data_majalah-pdf');
        return $pdf->download('data_majalah.pdf');
    }
}
