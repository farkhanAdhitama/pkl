@extends('layouts.blank')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-arrow-up-bold-circle"></i>
            </span> Data Pengguna
        </h3>
        {{-- swall berhasil insert --}}
        @if ($message = Session::get('insertsuccess'))
            {{-- Notif buku berhasil ditambah --}}
            <script>
                Swal.fire(
                    'Berhasil!',
                    'Data Anggota Ditambahkan!',
                    'success'
                )
            </script>
        @endif
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="float">
                <button type="button" data-bs-toggle="modal" data-bs-target="#insertPengguna"
                    class="btn btn-sm btn-primary mb-3"><i class="mdi mdi-library-plus mdi-icon"></i>Tambah Anggota</button>
                <!-- The Insert Modal -->
                <div class="modal fade" id="insertPengguna">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title ">Tambah Anggota</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body px-4">
                                <form action="/insertPengguna" method="POST" enctype="multipart/form-data"
                                    class="forms-sample">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama<span class="text-danger">*</span> </label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Nama" required value="{{ old('name') }}" autocomplete="name"
                                            class="@error('name') is-invalid @enderror">
                                        @error('name')
                                            <sub class="p fst-italic text-danger invalid-feedback"
                                                role="alert">{{ "$message" }}</sub>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username<span class="text-danger">*</span> </label>
                                        <input type="text" name="username" class="form-control" id="username"
                                            placeholder="Username" required value="{{ old('username') }}"
                                            autocomplete="username" class="@error('username') is-invalid @enderror">
                                        @error('username')
                                            <sub class="p fst-italic text-danger invalid-feedback"
                                                role="alert">{{ "$message" }}</sub>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email<span class="text-danger">*</span> </label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Email" required value="{{ old('email') }}" autocomplete="email"
                                            class="@error('email') is-invalid @enderror">
                                        @error('email')
                                            <sub class="p fst-italic text-danger invalid-feedback"
                                                role="alert">{{ "$message" }}</sub>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password<span class="text-danger">*</span> </label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Password" required value="{{ old('password') }}"
                                            autocomplete="password" class="@error('password') is-invalid @enderror">
                                        @error('password')
                                            <sub class="p fst-italic text-danger invalid-feedback"
                                                role="alert">{{ "$message" }}</sub>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="password-confirm">Konfirmasi Password<span class="text-danger">*</span>
                                        </label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="password-confirm" placeholder="Konfirmasi Password" required
                                            value="{{ old('password-confirm') }}" autocomplete="password-confirm"
                                            class="@error('password-confirm') is-invalid @enderror">
                                        @error('password-confirm')
                                            <sub class="p fst-italic text-danger invalid-feedback"
                                                role="alert">{{ "$message" }}</sub>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="level">Level</label>
                                        <select class="form-control selectpicker" data-live-search="true" name="level"
                                            id="level">
                                            <option value="Operator">Operator</option>
                                            <option value="Administrator">Administrator</option>
                                        </select>
                                        @error('level')
                                            <sub class="p fst-italic text-danger invalid-feedback" role="alert">
                                                {{ "$message" }}</sub>
                                        @enderror
                                    </div>

                                    <button type="submit"class="btn btn-primary me-2">Submit</button>
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
                    <a href="#"><button type="button" class="btn btn-sm btn-info btn-icon-text me-1">
                            <i class="mdi mdi-printer btn-icon-append"></i> Cetak PDF </button></a>
                    <a href="#"> <button type="button" class="btn btn-sm btn-success btn-icon-text me-1"> <i
                                class="mdi mdi-printer btn-icon-append"></i>
                            Cetak Excel </button></a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Pengguna</h4>
                        <div class="table-responsive">
                            <table class="table " id="myTable">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Nama </th>
                                        <th> Username </th>
                                        <th> Email</th>
                                        <th> Level</th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td scope="user">{{ $index + $users->firstItem() }}</td>
                                            <td>{{ $user->name ?? 'N/A' }}</td>
                                            <td>{{ $user->username ?? 'N/A' }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->level }}</td>
                                            <td>
                                                <button type="button" class="btn btn-inverse-primary btn-icon"
                                                    data-bs-toggle="modal" data-bs-target="#">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>

                                                <a href="#">
                                                    <button class="btn btn-inverse-danger btn-icon delete "
                                                        data-id="{{ $user->id }}">
                                                        <i class="mdi mdi-delete "></i>
                                                    </button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
