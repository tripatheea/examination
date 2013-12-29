SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `parikchya`
--

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE IF NOT EXISTS `marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symbol_no` varchar(9) NOT NULL,
  `school_code` tinytext NOT NULL,
  `name` varchar(40) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `opti_choice` varchar(4) NOT NULL,
  `optii_choice` varchar(5) NOT NULL,
  `english_th` int(2) NOT NULL,
  `english_pr` int(2) NOT NULL,
  `nepali` int(3) NOT NULL,
  `maths` int(3) NOT NULL,
  `science_th` int(2) NOT NULL,
  `science_pr` int(2) NOT NULL,
  `social` int(3) NOT NULL,
  `hpe_th` int(2) NOT NULL,
  `hpe_pr` int(2) NOT NULL,
  `opti` int(3) NOT NULL,
  `opti_pr` int(2) NOT NULL,
  `optii_th` int(2) NOT NULL,
  `optii_pr` int(2) NOT NULL,
  `total` int(3) NOT NULL,
  `percent` varchar(5) NOT NULL,
  `division` varchar(11) NOT NULL,
  `pass` varchar(6) NOT NULL,
  `withheld` int(1) NOT NULL,
  `disqualified` int(1) NOT NULL,
  `ready` int(1) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `symbol_no` (`symbol_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_code` tinytext NOT NULL,
  `name` varchar(75) NOT NULL,
  `address` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field` varchar(20) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `field`, `value`) VALUES
(1, 'Year', '2013'),
(2, 'school/board', 'ABC Examination Board'),
(3, 'exam_name', 'ABC Examination'),
(4, 'result_status', '0');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_code` varchar(5) NOT NULL,
  `name` varchar(40) NOT NULL,
  `subject_type` varchar(12) NOT NULL,
  `theory_fm` int(3) NOT NULL,
  `theory_pm` int(2) NOT NULL,
  `practical_fm` int(2) NOT NULL,
  `practical_pm` int(2) NOT NULL,
  PRIMARY KEY (`subject_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_code`, `name`, `subject_type`, `theory_fm`, `theory_pm`, `practical_fm`, `practical_pm`) VALUES
('CMP01', 'English', 'Compulsory', 75, 24, 25, 10),
('CMP02', 'Nepali', 'Compulsory', 100, 32, 0, 0),
('CMP03', 'Mathematics', 'Compulsory', 100, 32, 0, 0),
('CMP04', 'Science', 'Compulsory', 75, 24, 25, 10),
('CMP05', 'Social Studies', 'Compulsory', 100, 32, 0, 0),
('CMP06', 'Health Population and Environment', 'Compulsory', 75, 24, 25, 10),
('OI01', 'Optional Mathematics', 'OptionalI', 100, 32, 0, 0),
('OI02', 'Optional Population', 'OptionalI', 100, 32, 0, 0),
('OI03', 'Optional Environment Science', 'OptionalI', 100, 32, 0, 0),
('OI04', 'Optional English', 'OptionalI', 100, 32, 0, 0),
('OI05', 'Optional Geography', 'OptionalI', 75, 24, 25, 10),
('OI06', 'Optional Economics', 'OptionalI', 100, 32, 0, 0),
('OII01', 'Optional Health & Physical Education', 'OptionalII', 75, 24, 25, 10),
('OII02', 'Optional Office Mgmt. & Accounts', 'OptionalII', 75, 24, 25, 10),
('OII03', 'Optional Agriculture', 'OptionalII', 75, 24, 25, 10),
('OII04', 'Optional Journalism', 'OptionalII', 75, 24, 25, 10),
('OII05', 'Optional Computer Science', 'OptionalII', 50, 16, 50, 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `access_level` int(1) NOT NULL COMMENT 'user type',
  `access_type` varchar(9) NOT NULL COMMENT 'which subjects right to give',
  `user_created_by` varchar(20) NOT NULL,
  `user_created_on` datetime NOT NULL,
  `last_logon_on` datetime NOT NULL,
  `last_logon_ip` varchar(15) NOT NULL,
  `locked` int(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
