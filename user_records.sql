-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 11, 2025 at 07:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_records`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPwd`) VALUES
(1, 'newuser', 'new@gmail.com', 'newuser12', '$2y$10$Wvyd08dHXonxkCrjDqWBfu17IKb3OLydJfG38ltVMCthXJ0BInTr2'),
(2, 'My Name', 'myname@gmail.com', 'myname', '$2y$10$VJHzOc/AeBc1UpCjeIJ.fOwehiIlBfJZC/5DdoIYwwjBsfr6AgvSW'),
(3, 'First User', 'user1@gmail.com', 'imFirstUser', '$2y$10$4tpKovLKuDmdAK/046oo.uvnZsYwRYw9BqDfnZeUGQsxnyeL.7U3e');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_favourite` tinyint(1) DEFAULT 0,
  `thumbnail_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `file_path`, `user_id`, `upload_date`, `is_favourite`, `thumbnail_path`) VALUES
(97, 'Video 21', 'uploads/66a559065f4a46.47298146.mp4', 2, '2024-07-27 20:31:02', 0, 'uploads/thumbnails/66a559065f4c72.00712381.jpg'),
(98, 'Video 22', 'uploads/66a55918b2b258.39219537.mp4', 2, '2024-07-27 20:31:20', 1, 'uploads/thumbnails/66a55918b2b480.38296507.jpg'),
(99, 'Video 23', 'uploads/66a559241e3391.15889696.mp4', 2, '2024-07-27 20:31:32', 1, 'uploads/thumbnails/66a559241e36d1.73318867.jpg'),
(100, 'Video 1', 'uploads/66a55bf8961ff8.74946904.mp4', 1, '2024-07-27 20:43:36', 1, 'uploads/thumbnails/66a55bf8962348.93720851.jpg'),
(101, 'Video 2', 'uploads/66a55c08041e24.05281928.mp4', 1, '2024-07-27 20:43:52', 1, 'uploads/thumbnails/66a55c08042016.81329434.jpg'),
(102, 'Video 3', 'uploads/66a561460d3f63.35717890.mp4', 1, '2024-07-27 21:06:14', 0, 'uploads/thumbnails/66a561460d42f9.98490329.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_id` (`video_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`usersId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
