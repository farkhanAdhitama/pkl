-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Feb 2023 pada 02.31
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggotas`
--

CREATE TABLE `anggotas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `angkatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` int(11) NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `masa_berlaku` date NOT NULL,
  `status` enum('Aktif','NonAktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `foto_anggota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `anggotas`
--

INSERT INTO `anggotas` (`id`, `nama`, `nis`, `email`, `angkatan`, `kelas`, `jurusan`, `masa_berlaku`, `status`, `foto_anggota`, `created_at`, `updated_at`) VALUES
(1, 'Aji', '5443', 'khanarter@gmail.com', '2021', 10, 'MIPA 1', '2025-12-12', 'Aktif', NULL, '2023-02-24 01:27:02', '2023-02-24 01:27:02'),
(2, 'Muhammad', '2312', 'farkhanduolingo@gmail.com', '2021', 10, 'MIPA 2', '2025-12-13', 'Aktif', NULL, '2023-02-24 01:27:02', '2023-02-24 01:27:02'),
(3, 'Arya', '3446', 'Arya@gmail.com', '2021', 10, 'MIPA 3', '2025-12-14', 'Aktif', NULL, '2023-02-24 01:27:02', '2023-02-24 01:27:02'),
(4, 'Haii', '2312', 'hai@gmail.com', '2021', 10, 'MIPA 4', '2025-12-15', 'Aktif', NULL, '2023-02-24 01:27:02', '2023-02-24 01:27:02'),
(5, 'Sodhik', '5677', 'shodik@gmail.com', '2021', 10, 'MIPA 5', '2025-12-16', 'Aktif', NULL, '2023-02-24 01:27:02', '2023-02-24 01:27:02'),
(6, 'Rafael', '4343', 'email@gmail.com', '2021', 10, 'IPS 1', '2025-12-17', 'Aktif', NULL, '2023-02-24 01:27:02', '2023-02-24 01:27:02'),
(7, 'Eno', '2322', 'email@gmail.com', '2021', 10, 'IPS 2', '2025-12-18', 'Aktif', NULL, '2023-02-24 01:27:02', '2023-02-24 01:27:02'),
(8, 'Miranda', '1211', 'email@gmail.com', '2021', 10, 'IPS 3', '2025-12-19', 'Aktif', NULL, '2023-02-24 01:27:02', '2023-02-24 01:27:02'),
(9, 'Noel', '4564', 'email@gmail.com', '2021', 10, 'IPS 4', '2025-12-20', 'Aktif', NULL, '2023-02-24 01:27:02', '2023-02-24 01:27:02'),
(10, 'Abu', '3423', 'email@gmail.com', '2021', 10, 'BAHASA', '2025-12-21', 'Aktif', NULL, '2023-02-24 01:27:02', '2023-02-24 01:27:02'),
(11, 'Abi', '1211', 'email@gmail.com', '2021', 10, 'BAHASA', '2025-12-22', 'Aktif', NULL, '2023-02-24 01:27:02', '2023-02-24 01:27:02'),
(12, 'Abe', '1111', 'email@gmail.com', '2021', 10, 'BAHASA', '2025-12-23', 'Aktif', NULL, '2023-02-24 01:27:02', '2023-02-24 01:27:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `batas_pinjams`
--

CREATE TABLE `batas_pinjams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batas_siswa` int(11) DEFAULT 2,
  `batas_guru` int(11) DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `batas_pinjams`
--

INSERT INTO `batas_pinjams` (`id`, `batas_siswa`, `batas_guru`, `created_at`, `updated_at`) VALUES
(1, 34, 45, '2023-02-24 01:21:08', '2023-02-24 01:22:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukus`
--

CREATE TABLE `bukus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peruntukan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_asli` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `subyek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penerjemah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` enum('Fiksi','Nonfiksi','Referensi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `bahasa` enum('Indonesia','Arab','Inggris','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `perolehan` enum('Pembelian','Hadiah','Hibah','Droping') COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_terbit_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jilid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cetakan` int(11) DEFAULT NULL,
  `halaman` int(11) DEFAULT NULL,
  `lebar` int(11) DEFAULT NULL,
  `panjang` int(11) DEFAULT NULL,
  `edisi` int(11) DEFAULT NULL,
  `rak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `tahun_terbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sampul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bukus`
--

INSERT INTO `bukus` (`id`, `peruntukan`, `jenis_id`, `judul_buku`, `judul_asli`, `penulis`, `jumlah`, `subyek`, `penerjemah`, `kategori`, `bahasa`, `perolehan`, `penerbit_id`, `tempat_terbit_id`, `jilid`, `cetakan`, `halaman`, `lebar`, `panjang`, `edisi`, `rak`, `isbn`, `harga`, `tahun_terbit`, `sampul`, `created_at`, `updated_at`) VALUES
(1, 'Koleksi', '1', 'Bulan', 'Moon', 'Slamet', 0, 'N/A', 'N/A', 'Referensi', 'Indonesia', 'Hadiah', NULL, NULL, '2', 1, 23, 12, 22, 2, '2', '1234567891234', 12444, '2022', NULL, '2023-02-24 01:26:39', '2023-02-26 14:35:39'),
(2, 'Koleksi', '1', 'Matahari', 'Sun', 'Slamet', 3, NULL, NULL, 'Fiksi', 'Indonesia', 'Hadiah', '1', '2', NULL, 2, 343, 11, 21, NULL, '3', '1234567891235', 12000, '2023', NULL, '2023-02-24 01:26:39', '2023-02-24 02:18:04'),
(3, 'Koleksi', '2', 'Bukit', 'Moon', 'Slamet', 4, NULL, NULL, 'Nonfiksi', 'Indonesia', 'Hadiah', '1', '1', '2', 3, 232, 21, 12, 2, NULL, '1234567891236', 12000, '2024', NULL, '2023-02-24 01:26:39', '2023-02-24 01:26:39'),
(4, 'Koleksi', '2', 'Fatamorgana', 'Fatamorgana', 'Slamet', 2, NULL, NULL, 'Nonfiksi', 'Indonesia', 'Hadiah', '1', '1', NULL, 4, 12, 12, 23, 4, '2', '1234567891237', 12000, '2025', NULL, '2023-02-24 01:26:39', '2023-02-24 01:26:39'),
(5, 'Koleksi', '2', 'Lingkungan Hidup', 'Nature', 'Slamet', 1, NULL, NULL, 'Nonfiksi', 'Indonesia', 'Hadiah', '1', '2', NULL, 5, 24, 11, 11, 1, NULL, '1234567891238', 12000, '2026', NULL, '2023-02-24 01:26:39', '2023-02-24 01:26:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `c_d_s`
--

CREATE TABLE `c_d_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_kelompok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_cd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perolehan` enum('Pembelian','Hadiah','Hibah','Dropping') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gurus`
--

CREATE TABLE `gurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jabatan` enum('Guru','Karyawan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `masa_berlaku` date NOT NULL,
  `status` enum('Aktif','NonAktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `foto_guru` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gurus`
--

INSERT INTO `gurus` (`id`, `jabatan`, `nama`, `nik`, `email`, `masa_berlaku`, `status`, `foto_guru`, `created_at`, `updated_at`) VALUES
(1, 'Guru', 'Aji , S.Pd.', '5443', 'khanarter@gmail.com', '2023-12-12', 'Aktif', NULL, '2023-02-24 02:17:12', '2023-02-24 02:17:12'),
(2, 'Guru', 'Muhammad, S.Pd.', '2312', 'farkhanduolingo@gmail.com', '2023-12-13', 'Aktif', NULL, '2023-02-24 02:17:12', '2023-02-24 02:17:12'),
(3, 'Guru', 'Arya , S.Pd.', '3446', 'email@mail.com', '2023-12-14', 'Aktif', NULL, '2023-02-24 02:17:12', '2023-02-24 02:17:12'),
(4, 'Guru', 'Haii, S.Pd.', '2312', 'email@mail.com', '2023-12-15', 'Aktif', NULL, '2023-02-24 02:17:12', '2023-02-24 02:17:12'),
(5, 'Guru', 'Sodhik, S.Pd.', '5677', 'email@mail.com', '2023-12-16', 'Aktif', NULL, '2023-02-24 02:17:12', '2023-02-24 02:17:12'),
(6, 'Guru', 'Rafael, S.Pd.', '4343', 'email@mail.com', '2023-12-17', 'Aktif', NULL, '2023-02-24 02:17:12', '2023-02-24 02:17:12'),
(7, 'Karyawan', 'Eno, S.Pd.', '2322', 'email@mail.com', '2023-12-18', 'Aktif', NULL, '2023-02-24 02:17:12', '2023-02-24 02:17:12'),
(8, 'Karyawan', 'Miranda, S.Pd.', '1211', 'email@mail.com', '2023-12-19', 'Aktif', NULL, '2023-02-24 02:17:12', '2023-02-24 02:17:12'),
(9, 'Karyawan', 'Noel, S.Pd.', '4564', 'email@mail.com', '2023-12-20', 'Aktif', NULL, '2023-02-24 02:17:12', '2023-02-24 02:17:12'),
(10, 'Karyawan', 'Abu, S.Pd.', '3423', 'email@mail.com', '2023-12-21', 'Aktif', NULL, '2023-02-24 02:17:12', '2023-02-24 02:17:12'),
(11, 'Karyawan', 'Abi, S.Pd.', '1211', 'email@mail.com', '2023-12-22', 'Aktif', NULL, '2023-02-24 02:17:12', '2023-02-24 02:17:12'),
(12, 'Karyawan', 'Abe, S.Pd.', '1111', 'email@mail.com', '2023-12-23', 'Aktif', NULL, '2023-02-24 02:17:12', '2023-02-24 02:17:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenisbukus`
--

CREATE TABLE `jenisbukus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenisbukus`
--

INSERT INTO `jenisbukus` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Novel', '2023-02-26 02:16:35', '2023-02-26 02:16:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `majalahs`
--

CREATE TABLE `majalahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `nomor` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(38, '2014_10_12_000000_create_users_table', 1),
(39, '2014_10_12_100000_create_password_resets_table', 1),
(40, '2019_08_19_000000_create_failed_jobs_table', 1),
(41, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(42, '2023_01_07_101337_create_bukus_table', 1),
(43, '2023_01_07_144332_create_kategoris_table', 1),
(44, '2023_01_07_144837_create_anggotas_table', 1),
(45, '2023_01_11_080708_create_jenisbukus_table', 1),
(46, '2023_01_19_214307_add_username_in_users_table', 1),
(47, '2023_01_24_095344_create_transaksis_table', 1),
(48, '2023_01_28_220919_create_majalahs_table', 1),
(49, '2023_01_29_092308_create_penerbits_table', 1),
(50, '2023_01_29_140155_create_tempat_terbits_table', 1),
(51, '2023_01_30_143225_create_c_d_s_table', 1),
(52, '2023_01_31_071449_create_gurus_table', 1),
(53, '2023_02_04_094731_create_transaksi_gurus_table', 1),
(54, '2023_02_07_084313_create_transaksi_siswas_table', 1),
(55, '2023_02_14_174618_create_siswas_table', 1),
(56, '2023_02_23_171113_create_batas_pinjams_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('khanarter@gmail.com', '$2y$10$dIG6/lDaGI67tCzugFV05e57voLka0SpZAA3W38ABX5eGOYYdW3t6', '2023-02-25 13:58:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbits`
--

CREATE TABLE `penerbits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `angkatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `masa_berlaku` date NOT NULL,
  `status` enum('Aktif','NonAktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `foto_siswa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempat_terbits`
--

CREATE TABLE `tempat_terbits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buku_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anggota_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Dipinjam','Dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dipinjam',
  `lama` int(11) NOT NULL,
  `denda` int(11) DEFAULT NULL,
  `tgl_kembali` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_gurus`
--

CREATE TABLE `transaksi_gurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buku_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `majalah_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cd_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guru_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Dipinjam','Dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dipinjam',
  `lama` int(11) NOT NULL,
  `status_email` int(11) NOT NULL DEFAULT 0,
  `tgl_kembali` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `petugas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_siswas`
--

CREATE TABLE `transaksi_siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anggota_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buku_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `majalah_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cd_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Dipinjam','Dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dipinjam',
  `lama` int(11) NOT NULL,
  `status_email` int(11) NOT NULL DEFAULT 0,
  `tgl_kembali` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `petugas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_siswas`
--

INSERT INTO `transaksi_siswas` (`id`, `anggota_id`, `buku_id`, `majalah_id`, `cd_id`, `jenis`, `status`, `lama`, `status_email`, `tgl_kembali`, `petugas`, `created_at`, `updated_at`) VALUES
(7, '2', '1', NULL, NULL, 'buku', 'Dipinjam', 7, 0, '2023-02-26 14:35:39', 'Muhammad', '2023-02-26 14:35:39', '2023-02-26 14:35:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('Operator','Administrator') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'person.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `level`, `foto_profil`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad', 'operator', 'khanarter@gmail.com', NULL, '$2y$10$X4zFVjVaXfIXeexSHnI1p.NVBam/twweh7/HDKl7KuoZ.rz17HNp2', 'Operator', 'f80c5c891336b546ced14b3974533f2f.jpg', '75DttHV3wYk95adyyGI0OatebtlAiNJzsD96BgvHuzNOfEhKRseJCGL6OHQy', '2023-02-24 01:08:32', '2023-02-26 04:23:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggotas`
--
ALTER TABLE `anggotas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `batas_pinjams`
--
ALTER TABLE `batas_pinjams`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `c_d_s`
--
ALTER TABLE `c_d_s`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenisbukus`
--
ALTER TABLE `jenisbukus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `majalahs`
--
ALTER TABLE `majalahs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `penerbits`
--
ALTER TABLE `penerbits`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tempat_terbits`
--
ALTER TABLE `tempat_terbits`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_gurus`
--
ALTER TABLE `transaksi_gurus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_siswas`
--
ALTER TABLE `transaksi_siswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggotas`
--
ALTER TABLE `anggotas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `batas_pinjams`
--
ALTER TABLE `batas_pinjams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `c_d_s`
--
ALTER TABLE `c_d_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gurus`
--
ALTER TABLE `gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `jenisbukus`
--
ALTER TABLE `jenisbukus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `majalahs`
--
ALTER TABLE `majalahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `penerbits`
--
ALTER TABLE `penerbits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tempat_terbits`
--
ALTER TABLE `tempat_terbits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_gurus`
--
ALTER TABLE `transaksi_gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi_siswas`
--
ALTER TABLE `transaksi_siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
