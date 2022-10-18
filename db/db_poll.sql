-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2022 at 07:52 AM
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
(1, 'myEvent', '2022-10-15 12:20:12', 1, 'admin');

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
(10, '15379731666071696', 'raise salary of intern woooo', '2022-10-18 13:42:55', '', 1, 'admin');

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
(1, 'Word Cloud', '', ' What do you think about EDith?', '', '', 0, 0, '15379731666071696', '2022-10-18 13:41:59', 1, 'admin');

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
(1, '201811803', 'admin', 'admin', 'lavillajheus10@gmail.com', '', 'lavilla', 'jheus', '', '09063265816', 'Philippines');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `poll_list`
--
ALTER TABLE `poll_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
