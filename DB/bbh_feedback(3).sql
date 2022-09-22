-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2014 at 04:58 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bbh_feedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `answer` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `status`) VALUES
(1, 'Other', 0),
(2, 'Excellent', 1),
(3, 'Good', 1),
(4, 'Average', 1),
(5, 'Poor', 1),
(6, 'Very Poor', 1),
(7, 'No Wait', 1),
(8, 'Within 10min', 1),
(9, '30 Min', 1),
(10, '30-60 Min', 1),
(11, 'More than 60 Min', 1),
(12, 'Yes', 1),
(13, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks_1`
--

CREATE TABLE IF NOT EXISTS `feedbacks_1` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `2` int(11) NOT NULL,
  `3` int(11) NOT NULL,
  `4` int(11) NOT NULL,
  `5` int(11) NOT NULL,
  `6` int(11) NOT NULL,
  `7` int(11) NOT NULL,
  `8` int(11) NOT NULL,
  `9` int(11) NOT NULL,
  `10` int(11) NOT NULL,
  `11` int(11) NOT NULL,
  `12` int(11) NOT NULL,
  `14` int(11) NOT NULL,
  `15` int(11) NOT NULL,
  `17` int(11) NOT NULL,
  `18` int(11) NOT NULL,
  `19` int(11) NOT NULL,
  `20` int(11) NOT NULL,
  `21` int(11) NOT NULL,
  `22` int(11) NOT NULL,
  `23` int(11) NOT NULL,
  `24` int(11) NOT NULL,
  `25` int(11) NOT NULL,
  `26` int(11) NOT NULL,
  `27` int(11) NOT NULL,
  `30` int(11) NOT NULL,
  `31` int(11) NOT NULL,
  `32` int(11) NOT NULL,
  `33` int(11) NOT NULL,
  `34` int(11) NOT NULL,
  `35` int(11) NOT NULL,
  `36` int(11) NOT NULL,
  `37` int(11) NOT NULL,
  `38` int(11) NOT NULL,
  `39` int(11) NOT NULL,
  `40` int(11) NOT NULL,
  `42` int(11) NOT NULL,
  `43` int(11) NOT NULL,
  `44` int(11) NOT NULL,
  `45` int(11) NOT NULL,
  `46` int(11) NOT NULL,
  `47` int(11) NOT NULL,
  `48` int(11) NOT NULL,
  `49` int(11) NOT NULL,
  `50` int(11) NOT NULL,
  `52` int(11) NOT NULL,
  `54` int(11) NOT NULL,
  `57` int(11) NOT NULL,
  `58` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `feedbacks_1`
--

INSERT INTO `feedbacks_1` (`id`, `patient_id`, `date_time`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `14`, `15`, `17`, `18`, `19`, `20`, `21`, `22`, `23`, `24`, `25`, `26`, `27`, `30`, `31`, `32`, `33`, `34`, `35`, `36`, `37`, `38`, `39`, `40`, `42`, `43`, `44`, `45`, `46`, `47`, `48`, `49`, `50`, `52`, `54`, `57`, `58`) VALUES
(1, 2, '2014-11-11 18:58:35', 2, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0),
(2, 2, '2014-11-11 20:12:32', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 2, '2014-11-11 20:27:41', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 2, '2014-11-11 20:30:33', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 2, '2014-11-11 20:32:25', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 2, '2014-11-11 20:36:59', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 2, '2014-11-11 20:40:15', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0),
(8, 2, '2014-11-11 20:46:20', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 2, '2014-11-11 20:48:35', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 2, '2014-11-11 20:48:35', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 2, '2014-11-11 23:03:28', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 2, '2014-11-11 23:10:52', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0),
(13, 2, '2014-11-11 23:12:04', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 2, '2014-11-11 23:12:35', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 2, '2014-11-11 23:28:51', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 2, '2014-11-11 23:30:59', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 2, '2014-11-11 23:32:25', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 2, '2014-11-11 23:37:36', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(19, 2, '2014-11-11 23:39:21', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(20, 2, '2014-11-11 23:40:19', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(21, 2, '2014-11-11 23:59:05', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(22, 2, '2014-11-11 23:59:51', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(23, 2, '2014-11-11 23:59:51', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(24, 2, '2014-11-12 10:17:46', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 7, 7, 7, 7, 7, 7, 7, 7, 7, 2, 12, 1, 0),
(25, 2, '2014-11-12 10:21:03', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks_comments`
--

CREATE TABLE IF NOT EXISTS `feedbacks_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `feedback_id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `feedbacks_comments`
--

INSERT INTO `feedbacks_comments` (`id`, `group_id`, `feedback_id`, `question_id`, `comments`) VALUES
(1, 1, 23, 14, 'eeee'),
(2, 1, 23, 57, 'wwwwwwww'),
(3, 1, 24, 14, 'test'),
(4, 1, 24, 57, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_reviews`
--

CREATE TABLE IF NOT EXISTS `feedback_reviews` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `groups_id` bigint(20) NOT NULL,
  `patient_id` bigint(20) NOT NULL,
  `reviewer_id` bigint(20) NOT NULL,
  `ticket_id` bigint(20) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `feedbacks_id` (`groups_id`),
  KEY `feedbacks_id_2` (`groups_id`),
  KEY `feedbacks_id_3` (`groups_id`),
  KEY `groups_id` (`groups_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `feedback_reviews`
--

INSERT INTO `feedback_reviews` (`id`, `groups_id`, `patient_id`, `reviewer_id`, `ticket_id`, `date_time`) VALUES
(1, 1, 1, 1, 1, '2014-11-11 18:49:43'),
(2, 1, 2, 1, 1, '2014-11-11 18:50:24'),
(3, 1, 3, 1, 1, '2014-11-11 18:50:42'),
(4, 1, 4, 2, 1, '2014-11-12 04:52:27'),
(5, 1, 5, 2, 0, '2014-11-12 04:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `status`) VALUES
(1, 'DEPT1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) NOT NULL,
  `patient_id` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `contact` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hospital_no` varchar(25) NOT NULL,
  `private_or_general` tinyint(4) NOT NULL,
  `service_available_department` varchar(25) NOT NULL,
  `date_time` datetime NOT NULL,
  `visit_date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `group_id`, `patient_id`, `name`, `contact`, `email`, `hospital_no`, `private_or_general`, `service_available_department`, `date_time`, `visit_date_time`) VALUES
(1, 1, '2', 'pentamine', '33', '33', '4444', 0, '33', '2014-08-18 19:22:12', '0000-00-00 00:00:00'),
(2, 1, '2', 'ghjgh', '56756', 'gjghjgh@hjhj', '65765', 0, 'gh', '2014-08-22 16:17:59', '0000-00-00 00:00:00'),
(3, 1, '2', 'fgfg', '56456456', 'nghjgh', '5645', 0, 'jhgh', '2014-08-22 16:18:52', '0000-00-00 00:00:00'),
(4, 1, '2', '', '', '', '', 0, '', '2014-08-22 17:18:20', '0000-00-00 00:00:00'),
(5, 1, '2', 'rrrrrrrrrr', '45456546', 'rrrrrrrrrrr', '5444444', 0, 'rrrrrrrrrrrrr', '2014-08-22 17:26:50', '2014-08-22 00:00:00'),
(6, 1, '2', 'BBH', '9900320715', 'karthi', '123', 0, 'cser@gmail', '2014-10-20 09:40:08', '0000-00-00 00:00:00'),
(7, 1, '2', 'test', '1123', 'karthi', '1233456', 0, 'cserp@yahoo', '2014-11-10 16:52:05', '0000-00-00 00:00:00'),
(8, 1, '2', '', '', '', '', 0, '', '2014-11-10 16:54:23', '0000-00-00 00:00:00'),
(9, 1, '2', '', '', '', '', 0, '', '2014-11-10 16:54:30', '0000-00-00 00:00:00'),
(10, 1, '2', '', '', '', '', 0, '', '2014-11-10 16:54:30', '0000-00-00 00:00:00'),
(11, 1, '2', '', '', '', '', 0, '', '2014-11-10 17:18:22', '0000-00-00 00:00:00'),
(12, 1, '2', '', '', '', '', 0, '', '2014-11-11 12:11:46', '0000-00-00 00:00:00'),
(13, 1, '2', '', '', '', '', 0, '', '2014-11-11 12:24:40', '0000-00-00 00:00:00'),
(14, 1, '2', '', '', '', '', 0, '', '2014-11-11 12:29:31', '0000-00-00 00:00:00'),
(15, 1, '2', '', '', '', '', 0, '', '2014-11-11 12:32:13', '0000-00-00 00:00:00'),
(16, 1, '2', '', '', '', '', 0, '', '2014-11-11 12:38:11', '0000-00-00 00:00:00'),
(17, 1, '2', '', '', '', '', 0, '', '2014-11-11 12:38:35', '0000-00-00 00:00:00'),
(18, 1, '2', '', '', '', '', 0, '', '2014-11-11 12:44:56', '0000-00-00 00:00:00'),
(19, 1, '2', '', '', '', '', 0, '', '2014-11-11 12:46:26', '0000-00-00 00:00:00'),
(20, 1, '2', 'gwhjf', '3434', 'karthi', '4444', 0, 'cser@gmail', '2014-11-11 12:46:26', '0000-00-00 00:00:00'),
(21, 1, '2', 'dwded', '22', 'karthi', '322', 0, 'cser@gmail', '2014-11-11 12:47:36', '0000-00-00 00:00:00'),
(22, 1, '2', 'qqqqqqqqqqqqq', '222', 'karthi', '2222', 0, 'cser@gmail', '2014-11-11 12:47:36', '0000-00-00 00:00:00'),
(23, 1, '2', 'pentamine', '3333', 'karthi', '3333', 0, 'cser@gmail', '2014-11-11 12:51:10', '0000-00-00 00:00:00'),
(24, 1, '2', '', '', '', '', 0, '', '2014-11-11 12:51:10', '0000-00-00 00:00:00'),
(25, 1, '2', '', '', '', '', 0, '', '2014-11-11 13:13:11', '0000-00-00 00:00:00'),
(26, 1, '2', 'pentamine', '2432', 'karthi', '234234', 0, 'cser@gmail', '2014-11-11 13:16:23', '0000-00-00 00:00:00'),
(27, 1, '2', '', '', '', '', 0, '', '2014-11-11 13:16:23', '0000-00-00 00:00:00'),
(28, 1, '2', '', '', '', '', 0, '', '2014-11-11 13:22:46', '0000-00-00 00:00:00'),
(29, 1, '2', 'erwtewr', '35435', 'karthi', '32424', 0, 'cser@gmail', '2014-11-11 13:25:31', '0000-00-00 00:00:00'),
(30, 1, '2', 'dfsasdf', '34535', 'karthi', '435245', 0, 'cser@gmail', '2014-11-11 13:28:28', '0000-00-00 00:00:00'),
(31, 0, '1', '', '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 1, '2', 'wrrwe', '543345', 'karthi', '34', 0, 'cser@gmail', '2014-11-11 14:21:52', '0000-00-00 00:00:00'),
(33, 1, '2', 'wrrwe', '543345', 'karthi', '34', 0, 'cser@gmail', '2014-11-11 14:21:52', '0000-00-00 00:00:00'),
(34, 1, '2', '', '', '', '', 0, '', '2014-11-11 14:26:07', '0000-00-00 00:00:00'),
(35, 1, '2', 'pentamine', '444444444', 'karthi', '3424343434', 0, 'cser@gmail', '2014-11-11 14:29:42', '0000-00-00 00:00:00'),
(36, 1, '2', 'frwe', '4444', 'karthi', '54', 0, 'cser@gmail', '2014-11-11 14:36:48', '0000-00-00 00:00:00'),
(37, 1, '2', 'errr', '45444', 'karthi', '4', 0, 'cser@gmail', '2014-11-11 14:38:38', '0000-00-00 00:00:00'),
(38, 1, '2', 'pentamine', '2322', 'karthi', '444444', 0, 'cser@gmail', '2014-11-11 14:39:39', '0000-00-00 00:00:00'),
(39, 1, '2', 'DEPT', '4333', 'karthi', '555', 0, 'cser@gmail', '2014-11-11 14:41:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `Id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  `ownerEl` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'parent',
  `slave` binary(1) NOT NULL DEFAULT '0',
  `option_ids` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=58 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`Id`, `group_id`, `name`, `position`, `ownerEl`, `slave`, `option_ids`, `status`) VALUES
(1, 1, 'How would you rate the following staff? Were they able to explain everything clearly to your satisfaction,give accurate information,check with you whether you have any doubts and offered help if you have any queries later?', 1, 0, '0', '1,2,3,4,5,6', 1),
(2, 1, 'Registration Staff', 0, 1, '1', '', 1),
(3, 1, 'Guest relations Staff', 1, 1, '1', '', 1),
(4, 1, 'Doctors', 2, 1, '1', '', 1),
(5, 1, 'Nurses', 3, 1, '1', '', 1),
(6, 1, 'Lab Technicians', 4, 1, '1', '', 1),
(7, 1, 'Radiology Technicians(USG/CT Scan/X-ray/ECG/Endoscopy)', 5, 1, '1', '', 1),
(8, 1, 'Pharmacy Staff', 6, 1, '1', '', 1),
(9, 1, 'Dietary Staff(Dietician/Serving boys)', 7, 1, '1', '', 1),
(10, 1, 'Security Staff', 8, 1, '1', '', 1),
(11, 1, 'Billing Staff(Cash counter/Re-imbursement)', 9, 1, '1', '', 1),
(12, 1, 'Corporate Staff', 10, 1, '1', '', 1),
(13, 1, 'How would you rate the environment within the hospital with regard to cleanliness, quietness, safety and signage?', 0, 0, '0', '1,2,3,4,5,6', 1),
(14, 1, 'Common area', 0, 13, '1', '', 1),
(15, 1, 'Toilets', 1, 13, '1', '', 1),
(16, 1, 'Were the following staff  approachable,respectful,cordial,willing to listen,explaining things in a way you could understand and polite during their interaction', 3, 0, '0', '2,3,4,5,6', 1),
(17, 1, 'Registration Staff', 0, 16, '1', '', 1),
(18, 1, 'Guest relations Staff', 1, 16, '1', '', 1),
(19, 1, 'Doctors', 2, 16, '1', '', 1),
(20, 1, 'Nurses', 3, 16, '1', '', 1),
(21, 1, 'Lab Technicians', 4, 16, '1', '', 1),
(22, 1, 'Radiology Technicians(USG/CT scan/X-ray/ECG/Endoscopy)', 5, 16, '1', '', 1),
(23, 1, 'Pharmacy Staff', 6, 16, '1', '', 1),
(24, 1, 'Dietary staff(Dietician/serving boys)', 7, 16, '1', '', 1),
(25, 1, 'Security Staff', 8, 16, '1', '', 1),
(26, 1, 'Billing Staff(Cash counter/Re-imbursement)', 9, 16, '1', '', 1),
(27, 1, 'Corporate Staff', 10, 16, '1', '', 1),
(28, 1, 'How would you rate the way you were treated with regard to respect,dignity and privacy?&please specify the department if your response is anything other than good?', 2, 0, '0', '2,3,4,5,6', 1),
(29, 1, 'How would you rate our service in terms of errors,mistakes,unclear or inaccurate documentation with respect to the following?', 4, 0, '0', '2,3,4,5,6', 1),
(30, 1, 'How would you rate the way you were treated with regard to respect,dignity and privacy?&please specify the department if your response is anything other than good?', 0, 28, '1', '', 1),
(31, 1, 'Medical Records', 0, 29, '1', '', 1),
(32, 1, 'Doctors', 1, 29, '1', '', 1),
(33, 1, 'Nurses', 2, 29, '1', '', 1),
(34, 1, 'Laboratory Testing/Reports', 3, 29, '1', '', 1),
(35, 1, 'Radiology Testing/Reports', 4, 29, '1', '', 1),
(36, 1, 'Pharmacy', 5, 29, '1', '', 1),
(37, 1, 'Dietary(Dietician/Serving boys)', 6, 29, '1', '', 1),
(38, 1, 'Discharge', 7, 29, '1', '', 1),
(39, 1, 'Billing(Cash counter/IP Billiing/Re-imbursement)', 8, 29, '1', '', 1),
(40, 1, 'Corporate', 9, 29, '1', '', 1),
(41, 1, 'How would you rate your service delivery with respect to wait times(in minutes) with the following?', 5, 0, '0', '7,8,9,10,11', 1),
(42, 1, 'Discharge Process', 0, 41, '1', '', 1),
(43, 1, 'Doctors', 1, 41, '1', '', 1),
(44, 1, 'Nurses', 2, 41, '1', '', 1),
(45, 1, 'Laboratory Testing/Reports', 3, 41, '1', '', 1),
(46, 1, 'Radiiology Testing/Repots', 4, 41, '1', '', 1),
(47, 1, 'Pharmacy', 5, 41, '1', '', 1),
(48, 1, 'Dietary(Counselling/Canteen)', 6, 41, '1', '', 1),
(49, 1, 'Billing(Cash counter/IP Billing/Re-imbursement)', 7, 41, '1', '', 1),
(50, 1, 'Corporate', 8, 41, '1', '', 1),
(51, 1, 'How would you rate your overall experience at BBH?', 6, 0, '0', '2,3,4,5,6', 1),
(52, 1, 'How would you rate your overall experience at BBH?', 0, 51, '1', '', 1),
(53, 1, 'How would you come back to us or recommend this hospital to your family and friends if need arise?', 7, 0, '0', '12,13', 1),
(54, 1, 'How would you come back to us or recommend this hospital to your family and friends if need arise?', 0, 53, '1', '', 1),
(55, 2, 'test', 8, 0, '0', '', 1),
(56, 2, 'test2', 9, 0, '0', '', 1),
(57, 1, 'test', 2, 13, '1', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone_number` bigint(10) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_role_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_role_id` (`user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `phone_number`, `user_name`, `password`, `user_role_id`) VALUES
(1, 'Pentamine', 'Bangalore', 1234567891, 'pentamine', 'admin@bbh', 1),
(2, 'Admin', 'Admin', 1234567891, 'admin', 'admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Super Admin'),
(2, 'Admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback_reviews`
--
ALTER TABLE `feedback_reviews`
  ADD CONSTRAINT `feedback_reviews_ibfk_1` FOREIGN KEY (`groups_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
