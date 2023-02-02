@extends('layouts.blank')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-arrow-up-bold-circle"></i>
            </span> Peminjaman Buku
        </h3>

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
                <a href="/showTambahPeminjaman" type="button" class="btn btn-sm btn-primary mb-3"><i
                        class="mdi mdi-library-plus mdi-icon"></i> Tambah Transaksi Peminjaman</a>
                <div class="float-end mb-3">
                    <a href="/exportpdf_peminjaman"><button type="button" class="btn btn-sm btn-info btn-icon-text me-1">
                            <i class="mdi mdi-printer btn-icon-append"></i> Cetak PDF </button></a>
                    <a href="/exportexcel_peminjaman"> <button type="button"
                            class="btn btn-sm btn-success btn-icon-text me-1"> <i
                                class="mdi mdi-printer btn-icon-append"></i> Cetak Excel </button></a>
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
                                        <th> Kelas</th>
                                        <th> Judul </th>
                                        <th> Tanggal Pinjam</th>
                                        <th> Batas Kembali</th>
                                        <th> Lama </th>
                                        <th> Denda </th>
                                        <th> Status </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $index => $pinjam)
                                        <tr>
                                            <td scope="pinjam">{{ $index + $peminjaman->firstItem() }}</td>
                                            <td>{{ $pinjam->anggota->nama ?? 'N/A' }}</td>
                                            <td>{{ $pinjam->anggota->kelas ?? 'N/A' }}</td>
                                            <td>{{ $pinjam->buku->judul_buku ?? 'N/A' }}</td>
                                            <td>{{ $pinjam->getCreatedAttribute() }}</td>
                                            <td>{{ $pinjam->getTenggatWaktu($pinjam->lama) }}</td>
                                            <td>{{ $pinjam->lama }} Hari</td>
                                            <td>Rp {{ $pinjam->getDenda($pinjam->lama) }}</td>
                                            <td><label class="badge badge-gradient-warning">{{ $pinjam->status }}</label>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-inverse-danger btn-sm perpanjang "
                                                    data-bs-toggle="modal " data-id="{{ $pinjam->id }}"
                                                    data-buku="{{ $pinjam->buku->judul_buku }}"
                                                    data-anggota="{{ $pinjam->anggota->nama }}">
                                                    Perpanjang
                                                </button>
                                                <a href="#">
                                                    <button class="btn btn-sm btn-inverse-primary kembalikan"
                                                        data-id="{{ $pinjam->id }}"
                                                        data-buku="{{ $pinjam->buku->judul_buku }}"
                                                        data-anggota="{{ $pinjam->anggota->nama }}">
                                                        Kembalikan
                                                    </button>
                                                </a>


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
                    window.location = "/perpanjang/" + idpinjam + ""
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
            var databuku = $(this).attr('data-buku');
            var dataanggota = $(this).attr('data-anggota');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Kembalikan Buku " + databuku + " Atas Nama " + dataanggota + "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/kembalikan/" + idpinjam + ""
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
