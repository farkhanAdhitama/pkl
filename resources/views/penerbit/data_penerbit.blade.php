@extends('layouts.blank')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-book-open "></i>
            </span> Data Penerbit
        </h3>

    </div>

    @if ($message = Session::get('insertsuccess'))
        {{-- Notif buku berhasil ditambah --}}
        <script>
            Swal.fire(
                'Berhasil!',
                'Data Penerbit Berhasil Ditambahkan!',
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
                'Data Penerbit Berhasil Ditambahkan!',
                'success'
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
                'Data Penerbit Berhasil Diperbarui!',
                'success'
            )
        </script>
    @endif

    {{-- Data sudah ada --}}
    @if ($message = Session::get('add_fails'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Penerbit Sudah Ada',
                footer: 'Silahkan dicek kembali'
            })
        </script>
    @endif

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="float">
                <button onclick="location.href='/tambahbuku';" type="button" class="btn btn-sm btn-primary mb-3">
                    <i class="mdi mdi-keyboard-backspace"></i>
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#insertDataPenerbit"
                    class="btn btn-sm btn-primary mb-3"><i class="mdi mdi-library-plus mdi-icon"></i>Tambah
                    Penerbit</button>
                <!-- The Insert Modal -->
                <div class="modal fade" id="insertDataPenerbit">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title ">Tambah Data Penerbit</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body px-4">
                                <form action="/insertPenerbit" method="POST" enctype="multipart/form-data"
                                    class="forms-sample">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_penerbit">Penerbit</label>
                                        <input type="text" name="nama_penerbit" class="form-control" id="nama_penerbit"
                                            placeholder="Nama Penerbit" required value="{{ old('nama_penerbit') }}"
                                            autocomplete="nama_penerbit"
                                            class="@error('nama_penerbit') is-invalid @enderror">
                                        @error('nama_penerbit')
                                            <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" id="alamat"
                                            placeholder="Alamat" required value="{{ old('alamat') }}" autocomplete="alamat"
                                            class="@error('alamat') is-invalid @enderror">
                                        @error('alamat')
                                            <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kota">Kota</label>
                                        <input type="text" name="kota" class="form-control" id="kota"
                                            placeholder="Nama Kota" required value="{{ old('kota') }}" autocomplete="kota"
                                            class="@error('kota') is-invalid @enderror">
                                        @error('kota')
                                            <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
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

                    <a href="/exportpdf_penerbit"><button type="button" class="btn btn-sm btn-info btn-icon-text me-1"> <i
                                class="mdi mdi-printer btn-icon-append"></i> Cetak PDF </button></a>
                    <a href="/exportexcel_penerbit"> <button type="button"
                            class="btn btn-sm btn-success btn-icon-text me-1"> <i
                                class="mdi mdi-printer btn-icon-append"></i> Cetak Excel </button></a>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#import_jenisbuku"
                        class="btn btn-sm btn-danger btn-icon-text"><i class="mdi mdi-upload btn-icon-prepend"></i>Import
                        Data</button>
                    <!-- The Import Excel Modal -->
                    <div class="modal fade" id="import_jenisbuku">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title ">Import Data Penerbit</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="card m-3 text-center">
                                    <div class="card-body m-3">
                                        <h5 class="card-title text-center">Download Template Excel</h5>
                                        <h6 class="card-subtitle mb-2 text-muted text-center">Untuk Import Data</h6>
                                        <a href="assets/template_import/importpenerbit_template.xlsx"><button type="button"
                                                class="btn btn-primary text-center">Download</button></a>
                                    </div>
                                </div>
                                <form action="/importexcel_penerbit" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="modal-body px-4">
                                        <h5>Pilih File yang Akan Diimport</h5>
                                        <div class="form-group">
                                            <input class="" type="file" name="file" id="" required>
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
                    <h4 class="card-title">Data Penerbit</h4>
                    <div class="table-responsive">
                        <table class="table " id="myTable">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Kode </th>
                                    <th> Penerbit </th>
                                    <th> Alamat </th>
                                    <th> Kota </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penerbits as $index => $penerbit)
                                    <tr>
                                        <td scope="penerbit"> {{ $index + $penerbits->firstItem() }} </td>
                                        <td>{{ $penerbit->id }}</td>
                                        <td>{{ $penerbit->nama_penerbit }}</td>
                                        <td>{{ $penerbit->alamat }}</td>
                                        <td>{{ $penerbit->kota }}</td>
                                        <td>
                                            <button type="button" class="btn btn-inverse-info btn-icon"
                                                data-bs-toggle="modal" data-bs-target="#view{{ $penerbit->id }}">
                                                <i class="mdi mdi-information-outline"></i>
                                            </button>

                                            <button type="button" class="btn btn-inverse-primary btn-icon"
                                                data-bs-toggle="modal" data-bs-target="#edit{{ $penerbit->id }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>

                                            <a href="#">
                                                <button class="btn btn-inverse-danger btn-icon delete "
                                                    data-id="{{ $penerbit->id }}"
                                                    data-penerbit="{{ $penerbit->nama_penerbit }}">
                                                    <i class="mdi mdi-delete "></i>
                                                </button></a>
                                        </td>
                                    </tr>
                                    <!-- The Detail Modal -->
                                    <div class="modal fade" id="view{{ $penerbit->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title ">Detail Penerbit</h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body px-4">

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <h6>Penerbit</h6>
                                                            <p>{{ $penerbit->nama_penerbit }}</p>
                                                            <h6>Alamat</h6>
                                                            <p>{{ $penerbit->alamat }}</p>
                                                            <h6>Kota</h6>
                                                            <p>{{ $penerbit->kota }}</p>
                                                            <h6>Diinput Pada</h6>
                                                            <p>{{ $penerbit->getCreatedAttribute() }}</p>
                                                            <h6>Diperbarui Pada</h6>
                                                            <p>{{ $penerbit->getUpdatedAttribute() }}</p>
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
                                    <div class="modal fade" id="edit{{ $penerbit->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title ">Edit Data Penerbit</h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body px-4">

                                                    <form action="/updatePenerbit/{{ $penerbit->id }}" method="POST"
                                                        enctype="multipart/form-data" class="forms-sample">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="nama_penerbit">Penerbit</label>
                                                            <input value="{{ $penerbit->nama_penerbit }}" type="text"
                                                                name="nama_penerbit" class="form-control"
                                                                id="nama_penerbit" placeholder="Nama Penerbit" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamat">Alamat</label>
                                                            <input value="{{ $penerbit->alamat }}" type="text"
                                                                name="alamat" class="form-control" id="alamat"
                                                                placeholder="Alamat" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kota">Kota</label>
                                                            <input value="{{ $penerbit->kota }}" type="text"
                                                                name="kota" class="form-control" id="kota"
                                                                placeholder="Kota" required>
                                                        </div>
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


    <script>
        $('.delete').click(function() {
            var idpenerbit = $(this).attr('data-id');
            var nama_penerbit = $(this).attr('data-penerbit');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Hapus Penerbit  " + nama_penerbit + " ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/deletePenerbit/" + idpenerbit + ""
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
