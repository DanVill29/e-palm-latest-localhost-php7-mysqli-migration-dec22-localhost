-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2015 at 11:32 AM
-- Server version: 10.0.22-MariaDB
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epalmnet_epalm`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `value` varchar(1000) NOT NULL,
  `result` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `quizz_id` int(11) NOT NULL,
  `date_modified` varchar(1000) NOT NULL,
  PRIMARY KEY (`answer_id`),
  UNIQUE KEY `answer_id` (`answer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=210 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `question_id`, `value`, `result`, `student_id`, `quizz_id`, `date_modified`) VALUES
(58, 181, 'Yes, some chips.', 1, 4, 43, '2015-03-03 10:15:42am'),
(59, 182, 'Yes, I do.', 0, 4, 43, '2015-03-03 10:15:46am'),
(82, 206, 'ds', 1, 4, 47, '2015-03-19 06:49:05pm'),
(83, 225, 'Seti dies soon after Moses'' return to Memphis, and Ramesses becomes the new Pharaoh (Ramesses II). Hegep arrives to reveal Moses'' true identity, but Ramesses is conflicted about whether to believe the story. At the urging of Queen Tuya, he interrogates the servant Miriam, who denies being Moses'' sister. When Ramesses threatens to cut off Miriam''s arm, Moses comes to her defense, revealing he is a Hebrew. Although Tuya wants Moses to be put to death, Ramesses decides to send him into exile. Before leaving Egypt, Moses meets with his birth mother and Miriam, who refer to him by his birth name of Moishe. Following a journey into the desert, Moses comes to Midian where he meets Zipporah and her father, Jethro. Moses becomes a shepherd, marries Zipporah and has a son Gershom.', 0, 4, 48, '2015-03-23 04:43:30pm'),
(84, 224, 'Seti dies soon after Moses'' return to Memphis, and Ramesses becomes the new Pharaoh (Ramesses II). Hegep arrives to reveal Moses'' true identity, but Ramesses is conflicted about whether to believe the story. At the urging of Queen Tuya, he interrogates the servant Miriam, who denies being Moses'' sister. When Ramesses threatens to cut off Miriam''s arm, Moses comes to her defense, revealing he is a Hebrew. Although Tuya wants Moses to be put to death, Ramesses decides to send him into exile. Before leaving Egypt, Moses meets with his birth mother and Miriam, who refer to him by his birth name of Moishe. Following a journey into the desert, Moses comes to Midian where he meets Zipporah and her father, Jethro. Moses becomes a shepherd, marries Zipporah and has a son Gershom.', 0, 4, 48, '2015-03-23 04:43:37pm'),
(85, 226, 'Seti dies soon after Moses'' return to Memphis, and Ramesses becomes the new Pharaoh (Ramesses II). Hegep arrives to reveal Moses'' true identity, but Ramesses is conflicted about whether to believe the story. At the urging of Queen Tuya, he interrogates the servant Miriam, who denies being Moses'' sister. When Ramesses threatens to cut off Miriam''s arm, Moses comes to her defense, revealing he is a Hebrew. Although Tuya wants Moses to be put to death, Ramesses decides to send him into exile. Before leaving Egypt, Moses meets with his birth mother and Miriam, who refer to him by his birth name of Moishe. Following a journey into the desert, Moses comes to Midian where he meets Zipporah and her father, Jethro. Moses becomes a shepherd, marries Zipporah and has a son Gershom.', 0, 4, 48, '2015-03-23 04:43:42pm'),
(86, 223, 'Seti dies soon after Moses'' return to Memphis, and Ramesses becomes the new Pharaoh (Ramesses II). H', 0, 4, 48, '2015-03-23 04:43:45pm'),
(116, 225, ';O''''', 0, 61, 48, '2015-03-23 05:17:35pm'),
(117, 224, '''', 0, 61, 48, '2015-03-23 05:17:39pm'),
(118, 223, 'Seti dies soon after Moses'' return to Memphis, and Ramesses becomes the new Pharaoh (Ramesses II). H', 0, 61, 48, '2015-03-23 05:17:41pm'),
(119, 226, '''', 0, 61, 48, '2015-03-23 05:17:44pm'),
(120, 185, 'It is Tom.', 1, 61, 43, '2015-03-23 05:18:58pm'),
(121, 190, 'We went to LA', 1, 61, 43, '2015-03-23 05:19:02pm'),
(122, 188, 'On Saturdays', 0, 61, 43, '2015-03-23 05:19:04pm'),
(123, 186, 'I read it last week.', 0, 61, 43, '2015-03-23 05:19:06pm'),
(124, 193, 'It is your turn', 0, 61, 43, '2015-03-23 05:19:09pm'),
(125, 181, 'Could I have some water?', 1, 61, 43, '2015-03-23 05:19:11pm'),
(126, 182, 'Yes, I do.', 0, 61, 43, '2015-03-23 05:19:13pm'),
(127, 191, 'I like playing golf, reading and sleeping ', 0, 61, 43, '2015-03-23 05:19:16pm'),
(128, 187, '1965', 0, 61, 43, '2015-03-23 05:19:18pm'),
(129, 192, 'Im a banker', 0, 61, 43, '2015-03-23 05:19:21pm'),
(130, 195, 'HJ', 0, 61, 43, '2015-03-23 05:19:26pm'),
(131, 229, 'as', 0, 4, 49, '2015-03-26 09:20:35am'),
(132, 227, 'asda ''', 0, 4, 49, '2015-03-26 09:20:37am'),
(133, 228, 'asd', 0, 4, 49, '2015-03-26 09:20:40am'),
(134, 197, 'The', 1, 61, 44, '2015-03-27 07:02:45am'),
(135, 198, 'The', 0, 61, 44, '2015-03-27 07:03:21am'),
(136, 196, 'a', 1, 61, 44, '2015-03-27 07:04:23am'),
(137, 199, 'a', 1, 61, 44, '2015-03-27 07:04:41am'),
(138, 200, 'the', 0, 61, 44, '2015-03-27 07:05:35am'),
(163, 227, 'asda ''', 0, 73, 50, '2015-04-06 02:01:48pm'),
(164, 228, 'amdas', 0, 73, 50, '2015-04-06 02:01:50pm'),
(165, 230, 'adsasd', 1, 1, 51, '2015-04-06 02:16:57pm'),
(166, 229, 'dasasd', 0, 1, 51, '2015-04-06 02:16:59pm'),
(167, 231, 'sad', 0, 1, 51, '2015-04-06 02:17:14pm'),
(168, 232, 'ads', 0, 1, 51, '2015-04-06 02:17:16pm'),
(169, 233, '32', 1, 1, 52, '2015-04-06 02:17:38pm'),
(170, 229, 'dasasd', 0, 73, 51, '2015-04-06 02:18:03pm'),
(171, 232, 'ds', 0, 73, 51, '2015-04-06 02:18:05pm'),
(172, 231, 'asd', 0, 73, 51, '2015-04-06 02:18:06pm'),
(173, 230, 'adsasd', 1, 73, 51, '2015-04-06 02:18:07pm'),
(174, 233, '32', 1, 73, 52, '2015-04-06 02:18:13pm'),
(175, 192, 'Jones', 1, 1, 43, '2015-04-06 03:24:51pm'),
(176, 195, 'das', 0, 1, 43, '2015-04-06 03:24:52pm'),
(177, 181, 'Could I have some water?', 1, 1, 43, '2015-04-06 03:24:54pm'),
(178, 188, 'No, I do not.', 0, 1, 43, '2015-04-06 03:24:55pm'),
(179, 185, 'It is Tom.', 1, 1, 43, '2015-04-06 03:24:56pm'),
(180, 182, 'I often drink coffee.', 0, 1, 43, '2015-04-06 03:24:57pm'),
(181, 186, 'I read it last week.', 0, 1, 43, '2015-04-06 03:24:59pm'),
(182, 187, 'In Seattle.', 1, 1, 43, '2015-04-06 03:25:00pm'),
(183, 193, 'It is your turn', 0, 1, 43, '2015-04-06 03:25:01pm'),
(184, 190, 'We went to LA', 1, 1, 43, '2015-04-06 03:25:02pm'),
(185, 191, 'A steak, please', 1, 1, 43, '2015-04-06 03:25:04pm'),
(188, 235, 'asda', 0, 75, 53, '2015-04-07 10:04:28am'),
(189, 234, 'das', 1, 75, 53, '2015-04-07 10:04:29am'),
(190, 251, 'Osborne I', 1, 4, 55, '2015-04-09 09:01:37am'),
(191, 244, 'UNIVAC I', 1, 4, 55, '2015-04-09 09:01:51am'),
(192, 240, 'complex number calculator', 1, 4, 55, '2015-04-09 09:01:59am'),
(193, 259, 'the same', 0, 4, 55, '2015-04-09 09:02:08am'),
(194, 253, 'LOGO', 1, 4, 55, '2015-04-09 09:02:16am'),
(195, 247, 'Dartmouth', 1, 4, 55, '2015-04-09 09:02:22am'),
(196, 254, 'Word', 1, 4, 55, '2015-04-09 09:02:42am'),
(197, 242, '5,000 square feet', 0, 4, 55, '2015-04-09 09:02:46am'),
(198, 252, 'Commodore 64 ', 1, 4, 55, '2015-04-09 09:02:51am'),
(199, 243, 'ERA 1101', 1, 4, 55, '2015-04-09 09:02:59am'),
(200, 258, 'Jerry''sGuide to the World Wide Web', 0, 4, 55, '2015-04-09 09:03:04am'),
(201, 248, '1965', 0, 4, 55, '2015-04-09 09:03:11am'),
(202, 241, 'Whirlwind', 1, 4, 55, '2015-04-09 09:03:18am'),
(203, 249, 'Steve Wozniak', 1, 4, 55, '2015-04-09 09:03:23am'),
(204, 256, 'Linus Torvalds', 1, 4, 55, '2015-04-09 09:03:28am'),
(205, 250, 'Breakout ', 1, 4, 55, '2015-04-09 09:03:34am'),
(206, 255, 'Apple Lisa', 1, 4, 55, '2015-04-09 09:03:41am'),
(207, 245, ' Dwight D. Eisenhower v. Adlai Stevenson', 1, 4, 55, '2015-04-09 09:03:51am'),
(208, 257, 'Doom', 1, 4, 55, '2015-04-09 09:03:56am'),
(209, 246, ' Galaga', 0, 4, 55, '2015-04-09 09:04:03am');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10000) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `name`, `discussion_id`, `added_by`, `date_modified`) VALUES
(98, 'Use this link to study more about the topic:&nbsp;http://esl.about.com/library/quiz/blgrquiz_pastforms.htm?lastQuestion=3&amp;answers=1&amp;submit=Next+Question+%3E%3E&amp;ccount=2', 27, 4, '2015-03-03 11:00:02am'),
(99, 'Thanks Sir! This link is very useful.', 27, 61, '2015-03-03 11:05:31am'),
(100, 'This is noted Sir!', 27, 62, '2015-03-03 11:06:45am'),
(101, 'eqwre', 27, 61, '2015-03-30 03:18:52pm'),
(102, 'x', 36, 4, '2015-04-09 09:34:08am'),
(103, 'x2', 36, 4, '2015-04-09 09:34:42am'),
(104, 'x3', 36, 4, '2015-04-09 09:39:13am'),
(105, 's1', 35, 75, '2015-04-09 09:44:34am'),
(106, 's2', 35, 75, '2015-04-09 09:44:37am'),
(107, 's3', 35, 75, '2015-04-09 09:44:44am'),
(108, '5dasdas', 35, 4, '2015-04-09 09:46:39am'),
(109, 'fghh', 35, 77, '2015-04-12 09:10:24am');

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE IF NOT EXISTS `discussion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(1000) NOT NULL,
  `name` mediumtext NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`id`, `subject`, `name`, `added_by`, `date_modified`) VALUES
(33, '1', 'D s1', 0, '2015-04-09 09:30:34am'),
(34, '2', 'D s2', 0, '2015-04-09 09:30:39am'),
(35, '1', '<span style="color: rgb(51, 51, 51); font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; background-color: rgb(255, 255, 255);">D s1</span>', 4, '2015-04-09 09:33:50am'),
(36, '6', '<span style="color: rgb(51, 51, 51); font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; background-color: rgb(255, 255, 255);">D s1</span>', 0, '2015-04-09 09:34:00am'),
(37, '5', 'd s5', 4, '2015-04-09 09:39:30am');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_subjects`
--

CREATE TABLE IF NOT EXISTS `enrolled_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `year_level` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=209 ;

--
-- Dumping data for table `enrolled_subjects`
--

INSERT INTO `enrolled_subjects` (`id`, `student_id`, `subject_id`, `year_level`, `semester`) VALUES
(202, 75, 1, 1, 1),
(203, 76, 5, 2, 1),
(204, 77, 1, 1, 1),
(205, 77, 2, 1, 1),
(206, 77, 3, 1, 1),
(207, 77, 4, 1, 1),
(208, 76, 8, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `prelim` varchar(1000) NOT NULL,
  `midterm` varchar(1000) NOT NULL,
  `prefinal` varchar(1000) NOT NULL,
  `final` varchar(1000) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `cleared` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `prelim`, `midterm`, `prefinal`, `final`, `subject`, `cleared`) VALUES
(5, 75, '1', '3.1', '3.6', '', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `name`, `password`) VALUES
(1, 'Jun Cristobal', 'epalm'),
(2, 'Fr. Ned Disu', 'epalm'),
(3, 'Rico Langue', 'epalm'),
(4, 'Roldan Villaber', 'epalm');

-- --------------------------------------------------------

--
-- Table structure for table `qset`
--

CREATE TABLE IF NOT EXISTS `qset` (
  `qset_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `quizz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`qset_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `question_type_id` int(11) NOT NULL,
  `quizz_id` int(11) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=260 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `title`, `question_type_id`, `quizz_id`) VALUES
(181, 'Q: Would you like something to drink?', 2, 43),
(182, 'Q: Would you like some coffee?', 2, 43),
(185, 'Q: Whose is this?', 2, 43),
(186, 'Q: Who wrote "Happy in Purgatory"?', 2, 43),
(187, 'Q: Where were you born?', 2, 43),
(188, 'Q: Where is the nearest bank?', 2, 43),
(190, 'Q: Where did you go?', 2, 43),
(191, 'Q: What would you like?', 2, 43),
(192, 'Q: What is your surname?', 2, 43),
(193, 'Q: What time is it?', 2, 43),
(195, 'What can you say about online learning?', 1, 43),
(196, 'Q: We stayed in ___ hotel near the city center.', 2, 44),
(197, 'Q: ____ book was written by Jane Anders.', 2, 44),
(198, 'Q: I had ____ exciting vacation in Spain', 2, 44),
(199, 'Q: He bought ____ new car last weekend.', 2, 44),
(200, 'Q: My father is ____ director of this company.', 2, 44),
(201, 'Q: They _____ while I was cooking dinner.', 2, 45),
(202, 'Q: There was no food left when I returned. They _____ everything!', 2, 45),
(203, 'Q: If she had visited us last summer, she _____ the hikes in the mountains.', 2, 45),
(204, 'Q: I _____ the bags before we left on holiday.', 2, 45),
(223, 'Seti dies soon after Moses'' return to Memphis, and Ramesses becomes the new Pharaoh (Ramesses II). H', 2, 48),
(224, 'Seti dies soon after Moses'' return to Memphis, and Ramesses becomes the new Pharaoh (Ramesses II). H', 1, 48),
(225, 'Seti dies soon after Moses'' return to Memphis, and Ramesses becomes the new Pharaoh (Ramesses II). H', 1, 48),
(226, 'Seti dies soon after Moses'' return to Memphis, and Ramesses becomes the new Pharaoh (Ramesses II). H', 1, 48),
(227, 'adsas', 2, 50),
(228, 'adsas', 2, 50),
(229, 'sadsdsds', 2, 51),
(230, 'asd', 2, 51),
(231, 'das', 1, 51),
(232, 'ads', 1, 51),
(233, '34ew', 2, 52),
(239, 'asdasdas', 2, 54),
(240, 'George Stibitz invented a machine called the CNC and performed the first remote-access computing dem', 2, 55),
(241, 'In 1943, computer engineers at MIT embarked on an eight-year project to design a flight simulator fo', 2, 55),
(242, 'How much floor space did the ENIAC computer, unveiled in 1946, take up?', 2, 55),
(243, 'What was the first commercially produced computer?', 2, 55),
(244, 'This computer, which was used at the U.S. Census Bureau, was the first well-known commercial compute', 2, 55),
(245, 'CBS News used a UNIVAC computer on Nov. 4, 1952, to predict the outcome of this presidential race.', 2, 55),
(246, 'Which of the games below made its debut first?', 2, 55),
(247, 'Two professors at this college developed the BASIC programming language in 1964.', 2, 55),
(248, 'In what year was the first e-mail sent?', 2, 55),
(249, 'Who designed the Apple I?', 2, 55),
(250, 'What video game did the Apple II come with?', 2, 55),
(251, 'What was the first portable computer?', 2, 55),
(252, 'What''s the best-selling computer model of all time?', 2, 55),
(253, 'This computer language, which controlled a mechanical ''turtle,'' was developed for children.', 2, 55),
(254, 'Microsoft distributed 450,000 disks of this new product in the November 1983 issue of ''PC World'' mag', 2, 55),
(255, 'What was the first computer with graphical user interface?', 2, 55),
(256, 'Who designed the Linux operating system?', 2, 55),
(257, 'This groundbreaking ultraviolent computer game was released in 1993.', 2, 55),
(258, 'What was the original name of Yahoo when the company was founded in 1994?', 2, 55),
(259, 'What are your expectations to this subject?', 1, 55);

-- --------------------------------------------------------

--
-- Table structure for table `question_enum_values`
--

CREATE TABLE IF NOT EXISTS `question_enum_values` (
  `question_id` int(11) NOT NULL,
  `enum_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`enum_value_id`),
  UNIQUE KEY `question_id` (`question_id`,`enum_value_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=384 ;

--
-- Dumping data for table `question_enum_values`
--

INSERT INTO `question_enum_values` (`question_id`, `enum_value_id`, `name`) VALUES
(181, 243, 'Could I have some water?'),
(181, 244, 'Yes, some chips.'),
(181, 245, 'I did not.'),
(182, 246, ' Yes, thank you.'),
(182, 247, 'I often drink coffee.'),
(182, 248, 'Yes, I do.'),
(185, 249, 'It is Tom.'),
(185, 250, 'No, it is not'),
(185, 251, 'It is my.'),
(186, 252, ' Peter Hemings.'),
(186, 253, 'I read it last week.'),
(186, 254, 'In London.'),
(187, 255, 'In Seattle.'),
(187, 256, '1965'),
(187, 257, 'I was not.'),
(188, 258, 'On the corner.'),
(188, 259, 'No, I do not.'),
(188, 260, 'On Saturdays'),
(189, 261, 'I come from work.'),
(189, 262, 'Im coming from work'),
(189, 263, 'The USA'),
(190, 264, 'We went to LA'),
(190, 265, 'By car.'),
(190, 266, 'At three o clock.'),
(191, 267, 'A steak, please'),
(191, 268, 'I like playing golf, reading and sleeping '),
(191, 269, 'I do not like it'),
(192, 270, 'Jones'),
(192, 271, 'Im a banker'),
(192, 272, '32 Brown Street'),
(193, 274, 'Two-thirty'),
(193, 275, 'It is your turn'),
(193, 276, 'Soon'),
(196, 277, 'a'),
(196, 278, 'the'),
(196, 279, 'an'),
(197, 280, 'The'),
(197, 281, 'A'),
(197, 282, 'An'),
(198, 283, 'an'),
(198, 284, 'a'),
(198, 285, 'The'),
(199, 286, 'a'),
(199, 287, 'the'),
(200, 288, 'a'),
(200, 289, 'the'),
(201, 290, ' were cleaning up'),
(201, 291, 'had cleaned up'),
(202, 292, 'had eaten'),
(202, 293, 'ate'),
(202, 294, 'were eating'),
(203, 295, 'had enjoyed'),
(203, 296, 'would enjoy'),
(203, 297, 'would have enjoyed'),
(204, 298, 'was checking'),
(229, 311, 'dss'),
(229, 312, 'dasasd'),
(230, 313, 'adsasd'),
(233, 314, '32'),
(234, 315, 'das'),
(234, 316, 'asdas'),
(236, 317, 'asdas'),
(236, 318, 'asdas'),
(236, 319, 'asd'),
(236, 320, 'asdas'),
(237, 321, 'asdasd'),
(237, 322, 'asdasd'),
(237, 323, 'asdasd'),
(239, 324, 'asdas'),
(239, 325, 'asdasd2'),
(240, 326, 'complex number calculator'),
(240, 327, 'common number computer'),
(241, 328, 'Whirlwind'),
(241, 329, 'Soaring Eagle'),
(241, 330, 'Flying Aces'),
(242, 331, '1,000 square feet'),
(242, 332, '500 square feet'),
(242, 333, '5,000 square feet'),
(243, 334, 'ERA 1101'),
(243, 335, 'ENIAC'),
(243, 336, 'Zuse Z3'),
(244, 337, 'UNIVAC I'),
(244, 338, ' Sinclair VX80'),
(244, 339, ' American Supercomputer'),
(244, 340, ' FORTRAN II'),
(245, 341, ' Dwight D. Eisenhower v. Adlai Stevenson'),
(245, 342, 'Franklin D. Roosevelt v. Wendell Willkie'),
(245, 343, 'Harry S. Truman v. Thomas E. Dewey'),
(246, 344, 'SpaceWar!'),
(246, 345, ' Paperboy'),
(246, 346, ' Galaga'),
(247, 347, 'Dartmouth'),
(247, 348, 'Stanford'),
(247, 349, ' Harvard'),
(248, 350, '1971'),
(248, 351, '1965'),
(249, 352, 'Steve Wozniak'),
(249, 353, ' Bill Gates'),
(249, 354, 'Steve Jobs'),
(250, 355, 'Breakout '),
(250, 356, 'Zork'),
(250, 357, ' Pac-man'),
(250, 358, 'Space Invaders'),
(251, 359, 'Osborne I'),
(251, 360, 'Sanders I'),
(251, 361, 'Irving II'),
(252, 362, 'Commodore 64 '),
(252, 363, 'Apple Macintosh'),
(252, 364, 'Apple II'),
(253, 365, 'LOGO'),
(253, 366, ' Linux'),
(253, 367, ' Java'),
(253, 368, 'C++'),
(254, 369, 'Word'),
(254, 370, ' Excel'),
(254, 371, 'PowerPoint'),
(255, 372, 'Apple Lisa'),
(255, 373, 'Tandy Color Computer 3'),
(256, 374, 'Linus Torvalds'),
(256, 375, 'Linus Stromberg'),
(256, 376, 'Liam Nuxhall'),
(257, 377, 'Doom'),
(257, 378, 'Halo'),
(257, 379, 'Counter-Strike'),
(258, 380, 'Jerry''sGuide to the World Wide Web'),
(258, 381, 'Go Get It'),
(258, 382, 'Search This'),
(258, 383, 'Find it Now!');

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE IF NOT EXISTS `question_type` (
  `question_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`question_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`question_type_id`, `name`) VALUES
(1, 'open end'),
(2, 'multiple choice');

-- --------------------------------------------------------

--
-- Table structure for table `question_values1`
--

CREATE TABLE IF NOT EXISTS `question_values1` (
  `question_id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL,
  UNIQUE KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_values1`
--

INSERT INTO `question_values1` (`question_id`, `value`, `answer`) VALUES
(181, 'Q: Would you like something to drink?', 'Could I have some water?'),
(182, 'Q: Would you like some coffee?', ' Yes, thank you.'),
(185, 'Q: Whose is this?', 'It is Tom.'),
(186, 'Q: Who wrote "Happy in Purgatory"?', ' Peter Hemings.'),
(187, 'Q: Where were you born?', 'In Seattle.'),
(188, 'Q: Where is the nearest bank?', 'On the corner.'),
(189, 'Q: Where do you come from?', 'I come from work.'),
(190, 'Q: Where did you go?', 'We went to LA'),
(191, 'Q: What would you like?', 'A steak, please'),
(192, 'Q: What is your surname?', 'Jones'),
(193, 'Q: What time is it?', 'Two-thirty'),
(194, 'What can you say about online learning?', '(open end)'),
(195, 'What can you say about online learning?', '(open end)'),
(196, 'Q: We stayed in ___ hotel near the city center.', 'a'),
(197, 'Q: ____ book was written by Jane Anders.', 'The'),
(198, 'Q: I had ____ exciting vacation in Spain', 'an'),
(199, 'Q: He bought ____ new car last weekend.', 'a'),
(200, 'Q: My father is ____ director of this company.', 'a'),
(201, 'Q: They _____ while I was cooking dinner.', ' were cleaning up'),
(202, 'Q: There was no food left when I returned. They _____ everything!', 'had eaten'),
(203, 'Q: If she had visited us last summer, she _____ the hikes in the mountains.', 'had enjoyed'),
(204, 'Q: I _____ the bags before we left on holiday.', 'was checking'),
(229, 'sadsdsds', 'dss'),
(230, 'asd', 'adsasd'),
(231, 'das', 'adsas'),
(232, 'ads', 'sad'),
(233, '34ew', '32'),
(234, 'asdasd', 'das'),
(235, 'asdas', 'asdas'),
(236, 'asdasd asdas', 'asdas'),
(237, 'asdas', 'asdasd'),
(238, 'asdas', 'asdas'),
(239, 'asdasdas', 'asdas'),
(240, 'George Stibitz invented a machine called the CNC and performed the first remote-access computing dem', 'complex number calculator'),
(241, 'In 1943, computer engineers at MIT embarked on an eight-year project to design a flight simulator fo', 'Whirlwind'),
(242, 'How much floor space did the ENIAC computer, unveiled in 1946, take up?', '1,000 square feet'),
(243, 'What was the first commercially produced computer?', 'ERA 1101'),
(244, 'This computer, which was used at the U.S. Census Bureau, was the first well-known commercial compute', 'UNIVAC I'),
(245, 'CBS News used a UNIVAC computer on Nov. 4, 1952, to predict the outcome of this presidential race.', ' Dwight D. Eisenhower v. Adlai Stevenson'),
(246, 'Which of the games below made its debut first?', 'SpaceWar!'),
(247, 'Two professors at this college developed the BASIC programming language in 1964.', 'Dartmouth'),
(248, 'In what year was the first e-mail sent?', '1971'),
(249, 'Who designed the Apple I?', 'Steve Wozniak'),
(250, 'What video game did the Apple II come with?', 'Breakout '),
(251, 'What was the first portable computer?', 'Osborne I'),
(252, 'What''s the best-selling computer model of all time?', 'Commodore 64 '),
(253, 'This computer language, which controlled a mechanical ''turtle,'' was developed for children.', 'LOGO'),
(254, 'Microsoft distributed 450,000 disks of this new product in the November 1983 issue of ''PC World'' mag', 'Word'),
(255, 'What was the first computer with graphical user interface?', 'Apple Lisa'),
(256, 'Who designed the Linux operating system?', 'Linus Torvalds'),
(257, 'This groundbreaking ultraviolent computer game was released in 1993.', 'Doom'),
(258, 'What was the original name of Yahoo when the company was founded in 1994?', 'Jerry''sGuide to the World Wide Web'),
(259, 'What are your expectations to this subject?', 'open end');

-- --------------------------------------------------------

--
-- Table structure for table `question_values2`
--

CREATE TABLE IF NOT EXISTS `question_values2` (
  `question_id` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  UNIQUE KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quizz`
--

CREATE TABLE IF NOT EXISTS `quizz` (
  `quizz_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(1000) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `quiztype` int(11) NOT NULL,
  `showscore` int(11) NOT NULL,
  `quiz_time` int(11) NOT NULL,
  PRIMARY KEY (`quizz_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `quizz`
--

INSERT INTO `quizz` (`quizz_id`, `subject`, `name`, `quiztype`, `showscore`, `quiz_time`) VALUES
(45, '5', 'Take the Past Tenses Quiz', 0, 1, 60),
(44, '5', 'Articles - The A An - Quiz', 0, 1, 60),
(43, '5', '50 Basic English Questions Quiz  ', 0, 1, 60),
(55, '1', 'The Computer History Quiz', 0, 1, 60);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE IF NOT EXISTS `quiz_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(1000) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `wrong_answer` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `feedback` varchar(10000) NOT NULL,
  `date_modified` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=262 ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `cellnumber` varchar(100) NOT NULL,
  `course` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `activate` int(11) NOT NULL,
  `year_level` int(11) NOT NULL,
  `date_modified` varchar(1000) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `gender`, `firstname`, `lastname`, `age`, `address`, `cellnumber`, `course`, `password`, `email`, `activate`, `year_level`, `date_modified`) VALUES
(76, 'Male', 'Jamie Riett', 'Sepe', '25', 'LLC', '09284348217', 'BS in Education (Major in English)', 'epalm', 'jauisland@gmail.com', 1, 2, '2015-04-07 09:37:40am'),
(75, 'Male', 'Roldan', 'Villaber', '25', 'LLC', '09475840258', 'BS in Education (Major in English)', 'epalm', 'jauisland@gmail.com', 1, 1, '2015-04-07 09:35:26am'),
(77, 'Male', 'Rolando', 'Villaber', '40', 'LLC', '09475840258', 'BS in Education (Major in English)', 'epalm', 'jauisland@gmail.com', 1, 1, '2015-04-07 10:06:40am'),
(78, 'Male', 'Francisca', 'Villaber', '40', 'LLC', '09475840258', 'BS in Education (Major in English)', 'epalm', 'jauisland@gmail.com', 0, 1, '2015-04-07 10:07:27am'),
(79, 'Male', 'Claire', 'Villaber', '20', 'LLC', '09475840258', 'BS in Education (Major in English)', 'epalm', 'jauisland@gmail.com', 0, 1, '2015-04-07 10:08:38am');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(1000) NOT NULL,
  `subject_name` varchar(1000) NOT NULL,
  `student_id` varchar(1000) NOT NULL,
  `year_level` int(11) NOT NULL,
  `date_modified` varchar(1000) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=281 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject`, `subject_name`, `student_id`, `year_level`, `date_modified`) VALUES
(218, 'subject2', '', '67', 1, '2015-03-30 03:32:47pm'),
(219, 'subject3', '', '67', 1, '2015-03-30 03:32:47pm'),
(220, 'subject4', '', '67', 1, '2015-03-30 03:32:47pm'),
(221, 'subject1', 'Facilitating Learning', '68', 1, '2015-03-30 03:37:44pm'),
(222, 'subject2', '', '68', 1, '2015-03-30 03:37:44pm'),
(223, 'subject3', '', '68', 1, '2015-03-30 03:37:44pm'),
(224, 'subject4', '', '68', 1, '2015-03-30 03:37:44pm'),
(225, 'subject1', 'Facilitating Learning', '69', 1, '2015-03-30 03:41:13pm'),
(226, '', '', '69', 1, '2015-03-30 03:41:13pm'),
(227, '', '', '69', 1, '2015-03-30 03:41:13pm'),
(228, '', '', '69', 1, '2015-03-30 03:41:13pm'),
(229, 'subject1', 'Facilitating Learning', '72', 1, '2015-04-02 11:46:01am'),
(230, '', '', '72', 1, '2015-04-02 11:46:01am'),
(231, '', '', '72', 1, '2015-04-02 11:46:01am'),
(232, '', '', '72', 1, '2015-04-02 11:46:01am'),
(233, 'subject1', 'Facilitating Learning', '', 0, '2015-04-02 12:25:55pm'),
(234, '', '', '', 0, '2015-04-02 12:25:55pm'),
(235, '', '', '', 0, '2015-04-02 12:25:55pm'),
(236, '', '', '', 0, '2015-04-02 12:25:55pm'),
(237, '', 'Facilitating Learning', '', 0, '2015-04-02 12:29:54pm'),
(238, 'subject2', '', '', 0, '2015-04-02 12:29:54pm'),
(239, '', '', '', 0, '2015-04-02 12:29:54pm'),
(240, '', '', '', 0, '2015-04-02 12:29:54pm'),
(241, 'subject1', 'Facilitating Learning', '72', 0, '2015-04-02 12:31:32pm'),
(242, '', '', '72', 0, '2015-04-02 12:31:32pm'),
(243, '', '', '72', 0, '2015-04-02 12:31:32pm'),
(244, '', '', '72', 0, '2015-04-02 12:31:32pm'),
(245, '', 'Facilitating Learning', '72', 0, '2015-04-02 12:33:10pm'),
(246, 'subject2', '', '72', 0, '2015-04-02 12:33:10pm'),
(247, '', '', '72', 0, '2015-04-02 12:33:10pm'),
(248, '', '', '72', 0, '2015-04-02 12:33:10pm'),
(249, 'subject1', 'Facilitating Learning', '72', 0, '2015-04-02 12:34:40pm'),
(250, '', '', '72', 0, '2015-04-02 12:34:40pm'),
(251, '', '', '72', 0, '2015-04-02 12:34:40pm'),
(252, '', '', '72', 0, '2015-04-02 12:34:40pm'),
(253, '', 'Facilitating Learning', '72', 0, '2015-04-02 12:34:45pm'),
(254, '', '', '72', 0, '2015-04-02 12:34:45pm'),
(255, 'subject3', '', '72', 0, '2015-04-02 12:34:45pm'),
(256, '', '', '72', 0, '2015-04-02 12:34:45pm'),
(257, 'subject1', 'Facilitating Learning', '72', 0, '2015-04-02 12:34:51pm'),
(258, '', '', '72', 0, '2015-04-02 12:34:51pm'),
(259, '', '', '72', 0, '2015-04-02 12:34:51pm'),
(260, '', '', '72', 0, '2015-04-02 12:34:51pm'),
(261, '', 'Facilitating Learning', '72', 0, '2015-04-02 12:35:38pm'),
(262, 'subject2', '', '72', 0, '2015-04-02 12:35:38pm'),
(263, '', '', '72', 0, '2015-04-02 12:35:38pm'),
(264, '', '', '72', 0, '2015-04-02 12:35:38pm'),
(265, '', 'Facilitating Learning', '72', 0, '2015-04-02 12:40:52pm'),
(266, 'subject2', '', '72', 0, '2015-04-02 12:40:52pm'),
(267, '', '', '72', 0, '2015-04-02 12:40:52pm'),
(268, '', '', '72', 0, '2015-04-02 12:40:52pm'),
(269, 'subject1', 'Facilitating Learning', '72', 0, '2015-04-02 12:42:27pm'),
(270, 'subject2', '', '72', 0, '2015-04-02 12:42:27pm'),
(271, 'subject3', '', '72', 0, '2015-04-02 12:42:27pm'),
(272, 'subject4', '', '72', 0, '2015-04-02 12:42:27pm'),
(273, '', 'Facilitating Learning', '71', 1, '2015-04-05 02:26:37pm'),
(274, '', '', '71', 1, '2015-04-05 02:26:37pm'),
(275, '', '', '71', 1, '2015-04-05 02:26:37pm'),
(276, 'subject4', '', '71', 1, '2015-04-05 02:26:37pm'),
(277, 'subject1', 'Facilitating Learning', '71', 1, '2015-04-05 03:39:13pm'),
(278, '', '', '71', 1, '2015-04-05 03:39:13pm'),
(279, '', '', '71', 1, '2015-04-05 03:39:13pm'),
(280, '', '', '71', 1, '2015-04-05 03:39:13pm');

-- --------------------------------------------------------

--
-- Table structure for table `subject_info`
--

CREATE TABLE IF NOT EXISTS `subject_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `year_level` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `subject_info`
--

INSERT INTO `subject_info` (`id`, `title`, `year_level`, `semester`) VALUES
(1, 'CSI 1: Computer Science', 1, 1),
(2, 'Eng 1: Remedial Instruction in English Grammar', 1, 1),
(3, 'Eng 2: Study and Thinking Skills ', 1, 1),
(4, 'Math 1: College Algebra', 1, 1),
(5, 'PROF ED 2: Facilitating Learning', 2, 1),
(6, 'STRAT 4: Principles of Teaching 1', 2, 1),
(7, 'STRAT 5: Developmental Training 1\r\n', 2, 1),
(8, 'ECON 1: Basic Economics Taxation, Agrarian Reform\r\n', 2, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
