<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Models\Siswa;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;



class SiswaController extends Controller
{

    public function index(Request $request)
    {   
        $anggotas = Siswa::paginate(1000000);
        $members = Siswa::all();
        foreach ($members as $anggota){
            $id_anggota = $anggota->id;
            $result = now()->diffInDays($anggota->masa_berlaku, false);
            if($result < 0){
                $anggota::where('id', $id_anggota)->update(['status' => "NonAktif"]);
            }
        }
        return view('dataanggota', compact('anggotas'));
    }

    /**
     * Display tambah anggota page
     */
    public function showTambahSiswa()
    {  
        return view('tambahanggota');
    }
    

    /**
     * Insert Data
     *
     * @return \Illuminate\Http\Response
     */
    public function insertSiswa(Request $request)
    {   
        $validated = $request->validate([
            'nama' => 'required|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'nis' => 'required|numeric|unique:anggotas',
            'kelas' => 'required', 
            
            
        ],[
            'nama.regex' => 'Nama Harus Berisi Alphabet',
            'nis.numeric' => 'NIS Harus Berisi Angka',
            'nis.required' => 'NIS Sudah Ada',
            'kelas.required' => 'Kelas Harus Diisi'
        ]);

        $data = Siswa::create($request->all());
        if($request->hasFile('foto_anggota')){
            $request->file('foto_anggota')->move('assets/images/foto_anggota/', $request->file('foto_anggota')->getClientOriginalName());
            $data->foto_anggota = $request->file('foto_anggota')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('dataanggota')->with('insertsuccess', 'Siswa Berhasil Ditambahkan');
    }

    //Delete Siswa
    public function deleteanggota($id)
    {
        $data = Siswa::find($id);
        $data->delete();
        return redirect()->route('dataanggota')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

    public function updateanggota(Request $request, $id)
    {
        $data = Siswa::find( $id);
        $data->update($request->all());
        if($request->hasFile('foto_anggota')){
            $request->file('foto_anggota')->move('assets/images/foto_anggota/', $request->file('foto_anggota')->getClientOriginalName());
            $data->foto_anggota = $request->file('foto_anggota')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('dataanggota')->with('updatesuccess', 'Data Berhasil Diperbarui');

    }

    // public function exportexcel_anggota(){
    //     return Excel::download(new SiswaExport, 'Data_Siswa.xlsx');
    // }

    // public function importexcel_anggota(Request $request)
    // {
    //     $data = $request->file('file');
    //     $namafile = $data->getClientOriginalName();
    //     $data->move('assets/data_anggota_excel/', $namafile);

    //     Excel::import(new SiswaImport, \public_path('/assets/data_anggota_excel/'.$namafile));
    //     return \redirect()->back()->with('importsuccess', 'Data Berhasil Diimport');;

    // }

    public function exportpdf_anggota(){
        $data = Siswa::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('data_anggota-pdf');
        return $pdf->download('data_anggota.pdf');
    }

    public function ubahStatusNonAktif(Request $request,$id)
    {   
        $data = Siswa::where('id', $id)->update(['status' => "NonAktif"]);
        return redirect()->route('dataanggota')->with('succesUbahStatus', 'Status Diubah');

    }

    public function ubahStatusAktif(Request $request,$id)
    {   
        $data = Siswa::where('id', $id)->update(['status' => "Aktif"]);
        return redirect()->route('dataanggota')->with('succesUbahStatus', 'Status Diubah');

    }
}