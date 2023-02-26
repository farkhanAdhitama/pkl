@extends('layouts.blank')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-book-open "></i>
            </span> Tambah Data Anggota Siswa Perpustakaan
        </h3>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambahkan Data Anggota Siswa</h4>
                <p class="card-description"> Sesuai dengan form yang disediakan </p>
                <form action="/insertAnggota" method="POST" enctype="multipart/form-data" class="forms-sample">
                    @csrf

                    <div class="form-group">
                        <label for="nama">Nama Anggota</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Anggota"
                            required value="{{ old('nama') }}" autocomplete="nama"
                            class="@error('nama') is-invalid @enderror">
                        @error('nama')
                            <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="number" name="nis" class="form-control" id="nis" placeholder="NIS" required
                            value="{{ old('nis') }}" autocomplete="nis" class="@error('nis') is-invalid @enderror">
                        @error('nis')
                            <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                            required value="{{ old('email') }}" autocomplete="email"
                            class="@error('email') is-invalid @enderror">
                        @error('email')
                            <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="angkatan">Angkatan</label>
                        <input type="number" name="angkatan" class="form-control" id="angkatan" placeholder="Angkatan"
                            value="{{ old('angkatan') }}" autocomplete="angkatan"
                            class="@error('angkatan') is-invalid @enderror">
                        @error('angkatan')
                            <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-md-1">
                            <label for="kelas">Kelas</label>
                            <select class="form-control" name="kelas" id="kelas" required>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" name="jurusan" id="jurusan" required>
                                <option value="MIPA 1">MIPA 1</option>
                                <option value="MIPA 2">MIPA 2</option>
                                <option value="MIPA 3">MIPA 3</option>
                                <option value="MIPA 4">MIPA 4</option>
                                <option value="MIPA 5">MIPA 5</option>
                                <option value="IPS 1">IPS 1</option>
                                <option value="IPS 2">IPS 2</option>
                                <option value="IPS 3">IPS 3</option>
                                <option value="IPS 4">IPS 4</option>
                                <option value="BAHASA">BAHASA</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="masa_berlaku">Berlaku Sampai</label>
                        <input type="date" name="masa_berlaku" class="form-control" id="masa_berlaku"
                            placeholder="Angkatan" value="{{ old('masa_berlaku') }}" autocomplete="masa_berlaku"
                            class="@error('masa_berlaku') is-invalid @enderror">
                        @error('masa_berlaku')
                            <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto_anggota" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="/dataanggota" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
