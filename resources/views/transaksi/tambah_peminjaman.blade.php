@extends('layouts.blank')

@section('content')

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-book-open "></i>
    </span> Tambah Transaksi Peminjaman
  </h3>
</div>
@if($message = Session::get('success'))
{{-- Notif buku berhasil ditambah --}}
  <script>
    Swal.fire(
    'Berhasil!',
    'Transaksi Berhasil Dilakukan',
    'success'
    )
  </script>
@endif

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tambahkan Transaksi</h4>
        <p class="card-description"> Sesuai dengan form yang disediakan </p>
        <form action="/tambah_peminjaman" method="POST" enctype="multipart/form-data" class="forms-sample">
          @csrf
          
          <div class="form-group">
            <label for="anggota_id">Peminjam</label>
            <select class="form-control" class="selectpicker" data-live-search="true" name="anggota_id" id="anggota_id">
              <option value="">--Nama Peminjam--</option>
              @foreach ($anggotas as $anggota)
                <option value="{{$anggota->id}}">{{$anggota->nama}}</option>
              @endforeach
            </select>
          </div>  

          <div class="form-group">
            <label for="buku_id">Judul Buku</label>
            <select class="form-control selectpicker" data-live-search="true" name="buku_id" id="buku_id">
              <option value="">--Judul Buku--</option>
              @foreach ($bukus as $buku)
                <option value="{{$buku->id}}">{{$buku->judul_buku}}</option>
              @endforeach
            </select>
          </div>                  

          <div class="form-group">
            <label for="lama">Lama Pinjam</label>
            {{-- <input type="number" name="lama" class="form-control" id="lama" placeholder="Lama Peminjaman (Hari)" value="{{ old('lama') }}" autocomplete="lama"
            class="@error('lama') is-invalid @enderror"> --}}
            <select class="form-control selectpicker" data-live-search="true" name="lama" id="lama">
              <option value="7">1 Minggu</option>
              <option value="30">1 Bulan</option>
              <option value="365">1 Tahun</option>
            </select>
            @error('lama')
                <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
            @enderror
          </div>
          
          <button type="submit" class="btn btn-primary me-2">Submit</button>
          <a href="/peminjaman" class="btn btn-danger">Kembali</a>
        </form>
      </div>
    </div>
  </div>
@endsection
