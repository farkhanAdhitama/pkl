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
              </span> Data Buku
            </h3>
            
          </div>
          {{-- swall berhasil insert --}}
          @if($message = Session::get('addsuccess'))
          {{-- Notif buku berhasil ditambah --}}
            <script>
              Swal.fire(
              'Berhasil!',
              'Data Buku Berhasil Ditambahkan!',
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
              'Data Buku Berhasil Diperbarui!',
              'success'
              )
            </script>
          @endif

          <div class="row">
            <div class="col-12 grid-margin">
              <div class="float">
              <a href="/tambahbuku" type="button" class="btn btn-sm btn-primary mb-3"  ><i class="mdi mdi-library-plus mdi-icon"></i> Tambah Buku</a>
                <div class="float-end mb-3">
                <button type="button" class="btn btn-sm btn-info btn-icon-text me-1"> <i class="mdi mdi-printer btn-icon-append"></i>  PDF  </button>
                <a href="/exportexcel"> <button type="button" class="btn btn-sm btn-success btn-icon-text me-1"> <i class="mdi mdi-printer btn-icon-append"></i>  Excel  </button></a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#importbuku" class="btn btn-sm btn-danger btn-icon-text"><i class="mdi mdi-upload btn-icon-prepend"></i>Import Data</button>
                
                  <!-- The Import Excel Modal -->
                  <div class="modal fade" id="importbuku">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title ">Detail Buku</h4>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Modal body -->
                        <form action="/importexcel" method="POST" enctype="multipart/form-data">
                          @csrf
                          
                          <div class="modal-body px-4">
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
                  <h4 class="card-title">Data Buku</h4>
                  <div class="table-responsive">
                    <table class="table " id="myTable">
                      <thead>              
                        <tr>
                          <th> Judul </th>
                          <th> ISBN </th>
                          <th> Kategori </th>
                          <th> Jenis Buku</th>
                          <th> Penulis </th>
                          <th> Penerbit </th>
                          <th> Terbitan </th>
                          <th> Jumlah </th>
                          <th> Aksi </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($bukus as $buku)
                        <tr>
                          <td>
                            <?php
                              if (empty($buku->sampul)){?>
                                <img src="assets/images/sampul/sampuldefault.png" class="me-2" alt="image">{{ $buku->judul_buku }}
                            <?php
                              }else{
                            ?>
                              <img src="assets/images/sampul/{{$buku->sampul}}" class="me-2" alt="image">{{ $buku->judul_buku }}
                            <?php }?>  
                          </td>
                          <td>{{$buku->isbn}}</td>
                          <td>{{$buku->kategori}}</td>
                          <td>{{$buku->jenis->nama}}</td>
                          <td>{{$buku->penulis}}</td>
                          <td>
                            {{$buku->penerbit}}
                          </td>
                          <td> {{$buku->tahun_terbit}} </td>
                          <td> {{$buku->jumlah}} </td>
                          {{-- <td> {{$buku->getCreatedAttribute()}} </td> --}}
                          <td>
                            <button type="button" class="btn btn-inverse-info btn-icon" data-bs-toggle="modal" data-bs-target="#view{{$buku->id}}">
                              <i class="mdi mdi-information-outline"></i>
                            </button>
                            
                            <button type="button" class="btn btn-inverse-primary btn-icon" data-bs-toggle="modal" data-bs-target="#edit{{$buku->id}}">
                              <i class="mdi mdi-pencil"></i>
                            </button>
                            
                            <a href="#">
                            <button class="btn btn-inverse-danger btn-icon delete " data-id = "{{$buku->id}}" data-judul = "{{$buku->judul_buku}}"> 
                              <i class="mdi mdi-delete "></i>
                            </button></a>
                          </td>
                        </tr>
                        <!-- The Detail Modal -->
                        <div class="modal fade" id="view{{$buku->id}}">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title ">Detail Buku</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body px-4">
                                
                                <div class="row">
                                  <div class="col-sm-6 ">
                                    <h2>{{$buku->judul_buku}}</h2>
                                    <?php
                                      if (empty($buku->sampul)){?>
                                        <img width="200px" src="assets/images/sampul/sampuldefault.png" class="me-2" alt="image">
                                    <?php
                                      }else{
                                    ?>
                                        <img width="200px" src="assets/images/sampul/{{$buku->sampul}}" class="me-2" alt="image">
                                    <?php }?> 
                                  </div>
                                  <div class="col-sm-6">
                                    <h6>ISBN</h6>
                                    <p>{{$buku->isbn}}</p>
                                    <h6>Kategori</h6>
                                    <p>{{$buku->kategori}}</p>
                                    <h6>Jenis Buku</h6>
                                    <p>{{$buku->jenis->nama}}</p>
                                    <h6>Penulis</h6>
                                    <p>{{$buku->penulis}}</p>
                                    <h6>Penerbit</h6>
                                    <p>{{$buku->penerbit}}</p>
                                    <h6>Tahun Terbit</h6>
                                    <p>{{$buku->tahun_terbit}}</p>
                                    <h6>Jumlah Buku</h6>
                                    <p>{{$buku->jumlah}}</p>
                                    <h6>Diinput Pada</h6>
                                    <p>{{$buku->getCreatedAttribute()}}</p>
                                    <h6>Diperbarui Pada</h6>
                                    <p>{{$buku->getUpdatedAttribute()}}</p>
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
                        <div class="modal fade" id="edit{{$buku->id}}">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title ">Edit Data Buku</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body px-4">
                                
                                <form action="/updatebuku/{{$buku->id}}" method="POST" enctype="multipart/form-data" class="forms-sample">
                                  @csrf
                                  <div class="form-group">
                                    <label for="judul_buku">Judul Buku</label>
                                    <input required value="{{$buku->judul_buku}}" type="text" name="judul_buku" class="form-control" id="judul_buku" placeholder="Judul Buku">
                                  </div>
                                  <div class="form-group">
                                    <label for="isbn">ISBN</label>
                                    <input required value="{{$buku->isbn}}" type="text" name="isbn" class="form-control" id="isbn" placeholder="ISBN Buku">
                                  </div>
                                  <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select  class="form-control" name="kategori" id="kategori">
                                      <option class="" value="{{$buku->kategori}}"><div style="text-transform: capitalize;">{{ $buku->kategori}}</div></option>
                                      <option value="fiksi">Fiksi</option>
                                      <option value="nonfiksi">Non Fiksi</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="jenis_id">Jenis Buku</label>
                                    <select class="form-control" name="jenis_id" id="jenis_id">
                                      <option class="disabled" value="{{$buku->jenis->id}}">{{ $buku->jenis->nama}}</option>
                                      @foreach ($jen as $jenisbuku)
                                        <option value="{{$jenisbuku->id}}">{{$jenisbuku->nama}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="penulis">Penulis</label>
                                    <input required value="{{$buku->penulis}}" type="text" name="penulis" class="form-control" id="penulis" placeholder="Penulis">
                                  </div>
                                  <div class="form-group">
                                    <label for="penerbit">Penerbit</label>
                                    <input required value="{{$buku->penerbit}}" type="text" name="penerbit" class="form-control" id="penerbit" placeholder="Penerbit">
                                  </div>
                                  <div class="form-group">
                                    <label for="tahun_terbit">Tahun Terbit</label>
                                    <input required value="{{$buku->tahun_terbit}}" type="text" name="tahun_terbit" class="form-control" id="tahun_terbit" placeholder="Tahun Terbit">
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="jumlah">Jumlah Buku</label>
                                    <input required value="{{$buku->jumlah}}" type="number" name="jumlah" class="form-control" id="jumlah" placeholder="kode">
                                  </div>
                                  <div class="form-group">
                                    <label>Sampul Buku</label><br>
                                    <img height="100px" src="assets/images/sampul/{{$buku->sampul}}" alt="">
                                    <input type="file" name="sampul" class="form-control">
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
        var idbuku = $(this).attr('data-id');
        var judul_buku = $(this).attr('data-judul');
        Swal.fire({
        title: 'Apakah Yakin?',
        text: "Hapus Buku dengan judul "+judul_buku+" ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "/deletebuku/"+idbuku+""
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



