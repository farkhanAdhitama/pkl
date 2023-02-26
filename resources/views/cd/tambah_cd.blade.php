@extends('layouts.blank')

@section('content')

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-book-open "></i>
    </span> Tambah CD
  </h3>
</div>

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tambahkan Koleksi CD</h4>
      <p class="card-description"> Sesuai dengan form yang disediakan </p>
      <form action="/insertCD" method="POST" enctype="multipart/form-data" class="forms-sample">
        @csrf
        
        <div class="form-group">
          <label for="kode_kelompok">Kode Kelompok<span class="text-danger">*</span> </label>
          <input type="number" name="kode_kelompok" class="form-control" id="kode_kelompok" placeholder="Kode Kelompok CD" required value="{{ old('kode_kelompok') }}" autocomplete="kode_kelompok"
          class="@error('kode_kelompok') is-invalid @enderror">
          @error('kode_kelompok')
              <sub class="p fst-italic text-danger">{{"$message"}}</sub>
          @enderror
        </div>
        <div class="form-group">
          <label for="judul_cd">Judul<span class="text-danger">*</span></label>
          <input type="text" name="judul_cd" class="form-control" id="judul_cd" placeholder="Judul CD" required value="{{ old('judul_cd') }}" autocomplete="judul_cd"
          class="@error('judul_cd') is-invalid @enderror">
          @error('judul_cd')
              <sub class="p fst-italic text-danger">{{"$message"}}</sub>
          @enderror
        </div>
        <div class="form-group">
          <label for="perolehan">Perolehan<span class="text-danger">*</span></label>
          <select class="form-control"  name="perolehan" id="perolehan" 
          class="@error('perolehan') is-invalid @enderror">
            <option value="">--Piih Perolehan--</option>
            <option value="Pembelian">Pembelian</option>
            <option value="Hadiah">Hadiah</option>
            <option value="Hibah">Hibah</option>
            <option value="Dropping">Dropping</option>
          </select>
          @error('perolehan')
          <sub class="fst-italic text-danger">{{ "$message"  }}</sub>
          @enderror
        </div>
        <div class="form-group">
          <label for="jumlah">Jumlah CD<span class="text-danger">*</span></label>
          <input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah CD" required value="{{ old('jumlah') }}" autocomplete="jumlah"
          class="@error('jumlah') is-invalid @enderror">
          @error('jumlah')
              <sub class="p fst-italic text-danger">{{"$message"}}</sub>
          @enderror
        </div>
        <div class="mb-3">
        <span class="text-danger">*</span><span>= Wajib Diisi</span>
        </div>
        <button type="submit" class="btn btn-primary me-2">Submit</button>
        <a href="/dataMajalah" class="btn btn-danger">Kembali</a>
      </form>
    </div>
  </div>
</div>         
@endsection
