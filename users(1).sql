-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2023 at 05:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `song_id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `playlist_name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `playlist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`email`, `password`) VALUES
('kumarvishal6485@gmail.com', '??#}yʈ?dd??\r?cEQ9d'),
('shashankyadav@gmail.com', '@?\0c_?Qe2???^?۾?');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `id` int(11) NOT NULL,
  `songname` varchar(30) DEFAULT NULL,
  `music` longblob DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `artist` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id`, `songname`, `music`, `image`, `artist`) VALUES
(19, 'Brown Munde', 0x42726f776e2d4d756e6465285061676c61536f6e6773292e6d7033, 0x736f6e67382e6a7067, 'AP Dhillon | Gurinder Gill'),
(20, 'Daku', 0x44616b75285061676c61536f6e6773292e6d7033, 0x736f6e67312e6a7067, 'Inderpal Moga'),
(21, 'Excuses', 0x45786375736573285061676c61536f6e6773292e6d7033, 0x736f6e67332e6a7067, 'AP Dhillon | Gurinder Gill'),
(22, 'Tu Aake Dekhle-King', 0x54752d41616b652d44656b686c65285061676c61536f6e6773292e6d7033, 0x736f6e67372e6a7067, 'King'),
(23, 'Kaun Nachdi', 0x4b61756e2d4e6163686469285061676c61536f6e6773292e6d7033, 0x736f6e67342e6a7067, 'Guru Randhawa'),
(24, 'Levels - sidhu moose wala', 0x4c6576656c73285061676c61536f6e6773292e6d7033, 0x736f6e67362e6a7067, 'Sidhu Moose Wala'),
(25, 'Gaadi Paache Gaadi', 0x4761616469205061616368652047616164695f363428506167616c576f726c642e636f6d2e7365292e6d7033, 0x736f6e67352e6a7067, 'Amanraj Gill | Pranjal Dahiya'),
(26, 'She dont give a - king', 0x53686520446f6e74204769766520412e6d7033, 0x736f6e67332e6a7067, 'King');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `playlist_no` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `lastplayed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD KEY `song_id` (`song_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD UNIQUE KEY `id` (`id`) USING BTREE,
  ADD KEY `email` (`email`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_3` (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD KEY `foreign key` (`id`),
  ADD KEY `song_id` (`song_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `song` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`email`) REFERENCES `signup` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`email`) REFERENCES `signup` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `foreign key` FOREIGN KEY (`id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `song` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
