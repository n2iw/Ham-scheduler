-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2014 at 04:09 AM
-- Server version: 5.6.13
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `W1AW_2_2014`
--

-- --------------------------------------------------------

--
-- Table structure for table `band`
--

CREATE TABLE IF NOT EXISTS `band` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `band` varchar(20) NOT NULL,
  `AM` tinyint(1) NOT NULL DEFAULT '0',
  `FM` tinyint(1) NOT NULL DEFAULT '0',
  `no_phone` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`band`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `band`
--

INSERT INTO `band` (`id`, `band`, `AM`, `FM`, `no_phone`) VALUES
(1, '160m', 0, 0, 0),
(2, '80m', 1, 0, 0),
(3, '40m', 0, 0, 0),
(4, '30m', 0, 0, 1),
(5, '20m', 0, 0, 0),
(6, '17m', 0, 0, 0),
(7, '15m', 0, 0, 0),
(8, '12m', 0, 0, 0),
(9, '10m', 0, 1, 0),
(10, '6m', 0, 1, 0),
(11, '2m', 0, 1, 0),
(12, '1.25m', 0, 1, 0),
(13, '70cm', 0, 1, 0),
(14, '33cm&up', 0, 1, 0),
(15, 'Satellites', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `band_mode`
--

CREATE TABLE IF NOT EXISTS `band_mode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `band` int(11) NOT NULL,
  `mode` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `band` (`band`,`mode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `band_mode`
--

INSERT INTO `band_mode` (`id`, `band`, `mode`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 6),
(4, 1, 7),
(5, 2, 1),
(6, 2, 3),
(61, 2, 4),
(7, 2, 6),
(8, 2, 7),
(9, 3, 1),
(10, 3, 2),
(11, 3, 6),
(12, 3, 7),
(13, 4, 1),
(15, 4, 6),
(16, 4, 7),
(17, 5, 1),
(18, 5, 2),
(19, 5, 6),
(20, 5, 7),
(21, 6, 1),
(22, 6, 2),
(23, 6, 6),
(24, 6, 7),
(25, 7, 1),
(26, 7, 2),
(27, 7, 6),
(28, 7, 7),
(29, 8, 1),
(30, 8, 2),
(31, 8, 6),
(32, 8, 7),
(33, 9, 1),
(34, 9, 3),
(62, 9, 5),
(35, 9, 6),
(36, 9, 7),
(37, 10, 1),
(38, 10, 3),
(63, 10, 5),
(39, 10, 6),
(40, 10, 7),
(41, 11, 1),
(42, 11, 3),
(64, 11, 5),
(43, 11, 6),
(44, 11, 7),
(45, 12, 1),
(46, 12, 3),
(65, 12, 5),
(47, 12, 6),
(48, 12, 7),
(49, 13, 1),
(50, 13, 3),
(66, 13, 5),
(51, 13, 6),
(52, 13, 7),
(53, 14, 1),
(54, 14, 3),
(67, 14, 5),
(55, 14, 6),
(56, 14, 7),
(57, 15, 1),
(58, 15, 3),
(68, 15, 5),
(59, 15, 6),
(60, 15, 7);

-- --------------------------------------------------------

--
-- Table structure for table `mode`
--

CREATE TABLE IF NOT EXISTS `mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` varchar(10) NOT NULL,
  `sub_mode` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mode`
--

INSERT INTO `mode` (`id`, `mode`, `sub_mode`) VALUES
(1, 'CW', 0),
(2, 'Phone', 0),
(3, 'SSB', 1),
(4, 'AM', 1),
(5, 'FM', 1),
(6, 'RTTY', 0),
(7, 'PSK31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `op`
--

CREATE TABLE IF NOT EXISTS `op` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `callsign` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0:read-only, 1:normal, 2:admin',
  PRIMARY KEY (`id`),
  UNIQUE KEY `call` (`callsign`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `op`
--

INSERT INTO `op` (`id`, `callsign`, `name`, `email`, `phone`, `password`, `privilege`) VALUES
(0, '', 'None', 'None', '', '', 0),
(2, 'N2IW', 'James Ying', 'n2iw@arrl.net', '585-555-5555', '$1$3NkieKGY$9mcOX1rlliVSB.cpkvth01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `slot`
--

CREATE TABLE IF NOT EXISTS `slot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `startTime` int(4) unsigned zerofill NOT NULL,
  `band` int(11) NOT NULL,
  `mode` varchar(10) NOT NULL,
  `op` int(11) NOT NULL,
  `endTime` int(4) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`,`startTime`,`band`,`mode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
