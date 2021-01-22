-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 22, 2021 at 11:02 AM
-- Server version: 5.7.26
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Mock_test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mock_test_tbl`
--

CREATE TABLE `mock_test_tbl` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Phone` varchar(11) NOT NULL,
  `Gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mock_test_tbl`
--

INSERT INTO `mock_test_tbl` (`Id`, `Name`, `Email`, `Phone`, `Gender`) VALUES
(1, 'Test1', 'test1@gmail.com', '123456789', 'male'),
(2, 'Test2', 'test2@gmail.com', '212343234', 'female'),
(3, 'Test0', 'test0@gmail.com', '1234567890', 'male'),
(4, 'Test1', 'test1@gmail.com', '1234567891', 'male'),
(5, 'Test2', 'test2@gmail.com', '1234567892', 'male'),
(6, 'Test3', 'test3@gmail.com', '1234567893', 'male'),
(7, 'Test4', 'test4@gmail.com', '1234567894', 'male'),
(8, 'Test5', 'test5@gmail.com', '1234567895', 'male'),
(9, 'Test6', 'test6@gmail.com', '1234567896', 'male'),
(10, 'Test7', 'test7@gmail.com', '1234567897', 'male'),
(11, 'Test8', 'test8@gmail.com', '1234567898', 'male'),
(12, 'Test9', 'test9@gmail.com', '1234567899', 'male'),
(13, 'Test10', 'test10@gmail.com', '12345678910', 'male'),
(14, 'Test11', 'test11@gmail.com', '12345678911', 'male'),
(15, 'Test12', 'test12@gmail.com', '12345678912', 'male'),
(16, 'Test13', 'test13@gmail.com', '12345678913', 'male'),
(17, 'Test14', 'test14@gmail.com', '12345678914', 'male'),
(18, 'Test15', 'test15@gmail.com', '12345678915', 'male'),
(19, 'Test16', 'test16@gmail.com', '12345678916', 'male'),
(20, 'Test17', 'test17@gmail.com', '12345678917', 'male'),
(21, 'Test18', 'test18@gmail.com', '12345678918', 'male'),
(22, 'Test19', 'test19@gmail.com', '12345678919', 'male'),
(23, 'Test20', 'test20@gmail.com', '12345678920', 'male'),
(24, 'Test21', 'test21@gmail.com', '12345678921', 'male'),
(25, 'Test22', 'test22@gmail.com', '12345678922', 'male'),
(26, 'Test23', 'test23@gmail.com', '12345678923', 'male'),
(27, 'Test24', 'test24@gmail.com', '12345678924', 'male'),
(28, 'Test25', 'test25@gmail.com', '12345678925', 'male'),
(29, 'Test26', 'test26@gmail.com', '12345678926', 'male'),
(30, 'Test27', 'test27@gmail.com', '12345678927', 'male'),
(31, 'Test28', 'test28@gmail.com', '12345678928', 'male'),
(32, 'Test29', 'test29@gmail.com', '12345678929', 'male'),
(33, 'Test30', 'test30@gmail.com', '12345678930', 'male'),
(34, 'Test31', 'test31@gmail.com', '12345678931', 'male'),
(35, 'Test32', 'test32@gmail.com', '12345678932', 'male'),
(36, 'Test33', 'test33@gmail.com', '12345678933', 'male'),
(37, 'Test34', 'test34@gmail.com', '12345678934', 'male'),
(38, 'Test35', 'test35@gmail.com', '12345678935', 'male'),
(39, 'Test36', 'test36@gmail.com', '12345678936', 'male'),
(40, 'Test37', 'test37@gmail.com', '12345678937', 'male'),
(41, 'Test38', 'test38@gmail.com', '12345678938', 'male'),
(42, 'Test39', 'test39@gmail.com', '12345678939', 'male'),
(43, 'Test40', 'test40@gmail.com', '12345678940', 'male'),
(44, 'Test41', 'test41@gmail.com', '12345678941', 'male'),
(45, 'Test42', 'test42@gmail.com', '12345678942', 'male'),
(46, 'Test43', 'test43@gmail.com', '12345678943', 'male'),
(47, 'Test44', 'test44@gmail.com', '12345678944', 'male'),
(48, 'Test45', 'test45@gmail.com', '12345678945', 'male'),
(49, 'Test46', 'test46@gmail.com', '12345678946', 'male'),
(50, 'Test47', 'test47@gmail.com', '12345678947', 'male'),
(51, 'Test48', 'test48@gmail.com', '12345678948', 'male'),
(52, 'Test49', 'test49@gmail.com', '12345678949', 'male'),
(53, 'Test50', 'test50@gmail.com', '12345678950', 'male'),
(54, 'Test51', 'test51@gmail.com', '12345678951', 'male'),
(55, 'Test52', 'test52@gmail.com', '12345678952', 'male'),
(56, 'Test53', 'test53@gmail.com', '12345678953', 'male'),
(57, 'Test54', 'test54@gmail.com', '12345678954', 'male'),
(58, 'Test55', 'test55@gmail.com', '12345678955', 'male'),
(59, 'Test56', 'test56@gmail.com', '12345678956', 'male'),
(60, 'Test57', 'test57@gmail.com', '12345678957', 'male'),
(61, 'Test58', 'test58@gmail.com', '12345678958', 'male'),
(62, 'Test59', 'test59@gmail.com', '12345678959', 'male'),
(63, 'Test60', 'test60@gmail.com', '12345678960', 'male'),
(64, 'Test61', 'test61@gmail.com', '12345678961', 'male'),
(65, 'Test62', 'test62@gmail.com', '12345678962', 'male'),
(66, 'Test63', 'test63@gmail.com', '12345678963', 'male'),
(67, 'Test64', 'test64@gmail.com', '12345678964', 'male'),
(68, 'Test65', 'test65@gmail.com', '12345678965', 'male'),
(69, 'Test66', 'test66@gmail.com', '12345678966', 'male'),
(70, 'Test67', 'test67@gmail.com', '12345678967', 'male'),
(71, 'Test68', 'test68@gmail.com', '12345678968', 'male'),
(72, 'Test69', 'test69@gmail.com', '12345678969', 'male'),
(73, 'Test70', 'test70@gmail.com', '12345678970', 'male'),
(74, 'Test71', 'test71@gmail.com', '12345678971', 'male'),
(75, 'Test72', 'test72@gmail.com', '12345678972', 'male'),
(76, 'Test73', 'test73@gmail.com', '12345678973', 'male'),
(77, 'Test74', 'test74@gmail.com', '12345678974', 'male'),
(78, 'Test75', 'test75@gmail.com', '12345678975', 'male'),
(79, 'Test76', 'test76@gmail.com', '12345678976', 'male'),
(80, 'Test77', 'test77@gmail.com', '12345678977', 'male'),
(81, 'Test78', 'test78@gmail.com', '12345678978', 'male'),
(82, 'Test79', 'test79@gmail.com', '12345678979', 'male'),
(83, 'Test80', 'test80@gmail.com', '12345678980', 'male'),
(84, 'Test81', 'test81@gmail.com', '12345678981', 'male'),
(85, 'Test82', 'test82@gmail.com', '12345678982', 'male'),
(86, 'Test83', 'test83@gmail.com', '12345678983', 'male'),
(87, 'Test84', 'test84@gmail.com', '12345678984', 'male'),
(88, 'Test85', 'test85@gmail.com', '12345678985', 'male'),
(89, 'Test86', 'test86@gmail.com', '12345678986', 'male'),
(90, 'Test87', 'test87@gmail.com', '12345678987', 'male'),
(91, 'Test88', 'test88@gmail.com', '12345678988', 'male'),
(92, 'Test89', 'test89@gmail.com', '12345678989', 'male'),
(93, 'Test90', 'test90@gmail.com', '12345678990', 'male'),
(94, 'Test91', 'test91@gmail.com', '12345678991', 'male'),
(95, 'Test92', 'test92@gmail.com', '12345678992', 'male'),
(96, 'Test93', 'test93@gmail.com', '12345678993', 'male'),
(97, 'Test94', 'test94@gmail.com', '12345678994', 'male'),
(98, 'Test95', 'test95@gmail.com', '12345678995', 'male'),
(99, 'Test96', 'test96@gmail.com', '12345678996', 'male'),
(100, 'Test97', 'test97@gmail.com', '12345678997', 'male'),
(101, 'Test98', 'test98@gmail.com', '12345678998', 'male'),
(102, 'Test99', 'test99@gmail.com', '12345678999', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mock_test_tbl`
--
ALTER TABLE `mock_test_tbl`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mock_test_tbl`
--
ALTER TABLE `mock_test_tbl`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
