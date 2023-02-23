@extends('layouts.blank')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard Perpustakaan
        </h3>
    </div>
    <h4>Koleksi</h4>
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <a style="text-decoration: none; color:white;" href="/databuku">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-2">Jumlah Buku<i
                                class="mdi mdi-library-books mdi-20px mx-1 float-right"></i>
                        </h4>
                        <h1 class="">{{ $jumlah_buku }}</h1>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <a style="text-decoration: none; color:white;" href="/dataMajalah">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-2">Jumlah Majalah<i
                                class="mdi mdi mdi-book-open-variant mdi-20px mx-1 float-right"></i>
                        </h4>
                        <h1 class="">{{ $jumlah_majalah }}</h1>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <a style="text-decoration: none; color:white;" href="/dataCD">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-2">Jumlah CD<i
                                class="mdi mdi mdi-disc mdi-20px mx-1 float-right"></i>
                        </h4>
                        <h1 class="">{{ $jumlah_cd }}</h1>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <h4>Peminjam</h4>
    <div class="row">
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <a style="text-decoration: none; color:white;" href="/dataanggota">
                    <div class="card-body">
                        <h4 class="font-weight-normal mb-3">Siswa Aktif<i
                                class="mdi mdi-account-multiple mdi-20px mx-1 float-right"></i>
                        </h4>
                        <h1 class="">{{ $jumlah_anggota_aktif }}</h1>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <a style="text-decoration: none; color:white;" href="/dataanggota">
                    <div class="card-body">
                        <h4 class="font-weight-normal mb-3">Siswa Non Aktif<i
                                class="mdi mdi-account-multiple-outline mdi-20px mx-1 float-right"></i>
                        </h4>
                        <h1 class="">{{ $jumlah_anggota_nonaktif }}</h1>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <a style="text-decoration: none; color:white;" href="/dataguru">
                    <div class="card-body">
                        <h4 class="font-weight-normal mb-3">Guru Aktif<i
                                class="mdi mdi-account-multiple mdi-20px mx-1 float-right"></i>
                        </h4>
                        <h1 class="">{{ $jumlah_guru_aktif }}</h1>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <a style="text-decoration: none; color:white;" href="/dataguru">
                    <div class="card-body">
                        <h4 class="font-weight-normal mb-3">Guru Non Aktif<i
                                class="mdi mdi-account-multiple-outline mdi-20px mx-1 float-right"></i>
                        </h4>
                        <h1 class="">{{ $jumlah_guru_nonaktif }}</h1>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <h4>Transaksi</h4>
    <div class="row">
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <a style="text-decoration: none; color:white;" href="/peminjaman_buku">
                    <div class="card-body">
                        <h5 class="font-weight-normal mb-3">Peminjaman Siswa<i
                                class="mdi mdi-arrow-up-bold-circle mdi-20px mx-1 float-right"></i>
                        </h5>
                        <h1 class="">{{ $jumlah_pinjam_siswa }}</h1>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <a style="text-decoration: none; color:white;" href="/pengembalian_buku">
                    <div class="card-body">
                        <h5 class="font-weight-normal mb-3">Pengembalian Siswa<i
                                class="mdi mdi-arrow-down-bold-circle mdi-20px mx-1 float-right"></i>
                        </h5>
                        <h1 class="">{{ $jumlah_kembali_siswa }}</h1>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <a style="text-decoration: none; color:white;" href="/guru_pinjam">
                    <div class="card-body">
                        <h5 class="font-weight-normal mb-3">Peminjaman Guru<i
                                class="mdi mdi-arrow-up-bold-circle mdi-20px mx-1 float-right"></i>
                        </h5>
                        <h1 class="">{{ $jumlah_pinjam_guru }}</h1>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <a style="text-decoration: none; color:white;" href="/guru_kembali">
                    <div class="card-body">
                        <h5 class="font-weight-normal mb-3">Pengembalian Guru<i
                                class="mdi mdi-arrow-down-bold-circle mdi-20px mx-1 float-right"></i>
                        </h5>
                        <h1 class="">{{ $jumlah_kembali_guru }}</h1>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <h4 class="card-title float-left">Statistik Transaksi</h4>
                        <div id="visit-sale-chart-legend"
                            class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <canvas id="visit-sale-chart" class="mt-4"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Koleksi Kategori Buku</h4>
                    <canvas id="traffic-chart"></canvas>
                    <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endsection
