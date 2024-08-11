-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 09:29 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `uid` int(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`uid`, `name`, `email`, `password`) VALUES
(1, 'S. Mali', 'admin1@outlook.com', 'admin456');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `aid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`aid`, `name`) VALUES
(1, 'Behrouz A. Forouzan'),
(3, 'P. C. Das'),
(4, 'S. C. Gupta'),
(5, 'Raymond Murphy'),
(6, 'Melony Jacobs'),
(7, 'Raef Meeuwisse'),
(8, 'R. Nageswara Rao'),
(11, 'Jacob Fraden'),
(12, 'Norman S. Nise'),
(13, 'Darren Hardy'),
(14, 'Anirudha Bhattacharjee'),
(17, 'Hansaji J. Yogendra');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `isbn` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `locker_no` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `author_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bid`, `name`, `isbn`, `status`, `locker_no`, `price`, `author_id`, `category_id`) VALUES
(1, 'Data Communications & Networking (3rd Ed.)', '07-254-8', 1, 7, 949, 1, 1),
(3, 'Applied English (Beng. Ed. 2020)', '978-8105', 1, 2, 492, 3, 2),
(4, 'English Grammar & Composition (2nd Ed.)', '9355140', 1, 2, 375, 4, 2),
(5, 'Essential English Grammar (2nd Ed.)', '8175969', 1, 2, 345, 5, 2),
(6, 'English Grammar Rules 101', '1989082', 1, 2, 1007, 6, 2),
(7, 'Cybersecurity for Beginners (2nd Ed.)', '1911534', 1, 7, 1500, 7, 1),
(8, 'Core Python Programming (3rd Ed.)', '978-9351', 1, 7, 735, 8, 1),
(9, 'Cryptography & Network Security (3rd Ed.)', '978-0532', 1, 7, 740, 1, 1),
(10, 'C++ Programming (1st Ed.)', '9355309', 0, 8, 759, 1, 1),
(11, 'The Ultimate C (1st Ed.)', '8192531', 1, 8, 320, 8, 1),
(12, 'Handbook of Modern Sensors (5th Ed.)', '3319373', 1, 10, 6560, 11, 3),
(13, 'Nise\'s Control Systems Engineering (1st IN Ed.)', '8126571', 1, 10, 894, 12, 3),
(14, 'The Compound Effect (2020 Ed.)', '978-9639', 1, 5, 320, 13, 4),
(16, 'Kishore Kumar: The Ultimate Biography', '978-1713', 1, 1, 400, 14, 5),
(19, 'Sattvik Cooking: Modern Avatars of Vedic Foods', '978-0590', 1, 4, 395, 17, 8),
(20, 'Yoga For All: Discovering The True Essence of Yoga (1st Ed.)', '978-5700', 0, 9, 275, 17, 9);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `name`) VALUES
(1, 'Computer Science'),
(2, 'English Grammer'),
(3, 'Electronics'),
(4, 'Self Improvement'),
(5, 'Autobiography'),
(8, 'Cooking'),
(9, 'Health');

-- --------------------------------------------------------

--
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `ibid` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `days_late` int(10) DEFAULT NULL,
  `fine` int(10) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `author_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issued_books`
--

INSERT INTO `issued_books` (`ibid`, `status`, `issue_date`, `due_date`, `return_date`, `days_late`, `fine`, `user_id`, `book_id`, `author_id`) VALUES
(1, 0, '2021-06-13', '2021-07-13', '2021-07-17', 3, 75, 1, 1, 1),
(2, 0, '2021-06-17', '2021-07-17', '2021-07-19', 2, 50, 6, 5, 5),
(3, 0, '2021-06-17', '2021-07-17', '2021-07-17', 0, 0, 5, 14, 13),
(4, 0, '2021-06-19', '2021-07-19', '2021-07-18', 0, 0, 2, 8, 8),
(5, 0, '2021-06-20', '2021-07-20', '2021-07-19', 0, 0, 1, 12, 11),
(7, 0, '2021-06-24', '2021-07-24', '2021-07-24', 0, 0, 5, 19, 17),
(8, 0, '2021-06-25', '2021-07-25', '2021-07-24', 0, 0, 4, 6, 6),
(9, 0, '2021-06-25', '2021-07-25', '2021-07-24', 0, 0, 6, 16, 14),
(10, 0, '2021-06-27', '2021-07-27', '2021-07-25', 0, 0, 4, 16, 14),
(11, 1, '2021-07-01', '2021-08-01', NULL, NULL, NULL, 4, 20, 17);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rid` int(10) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `user_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rid`, `rating`, `user_id`, `book_id`) VALUES
(3, 3, 6, 5),
(4, 5, 6, 16),
(5, 4, 4, 6),
(6, 5, 5, 14),
(7, 4, 2, 8),
(9, 5, 4, 16),
(11, 4, 4, 20),
(12, 4, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry_date` date DEFAULT NULL,
  `gender` varchar(6) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `joined` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `email`, `password`, `reset_token`, `reset_token_expiry_date`, `gender`, `mobile`, `address`, `joined`) VALUES
(1, 'A. Manna', 'am5@gmail.com', '11111111', NULL, NULL, 'male', 9009911221, 'Garia, Kolkata, India', '2021-06-05 09:13:05'),
(2, 'D. Das', 'dd2@gmail.com', '22222222', NULL, NULL, 'male', 9999988885, 'Garia, Kolkata, India', '2021-06-05 11:23:05'),
(4, 'S. Roy', 'tempcode1260@gmail.com', '11112222', NULL, NULL, 'male', 8888021133, 'Dum Dum, N24 Parganas, India', '2021-06-06 13:17:43'),
(5, 'R. Mali', 'rn8@gmail.com', '44444444', NULL, NULL, 'female', 9999999912, 'Sonarpur, S24 Parganas, India', '2021-06-08 12:07:44'),
(6, 'M. Paul', 'mp4@gmail.com', '55555555', NULL, NULL, 'female', 8888111122, 'Naihati, Nadia, India', '2021-06-11 16:15:41'),
(7, 'P. Majumder', 'pm9@gmail.com', '99999999', NULL, NULL, 'female', 9999911228, 'Salt Lake, Kolkata, India', '2023-07-25 16:48:15'),
(8, 'S. Sarma', 'ss@gmail.com', '24242424', NULL, NULL, 'female', 8888899999, 'Ichapur, WB, India', '2024-08-11 08:36:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`ibid`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rid`),
  ADD UNIQUE KEY `unique_user_book` (`user_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `uid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `ibid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`aid`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`cid`);

--
-- Constraints for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD CONSTRAINT `issued_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `issued_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`bid`),
  ADD CONSTRAINT `issued_books_ibfk_3` FOREIGN KEY (`author_id`) REFERENCES `authors` (`aid`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`bid`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
