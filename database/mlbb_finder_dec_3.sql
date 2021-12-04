-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 02:34 PM
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

--
-- Dumping data for table `tbl_friend`
--

INSERT INTO `tbl_friend` (`friend_id`, `friendUserId`, `createdBy`, `isAccepted`, `createdAt`, `updatedAt`) VALUES
(11, 7, 14, 0, '2021-11-28 13:30:08', '2021-11-28 13:30:08'),
(12, 16, 14, 0, '2021-11-28 13:51:42', '2021-11-28 13:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lobby`
--

CREATE TABLE `tbl_lobby` (
  `lobby_id` int(11) NOT NULL,
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`json`)),
  `uuid` varchar(64) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Dumping data for table `tbl_mlbbdata`
--

INSERT INTO `tbl_mlbbdata` (`data_id`, `createdBy`, `mlid`, `ign`, `createdAt`, `updatedAt`) VALUES
(7, 7, 'test', 'AczellPogi', '2021-11-07 10:15:35', '2021-11-26 15:26:10'),
(8, 7, '12321443', 'Keenplify', '2021-11-07 10:30:55', '2021-11-07 10:30:55'),
(10, 14, '42132111', 'Keenplify', '2021-11-07 11:17:58', '2021-11-07 11:17:58'),
(11, 15, 'dfsaasda3', 'TestUser3', '2021-11-07 11:19:08', '2021-11-07 11:19:08'),
(12, 16, '32132131', 'TestUser4', '2021-11-07 11:20:08', '2021-11-07 11:20:08'),
(13, 17, '14241215', 'TestUser5', '2021-11-07 11:21:48', '2021-11-07 11:21:48'),
(14, 17, '987984232', 'CuteAko123', '2021-11-11 14:30:08', '2021-11-11 14:30:08'),
(15, 18, '543811132', 'AdminMLBB', '2021-11-27 06:14:51', '2021-11-27 06:14:51'),
(16, 19, '645642343', 'KNPLFY', '2021-11-28 13:26:44', '2021-11-28 13:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_preference`
--

CREATE TABLE `tbl_preference` (
  `preference_id` int(11) NOT NULL,
  `primaryRole` enum('Tank','Fighter','Marksman','Mage','Assassin','Support') NOT NULL,
  `secondaryRole` enum('Tank','Fighter','Marksman','Mage','Assassin','Support') NOT NULL,
  `gameMode` enum('Classic','Ranked','Brawl') NOT NULL,
  `mlbbdata_id` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_preference`
--

INSERT INTO `tbl_preference` (`preference_id`, `primaryRole`, `secondaryRole`, `gameMode`, `mlbbdata_id`, `createdBy`, `createdAt`) VALUES
(22, 'Tank', 'Fighter', 'Classic', 7, 7, '2021-11-07 11:16:57'),
(23, 'Fighter', 'Marksman', 'Classic', 10, 14, '2021-11-07 11:18:25'),
(24, 'Marksman', 'Mage', 'Classic', 11, 15, '2021-11-07 11:19:28'),
(25, 'Mage', 'Assassin', 'Classic', 12, 16, '2021-11-07 11:20:21'),
(27, 'Assassin', 'Support', 'Classic', 14, 17, '2021-11-11 14:30:32'),
(28, 'Support', 'Mage', 'Ranked', 16, 19, '2021-11-28 13:27:50');

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
  `status` enum('OPEN','PENDING','RESOLVED','CLOSED') NOT NULL DEFAULT 'OPEN',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tickets`
--

INSERT INTO `tbl_tickets` (`ticket_id`, `createdBy`, `title`, `body`, `status`, `createdAt`, `updatedAt`) VALUES
(2, 7, '1914 translation by H. Rackham Test', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', 'OPEN', '2021-11-26 11:20:47', '2021-11-27 02:46:59'),
(3, 7, '1914 translation by H. Rackham Test', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', 'OPEN', '2021-11-26 11:20:47', '2021-11-27 02:46:59'),
(5, 7, 'fsdfdsfds', 'ticket new by aczell', 'OPEN', '2021-11-27 02:52:44', '2021-11-27 02:52:44');

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
  `type` enum('USER','ADMIN') DEFAULT 'USER',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `firstname`, `lastname`, `email`, `username`, `password`, `birthday`, `currentLobbyUUID`, `type`, `createdAt`, `updatedAt`) VALUES
(7, 'Test', 'User', 'testuser@gmail.com', 'testuser', '$2y$10$AS/1aK3epaE3.1d4Wv8AAu3bsTkyNK7Vfr4b12D44kpqzf7g5ck6W', '0000-00-00', NULL, 'USER', '2021-10-31 11:18:45', '2021-11-28 13:24:15'),
(8, 'Aczell', 'Florencio', 'aczellbien.florencio2@gmail.com', 'keenplify', '$2y$10$Zy3HVEAAzZkGJyjQuFfjQuPgy5cd2hwT1UDv853LtcvyJk3L.gwJS', '2002-02-02', NULL, 'USER', '2021-11-02 02:07:21', '2021-11-05 06:55:20'),
(14, 'test', 'user 2', 'testuser2@gmail.com', 'testuser2', '$2y$10$1MryMN8svJpJo21J0eW8belY1HPT9cKzVzod3MpK1ihYlJq55HKtS', '2003-11-04', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 'USER', '2021-11-04 12:35:34', '2021-11-14 11:42:36'),
(15, 'test', 'user3', 'testuser3@gmail.com', 'testuser3', '$2y$10$8xuY7i39DZfMy08MCUrtoOBrk.CD6nFAYGY4QEAac.koDIRlrRQlC', '2003-11-04', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 'USER', '2021-11-04 14:06:50', '2021-11-14 11:42:36'),
(16, 'test', 'user4', 'testuser4@gmail.com', 'testuser4', '$2y$10$glqhHFG7HPicCqOvVynMTuGhj4EADnGw6UA6tnWfHdG1.3X7xtbOK', '2003-11-04', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 'USER', '2021-11-04 14:13:05', '2021-11-14 11:42:36'),
(17, 'test', 'user5', 'testuser5@gmail.com', 'testuser5', '$2y$10$07DY568Pg8OZeKTrMeWFdeQabu6OpQ.IAc4L40CpPEft6nuGoa0jK', '2003-11-04', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 'USER', '2021-11-04 14:18:44', '2021-11-14 11:42:36'),
(18, 'Admin', 'User', 'admin@gmail.com', 'admin', '$2y$10$C.xqHQoA22qHCKdWoVUpqutyo.2u8ldw904DvpCo519C1qvVc39bW', '2002-02-02', NULL, 'ADMIN', '2021-11-26 12:47:49', '2021-11-26 12:47:49'),
(19, 'Aczell', 'Florencio', 'knplfy@gmail.com', 'knplfy', '$2y$10$LEB8IXS1N5L6HGjrYxA8U.QEyErK.OoZ2CAs613R4LlbZPF8qddiy', '2002-02-02', NULL, 'USER', '2021-11-28 13:26:00', '2021-11-28 13:26:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_friend`
--
ALTER TABLE `tbl_friend`
  ADD PRIMARY KEY (`friend_id`),
  ADD KEY `fkFriendCreatedBy` (`createdBy`);

--
-- Indexes for table `tbl_lobby`
--
ALTER TABLE `tbl_lobby`
  ADD PRIMARY KEY (`lobby_id`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `fkMessageCreatedBy` (`createdBy`),
  ADD KEY `fkMessageLobbyUUID` (`lobbyUUID`);

--
-- Indexes for table `tbl_mlbbdata`
--
ALTER TABLE `tbl_mlbbdata`
  ADD PRIMARY KEY (`data_id`),
  ADD KEY `fkMLBBDataCreatedBy` (`createdBy`);

--
-- Indexes for table `tbl_preference`
--
ALTER TABLE `tbl_preference`
  ADD PRIMARY KEY (`preference_id`),
  ADD KEY `fkPreferenceCreatedBy` (`createdBy`),
  ADD KEY `fkPreferenceMLBBData` (`mlbbdata_id`);

--
-- Indexes for table `tbl_queue`
--
ALTER TABLE `tbl_queue`
  ADD PRIMARY KEY (`queue_id`),
  ADD KEY `fkQueueCreatedBy` (`createdBy`),
  ADD KEY `fkQueuePreferenceId` (`preferenceId`);

--
-- Indexes for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `fkCreatedBy` (`createdBy`);

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
  MODIFY `friend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_lobby`
--
ALTER TABLE `tbl_lobby`
  MODIFY `lobby_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_mlbbdata`
--
ALTER TABLE `tbl_mlbbdata`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_preference`
--
ALTER TABLE `tbl_preference`
  MODIFY `preference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_queue`
--
ALTER TABLE `tbl_queue`
  MODIFY `queue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_friend`
--
ALTER TABLE `tbl_friend`
  ADD CONSTRAINT `fkFriendCreatedBy` FOREIGN KEY (`createdBy`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD CONSTRAINT `fkMessageCreatedBy` FOREIGN KEY (`createdBy`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkMessageLobbyUUID` FOREIGN KEY (`lobbyUUID`) REFERENCES `tbl_lobby` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_mlbbdata`
--
ALTER TABLE `tbl_mlbbdata`
  ADD CONSTRAINT `fkMLBBDataCreatedBy` FOREIGN KEY (`createdBy`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_preference`
--
ALTER TABLE `tbl_preference`
  ADD CONSTRAINT `fkPreferenceCreatedBy` FOREIGN KEY (`createdBy`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkPreferenceMLBBData` FOREIGN KEY (`mlbbdata_id`) REFERENCES `tbl_mlbbdata` (`data_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_queue`
--
ALTER TABLE `tbl_queue`
  ADD CONSTRAINT `fkQueueCreatedBy` FOREIGN KEY (`createdBy`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkQueuePreferenceId` FOREIGN KEY (`preferenceId`) REFERENCES `tbl_preference` (`preference_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  ADD CONSTRAINT `fkCreatedBy` FOREIGN KEY (`createdBy`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
