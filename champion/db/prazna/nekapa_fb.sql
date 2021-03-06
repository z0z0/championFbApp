-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2013 at 01:07 PM
-- Server version: 5.5.32-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nekapa_fb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`nekapa`@`localhost` PROCEDURE `user_insert`(IN `p_fb_id` TEXT, IN `p_ime_prezime` TEXT, IN `p_email` TEXT, IN `p_telefon` TEXT, IN `p_godiste` TEXT, IN `p_grad` TEXT, IN `p_pol` INT, IN `p_slika1` TEXT, IN `p_slika2` TEXT)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `upload_like`
--

CREATE TABLE IF NOT EXISTS `upload_like` (
  `id_upload` int(11) NOT NULL,
  `fb_id` text NOT NULL,
  UNIQUE KEY `unique_user_upload` (`id_upload`,`fb_id`(20)),
  KEY `fb_id` (`fb_id`(20))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id_user`),
  KEY `c_fb_id` (`fb_id`(20))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `user_opis`
--

CREATE TABLE IF NOT EXISTS `user_opis` (
  `id_user` int(11) NOT NULL,
  `ime_prezime` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `pol` varchar(11) DEFAULT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `godiste` text NOT NULL,
  `grad` text NOT NULL,
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD CONSTRAINT `f_key_upload` FOREIGN KEY (`id_upload`) REFERENCES `upload` (`id_upload`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
         