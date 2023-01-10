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
              </span> Kategori Buku
            </h3>
            
          </div>

          <div class="row">
            <div class="col-12 grid-margin">
              <button type="button" class="btn btn-gradient-primary mb-3"><i class="mdi mdi-library-plus mdi-icon"></i> Tambah Kategori</button>

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Kategori Buku</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th> Kategori </th>
                          <th> Rak </th>
                          <th> Jumlah Buku </th>
                          <th> Aksi </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                             Ilmu Pengetahuan
                          </td>
                          <td>2</td>
                          <td> 323 </td>
                          <td>
                            <button type="button" class="btn btn-inverse-primary btn-icon">
                              <i class="mdi mdi-settings"></i>
                            </button>
                            <button type="button" class="btn btn-inverse-danger btn-icon">
                              <i class="mdi mdi-delete"></i>
                            </button>
                          </td>
                        </tr>
                      
                        
                      </tbody>
                    </table>
                  </div>
                </div>
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
