@extends('layouts.blank')

@section('content')

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-book-open "></i>
    </span> Data Guru/Staff
  </h3>
  
</div>
@if($message = Session::get('insertsuccess'))
{{-- Notif buku berhasil ditambah --}}
  <script>
    Swal.fire(
    'Berhasil!',
    'Data Guru Berhasil Ditambahkan!',
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
    'Data Guru Berhasil Ditambahkan!',
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
    'Data Guru Berhasil Diperbarui!',
    'success'
    )
  </script>
@endif

<div class="row">
  <div class="col-12 grid-margin">
    <div class="float">
    
    <a href="/tambahguru" type="button" class="btn btn-sm btn-primary mb-3"  ><i class="mdi mdi-library-plus mdi-icon"></i> Tambah Guru/Staff</a>
    
    <div class="float-end mb-3">
      
    <a href="/exportpdf_guru"><button type="button" class="btn btn-sm btn-info btn-icon-text me-1"> <i class="mdi mdi-printer btn-icon-append"></i>  PDF  </button></a>
    <a href="/exportexcel_guru"> <button type="button" class="btn btn-sm btn-success btn-icon-text me-1"> <i class="mdi mdi-printer btn-icon-append"></i>  Excel  </button></a>
    <button type="button" data-bs-toggle="modal" data-bs-target="#importguru" class="btn btn-sm btn-danger btn-icon-text"><i class="mdi mdi-upload btn-icon-prepend"></i>Import Data</button>
      
      <!-- The Import Guru Excel Modal -->
      <div class="modal fade" id="importguru">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title ">Import Data Guru/Staff</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <!-- Modal body -->
        
          <div class="card m-3 text-center" >
            <div class="card-body m-3">
              <h5 class="card-title text-center">Download Template Excel</h5>
              <h6 class="card-subtitle mb-2 text-muted text-center">Untuk Import Data</h6>
              <a href="assets/template_import/importguru_template.xlsx"><button type="button" class="btn btn-primary text-center">Download</button></a>
            </div>
          </div>
          <form action="/importexcel_guru" method="POST" enctype="multipart/form-data">
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
        <h4 class="card-title">Data Guru/Staff</h4>
        <div class="table-responsive">
          <table class="table " id="myTable">
            <thead>              
              <tr>
                <th> No </th>
                <th> Nama </th>
                <th> NIK </th>
                <th> Jabatan </th>
                <th> Berlaku Sampai </th>
                <th> Status </th>
                <th> Aksi </th>
              </tr>
            </thead>
            <tbody>
            @foreach ($gurus as $index => $guru)
              <tr>
                <td scope="guru">{{ $index + $gurus->firstItem()}}</td>
                <td>
                  <?php
                    if (empty($guru->foto_guru)){?>
                      <img src="assets/images/foto_guru/person.png" class="me-2" alt="image">{{ $guru->nama }}
                  <?php
                    }else{
                  ?>
                    <img src="assets/images/foto_guru/{{$guru->foto_guru}}" class="me-2" alt="image">{{ $guru->nama }}
                  <?php }?>  
                </td>
                <td>{{$guru->nik}}</td>
                <td>{{$guru->jabatan}}</td>
                <td>{{$guru->getMasaBerlaku()}}</td>
                
                @if ($guru->status == "Aktif")
                  <td>
                    <a href="ubahStatusNonAktifGuru/{{$guru->id}}"> <label  style="cursor: pointer;" class="badge badge-gradient-primary">{{$guru->status}}</label></a>
                  </td>
                @else
                  <td>
                    <a href="ubahStatusAktifGuru/{{$guru->id}}"> <label  style="cursor: pointer;" class="badge badge-gradient-danger">{{$guru->status}}</label></a>
                  </td>
                @endif

                <td>
                  <button type="button" class="btn btn-inverse-info btn-icon" data-bs-toggle="modal" data-bs-target="#view{{$guru->id}}" >
                    <i class="mdi mdi-information-outline"></i>
                  </button>
                  
                  <button type="button" class="btn btn-inverse-primary btn-icon" data-bs-toggle="modal" data-bs-target="#edit{{$guru->id}}">
                    <i class="mdi mdi-pencil"></i>
                  </button>
                  
                  <a href="#">
                  <button class="btn btn-inverse-danger btn-icon delete " data-id = "{{$guru->id}}" data-guru = "{{$guru->nama}}"> 
                    <i class="mdi mdi-delete "></i>
                  </button></a>
                </td>
              </tr>
              <!-- The Detail Modal -->
              <div class="modal fade" id="view{{$guru->id}}">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title ">Detail Guru</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body px-4">
                      
                      <div class="row">
                        <div class="col-sm-6 ">
                          <h3>{{$guru->nama}}</h3>
                          <?php
                            if (empty($guru->foto_guru)){?>
                              <img width="200px" src="assets/images/foto_guru/person.png" class="me-2" alt="image">
                          <?php
                            }else{
                          ?>
                              <img width="200px" src="assets/images/foto_guru/{{$guru->foto_guru}}" class="me-2" alt="image">
                          <?php 
                        }?> 
                        </div>
                        <div class="col-sm-6">
                          <h6>NIK</h6>
                          <p>{{$guru->nik}}</p>
                          <h6>Jabatan</h6>
                          <p>{{$guru->jabatan}}</p>
                          <h6>Status</h6>
                          <p>{{$guru->status}}</p>
                          <h6>Berlaku Sampai</h6>
                          <p>{{$guru->getMasaBerlaku()}}</p>
                          <h6>Diinput Pada</h6>
                          <p>{{$guru->getCreatedAttribute()}}</p>
                          <h6>Diperbarui Pada</h6>
                          <p>{{$guru->getUpdatedAttribute()}}</p>
                          
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
              <div class="modal fade" id="edit{{$guru->id}}">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title ">Edit Data Guru</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body px-4">
                      
                      <form action="/updateguru/{{$guru->id}}" method="POST" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                      
                        <div class="form-group">
                          <label for="nama">Nama Guru/Staff</label>
                          <input value="{{$guru->nama}}" type="text" name="nama" class="form-control" id="nama" placeholder="Nama Guru" required value="{{ old('nama') }}" autocomplete="nama"
                          class="@error('nama') is-invalid @enderror">
                          @error('nama')
                              <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="jabatan">Jabatan</label>
                          <select class="form-control" name="jabatan" id="jabatan"
                          class="@error('jabatan') is-invalid @enderror">
                            <option value="{{$guru->jabatan}}">{{$guru->jabatan}}</option>
                            <option value="Guru">Guru</option>
                            <option value="Karyawan">Karyawan</option>
                          </select>
                          @error('jabatan')
                              <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="nik">NIK</label>
                          <input value="{{$guru->nik}}" type="text" name="nik" class="form-control" id="nik" placeholder="NIK" required value="{{ old('nik') }}" autocomplete="nik"
                          class="@error('nik') is-invalid @enderror">
                          @error('nik')
                              <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="masa_berlaku">Berlaku Sampai</label>
                          <input value="{{$guru->masa_berlaku}}" type="date" name="masa_berlaku" class="form-control" id="masa_berlaku" placeholder="Angkatan" value="{{ old('masa_berlaku') }}" autocomplete="masa_berlaku"
                          class="@error('masa_berlaku') is-invalid @enderror">
                          @error('masa_berlaku')
                              <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Foto Guru</label><br>
                          <img height="100px" src="assets/images/foto_guru/{{$guru->foto_guru}}" alt="">
                          <input type="file" name="foto_guru" class="form-control">
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

       
<!-- page-body-wrapper ends -->
<script>
  $('.delete').click(function(){
    var idguru = $(this).attr('data-id');
    var nama = $(this).attr('data-guru');
    Swal.fire({
    title: 'Apakah Yakin?',
    text: "Hapus Guru dengan Nama "+nama+" ",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "/deleteguru/"+idguru+""
      Swal.fire(
        'Dihapus!',
        'Data Berhasil Dihapus',
        'success'
      )
    }
  })
  })
</script>

    
@endsection



