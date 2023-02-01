@extends('layouts.blank')

@section('content')

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-book-open "></i>
    </span> Tambah Data Guru
  </h3>
</div>

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tambahkan Data Guru</h4>
      <p class="card-description"> Sesuai dengan form yang disediakan </p>
      <form action="/insertGuru" method="POST" enctype="multipart/form-data" class="forms-sample">
        @csrf
        
        <div class="form-group">
          <label for="nama">Nama Guru/Staff</label>
          <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Guru" required value="{{ old('nama') }}" autocomplete="nama"
          class="@error('nama') is-invalid @enderror">
          @error('nama')
              <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
          @enderror
        </div>

        
        <div class="form-group">
          <label for="jabatan">Jabatan</label>
          <select class="form-control" name="jabatan" id="jabatan"
          class="@error('jabatan') is-invalid @enderror">
            <option value="Guru">Guru</option>
            <option value="Karyawan">Karyawan</option>
          </select>
          @error('jabatan')
              <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
          @enderror
        </div>

        <div class="form-group">
          <label for="nik">NIK</label>
          <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK" required value="{{ old('nik') }}" autocomplete="nik"
          class="@error('nik') is-invalid @enderror">
          @error('nik')
              <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
          @enderror
        </div>

        <div class="form-group">
          <label for="masa_berlaku">Berlaku Sampai</label>
          <input type="date" name="masa_berlaku" class="form-control" id="masa_berlaku" placeholder="Angkatan" value="{{ old('masa_berlaku') }}" autocomplete="masa_berlaku"
          class="@error('masa_berlaku') is-invalid @enderror">
          @error('masa_berlaku')
              <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
          @enderror
        </div>


        <div class="form-group">
          <label>Foto</label>
          <input type="file" name="foto_guru" class="form-control">
        </div>
    
        <button type="submit" class="btn btn-primary me-2">Submit</button>
        <a href="/dataguru" class="btn btn-danger">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection
