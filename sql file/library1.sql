-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 03:40 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password123');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `full name` int(255) NOT NULL,
  `dob` date NOT NULL,
  `bookname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `file_path`) VALUES
(2, 'Dusk till dawn', 'Zayn Sia', 'Romance', 'uploads/659f05b5a9c54_Machine Leaning Model For Detection of Mental Health Disorders.pdf'),
(3, 'Twilight', 'JackPeterson Edward', 'Action', 'uploads/659f05bab75bc_Machine Leaning Model For Detection of Mental Health Disorders.pdf'),
(4, 'Batman Begins', 'Clark Kent', 'Action, Drama', 'uploads/659f05d1f00bf_Machine Leaning Model For Detection of Mental Health Disorders.pdf'),
(5, 'Keeping up with Shay shay', 'Katt wiliams', 'Comedy', 'uploads/659f05d705987_Machine Leaning Model For Detection of Mental Health Disorders.pdf'),
(6, 'War dogs', 'Brad pitt Jolie', 'sci-fi', 'uploads/659f05dd8d6c8_Machine Leaning Model For Detection of Mental Health Disorders.pdf'),
(7, 'Barbenheimer', 'Evans tony', 'sci-fi', 'uploads/659f075b8e709_Everything Is Fcked A Book About Hope (Mark Manson) (z-lib.org).pdf'),
(8, 'Pathan', 'Sharruk Khan', 'action,comedy,drama', 'uploads/659f0876d3f5b_Chapter Lecture 8-Finance 2023.pdf'),
(9, 'Focus', 'Will Smith Pinket', 'drama', 'uploads/659f091fa8701_psychologypower.pdf'),
(10, 'Last of us', 'Jimmy Jimmy', 'action ', 'uploads/659f1e165bca1_Fibonacci Ratios with Pattern Recognition - Larry Pesavento.pdf'),
(11, 'Fleek or Flight', 'Bruce Melody', 'Comedy', 'uploads/659f4ca8dcc6d_Trade the Price Action - Laurentiu Damir.pdf'),
(12, 'Damnation', 'Bruce Melody', 'Horror', 'uploads/659f4cdc9d1a6_Forex Trading With Price Action - Raoul Hunter.pdf'),
(13, '2012', 'Michael ryan', 'Horror', 'uploads/659f4d2906e86_Forex Patterns Probabilities - Ed Ponsi.pdf'),
(14, 'Scream ', 'Michael ryan', 'Horror, Romance', 'uploads/659f4d4857812_Forex Patterns Probabilities - Ed Ponsi.pdf'),
(15, 'KGF vol 1', 'Rocky bhai', 'action', 'uploads/659f4d955c3c4_Advanced_Forex_Trading_Learn_the_Advanced_Forex_Investing_Strategies.pdf'),
(16, 'KGF Vol 2', 'Rocky bhai', 'Action', 'uploads/659f4e19549f7_psychologypower.pdf'),
(17, 'KGF Vol 3', 'Rocky bhai', 'Action, horror', 'uploads/659f4e2851031_psychologypower.pdf'),
(18, 'Tiger Vol 1', 'Salman Khan', 'Action, horror', 'uploads/659f4e4bc8c74_Day Trading and Swing Trading the Currency Market.pdf'),
(19, 'Black Panther ', 'StevecLee', 'Action', 'uploads/659f4e8e2143b_Forex Strategy The Price in Time - Gabriele Fabris.pdf'),
(20, 'Logan', 'Deadpool', 'Action', 'uploads/659f4eb698dc9_Essential Technical Analysis - Leigh Stevens.pdf'),
(21, 'Vampaire Dairies', 'Damon Salvatore', 'action, horror, romance', 'uploads/659f4f09d55ed_Forex_Trading_Profitable_Candlestick_Patterns_Matt_Anderson.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `book_interactions`
--

CREATE TABLE `book_interactions` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action_type` enum('like','comment') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_interactions`
--

INSERT INTO `book_interactions` (`id`, `book_id`, `user_id`, `action_type`, `timestamp`) VALUES
(1, 2, 1, 'like', '2024-01-11 00:39:49'),
(2, 2, 1, 'comment', '2024-01-11 00:40:00'),
(3, 3, 1, 'like', '2024-01-11 00:41:20'),
(4, 4, 1, 'like', '2024-01-11 00:41:26'),
(5, 2, 1, 'like', '2024-01-11 00:43:00'),
(6, 3, 1, 'like', '2024-01-11 00:43:03'),
(7, 4, 1, 'like', '2024-01-11 00:43:07'),
(8, 5, 1, 'like', '2024-01-11 01:15:44'),
(9, 3, 1, 'like', '2024-01-11 02:17:28'),
(10, 2, 1, 'like', '2024-01-11 02:17:32'),
(11, 2, 1, 'like', '2024-01-11 02:17:34'),
(12, 2, 1, 'like', '2024-01-11 02:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` int(255) NOT NULL,
  `gender` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phonenumber`, `gender`, `username`, `password`) VALUES
(2, 'Jane Smith', 'jane.smith@example.com', 2147483647, 'Female', 'jane_smith', 'password456'),
(3, 'Bob Johnson', 'bob.johnson@example.com', 2147483647, 'Male', 'bob_johnson', 'securepass'),
(4, 'Alice Green', 'alice.green@example.com', 1239874560, 'Female', 'alice_green', 'pass123'),
(5, 'Charlie Brown', 'charlie.brown@example.com', 2147483647, 'Male', 'charlie_brown', 'strongpass'),
(6, 'Emily White', 'emily.white@example.com', 2147483647, 'Female', 'emily_white', 'mypassword'),
(7, 'David Wilson', 'david.wilson@example.com', 2147483647, 'Male', 'david_wilson', 'secure123'),
(8, 'Sophia Turner', 'sophia.turner@example.com', 2147483647, 'Female', 'sophia_turner', 'hellopass'),
(9, 'James Miller', 'james.miller@example.com', 2147483647, 'Male', 'james_miller', 'mypass123'),
(10, 'Olivia Davis', 'olivia.davis@example.com', 1357902468, 'Female', 'olivia_davis', 'secret123'),
(17, 'sss', 'jhdfsdnjd@gmail.com', 223344322, 'female', 'jackjimmy602@gmail.com', '12333'),
(18, 'loma', 'jhdfsdnjd@gmail.com', 223344322, 'male', 'jackjimmy602@gmail.com', '12333'),
(19, 'loma', 'jhdfsdnjd@gmail.com', 223344322, 'male', 'jackjimmy602@gmail.com', '12333'),
(20, '', '', 0, '', '', ''),
(21, 'loma', 'jhdfsdnjd@gmail.com', 223344322, 'male', 'jackjimmy602@gmail.com', '12333'),
(22, '', '', 0, '', '', ''),
(23, 'loma', 'jhdfsdnjd@gmail.com', 223344322, 'male', 'jackjimmy602@gmail.com', '12333'),
(24, 'loma', 'jhdfsdnjd@gmail.com', 223344322, 'male', 'jackjimmy602@gmail.com', '12333'),
(25, '', '', 0, 'male', '', ''),
(26, 'loma', 'mwantumu@gmail.com', 22222, 'male', '1738', 'hhhhh'),
(27, 'kintu massawe', 'kintmassawe@gmail.com', 2147483647, 'male', 'kintusaa', 'kintusaa'),
(28, 'test', 'test@gmail.com', 712345678, 'male', 'test', 'test12344'),
(29, 'Dani Msangi', 'msngii@yahoo.com', 657243153, 'male', 'solosngii', '$2y$10$LLaKwfftWTGH8b8lyBuWg.kLdZYNjgE.VSApflEL1FkFzUrdz8niC'),
(30, 'testing', 'testing@gmail.com', 712356783, 'female', 'Testing1', '$2y$10$VMXq8xD/fxeGFwaKOXVeqezbjxbOlMdXykuBI80qsTdfDBnyB6xjK'),
(31, 'klaus michaeel', 'klausm12@gmail.com', 712563241, 'male', 'klaus12', '$2y$10$J0xNxzz3.dfYI0yRxotyNOFlDG10ipYcMsi1Hck0pNF7N9d815bqK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`full name`),
  ADD KEY `bookname` (`bookname`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_interactions`
--
ALTER TABLE `book_interactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `book_interactions`
--
ALTER TABLE `book_interactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
