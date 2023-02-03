@extends('layouts.blank')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/smankaLogo.png') }}" />


    {{-- swal berhasil import --}}
    @if ($message = Session::get('update_sukses'))
        {{-- Notif cd berhasil ditambah --}}
        <script>
            Swal.fire(
                'Berhasil!',
                'Data Berhasil Diperbarui!',
                'success'
            )
        </script>
    @endif
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-settings"></i>
            </span> Pengaturan
        </h3>

    </div>
    <div class="row">
        <div class="col-md grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <h4 class="card-title float-left mb-3">Profil User</h4>
                        <div id="visit-sale-chart-legend"
                            class="rounded-legend legend-horizontal legend-top-right float-right"></div><br>
                        <div class="text-center mb-5">
                            <img height="200px" width="200px" src="../assets/images/foto_profil/{{ $profil->foto_profil }}"
                                class="rounded mx-auto d-block rounded-circle mt-2" alt="">
                        </div>

                        <h6>Nama</h6>
                        <p>{{ $profil->name }}</p>
                        <h6>Username</h6>
                        <p>{{ $profil->username }}</p>
                        <h6>Email</h6>
                        <p>{{ $profil->email }}</p>
                        {{-- <h6>password</h6>
                        <p>{{ $profil->password }}</p> --}}

                    </div>
                    <div class="text-center">
                        <a href="#"> <button type="button" class="btn btn-gradient-primary btn-rounded btn-fw "
                                data-bs-toggle="modal" data-bs-target="#editProfil">Ubah Profil Pengguna</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Pengaturan Lain</h4>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfil">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title ">Edit Profil</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body px-4">

                    <form action="/updateAdmin/{{ $profil->id }}" method="POST" enctype="multipart/form-data"
                        class="forms-sample">
                        @csrf
                        <div class="form-group ">
                            <div class="text-center">
                                <img class="m-3 text-center rounded mx-auto d-block rounded-circle" height="150px"
                                    src="../assets/images/foto_profil/{{ $profil->foto_profil }}" alt="">
                            </div>
                            <h5 class="mt-3">Pilih Foto Profil Baru</h5>
                            <input type="file" name="foto_profil" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input required value="{{ $profil->name }}" type="text" name="name" class="form-control"
                                id="name" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input required value="{{ $profil->username }}" type="text" name="username"
                                class="form-control" id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input required value="{{ $profil->email }}" type="email" name="email" class="form-control"
                                id="email" placeholder="Email">
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

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc1.js') }}"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
