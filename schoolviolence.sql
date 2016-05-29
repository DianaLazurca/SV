-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2016 at 09:11 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolviolence`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `testID` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `location` varchar(500) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`testID`, `password`, `location`, `username`, `date`, `id`) VALUES
(45, 'PmbPLTBgcHiQBTv', 'http://localhost:8080/Licenta/assets/logs/PmbPLTBgcHiQBTvGeorgicaTestkk11463317857627.json', 'Georgica', '2016-05-15', 10),
(45, 'nV5nvzjDZDClD3zeNkhvkplS', 'http://localhost:8080/Licenta/assets/logs/nV5nvzjDZDClD3zeNkhvkplSkjdTestkk11463347690051.json', 'kjd', '2016-05-15', 13),
(45, 'T2bQbGNvtY2dnCetXPedP', 'http://localhost:8080/Licenta/assets/logs/T2bQbGNvtY2dnCetXPedPMihaelaTestkk11463347622086.json', 'Mihaela', '2016-05-15', 12),
(45, 'Z7E7AoaHImg4kBEAVey6rQHWnvhYFQ2vOW', 'http://localhost:8080/Licenta/assets/logs/Z7E7AoaHImg4kBEAVey6rQHWnvhYFQ2vOWMihaiTestkk11463317832343.json', 'Mihai', '2016-05-15', 9),
(45, '3shUkwOk', 'http://localhost:8080/Licenta/assets/logs/3shUkwOkDianaTestkk11463347593743.json', 'Diana', '2016-05-15', 11),
(45, 'LRAnmpk4G5lvHtl1RHxs8kEb1tU0sH1iV8cTol', 'http://localhost:8080/Licenta/assets/logs/LRAnmpk4G5lvHtl1RHxs8kEb1tU0sH1iV8cTolprofTestkk11463347760223.json', 'prof', '2016-05-15', 14),
(45, 'AhIQjrAaLKJeTLQnbCarASpMADNe9', 'http://localhost:8080/Licenta/assets/logs/AhIQjrAaLKJeTLQnbCarASpMADNe9sdjkfTestkk11463348123222.json', 'sdjkf', '2016-05-15', 15),
(45, '19Kylnkoreo7zASjqMh4eEx0Hx9b4h5e2', 'http://localhost:8080/Licenta/assets/logs/19Kylnkoreo7zASjqMh4eEx0Hx9b4h5e2sdjkfTestkk11463348435444.json', 'sdjkf', '2016-05-15', 16),
(45, 'DhGew5y0oYBBsNL', 'http://localhost:8080/Licenta/assets/logs/DhGew5y0oYBBsNLMurginelTestkk11463348833547.json', 'Murginel', '2016-05-15', 17);

-- --------------------------------------------------------

--
-- Table structure for table `passwordsfortests`
--

CREATE TABLE `passwordsfortests` (
  `TestID` int(11) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passwordsfortests`
--

INSERT INTO `passwordsfortests` (`TestID`, `password`) VALUES
(45, '1ay2j6VLeg3qXsW');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `Creator` varchar(11) NOT NULL,
  `Location` varchar(500) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `CreationDate` date NOT NULL,
  `Name` varchar(500) NOT NULL,
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`Creator`, `Location`, `Category`, `CreationDate`, `Name`, `id`, `user_id`) VALUES
('prof', 'http://localhost:8080/Licenta/assets/uploads/prof/Testkk1.json', 'School Violence', '2016-05-15', 'Testkk1', 45, 2);

-- --------------------------------------------------------

--
-- Table structure for table `testsotherformats`
--

CREATE TABLE `testsotherformats` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `format` varchar(5) NOT NULL,
  `Location` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testsotherformats`
--

INSERT INTO `testsotherformats` (`id`, `test_id`, `format`, `Location`) VALUES
(27, 45, 'docx', 'http://localhost:8080/Licenta/assets/uploads/prof/Testkk1.docx');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `motivation` varchar(500) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `motivation`, `username`, `date`, `type`) VALUES
(1, 'diana@gmail.com', 'student', 'sdfasfasfasf', 'student', '2016-04-01', 'student'),
(2, 'prof', 'prof', 'asdf', 'prof', '2016-04-12', '2'),
(3, '', 'admin', '', 'admin', '2016-05-15', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testsotherformats`
--
ALTER TABLE `testsotherformats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `testsotherformats`
--
ALTER TABLE `testsotherformats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
