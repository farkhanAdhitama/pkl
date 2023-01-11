@extends('layouts.blank')

@section('content')
<div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    @include('partial._navbar')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('partial._sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-book-open "></i>
              </span> Tambah Data Anggota Perpustakaan
            </h3>
          </div>
          
          <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tambahkan Data Anggota</h4>
                    <p class="card-description"> Sesuai dengan form yang disediakan </p>
                    <form action="/insertAnggota" method="POST" enctype="multipart/form-data" class="forms-sample">
                      @csrf
                      
                      <div class="form-group">
                        <label for="nama">Nama Anggota</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Anggota" required value="{{ old('nama') }}" autocomplete="nama"
                        class="@error('nama') is-invalid @enderror">
                        @error('nama')
                            <sub class="p fst-italic text-danger">{{ "Nama Harus Diisi dengan Huruf" }}</sub>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="nis">NIS/NIP Anggota</label>
                        <input type="number" name="nis" class="form-control" id="nis" placeholder="NIS/NIP Anggota" required value="{{ old('nis') }}" autocomplete="nis"
                        class="@error('nis') is-invalid @enderror">
                        @error('nis')
                            <sub class="p fst-italic text-danger">{{ "NIS/NIP harus Diisi dengan Angka" }}</sub>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="kelas">Kelas/Jabatan</label>
                        <select class="form-control" name="kelas" id="kelas">
                          <option value="pengajar">Pengajar</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="11">12</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="no_hp">Nomor HP</label>
                        <input type="number" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP" value="{{ old('no_hp') }}" autocomplete="no_hp"
                        class="@error('no_hp') is-invalid @enderror">
                        @error('no_hp')
                            <sub class="p fst-italic text-danger">{{ "Nomor HP Harus Diisi dengan Angka" }}</sub>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat" value="{{ old('alamat') }}" autocomplete="alamat"
                       ></textarea>
                      </div>

                      <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto_anggota" class="form-control">
                      </div>
                  
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      <a href="/dataanggota" class="btn btn-danger">Kembali</a>
                    </form>
                  </div>
                </div>
              </div>
          
          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('partial._footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
   
    
  </div>
@endsection
