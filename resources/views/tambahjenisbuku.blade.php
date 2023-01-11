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
              </span> Tambah Jenis Buku
            </h3>
          </div>

          <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tambahkan Jenis Buku</h4>
                    <p class="card-description"> Sesuai dengan form yang disediakan </p>
                    <form action="/insertJenisbuku" method="POST" enctype="multipart/form-data" class="forms-sample">
                      @csrf
                      
                      <div class="form-group">
                        <label for="jenis">Jenis Buku</label>
                        <input type="text" name="jenis" class="form-control" id="jenis" placeholder="Jenis Buku" required value="{{ old('jenis') }}" autocomplete="jenis"
                        class="@error('jenis') is-invalid @enderror">
                        @error('jenis')
                            <sub class="p fst-italic text-danger">{{ "Jenis Buku Harus Diisi" }}</sub>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="rak">Rak Buku</label>
                        <input type="text" name="rak" class="form-control" id="rak" placeholder="Rak Buku" required value="{{ old('rak') }}" autocomplete="rak">
                      </div>
                  
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      <a href="/datajenisbuku" class="btn btn-danger">Kembali</a>
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
