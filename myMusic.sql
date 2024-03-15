-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2024 at 07:39 AM
-- Server version: 5.7.34
-- PHP Version: 7.0.33-27+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myMusic`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `following` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `follower`, `following`) VALUES
(51, 5, 12),
(57, 4, 12),
(60, 1, 12),
(66, 2, 12),
(70, 12, 12),
(87, 2, 14),
(88, 7, 14);

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id` int(10) NOT NULL,
  `artist` varchar(200) NOT NULL DEFAULT 'unknown',
  `title` varchar(200) NOT NULL,
  `music` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id`, `artist`, `title`, `music`, `image`, `description`, `date`, `user_id`) VALUES
(10, 'Aste x Kedamawe', 'jalye', 'song.mp3', 'cover.png', '', '1979', 1),
(12, 'cara', 'love is winn', 'song1.mp3', 'vlcsnap-2023-05-24-20h25m53s419.png', '', '199203', 4),
(13, 'selena gomez', 'you', 'selena gomez.mp3', 'selena.png', '', '199203', 1),
(14, 'unknown', 'no one', 'song2.mp3', 'Screenshot from 2023-05-22 18-52-24.png', '', '199203', 1),
(23, 'cara', 'love is winn', 'song1.mp3', 'vlcsnap-2023-05-24-20h25m53s419.png', '', '199203', 2),
(24, 'wu thang', 'Intro', '01 Intro.mp3', 'albem_art.png', '', '2024-01-15', 7),
(25, 'wu thang', 'Special Delivery', '05 Special Delivery.mp3', 'albem_art.png', '', '2024-01-15', 7),
(26, 'young_stunna', 'Compose', '12 Compose - Young Stunna ft JSongz.mp3', 'young_stunna.png', 'my des', '2024-01-15', 15);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(10) NOT NULL,
  `playlist_id` int(10) NOT NULL,
  `music_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `playlist_id`, `music_id`) VALUES
(1, 1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_name`
--

CREATE TABLE `playlist_name` (
  `id` int(10) NOT NULL,
  `playlist_name` varchar(200) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlist_name`
--

INSERT INTO `playlist_name` (`id`, `playlist_name`, `user_id`) VALUES
(1, 'my new app', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL DEFAULT 'userdefut.png',
  `description` text NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `image`, `description`, `active`) VALUES
(1, 'minte', '@minte.gmail.com', 'sdsfddf', 'image.png', '', 1),
(2, 'mintenot yesmashew', 'mintesnot@gmail.com', '@mntman40', 'musicSample.png', 'hello every one', 1),
(4, 'zara larsson', 'larsson@gmail.com', 'zara', 'hm-dark-artist.png', '', 1),
(5, 'selena gomeze', 'selena', 'asadsds', 'selena.png', 'i dont give up its my time i dont give up its my time i dont give up its my time i dont give up its my time i dont give up its my time i dont give up ', 0),
(7, 'Wu Tang', 'wutang@gmail.com', '11221122', 'albem_art.png', '', 1),
(12, 'gashminte', 'gashminte@gmail.com', 'gashgash', 'userdefut.png', '', 0),
(13, 'my name', 'mynameis@gmail.com', '232134', 'userdefut.png', '', 0),
(14, 'root', 'mintesnotyess@gmail.com', 'dfdfdf', 'userdefut.png', '', 0),
(15, 'young', 'stunna@gmail.com', '11111111111234', 'young_stunna.png', 'i dont give up its my time i dont give up its my time i dont give up its my time i dont give up its my time i dont give up its my time i dont give up ', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playlist_id` (`playlist_id`,`music_id`),
  ADD KEY `music_id` (`music_id`);

--
-- Indexes for table `playlist_name`
--
ALTER TABLE `playlist_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `playlist_name`
--
ALTER TABLE `playlist_name`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `music_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`music_id`) REFERENCES `music` (`id`),
  ADD CONSTRAINT `playlist_ibfk_2` FOREIGN KEY (`playlist_id`) REFERENCES `playlist_name` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
