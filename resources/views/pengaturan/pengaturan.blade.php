@extends('layouts.blank')

@section('content')    
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-settings"></i>
    </span> Pengaturan
  </h3>
  
</div>
<div class="row">
  <div class="col-md grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="clearfix">
          <h4 class="card-title float-left mb-3">Profil User</h4>
          <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div><br>
          <div class="text-center mb-5">
            <img height="200px" width="200px" src="assets/images/smankaLogo.png" class="rounded mx-auto d-block rounded-circle mt-2" alt="">
          </div>
          
          <h6>Nama</h6>
          <p>{{$profil->name}}</p>
          <h6>Username</h6>
          <p>{{$profil->username}}</p>
          <h6>Email</h6> 
          <p>{{$profil->email}}</p>
          <h6>password</h6>
          <p>{{$profil->password}}</p> 
          
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
        <h4 class="card-title mb-4">Pengaturan Lain</h4>
        
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
         
        <form action="/updateAdmin/{{$profil->id}}" method="POST" enctype="multipart/form-data" class="forms-sample">
          @csrf
          <div class="form-group ">
            <div class="text-center">
            <img class="m-3 text-center" height="150px" src="assets/images/smankaLogo.png" alt=""></div>
            <h5 class="mt-3">Pilih Foto Profil Baru</h5>
            <input type="file" name="foto_profil" class="form-control">
          </div>
          <div class="form-group">
            <label for="name">Nama</label>
            <input required value="{{$profil->name}}" type="text" name="name" class="form-control" id="name" placeholder="Nama">
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input required value="{{$profil->username}}" type="text" name="username" class="form-control" id="username" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input required value="{{$profil->email}}" type="email" name="email" class="form-control" id="email" placeholder="Email">
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
@endsection


