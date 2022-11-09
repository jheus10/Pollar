-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2022 at 02:05 AM
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
(1, 'myEvent', '2022-10-15 12:20:12', 1, 'admin'),
(2, 'Tutorial Event', '2022-10-24 15:39:25', 0, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id` int(11) NOT NULL,
  `poll_code` varchar(50) NOT NULL,
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
(1, '15379731666071696', 'Its a nice department', '2022-10-18 13:42:11', '', 1, 'admin'),
(2, '15379731666071696', 'Its a nice department', '2022-10-18 13:42:13', '', 1, 'admin'),
(3, '15379731666071696', 'Its a nice department', '2022-10-18 13:42:19', '', 1, 'admin'),
(4, '15379731666071696', 'Manuel is nice ❤', '2022-10-18 13:42:26', '', 1, 'admin'),
(5, '15379731666071696', 'Manuel is nice ❤', '2022-10-18 13:42:27', '', 1, 'admin'),
(6, '15379731666071696', 'Manuel is nice ❤', '2022-10-18 13:42:29', '', 1, 'admin'),
(7, '15379731666071696', 'Manuel is nice ❤', '2022-10-18 13:42:30', '', 1, 'admin'),
(8, '15379731666071696', 'Manuel is nice ❤', '2022-10-18 13:42:31', '', 1, 'admin'),
(9, '15379731666071696', 'more funding wohoo', '2022-10-18 13:42:39', '', 1, 'admin'),
(10, '15379731666071696', 'raise salary of intern woooo', '2022-10-18 13:42:55', '', 1, 'admin'),
(11, '15379731666071696', 'together', '2022-10-19 18:18:27', '', 1, 'admin'),
(12, '15379731666071696', 'together', '2022-10-19 18:18:37', '', 1, 'admin'),
(13, '15379731666071696', 'together', '2022-10-19 18:18:44', '', 1, 'admin'),
(14, '15379731666071696', 'together', '2022-10-19 18:18:48', '', 1, 'admin'),
(15, '15379731666071696', 'together', '2022-10-19 18:19:42', '', 1, 'admin'),
(16, '15379731666071696', 'together', '2022-10-19 18:19:48', '', 1, 'admin'),
(17, '15379731666071696', 'together', '2022-10-19 18:20:09', '', 1, 'admin'),
(18, '15379731666071696', 'together', '2022-10-19 18:20:25', '', 1, 'admin'),
(19, '15379731666071696', 'together', '2022-10-19 18:20:30', '', 1, 'admin'),
(20, '30765091666186159', '2', '2022-10-19 21:31:58', 'incorrect', 1, 'test'),
(21, '30765091666186159', '2', '2022-10-19 21:31:58', 'incorrect', 1, 'test'),
(22, '30765091666186159', '2', '2022-10-19 21:31:58', 'correct', 1, 'test'),
(23, '66729361666186185', '4', '2022-10-19 21:32:02', '', 1, 'test'),
(24, '81912841666186230', 'heyy', '2022-10-19 21:32:05', '', 1, 'test'),
(25, '75032131666186238', '1', '2022-10-19 21:32:11', '5', 1, 'test'),
(26, '75032131666186238', '3', '2022-10-19 21:32:11', '4', 1, 'test'),
(27, '75032131666186238', '2', '2022-10-19 21:32:11', '3', 1, 'test'),
(28, '75032131666186238', '4', '2022-10-19 21:32:11', '2', 1, 'test'),
(29, '75032131666186238', '5', '2022-10-19 21:32:11', '1', 1, 'test'),
(30, '15379731666071696', 'yow edith', '2022-10-19 21:32:16', '', 1, 'test'),
(31, '19100921666186192', '4', '2022-10-19 21:32:21', '', 1, 'test'),
(32, '78629781666962414', '1', '2022-10-28 21:07:11', 'correct', 1, 'admin'),
(33, '91701651667309767', 'Aly is the best!', '2022-11-01 21:36:50', '', 1, 'admin'),
(34, '91701651667309767', 'Hi', '2022-11-01 21:37:18', '', 1, 'admin'),
(35, '91701651667309767', 'Hi', '2022-11-01 21:37:30', '', 1, 'admin'),
(36, '91701651667309767', 'Hi', '2022-11-01 21:37:32', '', 1, 'admin'),
(37, '91701651667309767', 'Hi', '2022-11-01 21:37:34', '', 1, 'admin');

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
  `poll_code` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `event_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll_list`
--

INSERT INTO `poll_list` (`id`, `poll_type`, `poll_title`, `poll_question`, `poll_correct`, `poll_choices`, `show_answer`, `lock_voting`, `poll_code`, `date_created`, `event_id`, `user_id`) VALUES
(1, 'Word Cloud', '', ' What do you think about EDith?', '', '', 0, 0, '15379731666071696', '2022-10-18 13:41:59', 1, 'admin'),
(3, 'Quiz', 't', ' ,*/q1,*/q2,*/q3,*/', ',*/3,*/1,*/2,*/', '--,*/1,*/2,*/3,*/--,*/1,*/2,*/3,*/--,*/1,*/2,*/3,*/--,*/', 0, 0, '30765091666186159', '2022-10-19 21:29:45', 1, 'admin'),
(4, 'Multiple Choice', '', ' q1', '', ',*/1,*/2,*/3,*/4,*/ ', 0, 0, '66729361666186185', '2022-10-19 21:29:52', 1, ''),
(5, 'Rating', '', ' rate me', '5', '', 0, 0, '19100921666186192', '2022-10-19 21:30:30', 1, ''),
(6, 'Open Text', '', ' What would you like to ask?', '', '', 0, 0, '81912841666186230', '2022-10-19 21:30:38', 1, ''),
(7, 'Ranking', '', ' rank me', '', ',*/1,*/2,*/3,*/4,*/5,*/', 0, 0, '75032131666186238', '2022-10-19 21:30:48', 1, ''),
(19, 'Multiple Choice', '', ' 1', '', ',*/1,*/2,*/ ', 0, 0, '48601871666962406', '2022-10-28 21:06:54', 1, ''),
(20, 'Quiz', 'q1', ' ,*/1,*/', ',*/1,*/', '--,*/1,*/2,*/--,*/', 0, 0, '78629781666962414', '2022-10-28 21:07:04', 1, 'admin'),
(21, 'Word Cloud', '', ' what do you think of aly', '', '', 0, 0, '91701651667309767', '2022-11-01 21:36:24', 1, 'admin');

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
(10, '', 'test', 'test123', '', '', '', '', '', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `poll_list`
--
ALTER TABLE `poll_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
