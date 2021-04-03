-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 03, 2021 at 03:47 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uitmgrab`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int(10) NOT NULL AUTO_INCREMENT,
  `fk_student_id` int(4) NOT NULL,
  `fk_driver_id` int(4) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` time DEFAULT NULL,
  `booking_pickup` varchar(50) NOT NULL,
  `booking_drop` varchar(50) NOT NULL,
  `booking_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `fk_student_id` (`fk_student_id`),
  KEY `fk_driver_id` (`fk_driver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `fk_student_id`, `fk_driver_id`, `booking_date`, `booking_time`, `booking_pickup`, `booking_drop`, `booking_status`) VALUES
(1, 1, 1, '2020-01-01', '00:00:00', 'UiTM KKB', 'OS', 'In transit to destination'),
(3, 1, 1, '2019-06-12', '06:02:00', 'UiTM KKA', 'Bandar Segamat', 'Arrived at the destination'),
(4, 1, NULL, '2021-01-03', '23:23:00', 'UiTM KKC', 'Bandar Segamat', 'Searching for a driver'),
(8, 1, NULL, '2021-04-02', '00:28:00', 'UiTM KKA', 'OS', 'Searching for a driver');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
CREATE TABLE IF NOT EXISTS `driver` (
  `driver_id` int(4) NOT NULL AUTO_INCREMENT,
  `driver_name` varchar(50) NOT NULL,
  `driver_ic` varchar(12) NOT NULL,
  `driver_license` varchar(2) NOT NULL,
  `driver_phone` varchar(12) NOT NULL,
  `driver_email` varchar(50) NOT NULL,
  `driver_pass` varchar(50) NOT NULL,
  `driver_carplate` varchar(50) NOT NULL,
  `driver_carmodel` varchar(50) NOT NULL,
  `driver_carcolour` varchar(50) NOT NULL,
  PRIMARY KEY (`driver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `driver_name`, `driver_ic`, `driver_license`, `driver_phone`, `driver_email`, `driver_pass`, `driver_carplate`, `driver_carmodel`, `driver_carcolour`) VALUES
(1, 'Baby Driver', '9905148934', 'D', '0123456789', 'babydriver@gmail.com', 'abc123', 'WHY555', 'Nissan Skyline', 'White');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(4) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(50) NOT NULL,
  `student_matrix` varchar(10) NOT NULL,
  `student_ic` varchar(12) NOT NULL,
  `student_pass` varchar(50) NOT NULL,
  `student_phone` varchar(12) NOT NULL,
  `student_college` varchar(50) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `student_matrix`, `student_ic`, `student_pass`, `student_phone`, `student_college`) VALUES
(1, 'Amir Yasser', '2017123456', '990123456789', 'amir123', '0123456789', 'KKC');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`fk_student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`fk_driver_id`) REFERENCES `driver` (`driver_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
