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
              </span> Data Jenis Buku
            </h3>
            
          </div>

          @if($message = Session::get('insertsuccess'))
          {{-- Notif buku berhasil ditambah --}}
            <script>
              Swal.fire(
              'Berhasil!',
              'Data Jenis Buku Berhasil Ditambahkan!',
              'success'
              )
            </script>
          @endif

          {{-- swal berhasil import --}}
          @if($message = Session::get('importsuccess'))
          {{-- Notif buku berhasil ditambah --}}
            <script>
              Swal.fire(
              'Berhasil!',
              'Data Buku Berhasil Ditambahkan!',
              'success'
              )
            </script>
          @endif

          @if($message = Session::get('deletesuccess'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
          </div>
          @endif

          {{-- Jika berhasil Update --}}
          @if($message = Session::get('updatesuccess'))
            <script>
              Swal.fire(
              'Berhasil!',
              'Data Jenis Buku Berhasil Diperbarui!',
              'success'
              )
            </script>
          @endif

          <div class="row">
            <div class="col-12 grid-margin">
              <div class="float">
              
              <a href="/tambahMajalah" type="button" class="btn btn-sm btn-primary mb-3"  ><i class="mdi mdi-library-plus mdi-icon"></i> Tambah Data Majalah</a>
              
              <div class="float-end mb-3">
                
                <a href="#"><button type="button" class="btn btn-sm btn-info btn-icon-text me-1"> <i class="mdi mdi-printer btn-icon-append"></i>  Cetak PDF  </button></a>
                <a href="#"> <button type="button" class="btn btn-sm btn-success btn-icon-text me-1"> <i class="mdi mdi-printer btn-icon-append"></i>  Cetak Excel  </button></a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#import_jenisbuku" class="btn btn-sm btn-danger btn-icon-text"><i class="mdi mdi-upload btn-icon-prepend"></i>Import Data</button>
                
                  <!-- The Import Excel Modal -->
                  <div class="modal fade" id="import_jenisbuku">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title ">Import Majalah</h4>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Modal body -->
                      
                        <div class="card m-3 text-center" >
                          <div class="card-body m-3">
                            <h5 class="card-title text-center">Download Template Excel</h5>
                            <h6 class="card-subtitle mb-2 text-muted text-center">Untuk Import Data</h6>
                            <a href="assets/template_import/Data_Jenisbuku_template.xlsx"><button type="button" class="btn btn-primary text-center">Download</button></a>
                          </div>
                        </div>
                        <form action="/importexcel_jenisbuku" method="POST" enctype="multipart/form-data">
                          @csrf
                          
                          <div class="modal-body px-4">
                            <h5>Pilih File yang Akan Diimport</h5>
                            <div class="form-group">
                              <input class="" type="file" name="file" id="" required> 
                            </div>
                          </div>

                        <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Import</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

             </div>
              </div>
              
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Majalah</h4>
                  <div class="table-responsive">
                    <table class="table " id="myTable">
                      <thead>              
                        <tr>
                          <th> Nama </th>
                          <th> Tanggal Terbit </th>
                          <th> Nomor/Volume/Tahun </th>
                          <th> ISSN </th>
                          <th> Topik Utama </th>
                          <th> Jumlah </th>
                        </tr>
                      </thead>
                      {{-- <tbody>
                      @foreach ($jenisbukus as $jenisbuku)
                        <tr>
                          <td>{{$jenisbuku->nama}}</td>
                          <td>{{$jenisbuku->id}}</td>
                          <td>{{$jenisbuku->rak}}</td>
                          <td>
                            <button type="button" class="btn btn-inverse-info btn-icon" data-bs-toggle="modal" data-bs-target="#view{{$jenisbuku->id}}">
                              <i class="mdi mdi-information-outline"></i>
                            </button>
                            
                            <button type="button" class="btn btn-inverse-primary btn-icon" data-bs-toggle="modal" data-bs-target="#edit{{$jenisbuku->id}}">
                              <i class="mdi mdi-pencil"></i>
                            </button>
                            
                            <a href="#">
                            <button class="btn btn-inverse-danger btn-icon delete " data-id = "{{$jenisbuku->id}}" data-jenisbuku = "{{$jenisbuku->nama}}"> 
                              <i class="mdi mdi-delete "></i>
                            </button></a>
                          </td>
                        </tr>
                        <!-- The Detail Modal -->
                        <div class="modal fade" id="view{{$jenisbuku->id}}">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title ">Detail Jenis Buku</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body px-4">
                                
                                <div class="row">
                                  <div class="col-sm-6">
                                    <h6>Jenis Buku</h6>
                                    <p>{{$jenisbuku->nama}}</p>
                                    <h6>Rak</h6>
                                    <p>{{$jenisbuku->rak}}</p>
                                    <h6>Diinput Pada</h6>
                                    <p>{{$jenisbuku->getCreatedAttribute()}}</p>
                                    <h6>Diperbarui Pada</h6>
                                    <p>{{$jenisbuku->getUpdatedAttribute()}}</p>
                                    
                                  </div>
                                </div>
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-gradient-danger w-100" data-bs-dismiss="modal">Tutup</button>
                              </div>

                            </div>
                          </div>
                        </div>


                        <!-- The Edit Modal -->
                        <div class="modal fade" id="edit{{$jenisbuku->id}}">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title ">Edit Data Jenis Buku</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body px-4">
                                
                                <form action="/updateJenisBuku/{{$jenisbuku->id}}" method="POST" enctype="multipart/form-data" class="forms-sample">
                                  @csrf
                                  <div class="form-group">
                                    <label for="nama">Jenis Buku</label>
                                    <input value="{{$jenisbuku->nama}}" type="text" name="nama" class="form-control" id="nama" placeholder="Jenis Buku" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="rak">Rak</label>
                                    <input value="{{$jenisbuku->rak}}" type="number" name="rak" class="form-control" id="rak" placeholder="Rak" required>
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
                      </tbody> --}}
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
    <script>
      $('.delete').click(function(){
        var idjenisbuku = $(this).attr('data-id');
        var nama = $(this).attr('data-jenisbuku');
        Swal.fire({
        title: 'Apakah Yakin?',
        text: "Hapus Jenis Buku  "+nama+" ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "/deleteJenisbuku/"+idjenisbuku+""
          Swal.fire(
            'Dihapus!',
            'Data Berhasil Dihapus',
            'success'
          )
        }
      })
      })
    </script>

    
  </div>
@endsection



