<?php

namespace App\Http\Controllers;

use App\Exports\PenerbitExport;
use App\Models\Penerbit;
use App\Http\Requests\StorePenerbitRequest;
use App\Http\Requests\UpdatePenerbitRequest;
use Illuminate\Http\Request;
use App\Imports\JenisbukuImport;
use App\Imports\PenerbitImport;
use Maatwebsite\Excel\Facades\Excel;
Use Barryvdh\DomPDF\Facade\Pdf;


class PenerbitController extends Controller
{
    public function index()
    {   
        $penerbits = Penerbit::paginate(9999);
        
        return view('penerbit.data_penerbit', compact('penerbits'));
    }

    /**
     * Insert Data
     *
     * @return \Illuminate\Http\Response
     */
    public function insertPenerbit(Request $request)
    {    $validated = $request->validate([
            'nama_penerbit' => 'required|unique:majalahs|numeric',
        ],[
            'nama_penerbit.unique' => 'Data Majalah Sudah Ada, Silahkan Dicek Kembali',
        ]);
        $data = Penerbit::create($request->all());
        return redirect()->route('dataPenerbit')->with('insertsuccess', 'Penerbit Berhasil Ditambahkan');
    }

    //Delete Anggota
    public function deletePenerbit($id)
    {
        $data = Penerbit::find($id);
        $data->delete();
        return redirect()->route('dataPenerbit')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

    public function updatePenerbit(Request $request, $id)
    {
        $data = Penerbit::find( $id);
        $data->update($request->all());
        return redirect()->route('dataPenerbit')->with('updatesuccess', 'Data Berhasil Diperbarui');

    }

    public function exportexcel_penerbit(){
        return Excel::download(new PenerbitExport, 'Data_Penerbit.xlsx');
    }

    public function importexcel_penerbit(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('assets/data_penerbit_excel/', $namafile);

        Excel::import(new PenerbitImport, \public_path('/assets/data_penerbit_excel/'.$namafile));
        return \redirect()->back()->with('importsuccess', 'Data Berhasil Diimport');;

    }

    public function exportpdf_penerbit(){
        $data = Penerbit::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('penerbit.data_penerbit-pdf');
        return $pdf->download('data_penerbit.pdf');
    }
}
