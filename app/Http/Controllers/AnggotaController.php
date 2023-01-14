<?php

namespace App\Http\Controllers;

use App\Exports\AnggotaExport;
use App\Models\Anggota;
use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
use App\Imports\AnggotaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class AnggotaController extends Controller
{

    public function index()
    {   
        $anggotas = Anggota::paginate(1000000);
        
        return view('dataanggota', compact('anggotas'));
    }

    /**
     * Display tambah anggota page
     */
    public function showTambahAnggota()
    {  
        return view('tambahanggota');
    }
    

    /**
     * Insert Data
     *
     * @return \Illuminate\Http\Response
     */
    public function insertAnggota(Request $request)
    {   
        $validated = $request->validate([
            'nama' => 'required|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'nis' => 'required|numeric',
            'kelas' => 'required', 
            
        ]);

        $data = Anggota::create($request->all());
        if($request->hasFile('foto_anggota')){
            $request->file('foto_anggota')->move('assets/images/foto_anggota/', $request->file('foto_anggota')->getClientOriginalName());
            $data->foto_anggota = $request->file('foto_anggota')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('dataanggota')->with('insertsuccess', 'Anggota Berhasil Ditambahkan');
    }

    //Delete Anggota
    public function deleteanggota($id)
    {
        $data = Anggota::find($id);
        $data->delete();
        return redirect()->route('dataanggota')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

    public function updateanggota(Request $request, $id)
    {
        $data = Anggota::find( $id);
        $data->update($request->all());
        if($request->hasFile('foto_anggota')){
            $request->file('foto_anggota')->move('assets/images/foto_anggota/', $request->file('foto_anggota')->getClientOriginalName());
            $data->foto_anggota = $request->file('foto_anggota')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('dataanggota')->with('updatesuccess', 'Data Berhasil Diperbarui');

    }

    public function exportexcel_anggota(){
        return Excel::download(new AnggotaExport, 'Data_Anggota.xlsx');
    }

    public function importexcel_anggota(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('assets/data_anggota_excel/', $namafile);

        Excel::import(new AnggotaImport, \public_path('/assets/data_anggota_excel/'.$namafile));
        return \redirect()->back()->with('importsuccess', 'Data Berhasil Diimport');;

    }

}