-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2019 at 09:45 PM
-- Server version: 5.6.41
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devbloom_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(220) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `pagetext` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`, `slug`, `pagetext`) VALUES
(2, 'Servicii', 'servicii', 'servicii', '<p>Pierre-Emerick Aubameyang este tinta despre care presa din Spania a anuntat in ultima saptamana ca Real ar fi dispusa sa plateasca 100 de milioane de euro. In ciuda faptului ca jucatorul a declarat in nenumarate randuri ca si-ar dori sa ajunga la Real Madrid, a respins ideea unui transfer inevitabil. Intrebat la finalul meciului dintre Dortmund si Tottenham din Europa League daca din vara va ajunge la Real Madrid, jucatorul a avut o reactie neasteptata. Test</p>'),
(28, 'about', 'about', 'about', '<p>about</p>\r\n<p><img src=\"uploads/upload.jpg\" alt=\"\" /></p>'),
(18, 'Contact', 'contact', 'contact', 'contact'),
(27, 'Panouri solare', 'Panouri solare heat pipe â€“ generalitati !', 'panouri-solare', '<p><img src=\"upload/Seo.jpg\" alt=\"\" width=\"1920\" height=\"843\" /><img src=\"upload/advertising-alphabet-business-270637.jpg\" alt=\"\" />Panouri solare heat pipe &ndash; generalitati !</p>\r\n<p><img src=\"upload/pexels.jpeg\" alt=\"\" width=\"640\" height=\"466\" /></p>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(3, 'makesite2017@gmail.com', '$2y$10$Qej9l0.oen3.t3IYiGnxxOqWAL3Bo0SE//WpNmDNFepYazd75iK22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
