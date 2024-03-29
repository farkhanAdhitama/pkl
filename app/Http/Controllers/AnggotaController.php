<?php

namespace App\Http\Controllers;

use App\Exports\AnggotaExport;
use App\Models\Anggota;
use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
use App\Imports\AnggotaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class AnggotaController extends Controller
{

    public function index(Request $request)
    {   
        $anggotas = Anggota::all();
        $members = Anggota::all();
        foreach ($members as $anggota){
            $id_anggota = $anggota->id;
            $result = now()->diffInDays($anggota->masa_berlaku, false);
            if($result < 0){
                $anggota::where('id', $id_anggota)->update(['status' => "NonAktif"]);
            }
        }
        return view('anggota.dataanggota', compact('anggotas'));
    }

    /**
     * Display tambah anggota page
     */
    public function showTambahAnggota()
    {  
        return view('anggota.tambahanggota');
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
            'nis' => 'required|numeric|unique:anggotas',
            'kelas' => 'required', 
            
            
        ],[
            'nama.regex' => 'Nama Harus Berisi Alphabet',
            'nis.numeric' => 'NIS Harus Berisi Angka',
            'nis.unique' => 'NIS Sudah Ada',
            'kelas.required' => 'Kelas Harus Diisi'
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
        if ($data->foto_anggota != 'person.png') {
            if (File::exists(public_path('assets/images/foto_anggota/'.$data->foto_anggota))) {
                File::delete(public_path('assets/images/foto_anggota/'.$data->foto_anggota));
            }
        }
        $data->delete();
        return redirect()->route('dataanggota')->with('deletesuccess', 'Data Berhasil Dihapus');

    }

    //Delete Anggota All
    public function deleteAnggotaAll()
    {
        Anggota::getQuery()->delete();
        return redirect()->route('dataanggota')->with('deletesuccess_all', 'Data Berhasil Dihapus');

    }

     //Delete Anggota Non
    public function deleteAnggotaNonAktif()
    {
        Anggota::where("status", "NonAktif")->getQuery()->delete();
        return redirect()->route('dataanggota')->with('deletesuccess_non', 'Data Berhasil Dihapus');

    }

    public function updateanggota(Request $request, $id)
    {
        $data = Anggota::find( $id);
        $data->update($request->all());
        if($request->hasFile('foto_anggota')){
            if ($data->foto_anggota != 'person.png') {
                File::delete(public_path('assets/images/foto_anggota/'.$data->foto_anggota));
            }
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

    public function exportpdf_anggota(){
        $data = Anggota::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('anggota.data_anggota-pdf');
        return $pdf->download('data_anggota.pdf');
    }

    public function ubahStatusNonAktif(Request $request,$id)
    {   
        $data = Anggota::where('id', $id)->update(['status' => "NonAktif"]);
        return redirect()->route('dataanggota')->with('succesUbahStatus', 'Status Diubah');

    }

    public function ubahStatusAktif(Request $request,$id)
    {   
        $data = Anggota::where('id', $id)->update(['status' => "Aktif"]);
        return redirect()->route('dataanggota')->with('succesUbahStatus', 'Status Diubah');

    }
}