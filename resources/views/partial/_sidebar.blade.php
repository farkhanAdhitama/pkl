<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="assets/images/logo/smankaLogo.png" alt="profile">
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">Administrator</span>
          <span class="text-secondary text-small">Perpustakaan SMANKA</span>
        </div>
        {{-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i> --}}
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="/home">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>

    {{-- <li class="nav-item">
      <a class="nav-link" href="{{ route('databuku') }}">
        <span class="menu-title">Data Buku</span>
        <i class="mdi mdi-book-open menu-icon"></i>
      </a>
    </li> --}}

    <li class="nav-item {{ (request()->is('tambahbuku', 'tambahMajalah','datajenisbuku','dataPenerbit')) ? 'active' : '' }}">
      <a class="nav-link " data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Koleksi</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-chart-bar menu-icon"></i>
      </a>
      <div class="collapse " id="ui-basic">
        <ul class="nav flex-column sub-menu ">
          <li class="nav-item "> <a class="nav-link {{ (request()->is('tambahbuku', 'datajenisbuku','dataPenerbit')) ? 'active' : '' }}" href="{{ route('databuku') }}">Koleksi Buku</a></li>
          {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('kategori') }}">Kategori Buku</a></li> --}}
          <li class="nav-item"> <a class="nav-link {{ (request()->is('tambahMajalah')) ? 'active' : '' }}" href="{{ route('dataMajalah') }}">Koleksi Majalah</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('dataCD') }}">Koleksi CD</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item ">
      <a class="nav-link " data-bs-toggle="collapse" href="#anggota" aria-expanded="false" aria-controls="anggota">
        <span class="menu-title">Anggota</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-account-multiple menu-icon"></i>
      </a>
      <div class="collapse " id="anggota">
        <ul class="nav flex-column sub-menu ">
          <li class="nav-item"> <a class="nav-link" href="{{ route('dataanggota') }}">Siswa</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('dataguru')}}">Guru/Staff</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#general" aria-expanded="false" aria-controls="general">
        <span class="menu-title">Transaksi Siswa</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi mdi-dns menu-icon"></i>
      </a>
      <div class="collapse" id="general">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('peminjaman') }}">Peminjaman</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('pengembalian') }}">Pengembalian</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#guru" aria-expanded="false" aria-controls="guru">
        <span class="menu-title">Transaksi Guru</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi mdi-dns menu-icon"></i>
      </a>
      <div class="collapse" id="guru">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="#">Peminjaman</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Pengembalian</a></li>
        </ul>
      </div>
    </li>

    {{-- <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#pages" aria-expanded="false" aria-controls="pages">
        <span class="menu-title">Transaksi Guru</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi mdi-dns menu-icon"></i>
      </a>
      <div class="collapse" id="pages">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('peminjaman_guru') }}">Peminjaman</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('pengembalian_guru') }}">Pengembalian</a></li>
        </ul>
      </div>
    </li> --}}
    
    {{-- <li class="nav-item">
      <a class="nav-link" href="{{ route('peminjaman') }}">
        <span class="menu-title">Peminjaman</span>
        <i class="mdi mdi-arrow-up-bold-circle menu-icon"></i>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('pengembalian') }}">
        <span class="menu-title">Pengembalian</span>
        <i class="mdi mdi-arrow-down-bold-circle menu-icon"></i>
      </a>
    </li> --}}

    <li class="nav-item">
      <a class="nav-link" href="{{ route('pengaturan') }}">
        <span class="menu-title">Pengaturan</span>
        <i class="mdi mdi-settings menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>