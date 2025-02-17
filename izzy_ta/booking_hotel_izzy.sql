-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Feb 2025 pada 07.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking_hotel_izzy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_izzy`
--

CREATE TABLE `admin_izzy` (
  `id_admin_izzy` int(11) DEFAULT NULL,
  `username_admin_izzy` varchar(250) NOT NULL,
  `password_admin_izzy` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_izzy`
--

INSERT INTO `admin_izzy` (`id_admin_izzy`, `username_admin_izzy`, `password_admin_izzy`) VALUES
(NULL, 'zay', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `facilities_izzy`
--

CREATE TABLE `facilities_izzy` (
  `id_facilites_izzy` int(11) NOT NULL,
  `facilities_name_izzy` varchar(250) NOT NULL,
  `description_izzy` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `features_izzy`
--

CREATE TABLE `features_izzy` (
  `id_feature_izzy` int(11) NOT NULL,
  `feature_name_izzy` varchar(250) NOT NULL,
  `description_izzy` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms_izzy`
--

CREATE TABLE `rooms_izzy` (
  `id_room_izzy` int(11) NOT NULL,
  `id_features_izzy` int(11) NOT NULL,
  `id_facilities_izzy` int(11) NOT NULL,
  `avaibility_izzy` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_izzy`
--

CREATE TABLE `setting_izzy` (
  `id_izzy` int(11) NOT NULL,
  `title_izzy` varchar(250) NOT NULL,
  `about_izzy` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `setting_izzy`
--

INSERT INTO `setting_izzy` (`id_izzy`, `title_izzy`, `about_izzy`) VALUES
(1, 'Izzy 123', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae culpa alias et, repellat autem corrupti. Esse aperiam illum sed ducimus!');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_izzy`
--

CREATE TABLE `user_izzy` (
  `id_user_izzy` int(11) NOT NULL,
  `username_user_izzy` varchar(250) NOT NULL,
  `password_user_izzy` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `facilities_izzy`
--
ALTER TABLE `facilities_izzy`
  ADD PRIMARY KEY (`id_facilites_izzy`);

--
-- Indeks untuk tabel `features_izzy`
--
ALTER TABLE `features_izzy`
  ADD PRIMARY KEY (`id_feature_izzy`);

--
-- Indeks untuk tabel `rooms_izzy`
--
ALTER TABLE `rooms_izzy`
  ADD PRIMARY KEY (`id_room_izzy`);

--
-- Indeks untuk tabel `setting_izzy`
--
ALTER TABLE `setting_izzy`
  ADD PRIMARY KEY (`id_izzy`);

--
-- Indeks untuk tabel `user_izzy`
--
ALTER TABLE `user_izzy`
  ADD PRIMARY KEY (`id_user_izzy`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `facilities_izzy`
--
ALTER TABLE `facilities_izzy`
  MODIFY `id_facilites_izzy` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `features_izzy`
--
ALTER TABLE `features_izzy`
  MODIFY `id_feature_izzy` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rooms_izzy`
--
ALTER TABLE `rooms_izzy`
  MODIFY `id_room_izzy` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `setting_izzy`
--
ALTER TABLE `setting_izzy`
  MODIFY `id_izzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_izzy`
--
ALTER TABLE `user_izzy`
  MODIFY `id_user_izzy` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
