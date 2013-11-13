-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2013 at 02:30 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_insert`(IN `p_fb_id` TEXT, IN `p_ime_prezime` TEXT, IN `p_email` TEXT, IN `p_telefon` TEXT, IN `p_godiste` TEXT, IN `p_grad` TEXT, IN `p_pol` INT, IN `p_slika1` TEXT, IN `p_slika2` TEXT)
BEGIN
DECLARE p_id_user INT DEFAULT 0;
DECLARE EXIT HANDLER FOR SQLEXCEPTION 
BEGIN 
      ROLLBACK;
 END;

 START TRANSACTION;

 


   
   INSERT INTO user (fb_id)
   VALUES (p_fb_id);

	SELECT id_user INTO p_id_user
	FROM user
	WHERE fb_id = p_fb_id;

   INSERT INTO user_opis (id_user,ime_prezime,email,telefon,godiste,grad,pol)
   VALUES (p_id_user,p_ime_prezime,p_email,p_telefon,p_godiste,p_grad,p_pol);

   INSERT INTO user_kategorija (id_user,id_kategorija)
   VALUES (p_id_user,2);


   INSERT INTO upload (id_user,slika1,slika2 )
   VALUES (p_id_user,p_slika1,p_slika2);

 COMMIT;
   END$$

DELIMITER ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id_upload`, `id_user`, `slika1`, `slika2`, `vreme`, `f_odobreno`) VALUES
(1, 4, '../gallery/uploads/4/2.jpg', '../gallery/uploads/4/1.jpg', '2013-11-12 20:02:26', 1),
(2, 6, '../files/6/1.jpg', '../files/6/2.jpg', '2013-11-12 21:57:18', 0),
(3, 7, '..files/7/1.jpg', '..files/7/2.jpg', '2013-11-12 22:14:20', 0),
(4, 8, '..files/8/1.jpg', '..files/8/2.jpg', '2013-11-12 23:18:00', 0),
(6, 9, 'gallery%2Fuploads%2F5282d612ada6a.jpg', 'gallery%2Fuploads%2F5282d61821c20.jpeg', '2013-11-13 02:29:25', 0);

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
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `fb_id` text,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fb_id`, `username`, `password`, `salt`, `last_login`) VALUES
(1, '', 'admin1', 'admin', '', '2013-11-07 23:00:00'),
(2, '', 'test_user', 'test', '', '2013-11-08 20:34:53'),
(3, '', 'admin', 'cc74ad98f4429531b5566c743f80f1b2b2ab6293141f2d27039cf6a5d50e67ac', '45ce6f827330b6aa', '2013-11-12 19:21:56'),
(4, '', 'katie', '', '', '2013-11-12 19:56:40'),
(5, '', 'gerard', '', '', '2013-11-12 19:56:40'),
(6, '', '', '', '', '2013-11-12 21:57:18'),
(7, '', '', '', '', '2013-11-12 22:14:20'),
(8, '', '', '', '', '2013-11-12 23:18:00'),
(9, '100006932083500', '', '', '', '2013-11-13 02:29:25');

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
(7, 2),
(8, 2),
(9, 2);

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
(7, 'La Linea', 1, '2222-2222', 'la@linea.com', '1983', 'bEOGRAD'),
(8, 'Majko Radiliovo', 1, '2222-2222', 'la@linea.com', '1983', 'bEOGRAD'),
(9, 'Uros', 1, '123', 'uavramovic@40yahoo.c', '1988', 'Semendria');

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
