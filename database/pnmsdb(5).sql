-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2017 at 11:55 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pnmsdb`
--
CREATE DATABASE IF NOT EXISTS `pnmsdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pnmsdb`;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_02_15_161227_tblBankPayment', 1),
(4, '2017_02_15_161324_tblCustomer', 1),
(5, '2017_02_15_161336_tblDecor', 1),
(6, '2017_02_15_161346_tblDelivery', 1),
(7, '2017_02_15_161408_tblDinnerwareType', 1),
(8, '2017_02_15_161417_tblDish', 1),
(9, '2017_02_15_161423_tblDishType', 1),
(10, '2017_02_15_161433_tblEquipmentType', 1),
(11, '2017_02_15_161452_tblEvent', 1),
(12, '2017_02_15_161458_tblEventDecor', 1),
(13, '2017_02_15_161506_tblEventType', 1),
(14, '2017_02_15_161515_tblEventTypes', 1),
(15, '2017_02_15_161534_tblInventory', 1),
(16, '2017_02_15_161553_tblInventoryDeficiency', 1),
(17, '2017_02_15_161604_tblInventoryRelease', 1),
(18, '2017_02_15_161612_tblInventoryStock', 1),
(19, '2017_02_15_161641_tblInvoice', 1),
(20, '2017_02_15_161652_tblItem', 1),
(21, '2017_02_15_161700_tblItemDinnerware', 1),
(22, '2017_02_15_161720_tblItemEquipment', 1),
(23, '2017_02_15_161729_tblItemRate', 1),
(24, '2017_02_15_161755_tblMenu', 1),
(25, '2017_02_15_161804_tblMenuBuffet', 1),
(26, '2017_02_15_161817_tblMenuDetail', 1),
(27, '2017_02_15_161827_tblMenuSet', 1),
(28, '2017_02_15_161835_tblOrder', 1),
(29, '2017_02_15_161845_tblOrderDetail', 1),
(30, '2017_02_15_161904_tblOrderInvoice', 1),
(31, '2017_02_15_161916_tblPayment', 1),
(32, '2017_02_15_161930_tblPaymentDetail', 1),
(33, '2017_02_15_161940_tblPenalty', 1),
(34, '2017_02_15_162008_tblPenaltyInvoice', 1),
(35, '2017_02_15_162015_tblPenaltyItem', 1),
(36, '2017_02_15_162024_tblPenaltyOther', 1),
(37, '2017_02_15_162037_tblQuantityRatio', 1),
(38, '2017_02_15_162053_tblRental', 1),
(39, '2017_02_15_162100_tblRentalDetail', 1),
(40, '2017_02_15_162107_tblRentalInvoice', 1),
(41, '2017_02_15_162126_tblUOM', 1),
(42, '2017_02_15_162142_tblWaiterRatio', 1),
(43, '2017_02_17_075623_TblMenuRate', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TblBankPayment`
--

CREATE TABLE `TblBankPayment` (
  `paymentCode` varchar(45) NOT NULL,
  `bankReferenceCode` varchar(100) NOT NULL,
  `bankPaymentStatus` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblCustomer`
--

CREATE TABLE `TblCustomer` (
  `customerCode` varchar(45) NOT NULL,
  `customerFirst` varchar(100) NOT NULL,
  `customerMiddle` varchar(100) DEFAULT NULL,
  `customerLast` varchar(100) NOT NULL,
  `customerAddress` text NOT NULL,
  `customerContact` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblDecor`
--

CREATE TABLE `TblDecor` (
  `decorCode` varchar(45) NOT NULL,
  `decorName` varchar(100) NOT NULL,
  `decorType` enum('1','2') NOT NULL,
  `decorDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblDecor`
--

INSERT INTO `TblDecor` (`decorCode`, `decorName`, `decorType`, `decorDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Ben10', '2', NULL, '2017-02-17 07:50:27', '2017-02-17 07:50:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblDelivery`
--

CREATE TABLE `TblDelivery` (
  `deliveryCode` varchar(45) NOT NULL,
  `deliveryLocation` varchar(45) NOT NULL,
  `deliveryFee` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblDelivery`
--

INSERT INTO `TblDelivery` (`deliveryCode`, `deliveryLocation`, `deliveryFee`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Fairview', '100.00', '2017-02-17 07:51:18', '2017-02-17 07:51:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblDinnerwareType`
--

CREATE TABLE `TblDinnerwareType` (
  `dinnerwareTypeCode` varchar(45) NOT NULL,
  `dinnerwareTypeName` varchar(100) NOT NULL,
  `dinnerwareTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblDinnerwareType`
--

INSERT INTO `TblDinnerwareType` (`dinnerwareTypeCode`, `dinnerwareTypeName`, `dinnerwareTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Utensils', NULL, '2017-02-17 07:23:05', '2017-02-17 07:23:05', NULL),
('0002', 'Glassware', NULL, '2017-02-17 21:40:37', '2017-02-17 21:40:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblDish`
--

CREATE TABLE `TblDish` (
  `dishCode` varchar(45) NOT NULL,
  `dishName` varchar(100) NOT NULL,
  `dishTypeCode` varchar(45) NOT NULL,
  `dishDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblDish`
--

INSERT INTO `TblDish` (`dishCode`, `dishName`, `dishTypeCode`, `dishDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('DSH0001', 'Beef Caldereta', '0001', '', '2017-02-17 07:32:08', '2017-02-17 07:32:08', NULL),
('DSH0002', 'Adobo', '0001', '', '2017-02-17 07:32:24', '2017-02-17 07:32:24', NULL),
('DSH0003', 'Iced Tea', '0002', '', '2017-02-17 07:32:40', '2017-02-17 07:32:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblDishType`
--

CREATE TABLE `TblDishType` (
  `dishTypeCode` varchar(45) NOT NULL,
  `dishTypeName` varchar(100) NOT NULL,
  `dishTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblDishType`
--

INSERT INTO `TblDishType` (`dishTypeCode`, `dishTypeName`, `dishTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Main Course', NULL, '2017-02-17 07:31:17', '2017-02-17 07:31:17', NULL),
('0002', 'Beverage', NULL, '2017-02-17 07:31:27', '2017-02-17 07:31:27', NULL),
('0003', 'Salad', NULL, '2017-02-17 21:44:07', '2017-02-17 21:44:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblEquipmentType`
--

CREATE TABLE `TblEquipmentType` (
  `equipmentTypeCode` varchar(45) NOT NULL,
  `equipmentTypeName` varchar(100) NOT NULL,
  `equipmentTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblEquipmentType`
--

INSERT INTO `TblEquipmentType` (`equipmentTypeCode`, `equipmentTypeName`, `equipmentTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Catering Equipment', NULL, '2017-02-17 07:22:39', '2017-02-17 07:22:39', NULL),
('0002', 'Electronics', NULL, '2017-02-17 21:39:15', '2017-02-17 21:39:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblEvent`
--

CREATE TABLE `TblEvent` (
  `eventCode` varchar(45) NOT NULL,
  `customerCode` varchar(45) NOT NULL,
  `eventTitle` varchar(100) NOT NULL,
  `eventDate` datetime NOT NULL,
  `eventReception` text NOT NULL,
  `eventDesc` text,
  `deliveryCode` varchar(45) NOT NULL,
  `waiterRatioCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblEventDecor`
--

CREATE TABLE `TblEventDecor` (
  `eventCode` varchar(45) NOT NULL,
  `decorCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblEventType`
--

CREATE TABLE `TblEventType` (
  `eventTypeCode` varchar(45) NOT NULL,
  `eventTypeName` varchar(100) NOT NULL,
  `eventTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblEventType`
--

INSERT INTO `TblEventType` (`eventTypeCode`, `eventTypeName`, `eventTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Wedding', NULL, '2017-02-17 07:49:10', '2017-02-17 07:49:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblEventTypes`
--

CREATE TABLE `TblEventTypes` (
  `eventCode` varchar(45) NOT NULL,
  `eventTypeCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblInventory`
--

CREATE TABLE `TblInventory` (
  `inventoryCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `inventoryThreshold` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblInventoryDeficiency`
--

CREATE TABLE `TblInventoryDeficiency` (
  `inventoryDeficiencyCode` int(11) NOT NULL,
  `inventoryCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `remarks` tinyint(1) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblInventoryRelease`
--

CREATE TABLE `TblInventoryRelease` (
  `inventoryReleaseCode` varchar(45) NOT NULL,
  `inventoryCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblInventoryStock`
--

CREATE TABLE `TblInventoryStock` (
  `inventoryStockCode` varchar(45) NOT NULL,
  `inventoryCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblInvoice`
--

CREATE TABLE `TblInvoice` (
  `invoiceCode` varchar(45) NOT NULL,
  `customerCode` varchar(45) NOT NULL,
  `invoiceType` tinyint(1) NOT NULL,
  `amount` decimal(5,2) NOT NULL,
  `invoiceNote` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblItem`
--

CREATE TABLE `TblItem` (
  `itemCode` varchar(45) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `itemDesc` text,
  `itemType` enum('1','2') NOT NULL,
  `uomCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblItem`
--

INSERT INTO `TblItem` (`itemCode`, `itemName`, `itemDesc`, `itemType`, `uomCode`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ITM0001', 'Long Table', NULL, '2', '0001', '2017-02-17 07:23:42', '2017-02-17 07:23:42', NULL),
('ITM0002', 'Tea Spoon', NULL, '1', '0001', '2017-02-17 07:30:36', '2017-02-17 07:30:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblItemDinnerware`
--

CREATE TABLE `TblItemDinnerware` (
  `itemCode` varchar(45) NOT NULL,
  `dinnerwareTypeCode` varchar(45) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblItemDinnerware`
--

INSERT INTO `TblItemDinnerware` (`itemCode`, `dinnerwareTypeCode`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ITM0002', '0001', NULL, '2017-02-17 07:30:37', '2017-02-17 07:30:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblItemEquipment`
--

CREATE TABLE `TblItemEquipment` (
  `itemCode` varchar(45) NOT NULL,
  `equipmentTypeCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblItemEquipment`
--

INSERT INTO `TblItemEquipment` (`itemCode`, `equipmentTypeCode`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ITM0001', '0001', '2017-02-17 07:23:42', '2017-02-17 07:23:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblItemRate`
--

CREATE TABLE `TblItemRate` (
  `itemRateCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `amount` decimal(5,2) NOT NULL,
  `uomCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblItemRate`
--

INSERT INTO `TblItemRate` (`itemRateCode`, `itemCode`, `amount`, `uomCode`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'ITM0001', '150.00', '0001', '2017-02-17 07:35:37', '2017-02-17 07:35:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblMenu`
--

CREATE TABLE `TblMenu` (
  `menuCode` varchar(45) NOT NULL,
  `menuName` varchar(100) NOT NULL,
  `menuType` enum('1','2') NOT NULL,
  `menuDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblMenu`
--

INSERT INTO `TblMenu` (`menuCode`, `menuName`, `menuType`, `menuDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('MEN0001', 'Filipino Set A', '1', NULL, '2017-02-17 00:28:43', '2017-02-17 00:28:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblMenuBuffet`
--

CREATE TABLE `TblMenuBuffet` (
  `menuCode` varchar(45) NOT NULL,
  `quantityRatioCode` varchar(45) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblMenuDetail`
--

CREATE TABLE `TblMenuDetail` (
  `menuCode` varchar(45) NOT NULL,
  `dishCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblMenuDetail`
--

INSERT INTO `TblMenuDetail` (`menuCode`, `dishCode`, `created_at`, `updated_at`, `deleted_at`) VALUES
('MEN0001', 'DSH0001', NULL, NULL, NULL),
('MEN0001', 'DSH0002', NULL, NULL, NULL),
('MEN0001', 'DSH0003', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblMenuRate`
--

CREATE TABLE `tblMenuRate` (
  `menuRateCode` varchar(45) NOT NULL,
  `menuCode` varchar(45) NOT NULL,
  `servingType` enum('1','2') NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblMenuRate`
--

INSERT INTO `tblMenuRate` (`menuRateCode`, `menuCode`, `servingType`, `quantity`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'MEN0001', '1', 7, '1050.00', '2017-02-17 01:21:51', '2017-02-17 07:48:09', NULL),
('0002', 'MEN0001', '2', NULL, '250.00', '2017-02-17 07:39:12', '2017-02-17 07:39:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblMenuSet`
--

CREATE TABLE `TblMenuSet` (
  `menuCode` varchar(45) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblOrder`
--

CREATE TABLE `TblOrder` (
  `orderCode` varchar(45) NOT NULL,
  `eventCode` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblOrderDetail`
--

CREATE TABLE `TblOrderDetail` (
  `orderCode` varchar(45) NOT NULL,
  `menuCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblOrderInvoice`
--

CREATE TABLE `TblOrderInvoice` (
  `invoiceCode` varchar(45) NOT NULL,
  `orderCode` varchar(45) NOT NULL,
  `deliveryCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblPayment`
--

CREATE TABLE `TblPayment` (
  `paymentCode` varchar(45) NOT NULL,
  `customerCode` varchar(45) NOT NULL,
  `paymentMethod` tinyint(1) NOT NULL,
  `paymentAmount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblPaymentDetail`
--

CREATE TABLE `TblPaymentDetail` (
  `paymentCode` varchar(45) NOT NULL,
  `invoiceCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblPenalty`
--

CREATE TABLE `TblPenalty` (
  `penaltyCode` varchar(45) NOT NULL,
  `penaltyName` varchar(100) DEFAULT NULL,
  `penaltyType` enum('1','2','3') NOT NULL,
  `itemCode` varchar(45) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblPenalty`
--

INSERT INTO `TblPenalty` (`penaltyCode`, `penaltyName`, `penaltyType`, `itemCode`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Late Payment Fee', '3', NULL, '100.00', '2017-02-17 07:08:26', '2017-02-17 07:08:26', NULL),
('0002', NULL, '1', 'ITM0001', '150.00', '2017-02-17 07:52:19', '2017-02-17 07:52:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblPenaltyInvoice`
--

CREATE TABLE `TblPenaltyInvoice` (
  `invoiceCode` varchar(45) NOT NULL,
  `penaltyCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblPenaltyItem`
--

CREATE TABLE `TblPenaltyItem` (
  `penaltyCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `minPoint` int(11) DEFAULT NULL,
  `amount` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblPenaltyOther`
--

CREATE TABLE `TblPenaltyOther` (
  `penaltyCode` varchar(45) NOT NULL,
  `amount` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblQuantityRatio`
--

CREATE TABLE `TblQuantityRatio` (
  `quantityRatioCode` varchar(45) NOT NULL,
  `quantityRatioMinPax` int(11) NOT NULL,
  `quantityRatioMaxPax` int(11) NOT NULL,
  `quantityRatioKilo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblRental`
--

CREATE TABLE `TblRental` (
  `rentalCode` varchar(45) NOT NULL,
  `customerCode` varchar(45) NOT NULL,
  `rentalAddress` text NOT NULL,
  `deliveryCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblRentalDetail`
--

CREATE TABLE `TblRentalDetail` (
  `rentalCode` varchar(45) NOT NULL,
  `inventoryCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblRentalInvoice`
--

CREATE TABLE `TblRentalInvoice` (
  `invoiceCode` varchar(45) NOT NULL,
  `rentalCode` varchar(45) NOT NULL,
  `deliveryCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TblUOM`
--

CREATE TABLE `TblUOM` (
  `uomCode` varchar(45) NOT NULL,
  `uomName` varchar(100) NOT NULL,
  `uomDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblUOM`
--

INSERT INTO `TblUOM` (`uomCode`, `uomName`, `uomDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Piece', NULL, '2017-02-17 07:22:16', '2017-02-17 07:22:16', NULL),
('0002', 'Box', NULL, '2017-02-17 21:38:47', '2017-02-17 21:38:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TblWaiterRatio`
--

CREATE TABLE `TblWaiterRatio` (
  `waiterRatioCode` varchar(45) NOT NULL,
  `waiterRatioMinPax` int(11) NOT NULL,
  `waiterRatioMaxPax` int(11) NOT NULL,
  `waiterRatioWaiterCount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblWaiterRatio`
--

INSERT INTO `TblWaiterRatio` (`waiterRatioCode`, `waiterRatioMinPax`, `waiterRatioMaxPax`, `waiterRatioWaiterCount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 50, 70, 3, '2017-02-17 07:50:55', '2017-02-17 07:50:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@localhost.com', 'admin', '$2y$10$uDC7o9vdGLt2QLvsUjADl.mHl8TsTMkdxM2b7GInGYzo0ZF8nxykq', 'F5AUhIfbKl4k1FLcz6lbn1wAi115cOaBs0qsRlMpdh9BYokr9x0cACBPQZrg', '2017-02-17 00:27:55', '2017-02-17 00:27:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `TblBankPayment`
--
ALTER TABLE `TblBankPayment`
  ADD PRIMARY KEY (`paymentCode`);

--
-- Indexes for table `TblCustomer`
--
ALTER TABLE `TblCustomer`
  ADD PRIMARY KEY (`customerCode`);

--
-- Indexes for table `TblDecor`
--
ALTER TABLE `TblDecor`
  ADD PRIMARY KEY (`decorCode`);

--
-- Indexes for table `TblDelivery`
--
ALTER TABLE `TblDelivery`
  ADD PRIMARY KEY (`deliveryCode`);

--
-- Indexes for table `TblDinnerwareType`
--
ALTER TABLE `TblDinnerwareType`
  ADD PRIMARY KEY (`dinnerwareTypeCode`);

--
-- Indexes for table `TblDish`
--
ALTER TABLE `TblDish`
  ADD PRIMARY KEY (`dishCode`),
  ADD KEY `fk_Dish_dishTypeCode_idx` (`dishTypeCode`);

--
-- Indexes for table `TblDishType`
--
ALTER TABLE `TblDishType`
  ADD PRIMARY KEY (`dishTypeCode`);

--
-- Indexes for table `TblEquipmentType`
--
ALTER TABLE `TblEquipmentType`
  ADD PRIMARY KEY (`equipmentTypeCode`);

--
-- Indexes for table `TblEvent`
--
ALTER TABLE `TblEvent`
  ADD PRIMARY KEY (`eventCode`),
  ADD KEY `fk_Event_customerCode_idx` (`customerCode`),
  ADD KEY `fk_Event_waiterRatioCode_idx` (`waiterRatioCode`);

--
-- Indexes for table `TblEventDecor`
--
ALTER TABLE `TblEventDecor`
  ADD PRIMARY KEY (`eventCode`,`decorCode`),
  ADD KEY `fk_EventDecor_decorCode_idx` (`decorCode`);

--
-- Indexes for table `TblEventType`
--
ALTER TABLE `TblEventType`
  ADD PRIMARY KEY (`eventTypeCode`);

--
-- Indexes for table `TblEventTypes`
--
ALTER TABLE `TblEventTypes`
  ADD PRIMARY KEY (`eventCode`,`eventTypeCode`),
  ADD KEY `fk_EventTypes_eventTypeCode_idx` (`eventTypeCode`);

--
-- Indexes for table `TblInventory`
--
ALTER TABLE `TblInventory`
  ADD PRIMARY KEY (`inventoryCode`),
  ADD KEY `fk_Inventory_itemCode_idx` (`itemCode`);

--
-- Indexes for table `TblInventoryDeficiency`
--
ALTER TABLE `TblInventoryDeficiency`
  ADD PRIMARY KEY (`inventoryCode`,`inventoryDeficiencyCode`);

--
-- Indexes for table `TblInventoryRelease`
--
ALTER TABLE `TblInventoryRelease`
  ADD PRIMARY KEY (`inventoryReleaseCode`),
  ADD KEY `fk_InventoryRelease_inventoryCode_idx` (`inventoryCode`);

--
-- Indexes for table `TblInventoryStock`
--
ALTER TABLE `TblInventoryStock`
  ADD PRIMARY KEY (`inventoryStockCode`),
  ADD KEY `fk_InventoryStock_inventoryCode_idx` (`inventoryCode`);

--
-- Indexes for table `TblInvoice`
--
ALTER TABLE `TblInvoice`
  ADD PRIMARY KEY (`invoiceCode`),
  ADD KEY `fk_Invoice_customerCode_idx` (`customerCode`);

--
-- Indexes for table `TblItem`
--
ALTER TABLE `TblItem`
  ADD PRIMARY KEY (`itemCode`),
  ADD KEY `fk_Item_uomCode_idx` (`uomCode`);

--
-- Indexes for table `TblItemDinnerware`
--
ALTER TABLE `TblItemDinnerware`
  ADD PRIMARY KEY (`itemCode`),
  ADD KEY `fk_ItemDinnerware_dinnerwareTypeCode_idx` (`dinnerwareTypeCode`);

--
-- Indexes for table `TblItemEquipment`
--
ALTER TABLE `TblItemEquipment`
  ADD PRIMARY KEY (`itemCode`),
  ADD KEY `fk_ItemEquipment_equipmentTypeCode_idx` (`equipmentTypeCode`);

--
-- Indexes for table `TblItemRate`
--
ALTER TABLE `TblItemRate`
  ADD PRIMARY KEY (`itemRateCode`),
  ADD KEY `fk_ItemRate_uomCode_idx` (`uomCode`);

--
-- Indexes for table `TblMenu`
--
ALTER TABLE `TblMenu`
  ADD PRIMARY KEY (`menuCode`);

--
-- Indexes for table `TblMenuBuffet`
--
ALTER TABLE `TblMenuBuffet`
  ADD PRIMARY KEY (`menuCode`),
  ADD KEY `fk_MenuBuffet_quantityRatioCode_idx` (`quantityRatioCode`);

--
-- Indexes for table `TblMenuDetail`
--
ALTER TABLE `TblMenuDetail`
  ADD PRIMARY KEY (`menuCode`,`dishCode`),
  ADD KEY `fk_MenuDetail_dishCode_idx` (`dishCode`);

--
-- Indexes for table `tblMenuRate`
--
ALTER TABLE `tblMenuRate`
  ADD PRIMARY KEY (`menuRateCode`);

--
-- Indexes for table `TblMenuSet`
--
ALTER TABLE `TblMenuSet`
  ADD PRIMARY KEY (`menuCode`);

--
-- Indexes for table `TblOrder`
--
ALTER TABLE `TblOrder`
  ADD PRIMARY KEY (`orderCode`);

--
-- Indexes for table `TblOrderDetail`
--
ALTER TABLE `TblOrderDetail`
  ADD PRIMARY KEY (`orderCode`,`menuCode`),
  ADD KEY `fk_OrderDetail_MenuCode_idx` (`menuCode`);

--
-- Indexes for table `TblOrderInvoice`
--
ALTER TABLE `TblOrderInvoice`
  ADD PRIMARY KEY (`invoiceCode`,`orderCode`),
  ADD KEY `fk_OrderInvoice_orderCode_idx` (`orderCode`),
  ADD KEY `fk_OrderInvoice_deliveryCode_idx` (`deliveryCode`);

--
-- Indexes for table `TblPayment`
--
ALTER TABLE `TblPayment`
  ADD PRIMARY KEY (`paymentCode`),
  ADD KEY `fk_Payment_customerCode_idx` (`customerCode`);

--
-- Indexes for table `TblPaymentDetail`
--
ALTER TABLE `TblPaymentDetail`
  ADD PRIMARY KEY (`paymentCode`,`invoiceCode`),
  ADD KEY `fk_PaymentDetail_invoiceCode_idx` (`invoiceCode`);

--
-- Indexes for table `TblPenalty`
--
ALTER TABLE `TblPenalty`
  ADD PRIMARY KEY (`penaltyCode`),
  ADD UNIQUE KEY `itemCode` (`itemCode`);

--
-- Indexes for table `TblPenaltyInvoice`
--
ALTER TABLE `TblPenaltyInvoice`
  ADD PRIMARY KEY (`invoiceCode`,`penaltyCode`);

--
-- Indexes for table `TblPenaltyItem`
--
ALTER TABLE `TblPenaltyItem`
  ADD PRIMARY KEY (`penaltyCode`);

--
-- Indexes for table `TblPenaltyOther`
--
ALTER TABLE `TblPenaltyOther`
  ADD PRIMARY KEY (`penaltyCode`);

--
-- Indexes for table `TblQuantityRatio`
--
ALTER TABLE `TblQuantityRatio`
  ADD PRIMARY KEY (`quantityRatioCode`);

--
-- Indexes for table `TblRental`
--
ALTER TABLE `TblRental`
  ADD PRIMARY KEY (`rentalCode`);

--
-- Indexes for table `TblRentalDetail`
--
ALTER TABLE `TblRentalDetail`
  ADD PRIMARY KEY (`rentalCode`,`inventoryCode`);

--
-- Indexes for table `TblRentalInvoice`
--
ALTER TABLE `TblRentalInvoice`
  ADD PRIMARY KEY (`invoiceCode`,`rentalCode`),
  ADD KEY `fk_RentalInvoice_rentalCode_idx` (`rentalCode`),
  ADD KEY `fk_RentalInvoice_deliveryCode_idx` (`deliveryCode`);

--
-- Indexes for table `TblUOM`
--
ALTER TABLE `TblUOM`
  ADD PRIMARY KEY (`uomCode`);

--
-- Indexes for table `TblWaiterRatio`
--
ALTER TABLE `TblWaiterRatio`
  ADD PRIMARY KEY (`waiterRatioCode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `TblDish`
--
ALTER TABLE `TblDish`
  ADD CONSTRAINT `fk_Dish_dishTypeCode` FOREIGN KEY (`dishTypeCode`) REFERENCES `tblDishType` (`dishTypeCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblEvent`
--
ALTER TABLE `TblEvent`
  ADD CONSTRAINT `fk_Event_customerCode` FOREIGN KEY (`customerCode`) REFERENCES `tblCustomer` (`customerCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Event_waiterRatioCode` FOREIGN KEY (`waiterRatioCode`) REFERENCES `tblWaiterRatio` (`waiterRatioCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblEventDecor`
--
ALTER TABLE `TblEventDecor`
  ADD CONSTRAINT `fk_EventDecor_decorCode` FOREIGN KEY (`decorCode`) REFERENCES `tblDecor` (`decorCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_EventDecor_eventCode` FOREIGN KEY (`eventCode`) REFERENCES `tblEvent` (`eventCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblEventTypes`
--
ALTER TABLE `TblEventTypes`
  ADD CONSTRAINT `fk_EventTypes_eventCode` FOREIGN KEY (`eventCode`) REFERENCES `tblEvent` (`eventCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_EventTypes_eventTypeCode` FOREIGN KEY (`eventTypeCode`) REFERENCES `tblEventType` (`eventTypeCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblInventory`
--
ALTER TABLE `TblInventory`
  ADD CONSTRAINT `fk_Inventory_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblInventoryDeficiency`
--
ALTER TABLE `TblInventoryDeficiency`
  ADD CONSTRAINT `fk_InventoryDeficiency_inventoryCode` FOREIGN KEY (`inventoryCode`) REFERENCES `tblInventory` (`inventoryCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblInventoryRelease`
--
ALTER TABLE `TblInventoryRelease`
  ADD CONSTRAINT `fk_InventoryRelease_inventoryCode` FOREIGN KEY (`inventoryCode`) REFERENCES `tblInventory` (`inventoryCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblInventoryStock`
--
ALTER TABLE `TblInventoryStock`
  ADD CONSTRAINT `fk_InventoryStock_inventoryCode` FOREIGN KEY (`inventoryCode`) REFERENCES `tblInventory` (`inventoryCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblInvoice`
--
ALTER TABLE `TblInvoice`
  ADD CONSTRAINT `fk_Invoice_customerCode` FOREIGN KEY (`customerCode`) REFERENCES `tblCustomer` (`customerCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblItem`
--
ALTER TABLE `TblItem`
  ADD CONSTRAINT `fk_Item_uomCode` FOREIGN KEY (`uomCode`) REFERENCES `tblUOM` (`uomCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblItemDinnerware`
--
ALTER TABLE `TblItemDinnerware`
  ADD CONSTRAINT `fk_ItemDinnerware_dinnerwareTypeCode` FOREIGN KEY (`dinnerwareTypeCode`) REFERENCES `tblDinnerwareType` (`dinnerwareTypeCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ItemDinnerware_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblItemEquipment`
--
ALTER TABLE `TblItemEquipment`
  ADD CONSTRAINT `fk_ItemEquipment_equipmentTypeCode` FOREIGN KEY (`equipmentTypeCode`) REFERENCES `tblEquipmentType` (`equipmentTypeCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ItemEquipment_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblItemRate`
--
ALTER TABLE `TblItemRate`
  ADD CONSTRAINT `fk_ItemRate_uomCode` FOREIGN KEY (`uomCode`) REFERENCES `tblUOM` (`uomCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblMenuBuffet`
--
ALTER TABLE `TblMenuBuffet`
  ADD CONSTRAINT `fk_MenuBuffet_menuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblMenu` (`menuCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_MenuBuffet_quantityRatioCode` FOREIGN KEY (`quantityRatioCode`) REFERENCES `tblQuantityRatio` (`quantityRatioCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblMenuDetail`
--
ALTER TABLE `TblMenuDetail`
  ADD CONSTRAINT `fk_MenuDetail_dishCode` FOREIGN KEY (`dishCode`) REFERENCES `tblDish` (`dishCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_MenuDetail_menuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblMenu` (`menuCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblMenuSet`
--
ALTER TABLE `TblMenuSet`
  ADD CONSTRAINT `fk_MenuSet_menuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblMenu` (`menuCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblOrderDetail`
--
ALTER TABLE `TblOrderDetail`
  ADD CONSTRAINT `fk_OrderDetail_MenuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblMenu` (`menuCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_OrderDetail_OrderCode` FOREIGN KEY (`orderCode`) REFERENCES `tblOrder` (`orderCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblOrderInvoice`
--
ALTER TABLE `TblOrderInvoice`
  ADD CONSTRAINT `fk_OrderInvoice_deliveryCode` FOREIGN KEY (`deliveryCode`) REFERENCES `tblDelivery` (`deliveryCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_OrderInvoice_invoiceCode` FOREIGN KEY (`invoiceCode`) REFERENCES `tblInvoice` (`invoiceCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_OrderInvoice_orderCode` FOREIGN KEY (`orderCode`) REFERENCES `tblOrder` (`orderCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblPayment`
--
ALTER TABLE `TblPayment`
  ADD CONSTRAINT `fk_Payment_customerCode` FOREIGN KEY (`customerCode`) REFERENCES `tblCustomer` (`customerCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblPaymentDetail`
--
ALTER TABLE `TblPaymentDetail`
  ADD CONSTRAINT `fk_PaymentDetail_invoiceCode` FOREIGN KEY (`invoiceCode`) REFERENCES `tblInvoice` (`invoiceCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_PaymentDetail_paymentCode` FOREIGN KEY (`paymentCode`) REFERENCES `tblPayment` (`paymentCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblPenalty`
--
ALTER TABLE `TblPenalty`
  ADD CONSTRAINT `fk_Penalty_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `TblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblPenaltyItem`
--
ALTER TABLE `TblPenaltyItem`
  ADD CONSTRAINT `fk_PenaltyItem_penaltyCode` FOREIGN KEY (`penaltyCode`) REFERENCES `tblPenalty` (`penaltyCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblPenaltyOther`
--
ALTER TABLE `TblPenaltyOther`
  ADD CONSTRAINT `fk_PenaltyOther_penaltyCode` FOREIGN KEY (`penaltyCode`) REFERENCES `tblPenalty` (`penaltyCode`) ON UPDATE CASCADE;

--
-- Constraints for table `TblRentalInvoice`
--
ALTER TABLE `TblRentalInvoice`
  ADD CONSTRAINT `fk_RentalInvoice_deliveryCode` FOREIGN KEY (`deliveryCode`) REFERENCES `tblDelivery` (`deliveryCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_RentalInvoice_invoiceCode` FOREIGN KEY (`invoiceCode`) REFERENCES `tblInvoice` (`invoiceCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_RentalInvoice_rentalCode` FOREIGN KEY (`rentalCode`) REFERENCES `tblRental` (`rentalCode`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
