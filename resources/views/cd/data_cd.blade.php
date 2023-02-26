@extends('layouts.blank')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-book-open "></i>
            </span> Koleksi CD
        </h3>

    </div>

    @if ($message = Session::get('insertsuccess'))
        {{-- Notif cd berhasil ditambah --}}
        <script>
            Swal.fire(
                'Berhasil!',
                'Data CD Berhasil Ditambahkan!',
                'success'
            )
        </script>
    @endif

    {{-- swal berhasil import --}}
    @if ($message = Session::get('importsuccess'))
        {{-- Notif cd berhasil ditambah --}}
        <script>
            Swal.fire(
                'Berhasil!',
                'Data CD Berhasil Ditambahkan!',
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
                'Data CD Berhasil Diperbarui!',
                'success'
            )
        </script>
    @endif

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="float">
                <a href="/tambahCD" type="button" class="btn btn-sm btn-primary mb-3"><i
                        class="mdi mdi-library-plus mdi-icon"></i> Tambah Data CD</a>

                <div class="float-end mb-3">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#cetaktgl"
                        class="btn btn-sm btn-primary btn-icon-text me-1"><i
                            class="mdi mdi-printer
                                btn-icon-append"></i>Cetak
                        PDF</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#cetakExcel"
                        class="btn btn-sm btn-success btn-icon-text me-1"><i
                            class="mdi mdi-printer
                                btn-icon-append"></i>Cetak
                        Excel</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#import_CD"
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
                                    <h6 class="mt-2">Keterangan :<h6>
                                            <ul>
                                                <li class="small">Jangkauan Tanggal Menurut Tanggal CD Masuk</li>
                                                <li class="small">Kosongkan Tanggal Untuk Mencetak Semua</li>
                                            </ul>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">

                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- The Cetak Excel pertanggal Modal -->
                    <div class="modal fade" id="cetakExcel">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title ">Cetak Excel</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body px-4">
                                    <div class="form-group">
                                        <label for="tgl_awal_excel">Tanggal Awal</label>
                                        <input type="date" name="tgl_awal_excel" class="form-control" id="tgl_awal_excel"
                                            placeholder="Tanggal Awal" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_akhir_excel">Tanggal Akhir</label>
                                        <input type="date" name="tgl_akhir_excel" class="form-control"
                                            id="tgl_akhir_excel" placeholder="Tanggal Akhir" required>
                                    </div>
                                    <button id="exportExcel" type="button"
                                        class="exportExcel btn btn-primary w-100 mb-2">Cetak
                                        Excel</button>
                                    <h6 class="mt-2">Keterangan :</h6>
                                    <ul>
                                        <li class="small">Jangkauan Tanggal Menurut Tanggal CD Masuk</li>
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
                    <div class="modal fade" id="import_CD">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title ">Import CD</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->

                                <div class="card m-3 text-center">
                                    <div class="card-body m-3">
                                        <h5 class="card-title text-center">Download Template Excel</h5>
                                        <h6 class="card-subtitle mb-2 text-muted text-center">Untuk Import Data</h6>
                                        <a href="assets/template_import/importCD_template.xlsx"><button type="button"
                                                class="btn btn-primary text-center">Download</button></a>
                                    </div>
                                </div>
                                <form action="/importexcel_CD" method="POST" enctype="multipart/form-data">
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
                    <h4 class="card-title">Data CD</h4>
                    <div class="table-responsive">
                        <table class="table " id="myTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th> Kode Kelompok </th>
                                    <th> Judul </th>
                                    <th> Perolehan </th>
                                    <th> Jumlah </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cds as $index => $cd)
                                    <tr>
                                        <td scope="cd">{{ $index + $cds->firstItem() }}</td>
                                        <td>{{ $cd->kode_kelompok }}</td>
                                        <td>{{ $cd->judul_cd }}</td>
                                        <td>{{ $cd->perolehan }} </td>
                                        <td>{{ $cd->jumlah }}</td>
                                        <td>
                                            <button type="button" class="btn btn-inverse-info btn-icon"
                                                data-bs-toggle="modal" data-bs-target="#view{{ $cd->id }}">
                                                <i class="mdi mdi-information-outline"></i>
                                            </button>

                                            <button type="button" class="btn btn-inverse-primary btn-icon"
                                                data-bs-toggle="modal" data-bs-target="#edit{{ $cd->id }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>

                                            <a href="#">
                                                <button class="btn btn-inverse-danger btn-icon delete "
                                                    data-id="{{ $cd->id }}" data-cd="{{ $cd->judul_cd }}">
                                                    <i class="mdi mdi-delete "></i>
                                                </button></a>
                                        </td>
                                    </tr>
                                    <!-- The Detail Modal -->
                                    <div class="modal fade" id="view{{ $cd->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title ">Detail CD</h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body px-4">

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <h6>Kode Kelompok</h6>
                                                            <p>{{ $cd->kode_kelompok }}</p>
                                                            <h6>Judul</h6>
                                                            <p>{{ $cd->judul_cd }}</p>
                                                            <h6>Perolehan</h6>
                                                            <p>{{ $cd->perolehan }}</p>
                                                            <h6>Jumlah</h6>
                                                            <p>{{ $cd->jumlah }}</p>
                                                            <h6>Diinput Pada</h6>
                                                            <p>{{ $cd->getCreatedAttribute() }}</p>

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
                                    <div class="modal fade" id="edit{{ $cd->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title ">Edit Data CD</h4>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body px-4">

                                                    <form action="/updateCD/{{ $cd->id }}" method="POST"
                                                        enctype="multipart/form-data" class="forms-sample">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="kode_kelompok">Kode Kelompok<span
                                                                    class="text-danger">*</span></label>
                                                            <input value="{{ $cd->kode_kelompok }}" type="text"
                                                                name="kode_kelompok" class="form-control"
                                                                id="kode_kelompok" placeholder="Kode Kelompok" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="judul_cd">Tanggal Terbit<span
                                                                    class="text-danger">*</span></label>
                                                            <input value="{{ $cd->judul_cd }}" type="text"
                                                                name="judul_cd" class="form-control" id="judul_cd"
                                                                placeholder="DD/MM/YYYY" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="judul_cd">Tanggal Terbit<span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control" name="perolehan" id="perolehan">
                                                                <option class="" value="{{ $cd->perolehan }}">
                                                                    <div style="text-transform: capitalize;">
                                                                        {{ $cd->perolehan }}</div>
                                                                </option>
                                                                <option value="Pembelian">Pembelian</option>
                                                                <option value="Hadiah">Hadiah</option>
                                                                <option value="Hibah">Hibah</option>
                                                                <option value="Dropping">Dropping</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jumlah">Jumlah<span
                                                                    class="text-danger">*</span></label>
                                                            <input value="{{ $cd->jumlah }}" type="number"
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

    <script>
        $('.delete').click(function() {
            var id_cd = $(this).attr('data-id');
            var judul = $(this).attr('data-cd');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: "Hapus CD  " + judul + " ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/deleteCD/" + id_cd + ""
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

            window.location.href = '/exportpdf_CD/' + tgl_awal + '/' + tgl_akhir
        })

        $('#exportExcel').click(function() {
            var tgl_awal_excel = document.getElementById('tgl_awal_excel').value;
            var tgl_akhir_excel = document.getElementById('tgl_akhir_excel').value;

            if (tgl_awal_excel == '') {
                tgl_awal_excel = '2000-01-01';
            }

            if (tgl_akhir_excel == '') {
                const date = new Date();
                const month = date.getMonth(); //getMonth mengembalikan bulan dalam nilai (0--11)
                const realMonth = month + 1;
                const now = date.getFullYear() + '-' + realMonth + '-' + date.getDate();
                tgl_akhir_excel = now;
            }

            window.location.href = '/exportexcel_CD/' + tgl_awal_excel + '/' + tgl_akhir_excel
        })
    </script>
@endsection
