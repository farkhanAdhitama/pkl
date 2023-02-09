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
                        <input type="number" name="nis" class="form-control" id="nis"
                            placeholder="NIS/NIP Anggota" required value="{{ old('nis') }}" autocomplete="nis"
                            class="@error('nis') is-invalid @enderror">
                        @error('nis')
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

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" name="kelas" id="kelas">
                            <option value="10 MIPA 1">10 MIPA 1</option>
                            <option value="10 MIPA 2">10 MIPA 2</option>
                            <option value="10 MIPA 3">10 MIPA 3</option>
                            <option value="10 MIPA 4">10 MIPA 4</option>
                            <option value="10 IPS 1">10 IPS 1</option>
                            <option value="10 IPS 2">10 IPS 2</option>
                            <option value="10 IPS 3">10 IPS 3</option>
                            <option value="10 IPS 4">10 IPS 4</option>
                            <option value="10 BAHASA">10 BAHASA</option>
                            <option value="11 MIPA 1">11 MIPA 1</option>
                            <option value="11 MIPA 2">11 MIPA 2</option>
                            <option value="11 MIPA 3">11 MIPA 3</option>
                            <option value="11 MIPA 4">11 MIPA 4</option>
                            <option value="11 IPS 1">11 IPS 1</option>
                            <option value="11 IPS 2">11 IPS 2</option>
                            <option value="11 IPS 3">11 IPS 3</option>
                            <option value="11 IPS 4">11 IPS 4</option>
                            <option value="11 BAHASA">11 BAHASA</option>
                            <option value="12 MIPA 1">12 MIPA 1</option>
                            <option value="12 MIPA 2">12 MIPA 2</option>
                            <option value="12 MIPA 3">12 MIPA 3</option>
                            <option value="12 MIPA 4">12 MIPA 4</option>
                            <option value="12 IPS 1">12 IPS 1</option>
                            <option value="12 IPS 2">12 IPS 2</option>
                            <option value="12 IPS 3">12 IPS 3</option>
                            <option value="12 IPS 4">12 IPS 4</option>
                            <option value="12 BAHASA">12 BAHASA</option>
                        </select>
                    </div>

                    <div class="form-group">
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
