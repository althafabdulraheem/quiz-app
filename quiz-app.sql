-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 26, 2024 at 01:32 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `option_name` varchar(255) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `is_answer` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_name`, `quest_id`, `is_answer`, `created_at`) VALUES
(1, 'Mercury', 1, '0', '2024-09-24 11:45:58'),
(2, 'Venus', 1, '0', '2024-09-24 11:46:23'),
(3, 'Earth', 1, '0', '2024-09-24 11:46:23'),
(4, 'Jupiter', 1, '1', '2024-09-24 11:46:54'),
(5, 'Mars', 1, '0', '2024-09-24 11:46:54'),
(6, 'Thomas Edison', 2, '1', '2024-09-24 11:53:47'),
(7, 'Albert Einstein', 2, '0', '2024-09-24 11:55:47'),
(8, 'Marie Curie', 2, '0', '2024-09-24 11:55:47'),
(9, 'Isaac Newton', 2, '0', '2024-09-24 11:56:25'),
(10, 'Charles Darwin', 2, '0', '2024-09-24 11:56:25'),
(11, 'Albury-Wodonga', 3, '0', '2024-09-24 11:57:41'),
(12, 'Bega', 3, '0', '2024-09-24 11:57:41'),
(13, 'Campbelltown', 3, '0', '2024-09-24 11:58:03'),
(14, 'Corowa', 3, '0', '2024-09-24 11:58:03'),
(15, 'Canberra', 3, '1', '2024-09-24 11:58:29'),
(16, 'Nile', 4, '1', '2024-09-25 12:42:50'),
(17, 'Amazon', 4, '0', '2024-09-25 12:43:27'),
(18, 'Amur', 4, '0', '2024-09-25 12:43:27'),
(19, 'Mekong River', 4, '0', '2024-09-25 12:44:03'),
(20, 'Volga River', 4, '0', '2024-09-25 12:44:03'),
(21, 'Antarctica Desert', 5, '1', '2024-09-25 12:45:20'),
(22, 'Thar Desert', 5, '0', '2024-09-25 12:45:40'),
(23, 'Cholistan Desert', 5, '0', '2024-09-25 12:45:40'),
(24, 'Simpson Desert', 5, '0', '2024-09-26 10:53:01'),
(25, 'Tanami Desert', 5, '0', '2024-09-26 10:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `created_at`) VALUES
(1, 'What is the largest planet in our solar system?', '2024-09-24 11:42:05'),
(2, 'Who invented the light bulb?', '2024-09-24 11:42:26'),
(3, 'What is the capital of Australia', '2024-09-24 11:42:39'),
(4, 'Which river is the longest in the world', '2024-09-24 11:42:49'),
(5, 'What is the largest desert in the world', '2024-09-24 11:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
