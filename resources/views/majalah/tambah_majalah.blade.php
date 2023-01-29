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
              </span> Tambah Majalah
            </h3>
          </div>

          <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tambahkan Koleksi Majalah</h4>
                    <p class="card-description"> Sesuai dengan form yang disediakan </p>
                    <form action="/insertMajalah" method="POST" enctype="multipart/form-data" class="forms-sample">
                      @csrf
                      
                      <div class="form-group">
                        <label for="nama">Nama Majalah</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Majalah" required value="{{ old('nama') }}" autocomplete="nama"
                        class="@error('nama') is-invalid @enderror">
                        @error('nama')
                            <sub class="p fst-italic text-danger">{{"$message"}}</sub>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="tanggal_terbit">Tanggal Terbit</label>
                        <input type="text" name="tanggal_terbit" class="form-control" id="tanggal_terbit" placeholder="Tanggal Terbit" required value="{{ old('tanggal_terbit') }}" autocomplete="tanggal_terbit"
                        class="@error('tanggal_terbit') is-invalid @enderror">
                        @error('tanggal_terbit')
                            <sub class="p fst-italic text-danger">{{"$message"}}</sub>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="nomor">Nomor</label>
                        <input type="number" name="nomor" class="form-control" id="nomor" placeholder="Nomor" required value="{{ old('nomor') }}" autocomplete="nomor"
                        class="@error('nomor') is-invalid @enderror">
                        @error('nomor')
                            <sub class="p fst-italic text-danger">{{"$message"}}</sub>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="volume">Volume</label>
                        <input type="number" name="volume" class="form-control" id="volume" placeholder="Volume" required value="{{ old('volume') }}" autocomplete="volume"
                        class="@error('volume') is-invalid @enderror">
                        @error('volume')
                            <sub class="p fst-italic text-danger">{{"$message"}}</sub>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="text" name="tahun" class="form-control" id="tahun" placeholder="Tahun" required value="{{ old('tahun') }}" autocomplete="tahun"
                        class="@error('tahun') is-invalid @enderror">
                        @error('tahun')
                            <sub class="p fst-italic text-danger">{{"$message"}}</sub>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="issn">ISSN</label>
                        <input type="text" name="issn" class="form-control" id="issn" placeholder="ISSN" required value="{{ old('issn') }}" autocomplete="issn"
                        class="@error('issn') is-invalid @enderror">
                        @error('issn')
                            <sub class="p fst-italic text-danger">{{"$message"}}</sub>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="topik">Topik Utama</label>
                        <input type="text" name="topik" class="form-control" id="topik" placeholder="Topik Utama" required value="{{ old('topik') }}" autocomplete="topik"
                        class="@error('topik') is-invalid @enderror">
                        @error('topik')
                            <sub class="p fst-italic text-danger">{{"$message"}}</sub>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="jumlah">Jumlah Eksemplar</label>
                        <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah Eksemplar" required value="{{ old('jumlah') }}" autocomplete="jumlah"
                        class="@error('jumlah') is-invalid @enderror">
                        @error('jumlah')
                            <sub class="p fst-italic text-danger">{{"$message"}}</sub>
                        @enderror
                      </div>
                    
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      <a href="/data_majalah" class="btn btn-danger">Kembali</a>
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
