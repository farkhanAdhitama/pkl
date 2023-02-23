@extends('layouts.blank')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-arrow-up-bold-circle"></i>
            </span> Peminjaman Buku Guru
        </h3>
        <div class="dropdown">
            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Jenis Peminjaman
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/guru_pinjam">Buku</a></li>
                <li><a class="dropdown-item" href="/majalah_guru_pinjam">Majalah</a></li>
                <li><a class="dropdown-item" href="/cd_guru_pinjam">CD</a></li>
            </ul>
        </div>

        {{-- swall berhasil insert --}}
        @if ($message = Session::get('insertsuccess'))
            {{-- Notif buku berhasil ditambah --}}
            <script>
                Swal.fire(
                    'Berhasil!',
                    'Data Peminjaman Ditambahkan!',
                    'success'
                )
            </script>
        @endif
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="float">
                <button type="button" data-bs-toggle="modal" data-bs-target="#insertPinjamBuku"
                    class="btn btn-sm btn-primary mb-3"><i class="mdi mdi-library-plus mdi-icon"></i>Tambah Peminjaman
                    Buku</button>
                <!-- The Insert Modal -->
                <div class="modal fade" id="insertPinjamBuku">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title ">Tambah Peminjaman Buku</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body px-4">
                                <form action="tambah_peminjaman_buku_guru" method="POST" enctype="multipart/form-data"
                                    class="forms-sample">
                                    @csrf

                                    <div class="form-group">
                                        <label for="guru_id">Peminjam</label>
                                        <select class="form-control" class="selectpicker" data-live-search="true" required
                                            name="guru_id" id="guru_id">
                                            <option value="">--Nama Peminjam--</option>
                                            @foreach ($gurus as $guru)
                                                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="buku_id">Judul Buku</label>
                                        <select class="form-control selectpicker" data-live-search="true" name="buku_id"
                                            required id="buku_id">
                                            <option value="">--Judul Buku--</option>
                                            @foreach ($bukus as $buku)
                                                <option value="{{ $buku->id }}">{{ $buku->judul_buku }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="lama">Lama Pinjam</label>

                                        <select class="form-control selectpicker" data-live-search="true" name="lama"
                                            id="lama">
                                            <option value="7">1 Minggu</option>
                                            <option value="30">1 Bulan</option>
                                            <option value="365">1 Tahun</option>
                                        </select>
                                        @error('lama')
                                            <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                                        @enderror
                                    </div>
                                    <input type="hidden" value="buku" name="jenis" class="form-control" id="jenis">


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
                    <a href="/exportpdf_peminjaman_buku_guru"><button type="button"
                            class="btn btn-sm btn-info btn-icon-text me-1">
                            <i class="mdi mdi-printer btn-icon-append"></i> Cetak PDF </button></a>
                    <a href="/exportexcel_peminjaman_buku_guru"> <button type="button"
                            class="btn btn-sm btn-success btn-icon-text me-1"> <i
                                class="mdi mdi-printer btn-icon-append"></i>
                            Cetak Excel </button></a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Peminjaman Buku</h4>
                        <div class="table-responsive">
                            <table class="table " id="myTable">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Nama </th>
                                        <th> Judul </th>
                                        <th> Tanggal Pinjam</th>
                                        <th> Batas Kembali</th>
                                        <th> Lama </th>
                                        <th> Status </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $index => $pinjam)
                                        @if ($pinjam->getSelisih($pinjam->lama) < 0 && $pinjam->status_email == 0)
                                            {{ $pinjam->sendEmail(
                                                $pinjam->guru->email,
                                                $pinjam->id,
                                                $pinjam->guru->nama,
                                                $pinjam->buku->judul_buku,
                                                $pinjam->getTenggatWaktu($pinjam->lama),
                                            ) }}
                                        @endif
                                        <tr @if ($pinjam->getSelisih($pinjam->lama) < 0) class="table-danger" @endif>
                                            <td scope="pinjam">{{ $index + $peminjaman->firstItem() }}</td>
                                            <td>{{ $pinjam->guru->nama ?? 'N/A' }}</td>
                                            <td>{{ $pinjam->buku->judul_buku ?? 'N/A' }}</td>
                                            <td>{{ $pinjam->getCreatedAttribute() }}</td>
                                            <td>{{ $pinjam->getTenggatWaktu($pinjam->lama) }}</td>
                                            <td>{{ $pinjam->lama }} Hari</td>
                                            <td><label class="badge badge-gradient-warning">{{ $pinjam->status }}</label>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-inverse-danger btn-sm perpanjang "
                                                    data-bs-toggle="modal " data-id="{{ $pinjam->id }}"
                                                    @if ($pinjam->getSelisih($pinjam->lama) < 0) disabled @endif
                                                    data-buku="{{ $pinjam->buku->judul_buku }}"
                                                    data-guru="{{ $pinjam->guru->nama }}">
                                                    Perpanjang
                                                </button>
                                                <a href="#">
                                                    <button class="btn btn-sm btn-inverse-primary kembalikan"
                                                        buku-id="{{ $pinjam->buku->id }}" data-id="{{ $pinjam->id }}"
                                                        data-buku="{{ $pinjam->buku->judul_buku }}"
                                                        data-guru="{{ $pinjam->guru->nama }}">
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
            var databuku = $(this).attr('data-buku');
            var dataanggota = $(this).attr('data-anggota');
            Swal.fire({
                title: 'Perpanjang Peminjaman?',
                text: "Buku " + databuku + " Selama 1 Minggu",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/perpanjang_buku/" + idpinjam + ""
                    Swal.fire(
                        'Berhasil!',
                        'Peminjaman Diperpanjang 1 Minggu',
                        'success'
                    )
                }
            })
        })
    </script>

    {{-- kembalkan swal --}}
    <script>
        $('.kembalikan').click(function() {
            var idpinjam = $(this).attr('data-id');
            var idbuku = $(this).attr('buku-id');
            var databuku = $(this).attr('data-buku');
            var dataguru = $(this).attr('data-guru');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Kembalikan Buku " + databuku + " Atas Nama " + dataguru + "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/kembalikan_buku_guru/" + idpinjam + "/" + idbuku + ""
                    Swal.fire(
                        'Berhasil!',
                        'Buku Berhasil Dikembalikan',
                        'success'
                    )
                }
            })
        })
    </script>
@endsection
