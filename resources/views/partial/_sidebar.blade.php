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
      <a class="nav-link" href="/home">
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

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Data</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-chart-bar menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('databuku') }}">Data Buku</a></li>
          {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('kategori') }}">Kategori Buku</a></li> --}}
          <li class="nav-item"> <a class="nav-link" href="{{ route('dataanggota') }}">Data Anggota</a></li>
        </ul>
      </div>
    </li>
    
    <li class="nav-item">
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
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('pengaturan') }}">
        <span class="menu-title">Pengaturan</span>
        <i class="mdi mdi-settings menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>