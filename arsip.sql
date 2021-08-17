-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 17 Agu 2021 pada 15.48
-- Versi server: 5.7.26
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_arsip`
--

CREATE TABLE `tbl_arsip` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `file` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_arsip`
--

INSERT INTO `tbl_arsip` (`id`, `judul`, `file`, `user_id`, `tanggal`) VALUES
(1, 'dokument kenaikan pangkat', 'ini contoh saja', 2, '2021-08-11'),
(2, 'sasas', 'a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;}', 10, '2021-08-18'),
(3, 'sasas', 'a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;}', 10, '2021-08-18'),
(4, 'sasas', 'a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;}', 10, '2021-08-18'),
(5, 'sasas', 'a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;N;i:5;N;}', 10, '2021-08-18'),
(6, 'sasas', 'a:6:{i:0;s:0:\"\";i:1;s:40:\"Screen_Shot_2021-08-16_at_13_21_4810.png\";i:2;s:39:\"Screen_Shot_2021-08-16_at_13_21_585.png\";i:3;s:39:\"Screen_Shot_2021-08-16_at_13_21_395.png\";i:4;s:40:\"Screen_Shot_2021-08-16_at_13_21_4811.png\";i:5;s:40:\"Screen_Shot_2021-08-16_at_13_21_4811.png\";}', 10, '2021-08-18'),
(7, 'sasas', 'a:6:{i:0;s:0:\"\";i:1;s:40:\"Screen_Shot_2021-08-16_at_13_21_4812.png\";i:2;s:39:\"Screen_Shot_2021-08-16_at_13_21_586.png\";i:3;s:39:\"Screen_Shot_2021-08-16_at_13_21_396.png\";i:4;s:40:\"Screen_Shot_2021-08-16_at_13_21_4813.png\";i:5;s:40:\"Screen_Shot_2021-08-16_at_13_21_4813.png\";}', 10, '2021-08-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bidang`
--

CREATE TABLE `tbl_bidang` (
  `id` int(11) NOT NULL,
  `nama_bidang` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_bidang`
--

INSERT INTO `tbl_bidang` (`id`, `nama_bidang`) VALUES
(1, 'bidang 1'),
(2, 'bidang 2'),
(3, 'bidang 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(15, 1, 1),
(19, 1, 3),
(21, 2, 1),
(24, 1, 9),
(28, 2, 3),
(29, 2, 2),
(30, 1, 2),
(31, 1, 10),
(32, 1, 11),
(33, 1, 12),
(34, 1, 13),
(35, 3, 11),
(36, 4, 11),
(37, 5, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori_arsip`
--

CREATE TABLE `tbl_kategori_arsip` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_kategori_arsip`
--

INSERT INTO `tbl_kategori_arsip` (`id`, `nama_kategori`) VALUES
(1, 'kategori 1'),
(2, 'kategori 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 'y'),
(2, 'KELOLA PENGGUNA', 'user', 'fa fa-user-o', 0, 'y'),
(3, 'level PENGGUNA', 'userlevel', 'fa fa-users', 0, 'n'),
(9, 'Contoh Form', 'welcome/form', 'fa fa-id-card', 0, 'n'),
(10, 'KELOLA BIDANG', 'bidang', 'fa fa-user', 0, 'y'),
(11, 'Kategori Arsip', 'kategori', 'fa fa-user', 0, 'y'),
(12, 'kelola Pengumuman', 'pengumuman', 'fa fa-user', 0, 'y'),
(13, 'kelola Arsip', 'arsip', 'fa fa-user', 0, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengumuman`
--

CREATE TABLE `tbl_pengumuman` (
  `id` int(11) NOT NULL,
  `judul` int(11) NOT NULL,
  `keterangan` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_unit_kerja`
--

CREATE TABLE `tbl_unit_kerja` (
  `id` int(11) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_unit_kerja`
--

INSERT INTO `tbl_unit_kerja` (`id`, `unit_kerja`) VALUES
(1, 'unit kerja 1'),
(2, 'unit kerja 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `id_bidang`, `is_aktif`) VALUES
(1, 'Nuris Akbar M.Kom', 'nuris.akbar@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 1, 0, 'y'),
(3, 'Muhammad hafidz Muzaki', 'hafid@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', '7.png', 2, 0, 'y'),
(7, 'sasas', 'amiludin@gmail.com', '$2y$04$I.KMZ3j6UeKGGXVjNXoFUONpy5BqnB5QExf6q5FV6xJ6S/G6aNuam', 'Screen_Shot_2021-08-16_at_13_44_481.png', 1, 2, 'y'),
(8, 'dsdsds', 'adminbalai@gmail.com', '$2y$04$ys5e5JqMhYpV8EQe6Axb1OpSHu5k7piZSSX7RcibPj77uRILNTO7S', 'Screen_Shot_2021-08-16_at_14_52_09.jpg', 5, 1, 'y'),
(9, 'sasa', 'sas@gmail.com', '$2y$04$GbNJq2IQ6PPscldn/S5qU.Q0aXXdZxjZCFTT.lWgNJYmKmLVByYkO', 'Screen_Shot_2021-08-16_at_14_52_09.png', 3, 3, 'y'),
(10, 'contoh user level 3', 'userlevel3@gmail.com', '$2y$04$hOkM9tzXGcM7hRHvOBShKu9sigYbdleK.eaFeROtTtDCv1TFw05k2', 'Screen_Shot_2021-08-16_at_14_27_02.png', 5, 1, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Level 1'),
(4, 'Level 2'),
(5, 'Level 3');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_arsip`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_arsip` (
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_arsip`
--
DROP TABLE IF EXISTS `view_arsip`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_arsip`  AS  select `a`.`id` AS `id`,`a`.`judul` AS `judul`,`a`.`file` AS `file`,`a`.`tanggal` AS `tanggal`,`b`.`nama_bidang` AS `nama_bidang`,`p`.`nama` AS `nama`,`u`.`unit_kerja` AS `unit_kerja` from (((`arsip` `a` join `bidang` `b` on((`b`.`id` = `a`.`bidang_id`))) join `pengguna` `p` on((`p`.`id` = `a`.`pengguna_id`))) join `unit_kerja` `u` on((`u`.`id` = `a`.`unit_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_arsip`
--
ALTER TABLE `tbl_arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_bidang`
--
ALTER TABLE `tbl_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_kategori_arsip`
--
ALTER TABLE `tbl_kategori_arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tbl_pengumuman`
--
ALTER TABLE `tbl_pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `tbl_unit_kerja`
--
ALTER TABLE `tbl_unit_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indeks untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_arsip`
--
ALTER TABLE `tbl_arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_bidang`
--
ALTER TABLE `tbl_bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori_arsip`
--
ALTER TABLE `tbl_kategori_arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengumuman`
--
ALTER TABLE `tbl_pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_unit_kerja`
--
ALTER TABLE `tbl_unit_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
