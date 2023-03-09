-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2023 at 01:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ucb`
--

-- --------------------------------------------------------

--
-- Table structure for table `datainfo`
--

CREATE TABLE `datainfo` (
  `invoice_id` varchar(30) NOT NULL,
  `company` varchar(30) DEFAULT NULL,
  `buyer` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `country` varchar(30) NOT NULL,
  `code` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `total` int(255) DEFAULT NULL,
  `ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datainfo`
--

INSERT INTO `datainfo` (`invoice_id`, `company`, `buyer`, `phone`, `postcode`, `address`, `country`, `code`, `date`, `total`, `ID`) VALUES
('001/PSP-USA/V/2021', 'PSP', 'Travis Emigh', '+1-814-341-1322', '15904', '1222 Clapboard Run Rd, Johstown Pa, 15904', 'United State', 'USA', '2021-05-06', 0, 3),
('002/PSP-USA/V/2021', 'PSP', 'Ashlie Byrd', '707-367-4646', 'CA 95490', '1797 Lupine Dr. Willits, CA USA', 'United State', 'USA', '2021-05-06', 4730000, 3),
('002/UCB-USA/V/2021', 'UCB', 'Ashlie Byrd', '707-367-4646', 'CA 95490', '1797 Lupine Dr. Willits, CA', 'United States', 'USA', '2021-05-21', 2200014, 1),
('003/PSP-USA/V/2021', 'PSP', 'Kris Eigenbrode', '727-364-6229', 'FL 34652', '3501 Universal Plaza New Port Richey, FL\r\nUSA', 'United State', 'USA', '2021-05-01', 5052500, 3),
('003/UCB-USA/V/2021', 'UCB', 'Kris Eigenbrode', '727-364-6229', 'FL 34652', '3501 Universal Plaza New Port Richey, FL', 'United States', 'USA', '2021-05-21', 5052500, 1),
('004/PSP-USA/V/2021', 'PSP', 'Steve Mortell', '+1 (206)-473-0744', 'WA 98133', '13754 Aurora Ave N # A Seattle, Wa 98133\r\nUSA', 'United State', 'USA', '2021-05-02', 3990000, 3),
('004/UCB-USA/V/2021', 'UCB', 'Steve Mortell', '206-473-0744', 'WA 98133', '13754 Aurora Ave N # A Seattle, WA 98133', 'United States', 'USA', '2021-05-21', 3990000, 1),
('005/PSP-USA/V/2021', 'PSP', 'Steve Mortell', '+1 (206)-473-0744', 'WA 98133', '13754 Aurora Ave N # A Seattle, WA 98133', 'United State', 'USA', '2021-05-03', 3990000, 3),
('005/UCB-USA/V/2021', 'UCB', 'Steve Mortell', '206-473-0744', 'WA 98133', '13754 Aurora Ave N # A Seattle, WA 98133', 'United States', 'USA', '2021-05-21', 3990000, 1),
('006/PSP-SPAIN/V/2021', 'PSP', 'Jose Escalante Aquilar', '+34696480966', '29400', 'C/ Cardoba, 13 29400 Ronda\r\nSPAIN', 'Spain', 'SPAIN', '2021-05-27', 4200000, 3),
('006/UCB-SPAIN/V/2021', 'UCB', 'Jose Escalante Aquilar', '34696480966', '29400', 'C/ Cardoba, 13 29400 Ronda', 'Spain', 'SPAIN', '2021-05-27', 4200000, 1),
('007/PSP-USA/V/2021', 'PSP', 'Steve Mortell', '+1 (206)-473-0744', 'WA 98133', '13754 Aurora Ave N # A Seattle, WA 9133\r\nUSA', 'United State', 'USA', '2021-05-21', 3990000, 3),
('007/UCB-USA/V/2021', 'UCB', 'Steve Mortell', '206-473-0744', 'WA 98133', '13754 Aurora Ave N # A Seattle, WA 98133', 'United States', 'USA', '2021-05-21', 3990000, 1),
('008/PSP-USA/V/2021', 'PSP', 'Steve Mortell', '+1 (206)-473-0744', 'WA 98133', '13754 Aurora Ave N # A Seattle, WA 98133', 'United State', 'USA', '2021-05-21', 3990000, 3),
('008/UCB-USA/V/2021', 'UCB', 'Steve Mortell', '206-473-0744', 'WA 98133', '13754 Aurora Ave N # A Seattle, WA 98133', 'United States', 'USA', '2021-05-21', 3990000, 1),
('009/PSP-USA/V/2021', 'PSP', 'Steve Mortell', '+1 (206)-473-0744', 'WA 98133', '13754 Aurora Ave N # A Seattle, WA 98133', 'United State', 'USA', '2021-05-21', 3990000, 3),
('009/UCB-USA/V/2021', 'UCB', 'Steve Mortell', '206-473-0744', 'WA 98133', '13754 Aurora Ave N # A Seattle, WA 98133', 'United States', 'USA', '2021-05-21', 3990000, 1),
('010/PSP-USA/V/2021', 'PSP', 'Steve Mortell 5', '+1 (206)-473-0744', 'WA 98133', '13754 Aurora Ave N # A Seattle, WA 98133\r\nUSA', 'United State', 'USA', '2021-05-21', 3990000, 3),
('010/UCB-USA/V/2021', 'UCB', 'Steve Mortell', '206-473-0744', 'WA 98133', '13754 Aurora Ave N # A Seattle, WA 98133', 'United States', 'USA', '2021-05-21', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `descriptions`
--

CREATE TABLE `descriptions` (
  `no` int(11) NOT NULL,
  `invoice_id` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  `metric` varchar(30) DEFAULT NULL,
  `quantity` double DEFAULT 1,
  `prices` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `descriptions`
--

INSERT INTO `descriptions` (`no`, `invoice_id`, `description`, `metric`, `quantity`, `prices`) VALUES
(12, '002/PSP-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 22, 215000),
(14, '003/PSP-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 23.5, 215000),
(15, '003/UCB-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 23.5, 215000),
(16, '004/PSP-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 21, 190000),
(17, '004/UCB-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 21, 190000),
(18, '005/PSP-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 21, 190000),
(19, '005/UCB-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 21, 190000),
(20, '006/PSP-SPAIN/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 12.5, 336000),
(21, '006/UCB-SPAIN/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 12.5, 336000),
(23, '007/PSP-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 21, 190000),
(24, '007/UCB-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 21, 190000),
(25, '008/PSP-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 21, 190000),
(26, '008/UCB-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 21, 190000),
(27, '009/UCB-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 21, 190000),
(28, '009/PSP-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 21, 190000),
(30, '010/PSP-USA/V/2021', 'Mitragyna Speciosa', 'Kilogram(s)', 21, 190000),
(36, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(37, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(39, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(40, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(41, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(42, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(43, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(44, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(45, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(46, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(47, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(48, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(49, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(50, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 1, 1),
(51, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', '', 10, 220000);

-- --------------------------------------------------------

--
-- Table structure for table `packing`
--

CREATE TABLE `packing` (
  `no_packing` int(10) NOT NULL,
  `invoice_id` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `nw` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packing`
--

INSERT INTO `packing` (`no_packing`, `invoice_id`, `description`, `quantity`, `nw`) VALUES
(7, '002/PSP-USA/V/2021', 'Mitragyna Speciosa', 1, 12.5),
(8, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 12),
(10, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1),
(11, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1),
(12, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1),
(13, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1),
(14, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1),
(15, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1),
(16, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1),
(17, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1),
(18, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1),
(23, '003/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1),
(24, '002/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1),
(25, '003/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1),
(26, '003/UCB-USA/V/2021', 'Mitragyna Speciosa', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `admin` varchar(10) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(30) DEFAULT 'UCB'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `admin`, `username`, `password`, `name`, `company`) VALUES
(1, 'Yes', 'ucb_001', '21232f297a57a5a743894a0e4a801fc3', 'User 1', 'UCB'),
(3, 'Yes', 'ucb_003', '4719ccab7a8bd33c3cd43f148fbcc01e', 'Admin PSP', 'PSP'),
(4, 'Yes', 'ucb_002', '21232f297a57a5a743894a0e4a801fc3', 'ucb2', 'UCB');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datainfo`
--
ALTER TABLE `datainfo`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `dv_fk` (`ID`);

--
-- Indexes for table `descriptions`
--
ALTER TABLE `descriptions`
  ADD PRIMARY KEY (`no`),
  ADD KEY `desc_fk` (`invoice_id`);

--
-- Indexes for table `packing`
--
ALTER TABLE `packing`
  ADD PRIMARY KEY (`no_packing`),
  ADD KEY `packing_fk` (`invoice_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `descriptions`
--
ALTER TABLE `descriptions`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `packing`
--
ALTER TABLE `packing`
  MODIFY `no_packing` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `datainfo`
--
ALTER TABLE `datainfo`
  ADD CONSTRAINT `dv_fk` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `descriptions`
--
ALTER TABLE `descriptions`
  ADD CONSTRAINT `desc_fk` FOREIGN KEY (`invoice_id`) REFERENCES `datainfo` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `packing`
--
ALTER TABLE `packing`
  ADD CONSTRAINT `packing_fk` FOREIGN KEY (`invoice_id`) REFERENCES `datainfo` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
