@extends('layouts.blank')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-book-open "></i>
            </span> Tambah Data Buku
        </h3>
    </div>
    @if ($message = Session::get('success'))
        {{-- Notif buku berhasil ditambah --}}
        <script>
            Swal.fire(
                'Berhasil!',
                'Data Buku Berhasil Ditambahkan!',
                'success'
            )
        </script>
    @endif

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambahkan Data Buku</h4>
                <p class="card-description"> Sesuai dengan form yang disediakan </p>
                <form action="/insertdata" method="POST" enctype="multipart/form-data" class="forms-sample">
                    @csrf

                    {{-- PERUNTUKAN DAN ISBN --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="peruntukan">Peruntukan <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="peruntukan" class="form-control" id="peruntukan"
                                        placeholder="Peruntukan" required value="{{ old('peruntukan') }}"
                                        autocomplete="peruntukan" class="@error('peruntukan') is-invalid @enderror">
                                    @error('peruntukan')
                                        <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="isbn">ISBN <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="isbn" class="form-control" id="isbn"
                                        placeholder="ISBN Buku" required value="{{ old('isbn') }}" autocomplete="isbn"
                                        class="@error('isbn') is-invalid @enderror">
                                    @error('isbn')
                                        <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- JUDUL & JUDUL ASLI --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="judul_buku">Judul Buku <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="judul_buku" class="form-control" id="judul_buku"
                                        placeholder="Judul Buku" required value="{{ old('judul_buku') }}"
                                        autocomplete="judul_buku" class="@error('judul_buku') is-invalid @enderror">
                                    @error('judul_buku')
                                        <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="judul_asli">Judul Asli</label>
                                <div class="col-sm-9">
                                    <input type="text" name="judul_asli" class="form-control" id="judul_asli"
                                        placeholder="Judul Asli" value="{{ old('judul_asli') }}" autocomplete="judul_asli"
                                        class="@error('judul_asli') is-invalid @enderror">
                                    @error('judul_asli')
                                        <sub class="p fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KATEGORI DAN JENIS --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="kategori">Kategori <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control w-50" name="kategori" id="kategori" required
                                        value="{{ old('kategori') }}"
                                        autocomplete="kategori 
                class="@error('kategori') is-invalid @enderror">
                                        @if (!empty(old('kategori')))
                                            <option value="{{ old('kategori') }}">{{ old('kategori') }}</option>
                                        @endif
                                        <option value="">--Piih Kategori Buku--</option>
                                        <option value="Fiksi">Fiksi</option>
                                        <option value="Nonfiksi">Non Fiksi</option>
                                        <option value="Referensi">Referensi</option>
                                    </select>
                                    @error('kategori')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="jenis_id">Jenis<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="jenis_id" id="jenis_id"
                                        class="@error('jenis_id') is-invalid @enderror">
                                        <option value="">--Piih
                                            Jenis Buku--</option>
                                        @foreach ($jen as $jenisbuku)
                                            <option value="{{ $jenisbuku->id }}">{{ $jenisbuku->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_id')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                                <button type="button" title="Tambah Jenis Buku"
                                    onclick="location.href='/datajenisbuku';"
                                    class="btn btn-sm btn-inverse-primary btn-icon delete "> <i
                                        class="mdi mdi-file-document-box"></i></button>

                            </div>
                        </div>
                    </div>

                    {{-- BAHASA DAN PEROLEHAN --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="bahasa">Bahasa <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="bahasa" id="bahasa" required
                                        class="@error('bahasa') is-invalid @enderror">
                                        @if (!empty(old('bahasa')))
                                            <option value="{{ old('bahasa') }}">{{ old('bahasa') }}</option>
                                        @endif
                                        <option value="">--Piih Bahasa--</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Arab">Arab</option>
                                        <option value="Inggris">Inggris</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    @error('bahasa')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="perolehan">Perolehan <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="perolehan" id="perolehan" required
                                        class="@error('perolehan') is-invalid @enderror">
                                        @if (!empty(old('perolehan')))
                                            <option value="{{ old('perolehan') }}">{{ old('perolehan') }}</option>
                                        @endif
                                        <option value="">--Piih Perolehan--</option>
                                        <option value="Pembelian">Pembelian</option>
                                        <option value="Hadiah">Hadiah</option>
                                        <option value="Hibah">Hibah</option>
                                        <option value="Dropping">Dropping</option>
                                    </select>
                                    @error('perolehan')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SUBJEK DAN PENERJEMAH --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="subyek">Subyek</label>
                                <div class="col-sm-9">
                                    <input type="text" name="subyek" class="form-control" id="subyek"
                                        placeholder="Subyek" value="{{ old('subyek') }}" autocomplete="subyek"
                                        class="@error('subyek') is-invalid @enderror">
                                    @error('subyek')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="penerjemah">Penerjemah</label>
                                <div class="col-sm-9">
                                    <input type="text" name="penerjemah" class="form-control" id="penerjemah"
                                        placeholder="Penerjemah" value="{{ old('penerjemah') }}"
                                        autocomplete="penerjemah" class="@error('penerjemah') is-invalid @enderror">
                                    @error('penerjemah')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PENULIS DAN PENERBIT --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="penulis">Penulis <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="penulis" class="form-control" id="penulis"
                                        placeholder="Penulis" required value="{{ old('penulis') }}"
                                        autocomplete="penulis" class="@error('penulis') is-invalid @enderror">
                                    @error('penulis')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="penerbit_id">Penerbit <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="penerbit_id" id="penerbit_id"
                                        class="@error('penerbit_id') is-invalid @enderror">
                                        <option value="">--Piih Penerbit--</option>
                                        @foreach ($penerbit as $row)
                                            <option value="{{ $row->id }}">{{ $row->nama_penerbit }}</option>
                                        @endforeach
                                    </select>
                                    @error('penerbit_id')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</p>
                                        @enderror
                                </div>
                                <button type="button" title="Tambah Penerbit" onclick="location.href='/dataPenerbit';"
                                    class="btn btn-sm btn-inverse-primary btn-icon "> <i
                                        class="mdi mdi-file-document-box"></i></button>
                            </div>
                        </div>
                    </div>

                    {{-- TAHUN TERBIT DAN JUMLAH BUKU --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="jumlah">Jumlah <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="number" name="jumlah" class="form-control"
                                        id="jumlah @error('jumlah') is-invalid @enderror" placeholder="Jumlah" required
                                        value="{{ old('jumlah') }}" autocomplete="jumlah">
                                    @error('jumlah')
                                        <sub class="text-danger fst-italic">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="tahun_terbit">Tahun Terbit <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="number" name="tahun_terbit" class="form-control" id="tahun_terbit"
                                        placeholder="Tahun Terbit" required value="{{ old('tahun_terbit') }}"
                                        autocomplete="tahun_terbit" class="@error('tahun_terbit') is-invalid @enderror">
                                    @error('tahun_terbit')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- EDISI DAN TEMPAT TERBIT --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="edisi">Edisi Ke-</label>
                                <div class="col-sm-9">
                                    <input type="number" name="edisi" class="form-control" id="edisi"
                                        placeholder="Edisi" value="{{ old('edisi') }}" autocomplete="edisi"
                                        class="@error('edisi') is-invalid @enderror">
                                    @error('edisi')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="tempat_terbit_id">Tempat Terbit <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="tempat_terbit_id" id="tempat_terbit_id"
                                        class="@error('tempat_terbit_id') is-invalid @enderror">
                                        <option value="">--Piih Tempat Terbit--</option>
                                        @foreach ($tempat_terbit as $row)
                                            <option value="{{ $row->id }}">{{ $row->kota }}</option>
                                        @endforeach
                                    </select>
                                    @error('tempat_terbit_id')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</p>
                                        @enderror
                                </div>
                                <button type="button" title="Tambah Tempat Terbit"
                                    onclick="location.href='/dataTempatTerbit';"
                                    class="btn btn-sm btn-inverse-primary btn-icon "> <i
                                        class="mdi mdi-file-document-box"></i></button>
                            </div>
                        </div>
                    </div>
                    <p class="card-description"> Detail Buku </p>

                    {{-- JILID DAN CETAKAN --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="jilid">Jilid Ke-</label>
                                <div class="col-sm-9">
                                    <input type="number" name="jilid" class="form-control" id="jilid"
                                        placeholder="Jilid" value="{{ old('jilid') }}" autocomplete="jilid"
                                        class="@error('jilid') is-invalid @enderror">
                                    @error('jilid')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="cetakan">Cetakan</label>
                                <div class="col-sm-9">
                                    <input type="number" name="cetakan" class="form-control" id="cetakan"
                                        placeholder="Cetakan" value="{{ old('cetakan') }}" autocomplete="cetakan"
                                        class="@error('cetakan') is-invalid @enderror">
                                    @error('cetakan')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- HALAMAN DAN PANJANG --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="halaman">Halaman</label>
                                <div class="col-sm-9">
                                    <input type="number" name="halaman" class="form-control" id="halaman"
                                        placeholder="Halaman" value="{{ old('halaman') }}" autocomplete="halaman"
                                        class="@error('halaman') is-invalid @enderror">
                                    @error('halaman')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="panjang">Panjang</label>
                                <div class="col-sm-9">
                                    <input type="number" name="panjang" class="form-control" id="panjang"
                                        placeholder="Panjang (cm)" value="{{ old('panjang') }}" autocomplete="panjang"
                                        class="@error('panjang') is-invalid @enderror">
                                    @error('panjang')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RAK DAN LEBAR --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="rak">Rak</label>
                                <div class="col-sm-9">
                                    <input type="number" name="rak" class="form-control" id="rak"
                                        placeholder="Rak" value="{{ old('rak') }}" autocomplete="rak"
                                        class="@error('rak') is-invalid @enderror">
                                    @error('rak')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="lebar">Lebar</label>
                                <div class="col-sm-9">
                                    <input type="number" name="lebar" class="form-control" id="lebar"
                                        placeholder="Lebar (cm)" value="{{ old('lebar') }}" autocomplete="lebar"
                                        class="@error('lebar') is-invalid @enderror">
                                    @error('lebar')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- HARGA DAN SAMPUL --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="harga">Harga</label>
                                <div class="col-sm-9">
                                    <input type="number" name="harga" class="form-control" id="harga"
                                        placeholder="Harga" value="{{ old('harga') }}" autocomplete="harga"
                                        class="@error('harga') is-invalid @enderror">
                                    @error('harga')
                                        <sub class="fst-italic text-danger">{{ "$message" }}</sub>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="sampul">Sampul Buku</label>
                                <div class="col-sm-9">
                                    <input type="file" name="sampul" class="form-control"
                                        value="{{ old('sampul') }}" autocomplete="sampul">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3"><span class="text-danger">*</span><span> = Wajib Diisi</span></div>

                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="/databuku" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
