<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="/pengaturan/{{ auth()->user()->id }}" class="nav-link">
                <div class="nav-profile-image">
                    <img src="../assets/images/foto_profil/{{ auth()->user()->foto_profil }}" alt="Profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
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

        <li
            class="nav-item {{ request()->is('tambahbuku', 'tambahMajalah', 'tambahCD', 'datajenisbuku', 'dataPenerbit', 'dataTempatTerbit') ? 'active' : '' }}">
            <a class="nav-link " data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-title">Koleksi</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
            <div class="collapse " id="ui-basic">
                <ul class="nav flex-column sub-menu ">
                    <li class="nav-item "> <a
                            class="nav-link {{ request()->is('tambahbuku', 'datajenisbuku', 'dataPenerbit', 'dataTempatTerbit') ? 'active' : '' }}"
                            href="{{ route('databuku') }}">Koleksi Buku</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('kategori') }}">Kategori Buku</a></li> --}}
                    <li class="nav-item"> <a class="nav-link {{ request()->is('tambahMajalah') ? 'active' : '' }}"
                            href="{{ route('dataMajalah') }}">Koleksi Majalah</a></li>
                    <li class="nav-item"> <a class="nav-link {{ request()->is('tambahCD') ? 'active' : '' }}"
                            href="{{ route('dataCD') }}">Koleksi CD</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{ request()->is('tambahanggota', 'tambahguru') ? 'active' : '' }}">
            <a class="nav-link " data-bs-toggle="collapse" href="#anggota" aria-expanded="false"
                aria-controls="anggota">
                <span class="menu-title">Peminjam</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
            <div class="collapse " id="anggota">
                <ul class="nav flex-column sub-menu ">
                    <li class="nav-item"> <a class="nav-link {{ request()->is('tambahanggota') ? 'active' : '' }}"
                            href="{{ route('dataanggota') }}">Siswa</a></li>
                    <li class="nav-item"> <a class="nav-link {{ request()->is('tambahguru') ? 'active' : '' }}"
                            href="{{ route('dataguru') }}">Guru/Staff</a></li>
                </ul>
            </div>
        </li>

        <li
            class="nav-item {{ request()->is('peminjaman_majalah', 'pengembalian_majalah', 'peminjaman_cd', 'pengembalian_cd') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#siswa" aria-expanded="false" aria-controls="siswa">
                <span class="menu-title">Transaksi Siswa</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-dns menu-icon"></i>
            </a>
            <div class="collapse" id="siswa">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a
                            class="nav-link {{ request()->is('peminjaman_majalah', 'peminjaman_cd') ? 'active' : '' }}"
                            href="{{ route('peminjaman_buku') }}">Peminjaman</a></li>
                    <li class="nav-item"> <a
                            class="nav-link {{ request()->is('pengembalian_majalah', 'pengembalian_cd') ? 'active' : '' }}"
                            href="{{ route('pengembalian_buku') }}">Pengembalian</a></li>
                </ul>
            </div>
        </li>

        <li
            class="nav-item {{ request()->is('majalah_guru_pinjam', 'majalah_guru_kembali', 'cd_guru_pinjam', 'cd_guru_kembali') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#guru" aria-expanded="false" aria-controls="guru">
                <span class="menu-title">Transaksi Guru</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-dns menu-icon"></i>
            </a>
            <div class="collapse" id="guru">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link  {{ request()->is('majalah_guru_pinjam', 'cd_guru_pinjam') ? 'active' : '' }}"
                            href="{{ route('guru_pinjam') }}">Peminjaman</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('majalah_guru_kembali', 'cd_guru_kembali') ? 'active' : '' }}"
                            href="{{ route('guru_kembali') }}">Pengembalian</a>
                    </li>
                </ul>
            </div>
        </li>
        @if (auth()->user()->level == 'Operator')
            <li class="nav-item">
                <a class="nav-link " href="/data_pengguna">
                    <span class="menu-title">Data Pengguna</span>
                    <i class=" mdi mdi-account-settings menu-icon"></i>
                </a>
            </li>
        @endif
        <li class="nav-item {{ request()->is('pengaturan*') ? 'active' : '' }}">
            <a class="nav-link " href="/pengaturan/{{ auth()->user()->id }}">
                <span class="menu-title">Pengaturan</span>
                <i class="mdi mdi-settings menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
