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

Route::get('/databuku', [App\Http\Controllers\BukuController::class, 'index'])->name('databuku');
Route::get('/tambahbuku', [App\Http\Controllers\BukuController::class, 'showTambahBuku'])->name('tambahbuku');
Route::post('/insertdata', [App\Http\Controllers\BukuController::class, 'insertdata'])->name('insertdata');
Route::get('/deletebuku/{id}', [App\Http\Controllers\BukuController::class, 'deletebuku'])->name('deletebuku');
Route::post('/updatebuku/{id}', [App\Http\Controllers\BukuController::class, 'updatebuku'])->name('updatebuku');

// upload/import
Route::get('/importexcel', [App\Http\Controllers\BukuController::class, 'importexcel'])->name('importexcel');
//export buku
Route::get('/exportexcel', [App\Http\Controllers\BukuController::class, 'exportexcel'])->name('exportexcel');

Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('kategori');
Route::get('/peminjaman', [App\Http\Controllers\PeminjamanController::class, 'showPeminjaman'])->name('peminjaman');
Route::get('/pengembalian', [App\Http\Controllers\PengembalianController::class, 'showPengembalian'])->name('pengembalian');
Route::get('/pengaturan', [App\Http\Controllers\PengaturanController::class, 'showPengaturan'])->name('pengaturan');

// anggota route
Route::get('/dataanggota', [App\Http\Controllers\AnggotaController::class, 'index'])->name('dataanggota');
Route::get('/tambahanggota', [App\Http\Controllers\AnggotaController::class, 'showTambahAnggota'])->name('tambahanggota');
Route::post('/insertAnggota', [App\Http\Controllers\AnggotaController::class, 'insertAnggota'])->name('insertAnggota');
Route::post('/updateanggota/{id}', [App\Http\Controllers\AnggotaController::class, 'updateanggota'])->name('updateanggota');
Route::get('/deleteanggota/{id}', [App\Http\Controllers\AnggotaController::class, 'deleteanggota'])->name('deleteanggota');

// anggota route
Route::get('/datajenisbuku', [App\Http\Controllers\JenisbukuController::class, 'index'])->name('datajenisbuku');
Route::get('/tambahjenisbuku', [App\Http\Controllers\JenisbukuController::class, 'showTambahjenisbuku'])->name('tambahjenisbuku');
Route::post('/insertJenisbuku', [App\Http\Controllers\JenisbukuController::class, 'insertJenisbuku'])->name('insertJenisbuku');
Route::post('/updateJenisBuku/{id}', [App\Http\Controllers\JenisbukuController::class, 'updateJenisbuku'])->name('updateJenisBuku');
Route::get('/deleteJenisbuku/{id}', [App\Http\Controllers\JenisbukuController::class, 'deleteJenisbuku'])->name('deleteJenisbuku');
