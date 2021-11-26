-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2021 at 02:04 PM
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
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`json`)),
  `uuid` varchar(64) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lobby`
--

INSERT INTO `tbl_lobby` (`lobby_id`, `json`, `uuid`, `createdAt`) VALUES
(1, '{\"id\":\"bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c\",\"gamemode\":\"Classic\",\"players\":{\"Tank\":{\"preference\":{\"preference_id\":22,\"primaryRole\":\"Tank\",\"secondaryRole\":\"Fighter\",\"gameMode\":\"Classic\",\"mlbbdata_id\":7,\"createdBy\":7,\"createdAt\":\"2021-11-07T11:16:57.000Z\"},\"queue\":{\"queue_id\":229,\"createdBy\":7,\"preferenceId\":22,\"createdAt\":\"2021-11-14T11:42:30.000Z\",\"updatedAt\":\"2021-11-14T11:42:30.000Z\"}},\"Fighter\":{\"preference\":{\"preference_id\":23,\"primaryRole\":\"Fighter\",\"secondaryRole\":\"Marksman\",\"gameMode\":\"Classic\",\"mlbbdata_id\":10,\"createdBy\":14,\"createdAt\":\"2021-11-07T11:18:25.000Z\"},\"queue\":{\"queue_id\":230,\"createdBy\":14,\"preferenceId\":23,\"createdAt\":\"2021-11-14T11:42:30.000Z\",\"updatedAt\":\"2021-11-14T11:42:30.000Z\"}},\"Marksman\":{\"preference\":{\"preference_id\":24,\"primaryRole\":\"Marksman\",\"secondaryRole\":\"Mage\",\"gameMode\":\"Classic\",\"mlbbdata_id\":11,\"createdBy\":15,\"createdAt\":\"2021-11-07T11:19:28.000Z\"},\"queue\":{\"queue_id\":231,\"createdBy\":15,\"preferenceId\":24,\"createdAt\":\"2021-11-14T11:42:31.000Z\",\"updatedAt\":\"2021-11-14T11:42:31.000Z\"}},\"Assassin\":{\"preference\":{\"preference_id\":27,\"primaryRole\":\"Assassin\",\"secondaryRole\":\"Support\",\"gameMode\":\"Classic\",\"mlbbdata_id\":14,\"createdBy\":17,\"createdAt\":\"2021-11-11T14:30:32.000Z\"},\"queue\":{\"queue_id\":232,\"createdBy\":17,\"preferenceId\":27,\"createdAt\":\"2021-11-14T11:42:32.000Z\",\"updatedAt\":\"2021-11-14T11:42:32.000Z\"}},\"Mage\":{\"preference\":{\"preference_id\":25,\"primaryRole\":\"Mage\",\"secondaryRole\":\"Assassin\",\"gameMode\":\"Classic\",\"mlbbdata_id\":12,\"createdBy\":16,\"createdAt\":\"2021-11-07T11:20:21.000Z\"},\"queue\":{\"queue_id\":233,\"createdBy\":16,\"preferenceId\":25,\"createdAt\":\"2021-11-14T11:42:32.000Z\",\"updatedAt\":\"2021-11-14T11:42:32.000Z\"}}}}', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', '2021-11-14 11:42:36');

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
(47, 'test', '8e1ff521-cb59-4cd5-bce5-176a9121ab5e', 17, '2021-11-05 13:23:53'),
(48, 'hello invite me na ', '384181f5-4611-4d8b-b40e-89e079541dab', 17, '2021-11-11 14:31:45'),
(49, 'ok wait po', '384181f5-4611-4d8b-b40e-89e079541dab', 14, '2021-11-11 14:32:06'),
(50, 'thx', '384181f5-4611-4d8b-b40e-89e079541dab', 7, '2021-11-11 14:32:13'),
(51, 'dsadsadsa', '384181f5-4611-4d8b-b40e-89e079541dab', 7, '2021-11-11 14:33:02'),
(52, 'fdsfdsfdsjik', '41b66d91-1c2e-4c18-bebe-efdca07c6f6e', 17, '2021-11-11 14:43:05'),
(53, 'dsadas', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 16, '2021-11-14 11:44:12'),
(54, 'gfdgdfg', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 7, '2021-11-14 11:44:20'),
(55, 'adsadaadsa', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 7, '2021-11-14 11:44:22'),
(56, 'dsadsa', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 14, '2021-11-14 12:05:22'),
(57, 'yeet', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 14, '2021-11-14 12:05:24');

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
(7, 7, 'test', 'GGLeviii2', '2021-11-07 10:15:35', '2021-11-07 10:40:09'),
(8, 7, '12321443', 'Keenplify', '2021-11-07 10:30:55', '2021-11-07 10:30:55'),
(10, 14, '42132111', 'Keenplify', '2021-11-07 11:17:58', '2021-11-07 11:17:58'),
(11, 15, 'dfsaasda3', 'TestUser3', '2021-11-07 11:19:08', '2021-11-07 11:19:08'),
(12, 16, '32132131', 'TestUser4', '2021-11-07 11:20:08', '2021-11-07 11:20:08'),
(13, 17, '14241215', 'TestUser5', '2021-11-07 11:21:48', '2021-11-07 11:21:48'),
(14, 17, '987984232', 'CuteAko123', '2021-11-11 14:30:08', '2021-11-11 14:30:08');

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
(27, 'Assassin', 'Support', 'Classic', 14, 17, '2021-11-11 14:30:32');

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
(1, 7, 'Test Ticket by Test User', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'OPEN', '2021-11-26 11:20:47', '2021-11-26 11:20:47'),
(2, 7, 'Another Ticket', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'OPEN', '2021-11-26 11:20:47', '2021-11-26 12:16:35');

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
(7, 'Test', 'User', 'testuser@gmail.com', 'testuser', '$2y$10$AS/1aK3epaE3.1d4Wv8AAu3bsTkyNK7Vfr4b12D44kpqzf7g5ck6W', '0000-00-00', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 'USER', '2021-10-31 11:18:45', '2021-11-14 11:42:36'),
(8, 'Aczell', 'Florencio', 'aczellbien.florencio2@gmail.com', 'keenplify', '$2y$10$Zy3HVEAAzZkGJyjQuFfjQuPgy5cd2hwT1UDv853LtcvyJk3L.gwJS', '2002-02-02', NULL, 'USER', '2021-11-02 02:07:21', '2021-11-05 06:55:20'),
(14, 'test', 'user 2', 'testuser2@gmail.com', 'testuser2', '$2y$10$1MryMN8svJpJo21J0eW8belY1HPT9cKzVzod3MpK1ihYlJq55HKtS', '2003-11-04', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 'USER', '2021-11-04 12:35:34', '2021-11-14 11:42:36'),
(15, 'test', 'user3', 'testuser3@gmail.com', 'testuser3', '$2y$10$8xuY7i39DZfMy08MCUrtoOBrk.CD6nFAYGY4QEAac.koDIRlrRQlC', '2003-11-04', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 'USER', '2021-11-04 14:06:50', '2021-11-14 11:42:36'),
(16, 'test', 'user4', 'testuser4@gmail.com', 'testuser4', '$2y$10$glqhHFG7HPicCqOvVynMTuGhj4EADnGw6UA6tnWfHdG1.3X7xtbOK', '2003-11-04', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 'USER', '2021-11-04 14:13:05', '2021-11-14 11:42:36'),
(17, 'test', 'user5', 'testuser5@gmail.com', 'testuser5', '$2y$10$07DY568Pg8OZeKTrMeWFdeQabu6OpQ.IAc4L40CpPEft6nuGoa0jK', '2003-11-04', 'bd0b3a4c-f539-4b2f-90d8-a8ec8e304d2c', 'USER', '2021-11-04 14:18:44', '2021-11-14 11:42:36'),
(18, 'Admin', 'User', 'admin@gmail.com', 'admin', '$2y$10$C.xqHQoA22qHCKdWoVUpqutyo.2u8ldw904DvpCo519C1qvVc39bW', '2002-02-02', NULL, 'ADMIN', '2021-11-26 12:47:49', '2021-11-26 12:47:49');

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
  MODIFY `lobby_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_mlbbdata`
--
ALTER TABLE `tbl_mlbbdata`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_preference`
--
ALTER TABLE `tbl_preference`
  MODIFY `preference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_queue`
--
ALTER TABLE `tbl_queue`
  MODIFY `queue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
