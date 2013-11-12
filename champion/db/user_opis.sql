-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2013 at 10:31 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `galerija`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_opis`
--

CREATE TABLE IF NOT EXISTS `user_opis` (
  `id_user` int(11) NOT NULL,
  `ime_prezime` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `pol` int(11) DEFAULT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `godiste` text NOT NULL,
  `grad` text NOT NULL,
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_opis`
--

INSERT INTO `user_opis` (`id_user`, `ime_prezime`, `pol`, `telefon`, `email`, `godiste`, `grad`) VALUES
(4, 'Kate Backinsale', 0, '5555-765', 'kate@backinsale.com', '1973', 'Albany'),
(5, 'Zarko Lausevic', 1, '5555-888', 'zare@lausevic.com', '1968', 'Beograd'),
(6, 'Jes Alba', 0, '55555-44', 'jes@alba.com', '1982', 'Arilje'),
(7, 'La Linea', 1, '2222-2222', 'la@linea.com', '1983', 'bEOGRAD');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_opis`
--
ALTER TABLE `user_opis`
  ADD CONSTRAINT `f_key_user2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
