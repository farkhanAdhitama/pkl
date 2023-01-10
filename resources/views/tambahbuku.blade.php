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
              </span> Tambah Data Buku
            </h3>
          </div>
          @if($message = Session::get('success'))
          {{-- Notif buku berhasil ditambah --}}
            <script>
              Swal.fire(
              'Berhasil!',
              'Data Buku Berhasil Ditambahkan!',
              'success'
              )
            </script>
          @endif

          <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tambahkan Data Buku</h4>
                    <p class="card-description"> Sesuai dengan form yang disediakan </p>
                    <form action="/insertdata" method="POST" enctype="multipart/form-data" class="forms-sample">
                      @csrf
                      
                      <div class="form-group">
                        <label for="judul_buku">Judul Buku</label>
                        <input type="text" name="judul_buku" class="form-control" id="judul_buku" placeholder="Judul Buku" required
                        class="@error('judul_buku') is-invalid @enderror">
                        @error('judul_buku')
                            <sub class="p fst-italic text-danger">{{ "Judul Buku Harus Diisi" }}</sub>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="kategori" id="kategori">
                          <option value="fiksi">Fiksi</option>
                          <option value="nonfiksi">Non Fiksi</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input type="text" name="penulis" class="form-control" id="penulis" placeholder="Penulis" required
                        class="@error('penulis') is-invalid @enderror">
                        @error('penulis')
                            <sub class="fst-italic text-danger">{{ "Harus Diisi dengan Huruf" }}</p>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control" id="penerbit" placeholder="Penerbit" required
                        class="@error('penerbit') is-invalid @enderror">
                        @error('penerbit')
                            <sub class="fst-italic text-danger">{{ "Harus Diisi dengan Huruf" }}</sub>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control" id="tahun_terbit" placeholder="Tahun Terbit" required
                        class="@error('tahun_terbit') is-invalid @enderror">
                        @error('tahun_terbit')
                            <sub class="fst-italic text-danger">{{ "Format Tahun Kosong atau Salah" }}</sub>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="jumlah">Jumlah Buku</label>
                        <input type="number" name="jumlah" class="form-control" id="jumlah @error('jumlah') is-invalid @enderror" placeholder="Jumlah" required> 
                        @error('jumlah')
                        <sub class="text-danger fst-italic">{{ "Harus Diisi dengan Angka Jumlah" }}</sub>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Sampul Buku</label>
                        <input type="file" name="sampul" class="form-control">
                      </div>
                  
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      <a href="/databuku" class="btn btn-danger">Kembali</a>
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
