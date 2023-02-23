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
use Illuminate\Support\Facades\Auth;
Auth::routes();


Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth', 'ceklevel:Operator']], function() {
    //DATA PENGGUNA
    Route::get('/data_pengguna', [App\Http\Controllers\DataPenggunaController::class, 'index'])->name('data_pengguna');
    Route::post('/insertPengguna', [App\Http\Controllers\DataPenggunaController::class, 'insertPengguna'])->name('insertPengguna');
    Route::get('/deleteUser/{id}', [App\Http\Controllers\DataPenggunaController::class, 'deleteUser'])->name('deleteUser');
    Route::post('/updateUser/{id}', [App\Http\Controllers\DataPenggunaController::class, 'updateUser'])->name('updateUser');

});


Route::group(['middleware' => ['auth', 'ceklevel:Administrator,Operator']], function() {

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
    Route::get('/exportexcel_buku/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\BukuController::class, 'exportexcel_buku'])->name('exportexcel_buku');
    Route::get('/exportpdf_buku/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\BukuController::class, 'exportpdf_buku'])->name('exportpdf_buku');

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
    Route::get('/exportexcel_majalah/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\MajalahController::class, 'exportexcel_majalah'])->name('exportexcel_majalah');
    Route::get('/exportpdf_majalah/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\MajalahController::class, 'exportpdf_majalah'])->name('exportpdf_majalah');

    // CD ROUTE
    Route::get('/dataCD', [App\Http\Controllers\CDController::class, 'index'])->name('dataCD');
    Route::post('/insertCD', [App\Http\Controllers\CDController::class, 'insertCD'])->name('insertCD');
    Route::get('/tambahCD', [App\Http\Controllers\CDController::class, 'showTambahCD'])->name('tambahCD');
    Route::post('/updateCD/{id}', [App\Http\Controllers\CDController::class, 'updateCD'])->name('updateCD');
    Route::get('/deleteCD/{id}', [App\Http\Controllers\CDController::class, 'deleteCD'])->name('deleteTempatTerbit');
    Route::post('/importexcel_CD', [App\Http\Controllers\CDController::class, 'importexcel_CD'])->name('importexcel_CD');
    Route::get('/exportexcel_CD/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\CDController::class, 'exportexcel_CD'])->name('exportexcel_CD');
    Route::get('/exportpdf_CD/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\CDController::class, 'exportpdf_CD'])->name('exportpdf_CD');

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
    Route::get('/deleteAnggotaAll', [App\Http\Controllers\AnggotaController::class, 'deleteAnggotaAll'])->name('deleteAnggotaAll');
    Route::get('/deleteAnggotaNonAktif', [App\Http\Controllers\AnggotaController::class, 'deleteAnggotaNonAktif'])->name('deleteAnggotaNonAktif');

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
    Route::get('/deleteGuruAll', [App\Http\Controllers\GuruController::class, 'deleteGuruAll'])->name('deleteGuruAll');
    Route::get('/deleteGuruNonAktif', [App\Http\Controllers\GuruController::class, 'deleteGuruNonAktif'])->name('deleteGuruNonAktif');



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

    //TRANSAKSI SISWA ROUTE
    Route::get('/sendEmail/{email}/{id_siswa}/{nama}/{berkas}/{tenggat}', [App\Http\Controllers\TransaksiSiswaController::class, 'sendEmail'])->name('sendEmail');
    //buku
    Route::get('/peminjaman_buku', [App\Http\Controllers\TransaksiSiswaController::class, 'showPeminjaman'])->name('peminjaman_buku');
    Route::get('/showTambahPeminjaman', [App\Http\Controllers\TransaksiSiswaController::class, 'showTambahPeminjaman'])->name('showTambahPeminjaman');
    Route::post('/tambah_peminjaman', [App\Http\Controllers\TransaksiSiswaController::class, 'tambah_peminjaman'])->name('tambah_peminjaman');
    Route::get('/pengembalian_buku', [App\Http\Controllers\TransaksiSiswaController::class, 'showPengembalian'])->name('pengembalian_buku');
    Route::get('/kembalikan/{id}/{id_buku}', [App\Http\Controllers\TransaksiSiswaController::class, 'kembalikan'])->name('kembalikan');
    Route::get('/perpanjang/{id}', [App\Http\Controllers\TransaksiSiswaController::class, 'perpanjang'])->name('perpanjang');
    Route::get('/exportpdf_peminjaman', [App\Http\Controllers\TransaksiSiswaController::class, 'exportpdf_peminjaman'])->name('exportpdf_peminjaman');
    Route::get('/exportpdf_pengembalian', [App\Http\Controllers\TransaksiSiswaController::class, 'exportpdf_pengembalian'])->name('exportpdf_pengembalian');
    Route::get('/exportexcel_peminjaman', [App\Http\Controllers\TransaksiSiswaController::class, 'exportexcel_peminjaman'])->name('exportexcel_peminjaman');
    Route::get('/exportexcel_pengembalian', [App\Http\Controllers\TransaksiSiswaController::class, 'exportexcel_pengembalian'])->name('exportexcel_pengembalian');
    Route::get('/deletePengembalianBukuSiswa/{id}', [App\Http\Controllers\TransaksiSiswaController::class, 'deletePengembalianBukuSiswa'])->name('deletePengembalianBukuSiswa');
    //majalah
    Route::get('/peminjaman_majalah', [App\Http\Controllers\TransaksiSiswaController::class, 'showPeminjamanMajalah'])->name('peminjaman_majalah');
    Route::post('/tambah_peminjaman_majalah', [App\Http\Controllers\TransaksiSiswaController::class, 'tambah_peminjaman_majalah'])->name('tambah_peminjaman_majalah');
    Route::get('/pengembalian_majalah', [App\Http\Controllers\TransaksiSiswaController::class, 'showPengembalianMajalah'])->name('pengembalian_majalah');
    Route::get('/kembalikan_majalah/{id}/{id_buku}', [App\Http\Controllers\TransaksiSiswaController::class, 'kembalikan_majalah'])->name('kembalikan_majalah');
    Route::get('/perpanjang_majalah/{id}', [App\Http\Controllers\TransaksiSiswaController::class, 'perpanjang_majalah'])->name('perpanjang_majalah');
    Route::get('/exportpdf_peminjaman_majalah', [App\Http\Controllers\TransaksiSiswaController::class, 'exportpdf_peminjaman_majalah'])->name('exportpdf_peminjaman_majalah');
    Route::get('/exportpdf_pengembalian_majalah', [App\Http\Controllers\TransaksiSiswaController::class, 'exportpdf_pengembalian_majalah'])->name('exportpdf_pengembalian_majalah');
    Route::get('/exportexcel_peminjaman_majalah', [App\Http\Controllers\TransaksiSiswaController::class, 'exportexcel_peminjaman_majalah'])->name('exportexcel_peminjaman_majalah');
    Route::get('/exportexcel_pengembalian_majalah', [App\Http\Controllers\TransaksiSiswaController::class, 'exportexcel_pengembalian_majalah'])->name('exportexcel_pengembalian_majalah');
    Route::get('/deletePengembalianMajalahSiswa/{id}', [App\Http\Controllers\TransaksiSiswaController::class, 'deletePengembalianMajalahSiswa'])->name('deletePengembalianMajalahSiswa');
    //cd
    Route::get('/peminjaman_cd', [App\Http\Controllers\TransaksiSiswaController::class, 'showPeminjamanCD'])->name('peminjaman_cd');
    Route::get('/showTambahPeminjaman', [App\Http\Controllers\TransaksiSiswaController::class, 'showTambahPeminjaman'])->name('showTambahPeminjaman');
    Route::post('/tambah_peminjaman_cd', [App\Http\Controllers\TransaksiSiswaController::class, 'tambah_peminjaman_cd'])->name('tambah_peminjaman_cd');
    Route::get('/pengembalian_cd', [App\Http\Controllers\TransaksiSiswaController::class, 'showPengembalianCD'])->name('pengembalian_cd');
    Route::get('/kembalikan_cd/{id}/{id_buku}', [App\Http\Controllers\TransaksiSiswaController::class, 'kembalikan_cd'])->name('kembalikan_cd');
    Route::get('/perpanjang_cd/{id}', [App\Http\Controllers\TransaksiSiswaController::class, 'perpanjang_cd'])->name('perpanjang_cd');
    Route::get('/exportpdf_peminjaman_cd', [App\Http\Controllers\TransaksiSiswaController::class, 'exportpdf_peminjaman_cd'])->name('exportpdf_peminjaman_cd');
    Route::get('/exportpdf_pengembalian_cd', [App\Http\Controllers\TransaksiSiswaController::class, 'exportpdf_pengembalian_cd'])->name('exportpdf_pengembalian_cd');
    Route::get('/exportexcel_peminjaman_cd', [App\Http\Controllers\TransaksiSiswaController::class, 'exportexcel_peminjaman_cd'])->name('exportexcel_peminjaman_cd');
    Route::get('/exportexcel_pengembalian_cd', [App\Http\Controllers\TransaksiSiswaController::class, 'exportexcel_pengembalian_cd'])->name('exportexcel_pengembalian_cd');
    Route::get('/deletePengembalianCDSiswa/{id}', [App\Http\Controllers\TransaksiSiswaController::class, 'deletePengembalianCDSiswa'])->name('deletePengembalianCDSiswa');



    //TRANSAKSI GURU ROUTE
    Route::get('/guru_pinjam', [App\Http\Controllers\TransaksiGuruController::class, 'showPeminjamanGuru'])->name('guru_pinjam');
    Route::get('/guru_kembali', [App\Http\Controllers\TransaksiGuruController::class, 'showPengembalianGuru'])->name('guru_kembali');
    Route::post('/tambah_peminjaman_buku_guru', [App\Http\Controllers\TransaksiGuruController::class, 'tambah_peminjaman_buku_guru'])->name('tambah_peminjaman_buku_guru');
    Route::get('/kembalikan_buku_guru/{id}/{id_buku}', [App\Http\Controllers\TransaksiGuruController::class, 'kembalikan_buku_guru'])->name('kembalikan_buku_guru');
    Route::get('/perpanjang_buku/{id}', [App\Http\Controllers\TransaksiGuruController::class, 'perpanjang_buku'])->name('perpanjang_buku');
    Route::get('/deletePengembalianBuku/{id}', [App\Http\Controllers\TransaksiGuruController::class, 'deletePengembalianBuku'])->name('deletePengembalianBuku');
    Route::get('/exportpdf_peminjaman_buku_guru', [App\Http\Controllers\TransaksiGuruController::class, 'exportpdf_peminjaman_buku_guru'])->name('exportpdf_peminjaman_buku_guru');
    Route::get('/exportpdf_pengembalian_buku_guru', [App\Http\Controllers\TransaksiGuruController::class, 'exportpdf_pengembalian_buku_guru'])->name('exportpdf_pengembalian_buku_guru');
    Route::get('/exportexcel_peminjaman_buku_guru', [App\Http\Controllers\TransaksiGuruController::class, 'exportexcel_peminjaman_buku_guru'])->name('exportexcel_peminjaman_buku_guru');
    Route::get('/exportexcel_pengembalian_buku_guru', [App\Http\Controllers\TransaksiGuruController::class, 'exportexcel_pengembalian_buku_guru'])->name('exportexcel_pengembalian_buku_guru');
    //majalah
    Route::get('/majalah_guru_pinjam', [App\Http\Controllers\TransaksiGuruController::class, 'showPeminjamanMajalahGuru'])->name('majalah_guru_pinjam');
    Route::post('/tambah_peminjaman_majalah_guru', [App\Http\Controllers\TransaksiGuruController::class, 'tambah_peminjaman_majalah_guru'])->name('tambah_peminjaman_majalah_guru');
    Route::get('/kembalikan_majalah_guru/{id}/{id_majalah}', [App\Http\Controllers\TransaksiGuruController::class, 'kembalikan_majalah_guru'])->name('kembalikan_majalah_guru');
    Route::get('/perpanjang_majalah_guru/{id}', [App\Http\Controllers\TransaksiGuruController::class, 'perpanjang_majalah_guru'])->name('perpanjang_majalah_guru');
    Route::get('/exportexcel_peminjaman_majalah_guru', [App\Http\Controllers\TransaksiGuruController::class, 'exportexcel_peminjaman_majalah_guru'])->name('exportexcel_peminjaman_majalah_guru');
    Route::get('/exportpdf_peminjaman_majalah_guru', [App\Http\Controllers\TransaksiGuruController::class, 'exportpdf_peminjaman_majalah_guru'])->name('exportpdf_peminjaman_majalah_guru');
    Route::get('/majalah_guru_kembali', [App\Http\Controllers\TransaksiGuruController::class, 'showPengembalianMajalahGuru'])->name('majalah_guru_kembali');
    Route::get('/deletePengembalianMajalah/{id}', [App\Http\Controllers\TransaksiGuruController::class, 'deletePengembalianMajalah'])->name('deletePengembalianMajalah');
    Route::get('/exportexcel_pengembalian_majalah_guru', [App\Http\Controllers\TransaksiGuruController::class, 'exportexcel_pengembalian_majalah_guru'])->name('exportexcel_pengembalian_majalah_guru');
    Route::get('/exportpdf_pengembalian_majalah_guru', [App\Http\Controllers\TransaksiGuruController::class, 'exportpdf_pengembalian_majalah_guru'])->name('exportpdf_pengembalian_majalah_guru');
    //cd
    Route::get('/cd_guru_pinjam', [App\Http\Controllers\TransaksiGuruController::class, 'showPeminjamanCDGuru'])->name('cd_guru_pinjam');
    Route::post('/tambah_peminjaman_cd_guru', [App\Http\Controllers\TransaksiGuruController::class, 'tambah_peminjaman_cd_guru'])->name('tambah_peminjaman_cd_guru');
    Route::get('/kembalikan_cd_guru/{id}/{id_cd}', [App\Http\Controllers\TransaksiGuruController::class, 'kembalikan_cd_guru'])->name('kembalikan_cd_guru');
    Route::get('/perpanjang_cd_guru/{id}', [App\Http\Controllers\TransaksiGuruController::class, 'perpanjang_cd_guru'])->name('perpanjang_cd_guru');
    Route::get('/exportexcel_peminjaman_cd_guru', [App\Http\Controllers\TransaksiGuruController::class, 'exportexcel_peminjaman_cd_guru'])->name('exportexcel_peminjaman_cd_guru');
    Route::get('/exportpdf_peminjaman_cd_guru', [App\Http\Controllers\TransaksiGuruController::class, 'exportpdf_peminjaman_cd_guru'])->name('exportpdf_peminjaman_cd_guru');
    Route::get('/cd_guru_kembali', [App\Http\Controllers\TransaksiGuruController::class, 'showPengembalianCDGuru'])->name('cd_guru_kembali');
    Route::get('/deletePengembalianCD/{id}', [App\Http\Controllers\TransaksiGuruController::class, 'deletePengembalianCD'])->name('deletePengembalianCD');
    Route::get('/exportexcel_pengembalian_cd_guru', [App\Http\Controllers\TransaksiGuruController::class, 'exportexcel_pengembalian_cd_guru'])->name('exportexcel_pengembalian_cd_guru');
    Route::get('/exportpdf_pengembalian_cd_guru', [App\Http\Controllers\TransaksiGuruController::class, 'exportpdf_pengembalian_cd_guru'])->name('exportpdf_pengembalian_cd_guru');

    //PENGATURAN

    Route::get('/pengaturan/{id}', [App\Http\Controllers\PengaturanController::class, 'showPengaturan'])->name('pengaturan');
    Route::post('/updateAdmin/{id}', [App\Http\Controllers\PengaturanController::class, 'updateAdmin'])->name('updateAdmin');
    Route::post('/ubahPassword/{id}', [App\Http\Controllers\PengaturanController::class, 'ubahPassword'])->name('ubahPassword');
    Route::post('/update_BatasSiswa/{id}', [App\Http\Controllers\PengaturanController::class, 'update_BatasSiswa'])->name('update_BatasSiswa');
    Route::post('/update_BatasGuru/{id}', [App\Http\Controllers\PengaturanController::class, 'update_BatasGuru'])->name('update_BatasGuru');

    //update foto profil
    Route::post('/updateFotoProfil', [App\Http\Controllers\PengaturanController::class, 'updateFotoProfil'])->name('updateFotoProfil');

   
    //KIRIM EMAIL
    Route::get('/sendEmail', [App\Http\Controllers\EmailController::class, 'index'])->name('sendEmail');

    
});

