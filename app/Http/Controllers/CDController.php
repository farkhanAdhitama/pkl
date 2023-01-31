<?php

namespace App\Http\Controllers;

use App\Exports\CDExport;
use App\Models\CD;
use App\Http\Requests\StoreCDRequest;
use App\Http\Requests\UpdateCDRequest;
use App\Imports\CDImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
Use Barryvdh\DomPDF\Facade\Pdf;

class CDController extends Controller
{
    public function index()
    {   
        $cds = CD::paginate(99999);
        
        return view('cd.data_cd', compact('cds'));
    }

    /**
     * Display tambah cd
     */
    public function showTambahCD()
    {  
        return view('cd.tambah_cd');
    }
    

    /**
     * Insert Data
     *
     * @return \Illuminate\Http\Response
     */
    public function insertCD(Request $request)
    {   

        $data = CD::create($request->all());
        return redirect()->route('dataCD')->with('insertsuccess', 'CD Berhasil Ditambahkan');
    }

    //Delete CD
    public function deleteCD($id)
    {
        $data = CD::find($id);
        $data->delete();
        return redirect()->route('dataCD')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

    public function updateCD(Request $request, $id)
    {
        $data = CD::find( $id);
        $data->update($request->all());
        return redirect()->route('dataCD')->with('updatesuccess', 'Data Berhasil Diperbarui');

    }

    public function exportexcel_CD(){
        return Excel::download(new CDExport, 'Data_CD.xlsx');
    }

    public function importexcel_cd(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('assets/data_cd_excel/', $namafile);

        Excel::import(new CDImport, \public_path('/assets/data_cd_excel/'.$namafile));
        return redirect()->back()->with('importsuccess', 'Data Berhasil Diimport');;

    }

    public function exportpdf_cd(){
        $data = CD::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('cd.data_cd-pdf');
        return $pdf->download('data_cd.pdf');
    }
}

