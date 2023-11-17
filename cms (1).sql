-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 17, 2023 at 06:36 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(58, 'WWE 2K23');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_date` date NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(68, 58, 'ark sruvival', 'james', '', '2023-09-29', '', '<p>ark</p>', 'ark', 8, 'published', 7),
(69, 58, 'WWE', 'vince', '', '2023-09-29', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(70, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(71, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 0),
(72, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 3),
(73, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(74, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(75, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 0),
(76, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 0),
(77, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(78, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(79, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 0),
(80, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 0),
(81, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(82, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(83, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 0),
(84, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 0),
(85, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(86, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(87, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 0),
(88, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 0),
(89, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(90, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(91, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 0),
(92, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 1),
(93, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(94, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 2),
(95, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 0),
(96, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 0),
(97, 58, 'WWE', 'vince', '', '2023-10-01', '', '<p>WWE</p>', 'WWE', 0, 'published', 0),
(101, 58, 'ark sruvival', 'james', '', '2023-10-01', '', '<p>ark</p>', 'ark', 0, 'published', 2),
(102, 58, 'wwe', '', '49', '2023-10-23', '', '<p>wwe</p>', 'wwe', 0, 'published', 0),
(103, 58, 'wwe', '', '49', '2023-10-23', '', '<p>www</p>', 'wwe', 0, 'published', 0),
(105, 58, 'wwe', '50', '50', '2023-10-23', 'images.jpg', '<p>wwe</p>', 'wwe', 0, 'draft', 0),
(106, 58, 'wwe', '49', '49', '2023-10-23', '', '<p>wwe</p>', 'wwe', 0, 'draft', 0),
(107, 58, 'wwe', '13', '13', '2023-10-23', 'images (2).jpg', '<p>www</p>', 'www', 0, 'draft', 0),
(108, 58, 'www', 'www', 'www', '2023-10-23', '', '<p>www</p>', 'www', 0, 'draft', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(49, 'www', '$2y$12$1btjGQQahNifYl43MDwmqusgkClWYXUHPGA8NeNg6fITyUq/pGem6', 'abcd', 'efg', 'w@gmail.com', 'images.jpg', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(50, '13', '$2y$12$Jwcjw7N4BHQth8pb.zJQ3Ok9acxwDfxLLzHZXPIEDS4fqX4dkbGxO', '', '', '13@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(13, '7b4e5db7751660199d827e649272e483', 1696444620),
(14, '7f90df470ff2cdaed47285baea586db3', 1696533284),
(15, '565f76ff55d3dd92e6e780bd177f212f', 1696794089),
(16, '23092492592a18a08cd4fb04eab512b5', 1696882453),
(17, '04177750e05165739d84e1b1d5ef9ebe', 1696944639),
(18, 'd7a06b18de7ba4a7c1e785b5977e15ec', 1697745106),
(19, '0cec83db8d5be8acd637cf67d85a0c03', 1697818383),
(20, 'd18d356f26b1136b8eca93859f10599d', 1697832890),
(21, 'ccbe290c35f9dc92b102b6187c2e331a', 1698066284);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
