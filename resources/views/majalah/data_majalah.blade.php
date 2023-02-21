@extends('layouts.blank')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-book-open "></i>
            </span> Koleksi Majalah
        </h3>
    </div>

    @if ($message = Session::get('insertsuccess'))
        {{-- Notif buku berhasil ditambah --}}
        <script>
            Swal.fire(
                'Berhasil!',
                'Data Majalah Berhasil Ditambahkan!',
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
                'Data Majalah Berhasil Ditambahkan!',
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
                'Data Majalah Berhasil Diperbarui!',
                'success'
            )
        </script>
    @endif

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="float">

                <a href="/tambahMajalah" type="button" class="btn btn-sm btn-primary mb-3"><i
                        class="mdi mdi-library-plus mdi-icon"></i> Tambah Data Majalah</a>

                <div class="float-end mb-3">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#cetaktgl"
                        class="btn btn-sm btn-primary btn-icon-text me-1"><i
                            class="mdi mdi-printer
                                btn-icon-append"></i>Cetak
                        PDF</button>
                    {{-- <a href="exportpdf_majalah"><button type="button" class="btn btn-sm btn-info btn-icon-text me-1"> <i
                                class="mdi mdi-printer btn-icon-append"></i> Cetak PDF </button></a> --}}
                    <a href="exportexcel_majalah"> <button type="button" class="btn btn-sm btn-success btn-icon-text me-1">
                            <i class="mdi mdi-printer btn-icon-append"></i> Cetak Excel </button></a>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#import_majalah"
                        class="btn btn-sm btn-danger btn-icon-text"><i class="mdi mdi-upload btn-icon-prepend"></i>Import
                        Data</button>

                    <!-- The Cetak PDF pertanggal Modal -->
                    <div class="modal fade" id="cetaktgl">
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
                                    <button id="exportPDF" type="button" class="exportPDF btn btn-primary w-100 mb-2">Cetak
                                        PDF</button>
                                    <h6 class="mt-2">Keterangan :</h6>
                                    <ul>
                                        <li class="small">Jangkauan Tanggal Menurut Tanggal Majalah Masuk</li>
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
                    <div class="modal fade" id="import_majalah">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title ">Import Majalah</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->

                                <div class="card m-3 text-center">
                                    <div class="card-body m-3">
                                        <h5 class="card-title text-center">Download Template Excel</h5>
                                        <h6 class="card-subtitle mb-2 text-muted text-center">Untuk Import Data</h6>
                                        <a href="assets/template_import/importmajalah_template.xlsx"><button type="button"
                                                class="btn btn-primary text-center">Download</button></a>
                                    </div>
                                </div>
                                <form action="/importexcel_majalah" method="POST" enctype="multipart/form-data">
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

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Majalah</h4>
                    <div class="table-responsive">
                        <table class="table " id="myTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th> Nama </th>
                                    <th> Tanggal Terbit </th>
                                    <th> Nomor/Volume/Tahun </th>
                                    <th> ISSN </th>
                                    <th> Jumlah </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($majalahs as $index => $majalah)
                                    <tr>
                                        <td scope="buku">{{ $index + $majalahs->firstItem() }}</td>
                                        <td>{{ $majalah->nama }}</td>
                                        <td>{{ $majalah->getTanggalTerbit() }}</td>
                                        <td>{{ $majalah->nomor }}/{{ $majalah->volume }}/{{ $majalah->tahun }} </td>
                                        <td>{{ $majalah->issn }}</td>
                                        <td>{{ $majalah->jumlah }}</td>
                                        <td>
                                            <button type="button" class="btn btn-inverse-info btn-icon"
                                                data-bs-toggle="modal" data-bs-target="#view{{ $majalah->id }}">
                                                <i class="mdi mdi-information-outline"></i>
                                            </button>

                                            <button type="button" class="btn btn-inverse-primary btn-icon"
                                                data-bs-toggle="modal" data-bs-target="#edit{{ $majalah->id }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>

                                            <a href="#">
                                                <button class="btn btn-inverse-danger btn-icon delete "
                                                    data-id="{{ $majalah->id }}" data-majalah="{{ $majalah->nama }}">
                                                    <i class="mdi mdi-delete "></i>
                                                </button></a>
                                        </td>
                                    </tr>
                                    <!-- The Detail Modal -->
                                    <div class="modal fade" id="view{{ $majalah->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title ">Detail Majalah</h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body px-4">

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <h6>Nama Majalah</h6>
                                                            <p>{{ $majalah->nama }}</p>
                                                            <h6>Tanggal Terbit</h6>
                                                            <p>{{ $majalah->tanggal_terbit }}</p>
                                                            <h6>Nomor/Volume/Tahun</h6>
                                                            <p>{{ $majalah->nomor }}/{{ $majalah->volume }}/{{ $majalah->tahun }}
                                                            </p>
                                                            <h6>ISSN</h6>
                                                            <p>{{ $majalah->issn }}</p>
                                                            <h6>Topik Utama</h6>
                                                            <p>{{ $majalah->topik }}</p>
                                                            <h6>Jumlah</h6>
                                                            <p>{{ $majalah->jumlah }}</p>
                                                            <h6>Diinput Pada</h6>
                                                            <p>{{ $majalah->getCreatedAttribute() }}</p>

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
                                    <div class="modal fade" id="edit{{ $majalah->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title ">Edit Data Majalah</h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body px-4">

                                                    <form action="/updateMajalah/{{ $majalah->id }}" method="POST"
                                                        enctype="multipart/form-data" class="forms-sample">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="nama">Nama Majalah<span
                                                                    class="text-danger">*</span></label>
                                                            <input value="{{ $majalah->nama }}" type="text"
                                                                name="nama" class="form-control" id="nama"
                                                                placeholder="Nama Majalah" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tanggal_terbit">Tanggal Terbit<span
                                                                    class="text-danger">*</span></label>
                                                            <input value="{{ $majalah->tanggal_terbit }}" type="date"
                                                                name="tanggal_terbit" class="form-control"
                                                                id="tanggal_terbit" placeholder="DD/MM/YYYY" required>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <label for="nomor">Nomor<span
                                                                                class="text-danger">*</span></label>
                                                                        <input value="{{ $majalah->nomor }}"
                                                                            type="text" name="nomor"
                                                                            class="form-control" id="nomor"
                                                                            placeholder="Nomor" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <label for="volume">Volume<span
                                                                                class="text-danger">*</span></label>
                                                                        <input value="{{ $majalah->volume }}"
                                                                            type="text" name="volume"
                                                                            class="form-control" id="volume"
                                                                            placeholder="Volume" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-12">
                                                                        <label for="tahun">Tahun<span
                                                                                class="text-danger">*</span></label>
                                                                        <input value="{{ $majalah->tahun }}"
                                                                            type="text" name="tahun"
                                                                            class="form-control" id="tahun"
                                                                            placeholder="Tahun" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="issn">ISSN<span
                                                                    class="text-danger">*</span></label>
                                                            <input value="{{ $majalah->issn }}" type="number"
                                                                name="issn" class="form-control" id="issn"
                                                                placeholder="ISSN" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="topik">Topik Utama</label>
                                                            <input value="{{ $majalah->topik }}" type="text"
                                                                name="topik" class="form-control" id="topik"
                                                                placeholder="Topik">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jumlah">Jumlah Eksemplar<span
                                                                    class="text-danger">*</span></label>
                                                            <input value="{{ $majalah->jumlah }}" type="text"
                                                                name="jumlah" class="form-control" id="jumlah"
                                                                placeholder="Jumlah Eksemplar" required>
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary me-2 ">Submit</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </form>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <div class="mb-3">
                                                        <span class="text-danger">*</span><span>= Wajib Diisi</span>
                                                    </div>
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


    <!-- page-body-wrapper ends -->
    <script>
        $('.delete').click(function() {
            var id_majalah = $(this).attr('data-id');
            var nama = $(this).attr('data-majalah');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Hapus Majalah  " + nama + " ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/deleteMajalah/" + id_majalah + ""
                    Swal.fire(
                        'Dihapus!',
                        'Data Berhasil Dihapus',
                        'success'
                    )
                }
            })
        })
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

            window.location.href = '/exportpdf_majalah/' + tgl_awal + '/' + tgl_akhir
        })
    </script>
@endsection
