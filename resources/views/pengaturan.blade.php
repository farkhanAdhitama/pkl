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
                <i class="mdi mdi-settings"></i>
              </span> Pengaturan
            </h3>
            
          </div>
          @foreach ($profil as $row)
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="clearfix">
                    <h4 class="card-title float-left mb-3">Profil User</h4>
                    <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div><br>
                    
                    <h6>Nama</h6>
                    <p>{{$row->name}}</p>
                    <h6>Username</h6>
                    <p>{{$row->username}}</p>
                    <h6>Email</h6>
                    <p>{{$row->email}}</p>
                    <h6>password</h6>
                    <p>{{$row->password}}</p>
                   
                  </div>
                  <div class="text-center">
                  <a href="#"> <button type="button" class="btn btn-gradient-primary btn-rounded btn-fw " data-bs-toggle="modal" data-bs-target="#editProfil">Ubah Profil Pengguna</button></a>
                </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-4">Foto Profil</h4>
                  <div class="text-center mt-5">
                    <img height="200px" width="200px" src="assets/images/smankaLogo.png" class="rounded mx-auto d-block rounded-circle mt-2" alt="">
                    <a href="#"> <button type="button" class="btn btn-gradient-primary btn-rounded btn-fw mt-5  mx-5" data-bs-toggle="modal" data-bs-target="#editFoto">Ubah Foto Profil</button></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="editProfil">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title ">Edit Profil</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body px-4">
                  
                  <form action="/updateAdmin/{{$row->id}}" method="POST" enctype="multipart/form-data" class="forms-sample">
                    @csrf
                    <div class="form-group">
                      <label for="name">Nama</label>
                      <input required value="{{$row->name}}" type="text" name="name" class="form-control" id="name" placeholder="Nama">
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input required value="{{$row->username}}" type="text" username="username" class="form-control" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input required value="{{$row->email}}" type="email" email="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input required value="{{$row->password}}" type="text" password="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary me-2 ">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                  </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                  
                </div>

              </div>
            </div>
          </div>


          {{-- modal edit foto --}}
          <div class="modal fade" id="editFoto">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title ">Edit Foto Profile</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <!-- Modal body -->
              <div class="modal-body px-4">
                
                <form action="/updateFotoProfil" method="POST" enctype="multipart/form-data" class="forms-sample">
                  @csrf
                  <div class="form-group ">
                    <div class="text-center">
                    <img class="m-3 text-center" height="150px" src="assets/images/smankaLogo.png" alt=""></div>
                    <h5 class="mt-3">Pilih Foto Profil Baru</h5>
                    <input type="file" name="foto_profil" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary me-2 ">Submit</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </form>
                </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                
              </div>

            </div>
          </div>
        </div>
        @endforeach
          
          
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
