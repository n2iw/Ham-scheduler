-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2014 at 08:34 PM
-- Server version: 5.6.17
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `w1aw2`
--

-- --------------------------------------------------------

--
-- Table structure for table `slot`
--

CREATE TABLE IF NOT EXISTS `slot` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `startTime` int(4) unsigned zerofill NOT NULL,
  `band` int(11) unsigned NOT NULL,
  `mode` int(11) unsigned NOT NULL,
  `op` int(11) unsigned NOT NULL,
  `endTime` int(4) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`,`startTime`,`band`,`mode`),
  KEY `op` (`op`),
  KEY `band` (`band`),
  KEY `mode` (`mode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5629 ;

--
-- Constraints for table `slot`
--

ALTER TABLE `slot`
  ADD CONSTRAINT `slot_mode_id` FOREIGN KEY (`mode`) REFERENCES `mode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `op_id` FOREIGN KEY (`op`) REFERENCES `op` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `slot_band_id` FOREIGN KEY (`band`) REFERENCES `band` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
