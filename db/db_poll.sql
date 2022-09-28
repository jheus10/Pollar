-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2022 at 05:46 PM
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
  `date_create` date NOT NULL DEFAULT current_timestamp(),
  `date_end` date NOT NULL DEFAULT current_timestamp(),
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_list`
--

INSERT INTO `event_list` (`id`, `event_name`, `date_create`, `date_end`, `active_status`, `user_id`) VALUES
(1, 'heyyyy', '2022-09-21', '2022-09-21', 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id` int(11) NOT NULL,
  `poll_code` int(11) NOT NULL,
  `answer_option` varchar(1000) NOT NULL,
  `date_answered` int(11) NOT NULL,
  `answer_status` varchar(20) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `poll_code`, `answer_option`, `date_answered`, `answer_status`, `event_id`, `user_id`) VALUES
(1, 3489976, '1', 0, '', 1, 'admin'),
(2, 4579462, '2', 0, '', 1, 'admin'),
(3, 4579462, '2', 0, '', 1, 'admin'),
(4, 4579462, '4', 0, '', 1, 'admin'),
(5, 2196939, 'po?????', 0, '', 1, 'admin'),
(6, 5317429, '2', 0, '', 1, 'admin'),
(7, 5317429, '4', 0, '', 1, 'admin'),
(8, 5317429, '4', 0, '', 1, 'admin'),
(9, 5317429, '5', 0, '', 1, 'admin'),
(10, 5317429, '5', 0, '', 1, 'admin'),
(11, 5317429, '3', 0, '', 1, 'admin'),
(12, 4590594, 'yow', 0, '', 1, 'admin'),
(13, 4590594, 'im hear', 0, '', 1, 'admin'),
(14, 4590594, 'im here', 0, '', 1, 'admin'),
(15, 4590594, 'im here', 0, '', 1, 'admin'),
(16, 4590594, 'im here', 0, '', 1, 'admin'),
(39, 4579462, '1', 0, '', 1, 'admin'),
(40, 4579462, '1', 0, '', 1, 'admin'),
(41, 4579462, '1', 0, '', 1, 'admin'),
(42, 4579462, '4', 0, '', 1, 'admin'),
(43, 4590594, 'hehe', 0, '', 1, 'admin'),
(44, 6003054, '1', 0, 'correct', 1, 'admin'),
(45, 6003054, '3', 0, 'incorrect', 1, 'admin'),
(46, 6003054, '5', 0, 'correct', 1, 'admin'),
(47, 6003054, '2', 0, 'incorrect', 1, 'alyana'),
(48, 6003054, '4', 0, 'correct', 1, 'alyana'),
(49, 6003054, '5', 0, 'correct', 1, 'alyana'),
(50, 6003054, '1', 0, 'correct', 1, 'admin'),
(51, 6003054, '3', 0, 'incorrect', 1, 'admin'),
(53, 6003054, '', 0, 'incorrect', 1, 'alyana'),
(54, 6003054, '', 0, 'incorrect', 1, 'alyana'),
(55, 6003054, '6', 0, 'incorrect', 1, 'alyana'),
(56, 5256367, '1', 0, 'incorrect', 1, 'admin'),
(57, 5256367, '5', 0, 'incorrect', 1, 'admin'),
(58, 5256367, '3', 0, 'correct', 1, 'admin'),
(59, 5256367, '5', 0, 'incorrect', 1, 'admin'),
(63, 3783172, '3', 0, 'correct', 1, 'admin'),
(64, 3783172, '4', 0, 'correct', 1, 'admin');

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
  `date_created` date NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll_list`
--

INSERT INTO `poll_list` (`id`, `poll_type`, `poll_title`, `poll_question`, `poll_correct`, `poll_choices`, `show_answer`, `lock_voting`, `poll_code`, `date_created`, `event_id`) VALUES
(3, 'Multiple Choice', '', ' howwww', '1', ',1,*/2,*/3,*/4,*/', 0, 0, 4432904, '0000-00-00', 6),
(6, 'Multiple Choice', '', ' henlo', '1', ',*/1,*/2,*/3,*/4,*/', 0, 0, 4579462, '0000-00-00', 1),
(32, 'Multiple Choice', '', ' test', '', ',*/2,*/3,*/4,*/5,*/', 0, 0, 5317429, '0000-00-00', 1),
(33, 'Word Cloud', '', ' anyhow', '', ',*/', 0, 0, 4590594, '0000-00-00', 1),
(37, 'Multiple Choice', '', ' hi', '2', ',*/1,*/2,*/', 0, 0, 1585951, '0000-00-00', 1),
(124, 'Quiz', '1st test', ' ,*/q1,*/q2,*/', ',*/3,*/6,*/', '//-,1,2,3,4,//-,5,6', 0, 0, 5256367, '0000-00-00', 1),
(125, 'Quiz', '2nd test', ' ,*/q1,*/q2,*/q2,*/', ',*/1,*/4,*/5,*/', '//-,1,2,//-,3,4,//-,5,6', 0, 0, 6003054, '0000-00-00', 1),
(126, 'Quiz', 'My QUIZ', ' ,*/whats up,*/heyy,*/', ',*/3,*/4,*/', '//-,1,2,3,//-,4,5,6', 0, 0, 3783172, '0000-00-00', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `poll_list`
--
ALTER TABLE `poll_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
