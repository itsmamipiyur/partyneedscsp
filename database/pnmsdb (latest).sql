-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2017 at 03:18 PM
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
(43, '2017_02_17_075623_TblMenuRate', 1),
(44, '2017_02_26_075240_add_timestamps_to_tblPackage', 2),
(45, '2017_02_26_080110_add_timestamps_to_tblPackageType', 3),
(46, '2017_02_26_075240_add_timestamps_to_tblCateringPackage', 4),
(47, '2017_02_26_165206_add_timestamps_to_tblRentalPackage', 4);

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
-- Table structure for table `tblbankpayment`
--

CREATE TABLE `tblbankpayment` (
  `paymentCode` varchar(45) NOT NULL,
  `bankReferenceCode` varchar(100) NOT NULL,
  `bankPaymentStatus` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblCateringPackage`
--

CREATE TABLE `tblCateringPackage` (
  `cateringPackageCode` varchar(45) NOT NULL,
  `cateringPackageName` varchar(100) NOT NULL,
  `cateringPackageDesc` text,
  `cateringPackageAmount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblCateringPackage`
--

INSERT INTO `tblCateringPackage` (`cateringPackageCode`, `cateringPackageName`, `cateringPackageDesc`, `cateringPackageAmount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('PKG0001', 'BirthdayPackage', NULL, '35500.00', '2017-03-09 06:42:39', '2017-03-09 06:42:39', NULL),
('PKG0002', 'WeddingPackage', NULL, '1000.00', '2017-03-09 21:51:41', '2017-03-09 21:51:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblCateringPackageItem`
--

CREATE TABLE `tblCateringPackageItem` (
  `cateringPackageCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblCateringPackageItem`
--

INSERT INTO `tblCateringPackageItem` (`cateringPackageCode`, `itemCode`, `quantity`) VALUES
('PKG0001', 'ITM0001', 90),
('PKG0001', 'ITM0002', 37),
('PKG0002', 'ITM0001', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tblCateringPackageMenu`
--

CREATE TABLE `tblCateringPackageMenu` (
  `cateringPackageCode` varchar(45) NOT NULL,
  `menuCode` varchar(45) NOT NULL,
  `pax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblCateringPackageMenu`
--

INSERT INTO `tblCateringPackageMenu` (`cateringPackageCode`, `menuCode`, `pax`) VALUES
('PKG0001', 'MEN0002', 30),
('PKG0001', 'MEN0003', 70),
('PKG0002', 'MEN0001', 70),
('PKG0002', 'MEN0003', 40);

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
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
-- Table structure for table `tbldecor`
--

CREATE TABLE `tbldecor` (
  `decorCode` varchar(45) NOT NULL,
  `decorName` varchar(100) NOT NULL,
  `decorType` enum('1','2') NOT NULL,
  `decorDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldecor`
--

INSERT INTO `tbldecor` (`decorCode`, `decorName`, `decorType`, `decorDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Ben10', '2', NULL, '2017-02-17 07:50:27', '2017-02-17 07:50:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbldelivery`
--

CREATE TABLE `tbldelivery` (
  `deliveryCode` varchar(45) NOT NULL,
  `deliveryLocation` varchar(45) NOT NULL,
  `deliveryFee` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldelivery`
--

INSERT INTO `tbldelivery` (`deliveryCode`, `deliveryLocation`, `deliveryFee`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Fairview', '100.00', '2017-02-17 07:51:18', '2017-02-17 07:51:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbldinnerwaretype`
--

CREATE TABLE `tbldinnerwaretype` (
  `dinnerwareTypeCode` varchar(45) NOT NULL,
  `dinnerwareTypeName` varchar(100) NOT NULL,
  `dinnerwareTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldinnerwaretype`
--

INSERT INTO `tbldinnerwaretype` (`dinnerwareTypeCode`, `dinnerwareTypeName`, `dinnerwareTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Utensils', NULL, '2017-02-17 07:23:05', '2017-02-17 07:23:05', NULL),
('0002', 'Glassware', NULL, '2017-02-17 21:40:37', '2017-02-17 21:40:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbldish`
--

CREATE TABLE `tbldish` (
  `dishCode` varchar(45) NOT NULL,
  `dishName` varchar(100) NOT NULL,
  `dishTypeCode` varchar(45) NOT NULL,
  `dishDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldish`
--

INSERT INTO `tbldish` (`dishCode`, `dishName`, `dishTypeCode`, `dishDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('DSH0001', 'Beef Caldereta', '0001', '', '2017-02-17 07:32:08', '2017-02-17 07:32:08', NULL),
('DSH0002', 'Adobo', '0001', '', '2017-02-17 07:32:24', '2017-02-17 07:32:24', NULL),
('DSH0003', 'Iced Tea', '0002', '', '2017-02-17 07:32:40', '2017-02-17 07:32:40', NULL),
('DSH0004', 'Spaghetti', '0004', '', '2017-02-25 19:40:23', '2017-02-25 19:40:23', NULL),
('DSH0005', 'Carbonarra', '0004', '', '2017-02-25 19:40:33', '2017-02-25 19:40:33', NULL),
('DSH0006', 'Fried Chicken', '0001', '', '2017-02-25 21:51:59', '2017-02-25 21:51:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbldishtype`
--

CREATE TABLE `tbldishtype` (
  `dishTypeCode` varchar(45) NOT NULL,
  `dishTypeName` varchar(100) NOT NULL,
  `dishTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldishtype`
--

INSERT INTO `tbldishtype` (`dishTypeCode`, `dishTypeName`, `dishTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Main Course', NULL, '2017-02-17 07:31:17', '2017-02-17 07:31:17', NULL),
('0002', 'Beverages', NULL, '2017-02-17 07:31:27', '2017-03-06 01:49:18', NULL),
('0003', 'Salad', NULL, '2017-02-17 21:44:07', '2017-02-17 21:44:07', NULL),
('0004', 'Pasta', NULL, '2017-02-25 19:40:00', '2017-02-25 19:40:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblequipmenttype`
--

CREATE TABLE `tblequipmenttype` (
  `equipmentTypeCode` varchar(45) NOT NULL,
  `equipmentTypeName` varchar(100) NOT NULL,
  `equipmentTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblequipmenttype`
--

INSERT INTO `tblequipmenttype` (`equipmentTypeCode`, `equipmentTypeName`, `equipmentTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Catering Equipment', NULL, '2017-02-17 07:22:39', '2017-02-17 07:22:39', NULL),
('0002', 'Electronics', NULL, '2017-02-17 21:39:15', '2017-02-17 21:39:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblevent`
--

CREATE TABLE `tblevent` (
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
-- Table structure for table `tbleventdecor`
--

CREATE TABLE `tbleventdecor` (
  `eventCode` varchar(45) NOT NULL,
  `decorCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventtype`
--

CREATE TABLE `tbleventtype` (
  `eventTypeCode` varchar(45) NOT NULL,
  `eventTypeName` varchar(100) NOT NULL,
  `eventTypeDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbleventtype`
--

INSERT INTO `tbleventtype` (`eventTypeCode`, `eventTypeName`, `eventTypeDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Wedding', NULL, '2017-02-17 07:49:10', '2017-02-17 07:49:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbleventtypes`
--

CREATE TABLE `tbleventtypes` (
  `eventCode` varchar(45) NOT NULL,
  `eventTypeCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblinventory`
--

CREATE TABLE `tblinventory` (
  `inventoryCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `inventoryThreshold` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblinventorydeficiency`
--

CREATE TABLE `tblinventorydeficiency` (
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
-- Table structure for table `tblinventoryrelease`
--

CREATE TABLE `tblinventoryrelease` (
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
-- Table structure for table `tblinventorystock`
--

CREATE TABLE `tblinventorystock` (
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
-- Table structure for table `tblinvoice`
--

CREATE TABLE `tblinvoice` (
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
-- Table structure for table `tblitem`
--

CREATE TABLE `tblitem` (
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
-- Dumping data for table `tblitem`
--

INSERT INTO `tblitem` (`itemCode`, `itemName`, `itemDesc`, `itemType`, `uomCode`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ITM0001', 'Long Table', NULL, '2', '0001', '2017-02-17 07:23:42', '2017-02-17 07:23:42', NULL),
('ITM0002', 'Tea Spoon', NULL, '1', '0001', '2017-02-17 07:30:36', '2017-02-17 07:30:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblitemdinnerware`
--

CREATE TABLE `tblitemdinnerware` (
  `itemCode` varchar(45) NOT NULL,
  `dinnerwareTypeCode` varchar(45) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblitemdinnerware`
--

INSERT INTO `tblitemdinnerware` (`itemCode`, `dinnerwareTypeCode`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ITM0002', '0001', NULL, '2017-02-17 07:30:37', '2017-02-17 07:30:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblitemequipment`
--

CREATE TABLE `tblitemequipment` (
  `itemCode` varchar(45) NOT NULL,
  `equipmentTypeCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblitemequipment`
--

INSERT INTO `tblitemequipment` (`itemCode`, `equipmentTypeCode`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ITM0001', '0001', '2017-02-17 07:23:42', '2017-02-17 07:23:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblitemrate`
--

CREATE TABLE `tblitemrate` (
  `itemRateCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `uomCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblitemrate`
--

INSERT INTO `tblitemrate` (`itemRateCode`, `itemCode`, `amount`, `uomCode`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'ITM0002', '12.00', '1', '2017-03-09 20:07:06', '2017-03-09 20:07:06', NULL),
('0002', 'ITM0002', '100.00', '2', '2017-03-09 20:09:47', '2017-03-10 05:06:52', NULL),
('0004', 'ITM0001', '2000.00', '2', '2017-03-09 21:53:57', '2017-03-10 05:15:32', NULL),
('0005', 'ITM0001', '10.00', '1', '2017-03-10 00:10:41', '2017-03-10 00:10:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblmenu`
--

CREATE TABLE `tblmenu` (
  `menuCode` varchar(45) NOT NULL,
  `menuName` varchar(100) NOT NULL,
  `menuType` enum('1','2') NOT NULL,
  `menuDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmenu`
--

INSERT INTO `tblmenu` (`menuCode`, `menuName`, `menuType`, `menuDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('MEN0001', 'Kiddie Menu A', '1', NULL, '2017-02-25 19:51:52', '2017-02-25 19:51:52', NULL),
('MEN0002', 'Kiddie Menu B', '1', NULL, '2017-02-25 21:52:28', '2017-02-25 21:52:28', NULL),
('MEN0003', 'Filipino Menu A', '1', NULL, '2017-02-26 07:46:13', '2017-02-26 07:46:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblmenubuffet`
--

CREATE TABLE `tblmenubuffet` (
  `menuCode` varchar(45) NOT NULL,
  `quantityRatioCode` varchar(45) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmenudetail`
--

CREATE TABLE `tblmenudetail` (
  `menuCode` varchar(45) NOT NULL,
  `dishCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmenudetail`
--

INSERT INTO `tblmenudetail` (`menuCode`, `dishCode`, `created_at`, `updated_at`, `deleted_at`) VALUES
('MEN0001', 'DSH0003', NULL, NULL, NULL),
('MEN0001', 'DSH0004', NULL, NULL, NULL),
('MEN0001', 'DSH0005', NULL, NULL, NULL),
('MEN0002', 'DSH0001', NULL, NULL, NULL),
('MEN0002', 'DSH0004', NULL, NULL, NULL),
('MEN0003', 'DSH0004', NULL, NULL, NULL),
('MEN0003', 'DSH0005', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblmenurate`
--

CREATE TABLE `tblmenurate` (
  `menuRateCode` varchar(45) NOT NULL,
  `menuCode` varchar(45) NOT NULL,
  `servingType` enum('1','2') NOT NULL,
  `pax` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmenurate`
--

INSERT INTO `tblmenurate` (`menuRateCode`, `menuCode`, `servingType`, `pax`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'MEN0003', '1', 60, '1000.00', '2017-03-10 05:50:31', '2017-03-10 05:50:31', NULL),
('0002', 'MEN0003', '2', 60, '1500.00', '2017-03-10 05:55:26', '2017-03-10 05:55:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblmenuset`
--

CREATE TABLE `tblmenuset` (
  `menuCode` varchar(45) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `orderCode` varchar(45) NOT NULL,
  `eventCode` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblorderdetail`
--

CREATE TABLE `tblorderdetail` (
  `orderCode` varchar(45) NOT NULL,
  `menuCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblorderinvoice`
--

CREATE TABLE `tblorderinvoice` (
  `invoiceCode` varchar(45) NOT NULL,
  `orderCode` varchar(45) NOT NULL,
  `deliveryCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
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
-- Table structure for table `tblpaymentdetail`
--

CREATE TABLE `tblpaymentdetail` (
  `paymentCode` varchar(45) NOT NULL,
  `invoiceCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpenalty`
--

CREATE TABLE `tblpenalty` (
  `penaltyCode` varchar(45) NOT NULL,
  `penaltyName` varchar(100) DEFAULT NULL,
  `penaltyDesc` text,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpenalty`
--

INSERT INTO `tblpenalty` (`penaltyCode`, `penaltyName`, `penaltyDesc`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Late Payment Kasi', NULL, '100.00', '2017-03-10 06:27:39', '2017-03-10 06:35:15', '2017-03-10 06:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `tblpenaltyinvoice`
--

CREATE TABLE `tblpenaltyinvoice` (
  `invoiceCode` varchar(45) NOT NULL,
  `penaltyCode` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpenaltyitem`
--

CREATE TABLE `tblpenaltyitem` (
  `penaltyItemCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `minLevel` int(11) NOT NULL,
  `penaltyType` enum('1','2') NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpenaltyitem`
--

INSERT INTO `tblpenaltyitem` (`penaltyItemCode`, `itemCode`, `minLevel`, `penaltyType`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0002', 'ITM0001', 1, '2', '500.00', '2017-03-10 07:16:26', '2017-03-10 07:16:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpenaltyother`
--

CREATE TABLE `tblpenaltyother` (
  `penaltyCode` varchar(45) NOT NULL,
  `amount` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblquantityratio`
--

CREATE TABLE `tblquantityratio` (
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
-- Table structure for table `tblrental`
--

CREATE TABLE `tblrental` (
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
-- Table structure for table `tblrentaldetail`
--

CREATE TABLE `tblrentaldetail` (
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
-- Table structure for table `tblrentalinvoice`
--

CREATE TABLE `tblrentalinvoice` (
  `invoiceCode` varchar(45) NOT NULL,
  `rentalCode` varchar(45) NOT NULL,
  `deliveryCode` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblRentalPackage`
--

CREATE TABLE `tblRentalPackage` (
  `rentalPackageCode` varchar(45) NOT NULL,
  `rentalPackageName` varchar(100) NOT NULL,
  `rentalPackageDesc` text,
  `rentalPackageDuration` int(11) NOT NULL,
  `rentalPackageUnit` enum('1','2') NOT NULL,
  `rentalPackageAmount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblRentalPackage`
--

INSERT INTO `tblRentalPackage` (`rentalPackageCode`, `rentalPackageName`, `rentalPackageDesc`, `rentalPackageDuration`, `rentalPackageUnit`, `rentalPackageAmount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('RNTPKG-001', 'Sample Rental Package', NULL, 3, '2', '1500.00', '2017-02-26 19:24:15', '2017-02-26 19:24:15', NULL),
('RNTPKG-002', 'SampleRental', NULL, 3, '1', '1234.00', '2017-03-09 18:49:00', '2017-03-09 18:49:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblRentalPackageDetail`
--

CREATE TABLE `tblRentalPackageDetail` (
  `rentalPackageCode` varchar(45) NOT NULL,
  `itemCode` varchar(45) NOT NULL,
  `quantity` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblRentalPackageDetail`
--

INSERT INTO `tblRentalPackageDetail` (`rentalPackageCode`, `itemCode`, `quantity`) VALUES
('RNTPKG-001', 'ITM0001', 50),
('RNTPKG-001', 'ITM0002', 10),
('RNTPKG-002', 'ITM0001', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbluom`
--

CREATE TABLE `tbluom` (
  `uomCode` varchar(45) NOT NULL,
  `uomName` varchar(100) NOT NULL,
  `uomDesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluom`
--

INSERT INTO `tbluom` (`uomCode`, `uomName`, `uomDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0001', 'Piece', NULL, '2017-02-17 07:22:16', '2017-02-25 17:39:15', '2017-02-25 17:39:15'),
('0002', 'Box', NULL, '2017-02-17 21:38:47', '2017-02-25 17:39:11', '2017-02-25 17:39:11'),
('0003', 'Pc', 'Piece', '2017-02-25 17:39:50', '2017-02-25 17:39:50', NULL),
('0004', 'Kg', 'Kilogram', '2017-03-03 07:36:38', '2017-03-03 07:36:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblwaiterratio`
--

CREATE TABLE `tblwaiterratio` (
  `waiterRatioCode` varchar(45) NOT NULL,
  `waiterRatioMinPax` int(11) NOT NULL,
  `waiterRatioMaxPax` int(11) NOT NULL,
  `waiterRatioWaiterCount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblwaiterratio`
--

INSERT INTO `tblwaiterratio` (`waiterRatioCode`, `waiterRatioMinPax`, `waiterRatioMaxPax`, `waiterRatioWaiterCount`, `created_at`, `updated_at`, `deleted_at`) VALUES
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
-- Indexes for table `tblbankpayment`
--
ALTER TABLE `tblbankpayment`
  ADD PRIMARY KEY (`paymentCode`);

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
  ADD KEY `fk_PackageItem_itemCode_idx` (`itemCode`);

--
-- Indexes for table `tblCateringPackageMenu`
--
ALTER TABLE `tblCateringPackageMenu`
  ADD PRIMARY KEY (`cateringPackageCode`,`menuCode`),
  ADD KEY `fk_PackageMenu_menuCode_idx` (`menuCode`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`customerCode`);

--
-- Indexes for table `tbldecor`
--
ALTER TABLE `tbldecor`
  ADD PRIMARY KEY (`decorCode`);

--
-- Indexes for table `tbldelivery`
--
ALTER TABLE `tbldelivery`
  ADD PRIMARY KEY (`deliveryCode`);

--
-- Indexes for table `tbldinnerwaretype`
--
ALTER TABLE `tbldinnerwaretype`
  ADD PRIMARY KEY (`dinnerwareTypeCode`);

--
-- Indexes for table `tbldish`
--
ALTER TABLE `tbldish`
  ADD PRIMARY KEY (`dishCode`),
  ADD KEY `fk_Dish_dishTypeCode_idx` (`dishTypeCode`);

--
-- Indexes for table `tbldishtype`
--
ALTER TABLE `tbldishtype`
  ADD PRIMARY KEY (`dishTypeCode`);

--
-- Indexes for table `tblequipmenttype`
--
ALTER TABLE `tblequipmenttype`
  ADD PRIMARY KEY (`equipmentTypeCode`);

--
-- Indexes for table `tblevent`
--
ALTER TABLE `tblevent`
  ADD PRIMARY KEY (`eventCode`),
  ADD KEY `fk_Event_customerCode_idx` (`customerCode`),
  ADD KEY `fk_Event_waiterRatioCode_idx` (`waiterRatioCode`);

--
-- Indexes for table `tbleventdecor`
--
ALTER TABLE `tbleventdecor`
  ADD PRIMARY KEY (`eventCode`,`decorCode`),
  ADD KEY `fk_EventDecor_decorCode_idx` (`decorCode`);

--
-- Indexes for table `tbleventtype`
--
ALTER TABLE `tbleventtype`
  ADD PRIMARY KEY (`eventTypeCode`);

--
-- Indexes for table `tbleventtypes`
--
ALTER TABLE `tbleventtypes`
  ADD PRIMARY KEY (`eventCode`,`eventTypeCode`),
  ADD KEY `fk_EventTypes_eventTypeCode_idx` (`eventTypeCode`);

--
-- Indexes for table `tblinventory`
--
ALTER TABLE `tblinventory`
  ADD PRIMARY KEY (`inventoryCode`),
  ADD KEY `fk_Inventory_itemCode_idx` (`itemCode`);

--
-- Indexes for table `tblinventorydeficiency`
--
ALTER TABLE `tblinventorydeficiency`
  ADD PRIMARY KEY (`inventoryCode`,`inventoryDeficiencyCode`);

--
-- Indexes for table `tblinventoryrelease`
--
ALTER TABLE `tblinventoryrelease`
  ADD PRIMARY KEY (`inventoryReleaseCode`),
  ADD KEY `fk_InventoryRelease_inventoryCode_idx` (`inventoryCode`);

--
-- Indexes for table `tblinventorystock`
--
ALTER TABLE `tblinventorystock`
  ADD PRIMARY KEY (`inventoryStockCode`),
  ADD KEY `fk_InventoryStock_inventoryCode_idx` (`inventoryCode`);

--
-- Indexes for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  ADD PRIMARY KEY (`invoiceCode`),
  ADD KEY `fk_Invoice_customerCode_idx` (`customerCode`);

--
-- Indexes for table `tblitem`
--
ALTER TABLE `tblitem`
  ADD PRIMARY KEY (`itemCode`),
  ADD KEY `fk_Item_uomCode_idx` (`uomCode`);

--
-- Indexes for table `tblitemdinnerware`
--
ALTER TABLE `tblitemdinnerware`
  ADD PRIMARY KEY (`itemCode`),
  ADD KEY `fk_ItemDinnerware_dinnerwareTypeCode_idx` (`dinnerwareTypeCode`);

--
-- Indexes for table `tblitemequipment`
--
ALTER TABLE `tblitemequipment`
  ADD PRIMARY KEY (`itemCode`),
  ADD KEY `fk_ItemEquipment_equipmentTypeCode_idx` (`equipmentTypeCode`);

--
-- Indexes for table `tblitemrate`
--
ALTER TABLE `tblitemrate`
  ADD PRIMARY KEY (`itemRateCode`),
  ADD UNIQUE KEY `UNIDX` (`uomCode`,`itemCode`);

--
-- Indexes for table `tblmenu`
--
ALTER TABLE `tblmenu`
  ADD PRIMARY KEY (`menuCode`);

--
-- Indexes for table `tblmenubuffet`
--
ALTER TABLE `tblmenubuffet`
  ADD PRIMARY KEY (`menuCode`),
  ADD KEY `fk_MenuBuffet_quantityRatioCode_idx` (`quantityRatioCode`);

--
-- Indexes for table `tblmenudetail`
--
ALTER TABLE `tblmenudetail`
  ADD PRIMARY KEY (`menuCode`,`dishCode`),
  ADD KEY `fk_MenuDetail_dishCode_idx` (`dishCode`);

--
-- Indexes for table `tblmenurate`
--
ALTER TABLE `tblmenurate`
  ADD PRIMARY KEY (`menuRateCode`);

--
-- Indexes for table `tblmenuset`
--
ALTER TABLE `tblmenuset`
  ADD PRIMARY KEY (`menuCode`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`orderCode`);

--
-- Indexes for table `tblorderdetail`
--
ALTER TABLE `tblorderdetail`
  ADD PRIMARY KEY (`orderCode`,`menuCode`),
  ADD KEY `fk_OrderDetail_MenuCode_idx` (`menuCode`);

--
-- Indexes for table `tblorderinvoice`
--
ALTER TABLE `tblorderinvoice`
  ADD PRIMARY KEY (`invoiceCode`,`orderCode`),
  ADD KEY `fk_OrderInvoice_orderCode_idx` (`orderCode`),
  ADD KEY `fk_OrderInvoice_deliveryCode_idx` (`deliveryCode`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`paymentCode`),
  ADD KEY `fk_Payment_customerCode_idx` (`customerCode`);

--
-- Indexes for table `tblpaymentdetail`
--
ALTER TABLE `tblpaymentdetail`
  ADD PRIMARY KEY (`paymentCode`,`invoiceCode`),
  ADD KEY `fk_PaymentDetail_invoiceCode_idx` (`invoiceCode`);

--
-- Indexes for table `tblpenalty`
--
ALTER TABLE `tblpenalty`
  ADD PRIMARY KEY (`penaltyCode`);

--
-- Indexes for table `tblpenaltyinvoice`
--
ALTER TABLE `tblpenaltyinvoice`
  ADD PRIMARY KEY (`invoiceCode`,`penaltyCode`);

--
-- Indexes for table `tblpenaltyitem`
--
ALTER TABLE `tblpenaltyitem`
  ADD PRIMARY KEY (`penaltyItemCode`);

--
-- Indexes for table `tblpenaltyother`
--
ALTER TABLE `tblpenaltyother`
  ADD PRIMARY KEY (`penaltyCode`);

--
-- Indexes for table `tblquantityratio`
--
ALTER TABLE `tblquantityratio`
  ADD PRIMARY KEY (`quantityRatioCode`);

--
-- Indexes for table `tblrental`
--
ALTER TABLE `tblrental`
  ADD PRIMARY KEY (`rentalCode`);

--
-- Indexes for table `tblrentaldetail`
--
ALTER TABLE `tblrentaldetail`
  ADD PRIMARY KEY (`rentalCode`,`inventoryCode`);

--
-- Indexes for table `tblrentalinvoice`
--
ALTER TABLE `tblrentalinvoice`
  ADD PRIMARY KEY (`invoiceCode`,`rentalCode`),
  ADD KEY `fk_RentalInvoice_rentalCode_idx` (`rentalCode`),
  ADD KEY `fk_RentalInvoice_deliveryCode_idx` (`deliveryCode`);

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
  ADD KEY `fk_RentalPackageDetail_itemCode_idx` (`itemCode`);

--
-- Indexes for table `tbluom`
--
ALTER TABLE `tbluom`
  ADD PRIMARY KEY (`uomCode`);

--
-- Indexes for table `tblwaiterratio`
--
ALTER TABLE `tblwaiterratio`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
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
  ADD CONSTRAINT `fk_PackageItem_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblitem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblCateringPackageMenu`
--
ALTER TABLE `tblCateringPackageMenu`
  ADD CONSTRAINT `fk_PackageMenu_menuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblmenu` (`menuCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tbldish`
--
ALTER TABLE `tbldish`
  ADD CONSTRAINT `fk_Dish_dishTypeCode` FOREIGN KEY (`dishTypeCode`) REFERENCES `tbldishtype` (`dishTypeCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblevent`
--
ALTER TABLE `tblevent`
  ADD CONSTRAINT `fk_Event_customerCode` FOREIGN KEY (`customerCode`) REFERENCES `tblcustomer` (`customerCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Event_waiterRatioCode` FOREIGN KEY (`waiterRatioCode`) REFERENCES `tblwaiterratio` (`waiterRatioCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tbleventdecor`
--
ALTER TABLE `tbleventdecor`
  ADD CONSTRAINT `fk_EventDecor_decorCode` FOREIGN KEY (`decorCode`) REFERENCES `tbldecor` (`decorCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_EventDecor_eventCode` FOREIGN KEY (`eventCode`) REFERENCES `tblevent` (`eventCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tbleventtypes`
--
ALTER TABLE `tbleventtypes`
  ADD CONSTRAINT `fk_EventTypes_eventCode` FOREIGN KEY (`eventCode`) REFERENCES `tblevent` (`eventCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_EventTypes_eventTypeCode` FOREIGN KEY (`eventTypeCode`) REFERENCES `tbleventtype` (`eventTypeCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblinventory`
--
ALTER TABLE `tblinventory`
  ADD CONSTRAINT `fk_Inventory_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblitem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblinventorydeficiency`
--
ALTER TABLE `tblinventorydeficiency`
  ADD CONSTRAINT `fk_InventoryDeficiency_inventoryCode` FOREIGN KEY (`inventoryCode`) REFERENCES `tblinventory` (`inventoryCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblinventoryrelease`
--
ALTER TABLE `tblinventoryrelease`
  ADD CONSTRAINT `fk_InventoryRelease_inventoryCode` FOREIGN KEY (`inventoryCode`) REFERENCES `tblinventory` (`inventoryCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblinventorystock`
--
ALTER TABLE `tblinventorystock`
  ADD CONSTRAINT `fk_InventoryStock_inventoryCode` FOREIGN KEY (`inventoryCode`) REFERENCES `tblinventory` (`inventoryCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  ADD CONSTRAINT `fk_Invoice_customerCode` FOREIGN KEY (`customerCode`) REFERENCES `tblcustomer` (`customerCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblitem`
--
ALTER TABLE `tblitem`
  ADD CONSTRAINT `fk_Item_uomCode` FOREIGN KEY (`uomCode`) REFERENCES `tbluom` (`uomCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblitemdinnerware`
--
ALTER TABLE `tblitemdinnerware`
  ADD CONSTRAINT `fk_ItemDinnerware_dinnerwareTypeCode` FOREIGN KEY (`dinnerwareTypeCode`) REFERENCES `tbldinnerwaretype` (`dinnerwareTypeCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ItemDinnerware_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblitem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblitemequipment`
--
ALTER TABLE `tblitemequipment`
  ADD CONSTRAINT `fk_ItemEquipment_equipmentTypeCode` FOREIGN KEY (`equipmentTypeCode`) REFERENCES `tblequipmenttype` (`equipmentTypeCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ItemEquipment_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblitem` (`itemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblmenubuffet`
--
ALTER TABLE `tblmenubuffet`
  ADD CONSTRAINT `fk_MenuBuffet_menuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblmenu` (`menuCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_MenuBuffet_quantityRatioCode` FOREIGN KEY (`quantityRatioCode`) REFERENCES `tblquantityratio` (`quantityRatioCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblmenudetail`
--
ALTER TABLE `tblmenudetail`
  ADD CONSTRAINT `fk_MenuDetail_dishCode` FOREIGN KEY (`dishCode`) REFERENCES `tbldish` (`dishCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_MenuDetail_menuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblmenu` (`menuCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblmenuset`
--
ALTER TABLE `tblmenuset`
  ADD CONSTRAINT `fk_MenuSet_menuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblmenu` (`menuCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblorderdetail`
--
ALTER TABLE `tblorderdetail`
  ADD CONSTRAINT `fk_OrderDetail_MenuCode` FOREIGN KEY (`menuCode`) REFERENCES `tblmenu` (`menuCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_OrderDetail_OrderCode` FOREIGN KEY (`orderCode`) REFERENCES `tblorder` (`orderCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblorderinvoice`
--
ALTER TABLE `tblorderinvoice`
  ADD CONSTRAINT `fk_OrderInvoice_deliveryCode` FOREIGN KEY (`deliveryCode`) REFERENCES `tbldelivery` (`deliveryCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_OrderInvoice_invoiceCode` FOREIGN KEY (`invoiceCode`) REFERENCES `tblinvoice` (`invoiceCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_OrderInvoice_orderCode` FOREIGN KEY (`orderCode`) REFERENCES `tblorder` (`orderCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD CONSTRAINT `fk_Payment_customerCode` FOREIGN KEY (`customerCode`) REFERENCES `tblcustomer` (`customerCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblpaymentdetail`
--
ALTER TABLE `tblpaymentdetail`
  ADD CONSTRAINT `fk_PaymentDetail_invoiceCode` FOREIGN KEY (`invoiceCode`) REFERENCES `tblinvoice` (`invoiceCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_PaymentDetail_paymentCode` FOREIGN KEY (`paymentCode`) REFERENCES `tblpayment` (`paymentCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblpenaltyother`
--
ALTER TABLE `tblpenaltyother`
  ADD CONSTRAINT `fk_PenaltyOther_penaltyCode` FOREIGN KEY (`penaltyCode`) REFERENCES `tblpenalty` (`penaltyCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblrentalinvoice`
--
ALTER TABLE `tblrentalinvoice`
  ADD CONSTRAINT `fk_RentalInvoice_deliveryCode` FOREIGN KEY (`deliveryCode`) REFERENCES `tbldelivery` (`deliveryCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_RentalInvoice_invoiceCode` FOREIGN KEY (`invoiceCode`) REFERENCES `tblinvoice` (`invoiceCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_RentalInvoice_rentalCode` FOREIGN KEY (`rentalCode`) REFERENCES `tblrental` (`rentalCode`) ON UPDATE CASCADE;

--
-- Constraints for table `tblRentalPackageDetail`
--
ALTER TABLE `tblRentalPackageDetail`
  ADD CONSTRAINT `fk_RentalPackageDetail_itemCode` FOREIGN KEY (`itemCode`) REFERENCES `tblitem` (`itemCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_RentalPackageDetail_rentalPackageCode` FOREIGN KEY (`rentalPackageCode`) REFERENCES `tblRentalPackage` (`rentalPackageCode`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
