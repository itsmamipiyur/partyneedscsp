CREATE DATABASE  IF NOT EXISTS `pnmsdb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pnmsdb`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: pnmsdb
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `tblCustomer`
--

DROP TABLE IF EXISTS `tblCustomer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblCustomer` (
  `strCustCode` varchar(45) NOT NULL,
  `strCustFirst` varchar(100) NOT NULL,
  `strCustMiddle` varchar(100) DEFAULT NULL,
  `strCustLast` varchar(100) NOT NULL,
  `txtCustAddress` text,
  `strCustContact` varchar(50) NOT NULL,
  PRIMARY KEY (`strCustCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblDelivery`
--

DROP TABLE IF EXISTS `tblDelivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblDelivery` (
  `strDeliCode` varchar(45) NOT NULL,
  `strDeliName` varchar(100) NOT NULL,
  `txtDeliDesc` text,
  `dblDeliFee` decimal(10,2) NOT NULL,
  PRIMARY KEY (`strDeliCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblEquipment`
--

DROP TABLE IF EXISTS `tblEquipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblEquipment` (
  `strEquiCode` varchar(45) NOT NULL,
  `strEquiName` varchar(45) NOT NULL,
  `strEquiEquiTypeCode` varchar(45) NOT NULL,
  `txtEquiDesc` text,
  PRIMARY KEY (`strEquiCode`),
  KEY `strEquiEquiTypeCode_idx` (`strEquiEquiTypeCode`),
  CONSTRAINT `strEquiEquiTypeCode` FOREIGN KEY (`strEquiEquiTypeCode`) REFERENCES `tblEquipmentType` (`strEquiTypeCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblEquipmentInventory`
--

DROP TABLE IF EXISTS `tblEquipmentInventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblEquipmentInventory` (
  `strEquiInveCode` varchar(45) NOT NULL,
  `dtmEquiInveDate` datetime NOT NULL,
  PRIMARY KEY (`strEquiInveCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblEquipmentInventoryDetail`
--

DROP TABLE IF EXISTS `tblEquipmentInventoryDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblEquipmentInventoryDetail` (
  `strEquiInveDetaEquiInveCode` varchar(45) NOT NULL,
  `strEquiInveDetaEquiCode` varchar(45) NOT NULL,
  `intEquiInveDetaQuantity` int(11) NOT NULL,
  PRIMARY KEY (`strEquiInveDetaEquiInveCode`,`strEquiInveDetaEquiCode`),
  KEY `fk_strEquiInveDetaEquiCode_idx` (`strEquiInveDetaEquiCode`),
  CONSTRAINT `fk_strEquiInveDetaEquiCode` FOREIGN KEY (`strEquiInveDetaEquiCode`) REFERENCES `tblEquipment` (`strEquiCode`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strEquiInveDetaEquiInveCode` FOREIGN KEY (`strEquiInveDetaEquiInveCode`) REFERENCES `tblEquipmentInventory` (`strEquiInveCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblEquipmentRate`
--

DROP TABLE IF EXISTS `tblEquipmentRate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblEquipmentRate` (
  `strEquiRateCode` varchar(45) NOT NULL,
  `strEquiRateEquiCode` varchar(45) NOT NULL,
  `dblEquiRateAmount` double NOT NULL,
  `strEquiRateUnitCode` varchar(45) NOT NULL,
  PRIMARY KEY (`strEquiRateCode`),
  KEY `strEquiRateEquiCode_idx` (`strEquiRateEquiCode`),
  KEY `fk_strEquiRateUnitCode_idx` (`strEquiRateUnitCode`),
  CONSTRAINT `fk_strEquiRateEquiCode` FOREIGN KEY (`strEquiRateEquiCode`) REFERENCES `tblEquipment` (`strEquiCode`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strEquiRateUnitCode` FOREIGN KEY (`strEquiRateUnitCode`) REFERENCES `tblUnit` (`strUnitCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblEquipmentType`
--

DROP TABLE IF EXISTS `tblEquipmentType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblEquipmentType` (
  `strEquiTypeCode` varchar(45) NOT NULL,
  `strEquiTypeName` varchar(100) NOT NULL,
  `txtEquiTypeDesc` text,
  PRIMARY KEY (`strEquiTypeCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblEventBooking`
--

DROP TABLE IF EXISTS `tblEventBooking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblEventBooking` (
  `strEvenBookCode` varchar(45) NOT NULL,
  `strEvenBookCustCode` varchar(45) NOT NULL,
  `strEvenBookEvenTypeCode` varchar(45) NOT NULL,
  `dtmEvenBookSchedule` datetime NOT NULL,
  `strEvenBookDeliCode` varchar(45) NOT NULL,
  `txtEvenBookAddress` text,
  `txtEvenBookDesc` text,
  PRIMARY KEY (`strEvenBookCode`),
  KEY `fk_strEvenBookCustCode_idx` (`strEvenBookCustCode`),
  KEY `fk_strEvenBookEvenTypeCode_idx` (`strEvenBookEvenTypeCode`),
  KEY `fk_strEvenBookDeliCode_idx` (`strEvenBookDeliCode`),
  CONSTRAINT `fk_strEvenBookCustCode` FOREIGN KEY (`strEvenBookCustCode`) REFERENCES `tblCustomer` (`strCustCode`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strEvenBookDeliCode` FOREIGN KEY (`strEvenBookDeliCode`) REFERENCES `tblDelivery` (`strDeliCode`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strEvenBookEvenTypeCode` FOREIGN KEY (`strEvenBookEvenTypeCode`) REFERENCES `tblEventType` (`strEvenTypeCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblEventEquipment`
--

DROP TABLE IF EXISTS `tblEventEquipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblEventEquipment` (
  `strEvenEquiCode` varchar(45) NOT NULL,
  `strEvenEquiEquiCode` varchar(45) NOT NULL,
  `strEvenEquiEvenBookCode` varchar(45) NOT NULL,
  `intEvenEquiQuantity` int(11) NOT NULL,
  PRIMARY KEY (`strEvenEquiCode`,`strEvenEquiEquiCode`,`strEvenEquiEvenBookCode`),
  KEY `fk_strEvenEquiEquiCode_idx` (`strEvenEquiEquiCode`),
  KEY `fk_strEvenEquiEvenBookCode_idx` (`strEvenEquiEvenBookCode`),
  CONSTRAINT `fk_strEvenEquiEquiCode` FOREIGN KEY (`strEvenEquiEquiCode`) REFERENCES `tblEquipment` (`strEquiCode`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strEvenEquiEvenBookCode` FOREIGN KEY (`strEvenEquiEvenBookCode`) REFERENCES `tblEventBooking` (`strEvenBookCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblEventMotif`
--

DROP TABLE IF EXISTS `tblEventMotif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblEventMotif` (
  `strEvenMotiMotiCode` varchar(45) NOT NULL,
  `strEvenMotiEvenBookCode` varchar(45) NOT NULL,
  PRIMARY KEY (`strEvenMotiMotiCode`,`strEvenMotiEvenBookCode`),
  KEY `fk_strEvenMotiEvenBookCode_idx` (`strEvenMotiEvenBookCode`),
  CONSTRAINT `fk_strEvenMotiEvenBookCode` FOREIGN KEY (`strEvenMotiEvenBookCode`) REFERENCES `tblEventBooking` (`strEvenBookCode`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strEvenMotiMotiCode` FOREIGN KEY (`strEvenMotiMotiCode`) REFERENCES `tblMotif` (`strMotiCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblEventType`
--

DROP TABLE IF EXISTS `tblEventType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblEventType` (
  `strEvenTypeCode` varchar(45) NOT NULL,
  `strEvenTypeName` varchar(100) NOT NULL,
  `txtEvenTypeDesc` text,
  PRIMARY KEY (`strEvenTypeCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblEventWaiter`
--

DROP TABLE IF EXISTS `tblEventWaiter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblEventWaiter` (
  `strEvenWaitEvenBookCode` varchar(45) NOT NULL,
  `strEvenWaitWaitCode` varchar(45) NOT NULL,
  PRIMARY KEY (`strEvenWaitEvenBookCode`,`strEvenWaitWaitCode`),
  KEY `fk_strEvenWaitWaitCode_idx` (`strEvenWaitWaitCode`),
  CONSTRAINT `fk_strEvenWaitEvenBookCode` FOREIGN KEY (`strEvenWaitEvenBookCode`) REFERENCES `tblEventBooking` (`strEvenBookCode`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strEvenWaitWaitCode` FOREIGN KEY (`strEvenWaitWaitCode`) REFERENCES `tblWaiter` (`strWaitCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblFoodCategory`
--

DROP TABLE IF EXISTS `tblFoodCategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblFoodCategory` (
  `strFoodCateCode` varchar(45) NOT NULL,
  `strFoodCateName` varchar(100) NOT NULL,
  `txtFoodCateDesc` text,
  PRIMARY KEY (`strFoodCateCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblMenu`
--

DROP TABLE IF EXISTS `tblMenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblMenu` (
  `strMenuCode` varchar(45) NOT NULL,
  `strMenuName` varchar(100) NOT NULL,
  `strMenuMenuTypeCode` varchar(45) NOT NULL,
  `strMenuFoodCateCode` varchar(45) DEFAULT NULL,
  `txtMenuDesc` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`strMenuCode`),
  KEY `fk_strMenuMenuTypeCode_idx` (`strMenuMenuTypeCode`),
  KEY `fk_strMenuFoodCateCode_idx` (`strMenuFoodCateCode`),
  CONSTRAINT `fk_strMenuFoodCateCode` FOREIGN KEY (`strMenuFoodCateCode`) REFERENCES `tblFoodCategory` (`strFoodCateCode`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strMenuMenuTypeCode` FOREIGN KEY (`strMenuMenuTypeCode`) REFERENCES `tblMenuType` (`strMenuTypeCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblMenuRate`
--

DROP TABLE IF EXISTS `tblMenuRate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblMenuRate` (
  `strMenuRateCode` varchar(45) NOT NULL,
  `strMenuRateMenuCode` varchar(45) NOT NULL,
  `strMenuRateRate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`strMenuRateCode`),
  KEY `fk_strMenuRateMenuCode_idx` (`strMenuRateMenuCode`),
  CONSTRAINT `fk_strMenuRateMenuCode` FOREIGN KEY (`strMenuRateMenuCode`) REFERENCES `tblMenu` (`strMenuCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblMenuType`
--

DROP TABLE IF EXISTS `tblMenuType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblMenuType` (
  `strMenuTypeCode` varchar(45) NOT NULL,
  `strMenuTypeName` varchar(100) NOT NULL,
  `txtMenuTypeDesc` text,
  PRIMARY KEY (`strMenuTypeCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblMotif`
--

DROP TABLE IF EXISTS `tblMotif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblMotif` (
  `strMotiCode` varchar(45) NOT NULL,
  `strMotiName` varchar(100) NOT NULL,
  `txtMotiDesc` text,
  PRIMARY KEY (`strMotiCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblOrder`
--

DROP TABLE IF EXISTS `tblOrder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblOrder` (
  `strOrdeCode` varchar(45) NOT NULL,
  `strOrdeEvenBookCode` varchar(45) NOT NULL,
  `strOrdeServTypeCode` varchar(45) NOT NULL,
  `intOrdeQuantity` varchar(45) NOT NULL,
  `dblOrdeRate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`strOrdeCode`),
  KEY `fk_strOrdeEvenBookCode_idx` (`strOrdeEvenBookCode`),
  KEY `fk_strOrdeServTypeCode_idx` (`strOrdeServTypeCode`),
  CONSTRAINT `fk_strOrdeEvenBookCode` FOREIGN KEY (`strOrdeEvenBookCode`) REFERENCES `tblEventBooking` (`strEvenBookCode`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strOrdeServTypeCode` FOREIGN KEY (`strOrdeServTypeCode`) REFERENCES `tblServeType` (`strServTypeCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblOrderDetail`
--

DROP TABLE IF EXISTS `tblOrderDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblOrderDetail` (
  `strOrdeDetaOrdeCode` varchar(45) NOT NULL,
  `strOrdeDetaMenuCode` varchar(45) NOT NULL,
  PRIMARY KEY (`strOrdeDetaOrdeCode`,`strOrdeDetaMenuCode`),
  KEY `fk_strOrdeDetaMenuCode_idx` (`strOrdeDetaMenuCode`),
  CONSTRAINT `fk_strOrdeDetaMenuCode` FOREIGN KEY (`strOrdeDetaMenuCode`) REFERENCES `tblMenu` (`strMenuCode`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strOrdeDetaOrdeCode` FOREIGN KEY (`strOrdeDetaOrdeCode`) REFERENCES `tblOrder` (`strOrdeCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblOrderInvoice`
--

DROP TABLE IF EXISTS `tblOrderInvoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblOrderInvoice` (
  `strOrdeInvoInvoCode` varchar(45) NOT NULL,
  `strOrdeInvoOrdeCode` varchar(45) NOT NULL,
  PRIMARY KEY (`strOrdeInvoInvoCode`,`strOrdeInvoOrdeCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblPenalty`
--

DROP TABLE IF EXISTS `tblPenalty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblPenalty` (
  `strPenaCode` varchar(45) NOT NULL,
  `strPenaName` varchar(100) NOT NULL,
  `strPenaPenaTypeCode` varchar(45) NOT NULL,
  `txtPenaDesc` text,
  `dblPenaFee` decimal(10,2) NOT NULL,
  PRIMARY KEY (`strPenaCode`),
  KEY `fk_strPenaPenaTypeCode_idx` (`strPenaPenaTypeCode`),
  CONSTRAINT `fk_strPenaPenaTypeCode` FOREIGN KEY (`strPenaPenaTypeCode`) REFERENCES `tblPenaltyType` (`strPenaTypeCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblPenaltyType`
--

DROP TABLE IF EXISTS `tblPenaltyType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblPenaltyType` (
  `strPenaTypeCode` varchar(45) NOT NULL,
  `strPenaTypeName` varchar(100) NOT NULL,
  `txtPenaTypeDesc` text,
  PRIMARY KEY (`strPenaTypeCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblRental`
--

DROP TABLE IF EXISTS `tblRental`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblRental` (
  `strRentCode` varchar(45) NOT NULL,
  `strRentCustCode` varchar(45) NOT NULL,
  `dtmRentStart` datetime NOT NULL,
  `strRentDeliCode` varchar(45) NOT NULL,
  `txtRentAddress` text,
  PRIMARY KEY (`strRentCode`),
  KEY `fk_strRentDeliCode_idx` (`strRentDeliCode`),
  CONSTRAINT `fk_strRentDeliCode` FOREIGN KEY (`strRentDeliCode`) REFERENCES `tblDelivery` (`strDeliCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblRentalDetail`
--

DROP TABLE IF EXISTS `tblRentalDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblRentalDetail` (
  `strRentDetaCode` varchar(45) NOT NULL,
  `strRentDetaRentCode` varchar(45) NOT NULL,
  `strRentDetaEquiCode` varchar(45) NOT NULL,
  `intRentDetaQuantity` int(11) NOT NULL,
  `intRentDetaDuration` int(11) NOT NULL,
  PRIMARY KEY (`strRentDetaRentCode`,`strRentDetaEquiCode`,`strRentDetaCode`),
  KEY `fk_strRentDetaEquiCode_idx` (`strRentDetaEquiCode`),
  CONSTRAINT `fk_strRentDetaEquiCode` FOREIGN KEY (`strRentDetaEquiCode`) REFERENCES `tblEquipment` (`strEquiCode`) ON UPDATE CASCADE,
  CONSTRAINT `fk_strRentDetaRentCode` FOREIGN KEY (`strRentDetaRentCode`) REFERENCES `tblRental` (`strRentCode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblRentalExtension`
--

DROP TABLE IF EXISTS `tblRentalExtension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblRentalExtension` (
  `strRentExteCode` varchar(45) NOT NULL,
  `strRentExteRentDetaCode` varchar(45) NOT NULL,
  `intRentExteDuration` int(11) NOT NULL,
  PRIMARY KEY (`strRentExteCode`),
  KEY `fk_strRentExteRentDetaCode_idx` (`strRentExteRentDetaCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblServeType`
--

DROP TABLE IF EXISTS `tblServeType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblServeType` (
  `strServTypeCode` varchar(45) NOT NULL,
  `strServTypeName` varchar(100) NOT NULL,
  `txtServTypeDesc` text,
  PRIMARY KEY (`strServTypeCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblUnit`
--

DROP TABLE IF EXISTS `tblUnit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblUnit` (
  `strUnitCode` varchar(45) NOT NULL,
  `strUnitName` varchar(100) NOT NULL,
  `txtUnitDesc` text,
  PRIMARY KEY (`strUnitCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tblWaiter`
--

DROP TABLE IF EXISTS `tblWaiter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblWaiter` (
  `strWaitCode` varchar(45) NOT NULL,
  `strWaitFirst` varchar(100) NOT NULL,
  `strWaitMiddle` varchar(100) DEFAULT NULL,
  `strWaitLast` varchar(100) NOT NULL,
  PRIMARY KEY (`strWaitCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'pnmsdb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-03  9:53:17
