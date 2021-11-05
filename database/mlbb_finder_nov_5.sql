-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2021 at 02:49 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlbb_finder`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_friend`
--

CREATE TABLE `tbl_friend` (
  `friend_id` int(11) NOT NULL,
  `friendUserId` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `isAccepted` tinyint(1) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lobby`
--

CREATE TABLE `tbl_lobby` (
  `lobby_id` int(11) NOT NULL,
  `uuid` varchar(64) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lobby`
--

INSERT INTO `tbl_lobby` (`lobby_id`, `uuid`, `createdAt`) VALUES
(2, '150d0132-d608-4a34-bc82-27920b7cdafd', '2021-11-05 06:57:59'),
(3, '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', '2021-11-05 07:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `message_id` int(11) NOT NULL,
  `message` varchar(256) NOT NULL,
  `lobbyUUID` varchar(64) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`message_id`, `message`, `lobbyUUID`, `createdBy`, `createdAt`) VALUES
(20, 'fsfsdfds', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 15, '2021-11-05 08:42:42'),
(21, 'dsfdsfds', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 15, '2021-11-05 08:42:50'),
(22, 'gdfgfd', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 08:43:06'),
(23, 'fdsfds', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 15, '2021-11-05 08:43:09'),
(24, 'message\n', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 17, '2021-11-05 11:59:22'),
(25, 'bvnnbvnvbn', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 17, '2021-11-05 12:02:03'),
(26, 'hgfhgfhgfhccc', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 17, '2021-11-05 12:02:29'),
(27, 'dfgdfgd', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 17, '2021-11-05 12:02:45'),
(28, 'test', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 17, '2021-11-05 12:03:27'),
(29, 'test', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 17, '2021-11-05 12:03:59'),
(30, 'dsadsa', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:17:31'),
(31, 'zz', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:17:33'),
(32, 'jhgjghjgh', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:18:27'),
(33, 'jjjj', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:19:33'),
(34, 'hgfhgfhgf', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:19:48'),
(35, 'dsadsa', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:19:54'),
(36, 'hello world', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:35:17'),
(37, 'test', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:36:14'),
(38, 'new message', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:37:02'),
(39, 'test', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:38:11'),
(40, 'new message', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:40:34'),
(41, 'sadsadsadas', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:40:43'),
(42, 'test', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 14, '2021-11-05 12:41:09'),
(43, 'Message from Mars', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 17, '2021-11-05 13:07:04'),
(44, 'jlkdfdlksfjsdlkfjdsfdsfjlkdfdlksfjsdlkfjdsfdsfjlkdfdlksfjsdlkfjdsfdsfjlkdfdlksfjsdlkfjdsfdsfjlkdfdlksfjsdlkfjdsfdsfjlkdfdlksfjsdlkfjdsfdsfjlkdfdlksfjsdlkfjdsfdsfjlkdfdlksfjsdlkfjdsfdsfjlkdfdlksfjsdlkfjdsfdsf', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 17, '2021-11-05 13:07:19'),
(45, 'Another message!', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 16, '2021-11-05 13:13:19'),
(46, 'hehe', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 16, '2021-11-05 13:17:40'),
(47, 'test', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 17, '2021-11-05 13:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mlbbdata`
--

CREATE TABLE `tbl_mlbbdata` (
  `data_id` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `mlid` varchar(32) NOT NULL,
  `ign` varchar(32) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_preference`
--

CREATE TABLE `tbl_preference` (
  `preference_id` int(11) NOT NULL,
  `primaryRole` enum('Tank','Fighter','Marksman','Mage','Assassin','Support') NOT NULL,
  `secondaryRole` enum('Tank','Fighter','Marksman','Mage','Assassin','Support') NOT NULL,
  `gameMode` enum('Classic','Ranked','Brawl') NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_preference`
--

INSERT INTO `tbl_preference` (`preference_id`, `primaryRole`, `secondaryRole`, `gameMode`, `createdBy`, `createdAt`) VALUES
(1, 'Support', 'Assassin', 'Classic', 1, '2021-10-21 16:28:59'),
(2, 'Mage', 'Assassin', 'Classic', 1, '2021-10-21 16:28:59'),
(3, 'Assassin', 'Tank', 'Ranked', 1, '2021-10-21 16:28:59'),
(4, 'Tank', 'Tank', 'Classic', 1, '2021-10-21 16:28:59'),
(9, 'Fighter', 'Fighter', 'Brawl', 7, '2021-11-04 12:19:27'),
(10, 'Support', 'Support', 'Brawl', 7, '2021-11-04 12:23:23'),
(14, 'Assassin', 'Assassin', 'Classic', 14, '2021-11-04 13:44:18'),
(15, 'Assassin', 'Fighter', 'Classic', 7, '2021-11-04 14:05:13'),
(16, 'Support', 'Assassin', 'Classic', 15, '2021-11-04 14:07:05'),
(17, 'Tank', 'Support', 'Classic', 16, '2021-11-04 14:14:51'),
(18, 'Marksman', 'Fighter', 'Classic', 17, '2021-11-04 14:20:17'),
(19, 'Fighter', 'Fighter', 'Classic', 7, '2021-11-04 14:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_queue`
--

CREATE TABLE `tbl_queue` (
  `queue_id` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `preferenceId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tickets`
--

CREATE TABLE `tbl_tickets` (
  `ticket_id` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `body` varchar(1024) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `currentLobbyUUID` varchar(64) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `firstname`, `lastname`, `email`, `username`, `password`, `birthday`, `currentLobbyUUID`, `createdAt`, `updatedAt`) VALUES
(7, 'Test', 'User', 'testuser@gmail.com', 'testuser', '$2y$10$AS/1aK3epaE3.1d4Wv8AAu3bsTkyNK7Vfr4b12D44kpqzf7g5ck6W', '0000-00-00', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', '2021-10-31 11:18:45', '2021-11-05 07:00:28'),
(8, 'Aczell', 'Florencio', 'aczellbien.florencio2@gmail.com', 'keenplify', '$2y$10$Zy3HVEAAzZkGJyjQuFfjQuPgy5cd2hwT1UDv853LtcvyJk3L.gwJS', '2002-02-02', NULL, '2021-11-02 02:07:21', '2021-11-05 06:55:20'),
(14, 'test', 'user 2', 'testuser2@gmail.com', 'testuser2', '$2y$10$1MryMN8svJpJo21J0eW8belY1HPT9cKzVzod3MpK1ihYlJq55HKtS', '2003-11-04', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', '2021-11-04 12:35:34', '2021-11-05 07:00:28'),
(15, 'test', 'user3', 'testuser3@gmail.com', 'testuser3', '$2y$10$8xuY7i39DZfMy08MCUrtoOBrk.CD6nFAYGY4QEAac.koDIRlrRQlC', '2003-11-04', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', '2021-11-04 14:06:50', '2021-11-05 07:00:28'),
(16, 'test', 'user4', 'testuser4@gmail.com', 'testuser4', '$2y$10$glqhHFG7HPicCqOvVynMTuGhj4EADnGw6UA6tnWfHdG1.3X7xtbOK', '2003-11-04', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', '2021-11-04 14:13:05', '2021-11-05 07:00:28'),
(17, 'test', 'user5', 'testuser5@gmail.com', 'testuser5', '$2y$10$07DY568Pg8OZeKTrMeWFdeQabu6OpQ.IAc4L40CpPEft6nuGoa0jK', '2003-11-04', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', '2021-11-04 14:18:44', '2021-11-05 07:00:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_friend`
--
ALTER TABLE `tbl_friend`
  ADD PRIMARY KEY (`friend_id`);

--
-- Indexes for table `tbl_lobby`
--
ALTER TABLE `tbl_lobby`
  ADD PRIMARY KEY (`lobby_id`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tbl_mlbbdata`
--
ALTER TABLE `tbl_mlbbdata`
  ADD PRIMARY KEY (`data_id`);

--
-- Indexes for table `tbl_preference`
--
ALTER TABLE `tbl_preference`
  ADD PRIMARY KEY (`preference_id`);

--
-- Indexes for table `tbl_queue`
--
ALTER TABLE `tbl_queue`
  ADD PRIMARY KEY (`queue_id`);

--
-- Indexes for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_friend`
--
ALTER TABLE `tbl_friend`
  MODIFY `friend_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_lobby`
--
ALTER TABLE `tbl_lobby`
  MODIFY `lobby_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_mlbbdata`
--
ALTER TABLE `tbl_mlbbdata`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_preference`
--
ALTER TABLE `tbl_preference`
  MODIFY `preference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_queue`
--
ALTER TABLE `tbl_queue`
  MODIFY `queue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
