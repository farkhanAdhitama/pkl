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
                <i class="mdi mdi-arrow-down-bold-circle"></i>
              </span> Pengembalian Buku
            </h3>
            
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Riwayat Pengembalian Buku</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th> No </th>
                          <th> Nama </th>
                          <th> Buku </th>
                          <th> Tanggal Pinjam </th>
                          <th> Tanggal Kembali</th>
                          <th> Denda </th>
                          <th> Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>
                            <img src="assets/images/faces/face1.jpg" class="me-2" alt="image"> David Grey
                          </td>
                          <td> Bajigur Goreng </td>
                          <td> Dec 5, 2017 </td>
                          <td> Dec 12, 2017 </td>
                          <td>12999</td>
                          <td>
                          <button type="button" class="btn btn-inverse-danger btn-sm" data-bs-toggle="modal" data-bs-target="">Hapus</button>
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
