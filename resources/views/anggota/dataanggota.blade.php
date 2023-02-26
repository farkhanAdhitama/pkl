@extends('layouts.blank')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-book-open "></i>
            </span> Data Anggota Siswa
        </h3>

    </div>
    @if ($message = Session::get('insertsuccess'))
        {{-- Notif buku berhasil ditambah --}}
        <script>
            Swal.fire(
                'Berhasil!',
                'Data Anggota Berhasil Ditambahkan!',
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
                'Data Anggota Berhasil Ditambahkan!',
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
                'Data Anggota Berhasil Diperbarui!',
                'success'
            )
        </script>
    @endif

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="float">

                <a href="/tambahanggota" type="button" class="btn btn-sm btn-primary mb-3"><i
                        class="mdi mdi-library-plus mdi-icon"></i> Tambah Anggota Siswa</a>

                <div class="float-end mb-3">

                    <a href="/exportpdf_anggota"><button type="button" class="btn btn-sm btn-info btn-icon-text me-1"> <i
                                class="mdi mdi-printer btn-icon-append"></i> Cetak PDF </button></a>
                    <a href="/exportexcel_anggota"> <button type="button"
                            class="btn btn-sm btn-success btn-icon-text me-1"> <i
                                class="mdi mdi-printer btn-icon-append"></i> Cetak Excel </button></a>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#importanggota"
                        class="btn btn-sm btn-info btn-icon-text me-1"><i class="mdi mdi-upload btn-icon-prepend"></i>Import
                        Data</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#hapus_data"
                        class="btn btn-sm btn-danger btn-icon-text"><i
                            class="mdi mdi-delete
                                btn-icon-append"></i>Hapus Data</button>

                    <!-- The Import Anggota Excel Modal -->
                    <div class="modal fade" id="importanggota">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title ">Import Data Anggota Siswa</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->

                                <div class="card m-3 text-center">
                                    <div class="card-body m-3">
                                        <h5 class="card-title text-center">Download Template Excel</h5>
                                        <h6 class="card-subtitle mb-2 text-muted text-center">Untuk Import Data</h6>
                                        <a href="assets/template_import/importanggota_template.xlsx"><button type="button"
                                                class="btn btn-primary text-center">Download</button></a>
                                    </div>
                                </div>
                                <form action="/importexcel_anggota" method="POST" enctype="multipart/form-data">
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
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- The Hapus Modal -->
                    <div class="modal fade" id="hapus_data">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title ">Hapus Data</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body px-4">
                                    <button id="hapus_nonaktif" type="button"
                                        class="hapus_nonaktif btn btn-danger w-100 mb-2">Hapus Non Aktif</button>
                                    <button id="hapus_semua" type="button"
                                        class="hapus_semua btn btn-danger w-100 mb-2">Hapus Semua</button>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Anggota Siswa</h4>
                    <div class="table-responsive">
                        <table class="table " id="myTable">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Nama </th>
                                    <th> NIS </th>
                                    {{-- <th> Email </th> --}}
                                    <th> Angkatan </th>
                                    <th> Kelas </th>
                                    <th> Berlaku Sampai </th>
                                    <th> Status </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($anggotas as $anggota)
                                    <tr>
                                        <td> {{ $i }}</td>
                                        @php
                                            $i++;
                                        @endphp
                                        <td>
                                            <?php
                    if (empty($anggota->foto_anggota)){?>
                                            <img src="assets/images/foto_anggota/person.png" class="me-2"
                                                alt="image">{{ $anggota->nama }}
                                            <?php
                    }else{
                  ?>
                                            <img src="assets/images/foto_anggota/{{ $anggota->foto_anggota }}"
                                                class="me-2" alt="image">{{ $anggota->nama }}
                                            <?php }?>
                                        </td>
                                        <td>{{ $anggota->nis }}</td>
                                        {{-- <td>{{ $anggota->email }}</td> --}}
                                        <td>{{ $anggota->angkatan }}</td>
                                        <td>{{ $anggota->kelas }} {{ $anggota->jurusan }}</td>
                                        <td>{{ $anggota->getMasaBerlaku() }}</td>

                                        @if ($anggota->status == 'Aktif')
                                            <td>
                                                <a href="ubahStatusNonAktif/{{ $anggota->id }}"> <label
                                                        style="cursor: pointer;"
                                                        class="badge badge-gradient-primary">{{ $anggota->status }}</label></a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="ubahStatusAktif/{{ $anggota->id }}"> <label
                                                        style="cursor: pointer;"
                                                        class="badge badge-gradient-danger">{{ $anggota->status }}</label></a>
                                            </td>
                                        @endif

                                        <td>
                                            <button type="button" class="btn btn-inverse-info btn-icon"
                                                data-bs-toggle="modal" data-bs-target="#view{{ $anggota->id }}">
                                                <i class="mdi mdi-information-outline"></i>
                                            </button>

                                            <button type="button" class="btn btn-inverse-primary btn-icon"
                                                data-bs-toggle="modal" data-bs-target="#edit{{ $anggota->id }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>

                                            <a href="#">
                                                <button class="btn btn-inverse-danger btn-icon delete "
                                                    data-id="{{ $anggota->id }}" data-anggota="{{ $anggota->nama }}">
                                                    <i class="mdi mdi-delete "></i>
                                                </button></a>
                                        </td>
                                    </tr>
                                    <!-- The Detail Modal -->
                                    <div class="modal fade" id="view{{ $anggota->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title ">Detail Anggota</h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body px-4">

                                                    <div class="row">
                                                        <div class="col-sm-6 ">
                                                            <h3>{{ $anggota->nama }}</h3>
                                                            <?php
                            if (empty($anggota->foto_anggota)){?>
                                                            <img width="200px"
                                                                src="assets/images/foto_anggota/person.png" class="me-2"
                                                                alt="image">
                                                            <?php
                            }else{
                          ?>
                                                            <img width="200px"
                                                                src="assets/images/foto_anggota/{{ $anggota->foto_anggota }}"
                                                                class="me-2" alt="image">
                                                            <?php 
                        }?>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6>NIS</h6>
                                                            <p>{{ $anggota->nis }}</p>
                                                            <h6>Email</h6>
                                                            <p>{{ $anggota->email }}</p>
                                                            <h6>Angkatan</h6>
                                                            <p>{{ $anggota->angkatan }}</p>
                                                            <h6>Kelas</h6>
                                                            <p>{{ $anggota->kelas }} {{ $anggota->jurusan }}</p>
                                                            <h6>Berlaku Sampai</h6>
                                                            <p>{{ $anggota->getMasaBerlaku() }}</p>
                                                            <h6>Status</h6>
                                                            <p>{{ $anggota->status }}</p>
                                                            <h6>Diinput Pada</h6>
                                                            <p>{{ $anggota->getCreatedAttribute() }}</p>
                                                            <h6>Diperbarui Pada</h6>
                                                            <p>{{ $anggota->getUpdatedAttribute() }}</p>

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
                                    <div class="modal fade" id="edit{{ $anggota->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title ">Edit Data Anggota</h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body px-4">

                                                    <form action="/updateanggota/{{ $anggota->id }}" method="POST"
                                                        enctype="multipart/form-data" class="forms-sample">
                                                        @csrf


                                                        <div class="form-group">
                                                            <label for="nama">Nama</label>
                                                            <input value="{{ $anggota->nama }}" type="text"
                                                                name="nama" class="form-control" id="nama"
                                                                placeholder="Nama" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nis">NIS</label>
                                                            <input value="{{ $anggota->nis }}" type="number"
                                                                name="nis" class="form-control" id="nis"
                                                                placeholder="NIS/NIP" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input value="{{ $anggota->email }}" type="email"
                                                                name="email" class="form-control" id="email"
                                                                placeholder="Email" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="angkatan">Angkatan</label>
                                                            <input value="{{ $anggota->angkatan }}" type="text"
                                                                name="angkatan" class="form-control" id="angkatan"
                                                                placeholder="Angkatan" required>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label for="kelas">Kelas</label>
                                                                <select class="form-control" name="kelas"
                                                                    id="kelas" required>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="jurusan">Jurusan</label>
                                                                <select class="form-control" name="jurusan"
                                                                    id="jurusan" required>
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
                                                        <div class="form-group">
                                                            <label for="masa_berlaku">Berlaku Sampai</label>
                                                            <input value="{{ $anggota->masa_berlaku }}" type="date"
                                                                name="masa_berlaku" class="form-control"
                                                                id="masa_berlaku" placeholder="Berlaku Sampai" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Foto Anggota</label><br>
                                                            <img height="100px"
                                                                src="assets/images/foto_anggota/{{ $anggota->foto_anggota }}"
                                                                alt="">
                                                            <input type="file" name="foto_anggota"
                                                                class="form-control">
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
            var idanggota = $(this).attr('data-id');
            var nama = $(this).attr('data-anggota');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Hapus Anggota dengan Nama " + nama + " ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/deleteanggota/" + idanggota + ""
                    Swal.fire(
                        'Dihapus!',
                        'Data Berhasil Dihapus',
                        'success'
                    )
                }
            })
        })
        $('.hapus_semua').click(function() {
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Hapus Semua Anggota Siswa",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/deleteAnggotaAll/"
                    Swal.fire(
                        'Dihapus!',
                        'Data Berhasil Dihapus',
                        'success'
                    )
                }
            })
        })
        $('.hapus_nonaktif').click(function() {
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Hapus Anggota Siswa Non Aktif",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/deleteAnggotaNonAktif/"
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