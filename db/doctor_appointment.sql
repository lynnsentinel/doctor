-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2023 at 12:41 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor_appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL,
  `admin_birthdate` date DEFAULT NULL,
  `u_status` int(11) NOT NULL DEFAULT 1 COMMENT '0:disable 1:enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `admin_birthdate`, `u_status`) VALUES
(2, 'te1', 'admin@admin.com', '387c2d6e4752feb581ca867e129041fc', '2023-03-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `ap_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `ap_date` date NOT NULL,
  `ap_start_time` varchar(20) NOT NULL,
  `ap_end_time` time NOT NULL,
  `cham_id` int(11) NOT NULL,
  `ap_detail` text NOT NULL,
  `ap_datetime_create` datetime DEFAULT NULL COMMENT 'เก็บวันที่เวลาทำนัด',
  `ap_status` int(11) NOT NULL DEFAULT 0 COMMENT '0:ยังไม่ยืนยัน 1:ยืนยัน 2:ยกเลิก',
  `ap_sendmail` int(11) NOT NULL DEFAULT 0,
  `ap_come` int(11) NOT NULL DEFAULT 0 COMMENT '0:ไม่ระบุ 1:มา 2:ไม่ม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`ap_id`, `patient_id`, `doctor_id`, `ap_date`, `ap_start_time`, `ap_end_time`, `cham_id`, `ap_detail`, `ap_datetime_create`, `ap_status`, `ap_sendmail`, `ap_come`) VALUES
(1, 8, 3, '2023-01-01', '09:30:00', '10:00:00', 4, '', '2023-03-02 03:33:07', 1, 0, 1),
(2, 8, 5, '2023-02-02', '09:00:00', '09:30:00', 4, '', '2023-03-02 09:58:30', 2, 0, 0),
(3, 10, 5, '2023-03-09', '09:00:00', '10:00:00', 4, '', '2023-03-02 10:03:45', 1, 0, 0),
(4, 8, 5, '2023-03-09', '10:00:00', '10:30:00', 4, '', '2023-03-10 09:39:29', 0, 0, 0),
(5, 8, 5, '2023-03-16', '10.00-10.15', '00:00:00', 4, '', '2023-03-11 10:23:16', 0, 1, 0),
(10, 8, 5, '2023-03-20', '10.00-10.15', '00:00:00', 4, 'ปวดฟัน', '2023-03-17 12:57:26', 0, 0, 0),
(11, 11, 5, '2023-04-10', '12.30-12.45', '00:00:00', 4, 'ปวดฟัน', '2023-04-02 17:36:53', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chamber`
--

CREATE TABLE `chamber` (
  `cham_id` int(3) NOT NULL,
  `cham_title` varchar(60) NOT NULL,
  `cham_order` int(3) NOT NULL DEFAULT 50,
  `cham_enable` int(1) NOT NULL DEFAULT 1 COMMENT '0:disable 1:enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chamber`
--

INSERT INTO `chamber` (`cham_id`, `cham_title`, `cham_order`, `cham_enable`) VALUES
(1, 'ศัลยศาสตร์หลอดเลือด', 50, 1),
(2, 'แพทย์เฉพาะทางโรคผิวหนังในเด็ก', 50, 1),
(3, 'กุมารเวชศาสตร์โรคทางเดินอาหารและตับ', 50, 1),
(4, 'ทันตกรรม ', 50, 1),
(5, 'แพทย์เฉพาะทางโรคผิวหนัง', 50, 1),
(6, 'Radiotherapy and Nuclear Medicine', 50, 1),
(7, 'ตจวิทยา', 50, 1),
(8, 'โสต ศอ นาสิกวิทยา', 50, 1),
(9, 'อายุรศาสตร์', 50, 1),
(11, 'จิตเวชศาสตร์', 50, 1),
(12, 'กุมารเวชศาสตร์', 50, 1),
(13, 'แพทย์เฉพาะทางโรคผิวหนังในเด็ก', 50, 1),
(14, 'พยาธิวิทยา', 50, 1),
(15, 'รังสีวิทยา', 50, 1),
(16, 'ศัลยศาสตร์กระดูกและข้อ', 50, 1),
(17, 'สูติศาสตร์-นรีเวชวิทยา', 50, 1),
(18, 'เวชศาสตร์ฉุกเฉิน', 50, 1),
(19, 'เวชศาสตร์ฟื้นฟู', 50, 1),
(20, 'โสต ศอ นาสิกวิทยา', 50, 1),
(21, 'ประสาทศัลยศาสตร์', 50, 1),
(22, 'ศัลยแพทย์ออร์โธปิดิกส์', 50, 1),
(23, 'ศัลยศาสตร์', 50, 1),
(24, 'ศัลยศาสตร์หลอดเลือด', 50, 1),
(25, 'จักษุวิทยา', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `doctor_title_id` int(11) NOT NULL,
  `doctor_name` varchar(200) NOT NULL,
  `cham_id` int(11) NOT NULL,
  `doctor_email` varchar(150) NOT NULL,
  `doctor_pass` varchar(150) NOT NULL,
  `doctor_mon` varchar(50) NOT NULL,
  `doctor_tue` varchar(50) NOT NULL,
  `doctor_wed` varchar(50) NOT NULL,
  `doctor_thu` varchar(50) NOT NULL,
  `doctor_fri` varchar(50) NOT NULL,
  `doctor_sat` varchar(50) NOT NULL,
  `doctor_sun` varchar(50) NOT NULL,
  `doctor_enable` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `doctor_title_id`, `doctor_name`, `cham_id`, `doctor_email`, `doctor_pass`, `doctor_mon`, `doctor_tue`, `doctor_wed`, `doctor_thu`, `doctor_fri`, `doctor_sat`, `doctor_sun`, `doctor_enable`) VALUES
(1, 1, 'ตระการ ไชยวานิช', 9, 'doctor@doctor.com', '387c2d6e4752feb581ca867e129041fc', '1', '1', '', '', '', '', '', 1),
(2, 1, 'บรรเจิด ประดิษฐ์สุขถาวร', 9, '', '', '1', '', '', '', '1', '', '', 1),
(4, 1, 'จิรชาติ พรหมมาศ', 9, '', '', '', '', '', '', '', '', '', 1),
(5, 3, 'อภิชญา สุธรรมวาท', 4, 'doctor2@doctor.com', '387c2d6e4752feb581ca867e129041fc', '1', '', '', '', '', '', '', 1),
(6, 1, 'จิรายุ ตังสกุล', 5, '', '', '', '', '', '', '', '', '', 1),
(7, 4, 'ประเสริฐ เลิศสงวนสินชัย', 9, '', '', '', '', '', '', '', '', '', 1),
(8, 1, 'สิทธิพร เตชาธรรมนันท์', 9, '', '', '', '', '', '', '', '', '', 1),
(9, 4, 'พีรพันธ์ เจริญชาศรี', 9, '', '', '', '', '', '', '', '', '', 1),
(10, 2, 'กาญจนารัฐ พัฒนาโภคินสกุล', 9, '', '', '', '', '', '', '', '', '', 1),
(11, 2, 'กัญจน์อมล ศิริเวช', 9, '', '', '', '', '', '', '', '', '', 1),
(12, 2, 'วริษฐา ดารารัตนโรจน์', 5, '', '', '', '', '', '', '', '', '', 1),
(13, 1, 'แดนสันติ์ พันธ์สงวนสุข', 9, '', '', '', '', '', '', '', '', '', 1),
(14, 1, 'สุเมธ พิทักษ์', 9, '', '', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_title`
--

CREATE TABLE `doctor_title` (
  `doctor_title_id` int(3) NOT NULL,
  `doctor_title_name` varchar(50) NOT NULL,
  `doctor_title_order` int(3) NOT NULL DEFAULT 50,
  `doctor_title_enable` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor_title`
--

INSERT INTO `doctor_title` (`doctor_title_id`, `doctor_title_name`, `doctor_title_order`, `doctor_title_enable`) VALUES
(1, 'นพ.', 50, 1),
(2, 'พญ.', 50, 1),
(3, 'ทพญ.', 50, 1),
(4, 'รศ.นพ.', 50, 1),
(5, 'ผศ.นพ.', 50, 1),
(6, 'ทพ.', 50, 1),
(7, 'ศ.(พิเศษ) ดร. นพ.', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_password`
--

CREATE TABLE `log_password` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `exp_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `patient_title_id` int(11) NOT NULL,
  `patient_name` varchar(250) NOT NULL,
  `patient_email` varchar(150) NOT NULL,
  `patient_pass` varchar(150) NOT NULL,
  `patient_birthdate` date NOT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `patient_mobile` varchar(15) DEFAULT NULL,
  `patient_register_date` datetime NOT NULL,
  `p_status` int(11) NOT NULL DEFAULT 1 COMMENT '0:disable 1:enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `patient_title_id`, `patient_name`, `patient_email`, `patient_pass`, `patient_birthdate`, `gender_id`, `patient_mobile`, `patient_register_date`, `p_status`) VALUES
(8, 4, 'te1', 'te1@gmail.com', '387c2d6e4752feb581ca867e129041fc', '2000-03-01', NULL, NULL, '2023-03-01 20:11:54', 1),
(10, 4, 'te2', 'te2@hotmail.com', '387c2d6e4752feb581ca867e129041fc', '2000-03-01', NULL, NULL, '2023-03-01 20:11:54', 1),
(11, 4, 'wwdw', 'wwww1@gmail.com', '387c2d6e4752feb581ca867e129041fc', '2010-01-02', NULL, NULL, '2023-04-02 17:36:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient_title`
--

CREATE TABLE `patient_title` (
  `patient_title_id` int(11) NOT NULL,
  `patient_title_name` varchar(50) NOT NULL,
  `patient_title_order` int(11) NOT NULL DEFAULT 50,
  `patient_title_enable` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_title`
--

INSERT INTO `patient_title` (`patient_title_id`, `patient_title_name`, `patient_title_order`, `patient_title_enable`) VALUES
(4, 'นาย', 50, 1),
(5, 'นางสาว', 50, 1),
(6, 'นาง', 50, 1),
(12, '', 50, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`ap_id`);

--
-- Indexes for table `chamber`
--
ALTER TABLE `chamber`
  ADD PRIMARY KEY (`cham_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `doctor_title`
--
ALTER TABLE `doctor_title`
  ADD PRIMARY KEY (`doctor_title_id`);

--
-- Indexes for table `log_password`
--
ALTER TABLE `log_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `patient_title`
--
ALTER TABLE `patient_title`
  ADD PRIMARY KEY (`patient_title_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chamber`
--
ALTER TABLE `chamber`
  MODIFY `cham_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `doctor_title`
--
ALTER TABLE `doctor_title`
  MODIFY `doctor_title_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `log_password`
--
ALTER TABLE `log_password`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patient_title`
--
ALTER TABLE `patient_title`
  MODIFY `patient_title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
