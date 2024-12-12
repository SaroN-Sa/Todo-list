-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2024 at 06:19 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ephy`
--

-- --------------------------------------------------------

--
-- Table structure for table `alarms`
--

CREATE TABLE IF NOT EXISTS `alarms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `alarm_time` time NOT NULL,
  `notified` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `alarms`
--


-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Saron', 'Samuel', 'amuelsaron41@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Saron', 'Samuel', 'samuelsaron41@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'ephy', 'sam', 'efrem2016@gmail.com', '1d7b217127d82ea1eac7e3b92090a463'),
(4, 'ephyr', 'samue', 'ephy12@gmail.com', '02c75fb22c75b23dc963c7eb91a062cc');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` varchar(255) NOT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `status`, `created_at`) VALUES
(36, 'reding', 'pending', '2024-08-13 18:23:01'),
(37, 'askgjhqil', 'pending', '2024-08-13 21:15:33'),
(38, 'askgjhqil', 'pending', '2024-08-13 21:15:34'),
(39, 'askgjhqil', 'pending', '2024-08-13 21:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_sessions`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `alarms`
--
ALTER TABLE `alarms`
  ADD CONSTRAINT `alarms_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);
