-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2022 at 07:15 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turf_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `turf_id` int(11) NOT NULL,
  `turf_owner_id` int(11) NOT NULL,
  `booking_date` varchar(255) DEFAULT NULL,
  `booking_time` varchar(255) DEFAULT NULL,
  `closing_time` varchar(255) DEFAULT NULL,
  `player_name` varchar(255) DEFAULT NULL,
  `team_name` varchar(255) DEFAULT NULL,
  `turf_name` varchar(255) DEFAULT NULL,
  `turf_owner_name` varchar(255) DEFAULT NULL,
  `booking_payment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `player_id`, `team_id`, `turf_id`, `turf_owner_id`, `booking_date`, `booking_time`, `closing_time`, `player_name`, `team_name`, `turf_name`, `turf_owner_name`, `booking_payment`) VALUES
(2, 1, 1, 1, 2, '2022-03-12', '12:24', '01:24', 'Jitendra Kumar', 'RCV', 'Test Turf', 'Jitendra Kumar', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL,
  `game_name` varchar(255) DEFAULT NULL,
  `challenge_name` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `team_id_creating` int(11) DEFAULT NULL,
  `team_leader_id_creating` int(11) DEFAULT NULL,
  `team_id_accepting` int(11) DEFAULT NULL,
  `team_leader_id_accepting` int(11) DEFAULT NULL,
  `turf_id` int(11) DEFAULT NULL,
  `booking_date` varchar(255) DEFAULT NULL,
  `starting_date` varchar(255) DEFAULT NULL,
  `ending_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `game_name`, `challenge_name`, `details`, `team_id_creating`, `team_leader_id_creating`, `team_id_accepting`, `team_leader_id_accepting`, `turf_id`, `booking_date`, `starting_date`, `ending_date`) VALUES
(2, 'Cricket', 'IPL Challenge', '                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi voluptatum recusandae non quisquam eos dolor architecto perferendis illum eaque nobis? Veniam, voluptates. Cupiditate repellat nihil, aut corrupti alias enim quidem?\r\n', 1, 1, 2, 6, 1, '2022-08-12', '01:05', '04:00');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `team_name` varchar(255) DEFAULT NULL,
  `team_leader_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_name`, `team_leader_id`) VALUES
(1, 'RCV', 1),
(2, 'Mumbai Indians', 6);

-- --------------------------------------------------------

--
-- Table structure for table `turf`
--

CREATE TABLE `turf` (
  `id` int(11) NOT NULL,
  `turf_name` varchar(255) DEFAULT NULL,
  `turf_location` varchar(255) DEFAULT NULL,
  `turf_image` varchar(255) DEFAULT NULL,
  `turf_owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `turf`
--

INSERT INTO `turf` (`id`, `turf_name`, `turf_location`, `turf_image`, `turf_owner_id`) VALUES
(1, 'Sports Turf', 'Aman Vihar Delhi 247632', 'Turf_up.jpg', 2),
(3, 'Excellent Turf ', 'Rajeev Nagar Mumbai 345', 'ec8dbe661b8185f220df02e5f70abd3d.jpg', 9),
(4, 'New Sports', 'Gandhi Park Delhi 23412', '97f132614ccdb40575b38df5467fda83.jpg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `turf_name` varchar(255) DEFAULT NULL,
  `turf_owner_contact` varchar(255) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `is_captain` varchar(255) DEFAULT NULL,
  `player_age` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type`, `email`, `contact`, `password`, `turf_name`, `turf_owner_contact`, `team_id`, `is_captain`, `player_age`, `address`) VALUES
(1, 'Jitendra Kumar', 1, 'wn11group@gmail.com', '0976009423', '12312312', NULL, NULL, 1, NULL, '22', 'dehradun'),
(2, 'Jitendra Kumar', 2, 'wn11group+11@gmail.com', '9050316445', '12312312', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Jadeja', 1, NULL, '9050316432', NULL, NULL, NULL, 1, NULL, '25', NULL),
(4, 'Rohit', 1, NULL, '9050316455', NULL, NULL, NULL, 1, NULL, '22', NULL),
(5, 'Jitendra Kumar', 1, NULL, '9050316499', NULL, NULL, NULL, 1, NULL, '21', NULL),
(6, 'MS Dhoni', 1, 'wn11group+44@gmail.com', '7906748534', '12312312', NULL, NULL, NULL, NULL, '26', 'Delhi'),
(7, 'Virat', 1, NULL, '09760094234', NULL, NULL, NULL, 2, NULL, '23', NULL),
(9, 'Viren', 2, 'wn11group+31@gmail.com', '9050316445', '12312312', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Rajeev Singh', 2, 'wn11group+41@gmail.com', '9760094234', '12312312', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `turf`
--
ALTER TABLE `turf`
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
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `turf`
--
ALTER TABLE `turf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
