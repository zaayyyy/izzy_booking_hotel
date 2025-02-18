-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Feb 2025 pada 09.06
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
-- Struktur dari tabel `add_facilities_izzy`
--

CREATE TABLE `add_facilities_izzy` (
  `id_add_izzy` int(11) NOT NULL,
  `add_name_izzy` varchar(150) NOT NULL,
  `add_desc_izzy` text NOT NULL,
  `add_price_izzy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `add_facilities_izzy`
--

INSERT INTO `add_facilities_izzy` (`id_add_izzy`, `add_name_izzy`, `add_desc_izzy`, `add_price_izzy`) VALUES
(1, 'extra bed', 'extra bed for children ', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_izzy`
--

CREATE TABLE `admin_izzy` (
  `id_admin_izzy` int(11) NOT NULL,
  `username_admin_izzy` varchar(250) NOT NULL,
  `password_admin_izzy` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_izzy`
--

INSERT INTO `admin_izzy` (`id_admin_izzy`, `username_admin_izzy`, `password_admin_izzy`) VALUES
(1, 'zay', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms_izzy`
--

CREATE TABLE `rooms_izzy` (
  `id_room_izzy` int(11) NOT NULL,
  `name_izzy` varchar(250) NOT NULL,
  `id_type_izzy` int(11) NOT NULL,
  `id_add_izzy` int(11) DEFAULT NULL,
  `guest_capacity_izzy` int(11) NOT NULL,
  `price_izzy` int(11) NOT NULL,
  `room_status_izzy` enum('available','booked','clean','pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rooms_izzy`
--

INSERT INTO `rooms_izzy` (`id_room_izzy`, `name_izzy`, `id_type_izzy`, `id_add_izzy`, `guest_capacity_izzy`, `price_izzy`, `room_status_izzy`) VALUES
(2, 'Deluxe Room', 2, 1, 4, 20, 'available'),
(3, 'Twin Bed', 3, 1, 6, 35, 'available'),
(4, 'Premium Room', 1, 1, 2, 15, 'available');

-- --------------------------------------------------------

--
-- Struktur dari tabel `room_type_izzy`
--

CREATE TABLE `room_type_izzy` (
  `id_type_izzy` int(11) NOT NULL,
  `type_izzy` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `room_type_izzy`
--

INSERT INTO `room_type_izzy` (`id_type_izzy`, `type_izzy`) VALUES
(1, 'Premium'),
(2, 'Deluxe'),
(3, 'Twin Bed');

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
-- Struktur dari tabel `transaction_izzy`
--

CREATE TABLE `transaction_izzy` (
  `id_transaction` int(11) NOT NULL,
  `id_room_izzy` int(11) NOT NULL,
  `id_user_izzy` int(11) NOT NULL,
  `room_q_izzy` int(11) DEFAULT NULL,
  `total_price_izzy` int(11) NOT NULL,
  `checkin_izzy` date NOT NULL,
  `checkout_izzy` date NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction_izzy`
--

INSERT INTO `transaction_izzy` (`id_transaction`, `id_room_izzy`, `id_user_izzy`, `room_q_izzy`, `total_price_izzy`, `checkin_izzy`, `checkout_izzy`, `create_at`) VALUES
(8, 4, 1, NULL, 30, '2025-02-18', '2025-02-20', '2025-02-18 07:27:19'),
(9, 4, 1, NULL, 45, '2025-02-18', '2025-02-21', '2025-02-18 07:27:27'),
(10, 4, 1, NULL, 45, '2025-02-18', '2025-02-21', '2025-02-18 07:28:41'),
(11, 4, 1, NULL, 45, '2025-02-18', '2025-02-21', '2025-02-18 07:29:28'),
(12, 4, 1, NULL, 45, '2025-02-18', '2025-02-21', '2025-02-18 07:29:45'),
(13, 4, 1, NULL, 30, '2025-02-18', '2025-02-20', '2025-02-18 07:29:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_izzy`
--

CREATE TABLE `user_izzy` (
  `id_izzy` int(11) NOT NULL,
  `name_izzy` varchar(255) NOT NULL,
  `email_izzy` varchar(255) NOT NULL,
  `phone_izzy` varchar(15) NOT NULL,
  `pincode_izzy` varchar(10) NOT NULL,
  `address_izzy` text NOT NULL,
  `password_izzy` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_izzy`
--

INSERT INTO `user_izzy` (`id_izzy`, `name_izzy`, `email_izzy`, `phone_izzy`, `pincode_izzy`, `address_izzy`, `password_izzy`, `created_at`) VALUES
(1, 'izzy', 'izzy123@gmail.com', '123123', '123', 'cimahi', '$2y$10$hLIkaqDhesql/i1nbto6yuM4fAxPqHErgu2WROAleawzzHS1Af5le', '2025-02-17 10:52:49');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `add_facilities_izzy`
--
ALTER TABLE `add_facilities_izzy`
  ADD PRIMARY KEY (`id_add_izzy`);

--
-- Indeks untuk tabel `admin_izzy`
--
ALTER TABLE `admin_izzy`
  ADD PRIMARY KEY (`id_admin_izzy`);

--
-- Indeks untuk tabel `rooms_izzy`
--
ALTER TABLE `rooms_izzy`
  ADD PRIMARY KEY (`id_room_izzy`);

--
-- Indeks untuk tabel `room_type_izzy`
--
ALTER TABLE `room_type_izzy`
  ADD PRIMARY KEY (`id_type_izzy`);

--
-- Indeks untuk tabel `setting_izzy`
--
ALTER TABLE `setting_izzy`
  ADD PRIMARY KEY (`id_izzy`);

--
-- Indeks untuk tabel `transaction_izzy`
--
ALTER TABLE `transaction_izzy`
  ADD PRIMARY KEY (`id_transaction`);

--
-- Indeks untuk tabel `user_izzy`
--
ALTER TABLE `user_izzy`
  ADD PRIMARY KEY (`id_izzy`),
  ADD UNIQUE KEY `email_izzy` (`email_izzy`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `add_facilities_izzy`
--
ALTER TABLE `add_facilities_izzy`
  MODIFY `id_add_izzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `admin_izzy`
--
ALTER TABLE `admin_izzy`
  MODIFY `id_admin_izzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rooms_izzy`
--
ALTER TABLE `rooms_izzy`
  MODIFY `id_room_izzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `room_type_izzy`
--
ALTER TABLE `room_type_izzy`
  MODIFY `id_type_izzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `setting_izzy`
--
ALTER TABLE `setting_izzy`
  MODIFY `id_izzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaction_izzy`
--
ALTER TABLE `transaction_izzy`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user_izzy`
--
ALTER TABLE `user_izzy`
  MODIFY `id_izzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
