-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2014 at 05:47 AM
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
  `color` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `status`, `color`) VALUES
(1, 'Other', 1, ''),
(2, 'Excellent', 1, ''),
(3, 'Good', 1, ''),
(4, 'Average', 1, ''),
(5, 'Poor', 1, ''),
(6, 'Very Poor', 1, ''),
(7, 'No Wait', 1, ''),
(8, 'Within 10min', 1, ''),
(9, '30 Min', 1, ''),
(10, '30-60 Min', 1, ''),
(11, 'More than 60 Min', 1, ''),
(12, 'Yes', 1, ''),
(13, 'No', 1, ''),
(14, 'NA', 1, '#FF2F0F');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks_2`
--

CREATE TABLE IF NOT EXISTS `feedbacks_2` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) NOT NULL,
  `survey_id` varchar(25) NOT NULL,
  `date_time` datetime NOT NULL,
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
  `57` int(11) NOT NULL,
  `58` int(11) NOT NULL,
  `59` int(11) NOT NULL,
  `60` int(11) NOT NULL,
  `61` int(11) NOT NULL,
  `62` int(11) NOT NULL,
  `63` int(11) NOT NULL,
  `64` int(11) NOT NULL,
  `65` int(11) NOT NULL,
  `66` int(11) NOT NULL,
  `67` int(11) NOT NULL,
  `68` int(11) NOT NULL,
  `69` int(11) NOT NULL,
  `70` int(11) NOT NULL,
  `71` int(11) NOT NULL,
  `72` int(11) NOT NULL,
  `73` int(11) NOT NULL,
  `74` int(11) NOT NULL,
  `75` int(11) NOT NULL,
  `76` int(11) NOT NULL,
  `77` int(11) NOT NULL,
  `78` int(11) NOT NULL,
  `79` int(11) NOT NULL,
  `80` int(11) NOT NULL,
  `81` int(11) NOT NULL,
  `82` int(11) NOT NULL,
  `83` int(11) NOT NULL,
  `84` int(11) NOT NULL,
  `85` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `prefix`, `status`) VALUES
(1, 'In-Patient', 'IN', 1),
(2, 'Out-Patient', 'OUT', 1);

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
  `private_or_general` varchar(15) NOT NULL,
  `service_available_department` varchar(25) NOT NULL,
  `date_time` datetime NOT NULL,
  `visit_date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=86 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`Id`, `group_id`, `name`, `position`, `ownerEl`, `slave`, `option_ids`, `status`) VALUES
(1, 1, 'How would you rate the following staff?  Were they able to explain everything clearly to your satisfaction, give accurate information, check with you whether you have any doubts and offered help if you have any queries later?', 0, 0, '0', '2,3,4,5,6,14', 1),
(2, 1, 'Registration Staff', 0, 1, '1', '', 1),
(3, 1, 'Admission Counter Staff', 1, 1, '1', '', 1),
(4, 1, 'Guest relations Staff', 2, 1, '1', '', 1),
(5, 1, 'Doctors', 3, 1, '1', '', 1),
(6, 1, 'Nurses', 4, 1, '1', '', 1),
(7, 1, 'Lab Technicians', 5, 1, '1', '', 1),
(8, 1, 'Radiology Technicians (USG/CT scan/X-ray/ECG/Endoscopy)', 6, 1, '1', '', 1),
(9, 1, 'Pharmacy Staff', 7, 1, '1', '', 1),
(10, 1, 'Dietary Staff (Dietician / Serving boys)', 8, 1, '1', '', 1),
(11, 1, 'Security Staff', 9, 1, '1', '', 1),
(12, 1, 'Billing Staff (Cash counter / IP Billing / Re-imbursement)', 10, 1, '1', '', 1),
(13, 1, 'Corporate Staff', 11, 1, '1', '', 1),
(14, 1, 'How would you rate the way you were treated with regard to respect, dignity and privacy?and please specify the department if your response is anything other than good? ', 1, 0, '0', '2,3,4,5,6,14', 1),
(15, 1, 'How would you rate the way you were treated with regard to respect, dignity and privacy?and please specify the department if your response is anything other than good? ', 0, 14, '1', '', 1),
(16, 1, 'Were the following staff approachable, respectful, cordial, willing to listen, explaining things in a way you could understand and polite during their interaction?', 2, 0, '0', '2,3,4,5,6,14', 1),
(17, 1, 'Registration Staff', 0, 16, '1', '', 1),
(18, 1, 'Admission Counter Staff', 1, 16, '1', '', 1),
(19, 1, 'Guest relations Staff', 2, 16, '1', '', 1),
(20, 1, 'Doctors', 3, 16, '1', '', 1),
(21, 1, 'Nurses', 4, 16, '1', '', 1),
(22, 1, 'Lab Technicians', 5, 16, '1', '', 1),
(23, 1, 'Radiology Technicians (USG/CT scan/X-ray/ECG/Endoscopy)', 6, 16, '1', '', 1),
(24, 1, 'Pharmacy Staff', 7, 16, '1', '', 1),
(25, 1, 'Dietary Staff (Dietician / Serving boys)', 8, 16, '1', '', 1),
(26, 1, 'Security Staff', 9, 16, '1', '', 1),
(27, 1, 'Billing Staff (Cash counter / IP Billing / Re-imbursement)', 10, 16, '1', '', 1),
(28, 1, 'Corporate Staff', 11, 16, '1', '', 1),
(29, 1, 'How would you rate the environment within the hospital with regard to cleanliness, quietness, safety, and signage?', 3, 0, '0', '2,3,4,5,6,14', 1),
(30, 1, 'Common area', 0, 29, '1', '', 1),
(31, 1, 'Toilets', 1, 29, '1', '', 1),
(32, 1, 'Rooms', 2, 29, '1', '', 1),
(33, 1, 'Linen', 3, 29, '1', '', 1),
(34, 1, 'During your visit to our hospital did you have an unfortunate experience of any error, mistake, unclear or inaccurate information / documentation? If yes, please specify the department and type of error.', 4, 0, '0', '12,13,14', 1),
(35, 1, 'During your visit to our hospital did you have an unfortunate experience of any error, mistake, unclear or inaccurate information / documentation? If yes, please specify the department and type of error.', 0, 34, '1', '', 1),
(36, 1, 'During your visit to our hospital did you have experience of delay in services?  If yes, please specify the department and the type of delay', 5, 0, '0', '12,13,14', 1),
(37, 1, 'During your visit to our hospital did you have experience of delay in services?  If yes, please specify the department and the type of delay', 0, 36, '1', '', 1),
(38, 1, 'How would you rate your overall experience at Bangalore Baptist Hospital? ', 6, 0, '0', '2,3,4,5,6,14', 1),
(39, 1, 'How would you rate your overall experience at Bangalore Baptist Hospital? ', 0, 38, '1', '', 1),
(40, 1, 'Would you come back to us or recommend this hospital to your family and friends if need arise? ', 7, 0, '0', '12,13,14', 1),
(41, 1, 'Would you come back to us or recommend this hospital to your family and friends if need arise? ', 0, 40, '1', '', 1),
(42, 1, 'If you would like to appreciate any specific staff for their service , Please mention their name and  dept:', 8, 0, '0', '', 1),
(43, 1, 'Please  elaborate on any area of concern:', 9, 0, '0', '', 1),
(44, 2, 'How would you rate the following staff?  Were they able to explain everything clearly to your satisfaction, give accurate information, check with you whether you have any doubts and offered help if you have any queries later?', 10, 0, '0', '2,3,4,5,6,14', 1),
(45, 2, 'Registration Staff', 0, 44, '1', '', 1),
(46, 2, 'Guest relations Staff', 1, 44, '1', '', 1),
(47, 2, 'Doctors', 2, 44, '1', '', 1),
(48, 2, 'Lab Technicians', 3, 44, '1', '', 1),
(49, 2, 'Radiology Technicians (USG/CT scan/X-ray/ECG/Endoscopy)', 4, 44, '1', '', 1),
(50, 2, 'Pharmacy Staff', 5, 44, '1', '', 1),
(51, 2, 'Dietician at the diet counseling department', 6, 44, '1', '', 1),
(52, 2, 'Security Staff', 7, 44, '1', '', 1),
(53, 2, 'Billing Staff (Cash counter / Re-imbursement)', 8, 44, '1', '', 1),
(54, 2, 'Corporate Staff', 9, 44, '1', '', 1),
(55, 2, 'Physiotherapy', 10, 44, '1', '', 1),
(56, 2, 'How would you rate the way you were treated with regard to respect, dignity and privacy? and please specify the department if your response is anything other than good? ', 11, 0, '0', '2,3,4,5,6,14', 1),
(57, 2, 'How would you rate the way you were treated with regard to respect, dignity and privacy? and please specify the department if your response is anything other than good? ', 0, 56, '1', '', 1),
(58, 2, 'Were the following staff approachable, respectful, cordial, willing to listen, explaining things in a way you could understand and polite during their interaction?', 12, 0, '0', '2,3,4,5,6,14', 1),
(59, 2, 'Registration Staff', 0, 58, '1', '', 1),
(60, 2, 'Guest relations Staff', 1, 58, '1', '', 1),
(61, 2, 'Doctors', 2, 58, '1', '', 1),
(62, 2, 'Lab Technicians', 3, 58, '1', '', 1),
(63, 2, 'Radiology Technicians (USG/CT scan/X-ray/ECG/Endoscopy)', 4, 58, '1', '', 1),
(64, 2, 'Pharmacy Staff', 5, 58, '1', '', 1),
(65, 2, 'Dietician at the diet counseling department', 6, 58, '1', '', 1),
(66, 2, 'Security Staff', 7, 58, '1', '', 1),
(67, 2, 'Billing Staff (Cash counter / Re-imbursement)', 8, 58, '1', '', 1),
(68, 2, 'Corporate Staff', 9, 58, '1', '', 1),
(69, 2, 'Physiotherapy', 10, 58, '1', '', 1),
(70, 2, 'How would you rate the environment within the hospital with regard to cleanliness, quietness, safety, and signage?', 13, 0, '0', '2,3,4,5,6,14', 1),
(71, 2, 'Common area', 0, 70, '1', '', 1),
(72, 2, 'Toilets', 1, 70, '1', '', 1),
(73, 2, 'Canteen (Near Emergency / Main Canteen)', 2, 70, '1', '', 1),
(74, 2, 'During your visit to our hospital did you have an unfortunate experience of any error, mistake, unclear or inaccurate information / documentation? If yes, please specify the department ', 14, 0, '0', '12,13,14', 1),
(75, 2, 'During your visit to our hospital did you have an unfortunate experience of any error, mistake, unclear or inaccurate information / documentation? If yes, please specify the department ', 0, 74, '1', '', 1),
(76, 2, 'During your visit to our hospital did you have experience of delay in services?  If yes, please specify the department ', 15, 0, '0', '12,13,14', 1),
(77, 2, 'During your visit to our hospital did you have experience of delay in services?  If yes, please specify the department ', 0, 76, '1', '', 1),
(78, 2, 'How would you rate your overall experience at Bangalore Baptist Hospital?', 16, 0, '0', '2,3,4,5,6,14', 1),
(79, 2, 'How would you rate your overall experience at Bangalore Baptist Hospital?', 0, 78, '1', '', 1),
(80, 2, 'Would you come back to us or recommend this hospital to your family and friends if need arise? ', 17, 0, '0', '12,13,14', 1),
(81, 2, 'Would you come back to us or recommend this hospital to your family and friends if need arise? ', 0, 80, '1', '', 1),
(82, 2, 'If you would like to appreciate any specific staff for their service Please mentioned their name / dept:', 18, 0, '0', '', 0),
(83, 2, 'If you would like to appreciate any specific staff for their service Please mentioned their name / dept:', 0, 82, '1', '', 0),
(84, 2, 'Please  elaborate on any area of concern:', 19, 0, '0', '', 1),
(85, 2, 'If you would like to appreciate any specific staff for their service Please mentioned their name / dept:', 20, 0, '0', '', 1);

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
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
