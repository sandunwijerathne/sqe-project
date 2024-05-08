-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2024 at 01:44 AM
-- Server version: 10.6.17-MariaDB-log
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sandun_cv`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `idCertificate` int(11) NOT NULL,
  `certificatename` varchar(45) DEFAULT NULL,
  `issueddate` varchar(45) DEFAULT NULL,
  `cv_idcv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`idCertificate`, `certificatename`, `issueddate`, `cv_idcv`) VALUES
(1, 'English Diploma', '2015', 5),
(2, 'IT Diploma', '2016', 5),
(4, 'Certificate course in English Language', '2014', 4),
(5, 'Certificate course in computer science', '2012', 4),
(6, 'Diploma In city & guilds spoken English Briti', '2012', 4),
(7, 'Certificate in Human skills & personality dev', '2012', 4);

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `idcv` int(11) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `dob` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `bio` varchar(200) DEFAULT NULL,
  `currentosition` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`idcv`, `fname`, `lname`, `email`, `address`, `phone`, `dob`, `image`, `gender`, `password`, `bio`, `currentosition`) VALUES
(4, 'sandun', 'wijerathne', 'sandun@gmail.com', 'no3b Rivikirana road, katugastota', '0701433445', '1995/05/07', '../uploads/sc3.jpg', 'Male', '123321', '                                                                                                Hi, I\'m Alec Thompson, Decisions: If you can\'t decide, the answer is no. If two equally difficult paths,', 'Senior Web Engineer'),
(5, 'John', 'David', 'john@gmail.com', 'No 202, Peradeniya Road, Katugastota', '0784527899', '1995/06/08', '../uploads/sc2.jpg', 'Male', '123321', '                        Hi, I\'m John David, a tech enthusiast with a background in computer science, is passionate about exploring AI and programming. Outside of work, he enjoys hiking and playing the', 'CEO / Co-Founder');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `idexperience` int(11) NOT NULL,
  `comapny` varchar(45) DEFAULT NULL,
  `startdate` varchar(45) DEFAULT NULL,
  `enddate` varchar(45) DEFAULT NULL,
  `responsibilities` varchar(45) DEFAULT NULL,
  `cv_idcv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`idexperience`, `comapny`, `startdate`, `enddate`, `responsibilities`, `cv_idcv`) VALUES
(1, 'WS02', '2017-01-19', '2020-02-01', 'Web Developer', 5),
(4, 'Virtusa', '2021-07-11', '2023-06-26', 'UI Designer', 5),
(5, 'IWD IT Solutions (Pvt) Ltd', '2018-01-04', '2024-05-05', 'Developed and implemented client service prog', 4),
(6, 'Technical Lead - (Part Time)', '2020-02-05', '2021-05-05', 'Grew SOCAL monthly organic traffic ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `idlanguage` int(11) NOT NULL,
  `language` varchar(45) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `cv_idcv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`idlanguage`, `language`, `level`, `cv_idcv`) VALUES
(1, 'English', '4', 5),
(4, 'Sinhala', '5', 5);

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE `qualification` (
  `idqualification` int(11) NOT NULL,
  `qualificationname` varchar(45) DEFAULT NULL,
  `institute` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `grade` varchar(45) DEFAULT NULL,
  `cv_idcv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `qualification`
--

INSERT INTO `qualification` (`idqualification`, `qualificationname`, `institute`, `year`, `grade`, `cv_idcv`) VALUES
(19, 'Higher Diploma', 'NIBM', '2017', 'Merit', 5),
(20, 'Diploma ', 'Esoft', '2015', 'Merit', 5);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `idskill` int(11) NOT NULL,
  `skillname` varchar(45) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `cv_idcv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`idskill`, `skillname`, `level`, `cv_idcv`) VALUES
(2, 'PHP', '8', 5),
(3, 'Java', '9', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `role`) VALUES
(1, 'sandun@gmail.com', '123321', 'admin'),
(2, 'john@gmail.com', '123321', 'admin'),
(3, 'raveen@gmail.com', '123321', 'agency'),
(4, 'kasun@gmail.com', '123321', 'agency'),
(5, 'Wso2@wso2', '123', 'agency'),
(7, 'java@java.lk', '123', 'agency'),
(8, 'nsbm@nsbm.lk', '123', 'agency');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`idCertificate`),
  ADD KEY `fk_certificate_cv1_idx` (`cv_idcv`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`idcv`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`idexperience`),
  ADD KEY `fk_experience_cv_idx` (`cv_idcv`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`idlanguage`),
  ADD KEY `fk_language_cv1_idx` (`cv_idcv`);

--
-- Indexes for table `qualification`
--
ALTER TABLE `qualification`
  ADD PRIMARY KEY (`idqualification`),
  ADD KEY `fk_qualification_cv1_idx` (`cv_idcv`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`idskill`),
  ADD KEY `fk_skill_cv1_idx` (`cv_idcv`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `idCertificate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `idcv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `idexperience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `idlanguage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `qualification`
--
ALTER TABLE `qualification`
  MODIFY `idqualification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `idskill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
  ADD CONSTRAINT `fk_certificate_cv1` FOREIGN KEY (`cv_idcv`) REFERENCES `cv` (`idcv`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `fk_experience_cv` FOREIGN KEY (`cv_idcv`) REFERENCES `cv` (`idcv`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `language`
--
ALTER TABLE `language`
  ADD CONSTRAINT `fk_language_cv1` FOREIGN KEY (`cv_idcv`) REFERENCES `cv` (`idcv`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `qualification`
--
ALTER TABLE `qualification`
  ADD CONSTRAINT `fk_qualification_cv1` FOREIGN KEY (`cv_idcv`) REFERENCES `cv` (`idcv`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `fk_skill_cv1` FOREIGN KEY (`cv_idcv`) REFERENCES `cv` (`idcv`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
