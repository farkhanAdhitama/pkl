@extends('layouts.blank')

@section('content')
    <div id="container">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-book-open "></i>
                </span> Koleksi Buku
            </h3>

        </div>
        {{-- swall berhasil insert --}}
        @if ($message = Session::get('addsuccess'))
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
        @if ($message = Session::get('importsuccess'))
            {{-- Notif buku berhasil ditambah --}}
            <script>
                Swal.fire(
                    'Berhasil!',
                    'Data Buku Berhasil Ditambahkan!',
                    'success'
                )
            </script>
        @endif

        {{-- swal gagal export pertanggal --}}
        @if ($message = Session::get('export_gagal'))
            <script>
                Swal.fire(
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal Cetak PDF Per Tanggal',
                    footer: 'Pastikan Tanggal Awal dan Akhir Terisi'
                )
            </script>
        @endif

        @if ($message = Session::get('deletesuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
            </div>
        @endif

        {{-- Jika berhasil Update --}}
        @if ($message = Session::get('updatesuccess'))
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
                    <a href="tambahbuku" type="button" class="tambah_buku btn btn-sm btn-primary mb-3"><i
                            class="mdi mdi-library-plus mdi-icon"></i> Tambah Buku</a>
                    <div class="float-end mb-3">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#cetakPDF"
                            class="btn btn-sm btn-primary btn-icon-text me-1"><i
                                class="mdi mdi-printer
                                btn-icon-append"></i>Cetak
                            PDF</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#cetakExcel"
                            class="btn btn-sm btn-success btn-icon-text me-1"><i
                                class="mdi mdi-printer
                                btn-icon-append"></i>Cetak
                            Excel</button>

                        {{-- <a href="/exportexcel"> <button type="button" class="btn btn-sm btn-success btn-icon-text me-1"> <i
                                    class="mdi mdi-printer btn-icon-append"></i> Cetak Excel </button></a> --}}
                        <button type="button" data-bs-toggle="modal" data-bs-target="#importbuku"
                            class="btn btn-sm btn-danger btn-icon-text"><i
                                class="mdi mdi-upload btn-icon-prepend"></i>Import
                            Data</button>

                        <!-- The Cetak PDF pertanggal Modal -->
                        <div class="modal fade" id="cetakPDF">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title ">Cetak PDF</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body px-4">
                                        <div class="form-group">
                                            <label for="tgl_awal">Tanggal Awal</label>
                                            <input type="date" name="tgl_awal" class="form-control" id="tgl_awal"
                                                placeholder="Tanggal Awal" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_akhir">Tanggal Akhir</label>
                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir"
                                                placeholder="Tanggal Akhir" required>
                                        </div>
                                        <button id="exportPDF" type="button"
                                            class="exportPDF btn btn-primary w-100 mb-2">Cetak
                                            PDF</button>
                                        <h6 class="mt-2">Keterangan :</h6>
                                        <ul>
                                            <li class="small">Jangkauan Tanggal Menurut Tanggal Buku Masuk</li>
                                            <li class="small">Kosongkan Tanggal Untuk Mencetak Semua</li>
                                        </ul>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- The Cetak Excel pertanggal Modal -->
                        <div class="modal fade" id="cetakExcel">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title ">Cetak Excel</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body px-4">
                                        <div class="form-group">
                                            <label for="tgl_awal_excel">Tanggal Awal</label>
                                            <input type="date" name="tgl_awal_excel" class="form-control"
                                                id="tgl_awal_excel" placeholder="Tanggal Awal" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_akhir_excel">Tanggal Akhir</label>
                                            <input type="date" name="tgl_akhir_excel" class="form-control"
                                                id="tgl_akhir_excel" placeholder="Tanggal Akhir" required>
                                        </div>
                                        <button id="exportExcel" type="button"
                                            class="exportExcel btn btn-primary w-100 mb-2">Cetak
                                            Excel</button>
                                        <h6 class="mt-2">Keterangan :</h6>
                                        <ul>
                                            <li class="small">Jangkauan Tanggal Menurut Tanggal Buku Masuk</li>
                                            <li class="small">Kosongkan Tanggal Untuk Mencetak Semua</li>
                                        </ul>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- The Import Excel Modal -->
                        <div class="modal fade" id="importbuku">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title ">Import Data Buku</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <!-- Modal body -->

                                    <div class="card m-3 text-center">
                                        <div class="card-body m-3">
                                            <h5 class="card-title text-center">Download Template Excel</h5>
                                            <h6 class="card-subtitle mb-2 text-muted text-center">Untuk Import Data</h6>
                                            <a href="assets/template_import/importdata_buku.xlsx"><button type="button"
                                                    class="btn btn-primary text-center">Download</button></a>
                                        </div>
                                    </div>
                                    <form action="/importexcel" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="modal-body px-4">
                                            <h5>Pilih File yang Akan Diimport</h5>
                                            <div class="form-group">
                                                <input class="" type="file" name="file" id=""
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"
                                                data-bs-dismiss="modal">Import</button>
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Tutup</button>
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
                                        <th> No </th>
                                        <th> Judul </th>
                                        <th> ISBN </th>
                                        <th> Kategori </th>
                                        {{-- <th> Jenis Buku</th> --}}
                                        <th> Penulis </th>
                                        <th> Penerbit </th>
                                        <th> Terbitan </th>
                                        <th> Jumlah </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bukus as $index => $buku)
                                        <tr>
                                            <td scope="buku">{{ $index + $bukus->firstItem() }}</td>
                                            <td>
                                                <?php
                    if (empty($buku->sampul)){?>
                                                <img src="assets/images/sampul/sampuldefault.png" class="me-2"
                                                    alt="image">{{ $buku->judul_buku }}
                                                <?php
                    }else{
                  ?>
                                                <img src="assets/images/sampul/{{ $buku->sampul }}" class="me-2"
                                                    alt="image">{{ $buku->judul_buku }}
                                                <?php }?>
                                            </td>
                                            <td>{{ $buku->isbn }}</td>
                                            <td>{{ $buku->kategori }}</td>
                                            {{-- <td>{{ $buku->jenis->nama ?? 'N/A' }}</td> --}}
                                            <td>{{ $buku->penulis }}</td>
                                            <td>
                                                {{ $buku->penerbit->nama_penerbit ?? 'N/A' }}
                                            </td>
                                            <td> {{ $buku->tahun_terbit }} </td>
                                            <td> {{ $buku->jumlah }} </td>
                                            {{-- <td> {{$buku->getCreatedAttribute()}} </td> --}}
                                            <td>
                                                <button type="button" class="btn btn-inverse-info btn-icon"
                                                    data-bs-toggle="modal" data-bs-target="#view{{ $buku->id }}">
                                                    <i class="mdi mdi-information-outline"></i>
                                                </button>

                                                <button type="button" class="btn btn-inverse-primary btn-icon"
                                                    data-bs-toggle="modal" data-bs-target="#edit{{ $buku->id }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>

                                                <a href="#">
                                                    <button class="btn btn-inverse-danger btn-icon delete "
                                                        data-id="{{ $buku->id }}"
                                                        data-judul="{{ $buku->judul_buku }}">
                                                        <i class="mdi mdi-delete "></i>
                                                    </button></a>
                                            </td>
                                        </tr>
                                        <!-- The Detail Modal -->
                                        <div class="modal fade " id="view{{ $buku->id }}">
                                            <div class="modal-dialog modal-xl  modal-dialog-centered">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title ">Detail Buku</h4>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body px-4">

                                                        <div class="row">
                                                            <div class="col-sm-4 ">
                                                                <div class="text-center">
                                                                    <h2>{{ $buku->judul_buku }}</h2>
                                                                    <?php
                            if (empty($buku->sampul)){?>
                                                                    <img width="200px"
                                                                        src="assets/images/sampul/sampuldefault.png"
                                                                        class="me-2" alt="image">
                                                                    <?php
                            }else{
                          ?>
                                                                    <img width="200px"
                                                                        src="assets/images/sampul/{{ $buku->sampul }}"
                                                                        class="me-2" alt="image">
                                                                    <?php }?>


                                                                    <h6 class="mt-3">Diinput Pada</h6>
                                                                    <p>{{ $buku->getCreatedAttribute() }}</p>
                                                                    <h6>Diperbarui Pada</h6>
                                                                    <p>{{ $buku->getUpdatedAttribute() }}</p>
                                                                    <h6>Harga</h6>
                                                                    <p>Rp {{ $buku->harga }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <h6>Peruntukan</h6>
                                                                <p>{{ $buku->peruntukan }}</p>
                                                                <h6>Kategori</h6>
                                                                <p>{{ $buku->kategori }}</p>
                                                                <h6>Bahasa</h6>
                                                                <p>{{ $buku->bahasa }}</p>
                                                                <h6>Subyek</h6>
                                                                <p>{{ $buku->subyek ?? 'N/A' }}</p>
                                                                <h6>Penulis</h6>
                                                                <p>{{ $buku->penulis }}</p>
                                                                <h6>Jumlah Buku</h6>
                                                                <p>{{ $buku->jumlah }}</p>
                                                                <h6>Edisi</h6>
                                                                <p>{{ $buku->edisi ?? 'N/A' }}</p>
                                                                <h6>Jilid</h6>
                                                                <p>{{ $buku->jilid ?? 'N/A' }}</p>
                                                                <h6>Jumlah Halaman</h6>
                                                                <p>{{ $buku->jumlah }}</p>
                                                                <h6>Rak</h6>
                                                                <p>{{ $buku->rak ?? 'N/A' }}</p>

                                                            </div>

                                                            <div class="col-sm-4">
                                                                <h6>ISBN</h6>
                                                                <p>{{ $buku->isbn }}</p>
                                                                <h6>Judul Asli</h6>
                                                                <p>{{ $buku->judul_asli }}</p>
                                                                <h6>Jenis Buku</h6>
                                                                <p>{{ $buku->jenis->nama ?? 'N/A' }}</p>
                                                                <h6>Penerjemah</h6>
                                                                <p>{{ $buku->penerjemah ?? 'N/A' }}</p>
                                                                <h6>Perolehan</h6>
                                                                <p>{{ $buku->perolehan }}</p>
                                                                <h6>Penerbit</h6>
                                                                <p>{{ $buku->penerbit->nama_penerbit ?? 'N/A' }}</p>
                                                                <h6>Tahun Terbit</h6>
                                                                <p>{{ $buku->tahun_terbit }}</p>
                                                                <h6>Tempat Terbit</h6>
                                                                <p>{{ $buku->tempat_terbit->kota ?? 'N/A' }}</p>
                                                                <h6>Cetakan ke-</h6>
                                                                <p>{{ $buku->cetakan ?? 'N/A' }}</p>
                                                                <h6>Panjang x Lebar</h6>
                                                                <p>{{ $buku->panjang }} cm x {{ $buku->lebar }} cm</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-gradient-danger w-100"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <!-- The Edit Modal -->
                                        <div class="modal fade" id="edit{{ $buku->id }}">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title ">Edit Data Buku</h4>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body px-4">
                                                        <form action="/updatebuku/{{ $buku->id }}" method="POST"
                                                            enctype="multipart/form-data" class="forms-sample">
                                                            @csrf

                                                            {{-- PERUNTUKAN DAN ISBN --}}
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="peruntukan">Peruntukan<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-9">
                                                                            <input required
                                                                                value="{{ $buku->peruntukan }}"
                                                                                type="text" name="peruntukan"
                                                                                class="form-control"
                                                                                id="peruntukan @error('peruntukan') is-invalid @enderror"
                                                                                placeholder="Peruntukan" required
                                                                                value="{{ old('peruntukan') }}"
                                                                                autocomplete="peruntukan">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="isbn">ISBN<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-9">
                                                                            <input required value="{{ $buku->isbn }}"
                                                                                type="text" name="isbn"
                                                                                class="form-control" id="isbn"
                                                                                placeholder="ISBN Buku">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- JUDUL BUKU DAN ISBN --}}
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="judul_buku">Judul Buku<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-9">
                                                                            <input required
                                                                                value="{{ $buku->judul_buku }}"
                                                                                type="text" name="judul_buku"
                                                                                class="form-control" id="judul_buku"
                                                                                placeholder="Judul Buku">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="judul_asli">Judul Asli</label>
                                                                        <div class="col-sm-9">
                                                                            <input
                                                                                value="{{ $buku->judul_asli ?? 'N/A' }}"
                                                                                type="text" name="judul_asli"
                                                                                class="form-control" id="judul_asli"
                                                                                placeholder="Judul Asli" required
                                                                                value="{{ old('judul_asli') }}"
                                                                                autocomplete="judul_asli">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- KATEGORI DAN JENIS BUKU --}}
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="kategori">Kategori<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" name="kategori"
                                                                                id="kategori">
                                                                                <option class=""
                                                                                    value="{{ $buku->kategori }}">
                                                                                    <div
                                                                                        style="text-transform: capitalize;">
                                                                                        {{ $buku->kategori }}</div>
                                                                                </option>
                                                                                <option value="Fiksi">Fiksi</option>
                                                                                <option value="Nonfiksi">Non Fiksi</option>
                                                                                <option value="Referensi">Referensi
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="jenis_id">Jenis Buku<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control" name="jenis_id"
                                                                                id="jenis_id">
                                                                                <option
                                                                                    value="{{ $buku->jenis->id ?? '' }}">
                                                                                    {{ $buku->jenis->nama ?? '' }}</option>
                                                                                @foreach ($jen as $jenisbuku)
                                                                                    <option value="{{ $jenisbuku->id }}">
                                                                                        {{ $jenisbuku->nama }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <button type="button" title="Tambah Jenis Buku"
                                                                            onclick="location.href='/datajenisbuku';"
                                                                            class="btn btn-sm btn-inverse-primary btn-icon delete ">
                                                                            <i
                                                                                class="mdi mdi-file-document-box"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- BAHASA DAN PEROLEHAN --}}
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="bahasa">Bahasa<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" name="bahasa"
                                                                                id="bahasa">
                                                                                <option class=""
                                                                                    value="{{ $buku->bahasa }}">
                                                                                    <div
                                                                                        style="text-transform: capitalize;">
                                                                                        {{ $buku->bahasa }}</div>
                                                                                </option>
                                                                                <option value="Indonesia">Indonesia
                                                                                </option>
                                                                                <option value="Arab">Arab</option>
                                                                                <option value="Inggris">Inggris</option>
                                                                                <option value="Lainnya">Lainnya</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="perolehan">Perolehan<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" name="perolehan"
                                                                                id="perolehan">
                                                                                <option class=""
                                                                                    value="{{ $buku->perolehan }}">
                                                                                    <div
                                                                                        style="text-transform: capitalize;">
                                                                                        {{ $buku->perolehan }}</div>
                                                                                </option>
                                                                                <option value="Pembelian">Pembelian
                                                                                </option>
                                                                                <option value="Hadiah">Hadiah</option>
                                                                                <option value="Hibah">Hibah</option>
                                                                                <option value="Dropping">Dropping</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- SUBJEK DAN PENERJEMAH --}}
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="subyek">Subyek</label>
                                                                        <div class="col-sm-9">
                                                                            <input value="{{ $buku->subyek ?? 'N/A' }}"
                                                                                type="text" name="subyek"
                                                                                class="form-control" id="subyek"
                                                                                placeholder="Subyek" required
                                                                                value="{{ old('subyek') }}"
                                                                                autocomplete="subyek">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="penerjemah">Penerjemah</label>
                                                                        <div class="col-sm-9">
                                                                            <input
                                                                                value="{{ $buku->penerjemah ?? 'N/A' }}"
                                                                                type="text" name="penerjemah"
                                                                                class="form-control" id="penerjemah"
                                                                                placeholder="Penerjemah" required
                                                                                value="{{ old('penerjemah') }}"
                                                                                autocomplete="penerjemah">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- PENULIS DAN PENERBIT --}}
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="penulis">Penulis<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-9">
                                                                            <input required value="{{ $buku->penulis }}"
                                                                                type="text" name="penulis"
                                                                                class="form-control" id="penulis"
                                                                                placeholder="Penulis">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="penerbit_id">Penerbit<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control"
                                                                                name="penerbit_id" id="penerbit_id">
                                                                                <option
                                                                                    value="{{ $buku->penerbit->id ?? '' }}">
                                                                                    {{ $buku->penerbit->nama_penerbit ?? '' }}
                                                                                </option>
                                                                                @foreach ($penerbit as $row)
                                                                                    <option value="{{ $row->id }}">
                                                                                        {{ $row->nama_penerbit }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <button type="button" title="Tambah Penerbit"
                                                                            onclick="location.href='/dataPenerbit';"
                                                                            class="btn btn-sm btn-inverse-primary btn-icon ">
                                                                            <i
                                                                                class="mdi mdi-file-document-box"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- TAHUN TERBIT DAN JUMLAH BUKU --}}
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="jumlah">Jumlah<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-9">
                                                                            <input required value="{{ $buku->jumlah }}"
                                                                                type="number" name="jumlah"
                                                                                class="form-control" id="jumlah"
                                                                                placeholder="Jumlah Buku">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="tahun_terbit">Tahun Terbit<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-9">
                                                                            <input required
                                                                                value="{{ $buku->tahun_terbit }}"
                                                                                type="text" name="tahun_terbit"
                                                                                class="form-control" id="tahun_terbit"
                                                                                placeholder="Tahun Terbit">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- EDISI DAN TEMPAT TERBIT --}}
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="edisi">Edisi</label>
                                                                        <div class="col-sm-9">
                                                                            <input value="{{ $buku->edisi }}"
                                                                                type="number" name="edisi"
                                                                                class="form-control"
                                                                                id="edisi @error('edisi') is-invalid @enderror"
                                                                                placeholder="Edisi"
                                                                                value="{{ old('edisi') }}"
                                                                                autocomplete="edisi">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="tempat_terbit_id">Tempat Terbit<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control"
                                                                                name="tempat_terbit_id"
                                                                                id="tempat_terbit_id">
                                                                                <option
                                                                                    value="{{ $buku->tempat_terbit->id ?? '' }}">
                                                                                    {{ $buku->tempat_terbit->kota ?? '' }}
                                                                                </option>
                                                                                @foreach ($tempat_terbit as $row)
                                                                                    <option value="{{ $row->id }}">
                                                                                        {{ $row->kota }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <button type="button"
                                                                            title="Tambah Tempat Terbit"
                                                                            onclick="location.href='/dataTempatTerbit';"
                                                                            class="btn btn-sm btn-inverse-primary btn-icon ">
                                                                            <i
                                                                                class="mdi mdi-file-document-box"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- JILID DAN CETAKAN --}}
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="jilid">Jilid</label>
                                                                        <div class="col-sm-9">
                                                                            <input value="{{ $buku->jilid }}"
                                                                                type="number" name="jilid"
                                                                                class="form-control" id="jilid"
                                                                                placeholder="Jilid"
                                                                                value="{{ old('jilid') }}"
                                                                                autocomplete="jilid"
                                                                                class="@error('jilid') is-invalid @enderror">
                                                                            @error('jilid')
                                                                                <sub
                                                                                    class="fst-italic text-danger">{{ "$message" }}</sub>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="cetakan">Cetakan</label>
                                                                        <div class="col-sm-9">
                                                                            <input value="{{ $buku->cetakan }}"
                                                                                type="number" name="cetakan"
                                                                                class="form-control" id="cetakan"
                                                                                placeholder="Cetakan"
                                                                                value="{{ old('cetakan') }}"
                                                                                autocomplete="cetakan"
                                                                                class="@error('cetakan') is-invalid @enderror">
                                                                            @error('cetakan')
                                                                                <sub
                                                                                    class="fst-italic text-danger">{{ "$message" }}</sub>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- HALAMAN DAN PANJANG LEBAR --}}
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="halaman">Halaman</label>
                                                                        <div class="col-sm-9">
                                                                            <input value="{{ $buku->halaman }}"
                                                                                type="number" name="halaman"
                                                                                class="form-control" id="halaman"
                                                                                placeholder="Halaman"
                                                                                value="{{ old('halaman') }}"
                                                                                autocomplete="halaman">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-6 col-form-label"
                                                                            for="panjang">Panjang</label>
                                                                        <div class="col-sm-6">
                                                                            <input value="{{ $buku->panjang }}"
                                                                                type="number" name="panjang"
                                                                                class="form-control" id="panjang"
                                                                                placeholder="Panjang (cm)"
                                                                                value="{{ old('panjang') }}"
                                                                                autocomplete="panjang">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-6 col-form-label"
                                                                            for="lebar">Lebar</label>
                                                                        <div class="col-sm-6">
                                                                            <input value="{{ $buku->lebar }}"
                                                                                type="number" name="lebar"
                                                                                class="form-control" id="lebar"
                                                                                placeholder="Lebar (cm)"
                                                                                value="{{ old('lebar') }}"
                                                                                autocomplete="lebar">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- RAK DAN HARGA --}}
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="rak">Rak</label>
                                                                        <div class="col-sm-9">
                                                                            <input value="{{ $buku->rak }}"
                                                                                type="number" name="rak"
                                                                                class="form-control" id="rak"
                                                                                placeholder="Rak"
                                                                                value="{{ old('rak') }}"
                                                                                autocomplete="rak"
                                                                                class="@error('rak') is-invalid @enderror">
                                                                            @error('rak')
                                                                                <sub
                                                                                    class="fst-italic text-danger">{{ "$message" }}</sub>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label"
                                                                            for="harga">Harga</label>
                                                                        <div class="col-sm-9">
                                                                            <input value="{{ $buku->harga }}"
                                                                                type="number" name="harga"
                                                                                class="form-control" id="harga"
                                                                                placeholder="Harga"
                                                                                value="{{ old('harga') }}"
                                                                                autocomplete="harga"
                                                                                class="@error('harga') is-invalid @enderror">
                                                                            @error('harga')
                                                                                <sub
                                                                                    class="fst-italic text-danger">{{ "$message" }}</sub>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="form-group">
                                                                <label>Sampul Buku</label><br>
                                                                <img class="mb-2" height="100px"
                                                                    src="assets/images/sampul/{{ $buku->sampul }}"
                                                                    alt="">
                                                                <input type="file" name="sampul"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="mb-3"><span class="text-danger">*</span><span> =
                                                                    Wajib Diisi</span></div>
                                                            <button type="submit"
                                                                class="btn btn-primary me-2 ">Submit</button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Tutup</button>
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
    <!-- page-body-wrapper ends -->
    <script>
        $('.delete').click(function() {
            var idbuku = $(this).attr('data-id');
            var judul_buku = $(this).attr('data-judul');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Hapus Buku dengan judul " + judul_buku + " ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/deletebuku/" + idbuku + ""
                    Swal.fire(
                        'Dihapus!',
                        'Data Berhasil Dihapus',
                        'success'
                    )
                }
            })
        })
        // $('.tambah_buku').click(function() {
        //     $.ajax({
        //         url: '{{ route('tambahbuku') }}',
        //         success: function(data) {
        //             $('#container').html(data);
        //         },
        //         error: function() {
        //             console.log('Error occurred');
        //         }
        //     });
        // })
    </script>
    <script>
        $('#exportPDF').click(function() {
            var tgl_awal = document.getElementById('tgl_awal').value;
            var tgl_akhir = document.getElementById('tgl_akhir').value;

            if (tgl_awal == '') {
                tgl_awal = '2000-01-01';
            }

            if (tgl_akhir == '') {
                const date = new Date();
                const month = date.getMonth(); //getMonth mengembalikan bulan dalam nilai (0--11)
                const realMonth = month + 1;
                const now = date.getFullYear() + '-' + realMonth + '-' + date.getDate();
                tgl_akhir = now;
            }

            window.location.href = '/exportpdf_buku/' + tgl_awal + '/' + tgl_akhir
        })

        $('#exportExcel').click(function() {
            var tgl_awal_excel = document.getElementById('tgl_awal_excel').value;
            var tgl_akhir_excel = document.getElementById('tgl_akhir_excel').value;

            if (tgl_awal_excel == '') {
                tgl_awal_excel = '2000-01-01';
            }

            if (tgl_akhir_excel == '') {
                const date = new Date();
                const month = date.getMonth(); //getMonth mengembalikan bulan dalam nilai (0--11)
                const realMonth = month + 1;
                const now = date.getFullYear() + '-' + realMonth + '-' + date.getDate();
                tgl_akhir_excel = now;
            }

            window.location.href = '/exportexcel_buku/' + tgl_awal_excel + '/' + tgl_akhir_excel
        })
    </script>
@endsection
