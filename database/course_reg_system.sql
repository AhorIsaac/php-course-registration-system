-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2022 at 03:32 PM
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
-- Database: `course_reg_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `secret_number` int(11) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `secret_number`, `password`) VALUES
(1, 11111, 'b0baee9d279d34fa1dfd71aadb908c3f');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(70) NOT NULL,
  `code` varchar(18) NOT NULL,
  `unit` int(2) NOT NULL,
  `lecturer` varchar(40) NOT NULL,
  `level` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `code`, `unit`, `lecturer`, `level`) VALUES
(1, 'Computer Architecture II', 'CMP 372', 3, 'Mathew Babatunde', 300),
(3, 'Sys & Analy Design', 'CMP 312', 3, 'Dr Yange ', 300),
(4, 'Object Oriented Programming ', 'CMP 322', 3, 'Idoko Charles Onyeke', 300),
(6, 'Introduction to Computers', 'CMP 111', 3, 'G S Iorundu', 100),
(7, 'Foundations of Mathematics', 'MTH 111', 3, 'Dr. Luga', 100),
(8, 'Machanics, Properties of Matter and Heat', 'PHY 111', 3, 'Dr.audu', 100),
(9, 'Experimental Physics 1', 'PHY 191', 1, 'Lecturer name', 100),
(10, 'Basic Inorganic Chemistry', 'CHM 111', 2, 'L', 100),
(11, 'Basic Experimental Chemistry', 'CHM 152', 1, 'Lec', 100),
(12, 'Basic Computer Science', 'CMP 122', 3, 'Dr. Yange', 100),
(13, 'Calculus', 'MTH 122', 3, 'Mr. Kaduna', 100),
(14, 'Applied Mathematics', 'MTH 132', 3, 'Dr. Luga', 100),
(15, 'Probability 1', 'STA 112', 3, 'Miss Ada', 100),
(16, 'Electricity and Magnetism', 'PHY 142', 3, 'Gesa Newton', 100),
(17, 'Optics, Sound and Waves', 'PHY 132', 2, 'Dr. Audu', 100),
(18, 'Basic Physical Chemistry', 'CHM 122', 2, 'Lecture Name', 100),
(19, 'Computer Programming 1', 'CMP 211', 3, 'Mr. Idoko', 200),
(20, 'Operating System 1', 'CMP 221', 3, 'Mr. Jerome', 200),
(21, 'Data Structure 1', 'CMP 241', 3, 'Mr. Ido', 200),
(22, 'Linear Algebra 1', 'MTH 211', 2, 'Gweryina', 200),
(23, 'Mathematical Motheds', 'MTH 231', 3, 'Dr. Luga', 200),
(24, 'Statistical Inference 1', 'STA 211', 2, 'Dr. Kuhe', 200),
(25, 'Real Analysis 1', 'MTH 221', 3, 'Mr. Uche', 200),
(27, 'Discrete Structures ', 'CMP 232', 3, 'Dr.Orgala', 200),
(28, 'Computer Programming II', 'CMP 222', 3, 'Mr. Idoko', 200),
(29, 'Digital Electronics', 'CMP 252', 3, 'Mr.Anaobi', 200),
(30, 'Ordinary Differential Equations', 'MTH 222', 3, 'Dr.leke', 200),
(31, 'Numerical Analysis 1', 'MTH 252', 3, 'Mr. Kaduna', 200),
(32, 'Structured Programming ', 'CMP 311', 3, 'Dr. Agaji', 300),
(33, 'Operating System I', 'CMP 321', 3, 'Mr. Onoja', 300),
(34, 'Computer Architecture I', 'CMP 331', 3, 'Mr. Baba Tude', 300),
(35, 'Data Base Management I', 'CMP 351', 3, 'Dr. Yange ', 300),
(36, 'Formal Language and Automata Theory', 'CMP 361', 3, 'Dr. Orgala', 300),
(37, 'Operation 1', 'STA 361', 3, 'Lecturer Name', 300),
(38, 'Algorithms and Complexity Analysis', 'CMP 332', 3, 'Lecturer name', 300),
(39, 'Compiler Construction I', 'CMP 352', 3, 'Mr. Iorundu', 300),
(40, 'Computation Science and Numerical Methods', 'CMP 382', 3, 'Dr. Gbande', 300),
(41, 'Data Communication & Networking', 'CMP 451', 3, 'Mr. Ashiru ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_registration`
--

CREATE TABLE `course_registration` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_ids` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_registration`
--

INSERT INTO `course_registration` (`id`, `student_id`, `course_ids`, `date`, `status`) VALUES
(1, 9, '40,39,38,37,36,35,34,', '2021-07-19 22:14:53', 1),
(2, 6, '31,30,27,25,24,20,', '2021-07-20 08:33:37', 1),
(3, 12, '40,39,38,37,3,1,', '2021-07-20 12:09:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `level` int(3) NOT NULL,
  `dob` date NOT NULL,
  `reg_num` varchar(17) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fullname`, `level`, `dob`, `reg_num`, `password`) VALUES
(6, 'Bernard Orjime ', 200, '2021-07-24', '19/74737/UE', '058869faf82adac51a712431465f2b37'),
(7, 'Ahula Ella', 400, '2021-07-24', '17/18565/UE', 'c5899d0a0ec58f515e2d50f4928a0353'),
(8, 'Bernard Orjime ', 400, '2021-07-21', '17/45076/UE', 'e2af067550e2491c8178124c235ab294'),
(9, 'Iorngbough Charles Orjighjigh', 300, '2021-07-15', '18/38189/UE', 'd3f69f7557a769085d40249f48ec4843'),
(10, 'Ajon Aondoso Victory', 100, '1998-02-23', '20/84806/UE', '47e1f7087bdf2ed08432723ae3ea536a'),
(11, 'Akaakohol Tartor Kingom', 300, '1998-02-14', '18/56541/UE', '23c7c7293c9a91eea16b1eb1079ce49f'),
(12, 'Aondoakaa Theophilus', 300, '1994-09-28', '18/52383/UE', '2b741cc13f973fe117df42f11ac34407');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_registration`
--
ALTER TABLE `course_registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `course_registration`
--
ALTER TABLE `course_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_registration`
--
ALTER TABLE `course_registration`
  ADD CONSTRAINT `course_registration_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
