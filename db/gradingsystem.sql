-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 09:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gradingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_list`
--

CREATE TABLE `admin_list` (
  `admin_id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_list`
--

INSERT INTO `admin_list` (`admin_id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `date_created`) VALUES
(2, 'ronald', 'Laceda', 'aljas', 'ronaldaljas02@gmail.com', '$2y$10$wTvQ4iepwjv/qX.QG0DX7e52bKlI5V8o2LgB3IojdH1EP2tV1DwxW', '2024-03-17 16:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_list`
--

CREATE TABLE `assessment_list` (
  `assessment_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL,
  `name` text NOT NULL,
  `hps` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calendar_event_master`
--

CREATE TABLE `calendar_event_master` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `event_start_date` datetime DEFAULT NULL,
  `event_end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `calendar_event_master`
--

INSERT INTO `calendar_event_master` (`event_id`, `event_name`, `event_start_date`, `event_end_date`) VALUES
(22, 'Chinese New Year', '2024-02-09 00:00:00', '2024-02-09 00:00:00'),
(23, 'Chinese New Year', '2024-02-22 00:00:00', '2024-02-10 00:00:00'),
(24, 'Haappy BIRTHDAY', '2024-02-09 00:00:00', '2024-02-11 00:00:00'),
(25, 'Monthsary', '2024-02-28 10:55:00', '2024-02-28 23:59:00'),
(26, 'MAMATAY SA SE', '2024-02-16 17:43:00', '2024-02-17 19:41:00'),
(27, 'Haappy BIRTHDAY', '2024-03-06 17:10:00', '2024-03-07 17:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `class_list`
--

CREATE TABLE `class_list` (
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grade` text NOT NULL,
  `section` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_list`
--

INSERT INTO `class_list` (`class_id`, `subject_id`, `grade`, `section`) VALUES
(27, 11, 'Grade 7', 'Galungong');

-- --------------------------------------------------------

--
-- Table structure for table `component_subject_percentage`
--

CREATE TABLE `component_subject_percentage` (
  `csp_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `percentage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `component_subject_percentage`
--

INSERT INTO `component_subject_percentage` (`csp_id`, `subject_id`, `component_id`, `percentage`) VALUES
(421, 11, 2, '20'),
(422, 11, 3, '30'),
(423, 11, 19, '50');

-- --------------------------------------------------------

--
-- Table structure for table `grading_components`
--

CREATE TABLE `grading_components` (
  `component_id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grading_components`
--

INSERT INTO `grading_components` (`component_id`, `name`) VALUES
(2, 'Quarterly Assessment'),
(3, 'Written Works'),
(19, 'Performance Task');

-- --------------------------------------------------------

--
-- Table structure for table `mark_list`
--

CREATE TABLE `mark_list` (
  `assessment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `mark` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `gradelvl` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section`, `gradelvl`) VALUES
(11, 'STEM B', 'Grade 7'),
(12, 'Galungong', 'Grade 7');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `suffix` varchar(10) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `LRN` int(11) NOT NULL,
  `father` varchar(100) DEFAULT NULL,
  `fathernum` varchar(100) DEFAULT NULL,
  `mother` varchar(100) DEFAULT NULL,
  `mothernum` varchar(100) DEFAULT NULL,
  `guardian` varchar(100) DEFAULT NULL,
  `guardiannum` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_assignments`
--

CREATE TABLE `student_assignments` (
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `name`) VALUES
(11, 'math');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `suffix` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `assigned_subject` varchar(100) NOT NULL,
  `assigned_year_level` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `firstname`, `middlename`, `lastname`, `suffix`, `birthday`, `address`, `contact`, `designation`, `assigned_subject`, `assigned_year_level`, `sex`, `username`, `password`) VALUES
(0, 'kristina Marie', 'Ventura', 'Gadem', '', '2002-09-10', 'Putik Zamboanga City', '09128731892731', 'Adviser', 'english', 'Grade 7', 'female', 'qb202102844@wmsu.edu.ph', '$2y$10$dOmyzcfuIYYuDN3rsSPKC.yZHM/sMyspVcfj2MJcUz4h1Pq5shR/m');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_list`
--

CREATE TABLE `teacher_list` (
  `teacher_id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `department` text NOT NULL,
  `gender` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `DATE_CREATED` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_list`
--

INSERT INTO `teacher_list` (`teacher_id`, `firstname`, `middlename`, `lastname`, `department`, `gender`, `contact`, `email`, `password`, `DATE_CREATED`) VALUES
(1, 'Ranielle Dae', 'Aldabe', 'Delos Reyes', 'English Department', 'female', '09639576655', 'ranielledaedelosreyes@gmail.com', '$2y$10$gvTbfaxP.sZh0k8wGpQa4OfasMMg/BPG5OyeR0qqJsu9DmPPLTOA2', '2024-03-17 17:33:19');

-- --------------------------------------------------------

--
-- Table structure for table `transmutation_table`
--

CREATE TABLE `transmutation_table` (
  `trans_id` int(11) NOT NULL,
  `from` double NOT NULL,
  `to` double NOT NULL,
  `grade` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transmutation_table`
--

INSERT INTO `transmutation_table` (`trans_id`, `from`, `to`, `grade`) VALUES
(1, 100, 100, 100),
(2, 0, 3.99, 60),
(3, 12, 15.99, 63),
(4, 16, 19.99, 64),
(5, 20, 23.99, 65),
(6, 24, 27.99, 66),
(7, 28, 31.99, 67),
(8, 32, 35.99, 68),
(9, 36, 39.99, 69),
(10, 4, 7.99, 61),
(11, 40, 43.99, 70),
(12, 44, 47.99, 71),
(13, 48, 51.99, 72),
(14, 52, 55.99, 73),
(15, 56, 59.99, 74),
(16, 60, 61.59, 75),
(17, 61.6, 63.19, 76),
(18, 63.2, 64.79, 77),
(19, 64.8, 66.39, 78),
(20, 66.4, 67.99, 79),
(21, 68, 69.59, 80),
(22, 69.6, 71.19, 81),
(23, 71.2, 72.79, 82),
(24, 72.8, 74.39, 83),
(25, 74.4, 75.99, 84),
(26, 76, 77.59, 85),
(27, 77.6, 79.19, 86),
(28, 79.2, 80.79, 87),
(29, 8, 11.99, 62),
(30, 80.8, 82.39, 88),
(31, 82.4, 83.99, 89),
(32, 84, 85.59, 90),
(33, 85.6, 87.19, 91),
(34, 87.2, 88.79, 92),
(35, 88.8, 90.39, 93),
(36, 90.4, 91.99, 94),
(37, 92, 93.59, 95),
(38, 93.6, 95.19, 96),
(39, 95.2, 96.79, 97),
(40, 96.8, 98.39, 98),
(41, 98.4, 99.99, 99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_list`
--
ALTER TABLE `admin_list`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `assessment_list`
--
ALTER TABLE `assessment_list`
  ADD PRIMARY KEY (`assessment_id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `calendar_event_master`
--
ALTER TABLE `calendar_event_master`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `class_list`
--
ALTER TABLE `class_list`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `component_subject_percentage`
--
ALTER TABLE `component_subject_percentage`
  ADD PRIMARY KEY (`csp_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `component_id` (`component_id`);

--
-- Indexes for table `grading_components`
--
ALTER TABLE `grading_components`
  ADD PRIMARY KEY (`component_id`);

--
-- Indexes for table `mark_list`
--
ALTER TABLE `mark_list`
  ADD KEY `assessment_id` (`assessment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_assignments`
--
ALTER TABLE `student_assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_list`
--
ALTER TABLE `teacher_list`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `transmutation_table`
--
ALTER TABLE `transmutation_table`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_list`
--
ALTER TABLE `admin_list`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assessment_list`
--
ALTER TABLE `assessment_list`
  MODIFY `assessment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `calendar_event_master`
--
ALTER TABLE `calendar_event_master`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `class_list`
--
ALTER TABLE `class_list`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `component_subject_percentage`
--
ALTER TABLE `component_subject_percentage`
  MODIFY `csp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;

--
-- AUTO_INCREMENT for table `grading_components`
--
ALTER TABLE `grading_components`
  MODIFY `component_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_assignments`
--
ALTER TABLE `student_assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teacher_list`
--
ALTER TABLE `teacher_list`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transmutation_table`
--
ALTER TABLE `transmutation_table`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessment_list`
--
ALTER TABLE `assessment_list`
  ADD CONSTRAINT `assessment_list_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class_list` (`class_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assessment_list_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `grading_components` (`component_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_id` FOREIGN KEY (`class_id`) REFERENCES `class_list` (`class_id`);

--
-- Constraints for table `class_list`
--
ALTER TABLE `class_list`
  ADD CONSTRAINT `class_list_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE;

--
-- Constraints for table `component_subject_percentage`
--
ALTER TABLE `component_subject_percentage`
  ADD CONSTRAINT `component_subject_percentage_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `component_subject_percentage_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `grading_components` (`component_id`) ON DELETE CASCADE;

--
-- Constraints for table `mark_list`
--
ALTER TABLE `mark_list`
  ADD CONSTRAINT `mark_list_ibfk_1` FOREIGN KEY (`assessment_id`) REFERENCES `assessment_list` (`assessment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mark_list_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_list` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_assignments`
--
ALTER TABLE `student_assignments`
  ADD CONSTRAINT `student_assignments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `student_assignments_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);

--
-- Constraints for table `student_list`
--
ALTER TABLE `student_list`
  ADD CONSTRAINT `student_list_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class_list` (`class_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
