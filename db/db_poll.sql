-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2022 at 12:13 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_poll`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_list`
--

CREATE TABLE `event_list` (
  `id` int(11) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp(),
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_list`
--

INSERT INTO `event_list` (`id`, `event_name`, `date_create`, `active_status`, `user_id`) VALUES
(1, 'heyyyy', '2022-09-21 00:00:00', 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id` int(11) NOT NULL,
  `poll_code` int(11) NOT NULL,
  `answer_option` varchar(1000) NOT NULL,
  `date_answered` datetime NOT NULL DEFAULT current_timestamp(),
  `answer_status` varchar(20) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `poll_code`, `answer_option`, `date_answered`, `answer_status`, `event_id`, `user_id`) VALUES
(1, 3489976, '1', '0000-00-00 00:00:00', '', 1, 'admin'),
(2, 4579462, '2', '0000-00-00 00:00:00', '', 1, 'admin'),
(3, 4579462, '2', '0000-00-00 00:00:00', '', 1, 'admin'),
(4, 4579462, '4', '0000-00-00 00:00:00', '', 1, 'admin'),
(5, 2196939, 'po?????', '0000-00-00 00:00:00', '', 1, 'admin'),
(6, 5317429, '2', '0000-00-00 00:00:00', '', 1, 'admin'),
(7, 5317429, '4', '0000-00-00 00:00:00', '', 1, 'admin'),
(8, 5317429, '4', '0000-00-00 00:00:00', '', 1, 'admin'),
(9, 5317429, '5', '0000-00-00 00:00:00', '', 1, 'admin'),
(10, 5317429, '5', '0000-00-00 00:00:00', '', 1, 'admin'),
(11, 5317429, '3', '0000-00-00 00:00:00', '', 1, 'admin'),
(12, 4590594, 'yow', '0000-00-00 00:00:00', '', 1, 'admin'),
(13, 4590594, 'im hear', '0000-00-00 00:00:00', '', 1, 'admin'),
(14, 4590594, 'im here', '0000-00-00 00:00:00', '', 1, 'admin'),
(15, 4590594, 'im here', '0000-00-00 00:00:00', '', 1, 'admin'),
(16, 4590594, 'im here', '0000-00-00 00:00:00', '', 1, 'admin'),
(39, 4579462, '1', '0000-00-00 00:00:00', '', 1, 'admin'),
(40, 4579462, '1', '0000-00-00 00:00:00', '', 1, 'admin'),
(41, 4579462, '1', '0000-00-00 00:00:00', '', 1, 'admin'),
(42, 4579462, '4', '0000-00-00 00:00:00', '', 1, 'admin'),
(43, 4590594, 'hehe', '0000-00-00 00:00:00', '', 1, 'admin'),
(44, 6003054, '1', '0000-00-00 00:00:00', 'correct', 1, 'admin'),
(45, 6003054, '3', '0000-00-00 00:00:00', 'incorrect', 1, 'admin'),
(46, 6003054, '5', '0000-00-00 00:00:00', 'correct', 1, 'admin'),
(47, 6003054, '2', '0000-00-00 00:00:00', 'incorrect', 1, 'alyana'),
(48, 6003054, '4', '0000-00-00 00:00:00', 'correct', 1, 'alyana'),
(49, 6003054, '5', '0000-00-00 00:00:00', 'correct', 1, 'alyana'),
(50, 6003054, '1', '0000-00-00 00:00:00', 'correct', 1, 'admin'),
(51, 6003054, '3', '0000-00-00 00:00:00', 'incorrect', 1, 'admin'),
(53, 6003054, '', '0000-00-00 00:00:00', 'incorrect', 1, 'alyana'),
(54, 6003054, '', '0000-00-00 00:00:00', 'incorrect', 1, 'alyana'),
(55, 6003054, '6', '0000-00-00 00:00:00', 'incorrect', 1, 'alyana'),
(56, 5256367, '1', '0000-00-00 00:00:00', 'incorrect', 1, 'admin'),
(57, 5256367, '5', '0000-00-00 00:00:00', 'incorrect', 1, 'admin'),
(58, 5256367, '3', '0000-00-00 00:00:00', 'correct', 1, 'admin'),
(59, 5256367, '5', '0000-00-00 00:00:00', 'incorrect', 1, 'admin'),
(63, 3783172, '3', '0000-00-00 00:00:00', 'correct', 1, 'admin'),
(64, 3783172, '4', '0000-00-00 00:00:00', 'correct', 1, 'admin'),
(65, 7557834, '3', '0000-00-00 00:00:00', '', 1, 'admin'),
(66, 3623592, '3', '0000-00-00 00:00:00', '', 1, 'admin'),
(67, 3623592, '6', '0000-00-00 00:00:00', '', 1, 'admin'),
(68, 3623592, '1', '0000-00-00 00:00:00', '', 1, 'admin'),
(69, 3623592, '1', '0000-00-00 00:00:00', '', 1, 'admin'),
(70, 4598639, '1', '0000-00-00 00:00:00', '', 1, 'admin'),
(71, 4598639, '1', '0000-00-00 00:00:00', '', 1, 'admin'),
(72, 4598639, '2', '0000-00-00 00:00:00', '', 1, 'admin'),
(234, 5608849, 'hi', '2022-10-06 18:08:53', '4', 1, 'admin'),
(235, 5608849, 'hello', '2022-10-06 18:08:53', '3', 1, 'admin'),
(236, 5608849, 'wyd?', '2022-10-06 18:08:53', '2', 1, 'admin'),
(237, 5608849, 'oke', '2022-10-06 18:08:53', '1', 1, 'admin'),
(238, 5608849, 'oke', '2022-10-06 18:09:02', '4', 1, 'admin'),
(239, 5608849, 'wyd?', '2022-10-06 18:09:02', '3', 1, 'admin'),
(240, 5608849, 'hello', '2022-10-06 18:09:02', '2', 1, 'admin'),
(241, 5608849, 'hi', '2022-10-06 18:09:02', '1', 1, 'admin'),
(242, 5608849, 'hi', '2022-10-06 18:09:09', '4', 1, 'admin'),
(243, 5608849, 'hello', '2022-10-06 18:09:09', '3', 1, 'admin'),
(244, 5608849, 'wyd?', '2022-10-06 18:09:09', '2', 1, 'admin'),
(245, 5608849, 'oke', '2022-10-06 18:09:09', '1', 1, 'admin'),
(246, 5608849, 'hi', '2022-10-06 18:12:37', '4', 1, 'admin'),
(247, 5608849, 'hello', '2022-10-06 18:12:37', '3', 1, 'admin'),
(248, 5608849, 'wyd?', '2022-10-06 18:12:37', '2', 1, 'admin'),
(249, 5608849, 'oke', '2022-10-06 18:12:37', '1', 1, 'admin'),
(250, 5608849, 'hi', '2022-10-06 18:12:49', '4', 1, 'admin'),
(251, 5608849, 'hello', '2022-10-06 18:12:49', '3', 1, 'admin'),
(252, 5608849, 'wyd?', '2022-10-06 18:12:49', '2', 1, 'admin'),
(253, 5608849, 'oke', '2022-10-06 18:12:49', '1', 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers_ranking`
--

CREATE TABLE `poll_answers_ranking` (
  `id` int(11) NOT NULL,
  `poll_code` int(11) NOT NULL,
  `answer_option` varchar(1000) NOT NULL,
  `date_answered` datetime NOT NULL DEFAULT current_timestamp(),
  `ranking` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll_answers_ranking`
--

INSERT INTO `poll_answers_ranking` (`id`, `poll_code`, `answer_option`, `date_answered`, `ranking`, `event_id`, `user_id`) VALUES
(1, 5608849, 'hi', '2022-10-06 16:56:41', 4, 1, 'admin'),
(2, 5608849, 'hello', '2022-10-06 16:56:41', 3, 1, 'admin'),
(3, 5608849, 'wyd?', '2022-10-06 16:56:41', 2, 1, 'admin'),
(4, 5608849, 'oke', '2022-10-06 16:56:41', 1, 1, 'admin'),
(13, 5608849, 'hi', '2022-10-06 17:29:50', 4, 1, 'alyana'),
(14, 5608849, 'hello', '2022-10-06 17:29:50', 3, 1, 'alyana'),
(15, 5608849, 'wyd?', '2022-10-06 17:29:50', 2, 1, 'alyana'),
(16, 5608849, 'oke', '2022-10-06 17:29:50', 1, 1, 'alyana'),
(17, 5608849, 'hello', '2022-10-06 17:41:58', 4, 1, 'alyana'),
(18, 5608849, 'wyd?', '2022-10-06 17:41:58', 3, 1, 'alyana'),
(19, 5608849, 'hi', '2022-10-06 17:41:58', 2, 1, 'alyana'),
(20, 5608849, 'oke', '2022-10-06 17:41:58', 1, 1, 'alyana'),
(21, 5608849, 'oke', '2022-10-06 17:43:15', 4, 1, 'admin'),
(22, 5608849, 'hello', '2022-10-06 17:43:15', 3, 1, 'admin'),
(23, 5608849, 'hi', '2022-10-06 17:43:15', 2, 1, 'admin'),
(24, 5608849, 'wyd?', '2022-10-06 17:43:15', 1, 1, 'admin'),
(25, 5608849, 'wyd?', '2022-10-06 18:01:02', 4, 1, 'admin'),
(26, 5608849, 'hi', '2022-10-06 18:01:02', 3, 1, 'admin'),
(27, 5608849, 'oke', '2022-10-06 18:01:02', 2, 1, 'admin'),
(28, 5608849, 'hello', '2022-10-06 18:01:02', 1, 1, 'admin'),
(29, 5608849, 'oke', '2022-10-06 18:01:20', 4, 1, 'admin'),
(30, 5608849, 'wyd?', '2022-10-06 18:01:20', 3, 1, 'admin'),
(31, 5608849, 'hello', '2022-10-06 18:01:20', 2, 1, 'admin'),
(32, 5608849, 'hi', '2022-10-06 18:01:20', 1, 1, 'admin'),
(33, 5608849, 'hi', '2022-10-06 18:01:37', 4, 1, 'admin'),
(34, 5608849, 'hello', '2022-10-06 18:01:37', 3, 1, 'admin'),
(35, 5608849, 'wyd?', '2022-10-06 18:01:37', 2, 1, 'admin'),
(36, 5608849, 'oke', '2022-10-06 18:01:37', 1, 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `poll_list`
--

CREATE TABLE `poll_list` (
  `id` int(11) NOT NULL,
  `poll_type` varchar(100) NOT NULL,
  `poll_title` varchar(100) NOT NULL,
  `poll_question` varchar(1000) NOT NULL,
  `poll_correct` varchar(1000) NOT NULL,
  `poll_choices` varchar(4000) NOT NULL,
  `show_answer` tinyint(1) NOT NULL DEFAULT 0,
  `lock_voting` tinyint(1) NOT NULL DEFAULT 0,
  `poll_code` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll_list`
--

INSERT INTO `poll_list` (`id`, `poll_type`, `poll_title`, `poll_question`, `poll_correct`, `poll_choices`, `show_answer`, `lock_voting`, `poll_code`, `date_created`, `event_id`) VALUES
(3, 'Multiple Choice', '', ' howwww', '1', ',1,*/2,*/3,*/4,*/', 0, 0, 4432904, '0000-00-00 00:00:00', 6),
(128, 'Rating', '', ' heyyy', '5', '', 0, 0, 7557834, '0000-00-00 00:00:00', 1),
(130, 'Rating', '', ' hey hey hey', '6', '', 0, 0, 3623592, '0000-00-00 00:00:00', 1),
(133, 'Open Text', '', ' what do you want to ask?', '', '', 0, 0, 4580950, '0000-00-00 00:00:00', 1),
(141, 'Word Cloud', '', ' heyy', '', '', 0, 0, 1600419, '0000-00-00 00:00:00', 1),
(142, 'Ranking', '', ' q1', '', ',*/1,*/2,*/3,*/4,*/', 0, 0, 3714129, '0000-00-00 00:00:00', 1),
(143, 'Ranking', '', ' ranking', '', ',*/hi,*/hello,*/wyd?,*/oke,*/', 0, 0, 5608849, '0000-00-00 00:00:00', 1),
(147, 'Ranking', '', ' q1', '', ',*/hey, iknow,*/yow, maybe,*/', 0, 0, 9957818, '2022-10-06 15:39:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `ID` int(11) NOT NULL,
  `stud_num` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_img` varchar(70) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `suffix` varchar(10) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`ID`, `stud_num`, `username`, `password`, `email`, `profile_img`, `lname`, `fname`, `suffix`, `contact_no`, `country`) VALUES
(1, '201811803', 'admin', 'admin', 'lavillajheus10@gmail.com', '', 'lavilla', 'jheus', '', '09063265816', 'Philippines'),
(7, '', 'user', 'user123', '', '', '', '', '', '', ''),
(8, '', 'alyana', 'aly123', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event_list`
--
ALTER TABLE `event_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_answers_ranking`
--
ALTER TABLE `poll_answers_ranking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_list`
--
ALTER TABLE `poll_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_list`
--
ALTER TABLE `event_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `poll_answers_ranking`
--
ALTER TABLE `poll_answers_ranking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `poll_list`
--
ALTER TABLE `poll_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
