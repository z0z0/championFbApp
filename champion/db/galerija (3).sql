-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2013 at 08:07 PM
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
CREATE DATABASE IF NOT EXISTS `galerija` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `galerija`;

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE IF NOT EXISTS `kategorija` (
  `id_kategorija` int(11) NOT NULL AUTO_INCREMENT,
  `opis` text NOT NULL,
  PRIMARY KEY (`id_kategorija`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id_kategorija`, `opis`) VALUES
(1, 'admin - ima pristup svemu'),
(2, 'ostali - nemaju pristup svemu');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `id_upload` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `slika1` text NOT NULL,
  `slika2` text NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `f_odobreno` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_upload`),
  KEY `f_key_id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id_upload`, `id_user`, `slika1`, `slika2`, `vreme`, `f_odobreno`) VALUES
(1, 4, '/files/4/1.jpg', '/files/4/2.jpg', '2013-11-12 20:02:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `upload_like`
--

CREATE TABLE IF NOT EXISTS `upload_like` (
  `id_upload` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  UNIQUE KEY `unique_user_upload` (`id_upload`,`id_user`),
  KEY `id_upload` (`id_upload`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload_like`
--

INSERT INTO `upload_like` (`id_upload`, `id_user`) VALUES
(1, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `salt`, `last_login`) VALUES
(1, 'admin1', 'admin', '', '2013-11-07 23:00:00'),
(2, 'test_user', 'test', '', '2013-11-08 20:34:53'),
(3, 'admin', 'cc74ad98f4429531b5566c743f80f1b2b2ab6293141f2d27039cf6a5d50e67ac', '45ce6f827330b6aa', '2013-11-09 15:51:17'),
(4, 'katie', '', '', '2013-11-12 19:56:40'),
(5, 'gerard', '', '', '2013-11-12 19:56:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_kategorija`
--

CREATE TABLE IF NOT EXISTS `user_kategorija` (
  `id_user` int(11) NOT NULL,
  `id_kategorija` int(11) NOT NULL,
  KEY `id_user` (`id_user`),
  KEY `id_kategorija` (`id_kategorija`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_kategorija`
--

INSERT INTO `user_kategorija` (`id_user`, `id_kategorija`) VALUES
(1, 1),
(2, 2),
(3, 1),
(4, 2),
(5, 2);

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
(5, 'Zarko Lausevic', 1, '5555-888', 'zare@lausevic.com', '1968', 'Beograd');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `upload`
--
ALTER TABLE `upload`
  ADD CONSTRAINT `f_key` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `upload_like`
--
ALTER TABLE `upload_like`
  ADD CONSTRAINT `f_key_upload` FOREIGN KEY (`id_upload`) REFERENCES `upload` (`id_upload`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `f_key_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_kategorija`
--
ALTER TABLE `user_kategorija`
  ADD CONSTRAINT `f_key_kat` FOREIGN KEY (`id_kategorija`) REFERENCES `kategorija` (`id_kategorija`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `f_key_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_opis`
--
ALTER TABLE `user_opis`
  ADD CONSTRAINT `f_key_user2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
