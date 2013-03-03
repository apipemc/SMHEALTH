CREATE DATABASE  IF NOT EXISTS `dbsmhealth` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dbsmhealth`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: dbsmhealth
-- ------------------------------------------------------
-- Server version	5.1.50-community

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `BookingId` int(11) NOT NULL AUTO_INCREMENT,
  `Reservationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DoctorId` int(11) NOT NULL,
  `PatientId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`BookingId`),
  KEY `fk_booking_doctor1_idx` (`DoctorId`),
  KEY `fk_booking_patient1_idx` (`PatientId`),
  KEY `fk_booking_user1_idx` (`UserId`),
  CONSTRAINT `fk_booking_doctor1` FOREIGN KEY (`DoctorId`) REFERENCES `doctor` (`DoctorId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_booking_patient1` FOREIGN KEY (`PatientId`) REFERENCES `patient` (`PatientId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_booking_user1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,'2013-03-06 00:00:00',3,1,1,1);
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor` (
  `DoctorId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Identification` int(11) NOT NULL,
  `Birthday` datetime NOT NULL,
  `StarTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`DoctorId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (1,'John Barrientos',1,'1998-12-05 00:00:00','08:00:00','18:00:00',1),(2,'Juan David Henao',2,'1985-06-20 00:00:00','14:00:00','18:00:00',1),(3,'Jorge Morales',3,'1986-01-23 00:00:00','14:00:00','18:00:00',1),(4,'Cristian Marín',4,'1991-05-13 00:00:00','14:00:00','18:00:00',1),(5,'Andres Cañola',5,'1985-02-09 00:00:00','08:00:00','18:00:00',1),(6,'Abner Trejo',6,'1972-12-25 00:00:00','08:00:00','18:00:00',1),(7,'Sandra Arias',7,'1985-08-30 00:00:00','19:00:00','18:00:00',1),(10,'Andres',21231,'2013-03-03 00:00:00','18:45:00','19:03:00',0);
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `PatientId` int(11) NOT NULL AUTO_INCREMENT,
  `Identification` int(11) NOT NULL,
  `Birthday` datetime NOT NULL,
  `Phone` varchar(45) DEFAULT NULL,
  `Observation` text,
  PRIMARY KEY (`PatientId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (1,1,'2013-03-31 00:00:00','6414068','Prueba Update');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `ProfileId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ProfileId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,'Guest',1),(2,'CallCenter',1),(3,'SuperUser',1);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialization`
--

DROP TABLE IF EXISTS `specialization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialization` (
  `SpecializationId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`SpecializationId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialization`
--

LOCK TABLES `specialization` WRITE;
/*!40000 ALTER TABLE `specialization` DISABLE KEYS */;
INSERT INTO `specialization` VALUES (1,'General',1),(2,'Oncología',1),(3,'Geriatría',1),(4,'Cardiología',1),(5,'Neurología',1),(6,'Pediatría',1),(7,'Infectología',1),(8,'Ginecología',1);
/*!40000 ALTER TABLE `specialization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialization_x_doctor`
--

DROP TABLE IF EXISTS `specialization_x_doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialization_x_doctor` (
  `SpecializationXdoctorId` int(11) NOT NULL AUTO_INCREMENT,
  `SpecializationId` int(11) NOT NULL,
  `DoctorId` int(11) NOT NULL,
  PRIMARY KEY (`SpecializationXdoctorId`),
  KEY `fk_specialization_x_doctor_specialization1_idx` (`SpecializationId`),
  KEY `fk_specialization_x_doctor_doctor1_idx` (`DoctorId`),
  CONSTRAINT `fk_specialization_x_doctor_doctor1` FOREIGN KEY (`DoctorId`) REFERENCES `doctor` (`DoctorId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_specialization_x_doctor_specialization1` FOREIGN KEY (`SpecializationId`) REFERENCES `specialization` (`SpecializationId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialization_x_doctor`
--

LOCK TABLES `specialization_x_doctor` WRITE;
/*!40000 ALTER TABLE `specialization_x_doctor` DISABLE KEYS */;
INSERT INTO `specialization_x_doctor` VALUES (5,1,1),(6,2,1),(7,1,2),(8,3,2),(9,4,3),(10,5,3),(11,1,4),(12,6,4),(13,2,5),(14,8,6),(15,1,6),(16,7,6),(17,6,7),(20,7,10),(21,8,10);
/*!40000 ALTER TABLE `specialization_x_doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  `ProfileId` int(11) NOT NULL,
  PRIMARY KEY (`UserId`),
  KEY `fk_user_profile_idx` (`ProfileId`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`ProfileId`) REFERENCES `profile` (`ProfileId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Csuarez','5c5e116057137d82a619d626c292d157d1b3328f',1,3),(2,'Cmora','910e80e8f4915fff9f9fb27062af57d3a4bfc377',1,2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-03 16:37:47
