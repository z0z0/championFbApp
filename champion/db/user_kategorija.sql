-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2013 at 10:30 PM
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
(5, 2),
(6, 2),
(7, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_kategorija`
--
ALTER TABLE `user_kategorija`
  ADD CONSTRAINT `f_key_kat` FOREIGN KEY (`id_kategorija`) REFERENCES `kategorija` (`id_kategorija`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `f_key_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
