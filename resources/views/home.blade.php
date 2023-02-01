@extends('layouts.blank')

@section('content')

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-home"></i>
    </span> Dashboard Perpustakaan
  </h3>
</div>
<div class="row">
  <div class="col-md-3 stretch-card grid-margin">
    <div class="card bg-gradient-info card-img-holder text-white">
      <a style="text-decoration: none; color:white;" href="/databuku">
      <div class="card-body">
        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3">Jumlah Buku<i class="mdi mdi-library-books mdi-24px float-right"></i>
        </h4>
        <h1 class="">{{$jumlah_buku}}</h1>
      </div>
      </a>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin">
    <div class="card bg-gradient-danger card-img-holder text-white">
      <a style="text-decoration: none; color:white;" href="/dataanggota">
        <div class="card-body">
        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3">Jumlah Anggota<i class="mdi mdi-account-multiple mdi-24px float-right"></i>
        </h4>
        <h1 class="">{{$jumlah_anggota}}</h1>
      </div>
      </a> 
    </div>
  </div>
  {{-- <div class="col-md-3 stretch-card grid-margin">
    <div class="card bg-gradient-success card-img-holder text-white">
      <a style="text-decoration: none; color:white;" href="/datajenisbuku">
      <div class="card-body">
        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3">Jenis Buku<i class="mdi mdi-arrow-up-bold-circle mdi-24px float-right"></i>
        </h4>
        <h1 class="">{{$jumlah_jenis}}</h1>
      </div>
      </a>
    </div>
  </div> --}}
  <div class="col-md-3 stretch-card grid-margin">
    <div class="card bg-gradient-primary card-img-holder text-white">
      <a style="text-decoration: none; color:white;" href="/peminjaman">
      <div class="card-body">
        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3">Peminjaman Aktif<i class="mdi mdi-arrow-up-bold-circle mdi-24px float-right"></i>
        </h4>
        <h1 class="">{{$jumlah_pinjam}}</h1>
      </div>
      </a>
    </div>
  </div>
  <div class="col-md-3 stretch-card grid-margin">
    <div class="card bg-gradient-info card-img-holder text-white">
      <a style="text-decoration: none; color:white;" href="/pengembalian">
      <div class="card-body">
        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
        <h4 class="font-weight-normal mb-3">Riwayat Pengembalian<i class="mdi mdi-arrow-down-bold-circle mdi-24px float-right"></i>
        </h4>
        <h1 class="">{{$jumlah_kembali}}</h1>
      </div>
      </a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-7 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="clearfix">
          <h4 class="card-title float-left">Visit And Sales Statistics</h4>
          <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
        </div>
        <canvas id="visit-sale-chart" class="mt-4"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-5 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Traffic Sources</h4>
        <canvas id="traffic-chart"></canvas>
        <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
      </div>
    </div>
  </div>
</div>
@endsection
