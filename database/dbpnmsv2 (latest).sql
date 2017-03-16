-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2017 at 03:44 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpnmsv2`
--
CREATE DATABASE IF NOT EXISTS `dbpnmsv2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbpnmsv2`;

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
(3, '2017_03_16_125752_add_timestamps_to_tblUOM', 1),
(4, '2017_03_16_125814_add_timestamps_to_tblItemRate', 1),
(5, '2017_03_16_125832_add_timestamps_to_tblItemPenalty', 1),
(6, '2017_03_16_125843_add_timestamps_to_tblItem', 1),
(7, '2017_03_16_125858_add_timestamps_to_tblEquipmentType', 1),
(8, '2017_03_16_125931_add_timestamps_to_tblDinnerwareType', 1),
(9, '2017_03_16_130536_add_timestamps_to_tblDishType', 2),
(10, '2017_03_16_130542_add_timestamps_to_tblDish', 2),
(11, '2017_03_16_130557_add_timestamps_to_tblMenu', 2),
(12, '2017_03_16_130609_add_timestamps_to_tblMenuRate', 2),
(13, '2017_03_16_130835_add_timestamps_to_tblDelivery', 3),
(14, '2017_03_16_130846_add_timestamps_to_tblPenalty', 3),
(15, '2017_03_16_131017_add_timestamps_to_tblCateringPackage', 4),
(16, '2017_03_16_131031_add_timestamps_to_tblRentalPackage', 4),
(17, '2017_03_16_142955_add_timestamps_to_tblDecor', 5),
(18, '2017_03_16_143014_add_timestamps_to_tblWaiterRatio', 5),
(19, '2017_03_16_143031_add_timestamps_to_tblEventType', 5);

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
-- Table structure for table `tblCateringPackage`
--

CREATE TABLE `tblCateringPackage` (
  `cateringPackageCode` varchar(45) NOT NULL,
  `cateringPackageName` varchar(100) NOT NULL,
  `cateringPackageDesc` text NOT NULL,
  `cateringPackageAmount` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblCateringPackageItem`
--

CREATE TABLE `tblCateringPackageItem` (
  `cateringPackageCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblCateringPackageMenu`
--

CREATE TABLE `tblCateringPackageMenu` (
  `cateringPackageCode` varchar(45) NOT NULL,
  `menuCode` varchar(45) NOT NULL,
  `menuRateCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblCustomer`
--

CREATE TABLE `tblCustomer` (
  `customerCode` varchar(45) NOT NULL,
  `customerFirst` varchar(100) NOT NULL,
  `customerMiddle` varchar(100) DEFAULT NULL,
  `customerLast` varchar(100) NOT NULL,
  `customerAddress` text NOT NULL,
  `customerContact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblDecor`
--

CREATE TABLE `tblDecor` (
  `decorCode` varchar(45) NOT NULL,
  `decorName` varchar(100) NOT NULL,
  `decorType` enum('1','2') NOT NULL,
  `decorDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblDecor`
--

INSERT INTO `tblDecor` (`decorCode`, `decorName`, `decorType`, `decorDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Ben 10', '2', NULL, '2017-03-16 07:24:12', '2017-03-16 07:24:12', NULL),
('0002', 'Yellow', '1', NULL, '2017-03-16 07:25:02', '2017-03-16 07:25:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblDelivery`
--

CREATE TABLE `tblDelivery` (
  `deliveryCode` varchar(45) NOT NULL,
  `deliveryLocation` varchar(100) NOT NULL,
  `deliveryFee` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblDelivery`
--

INSERT INTO `tblDelivery` (`deliveryCode`, `deliveryLocation`, `deliveryFee`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Fairview', '125.00', '2017-03-16 07:26:55', '2017-03-16 07:26:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblDinnerwareType`
--

CREATE TABLE `tblDinnerwareType` (
  `dinnerwareTypeCode` varchar(45) NOT NULL,
  `dinnerwareTypeName` varchar(100) NOT NULL,
  `dinnerwareTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblDinnerwareType`
--

INSERT INTO `tblDinnerwareType` (`dinnerwareTypeCode`, `dinnerwareTypeName`, `dinnerwareTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Glasswares', 'Dinnerwares that are babasagins', '2017-03-16 05:31:59', '2017-03-16 05:34:23', NULL),
('0002', 'Plates', NULL, '2017-03-16 06:18:39', '2017-03-16 06:18:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblDish`
--

CREATE TABLE `tblDish` (
  `dishCode` varchar(45) NOT NULL,
  `dishName` varchar(100) NOT NULL,
  `dishTypeCode` varchar(45) NOT NULL,
  `dishDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblDish`
--

INSERT INTO `tblDish` (`dishCode`, `dishName`, `dishTypeCode`, `dishDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('DSH0001', 'Adobong Manok', '0001', '', '2017-03-16 07:07:03', '2017-03-16 07:07:03', NULL),
('DSH0002', 'Chicken Afritada', '0001', '', '2017-03-16 07:07:18', '2017-03-16 07:07:18', NULL),
('DSH0003', 'Buko Pandan', '0002', '', '2017-03-16 07:07:49', '2017-03-16 07:07:49', NULL),
('DSH0004', 'Filipino Spaghetti', '0003', '', '2017-03-16 07:10:53', '2017-03-16 07:10:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblDishType`
--

CREATE TABLE `tblDishType` (
  `dishTypeCode` varchar(45) NOT NULL,
  `dishTypeName` varchar(100) NOT NULL,
  `dishTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblDishType`
--

INSERT INTO `tblDishType` (`dishTypeCode`, `dishTypeName`, `dishTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Main Course', NULL, '2017-03-16 07:06:39', '2017-03-16 07:06:39', NULL),
('0002', 'Dessert', NULL, '2017-03-16 07:07:28', '2017-03-16 07:07:28', NULL),
('0003', 'Pasta', NULL, '2017-03-16 07:10:35', '2017-03-16 07:10:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblEquipmentType`
--

CREATE TABLE `tblEquipmentType` (
  `equipmentTypeCode` varchar(45) NOT NULL,
  `equipmentTypeName` varchar(100) NOT NULL,
  `equipmentTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblEquipmentType`
--

INSERT INTO `tblEquipmentType` (`equipmentTypeCode`, `equipmentTypeName`, `equipmentTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Catering Equipment', 'eh eh eh', '2017-03-16 05:29:18', '2017-03-16 05:29:35', NULL),
('0002', 'Electronics', 'test test', '2017-03-16 05:29:48', '2017-03-16 05:30:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblEvent`
--

CREATE TABLE `tblEvent` (
  `eventCode` varchar(45) NOT NULL,
  `customerCode` varchar(45) NOT NULL,
  `eventTitle` varchar(100) NOT NULL,
  `eventStart` datetime NOT NULL,
  `eventEnd` datetime NOT NULL,
  `eventAddress` text,
  `deliveryId` varchar(45) NOT NULL,
  `waiterRatioCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblEventCateringPackage`
--

CREATE TABLE `tblEventCateringPackage` (
  `eventCode` varchar(45) NOT NULL,
  `cateringPackageCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblEventDecor`
--

CREATE TABLE `tblEventDecor` (
  `eventCode` varchar(45) NOT NULL,
  `decorCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblEventOrder`
--

CREATE TABLE `tblEventOrder` (
  `eventOrderCode` varchar(45) NOT NULL,
  `eventCode` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblEventOrderDetail`
--

CREATE TABLE `tblEventOrderDetail` (
  `eventOrderCode` varchar(45) NOT NULL,
  `menuCode` varchar(45) NOT NULL,
  `pax` int(11) NOT NULL,
  `servingType` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblEventType`
--

CREATE TABLE `tblEventType` (
  `eventTypeCode` varchar(45) NOT NULL,
  `eventTypeName` varchar(100) NOT NULL,
  `eventTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblEventType`
--

INSERT INTO `tblEventType` (`eventTypeCode`, `eventTypeName`, `eventTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Wedding', NULL, '2017-03-16 07:23:15', '2017-03-16 07:23:15', NULL),
('0002', 'Promenade', NULL, '2017-03-16 07:23:44', '2017-03-16 07:23:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblEventTypes`
--

CREATE TABLE `tblEventTypes` (
  `eventCode` varchar(45) NOT NULL,
  `eventTypeCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblInventoryDeficiency`
--

CREATE TABLE `tblInventoryDeficiency` (
  `inventoryDeficiencyCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblInventoryRelease`
--

CREATE TABLE `tblInventoryRelease` (
  `inventoryReleaseCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblInventoryReturn`
--

CREATE TABLE `tblInventoryReturn` (
  `inventoryReturnCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `quantity` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblInventoryStock`
--

CREATE TABLE `tblInventoryStock` (
  `inventoryStockCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblInvoice`
--

CREATE TABLE `tblInvoice` (
  `invoiceCode` varchar(45) NOT NULL,
  `customerCode` varchar(45) NOT NULL,
  `invoiceType` tinyint(1) NOT NULL,
  `invoiceNote` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblInvoiceEventOrder`
--

CREATE TABLE `tblInvoiceEventOrder` (
  `invoiceCode` varchar(45) NOT NULL,
  `eventOrderCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblInvoiceItemPenaltty`
--

CREATE TABLE `tblInvoiceItemPenaltty` (
  `invoiceCode` varchar(45) NOT NULL,
  `itemPenaltyCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblInvoicePenalty`
--

CREATE TABLE `tblInvoicePenalty` (
  `invoiceCode` varchar(45) NOT NULL,
  `penaltyCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblInvoiceRental`
--

CREATE TABLE `tblInvoiceRental` (
  `invoiceCode` varchar(45) NOT NULL,
  `rentalCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblItem`
--

CREATE TABLE `tblItem` (
  `itemCode` varchar(45) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `itemType` enum('1','2') NOT NULL,
  `uomCode` varchar(45) NOT NULL,
  `itemDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblItem`
--

INSERT INTO `tblItem` (`itemCode`, `itemName`, `itemType`, `uomCode`, `itemDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ITM0001', 'O\'hara Glass', '1', '0001', NULL, '2017-03-16 06:15:14', '2017-03-16 06:15:14', NULL),
('ITM0002', '5-inch Circular Plate', '1', '0001', NULL, '2017-03-16 06:21:23', '2017-03-16 06:21:23', NULL),
('ITM0003', 'Videoke Set', '2', '0001', NULL, '2017-03-16 07:04:54', '2017-03-16 07:04:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblItemDinnerware`
--

CREATE TABLE `tblItemDinnerware` (
  `itemCode` varchar(45) NOT NULL,
  `dinnerwareTypeCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblItemDinnerware`
--

INSERT INTO `tblItemDinnerware` (`itemCode`, `dinnerwareTypeCode`) VALUES
('ITM0001', '0001'),
('ITM0002', '0002');

-- --------------------------------------------------------

--
-- Table structure for table `tblItemEquipment`
--

CREATE TABLE `tblItemEquipment` (
  `itemCode` varchar(45) NOT NULL,
  `equipmentTypeCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblItemEquipment`
--

INSERT INTO `tblItemEquipment` (`itemCode`, `equipmentTypeCode`) VALUES
('ITM0003', '0002');

-- --------------------------------------------------------

--
-- Table structure for table `tblItemPenalty`
--

CREATE TABLE `tblItemPenalty` (
  `itemPenaltyCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `minQuantity` int(11) NOT NULL,
  `penaltyType` enum('1','2') NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `effectiveDate` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblItemPenalty`
--

INSERT INTO `tblItemPenalty` (`itemPenaltyCode`, `itemCode`, `minQuantity`, `penaltyType`, `amount`, `effectiveDate`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'ITM0002', 1, '1', '5.00', '2017-03-17 00:00:00', '2017-03-16 07:00:09', '2017-03-16 07:00:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblItemRate`
--

CREATE TABLE `tblItemRate` (
  `itemRateCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `unitCode` enum('1','2') NOT NULL,
  `effectiveDate` datetime NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblItemRate`
--

INSERT INTO `tblItemRate` (`itemRateCode`, `itemCode`, `unitCode`, `effectiveDate`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'ITM0002', '1', '2017-03-17 00:00:00', '13.00', '2017-03-16 06:47:37', '2017-03-16 06:47:37', NULL),
('0002', 'ITM0003', '2', '2017-03-16 00:00:00', '250.00', '2017-03-16 07:05:21', '2017-03-16 07:05:21', NULL),
('0003', 'ITM0003', '1', '2017-03-16 00:00:00', '100.00', '2017-03-16 07:05:46', '2017-03-16 07:05:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblMenu`
--

CREATE TABLE `tblMenu` (
  `menuCode` varchar(45) NOT NULL,
  `menuName` varchar(100) NOT NULL,
  `menuDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblMenu`
--

INSERT INTO `tblMenu` (`menuCode`, `menuName`, `menuDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('MEN0001', 'Filipino Menu A', NULL, '2017-03-16 07:08:14', '2017-03-16 07:08:14', NULL),
('MEN0002', 'Filipino Kiddie Menu A', NULL, '2017-03-16 07:11:21', '2017-03-16 07:11:21', NULL),
('MEN0003', 'Filipino Kiddie Menu B', NULL, '2017-03-16 07:12:45', '2017-03-16 07:12:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblMenuDish`
--

CREATE TABLE `tblMenuDish` (
  `menuCode` varchar(45) NOT NULL,
  `dishCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblMenuDish`
--

INSERT INTO `tblMenuDish` (`menuCode`, `dishCode`) VALUES
('MEN0001', 'DSH0001'),
('MEN0003', 'DSH0001'),
('MEN0001', 'DSH0002'),
('MEN0001', 'DSH0003'),
('MEN0002', 'DSH0003'),
('MEN0003', 'DSH0003'),
('MEN0002', 'DSH0004'),
('MEN0003', 'DSH0004');

-- --------------------------------------------------------

--
-- Table structure for table `tblMenuRate`
--

CREATE TABLE `tblMenuRate` (
  `menuRateCode` varchar(45) NOT NULL,
  `menuCode` varchar(45) NOT NULL,
  `servingType` enum('1','2') NOT NULL,
  `pax` int(11) NOT NULL,
  `effectiveDate` datetime NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblMenuRate`
--

INSERT INTO `tblMenuRate` (`menuRateCode`, `menuCode`, `servingType`, `pax`, `effectiveDate`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'MEN0003', '2', 10, '2017-03-16 00:00:00', '2000.00', '2017-03-16 07:16:47', '2017-03-16 07:16:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblPayment`
--

CREATE TABLE `tblPayment` (
  `paymentCode` varchar(45) NOT NULL,
  `customerCode` varchar(45) NOT NULL,
  `paymentMethod` tinyint(1) NOT NULL,
  `paymentAmount` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblPaymentBank`
--

CREATE TABLE `tblPaymentBank` (
  `paymentCode` varchar(45) NOT NULL,
  `bankReferenceCode` varchar(100) NOT NULL,
  `bankPaymentStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblPaymentDetail`
--

CREATE TABLE `tblPaymentDetail` (
  `paymentCode` varchar(45) NOT NULL,
  `invoiceCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblPenalty`
--

CREATE TABLE `tblPenalty` (
  `penaltyCode` varchar(45) NOT NULL,
  `penaltyName` varchar(100) NOT NULL,
  `penaltyDesc` text,
  `amount` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblRental`
--

CREATE TABLE `tblRental` (
  `rentalCode` varchar(45) NOT NULL,
  `customerCode` varchar(45) NOT NULL,
  `rentalAddress` text,
  `deliveryCode` varchar(45) NOT NULL,
  `rentalStatus` tinyint(1) NOT NULL,
  `rentalStart` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblRentalDetail`
--

CREATE TABLE `tblRentalDetail` (
  `rentalCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `duration` float NOT NULL,
  `unitCode` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblRentalDetailPackage`
--

CREATE TABLE `tblRentalDetailPackage` (
  `rentalCode` varchar(45) NOT NULL,
  `rentalPackageCode` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblRentalPackage`
--

CREATE TABLE `tblRentalPackage` (
  `rentalPackageCode` varchar(45) NOT NULL,
  `rentalPackageName` varchar(100) NOT NULL,
  `rentalPackageDuration` float NOT NULL,
  `rentalPackageUnit` enum('1','2') NOT NULL,
  `rentalPackageAmount` decimal(11,2) NOT NULL,
  `rentalPackageDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblRentalPackage`
--

INSERT INTO `tblRentalPackage` (`rentalPackageCode`, `rentalPackageName`, `rentalPackageDuration`, `rentalPackageUnit`, `rentalPackageAmount`, `rentalPackageDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('RNTPKG-001', 'Sample Rental Package', 1, '2', '1500.00', NULL, '2017-03-16 07:22:07', '2017-03-16 07:22:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblRentalPackageDetail`
--

CREATE TABLE `tblRentalPackageDetail` (
  `rentalPackageCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblRentalPackageDetail`
--

INSERT INTO `tblRentalPackageDetail` (`rentalPackageCode`, `itemCode`, `quantity`) VALUES
('RNTPKG-001', 'ITM0001', 50),
('RNTPKG-001', 'ITM0002', 50);

-- --------------------------------------------------------

--
-- Table structure for table `tblUOM`
--

CREATE TABLE `tblUOM` (
  `uomCode` varchar(45) NOT NULL,
  `uomSymbol` varchar(45) NOT NULL,
  `uomDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblUOM`
--

INSERT INTO `tblUOM` (`uomCode`, `uomSymbol`, `uomDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'pc', 'Piece', '2017-03-16 05:24:26', '2017-03-16 05:24:26', NULL),
('0002', 'kg', 'Kilogram', '2017-03-16 05:25:57', '2017-03-16 05:27:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblWaiterRatio`
--

CREATE TABLE `tblWaiterRatio` (
  `waiterRatioCode` varchar(45) NOT NULL,
  `waiterRatioMinPax` int(11) NOT NULL,
  `waiterRatioMaxPax` int(11) NOT NULL,
  `waiterRatioWaiterCount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblWaiterRatio`
--

INSERT INTO `tblWaiterRatio` (`waiterRatioCode`, `waiterRatioMinPax`, `waiterRatioMaxPax`, `waiterRatioWaiterCount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 1, 50, 3, '2017-03-16 07:25:36', '2017-03-16 07:25:36', NULL),
('0002', 51, 70, 5, '2017-03-16 07:26:12', '2017-03-16 07:26:12', NULL);

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
(1, 'Administrator', 'admin@localhost.com', 'admin', '$2y$10$eU55DDPHKrdD98QTrbcjy.D/8V1KOWx3wrCtNkGxUR97g3l6jgHBm', NULL, '2017-03-16 05:20:26', '2017-03-16 05:20:26');

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
-- Indexes for table `tblCateringPackage`
--
ALTER TABLE `tblCateringPackage`
  ADD PRIMARY KEY (`cateringPackageCode`);

--
-- Indexes for table `tblCateringPackageItem`
--
ALTER TABLE `tblCateringPackageItem`
  ADD PRIMARY KEY (`cateringPackageCode`,`itemCode`),
  ADD KEY `fk_cateringpackageitem_itemCode_idx` (`itemCode`);

--
-- Indexes for table `tblCateringPackageMenu`
--
ALTER TABLE `tblCateringPackageMenu`
  ADD PRIMARY KEY (`cateringPackageCode`,`menuCode`),
  ADD KEY `fk_cateringpackagemenu_menuCode_idx` (`menuCode`),
  ADD KEY `fk_cateringpackagemenu_menuRateCode_idx` (`menuRateCode`);

--
-- Indexes for table `tblCustomer`
--
ALTER TABLE `tblCustomer`
  ADD PRIMARY KEY (`customerCode`);

--
-- Indexes for table `tblDecor`
--
ALTER TABLE `tblDecor`
  ADD PRIMARY KEY (`decorCode`);

--
-- Indexes for table `tblDelivery`
--
ALTER TABLE `tblDelivery`
  ADD PRIMARY KEY (`deliveryCode`);

--
-- Indexes for table `tblDinnerwareType`
--
ALTER TABLE `tblDinnerwareType`
  ADD PRIMARY KEY (`dinnerwareTypeCode`);

--
-- Indexes for table `tblDish`
--
ALTER TABLE `tblDish`
  ADD PRIMARY KEY (`dishCode`),
  ADD KEY `fk_dish_dishTypeCode_idx` (`dishTypeCode`);

--
-- Indexes for table `tblDishType`
--
ALTER TABLE `tblDishType`
  ADD PRIMARY KEY (`dishTypeCode`);

--
-- Indexes for table `tblEquipmentType`
--
ALTER TABLE `tblEquipmentType`
  ADD PRIMARY KEY (`equipmentTypeCode`);

--
-- Indexes for table `tblEvent`
--
ALTER TABLE `tblEvent`
  ADD PRIMARY KEY (`eventCode`),
  ADD KEY `fk_event_customerCode_idx` (`customerCode`),
  ADD KEY `fk_event_deliveryCode_idx` (`deliveryId`),
  ADD KEY `fk_event_waiterRatioCode_idx` (`waiterRatioCode`);

--
-- Indexes for table `tblEventCateringPackage`
--
ALTER TABLE `tblEventCateringPackage`
  ADD PRIMARY KEY (`eventCode`,`cateringPackageCode`),
  ADD KEY `fk_eventcateringpackage_cateringPackageCode_idx` (`cateringPackageCode`);

--
-- Indexes for table `tblEventDecor`
--
ALTER TABLE `tblEventDecor`
  ADD PRIMARY KEY (`eventCode`,`decorCode`),
  ADD KEY `fk_eventdecor_decorCode_idx` (`decorCode`);

--
-- Indexes for table `tblEventOrder`
--
ALTER TABLE `tblEventOrder`
  ADD PRIMARY KEY (`eventOrderCode`,`eventCode`),
  ADD KEY `fk_eventorder_eventCode_idx` (`eventCode`);

--
-- Indexes for table `tblEventOrderDetail`
--
ALTER TABLE `tblEventOrderDetail`
  ADD PRIMARY KEY (`eventOrderCode`,`menuCode`),
  ADD KEY `fk_eventorderdetail_menuCode_idx` (`menuCode`);

--
-- Indexes for table `tblEventType`
--
ALTER TABLE `tblEventType`
  ADD PRIMARY KEY (`eventTypeCode`);

--
-- Indexes for table `tblEventTypes`
--
ALTER TABLE `tblEventTypes`
  ADD PRIMARY KEY (`eventCode`,`eventTypeCode`),
  ADD KEY `fk_eventtypes_eventTypeCode_idx` (`eventTypeCode`);

--
-- Indexes for table `tblInventoryDeficiency`
--
ALTER TABLE `tblInventoryDeficiency`
  ADD PRIMARY KEY (`inventoryDeficiencyCode`,`itemCode`),
  ADD KEY `fk_inventorydeficiency_itemCode_idx` (`itemCode`);

--
-- Indexes for table `tblInventoryRelease`
--
ALTER TABLE `tblInventoryRelease`
  ADD PRIMARY KEY (`inventoryReleaseCode`),
  ADD KEY `fk_inventoryrelease_itemCode_idx` (`itemCode`);

--
-- Indexes for table `tblInventoryReturn`
--
ALTER TABLE `tblInventoryReturn`
  ADD PRIMARY KEY (`inventoryReturnCode`),
  ADD KEY `fk_inventoryreturn_itemCode_idx` (`itemCode`);

--
-- Indexes for table `tblInventoryStock`
--
ALTER TABLE `tblInventoryStock`
  ADD PRIMARY KEY (`inventoryStockCode`),
  ADD KEY `fk_inventorystock_itemCode_idx` (`itemCode`);

--
-- Indexes for table `tblInvoice`
--
ALTER TABLE `tblInvoice`
  ADD PRIMARY KEY (`invoiceCode`),
  ADD KEY `fk_invoice_customerCode_idx` (`customerCode`);

--
-- Indexes for table `tblInvoiceEventOrder`
--
ALTER TABLE `tblInvoiceEventOrder`
  ADD PRIMARY KEY (`invoiceCode`,`eventOrderCode`),
  ADD KEY `fk_invoiceorder_orderCode_idx` (`eventOrderCode`);

--
-- Indexes for table `tblInvoiceItemPenaltty`
--
ALTER TABLE `tblInvoiceItemPenaltty`
  ADD PRIMARY KEY (`invoiceCode`,`itemPenaltyCode`),
  ADD KEY `fk_invoiceitempenalty_itemPenaltyCode_idx` (`itemPenaltyCode`);

--
-- Indexes for table `tblInvoicePenalty`
--
ALTER TABLE `tblInvoicePenalty`
  ADD PRIMARY KEY (`invoiceCode`,`penaltyCode`),
  ADD KEY `fk_invoicepenalty_penaltyCode_idx` (`penaltyCode`);

--
-- Indexes for table `tblInvoiceRental`
--
ALTER TABLE `tblInvoiceRental`
  ADD PRIMARY KEY (`invoiceCode`,`rentalCode`),
  ADD KEY `fk_invoicerental_rentalCode_idx` (`rentalCode`);

--
-- Indexes for table `tblItem`
--
ALTER TABLE `tblItem`
  ADD PRIMARY KEY (`itemCode`),
  ADD KEY `fk_item_uomCode_idx` (`uomCode`);

--
-- Indexes for table `tblItemDinnerware`
--
ALTER TABLE `tblItemDinnerware`
  ADD PRIMARY KEY (`itemCode`,`dinnerwareTypeCode`),
  ADD KEY `fk_itemdinnerware_dinnerwareTypeCode_idx` (`dinnerwareTypeCode`);

--
-- Indexes for table `tblItemEquipment`
--
ALTER TABLE `tblItemEquipment`
  ADD PRIMARY KEY (`itemCode`,`equipmentTypeCode`),
  ADD KEY `fk_itemequipment_equipmentTypeCode_idx` (`equipmentTypeCode`);

--
-- Indexes for table `tblItemPenalty`
--
ALTER TABLE `tblItemPenalty`
  ADD PRIMARY KEY (`itemPenaltyCode`),
  ADD KEY `fk_itempenalty_itemCode_idx` (`itemCode`);

--
-- Indexes for table `tblItemRate`
--
ALTER TABLE `tblItemRate`
  ADD PRIMARY KEY (`itemRateCode`),
  ADD KEY `fk_itemrate_itemCode_idx` (`itemCode`);

--
-- Indexes for table `tblMenu`
--
ALTER TABLE `tblMenu`
  ADD PRIMARY KEY (`menuCode`);

--
-- Indexes for table `tblMenuDish`
--
ALTER TABLE `tblMenuDish`
  ADD PRIMARY KEY (`menuCode`,`dishCode`),
  ADD KEY `fk_menudish_dishCode_idx` (`dishCode`);

--
-- Indexes for table `tblMenuRate`
--
ALTER TABLE `tblMenuRate`
  ADD PRIMARY KEY (`menuRateCode`),
  ADD KEY `fk_menurate_menuCode_idx` (`menuCode`);

--
-- Indexes for table `tblPayment`
--
ALTER TABLE `tblPayment`
  ADD PRIMARY KEY (`paymentCode`),
  ADD KEY `fk_payment_customerCode_idx` (`customerCode`);

--
-- Indexes for table `tblPaymentBank`
--
ALTER TABLE `tblPaymentBank`
  ADD PRIMARY KEY (`paymentCode`);

--
-- Indexes for table `tblPaymentDetail`
--
ALTER TABLE `tblPaymentDetail`
  ADD PRIMARY KEY (`paymentCode`,`invoiceCode`),
  ADD KEY `fk_paymentdetail_invoiceCode_idx` (`invoiceCode`);

--
-- Indexes for table `tblPenalty`
--
ALTER TABLE `tblPenalty`
  ADD PRIMARY KEY (`penaltyCode`);

--
-- Indexes for table `tblRental`
--
ALTER TABLE `tblRental`
  ADD PRIMARY KEY (`rentalCode`),
  ADD KEY `fk_rental_customerCode_idx` (`customerCode`),
  ADD KEY `fk_rental_deliveryCode_idx` (`deliveryCode`);

--
-- Indexes for table `tblRentalDetail`
--
ALTER TABLE `tblRentalDetail`
  ADD PRIMARY KEY (`rentalCode`,`itemCode`),
  ADD KEY `fk_rentaldetail_itemCode_idx` (`itemCode`);

--
-- Indexes for table `tblRentalDetailPackage`
--
ALTER TABLE `tblRentalDetailPackage`
  ADD PRIMARY KEY (`rentalCode`,`rentalPackageCode`),
  ADD KEY `fk_rentaldetailpackage_rentalPackageCode_idx` (`rentalPackageCode`);

--
-- Indexes for table `tblRentalPackage`
--
ALTER TABLE `tblRentalPackage`
  ADD PRIMARY KEY (`rentalPackageCode`);

--
-- Indexes for table `tblRentalPackageDetail`
--
ALTER TABLE `tblRentalPackageDetail`
  ADD PRIMARY KEY (`rentalPackageCode`,`itemCode`),
  ADD KEY `fk_rentalpackagedetail_itemCode_idx` (`itemCode`);

--
-- Indexes for table `tblUOM`
--
ALTER TABLE `tblUOM`
  ADD PRIMARY KEY (`uomCode`);

--
-- Indexes for table `tblWaiterRatio`
--
ALTER TABLE `tblWaiterRatio`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblCateringPackageItem`
--
ALTER TABLE `tblCateringPackageItem`
  ADD CONSTRAINT `fk_cateringpackageitem_cateringPackageCode` FOREIGN KEY (`cateringPackageCode`) REFERENCES `tblCateringPackage` (`cateringPackageCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cateringpackageitem_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblCateringPackageMenu`
--
ALTER TABLE `tblCateringPackageMenu`
  ADD CONSTRAINT `fk_cateringpackagemenu_cateringPackageCode` FOREIGN KEY (`cateringPackageCode`) REFERENCES `tblCateringPackage` (`cateringPackageCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cateringpackagemenu_menuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblMenu` (`menuCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cateringpackagemenu_menuRateCode` FOREIGN KEY (`menuRateCode`) REFERENCES `tblMenuRate` (`menuRateCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblDish`
--
ALTER TABLE `tblDish`
  ADD CONSTRAINT `fk_dish_dishTypeCode` FOREIGN KEY (`dishTypeCode`) REFERENCES `tblDishType` (`dishTypeCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblEvent`
--
ALTER TABLE `tblEvent`
  ADD CONSTRAINT `fk_event_customerCode` FOREIGN KEY (`customerCode`) REFERENCES `tblCustomer` (`customerCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event_deliveryCode` FOREIGN KEY (`deliveryId`) REFERENCES `tblDelivery` (`deliveryCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event_waiterRatioCode` FOREIGN KEY (`waiterRatioCode`) REFERENCES `tblWaiterRatio` (`waiterRatioCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblEventCateringPackage`
--
ALTER TABLE `tblEventCateringPackage`
  ADD CONSTRAINT `fk_eventcateringpackage_cateringPackageCode` FOREIGN KEY (`cateringPackageCode`) REFERENCES `tblCateringPackage` (`cateringPackageCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eventcateringpackage_eventCode` FOREIGN KEY (`eventCode`) REFERENCES `tblEvent` (`eventCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblEventDecor`
--
ALTER TABLE `tblEventDecor`
  ADD CONSTRAINT `fk_eventdecor_decorCode` FOREIGN KEY (`decorCode`) REFERENCES `tblDecor` (`decorCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eventdecor_eventCode` FOREIGN KEY (`eventCode`) REFERENCES `tblEvent` (`eventCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblEventOrder`
--
ALTER TABLE `tblEventOrder`
  ADD CONSTRAINT `fk_eventorder_eventCode` FOREIGN KEY (`eventCode`) REFERENCES `tblEvent` (`eventCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblEventOrderDetail`
--
ALTER TABLE `tblEventOrderDetail`
  ADD CONSTRAINT `fk_eventorderdetail_eventOrderCode` FOREIGN KEY (`eventOrderCode`) REFERENCES `tblEventOrder` (`eventOrderCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eventorderdetail_menuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblMenu` (`menuCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblEventTypes`
--
ALTER TABLE `tblEventTypes`
  ADD CONSTRAINT `fk_eventtypes_eventCode` FOREIGN KEY (`eventCode`) REFERENCES `tblEvent` (`eventCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eventtypes_eventTypeCode` FOREIGN KEY (`eventTypeCode`) REFERENCES `tblEventType` (`eventTypeCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblInventoryDeficiency`
--
ALTER TABLE `tblInventoryDeficiency`
  ADD CONSTRAINT `fk_inventorydeficiency_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblInventoryRelease`
--
ALTER TABLE `tblInventoryRelease`
  ADD CONSTRAINT `fk_inventoryrelease_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblInventoryReturn`
--
ALTER TABLE `tblInventoryReturn`
  ADD CONSTRAINT `fk_inventoryreturn_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblInventoryStock`
--
ALTER TABLE `tblInventoryStock`
  ADD CONSTRAINT `fk_inventorystock_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblInvoice`
--
ALTER TABLE `tblInvoice`
  ADD CONSTRAINT `fk_invoice_customerCode` FOREIGN KEY (`customerCode`) REFERENCES `tblCustomer` (`customerCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblInvoiceEventOrder`
--
ALTER TABLE `tblInvoiceEventOrder`
  ADD CONSTRAINT `fk_invoiceorder_eventOrderCode` FOREIGN KEY (`eventOrderCode`) REFERENCES `tblEventOrder` (`eventOrderCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoiceorder_invoiceCode` FOREIGN KEY (`invoiceCode`) REFERENCES `tblInvoice` (`invoiceCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblInvoiceItemPenaltty`
--
ALTER TABLE `tblInvoiceItemPenaltty`
  ADD CONSTRAINT `fk_invoiceitempenalty_invoiceCode` FOREIGN KEY (`invoiceCode`) REFERENCES `tblInvoice` (`invoiceCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoiceitempenalty_itemPenaltyCode` FOREIGN KEY (`itemPenaltyCode`) REFERENCES `tblItemPenalty` (`itemPenaltyCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblInvoicePenalty`
--
ALTER TABLE `tblInvoicePenalty`
  ADD CONSTRAINT `fk_invoicepenalty_invoiceCode` FOREIGN KEY (`invoiceCode`) REFERENCES `tblInvoice` (`invoiceCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoicepenalty_penaltyCode` FOREIGN KEY (`penaltyCode`) REFERENCES `tblPenalty` (`penaltyCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblInvoiceRental`
--
ALTER TABLE `tblInvoiceRental`
  ADD CONSTRAINT `fk_invoicerental_invoiceCode` FOREIGN KEY (`invoiceCode`) REFERENCES `tblInvoice` (`invoiceCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoicerental_rentalCode` FOREIGN KEY (`rentalCode`) REFERENCES `tblRental` (`rentalCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblItem`
--
ALTER TABLE `tblItem`
  ADD CONSTRAINT `fk_item_uomCode` FOREIGN KEY (`uomCode`) REFERENCES `tblUOM` (`uomCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblItemDinnerware`
--
ALTER TABLE `tblItemDinnerware`
  ADD CONSTRAINT `fk_itemdinnerware_dinnerwareTypeCode` FOREIGN KEY (`dinnerwareTypeCode`) REFERENCES `tblDinnerwareType` (`dinnerwareTypeCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_itemdinnerware_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblItemEquipment`
--
ALTER TABLE `tblItemEquipment`
  ADD CONSTRAINT `fk_itemequipment_equipmentTypeCode` FOREIGN KEY (`equipmentTypeCode`) REFERENCES `tblEquipmentType` (`equipmentTypeCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_itemequipment_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblItemPenalty`
--
ALTER TABLE `tblItemPenalty`
  ADD CONSTRAINT `fk_itempenalty_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblItemRate`
--
ALTER TABLE `tblItemRate`
  ADD CONSTRAINT `fk_itemrate_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblMenuDish`
--
ALTER TABLE `tblMenuDish`
  ADD CONSTRAINT `fk_menudish_dishCode` FOREIGN KEY (`dishCode`) REFERENCES `tblDish` (`dishCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_menudish_menuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblMenu` (`menuCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblMenuRate`
--
ALTER TABLE `tblMenuRate`
  ADD CONSTRAINT `fk_menurate_menuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblMenu` (`menuCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblPayment`
--
ALTER TABLE `tblPayment`
  ADD CONSTRAINT `fk_payment_customerCode` FOREIGN KEY (`customerCode`) REFERENCES `tblCustomer` (`customerCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblPaymentBank`
--
ALTER TABLE `tblPaymentBank`
  ADD CONSTRAINT `fk_paymentbank_paymentCode` FOREIGN KEY (`paymentCode`) REFERENCES `tblPayment` (`paymentCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblPaymentDetail`
--
ALTER TABLE `tblPaymentDetail`
  ADD CONSTRAINT `fk_paymentdetail_invoiceCode` FOREIGN KEY (`invoiceCode`) REFERENCES `tblInvoice` (`invoiceCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_paymentdetail_paymentCode` FOREIGN KEY (`paymentCode`) REFERENCES `tblPayment` (`paymentCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblRental`
--
ALTER TABLE `tblRental`
  ADD CONSTRAINT `fk_rental_customerCode` FOREIGN KEY (`customerCode`) REFERENCES `tblCustomer` (`customerCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rental_deliveryCode` FOREIGN KEY (`deliveryCode`) REFERENCES `tblDelivery` (`deliveryCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblRentalDetail`
--
ALTER TABLE `tblRentalDetail`
  ADD CONSTRAINT `fk_rentaldetail_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rentaldetail_rentalCode` FOREIGN KEY (`rentalCode`) REFERENCES `tblRental` (`rentalCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblRentalDetailPackage`
--
ALTER TABLE `tblRentalDetailPackage`
  ADD CONSTRAINT `fk_rentaldetailpackage_rentalCode` FOREIGN KEY (`rentalCode`) REFERENCES `tblRental` (`rentalCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rentaldetailpackage_rentalPackageCode` FOREIGN KEY (`rentalPackageCode`) REFERENCES `tblRentalPackage` (`rentalPackageCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblRentalPackageDetail`
--
ALTER TABLE `tblRentalPackageDetail`
  ADD CONSTRAINT `fk_rentalpackagedetail_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblItem` (`itemCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rentalpackagedetail_rentalPackageCode` FOREIGN KEY (`rentalPackageCode`) REFERENCES `tblRentalPackage` (`rentalPackageCode`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
