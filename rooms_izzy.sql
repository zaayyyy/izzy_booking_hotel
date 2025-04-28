-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2025 pada 10.31
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
-- Struktur dari tabel `rooms_izzy`
--

CREATE TABLE `rooms_izzy` (
  `id_room_izzy` int(11) NOT NULL,
  `name_izzy` varchar(250) NOT NULL,
  `id_type_izzy` int(11) NOT NULL,
  `guest_capacity_izzy` int(11) NOT NULL,
  `price_izzy` int(11) NOT NULL,
  `room_status_izzy` enum('available','booked','clean','pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rooms_izzy`
--

INSERT INTO `rooms_izzy` (`id_room_izzy`, `name_izzy`, `id_type_izzy`, `guest_capacity_izzy`, `price_izzy`, `room_status_izzy`) VALUES
(1, 'Room 101', 2, 2, 50, 'available'),
(2, 'Room 102', 1, 3, 12, 'available'),
(3, 'Room 103', 1, 3, 65, 'available'),
(4, 'Room 104', 2, 3, 70, 'booked'),
(5, 'Room 105', 2, 2, 5, 'available'),
(6, 'Room 106', 3, 4, 80, 'available'),
(7, 'Room 107', 3, 4, 85, 'available'),
(8, 'Room 108', 2, 3, 67, 'available'),
(9, 'Room 109', 1, 2, 53, 'available'),
(10, 'Room 110', 2, 3, 69, 'available'),
(11, 'Room 1123', 1, 2, 22, 'booked');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `rooms_izzy`
--
ALTER TABLE `rooms_izzy`
  ADD PRIMARY KEY (`id_room_izzy`),
  ADD KEY `id_type_izzy` (`id_type_izzy`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `rooms_izzy`
--
ALTER TABLE `rooms_izzy`
  MODIFY `id_room_izzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `rooms_izzy`
--
ALTER TABLE `rooms_izzy`
  ADD CONSTRAINT `rooms_izzy_ibfk_2` FOREIGN KEY (`id_type_izzy`) REFERENCES `room_type_izzy` (`id_type_izzy`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
