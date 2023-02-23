@extends('layouts.blank')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-arrow-up-bold-circle"></i>
            </span> Riwayat Pengembalian Buku Guru
        </h3>

        <div class="mb-3 d-flex justify-content-end">
            <a href="/exportpdf_pengembalian_buku_guru"><button type="button" class="btn btn-sm btn-info btn-icon-text me-1">
                    <i class="mdi mdi-printer btn-icon-append"></i> Cetak PDF </button></a>
            <a href="/exportexcel_pengembalian_buku_guru"> <button type="button"
                    class="btn btn-sm btn-success btn-icon-text me-1"> <i class="mdi mdi-printer btn-icon-append"></i> Cetak
                    Excel </button></a>
            <div class="dropdown">
                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Jenis Pengembalian
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/guru_kembali">Buku</a></li>
                    <li><a class="dropdown-item" href="/majalah_guru_kembali">Majalah</a></li>
                    <li><a class="dropdown-item" href="/cd_guru_kembali">CD</a></li>
                </ul>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="float">

                <div class="float-end mb-3">
                </div>
                @if ($message = Session::get('deletesuccess'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Buku yang Dikembalikan</h4>
                        <div class="table-responsive">
                            <table class="table " id="myTable">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Nama </th>
                                        <th> Judul </th>
                                        <th> Tanggal Pinjam</th>
                                        <th> Tanggal Kembali</th>
                                        <th> Total </th>
                                        <th> Status </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $index => $pinjam)
                                        <tr>
                                            <td scope="pinjam">{{ $index + $peminjaman->firstItem() }}</td>
                                            <td>{{ $pinjam->guru->nama ?? 'N/A' }}</td>
                                            <td>{{ $pinjam->buku->judul_buku ?? 'N/A' }}</td>
                                            <td>{{ $pinjam->getCreatedAttribute() }}</td>
                                            <td>{{ $pinjam->getTanggalKembali() }}</td>
                                            <td>{{ $pinjam->lama_peminjaman() }} Hari</td>
                                            <td><label class="badge badge-gradient-info">{{ $pinjam->status }}</label></td>
                                            <td>
                                                <button class="btn btn-inverse-danger btn-icon delete"
                                                    data-id="{{ $pinjam->id }}"
                                                    data-buku="{{ $pinjam->buku->judul_buku }}"
                                                    data-guru="{{ $pinjam->guru->nama }}">
                                                    <i class="mdi mdi-delete "></i>


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


    {{-- script delete --}}
    <script>
        $('.delete').click(function() {
            var idtransaksi = $(this).attr('data-id');
            var guru = $(this).attr('data-guru');
            var buku = $(this).attr('data-buku');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Hapus Pengembalian  " + buku + " Oleh " + guru + "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/deletePengembalianBuku/" + idtransaksi + ""
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