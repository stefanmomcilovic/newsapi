-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2021 at 01:05 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `news_comment`
--

CREATE TABLE `news_comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `new_title` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_comment`
--

INSERT INTO `news_comment` (`id`, `new_title`, `username`, `comment`, `created_at`) VALUES
(1, 'China\'s-biggest-car-brand-launches-rival-to-Tesla', 'sstefan29', 'Hello!', '2021-03-26 23:26:00'),
(2, 'China\'s-biggest-car-brand-launches-rival-to-Tesla', 'Kyle', 'Sup?', '2021-03-26 23:26:13'),
(3, 'China\'s-biggest-car-brand-launches-rival-to-Tesla', 'someone', 'Hi!', '2021-03-26 23:32:08'),
(4, 'China\'s-biggest-car-brand-launches-rival-to-Tesla', 'someone', 'Tesla!', '2021-03-26 23:32:57'),
(5, 'Elon-Musk-won’t-sell-his-NFT-song-after-all', 'sstefan29', 'comment!', '2021-03-27 00:49:51'),
(6, 'Elon-Musk-won’t-sell-his-NFT-song-after-all', 'kyle', 'mycomment', '2021-03-27 00:50:01'),
(7, 'Elon-Musk-won’t-sell-his-NFT-song-after-all', 'mami', 'hey', '2021-03-27 00:53:54'),
(8, 'Elon-Musk-won’t-sell-his-NFT-song-after-all', 'glagla', 'gla', '2021-03-27 00:54:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news_comment`
--
ALTER TABLE `news_comment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news_comment`
--
ALTER TABLE `news_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
