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
              </span> Data Tempat Terbit
            </h3>
            
          </div>

          @if($message = Session::get('insertsuccess'))
          {{-- Notif buku berhasil ditambah --}}
            <script>
              Swal.fire(
              'Berhasil!',
              'Data Tempat Terbit Berhasil Ditambahkan!',
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
              'Tempat Terbit Berhasil Ditambahkan!',
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
              'Tempat Terbit Berhasil Diperbarui!',
              'success'
              )
            </script>
          @endif

          <div class="row">
            <div class="col-12 grid-margin">
              <div class="float">
                <button onclick="location.href='/tambahbuku';" type="button" class="btn btn-sm btn-primary mb-3">
                  <i class="mdi mdi-keyboard-backspace"></i>
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#insertTempatTerbit" class="btn btn-sm btn-primary mb-3"><i class="mdi mdi-library-plus mdi-icon"></i>Tambah Tempat Terbit</button>
              <!-- The Insert Modal -->
              <div class="modal fade" id="insertTempatTerbit">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title ">Tambah Tempat Terbit</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body px-4">
                      <form action="/insertTempatTerbit" method="POST" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        <div class="form-group">
                          <label for="kota">Tempat Terbit</label>
                          <input type="text" name="kota" class="form-control" id="kota" placeholder="Tempat Terbit" required value="{{ old('kota') }}" autocomplete="kota"
                          class="@error('kota') is-invalid @enderror">
                          @error('kota')
                              <sub class="p fst-italic text-danger">{{"$message"}}</sub>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                      </form>              
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer"> 
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="float-end mb-3">
                <button type="button" data-bs-toggle="modal" data-bs-target="#import_tempat" class="btn btn-sm btn-danger btn-icon-text"><i class="mdi mdi-upload btn-icon-prepend"></i>Import Data</button>               
                <!-- The Import Excel Modal -->
                <div class="modal fade" id="import_tempat">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title ">Import Tempat Terbit</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <!-- Modal body -->                     
                      <div class="card m-3 text-center" >
                        <div class="card-body m-3">
                          <h5 class="card-title text-center">Download Template Excel</h5>
                          <h6 class="card-subtitle mb-2 text-muted text-center">Untuk Import Data</h6>
                          <a href="assets/template_import/importpenerbit_template.xlsx"><button type="button" class="btn btn-primary text-center">Download</button></a>
                        </div>
                      </div>
                      <form action="/importexcel_tempatterbit" method="POST" enctype="multipart/form-data">
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
                  <h4 class="card-title">Data Penerbit</h4>
                  <div class="table-responsive">
                    <table class="table " id="myTable">
                      <thead>              
                        <tr>
                          <th> No </th>
                          <th> Tempat Terbit </th>
                          <th> Aksi </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($tempatterbits as $index => $tempatterbit)
                        <tr>
                          <td scope="tempatterbit"> {{$index + $tempatterbits->firstItem()}} </td>
                          <td>{{$tempatterbit->kota}}</td>
                          <td>
                            <button type="button" class="btn btn-inverse-info btn-icon" data-bs-toggle="modal" data-bs-target="#view{{$tempatterbit->id}}">
                              <i class="mdi mdi-information-outline"></i>
                            </button>
                            
                            <button type="button" class="btn btn-inverse-primary btn-icon" data-bs-toggle="modal" data-bs-target="#edit{{$tempatterbit->id}}">
                              <i class="mdi mdi-pencil"></i>
                            </button>
                            
                            <a href="#">
                            <button class="btn btn-inverse-danger btn-icon delete " data-id = "{{$tempatterbit->id}}" data-tempatterbit = "{{$tempatterbit->kota}}"> 
                              <i class="mdi mdi-delete "></i>
                            </button></a>
                          </td>
                        </tr>
                        <!-- The Detail Modal -->
                        <div class="modal fade" id="view{{$tempatterbit->id}}">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title ">Detail Tempat Terbit</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body px-4">
                                
                                <div class="row">
                                  <div class="col-sm-6">
                                    <h6>Tempat Terbit</h6>
                                    <p>{{$tempatterbit->tempatterbit}}</p>
                                    <h6>Diinput Pada</h6>
                                    <p>{{$tempatterbit->getCreatedAttribute()}}</p>
                                    <h6>Diperbarui Pada</h6>
                                    <p>{{$tempatterbit->getUpdatedAttribute()}}</p>
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
                        <div class="modal fade" id="edit{{$tempatterbit->id}}">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title ">Edit Tempat Terbit</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body px-4">
                                
                                <form action="/updateTempatTerbit/{{$tempatterbit->id}}" method="POST" enctype="multipart/form-data" class="forms-sample">
                                  @csrf
                                  <div class="form-group">
                                    <label for="kota">Tempat Terbit</label>
                                    <input value="{{$tempatterbit->kota}}" type="text" name="kota" class="form-control" id="kota" placeholder="Tempat Terbit" required>
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
    <script>
      $('.delete').click(function(){
        var idtempat = $(this).attr('data-id');
        var kota = $(this).attr('data-tempatterbit');
        Swal.fire({
        title: 'Apakah Yakin?',
        text: "Hapus  "+kota+" ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "/deleteTempatTerbit/"+idtempat+""
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



