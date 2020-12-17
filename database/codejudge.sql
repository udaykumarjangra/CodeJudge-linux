-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2020 at 03:36 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codejudge`
--

-- --------------------------------------------------------
CREATE DATABASE codejudge;
--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `pid` int(11) NOT NULL,
  `problem_title` varchar(100) NOT NULL,
  `problem_statement` varchar(2000) NOT NULL,
  `testcase_input1` varchar(500) NOT NULL,
  `testcase_output1` varchar(500) NOT NULL,
  `testcase_input2` varchar(500) NOT NULL,
  `testcase_output2` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`pid`, `problem_title`, `problem_statement`, `testcase_input1`, `testcase_output1`, `testcase_input2`, `testcase_output2`) VALUES
(1, 'Array Sum', 'Write a program to find the sum of elements of an array.\r\nFirst line contains the length n of the array.\r\nSecond line consists of n elements.\r\nSample Input:\r\n5\r\n1 4 5 6 7\r\nSample Output:\r\n23\r\n\r\n', '2\r\n0 0', '0', '4\r\n1 1 1 1', '4'),
(2, 'Difference of 2 Numbers', 'Write a program to find the difference between 2 numbers.\r\nThe program should take 2 numbers as input from the user and should print its difference.\r\nSample Test Case Input:\r\n6\r\n4\r\n\r\nSample Output:\r\n2', '5\r\n4', '1', '4\r\n5', '-1'),
(3, 'Greatest of 2', 'Write a program to find the greatest number out of 2.\r\nThe first line contains the first number.\r\nThe second line contains the second number.\r\n\r\nSample Input:\r\n2\r\n3\r\n\r\nSample Output\r\n3', '10\r\n1', '10', '5\r\n5', '5'),
(4, 'Sort an Array', 'Write a program to sort an array in ascending order.\r\nThe first line contains the length of the array.\r\nThe second line contains the elements.\r\n\r\nSample Input:\r\n5\r\n3 2 6 4 7\r\n\r\nSample Output:\r\n2 3 4 6 7 ', '3\r\n9 8 7', '7 8 9', '6\r\n1 2 3 4 5 6', '1 2 3 4 5 6');

-- --------------------------------------------------------

--
-- Table structure for table `problems_user`
--

CREATE TABLE `problems_user` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `problem_answer` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problems_user`
--

INSERT INTO `problems_user` (`id`, `pid`, `uid`, `problem_answer`) VALUES
(1, 1, 1, 'I did it');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `email`) VALUES
(1, 'user', '$2y$10$2jeU6DflZF87n46ItcPsK.dwF032y770cXX8G2fS8HbH8MlM5cdPC', 'user@user.com'),
(6, 'Admin', '$2y$10$lyQBIb6UWBheG9ISMkIk8OeDkaACUM7no9qBNXMk2rROpl0H3yySq', 'admin@admin.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `problems_user`
--
ALTER TABLE `problems_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `problems_user`
--
ALTER TABLE `problems_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
