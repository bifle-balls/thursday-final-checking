-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 09:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oro-va_dental_records`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient_registry`
--

CREATE TABLE `patient_registry` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `registry_date` date NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `appointment_date` date NOT NULL,
  `services` varchar(512) DEFAULT NULL,
  `partial_denture_service` text DEFAULT NULL,
  `partial_denture_count` text DEFAULT NULL,
  `full_denture_service` text DEFAULT NULL,
  `full_denture_range` text DEFAULT NULL,
  `add_info` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_registry`
--

INSERT INTO `patient_registry` (`id`, `registry_date`, `first_name`, `middle_name`, `last_name`, `dob`, `age`, `email`, `address`, `mobile`, `appointment_date`, `services`, `partial_denture_service`, `partial_denture_count`, `full_denture_service`, `full_denture_range`, `add_info`, `created_at`) VALUES
(46, '2024-12-03', 'Miasco', 'Jhon Carl', 'Villanueva', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Consultation, + Medical Certificate', '', '', 'Stayplate Porcelain', 'Upper', 'Has not gone to the dentist ever', '2024-12-03 06:53:38'),
(47, '2024-12-03', 'Miasco', 'Jhon Carl', 'Villanueva', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Consultation, + Medical Certificate', '', '', 'Stayplate Plastic', 'Upper', 'Has not gone to the dentist ever', '2024-12-03 06:55:42'),
(48, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Consultation, + Medical Certificate', '', '4', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:08:53'),
(49, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Consultation, + Medical Certificate', '', '3', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:18:37'),
(50, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Consultation, + Medical Certificate', 'Stayplate Plastic', '5', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:21:07'),
(51, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Consultation, + Medical Certificate', 'Stayplate Plastic', '5', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:21:30'),
(52, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Consultation, + Medical Certificate', 'One-piece Plastic', '4', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:21:38'),
(53, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Consultation, + Medical Certificate', 'Flexite', '8', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:21:55'),
(54, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Consultation, + Medical Certificate', 'Flexite', '8', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:21:55'),
(55, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Consultation, + Medical Certificate', 'Flexite', '8', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:25:01'),
(56, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Consultation, + Medical Certificate', 'Flexite', '8', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:25:17'),
(57, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(58, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(59, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(60, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(61, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(62, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(63, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(64, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(65, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(66, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(67, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(68, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(69, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(70, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(71, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(72, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(73, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(74, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(75, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:17'),
(76, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(77, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(78, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(79, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(80, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(81, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(82, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(83, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(84, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(85, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(86, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(87, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(88, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(89, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(90, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(91, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(92, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(93, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(94, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(95, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:18'),
(96, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(97, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(98, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(99, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(100, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(101, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(102, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(103, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(104, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(105, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(106, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(107, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(108, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(109, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(110, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:23'),
(111, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:24'),
(112, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:24'),
(113, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:24'),
(114, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:24'),
(115, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:24'),
(116, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:25:33'),
(117, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Consultation, + Medical Certificate', 'Flexite', '8', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:25:36'),
(118, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Light-Moderate, + Fluoride Treatment', 'One-piece Plastic', '6', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:26:13'),
(119, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Light-Moderate, + Fluoride Treatment', 'One-piece Plastic', '6', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:27:16'),
(120, '0000-00-00', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2024-12-03 07:27:41'),
(121, '2024-12-03', 'Jhon Carl', 'Villanueva', 'Miasco', '2003-12-17', 20, 'jhoncarlmiasco@gmail.com', '15 C. P. Garcia St., Tondo, Manila', '094551113071', '2024-12-10', 'Light-Moderate, + Fluoride Treatment', 'One-piece Porcelain', '4', '', '', 'Has not gone to the dentist ever', '2024-12-03 07:27:59'),
(122, '2024-12-06', 'Jovert III', 'Buenaventura', 'Valenzuela', '2004-03-20', 20, 'jovertvalenzuela033@gmail.com', '12 Blumen St. Odnot, Etivac', '09221168638', '2024-12-13', 'Consultation, + Medical Certificate, Teeth Whitening', 'Flexite (Pontic Count: 4)', NULL, '', NULL, 'Partial - 2 upper, 2 lower. (insert condition)', '2024-12-06 08:08:53'),
(123, '2024-12-06', 'Jovert III', 'Buenaventura', 'Valenzuela', '2004-03-20', 20, 'jovertvalenzuela033@gmail.com', '12 Blumen St. Odnot, Etivac', '09221168638', '2024-12-13', 'Consultation, + Medical Certificate, Reline', 'Flexite', '4', '', '', 'Partial - 2 Upper, 2 Lower; (insert conditions)', '2024-12-06 08:18:53'),
(124, '2024-12-06', 'Jovert III', 'Buenaventura', 'Valenzuela', '2004-03-20', 20, 'jovertvalenzuela033@gmail.com', '12 Blumen St. Odnot, Etivac', '09221168638', '2024-12-13', 'Consultation, + Medical Certificate, Reline', '', '', 'Ivocap', 'Upper AND Lower', 'Brainrot; I just wanna be part of your Skibidi~', '2024-12-06 08:44:21'),
(125, '2024-12-06', 'Jovert III', 'Buenaventura', 'Valenzuela', '2004-03-20', 20, 'jovertvalenzuela033@gmail.com', '12 Blumen St. Odnot, Etivac', '09221168638', '2024-12-13', 'Consultation, + Medical Certificate, Reline', '', '', '', '', 'Brainrot; I just wanna be part of your Skibidi~', '2024-12-06 09:17:08'),
(126, '2024-12-06', 'Jovert III', 'Buenaventura', 'Valenzuela', '2004-03-20', 20, 'jovertvalenzuela033@gmail.com', '12 Blumen St. Odnot, Etivac', '09221168638', '2024-12-13', 'Consultation, + Medical Certificate, Reline', 'Flexite', '6', '', '', 'Brainrot; I just wanna be part of your Skibidi~', '2024-12-06 09:21:40'),
(127, '2024-12-06', 'Valenzuela', 'Jovert III', 'Buenaventura', '2004-03-20', 20, 'jovertvalenzuela033@gmail.com', '12 Blumen St. Odnot, Etivac', '09221168638', '2024-12-13', 'Consultation, + Medical Certificate, Reline', '', '', 'Ivocap', 'Upper', '(insert conditions)', '2024-12-06 09:25:38'),
(128, '2024-12-06', 'Valenzuela', 'Jovert III', 'B', '2004-03-20', 20, 'jovertvalenzuela033@gmail.com', '12 Blumen St. Odnot, Etivac', '09221168638', '2024-12-13', 'Consultation, Pit & Fissure Sealant', '', '', 'Stayplate Plastic, Stayplate Porcelain', 'Upper, Lower', 'Balls', '2024-12-06 09:34:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient_registry`
--
ALTER TABLE `patient_registry`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient_registry`
--
ALTER TABLE `patient_registry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
