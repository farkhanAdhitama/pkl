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
                <i class="mdi mdi-arrow-up-bold-circle"></i>
              </span> Riwayat Pengembalian Buku
            </h3>
            
          </div>  
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="float">
                <div class="mb-3 d-flex justify-content-end">
                <a href="/exportpdf_pengembalian"><button type="button" class="btn btn-sm btn-info btn-icon-text me-1"> <i class="mdi mdi-printer btn-icon-append"></i> Cetak PDF  </button></a>
                <a href=""> <button type="button" class="btn btn-sm btn-success btn-icon-text me-1"> <i class="mdi mdi-printer btn-icon-append"></i> Cetak Excel  </button></a>
              </div>
              <div class="float-end mb-3">
              </div>

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daftar Buku yang Dikembalikan</h4>
                  <div class="table-responsive">
                    <table class="table " id="myTable">
                      <thead>              
                        <tr>
                          <th> No </th>
                          <th> Nama </th>
                          <th> Kelas </th>
                          <th> Judul </th>
                          <th> Tanggal Pinjam</th>
                          <th> Tanggal Kembali</th>
                          <th> Total </th>
                          <th> Denda </th>
                          <th> Status </th>
                          <th> Aksi </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($peminjaman as $index => $pinjam)
                        <tr>
                          <td scope="pinjam">{{$index + $peminjaman->firstItem()}}</td>
                          <td>{{$pinjam->anggota->nama ?? 'N/A'}}</td>
                          <td>{{$pinjam->anggota->kelas ?? 'N/A'}}</td>
                          <td>{{$pinjam->buku->judul_buku ?? 'N/A'}}</td>
                          <td>{{$pinjam->getCreatedAttribute()}}</td>
                          <td>{{$pinjam->getTanggalKembali()}}</td>
                          <td>{{$pinjam->lama_peminjaman()}} Hari</td>
                          <td>Rp {{$pinjam->getDenda($pinjam->lama)}}</td>
                          <td><label class="badge badge-gradient-info">{{$pinjam->status}}</label></td>
                          <td>
                            <button class="btn btn-inverse-danger btn-icon delete "> 
                              <i class="mdi mdi-delete "></i>
                            

                          </td>
                        </tr>
                        @endforeach
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
