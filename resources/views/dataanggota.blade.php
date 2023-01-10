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
              </span> Data Anggota
            </h3>
            
          </div>

          @if($message = Session::get('success'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
          </div>
          @endif

          {{-- Jika berhasil Update --}}
          @if($message = Session::get('updatesuccess'))
            <script>
              Swal.fire(
              'Berhasil!',
              'Data Anggota Berhasil Diperbarui!',
              'success'
              )
            </script>
          @endif

          <div class="row">
            <div class="col-12 grid-margin">
              <div class="float">
              
              <a href="/tambahanggota" type="button" class="btn btn-sm btn-primary mb-3"  ><i class="mdi mdi-library-plus mdi-icon"></i> Tambah Anggota</a>
              
              <div class="float-end mb-3">
                
              <button type="button" class="btn btn-sm btn-info btn-icon-text me-1"> <i class="mdi mdi-printer btn-icon-append"></i>  PDF  </button>
              <button type="button" class="btn btn-sm btn-success btn-icon-text me-1"> <i class="mdi mdi-printer btn-icon-append"></i>  Excel  </button>
              <button type="button" class="btn btn-sm btn-danger btn-icon-text"><i class="mdi mdi-upload btn-icon-prepend"></i>Import Data</button>
             </div>
              </div>
              
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Anggota</h4>
                  <div class="table-responsive">
                    <table class="table " id="myTable">
                      <thead>              
                        <tr>
                          <th> Nama </th>
                          <th> NIS/NIP </th>
                          <th> Kelas/Jabatan </th>
                          <th> Nomor HP </th>
                          <th> Alamat </th>
                          <th> Aksi </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($anggotas as $anggota)
                        <tr>
                          <td>
                            <?php
                              if (empty($anggota->foto_anggota)){?>
                                <img src="assets/images/foto_anggota/person.png" class="me-2" alt="image">{{ $anggota->nama }}
                            <?php
                              }else{
                            ?>
                              <img src="assets/images/foto_anggota/{{$anggota->foto_anggota}}" class="me-2" alt="image">{{ $anggota->nama }}
                            <?php }?>  
                          </td>
                          <td>{{$anggota->nis}}</td>
                          <td>{{$anggota->kelas}}</td>
                          <td>{{$anggota->no_hp}}</td>
                          <td>
                            {{$anggota->alamat}}
                          </td>
                          <td>
                            <button type="button" class="btn btn-inverse-info btn-icon" data-bs-toggle="modal" data-bs-target="#view{{$anggota->id}}">
                              <i class="mdi mdi-information-outline"></i>
                            </button>
                            
                            <button type="button" class="btn btn-inverse-primary btn-icon" data-bs-toggle="modal" data-bs-target="#edit{{$anggota->id}}">
                              <i class="mdi mdi-pencil"></i>
                            </button>
                            
                            <a href="#">
                            <button class="btn btn-inverse-danger btn-icon delete " data-id = "{{$anggota->id}}" data-anggota = "{{$anggota->nama}}"> 
                              <i class="mdi mdi-delete "></i>
                            </button></a>
                          </td>
                        </tr>
                        <!-- The Detail Modal -->
                        <div class="modal fade" id="view{{$anggota->id}}">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title ">Detail Anggota</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body px-4">
                                
                                <div class="row">
                                  <div class="col-sm-6 ">
                                    <h3>{{$anggota->nama}}</h3>
                                    <?php
                                      if (empty($anggota->foto_anggota)){?>
                                        <img width="200px" src="assets/images/foto_anggota/person.png" class="me-2" alt="image">
                                    <?php
                                      }else{
                                    ?>
                                        <img width="200px" src="assets/images/foto_anggota/{{$anggota->foto_anggota}}" class="me-2" alt="image">
                                    <?php 
                                  }?> 
                                  </div>
                                  <div class="col-sm-6">
                                    <h6>NIS/NIP</h6>
                                    <p>{{$anggota->nis}}</p>
                                    <h6>Kelas/Jabatan</h6>
                                    <p>{{$anggota->kelas}}</p>
                                    <h6>Nomor HP</h6>
                                    <p>{{$anggota->no_hp}}</p>
                                    <h6>Alamat</h6>
                                    <p>{{$anggota->alamat}}</p>
                                    <h6>Diinput Pada</h6>
                                    <p>{{$anggota->getCreatedAttribute()}}</p>
                                    <h6>Diperbarui Pada</h6>
                                    <p>{{$anggota->getUpdatedAttribute()}}</p>
                                    
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
                        <div class="modal fade" id="edit{{$anggota->id}}">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title ">Edit Data Anggota</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body px-4">
                                
                                <form action="/updateanggota/{{$anggota->id}}" method="POST" enctype="multipart/form-data" class="forms-sample">
                                  @csrf
                                  
            
                                  <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input value="{{$anggota->nama}}" type="text" name="nama" class="form-control" id="nama" placeholder="Nama">
                                  </div>
                                  <div class="form-group">
                                    <label for="nis">NIS/NIP</label>
                                    <input value="{{$anggota->nis}}" type="number" name="nis" class="form-control" id="nis" placeholder="NIS/NIP">
                                  </div>
                                  <div class="form-group">
                                    <label for="kelas">Kelas/Jabatan</label>
                                    <select  class="form-control" name="kelas" id="kelas">
                                      <option class="" value="{{$anggota->kelas}}">{{$anggota->kelas}}</option>
                                      <option value="pengajar">Pengajar</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="no_hp">Nomor HP</label>
                                    <input value="{{$anggota->no_hp}}" type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Nomor HP">
                                  </div>
                                  <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input value="{{$anggota->alamat}}" type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat">
                                  </div>
                                  
                                  <div class="form-group">
                                    <label>Foto Anggota</label><br>
                                    <img height="100px" src="assets/images/foto_anggota/{{$anggota->foto_anggota}}" alt="">
                                    <input type="file" name="foto_anggota" class="form-control">
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
        var idanggota = $(this).attr('data-id');
        var nama = $(this).attr('data-anggota');
        Swal.fire({
        title: 'Apakah Yakin?',
        text: "Hapus Anggota dengan Nama "+nama+" ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "/deleteanggota/"+idanggota+""
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



