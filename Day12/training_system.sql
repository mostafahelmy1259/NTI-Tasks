-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 02:00 PM
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
-- Database: `training_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int(1) NOT NULL DEFAULT 0,
  `img_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `role_id`, `img_path`, `product_name`, `description`) VALUES
(17, 'Asmaa ahmed', 'asmaa@gmail.com', '$2y$10$lofIrv7TM/HTtlCmBaAF3OAYE4avAmPSGYI917iuwxInSEsnaH5O.', 0, '', '', ''),
(19, 'Jane Doe', 'jane@gmail.com', '$2y$10$n38i9uUIR.W1VR7bxi.0pOS77e.OzCwL0/yo8IiK.OrD2sAfRqSS6', 0, '../uploads/img_6881f7f5a3a942.40743497.jpg', 'skirt', 'skirt'),
(20, 'Admin', 'admin@example.com', '$2y$10$K8Kb4.yYcd9cFXOUcto4fOyQhVVd/cYU11N1gaB5Jno7fML7X5baC', 1, '../uploads/img_6881f7193a4857.05360485.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `hours` decimal(4,2) NOT NULL,
  `price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `hours`, `price`) VALUES
(1, 'Computer Network (IT321)', 'computer network', 75.00, 100.00),
(2, 'Computer Graphics', 'computer graphics', 75.00, 250.00),
(7, 'Artificial Intelligence', 'artificial intelligence', 76.00, 2440.00);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `grade` float NOT NULL,
  `enrollment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `grade`, `enrollment_date`, `course_id`) VALUES
(1, 1, 87, '2025-07-23 00:00:00', 1),
(2, 2, 66, '2025-07-23 10:55:58', 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `phone`, `date_of_birth`) VALUES
(1, 'Moustafa Ahmed Abouelainin', 'mah2112004@gmail.com', '0987654321', '2004-11-02'),
(2, 'Jone Doe', 'jane.doe@gmail.com', '+201068677120', '1996-07-04'),
(6, 'Ahmed Ali', 'ahmed.ali53@gmail.com', '+201063656738', '1976-05-02'),
(7, 'Test Student', 'test@student.com', '1234567890', '2000-01-01');

-- --------------------------------------------------------

--
-- Stand-in structure for view `task1_edit`
-- (See below for the actual view)
--
CREATE TABLE `task1_edit` (
`title` varchar(100)
,`student_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `task2_edit`
-- (See below for the actual view)
--
CREATE TABLE `task2_edit` (
`name` varchar(100)
,`course_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `task3`
-- (See below for the actual view)
--
CREATE TABLE `task3` (
`name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `task4`
-- (See below for the actual view)
--
CREATE TABLE `task4` (
`name` varchar(100)
,`course_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `task1_edit`
--
DROP TABLE IF EXISTS `task1_edit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `task1_edit`  AS SELECT `c`.`title` AS `title`, count(`e`.`student_id`) AS `student_count` FROM (`courses` `c` left join `enrollments` `e` on(`c`.`id` = `e`.`course_id`)) GROUP BY `c`.`title` HAVING count(`e`.`student_id`) > 0 ;

-- --------------------------------------------------------

--
-- Structure for view `task2_edit`
--
DROP TABLE IF EXISTS `task2_edit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `task2_edit`  AS SELECT `s`.`name` AS `name`, count(`e`.`course_id`) AS `course_count` FROM (`students` `s` left join `enrollments` `e` on(`s`.`id` = `e`.`student_id`)) GROUP BY `s`.`id`, `s`.`name` ORDER BY count(`e`.`course_id`) ASC LIMIT 0, 1 ;

-- --------------------------------------------------------

--
-- Structure for view `task3`
--
DROP TABLE IF EXISTS `task3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `task3`  AS SELECT `s`.`name` AS `name` FROM (`students` `s` left join `enrollments` `e` on(`s`.`id` = `e`.`student_id`)) WHERE `e`.`course_id` is null ;

-- --------------------------------------------------------

--
-- Structure for view `task4`
--
DROP TABLE IF EXISTS `task4`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `task4`  AS SELECT `s`.`name` AS `name`, count(`e`.`course_id`) AS `course_count` FROM (`students` `s` join `enrollments` `e` on(`s`.`id` = `e`.`student_id`)) GROUP BY `s`.`id`, `s`.`name` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
