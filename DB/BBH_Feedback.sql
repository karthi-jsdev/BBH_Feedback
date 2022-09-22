-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2014 at 12:20 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `bbh_feedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) NOT NULL auto_increment,
  `answer` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
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

CREATE TABLE `feedbacks` (
  `id` bigint(20) NOT NULL auto_increment,
  `patient_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `feedbacks`
--


-- --------------------------------------------------------

--
-- Table structure for table `feedbacks_1`
--

CREATE TABLE `feedbacks_1` (
  `id` bigint(20) NOT NULL auto_increment,
  `patient_id` bigint(20) NOT NULL,
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
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `feedbacks_1`
--

INSERT INTO `feedbacks_1` (`id`, `patient_id`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `14`, `15`, `17`, `18`, `19`, `20`, `21`, `22`, `23`, `24`, `25`, `26`, `27`, `30`, `31`, `32`, `33`, `34`, `35`, `36`, `37`, `38`, `39`, `40`, `42`, `43`, `44`, `45`, `46`, `47`, `48`, `49`, `50`, `52`, `54`, `57`) VALUES
(1, 2, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 3, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 11, 11, 11, 11, 11, 11, 11, 11, 11, 4, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `status`) VALUES
(1, 'Dept 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) NOT NULL auto_increment,
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
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `group_id`, `patient_id`, `name`, `contact`, `email`, `hospital_no`, `private_or_general`, `service_available_department`, `date_time`, `visit_date_time`) VALUES
(1, 1, '2', 'pentamine', '33', '33', '4444', 0, '33', '2014-08-18 19:22:12', '0000-00-00 00:00:00'),
(2, 1, '2', 'ghjgh', '56756', 'gjghjgh@hjhj', '65765', 0, 'gh', '2014-08-22 16:17:59', '0000-00-00 00:00:00'),
(3, 1, '2', 'fgfg', '56456456', 'nghjgh', '5645', 0, 'jhgh', '2014-08-22 16:18:52', '0000-00-00 00:00:00'),
(4, 1, '2', '', '', '', '', 0, '', '2014-08-22 17:18:20', '0000-00-00 00:00:00'),
(5, 1, '2', 'rrrrrrrrrr', '45456546', 'rrrrrrrrrrr', '5444444', 0, 'rrrrrrrrrrrrr', '2014-08-22 17:26:50', '2014-08-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `Id` bigint(10) unsigned NOT NULL auto_increment,
  `group_id` bigint(20) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `position` int(10) unsigned NOT NULL default '0',
  `ownerEl` int(10) unsigned NOT NULL default '0' COMMENT 'parent',
  `slave` binary(1) NOT NULL default '0',
  `option_ids` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=58 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`Id`, `group_id`, `name`, `position`, `ownerEl`, `slave`, `option_ids`, `status`) VALUES
(1, 1, 'How would you rate the following staff? Were they able to explain everything clearly to your satisfaction,give accurate information,check with you whether you have any doubts and offered help if you have any queries later?', 1, 0, '0', '2,3,4,5,6', 1),
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
(13, 1, 'How would you rate the environment within the hospital with regard to cleanliness, quietness, safety and signage?', 0, 0, '0', '2,3,4,5,6', 1),
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

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL auto_increment,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone_number` bigint(10) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_role_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
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

CREATE TABLE `user_role` (
  `id` bigint(20) NOT NULL auto_increment,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
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
