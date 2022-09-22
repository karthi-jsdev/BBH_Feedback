-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2014 at 06:53 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bbh_feedback1`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `answer` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `color` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `status`, `color`) VALUES
(1, 'NA', 1, ''),
(2, 'Excellent', 1, ''),
(3, 'Good', 1, ''),
(4, 'Average', 1, ''),
(5, 'Poor', 1, ''),
(6, 'Very Poor', 1, '#FF0829'),
(7, 'No Wait', 1, '#FFAB57'),
(8, 'Within 10min', 1, '#66FF7A'),
(9, '30 Min', 1, ''),
(10, '30-60 Min', 1, ''),
(11, 'More than 60 Min', 1, ''),
(12, 'Yes', 1, ''),
(13, 'No', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `survey_id` varchar(25) NOT NULL,
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
  `survey_id` varchar(25) NOT NULL,
  `date_time` datetime NOT NULL,
  `1` int(11) NOT NULL,
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
  `13` int(11) NOT NULL,
  `14` int(11) NOT NULL,
  `15` int(11) NOT NULL,
  `16` int(11) NOT NULL,
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
  `28` int(11) NOT NULL,
  `29` int(11) NOT NULL,
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
  `41` int(11) NOT NULL,
  `42` int(11) NOT NULL,
  `43` int(11) NOT NULL,
  `44` int(11) NOT NULL,
  `45` int(11) NOT NULL,
  `46` int(11) NOT NULL,
  `47` int(11) NOT NULL,
  `48` int(11) NOT NULL,
  `49` int(11) NOT NULL,
  `50` int(11) NOT NULL,
  `51` int(11) NOT NULL,
  `52` int(11) NOT NULL,
  `53` int(11) NOT NULL,
  `54` int(11) NOT NULL,
  `55` int(11) NOT NULL,
  `56` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feedbacks_1`
--

INSERT INTO `feedbacks_1` (`id`, `patient_id`, `survey_id`, `date_time`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, `21`, `22`, `23`, `24`, `25`, `26`, `27`, `28`, `29`, `30`, `31`, `32`, `33`, `34`, `35`, `36`, `37`, `38`, `39`, `40`, `41`, `42`, `43`, `44`, `45`, `46`, `47`, `48`, `49`, `50`, `51`, `52`, `53`, `54`, `55`, `56`) VALUES
(1, 1, 'Surv1_000000000', '2014-11-30 13:01:17', 0, 2, 3, 4, 5, 6, 5, 4, 3, 2, 3, 4, 0, 4, 2, 0, 2, 3, 4, 5, 6, 5, 4, 3, 2, 3, 4, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 11, 10, 9, 8, 7, 8, 9, 10, 11, 0, 2, 0, 12, 0, 0),
(2, 1, 'Surv1_0000000002', '2014-12-03 11:13:15', 0, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 0, 2, 2, 0, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 7, 8, 8, 9, 9, 10, 10, 11, 0, 2, 0, 12, 0, 0),
(3, 7, 'Surv1_0000000003', '2014-12-03 12:19:18', 0, 2, 3, 4, 5, 6, 5, 4, 3, 2, 3, 4, 0, 6, 3, 0, 2, 3, 4, 5, 6, 5, 4, 3, 2, 3, 4, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 8, 9, 10, 11, 10, 9, 8, 7, 0, 4, 0, 12, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `feedbacks_comments`
--

INSERT INTO `feedbacks_comments` (`id`, `group_id`, `feedback_id`, `question_id`, `comments`) VALUES
(1, 1, 1, 2, 'queries queries '),
(2, 1, 1, 3, 'queries queries '),
(3, 1, 1, 4, 'queries queries '),
(4, 1, 1, 5, 'queries queries '),
(5, 1, 1, 6, 'queries queries '),
(6, 1, 1, 7, 'queries queries '),
(7, 1, 1, 8, 'queries queries '),
(8, 1, 1, 9, 'queries queries '),
(9, 1, 1, 10, 'queries queries '),
(10, 1, 1, 11, 'queries queries '),
(11, 1, 1, 12, 'queries queries queries '),
(12, 1, 1, 14, 'queries queries queries '),
(13, 1, 1, 15, 'queries queries queries '),
(14, 1, 1, 17, 'explaining explaining '),
(15, 1, 1, 18, 'explaining '),
(16, 1, 1, 19, 'explaining '),
(17, 1, 1, 20, 'explaining explaining explaining '),
(18, 1, 1, 21, 'explaining explaining explaining '),
(19, 1, 1, 22, 'n a way you cou'),
(20, 1, 1, 23, 'n a way you cou'),
(21, 1, 1, 24, 'n a way you cou'),
(22, 1, 1, 25, 'n a way you coun a way you cou'),
(23, 1, 1, 26, 'n a way you cou'),
(24, 1, 1, 27, 'n a way you cou'),
(25, 1, 1, 31, 'unclear or inaccurate'),
(26, 1, 1, 32, 'unclear or inaccurate'),
(27, 1, 1, 33, 'unclear or inaccurate'),
(28, 1, 1, 34, 'unclear or inaccurate'),
(29, 1, 1, 35, 'unclear or inaccurate'),
(30, 1, 1, 36, 'unclear or inaccurate'),
(31, 1, 1, 37, 'unclear or inaccurate'),
(32, 1, 1, 38, 'unclear or inaccurate'),
(33, 1, 1, 39, 'unclear or inaccurate'),
(34, 1, 1, 40, 'unclear or inaccurate'),
(35, 1, 1, 42, 'it times(in minutes) with the foll'),
(36, 1, 1, 43, 'it times(in minutes) with the foll'),
(37, 1, 1, 44, 'it times(in minutes) with the foll'),
(38, 1, 1, 45, 'it times(in minutes) with the foll'),
(39, 1, 1, 46, 'it times(in minutes) with the foll'),
(40, 1, 1, 47, 'it times(in minutes) with the foll'),
(41, 1, 1, 48, 'it times(in minutes) with the foll'),
(42, 1, 1, 49, 'it times(in minutes) with the foll'),
(43, 1, 1, 50, 'it times(in minutes) with the foll'),
(44, 1, 1, 52, 'e your overall experience at BBH'),
(45, 1, 1, 54, 'e your overall experience at BBH'),
(46, 1, 1, 55, 'ou would like to appreciate any specific staff for their service Please mentou would like to appreciate any specific staff for their service Please mentou would like to appreciate any specific staff for their service Please ment'),
(47, 1, 1, 56, 'ou would like to appreciate any specific staff for their service Please mentou would like to appreciate any specific staff for their service Please mentou would like to appreciate any specific staff for their service Please mentou would like to appreciate any specific staff for their service Please mentou would like to appreciate any specific staff for their service Please ment'),
(48, 1, 2, 55, 'y specific staff for their service Please mentiony specific staff for their service Please mentiony specific staff for their service Please mentiony specific staff for their service Please mention'),
(49, 1, 3, 55, 'uld like to appreciate any specific staff for their service Please mentioned theuld like to appreciate any specific staff for their service Please mentioned theuld like to appreciate any specific staff for their service Please mentioned theuld like to appreciate any specific staff for their service Please mentioned the');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_reviews`
--

CREATE TABLE IF NOT EXISTS `feedback_reviews` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `groups_id` bigint(20) NOT NULL,
  `patient_id` bigint(20) NOT NULL,
  `feedbackid` int(25) NOT NULL,
  `reviewer_id` bigint(20) NOT NULL,
  `review_msg` varchar(300) NOT NULL,
  `review` bigint(20) NOT NULL,
  `ticket_id` bigint(20) NOT NULL,
  `ticket_msg` varchar(300) NOT NULL,
  `ticket_no` varchar(300) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `feedbacks_id` (`groups_id`),
  KEY `feedbacks_id_2` (`groups_id`),
  KEY `feedbacks_id_3` (`groups_id`),
  KEY `groups_id` (`groups_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `prefix` varchar(15) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `prefix`, `status`) VALUES
(1, 'SurveyCategory', 'Surv1', 1),
(3, 'Pentamine', 'sdf', 1);

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
  `private_or_general` varchar(25) NOT NULL,
  `service_available_department` varchar(25) NOT NULL,
  `date_time` datetime NOT NULL,
  `visit_date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `group_id`, `patient_id`, `name`, `contact`, `email`, `private_or_general`, `service_available_department`, `date_time`, `visit_date_time`) VALUES
(1, 1, '1', 'Pentamine', '2321312312', 'karthi.cserp@yahoo.conm', '0', 'general', '2014-11-30 13:01:17', '2014-11-11 00:00:00'),
(2, 2, '2', 'Pentamine', '32313131231', 'karthi.cserp@yahoo.conm', '0', 'sd', '2014-12-01 12:58:36', '2014-12-01 00:00:00'),
(3, 2, '23', 'Pentamine', '34324234234', 'karthi.cserp@yahoo.conm', '0', 'sfd', '2014-12-01 13:00:00', '2014-12-01 13:00:40'),
(4, 2, '123', 'eqwe', '123123123', 'karthi.cserp@yahoo.conm', '0', 'asd', '2014-12-01 13:04:14', '2014-12-03 00:00:00'),
(5, 2, '3', 'Pentamine', '424234234234', 'karthi.cserp@yahoo.conm', '0', 'rwe', '2014-12-01 13:48:12', '2014-12-01 00:00:00'),
(6, 2, '25', 'Pentamine', '123123123', 'karthi.cserp@yahoo.conm', '0', 'ads', '2014-12-01 14:12:04', '2014-12-01 00:00:00'),
(7, 1, '234', 'Pentamine', '23423423423', 'karthi.cserp@yahoo.conm', 'dasf', 'vsvxc', '2014-12-03 12:19:18', '2014-12-01 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=59 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`Id`, `group_id`, `name`, `position`, `ownerEl`, `slave`, `option_ids`, `status`) VALUES
(1, 1, 'How would you rate the following staff? Were they able to explain everything clearly to your satisfaction,give accurate information,check with you whether you have any doubts and offered help if you have any queries later?', 0, 0, '0', '2,3,4,5,6', 1),
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
(13, 1, 'How would you rate the environment within the hospital with regard to cleanliness, quietness, safety and signage?', 1, 0, '0', '2,3,4,5,6', 1),
(14, 1, 'Common area', 0, 13, '1', '', 1),
(15, 1, 'Toilets', 1, 13, '1', '', 1),
(16, 1, 'Were the following staff  approachable,respectful,cordial,willing to listen,explaining things in a way you could understand and polite during their interaction', 2, 0, '0', '2,3,4,5,6', 1),
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
(28, 1, 'How would you rate the way you were treated with regard to respect,dignity and privacy?', 3, 0, '0', '2,3,4,5,6', 1),
(29, 1, 'How would you rate the way you were treated with regard to respect,dignity and privacy?', 0, 28, '1', '', 1),
(30, 1, 'How would you rate our service in terms of errors,mistakes,unclear or inaccurate documentation with respect to the following?', 4, 0, '0', '', 1),
(31, 1, 'Medical Records', 0, 30, '1', '', 1),
(32, 1, 'Doctors', 1, 30, '1', '', 1),
(33, 1, 'Nurses', 2, 30, '1', '', 1),
(34, 1, 'Laboratory  Testing / Reports', 3, 30, '1', '', 1),
(35, 1, 'Radiology Testing / Reports', 4, 30, '1', '', 1),
(36, 1, 'Pharmacy', 5, 30, '1', '', 1),
(37, 1, 'Dietary(Dietician/Serving boys)', 6, 30, '1', '', 1),
(38, 1, 'Discharge', 7, 30, '1', '', 1),
(39, 1, 'Billing(Cash counter/IP Billiing/Re-imbursement)', 8, 30, '1', '', 1),
(40, 1, 'Corporate', 9, 30, '1', '', 1),
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
(51, 1, 'How would you rate your overall experience at BBH', 6, 0, '0', '2,3,4,5,6', 1),
(52, 1, 'How would you rate your overall experience at BBH?', 0, 51, '1', '', 1),
(53, 1, 'How would you come back to us or recommend this hospital to your family and friends if need arise?', 7, 0, '0', '12,13', 1),
(54, 1, 'How would you come back to us or recommend this hospital to your family and friends if need arise?', 0, 53, '1', '', 1),
(55, 1, 'If you would like to appreciate any specific staff for their service Please mentioned their name / dept:', 8, 0, '0', '', 1),
(56, 3, 'Please elaborate on any area of concern:', 9, 0, '0', '', 1);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
