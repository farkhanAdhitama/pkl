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
                    'Data Pengguna Ditambahkan!',
                    'success'
                )
            </script>
        @endif
        {{-- swall berhasil update --}}
        @if ($message = Session::get('updatesuccess'))
            {{-- Notif buku berhasil ditambah --}}
            <script>
                Swal.fire(
                    'Berhasil!',
                    'Data Pengguna Diperbarui!',
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
                                <h4 class="modal-title ">Tambah Pengguna</h4>
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
                                        <input type="hidden" value="1234" name="password" class="form-control"
                                            id="password" placeholder="Password" required value="{{ old('password') }}"
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
                                        <label for="level">Level<span class="text-danger">*</span>
                                        </label>
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
                                            <td><img src="../assets/images/foto_profil/{{ $user->foto_profil }}"
                                                    alt="Profile"> {{ $user->name ?? 'N/A' }}</td>
                                            <td>{{ $user->username ?? 'N/A' }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->level }}</td>
                                            <td>
                                                <button type="button" class="btn btn-inverse-primary btn-icon"
                                                    data-bs-toggle="modal" data-bs-target="#edit{{ $user->id }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <a href="#">
                                                    <button <?php  if ($user->level == 'Operator'){
                                                        ?>
                                                        class="btn btn-inverse-danger btn-icon delete disabled"
                                                        <?php
                                                            };
                                                        ?> class="btn btn-inverse-danger btn-icon delete "
                                                        data-id="{{ $user->id }}" data-user="{{ $user->name }}">
                                                        <i class="mdi mdi-delete "></i>
                                                    </button></a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="edit{{ $user->id }}">
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

                                                        <form action="/updateUser/{{ $user->id }}" method="POST"
                                                            enctype="multipart/form-data" class="forms-sample">
                                                            @csrf

                                                            <div class="form-group">
                                                                <label for="name">Nama<span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" name="name" class="form-control"
                                                                    id="name" placeholder="Nama" required
                                                                    value="{{ $user->name }}" autocomplete="name"
                                                                    class="@error('name') is-invalid @enderror">
                                                                @error('name')
                                                                    <sub class="p fst-italic text-danger invalid-feedback"
                                                                        role="alert">{{ "$message" }}</sub>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="username">Username<span
                                                                        class="text-danger">*</span> </label>
                                                                <input type="text" name="username"
                                                                    class="form-control" id="username"
                                                                    placeholder="Username" required
                                                                    value="{{ $user->username }}" autocomplete="username"
                                                                    class="@error('username') is-invalid @enderror">
                                                                @error('username')
                                                                    <sub class="p fst-italic text-danger invalid-feedback"
                                                                        role="alert">{{ "$message" }}</sub>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">Email<span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <input type="email" name="email" class="form-control"
                                                                    id="email" placeholder="Email" required
                                                                    value="{{ $user->email }}" autocomplete="email"
                                                                    class="@error('email') is-invalid @enderror">
                                                                @error('email')
                                                                    <sub class="p fst-italic text-danger invalid-feedback"
                                                                        role="alert">{{ "$message" }}</sub>
                                                                @enderror
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <label for="password">Password<span
                                                                        class="text-danger">*</span> </label>
                                                                <input type="password" name="password"
                                                                    class="form-control" id="password"
                                                                    placeholder="Password" required
                                                                    value="{{ $user->password }}" autocomplete="password"
                                                                    class="@error('password') is-invalid @enderror">
                                                                @error('password')
                                                                    <sub class="p fst-italic text-danger invalid-feedback"
                                                                        role="alert">{{ "$message" }}</sub>
                                                                @enderror
                                                            </div> --}}

                                                            <div class="form-group">
                                                                <label for="level">Level</label>
                                                                <select class="form-control selectpicker"
                                                                    data-live-search="true" name="level"
                                                                    id="level">
                                                                    <option value="Operator">Operator</option>
                                                                    <option value="Administrator">Administrator</option>
                                                                </select>
                                                                @error('level')
                                                                    <sub class="p fst-italic text-danger invalid-feedback"
                                                                        role="alert">
                                                                        {{ "$message" }}</sub>
                                                                @enderror
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
    </div>
    <script>
        $('.delete').click(function() {
            var iduser = $(this).attr('data-id');
            var nama = $(this).attr('data-user');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Hapus Pengguna dengan Nama " + nama + " ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/deleteUser/" + iduser + ""
                    Swal.fire(
                        'Dihapus!',
                        'Pengguna Berhasil Dihapus',
                        'success'
                    )
                }
            })
        })
    </script>
@endsection
