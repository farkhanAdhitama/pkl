<?php

namespace App\Http\Controllers;

use App\Exports\GuruExport;
use App\Models\Guru;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use App\Imports\GuruImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class GuruController extends Controller
{
    public function index()
    {   
        $gurus = Guru::paginate(1000000);
        
        return view('guru.dataguru', compact('gurus'));
    }

    /**
     * Display tambah guru page
     */
    public function showTambahGuru()
    {  
        return view('guru.tambahguru');
    }
    

    /**
     * Insert Data
     *
     * @return \Illuminate\Http\Response
     */
    public function insertGuru(Request $request)
    {   
        $validated = $request->validate([
            'nama' => 'required|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'nik' => 'required|numeric|unique:gurus',
            'masa_berlaku' => 'required', 
            'jabatan' => 'required', 
            
            
        ],[
            'nama.regex' => 'Nama Harus Berisi Alphabet',
            'nik.numeric' => 'NIS Harus Berisi Angka',
            'nik.unique' => 'NIS Sudah Ada',
            'jabatan.required' => 'Jabatan Harus Diisi',
            'masa_berlaku.required' => 'Masa Berlaku Harus Diisi',

        ]);

        $data = Guru::create($request->all());
        if($request->hasFile('foto_guru')){
            $request->file('foto_guru')->move('assets/images/foto_guru/', $request->file('foto_guru')->getClientOriginalName());
            $data->foto_guru = $request->file('foto_guru')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('dataguru')->with('insertsuccess', 'Guru Berhasil Ditambahkan');
    }

    //Delete Anggota
    public function deleteguru($id)
    {
        $data = Guru::find($id);
        $data->delete();
        return redirect()->route('dataguru')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

    public function updateguru(Request $request, $id)
    {
        $data = Guru::find( $id);
        $data->update($request->all());
        if($request->hasFile('foto_guru')){
            $request->file('foto_guru')->move('assets/images/foto_guru/', $request->file('foto_guru')->getClientOriginalName());
            $data->foto_guru = $request->file('foto_guru')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('dataguru')->with('updatesuccess', 'Data Berhasil Diperbarui');

    }

    public function exportexcel_guru(){
        return Excel::download(new GuruExport, 'Data_Guru.xlsx');
    }

    public function importexcel_guru(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('assets/data_guru_excel/', $namafile);

        Excel::import(new GuruImport, \public_path('/assets/data_guru_excel/'.$namafile));
        return \redirect()->back()->with('importsuccess', 'Data Berhasil Diimport');;

    }

    public function exportpdf_guru(){
        $data = Guru::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('guru.data_guru-pdf');
        return $pdf->download('data_guru.pdf');
    }

    public function ubahStatusNonAktifGuru(Request $request,$id)
    {   
        $data = Guru::where('id', $id)->update(['status' => "NonAktif"]);
        return redirect()->route('dataguru')->with('succesUbahStatus', 'Status Diubah');

    }

    public function ubahStatusAktifGuru(Request $request,$id)
    {   
        $data = Guru::where('id', $id)->update(['status' => "Aktif"]);
        return redirect()->route('dataguru')->with('succesUbahStatus', 'Status Diubah');

    }
}