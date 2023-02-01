<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
use Illuminate\Support\Facades\Auth;
Auth::routes();
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index.html', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// DATA BUKU ROUTE
Route::get('/databuku', [App\Http\Controllers\BukuController::class, 'index'])->name('databuku');
Route::get('/tambahbuku', [App\Http\Controllers\BukuController::class, 'showTambahBuku'])->name('tambahbuku');
Route::post('/insertdata', [App\Http\Controllers\BukuController::class, 'insertdata'])->name('insertdata');
Route::get('/deletebuku/{id}', [App\Http\Controllers\BukuController::class, 'deletebuku'])->name('deletebuku');
Route::post('/updatebuku/{id}', [App\Http\Controllers\BukuController::class, 'updatebuku'])->name('updatebuku');
// upload/import
Route::post('/importexcel', [App\Http\Controllers\BukuController::class, 'importexcel'])->name('importexcel');
//export buku
Route::get('/exportexcel', [App\Http\Controllers\BukuController::class, 'exportexcel'])->name('exportexcel');
Route::get('/exportpdf_buku/', [App\Http\Controllers\BukuController::class, 'exportpdf_buku'])->name('exportpdf_buku');

// PENERBIT ROUTE
Route::get('/dataPenerbit', [App\Http\Controllers\PenerbitController::class, 'index'])->name('dataPenerbit');
Route::post('/insertPenerbit', [App\Http\Controllers\PenerbitController::class, 'insertPenerbit'])->name('insertPenerbit');
Route::post('/updatePenerbit/{id}', [App\Http\Controllers\PenerbitController::class, 'updatePenerbit'])->name('updatePenerbit');
Route::get('/deletePenerbit/{id}', [App\Http\Controllers\PenerbitController::class, 'deletePenerbit'])->name('deletePenerbit');
// upload/import
Route::post('/importexcel_penerbit', [App\Http\Controllers\PenerbitController::class, 'importexcel_penerbit'])->name('importexcel_penerbit');
//export penerbit
Route::get('/exportexcel_penerbit', [App\Http\Controllers\PenerbitController::class, 'exportexcel_penerbit'])->name('exportexcel_penerbit');
Route::get('/exportpdf_penerbit/', [App\Http\Controllers\PenerbitController::class, 'exportpdf_penerbit'])->name('exportpdf_penerbit');

// TEMPAT TERBIT ROUTE
Route::get('/dataTempatTerbit', [App\Http\Controllers\TempatTerbitController::class, 'index'])->name('dataTempatTerbit');
Route::post('/insertTempatTerbit', [App\Http\Controllers\TempatTerbitController::class, 'insertTempatTerbit'])->name('insertTempatTerbit');
Route::post('/updateTempatTerbit/{id}', [App\Http\Controllers\TempatTerbitController::class, 'updateTempatTerbit'])->name('updateTempatTerbit');
Route::get('/deleteTempatTerbit/{id}', [App\Http\Controllers\TempatTerbitController::class, 'deleteTempatTerbit'])->name('deleteTempatTerbit');
// upload/import
Route::post('/importexcel_tempatterbit', [App\Http\Controllers\TempatTerbitController::class, 'importexcel_tempatterbit'])->name('importexcel_tempatterbit');

// MAJALAH ROUTE
Route::get('/dataMajalah', [App\Http\Controllers\MajalahController::class, 'index'])->name('dataMajalah');
Route::post('/insertMajalah', [App\Http\Controllers\MajalahController::class, 'insertMajalah'])->name('insertMajalah');
Route::get('/tambahMajalah', [App\Http\Controllers\MajalahController::class, 'showTambahMajalah'])->name('tambahMajalah');
Route::post('/updateMajalah/{id}', [App\Http\Controllers\MajalahController::class, 'updateMajalah'])->name('updateMajalah');
Route::get('/deleteMajalah/{id}', [App\Http\Controllers\MajalahController::class, 'deleteMajalah'])->name('deleteTempatTerbit');
Route::post('/importexcel_majalah', [App\Http\Controllers\MajalahController::class, 'importexcel_majalah'])->name('importexcel_majalah');
Route::get('/exportexcel_majalah', [App\Http\Controllers\MajalahController::class, 'exportexcel_majalah'])->name('exportexcel_majalah');
Route::get('/exportpdf_majalah/', [App\Http\Controllers\MajalahController::class, 'exportpdf_majalah'])->name('exportpdf_majalah');


// CD ROUTE
Route::get('/dataCD', [App\Http\Controllers\CDController::class, 'index'])->name('dataCD');
Route::post('/insertCD', [App\Http\Controllers\CDController::class, 'insertCD'])->name('insertCD');
Route::get('/tambahCD', [App\Http\Controllers\CDController::class, 'showTambahCD'])->name('tambahCD');
Route::post('/updateCD/{id}', [App\Http\Controllers\CDController::class, 'updateCD'])->name('updateCD');
Route::get('/deleteCD/{id}', [App\Http\Controllers\CDController::class, 'deleteCD'])->name('deleteTempatTerbit');
Route::post('/importexcel_CD', [App\Http\Controllers\CDController::class, 'importexcel_CD'])->name('importexcel_CD');
Route::get('/exportexcel_CD', [App\Http\Controllers\CDController::class, 'exportexcel_CD'])->name('exportexcel_CD');
Route::get('/exportpdf_CD/', [App\Http\Controllers\CDController::class, 'exportpdf_CD'])->name('exportpdf_CD');


// ANGGOTA ROUTE
Route::get('/dataanggota', [App\Http\Controllers\AnggotaController::class, 'index'])->name('dataanggota');
Route::get('/tambahanggota', [App\Http\Controllers\AnggotaController::class, 'showTambahAnggota'])->name('tambahanggota');
Route::post('/insertAnggota', [App\Http\Controllers\AnggotaController::class, 'insertAnggota'])->name('insertAnggota');
Route::post('/updateanggota/{id}', [App\Http\Controllers\AnggotaController::class, 'updateanggota'])->name('updateanggota');
Route::get('/deleteanggota/{id}', [App\Http\Controllers\AnggotaController::class, 'deleteanggota'])->name('deleteanggota');
// upload/import data anggota
Route::post('/importexcel_anggota', [App\Http\Controllers\AnggotaController::class, 'importexcel_anggota'])->name('importexcel_anggota');
//export anggota
Route::get('/exportexcel_anggota', [App\Http\Controllers\AnggotaController::class, 'exportexcel_anggota'])->name('exportexcel_anggota');
Route::get('/exportpdf_anggota/', [App\Http\Controllers\AnggotaController::class, 'exportpdf_anggota'])->name('exportpdf_anggota');
Route::get('/ubahStatusAktif/{id}', [App\Http\Controllers\AnggotaController::class, 'ubahStatusAktif'])->name('ubahStatusAktif');
Route::get('/ubahStatusNonAktif/{id}', [App\Http\Controllers\AnggotaController::class, 'ubahStatusNonAktif'])->name('ubahStatusNonAktif');

// GURU ROUTE
Route::get('/dataguru', [App\Http\Controllers\GuruController::class, 'index'])->name('dataguru');
Route::get('/tambahguru', [App\Http\Controllers\GuruController::class, 'showTambahGuru'])->name('tambahguru');
Route::post('/insertGuru', [App\Http\Controllers\GuruController::class, 'insertGuru'])->name('insertGuru');
Route::post('/updateguru/{id}', [App\Http\Controllers\GuruController::class, 'updateguru'])->name('updateguru');
Route::get('/deleteguru/{id}', [App\Http\Controllers\GuruController::class, 'deleteguru'])->name('deleteguru');
// upload/import data guru
Route::post('/importexcel_guru', [App\Http\Controllers\GuruController::class, 'importexcel_guru'])->name('importexcel_guru');
//export guru
Route::get('/exportexcel_guru', [App\Http\Controllers\GuruController::class, 'exportexcel_guru'])->name('exportexcel_guru');
Route::get('/exportpdf_guru/', [App\Http\Controllers\GuruController::class, 'exportpdf_guru'])->name('exportpdf_guru');
Route::get('/ubahStatusAktifGuru/{id}', [App\Http\Controllers\GuruController::class, 'ubahStatusAktifGuru'])->name('ubahStatusAktifGuru');
Route::get('/ubahStatusNonAktifGuru/{id}', [App\Http\Controllers\GuruController::class, 'ubahStatusNonAktifGuru'])->name('ubahStatusNonAktifGuru');



// JENIS BUKU ROUTE
Route::get('/datajenisbuku', [App\Http\Controllers\JenisbukuController::class, 'index'])->name('datajenisbuku');
Route::get('/tambahjenisbuku', [App\Http\Controllers\JenisbukuController::class, 'showTambahjenisbuku'])->name('tambahjenisbuku');
Route::post('/insertJenisbuku', [App\Http\Controllers\JenisbukuController::class, 'insertJenisbuku'])->name('insertJenisbuku');
Route::post('/updateJenisBuku/{id}', [App\Http\Controllers\JenisbukuController::class, 'updateJenisbuku'])->name('updateJenisBuku');
Route::get('/deleteJenisbuku/{id}', [App\Http\Controllers\JenisbukuController::class, 'deleteJenisbuku'])->name('deleteJenisbuku');
// upload/import data anggota
Route::post('/importexcel_jenisbuku', [App\Http\Controllers\JenisbukuController::class, 'importexcel_jenisbuku'])->name('importexcel_jenisbuku');
//export jenisbuku
Route::get('/exportexcel_jenisbuku', [App\Http\Controllers\JenisbukuController::class, 'exportexcel_jenisbuku'])->name('exportexcel_jenisbuku');
Route::get('/exportpdf_jenisbuku', [App\Http\Controllers\JenisbukuController::class, 'exportpdf_jenisbuku'])->name('exportpdf_jenisbuku');

Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('kategori');

//TRANSAKSI ROUTE
Route::get('/peminjaman', [App\Http\Controllers\TransaksiController::class, 'showPeminjaman'])->name('peminjaman');
Route::get('/showTambahPeminjaman', [App\Http\Controllers\TransaksiController::class, 'showTambahPeminjaman'])->name('showTambahPeminjaman');
Route::post('/tambah_peminjaman', [App\Http\Controllers\TransaksiController::class, 'tambah_peminjaman'])->name('tambah_peminjaman');
Route::get('/pengembalian', [App\Http\Controllers\TransaksiController::class, 'showPengembalian'])->name('pengembalian');
Route::get('/kembalikan/{id}', [App\Http\Controllers\TransaksiController::class, 'kembalikan'])->name('kembalikan');
Route::get('/perpanjang/{id}', [App\Http\Controllers\TransaksiController::class, 'perpanjang'])->name('perpanjang');
Route::get('/exportpdf_peminjaman', [App\Http\Controllers\TransaksiController::class, 'exportpdf_peminjaman'])->name('exportpdf_peminjaman');
Route::get('/exportpdf_pengembalian', [App\Http\Controllers\TransaksiController::class, 'exportpdf_pengembalian'])->name('exportpdf_pengembalian');
Route::get('/exportexcel_peminjaman', [App\Http\Controllers\TransaksiController::class, 'exportexcel_peminjaman'])->name('exportexcel_peminjaman');
Route::get('/exportexcel_pengembalian', [App\Http\Controllers\TransaksiController::class, 'exportexcel_pengembalian'])->name('exportexcel_pengembalian');
Route::get('/deletePengembalian/{id}', [App\Http\Controllers\TransaksiController::class, 'deletePengembalian'])->name('deletePengembalian');

//transaksi guru
Route::get('/peminjaman_guru', [App\Http\Controllers\TransaksiController::class, 'showPeminjamanGuru'])->name('peminjaman_guru');
Route::get('/pengembalian_guru', [App\Http\Controllers\TransaksiController::class, 'showPengembalianGuru'])->name('pengembalian_guru');

Route::get('/pengaturan/{id}', [App\Http\Controllers\PengaturanController::class, 'showPengaturan'])->name('pengaturan');
Route::post('/updateAdmin/{id}', [App\Http\Controllers\PengaturanController::class, 'updateAdmin'])->name('updateAdmin');

//update foto profil
Route::post('/updateFotoProfil/', [App\Http\Controllers\PengaturanController::class, 'updateFotoProfil'])->name('updateFotoProfil');
