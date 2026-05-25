-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2026 at 11:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filmovi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `filmovi`
--

CREATE TABLE `filmovi` (
  `id` int(11) NOT NULL,
  `Naslov` varchar(255) DEFAULT NULL,
  `Zanr` varchar(100) DEFAULT NULL,
  `Godina` int(11) DEFAULT NULL,
  `Trajanje_min` int(11) DEFAULT NULL,
  `Ocjena` decimal(3,1) DEFAULT NULL,
  `Rezisery` varchar(255) DEFAULT NULL,
  `Zemlja_porijekla` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filmovi`
--

INSERT INTO `filmovi` (`id`, `Naslov`, `Zanr`, `Godina`, `Trajanje_min`, `Ocjena`, `Rezisery`, `Zemlja_porijekla`) VALUES
(1, 'The Shawshank Redemption', 'Drama', 1994, 142, 9.5, 'Frank Darabont', 'USA'),
(2, 'The Godfather', 'Crime, Drama', 1972, 175, 9.2, 'Francis Ford Coppola', 'USA'),
(3, 'The Dark Knight', 'Action, Crime', 2008, 152, 9.0, 'Christopher Nolan', 'UK/USA'),
(4, 'Schindler\'s List', 'Biography, Drama', 1993, 195, 9.0, 'Steven Spielberg', 'USA'),
(5, '12 Angry Men', 'Crime, Drama', 1957, 96, 9.0, 'Sidney Lumet', 'USA'),
(6, 'Pulp Fiction', 'Crime, Drama', 1994, 154, 8.9, 'Quentin Tarantino', 'USA'),
(7, 'The Lord of the Rings: The Return of the King', 'Action, Adventure', 2003, 201, 9.0, 'Peter Jackson', 'NZ/USA'),
(8, 'Il Buono, il Brutto, il Cattivo', 'Western', 1966, 161, 8.8, 'Sergio Leone', 'Italy'),
(9, 'Fight Club', 'Drama', 1999, 139, 8.8, 'David Fincher', 'USA'),
(10, 'Inception', 'Action, Adventure', 2010, 148, 8.8, 'Christopher Nolan', 'USA/UK'),
(11, 'The Matrix', 'Action, Sci-Fi', 1999, 136, 8.7, 'Lana Wachowski', 'USA'),
(12, 'Goodfellas', 'Biography, Crime', 1990, 145, 8.7, 'Martin Scorsese', 'USA'),
(13, 'One Flew Over the Cuckoo\'s Nest', 'Drama', 1975, 133, 8.7, 'Milos Forman', 'USA'),
(14, 'Seven Samurai', 'Action, Drama', 1954, 207, 8.6, 'Akira Kurosawa', 'Japan'),
(15, 'Se7en', 'Crime, Drama', 1995, 127, 8.6, 'David Fincher', 'USA'),
(16, 'The Silence of the Lambs', 'Crime, Drama', 1991, 118, 8.6, 'Jonathan Demme', 'USA'),
(17, 'City of God', 'Crime, Drama', 2002, 130, 8.6, 'Fernando Meirelles', 'Brazil'),
(18, 'Life Is Beautiful', 'Comedy, Drama', 1997, 116, 8.6, 'Roberto Benigni', 'Italy'),
(19, 'Interstellar', 'Adventure, Drama', 2014, 169, 8.7, 'Christopher Nolan', 'USA/UK'),
(20, 'Saving Private Ryan', 'Drama, War', 1998, 169, 8.6, 'Steven Spielberg', 'USA'),
(21, 'Parasite', 'Drama, Thriller', 2019, 132, 8.5, 'Bong Joon Ho', 'South Korea'),
(22, 'The Green Mile', 'Crime, Drama', 1999, 189, 8.6, 'Frank Darabont', 'USA'),
(23, 'Star Wars: Episode IV - A New Hope', 'Action, Adventure', 1977, 121, 8.6, 'George Lucas', 'USA'),
(24, 'Terminator 2: Judgment Day', 'Action, Sci-Fi', 1991, 137, 8.6, 'James Cameron', 'USA'),
(25, 'Back to the Future', 'Adventure, Comedy', 1985, 116, 8.5, 'Robert Zemeckis', 'USA'),
(26, 'The Pianist', 'Biography, Drama', 2002, 150, 8.5, 'Roman Polanski', 'France/Poland'),
(27, 'Psycho', 'Horror, Mystery', 1960, 109, 8.5, 'Alfred Hitchcock', 'USA'),
(28, 'Gladiator', 'Action, Adventure', 2000, 155, 8.5, 'Ridley Scott', 'USA/UK'),
(29, 'The Lion King', 'Animation, Adventure', 1994, 88, 8.5, 'Roger Allers', 'USA'),
(30, 'The Departed', 'Crime, Drama', 2006, 151, 8.5, 'Martin Scorsese', 'USA'),
(31, 'Gladiator', 'Action', 2000, 155, 8.5, 'Ridley Scott', 'Ridley Scott'),
(32, 'Loš film', 'Comedy', 2002, 130, 4.0, 'Ridley Scott', 'USA'),
(33, 'Družba Pere Kvržice', 'Drama', 1990, 120, 7.0, 'Saša matić', 'Hrvatska');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `uloga` varchar(20) DEFAULT 'korisnik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `korisnicko_ime`, `email`, `lozinka`, `uloga`) VALUES
(1, 'Fran', 'fran@test.com', '$2y$10$GUE/fZrbhEguIgMXBy.o7uzs3sP1QNpV9hhL3VjCEjWgnJf61xZIC', 'admin'),
(2, 'Laura', 'laura@gmail.com', '$2y$10$OjmQwKtoDnhA3cWD5tKiw.y8FFvpQpVlKiFtM7MKirqrJN.3YvcmO', 'korisnik'),
(3, 'Kiki', 'kiki@gmail.com', '$2y$10$6pOT60NqVLyD8ZzK87HT6OwtUiW98ugQWHisGUCiLZvJlEear.DY.', 'korisnik'),
(4, 'Emanuel', 'emanuel@gmail.com', '$2y$10$zlk5zTClP75uAAD6rDWue.DW5grxckSdXjowR9bxfH/l55ynBFVoS', 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `ocjene_slika`
--

CREATE TABLE `ocjene_slika` (
  `id` int(11) NOT NULL,
  `slika_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `ocjena` int(11) NOT NULL CHECK (`ocjena` between 1 and 5),
  `vrijeme_ocjene` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ocjene_slika`
--

INSERT INTO `ocjene_slika` (`id`, `slika_id`, `korisnik_id`, `ocjena`, `vrijeme_ocjene`) VALUES
(1, 1, 2, 4, '2026-05-24 22:10:13'),
(2, 1, 3, 3, '2026-05-25 20:39:54'),
(4, 1, 4, 5, '2026-05-25 20:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `id` int(11) NOT NULL,
  `naziv_datoteke` varchar(255) NOT NULL,
  `opis` text DEFAULT NULL,
  `putanja` varchar(255) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `datum_dodavanja` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`id`, `naziv_datoteke`, `opis`, `putanja`, `korisnik_id`, `datum_dodavanja`) VALUES
(1, '1779660585_Cinestar_Avenue-Mall-2_1.jpg', 'cineszar', 'public/uploads/1779660585_Cinestar_Avenue-Mall-2_1.jpg', 1, '2026-05-24 22:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `zeljeni_filmovi`
--

CREATE TABLE `zeljeni_filmovi` (
  `id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `datum_dodavanja` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zeljeni_filmovi`
--

INSERT INTO `zeljeni_filmovi` (`id`, `korisnik_id`, `film_id`, `datum_dodavanja`) VALUES
(1, 1, 6, '2026-05-24 14:07:33'),
(4, 2, 1, '2026-05-24 16:41:29'),
(5, 1, 1, '2026-05-24 18:58:09'),
(6, 2, 32, '2026-05-24 21:52:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filmovi`
--
ALTER TABLE `filmovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ocjene_slika`
--
ALTER TABLE `ocjene_slika`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slika_id` (`slika_id`,`korisnik_id`),
  ADD KEY `korisnik_id` (`korisnik_id`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`);

--
-- Indexes for table `zeljeni_filmovi`
--
ALTER TABLE `zeljeni_filmovi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`),
  ADD KEY `film_id` (`film_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filmovi`
--
ALTER TABLE `filmovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ocjene_slika`
--
ALTER TABLE `ocjene_slika`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zeljeni_filmovi`
--
ALTER TABLE `zeljeni_filmovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ocjene_slika`
--
ALTER TABLE `ocjene_slika`
  ADD CONSTRAINT `ocjene_slika_ibfk_1` FOREIGN KEY (`slika_id`) REFERENCES `slike` (`id`),
  ADD CONSTRAINT `ocjene_slika_ibfk_2` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`id`);

--
-- Constraints for table `slike`
--
ALTER TABLE `slike`
  ADD CONSTRAINT `slike_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`id`);

--
-- Constraints for table `zeljeni_filmovi`
--
ALTER TABLE `zeljeni_filmovi`
  ADD CONSTRAINT `zeljeni_filmovi_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`id`),
  ADD CONSTRAINT `zeljeni_filmovi_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `filmovi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
