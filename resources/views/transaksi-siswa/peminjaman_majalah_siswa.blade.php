@extends('layouts.blank')

@section('content')
    {{-- Notif  Pengembalian Majalah berhasil --}}
    @if ($message = Session::get('success_kembalikan_majalah'))
        <script>
            Swal.fire(
                'Berhasil!',
                'Majalah Berhasil Dikembalikan!',
                'success'
            )
        </script>
    @endif
    {{-- Notif  Perpanjangan Majalah berhasil --}}
    @if ($message = Session::get('success_perpanjang_majalah'))
        <script>
            Swal.fire(
                'Berhasil!',
                'Masa Peminjaman Diperpanjang 1 Minggu!',
                'success'
            )
        </script>
    @endif
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-arrow-up-bold-circle"></i>
            </span> Peminjaman Majalah Siswa
        </h3>
        <div class="dropdown">
            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Jenis Peminjaman
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/peminjaman_buku">Buku</a></li>
                <li><a class="dropdown-item" href="/peminjaman_majalah">Majalah</a></li>
                <li><a class="dropdown-item" href="/peminjaman_cd">CD</a></li>
            </ul>
        </div>

        {{-- swall berhasil insert --}}
        @if ($message = Session::get('insertsuccess'))
            {{-- Notif majalah berhasil ditambah --}}
            <script>
                Swal.fire(
                    'Berhasil!',
                    'Data Peminjaman Ditambahkan!',
                    'success'
                )
            </script>
        @endif
        {{-- swal gagal insert --}}
        @if ($message = Session::get('insertgagal'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Peminjaman Siswa Melebihi Batas Pinjam {{ $batas_pinjam->batas_siswa ?? 'Belum Diset' }}',
                })
            </script>
        @endif
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="float">
                <button type="button" data-bs-toggle="modal" data-bs-target="#insertPinjamMajalah"
                    class="btn btn-sm btn-primary mb-3"><i class="mdi mdi-library-plus mdi-icon"></i>Tambah Peminjaman
                    Majalah</button>
                <!-- The Insert Modal -->
                <div class="modal fade" id="insertPinjamMajalah">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title ">Tambah Peminjaman Majalah</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body px-4">
                                <form action="tambah_peminjaman_majalah" method="POST" enctype="multipart/form-data"
                                    class="forms-sample">
                                    @csrf
                                    <input type="hidden" value="majalah" name="jenis" class="form-control"
                                        id="jenis">
                                    <input type="hidden" name="petugas" id="petugas" value="{{ auth()->user()->name }}">

                                    <div class="form-group">
                                        <label for="anggota_id">Peminjam</label>
                                        <select class="form-control" class="selectpicker" data-live-search="true " required
                                            name="anggota_id" id="anggota_id">
                                            <option value="">--Nama Peminjam--</option>
                                            @foreach ($anggotas as $anggota)
                                                <option value="{{ $anggota->id }}">{{ $anggota->nama }}
                                                    {{ $anggota->kelas }} {{ $anggota->jurusan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="majalah_id">Judul Majalah</label>
                                        <select class="form-control selectpicker" data-live-search="true" name="majalah_id"
                                            required id="majalah_id">
                                            <option value="">--Judul Majalah--</option>
                                            @foreach ($majalahs as $majalah)
                                                <option value="{{ $majalah->id }}">{{ $majalah->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="lama">Lama Pinjam</label>

                                        <select class="form-control selectpicker" data-live-search="true" name="lama"
                                            id="lama">
                                            <option value="7">1 Minggu</option>
                                            <option value="30">1 Bulan</option>
                                            <option value="180">1 Semester</option>
                                            <option value="365">1 Tahun</option>
                                        </select>
                                        @error('lama')
                                            <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
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
                    <a href="/exportpdf_peminjaman_majalah"><button type="button"
                            class="btn btn-sm btn-info btn-icon-text me-1">
                            <i class="mdi mdi-printer btn-icon-append"></i> Cetak PDF </button></a>
                    <a href="/exportexcel_peminjaman_majalah"> <button type="button"
                            class="btn btn-sm btn-success btn-icon-text me-1"> <i
                                class="mdi mdi-printer btn-icon-append"></i> Cetak Excel </button></a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Peminjaman Majalah</h4>
                        <div class="table-responsive">
                            <table class="table " id="myTable">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Nama </th>
                                        <th> Siswa </th>
                                        <th> Nama Majalah </th>
                                        <th> Tanggal Pinjam</th>
                                        <th> Batas Kembali</th>
                                        <th> Lama </th>
                                        <th> Petugas </th>
                                        <th> Status </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $index => $pinjam)
                                        @if ($pinjam->getSelisih($pinjam->lama) < 0 && $pinjam->status_email == 0)
                                            {{ $pinjam->sendEmail(
                                                $pinjam->anggota->email,
                                                $pinjam->id,
                                                $pinjam->anggota->nama,
                                                $pinjam->majalah->nama,
                                                $pinjam->getTenggatWaktu($pinjam->lama),
                                            ) }}
                                        @endif
                                        <tr @if ($pinjam->getSelisih($pinjam->lama) < 0) class="table-danger" @endif>
                                            <td scope="pinjam">{{ $index + $peminjaman->firstItem() }}</td>
                                            <td>{{ $pinjam->anggota->nama ?? 'N/A' }}</td>
                                            <td>{{ $pinjam->anggota->kelas ?? 'N/A' }}
                                                {{ $pinjam->anggota->jurusan ?? 'N/A' }}</td>
                                            <td>{{ $pinjam->majalah->nama ?? 'N/A' }}</td>
                                            <td>{{ $pinjam->getCreatedAttribute() }}</td>
                                            <td>{{ $pinjam->getTenggatWaktu($pinjam->lama) }}</td>
                                            <td>{{ $pinjam->lama }} Hari</td>
                                            <td>{{ $pinjam->petugas }}</td>
                                            <td><label class="badge badge-gradient-warning">{{ $pinjam->status }}</label>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-inverse-danger btn-sm perpanjang "
                                                    @if ($pinjam->getSelisih($pinjam->lama) < 0) disabled @endif
                                                    data-bs-toggle="modal " data-id="{{ $pinjam->id }}"
                                                    data-majalah="{{ $pinjam->majalah->nama ?? 'N/A' }}"
                                                    data-anggota="{{ $pinjam->anggota->nama ?? 'N/A' }}">
                                                    Perpanjang
                                                </button>
                                                <a href="#">
                                                    <button class="btn btn-sm btn-inverse-primary kembalikan"
                                                        majalah-id="{{ $pinjam->majalah->id ?? 'N/A' }}"
                                                        data-id="{{ $pinjam->id }}"
                                                        data-majalah="{{ $pinjam->majalah->nama ?? 'N/A' }}"
                                                        data-anggota="{{ $pinjam->anggota->nama ?? 'N/A' }}">
                                                        Kembalikan
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                Keterangan :
                                <p><i class="mdi mdi-checkbox-blank text-danger"></i> Masa Pinjam Telah Melewati Batas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- perpanjang swal --}}
    <script>
        $('.perpanjang').click(function() {
            var idpinjam = $(this).attr('data-id');
            var datamajalah = $(this).attr('data-majalah');
            var dataanggota = $(this).attr('data-anggota');
            Swal.fire({
                title: 'Perpanjang Peminjaman?',
                text: "Majalah " + datamajalah + " Selama 1 Minggu",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/perpanjang_majalah/" + idpinjam + ""
                }
            })
        })
    </script>

    {{-- kembalkan swal --}}
    <script>
        $('.kembalikan').click(function() {
            var idpinjam = $(this).attr('data-id');
            var idmajalah = $(this).attr('majalah-id');
            var datamajalah = $(this).attr('data-majalah');
            var dataanggota = $(this).attr('data-anggota');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Kembalikan Majalah " + datamajalah + " Atas Nama " + dataanggota + "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/kembalikan_majalah/" + idpinjam + "/" + idmajalah + ""
                }
            })
        })
    </script>
@endsection
