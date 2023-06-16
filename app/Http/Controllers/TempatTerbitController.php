<?php

namespace App\Http\Controllers;

use App\Models\TempatTerbit;
use App\Http\Requests\StoreTempatTerbitRequest;
use App\Http\Requests\UpdateTempatTerbitRequest;
use App\Imports\TempatTerbitImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
Use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class TempatTerbitController extends Controller
{
    public function index()
    {   
        $tempatterbits = TempatTerbit::paginate(9999);
        
        return view('tempat_terbit.data_tempat_terbit', compact('tempatterbits'));
    }

    /**
     * Insert Data
     *
     * @return \Illuminate\Http\Response
     */
    public function insertTempatTerbit(Request $request)
    {   

        $rules = [
            'kota' => ['unique:tempat_terbits'],
        ];

        $message = [
            'kota.unique' => 'Data Tempat Terbit Sudah Ada, Silahkan Dicek Kembali',
        ];
        $validasi = Validator::make($request->all(), $rules, $message);

        if ($validasi->fails()) {
            return redirect()
                ->back()
                ->with('add_fails', 'Data Gagal Ditambahkan.')
                ->withErrors($validasi);
        } else {
            $data = TempatTerbit::create($request->all());
        return redirect()->route('dataTempatTerbit')->with('insertsuccess', 'Berhasil Ditambahkan');
        }

       
    }

    //Delete Anggota
    public function deleteTempatTerbit($id)
    {
        $data = TempatTerbit::find($id);
        $data->delete();
        return redirect()->route('dataTempatTerbit')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

    public function updateTempatTerbit(Request $request, $id)
    {
        $data = TempatTerbit::find( $id);
        $data->update($request->all());
        return redirect()->route('dataTempatTerbit')->with('updatesuccess', 'Data Berhasil Diperbarui');

    }

    public function importexcel_tempatterbit(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('assets/data_tempatterbit_excel/', $namafile);

        Excel::import(new TempatTerbitImport, \public_path('/assets/data_tempatterbit_excel/'.$namafile));
        return \redirect()->back()->with('importsuccess', 'Data Berhasil Diimport');;

    }
}
