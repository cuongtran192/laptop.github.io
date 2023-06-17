-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 02:44 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `usernames` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `usernames`, `password`) VALUES
(1, 'admin', '1'),
(2, 'c', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Laptop Asus', NULL),
(2, 'Laptop Acer', NULL),
(3, 'Laptop Msi', NULL),
(4, 'Laptop Gigabyte', NULL),
(5, 'Tai Nghe', NULL),
(6, 'Chuột', NULL),
(7, 'Bàn Phím', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(11,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `diachi` varchar(255) DEFAULT NULL,
  `ten` varchar(255) DEFAULT NULL,
  `sdt` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Chưa xác định'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `order_date`, `diachi`, `ten`, `sdt`, `status`) VALUES
(10, 7, '53537000.00', '2023-05-19 08:23:42', '174 Triều Khúc, Thanh Xuân, Hà Nội', 'Trần Đức Cường', '0971433911', 'canceled'),
(12, 7, '1599000.00', '2023-05-20 10:56:09', 'Thái Bình', 'cường', '0971433911', 'shipping'),
(13, 7, '20900000.00', '2023-05-20 10:57:11', 'Hải Phòng', 'Linh Linh', '0987654321', 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(23, 10, 46, 1, '45900000.00'),
(24, 10, 66, 1, '1499000.00'),
(25, 10, 63, 1, '1590000.00'),
(26, 10, 52, 1, '3499000.00'),
(27, 10, 75, 1, '1049000.00'),
(30, 12, 61, 1, '1599000.00'),
(31, 13, 41, 1, '20900000.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(11,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `image`) VALUES
(11, 'LAPTOP ASUS ZENBOOK UX8402VU-P1028W (I9 13900H/32GB RAM/1TB SSD/14.5 2.8K', 'CPU: Intel® Core™ i9-13900H (24MB Cache, up to 5.4 GHz) \r\nRAM: 16GB LPDDR5 on board,\r\nỔ cứng: 1TB M.2 NVMe™ PCIe® 4.0,\r\nVGA: NVIDIA® Geforce RTX™ 4050 Laptop GPU 6GB GDDR6,\r\nMàn hình: 14.5\"2.8K OLED(2880 x 1800) 16:10,120Hz, 400nits, 100% DCI-P3,Touch', '69000000.00', 1, 'asus1.jpg'),
(12, 'LAPTOP ASUS GAMING TUF FX517ZC-HN079W (I5 12450H/8GB RAM/512GB SSD/15.6 FHD', 'CPU: Intel core i5 12450H\r\nRAM: 8GB\r\nỔ cứng: 512GB SSD\r\nVGA: NVIDIA RTX 3050 4GB\r\nMàn hình: 15.6 FHD 144hz\r\nHĐH: Win 11\r\nMàu: Trắng', '25499000.00', 1, 'asus2.png'),
(13, 'LAPTOP ASUS GAMING ROG STRIX G614JI-N4084W (I7 13650HX/16GB RAM/1TB SSD', 'CPU: Intel® Core™ i7-13650HX 2.6 GHz (24M Cache, up to 4.9 GHz)\r\nRAM: 16GB (2*8GB) DDR5-4800 SO-DIMM\r\nỔ cứng: 1TB PCIe® 4.0 NVMe™ M.2 SSD\r\nVGA: NVIDIA® GeForce RTX™ 4070 8GB GDDR6\r\nMàn hình: QHD+ 16:10 (2560 x 1600, WQXGA)240Hz IPS-level 500nits 100% DCI-', '55990000.00', 1, 'asus3.png'),
(14, 'LAPTOP ASUS GAMING TUF FA507NV-LP046W (R7 7735HS/8GB RAM/512GB SSD/15.6 FHD', 'CPU: Ryzen 7-7735HS\r\nRAM: 8GB (2 khe, tối đa 32GB)\r\nỔ cứng: 512GB M.2 NVMe\r\nVGA: NVIDIA GeForce RTX 4060 8GB GDDR6\r\nMàn hình: 15.6-inch FHD (1920 x 1080) 16:9, 144Hz, FHD 144Hz 100% sRGB\r\nMàu: Gray\r\nOS: Windows 11 Home', '32990000.00', 1, 'asus4.png'),
(15, 'LAPTOP ASUS GAMING ROG STRIX G513IC-HN729W (R7 4800H/8GB RAM/512GB SSD/15.6', 'CPU: AMD R7 4800H\r\nRAM: 8GB\r\nỔ cứng: 512GB SSD\r\nVGA: Nvidia RTX 3050 4GB\r\nMàn hình: 15.6 FHD 144Hz\r\nBàn phím: led RGB\r\nHĐH: Win 11\r\nMàu: Xám', '19990000.00', 1, 'asus5.png'),
(16, 'LAPTOP ASUS GAMING TUF FX506LHB-HN188W (I5 10300H/8GB RAM/512GB SSD/15.6', 'CPU: Intel® Core™ i5-10300H 2.5 GHZ\r\nRAM: 8GB DDR4 SO-DIMM 2933MHz\r\nỔ cứng: 512GB M.2 NVMe™ PCIe® 3.0 SSD\r\nVGA: NVIDIA GTX 1650 4GB\r\nMàn hình: 15.6-inch, FHD (1920 x 1080) 144hz, 16:9,NTSC: 45%, Độ sáng :250nits\r\n', '16990000.00', 1, 'asus6.jpeg'),
(17, 'Asus ROG Strix G15 G513QR-ES96 (Ryzen 9-5900HX, 16GB, 1TB, RTX 3070, 15.6\" FHD 300Hz)', 'CPU: Ryzen 9 - 5900HX \r\nGPU: RTX 3070 8GB\r\nRAM: 16GB DDR4 3200Mhz\r\nSSD: 1TB\r\nMàn hình: 15.6\" FHD IPS 300Hz ', '40990000.00', 1, 'asus7.png'),
(18, 'LAPTOP ASUS GAMING ROG STRIX G614JU-N3777W (I7 13650HX/16GB RAM/512GB SSD/16', 'CPU: Intel® Core™ i9-13900H 2.6 GHz (24M Cache, up to 5.4 GHz)\r\nRAM: 16GB DDR5-4800 SO-DIMM\r\nỔ cứng: 1TB PCIe® 4.0 NVMe™ M.2 SSD\r\nVGA: NVIDIA® GeForce RTX™ 4060 8GB GDDR6\r\nMàn hình: 16-inch WQXGA 16:10(2560 x 1600) Mini LED 100% DCI-P3 Touch 240Hz\r\nTính n', '59990000.00', 1, 'asus8.png'),
(19, 'LAPTOP ASUS GAMING ZEPHYRUS FLOW GZ301ZE-LD6688W (I9 12900H/16GB RAM/1TB', 'CPU: Intel Core i9 12900H\r\nRAM: 16GB RAM onboard\r\nỔ cứng: 1TB SSD\r\nVGA: Nvidia RTX 3050Ti 4GB\r\nMàn hình: 13.4 WUXGA Touch\r\nHĐH: Win 11\r\nMàu: Đen\r\nPhụ kiện: Túi, bút', '53990000.00', 1, 'asus9.png'),
(21, 'LAPTOP ACER GAMING PREDATOR HELIOS 18 PH18-71-94SJ (NH.QKRSV.002) (I9', 'CPU: Intel Core i9-13900HX (upto 5.40 GHz, 36MB)\r\nRAM: 32GB(2*16GB) khe rời DDR5 5600MHz (2 khe, Nâng cấp tối đa 32GB)\r\nỔ cứng: 2TB PCIe NVMe (RAID mode)\r\nVGA: NVIDIA GeForce RTX 4080 12GB\r\nMàn hình: 18 inch WQXGA 240Hz DCI-P3 100%, LED-backlit TFT LCD', '126990000.00', 2, 'acer1.png'),
(22, 'LAPTOP ACER GAMING PREDATOR TRITON 500 SE PT516-52S-91XH (NH.QFRSV.001)', 'CPU: Intel core i9 12900H\r\nRAM: 32GB\r\nỔ cứng: 2TB SSD\r\nVGA: Nvidia RTX 3080Ti 16G\r\nMàn hình: 16 inch WQXGA 240Hz\r\nHĐH: Win11\r\nMàu: Xám', '108490000.00', 2, 'acer2.png'),
(23, 'LAPTOP ACER GAMING PREDATOR HELIOS 300 PH315-55-751D (NH.QFTSV.002)', 'CPU: Intel Core i7-12700H (14 nhân, 20 luồng, 3.5GHz upto 4.7GHz, 24MB)\r\nRAM: 16GB (2x 8GB khe rời) DDR5 4800MHz\r\nỔ cứng: 512GB PCIe NVMe SSD\r\nVGA: NVIDIA GeForce RTX 3070Ti 8GB GDDR', '57499000.00', 2, 'acer3.png'),
(24, 'LAPTOP ACER GAMING NITRO 5 AN515-58-957R (NH.QHYSV.006) (I9 12900H/16GB', 'CPU: Intel® Core™ i9 12900H (upto 5 GHz, 24MB)\r\nRAM: 16GB khe rời DDR4 3200MHz (2 khe, tối đa 32GB)\r\nỔ cứng: 512GB PCIe NVMe\r\nVGA: NVIDIA® GeForce RTX3060 6G\r\nMàn hình: 15.6 inch FHD(1920 x 1080) IPS 165Hz', '37499000.00', 2, 'acer4.jpeg'),
(25, 'LAPTOP ACER GAMING NITRO 5 AN515-57-71VV (NH.QENSV.005) (I7 11800H/8GB', 'CPU: Intel core i7 11800H\r\nRAM: 8GB\r\nỔ cứng: 512GB SSD\r\nVGA: NVIDIA RTX3050 4G\r\nMàn hình: 15.6 inch FHD 144Hz\r\nBàn phím: có led\r\nHĐH: Win 11\r\nMàu: Đen', '22990000.00', 2, 'acer5.png'),
(27, 'LAPTOP ACER SWIFT 3 EVO SF314-512-741L (NX.K7JSV.001) (I7-1260P/16GB RAM/1TB', 'CPU: Intel® Core™ i7-1260\r\nRAM: 16GB (không nâng cấp được)\r\nỔ cứng: 1TB PCIe NVMe\r\nVGA: Intel® Iris® Xe Graphics\r\nMàn hình: 14 inch QHD (2560 x 1440) IPS , 60Hz\r\nMàu sắc: Gold\r\nOS: Windows 11 Home', '30199000.00', 2, 'acer7.png'),
(28, 'LAPTOP ACER SWIFT 3 SF314-511-55QE CHUẨN INTEL EVO (NX.ABNSV.003) ', 'CPU: Intel Core i5-1135G7\r\nRAM: 16GB\r\nỔ cứng: 512GB SSD\r\nVGA: Onboard\r\nMàn hình: 14.0 inch FHD IPS 100% sRGB\r\nHĐH: Win10\r\nMàu: Bạc', '17699000.00', 2, 'acer8.png'),
(31, 'LAPTOP MSI GAMING KATANA 15 (B13VFK-676VN) (I7 13620H/16GB/1TB SSD/RTX4060', 'CPU: Intel® Core™ i7 13620H 3.6 GHz (24M Cache, up to 4.9 GHz)\r\nRAM: 16GB DDR5-5200 SO-DIMM\r\nỔ cứng: 1TB PCIe® 4.0 NVMe™ M.2 SSD\r\nVGA: NVIDIA® GeForce RTX4060 8GB\r\nMàn hình: 15.6\" FHD (1920x1080), 144Hz, IPS-Level\r\nTính năng: Đèn nền bàn phím led RGB 4 vù', '36990000.00', 3, 'msi1.png'),
(32, 'LAPTOP MSI CREATOR M16 (B13VE-830VN) (I7 13700H 16GB RAM/512GB SSD/RTX4050', 'CPU: Intel Core i7-13700H (Up to 5.00 GHz, 24 MB)\r\nRAM: 16GB (2 khe)\r\nỔ cứng: 512GB NVMe PCIe SSD\r\nVGA: NVIDIA® GeForce RTX 4050 6GB GDDR6\r\nMàn hình: 16 inch FHD+ (1920x1200), IPS-Level, 144Hz\r\nTính năng: Đèn bàn phím\r\nMàu sắc: Đen\r\nOS: Windows 11 Home\r\n', '38790000.00', 3, 'msi2.png'),
(33, 'LAPTOP MSI GAMING CYBORG 15 (A12VE-240VN) (I7 12650H/8GB/512GB SSD/RTX4050', 'CPU: Intel® Core™ i7 12650H 3.5 GHz (24M Cache, up to 4.7 GHz)\r\nRAM: 8GB DDR5-4800 SO-DIMM\r\nỔ cứng: 512GB PCIe® 4.0 NVMe™ M.2 SSD\r\nVGA: NVIDIA® GeForce RTX4050 8GB\r\nMàn hình: 15.6\" FHD (1920x1080), 144Hz, IPS-Level\r\nTính năng: Đèn nền bàn phím led RGB 4 v', '27489000.00', 3, 'msi3.png'),
(34, 'LAPTOP MSI GAMING KATANA GF66 (11UE-824VN) (I7 11800H 16GB RAM/512GB', 'CPU: Intel® Core™ i7-11800H (Up to 4.60 GHz, 24 MB)\r\nRAM: 16GB DDR4-3200Mhz (2 khe, tối đa 64GB)\r\nỔ cứng: 512GB NVMe PCIe Gen3 SSD\r\nVGA: NVIDIA® GeForce RTX™ 3060 6GB GDDR6\r\nMàn hình: 15.6 inch FHD (1920x1080), 144Hz, IPS-Level\r\nMàu: Đen', '26599000.00', 3, 'msi4.png'),
(35, 'LAPTOP MSI GAMING STEALTH 14 STUDIO (A13VF-051VN) (I7-13700H/16GB RAM/1TB', 'CPU: Intel® Core™ i7 13700H 3.7 GHz (24M Cache, up to 5.0 GHz)\r\nRAM: 16GB DDR5-5200 SO-DIMM\r\nỔ cứng: 1TB PCIe® 4.0 NVMe™ M.2 SSD\r\nVGA: NVIDIA® GeForce RTX4060 8GB\r\nMàn hình: 14” QHD+ (2560x1600), 240Hz, IPS-Level\r\nTính năng: Đèn nền bàn phím led RGB từng ', '54890000.00', 3, 'msi5.png'),
(36, 'LAPTOP MSI GAMING GE67 HX RAIDER (12UGS-097VN) (I9 12900HX/32GB RAM/ 1TB', 'CPU: Intel Core i9 12900HX\r\nRAM: 32GB\r\nỔ cứng: 1TB SSD\r\nVGA: NVIDIA RTX3070Ti 8G\r\nMàn hình: 15.6 inch OLED QHD 240Hz\r\nBàn phím: có đèn led\r\nHĐH: Win 11\r\nMàu: Xám', '61000000.00', 3, 'msi6.jpg'),
(41, 'LAPTOP GIGABYTE GAMING G5 (GE- 51VN213SH) (I5 12500H /16GB RAM/512GB', 'CPU: Intel Core i5-12500H (upto 4.50GHz, 18MB)\r\nRAM: 16GB(8GBx2)DDR4 3200Mhz (2 khe, Nâng cấp tối đa 64GB)\r\nỔ cứng: 512GB SSD PCIe Gen3x4 Slot\r\nVGA: NVidia Geforce RTX 3050 4GB GDDR6\r\nMàn hình: 15.6 inch FHD (1920x1080) 144hz IPS-level Anti-glare', '20900000.00', 4, 'gg1.png'),
(42, 'LAPTOP GIGABYTE G5 (GD-51S1123SO/VN123SO) (I5 11400H/16GB/512GB', 'CPU: Intel i5 11400H (2.7Ghz, upto 4.5Ghz)\r\nRAM: 16GB DDR4 3200Mhz (8GB * 2)\r\nỔ cứng: 512GB SSD PCIe NVMe SSD Gen 4\r\nVGA: NVIDIA® GeForce® RTX 3050 4G-GDDR6\r\nMàn hình: 15.6\" Thin Bezel FHD 1920x1080 IPS, Anti-glare LCD (144Hz, 72% NTSC)\r\nBàn phím: có đèn ', '18400000.00', 4, 'gg2.png'),
(43, 'LAPTOP GIGABYTE GAMING AORUS 17 (XE5-73VN534GH) (I7 12700H /16GB RAM/1TB', 'CPU: Intel Core i7-12700H (2.30Ghz ~ 4.70Ghz)\r\nRAM: 16GB(8GBx2)DDR5 4800Mz max 64GB ( 2 khe )\r\nỔ cứng: 1TB PCIe NVMe SSD Gen 4,2x M.2 SSD slots (Type 2280, supports 2x NVMe PCIe Gen4)\r\nVGA: Nvidia GeForce RTX3070Ti 8G- GDDR6\r\nMàn hình: 17.3 inch FHD (1920', '54990000.00', 4, 'gg3.png'),
(44, 'LAPTOP GIGABYTE GAMING AORUS 15 (XE4-73VNB14GH) (I7 12700H /16GBRAM/1TB', 'CPU: Intel Core i7 12700H\r\nRAM: 16GB\r\nỔ cứng: 1TB SSD\r\nVGA: NVIDIA RTX3070Ti 8G\r\nMàn hình: 15.6 inch QHD 165Hz\r\nBàn phím: có đèn led\r\nHĐH: Win 11\r\nMàu: Đen', '47499000.00', 4, 'gg4.png'),
(45, 'LAPTOP GIGABYTE U4 (UD-50S1823SO) (I5 1155G7/16GB RAM/512GB SSD/14.0INCH', 'CPU: Intel Core i5 1155G7\r\nRAM: 16GB\r\nỔ cứng: 512GB SSD\r\nVGA: Onboard\r\nMàn hình: 14 inch FHD\r\nHĐH: Win 11\r\nMàu: Bạc', '16900000.00', 4, 'gg5.jpeg'),
(46, 'LAPTOP GIGABYTE GAMING AERO 16 (XE5-73VN938AH) (I7 12700H /16GBRAM/2TB', 'CPU: Intel Core i7 12700H\r\nRAM: 16GB\r\nỔ cứng: 2TB SSD\r\nVGA: Nvidia RTX3070Ti 8G\r\nMàn hình: 16.0 inch UHD+ AMOLED\r\nHĐH: Win 11\r\nMàu: Bạc', '45900000.00', 4, 'gg6.jpg'),
(51, 'TAI NGHE KHÔNG DÂY RAZER BARRACUDA QUARTZ RZ04-03790300-R3M1', 'Công nghệ RazerSmartSwitch Dual Wireless\r\nTích hợp Mic khử tiếng ồn Beamforming\r\nDriver Razer TriForce Titanium 50mm\r\nĐệm tai bằng mút hoạt tính Flowknit siêu mềm\r\nỨng dụng âm thanh Razer\r\nThời lượng pin 40 giờ với Sạc USB-C', '3699000.00', 5, 't1.jpg'),
(52, 'TAI NGHE HP HYPERX CLOUD II WIRELESS 4P5K4AA', 'Tai nghe HP HyperX Cloud II Wireless\r\nChuẩn kết nối: Không dây Wireless 2.4Ghz\r\nMàng loa 53mm cho âm thanh sống động\r\nÂm thanh vòm 7.1 tích hợp\r\nMicro khử ồn có thể tháo rời\r\nTính năng theo dõi mic được tích hợp', '3499000.00', 5, 't2.jpg'),
(53, 'TAI NGHE KHÔNG DÂY CORSAIR HS80 RGB WHITE CA-9011236-AP', 'Tai nghe không dây Corsair HS80 LED RGB Wireless\r\nDriver Neodymium 50mm cho chất lượng âm thanh cao cấp\r\nChuẩn kết nối: SlipStream Wireless 2.4Ghz độ trễ cực thấp\r\nTích hợp công nghệ âm thanh Dolby Atmos\r\nMicro đa hướng có thể gập để tắt mic\r\nLed RGB', '3399000.00', 5, 't3.jpg'),
(54, 'TAI NGHE KHÔNG DÂY RAZER KAIRA PRO FOR XBOX SERIES X/S-HALO INFINITE EDITION_RZ04-03470200-R3M1', 'Tai nghe không dây Razer Kaira Pro for Xbox Series X/S-HALO Infinite Edition\r\nPhiên bản Limited kết hợp cùng tựa game HALO Infinite của Microsoft\r\nChuẩn kết nối: Wireless 2.4Ghz / Bluetooth 5.0\r\nRazer™ TriForce 50mm Drivers mang lại chất âm chi tiết\r\nRaze', '3399000.00', 5, 't4.jpg'),
(55, 'TAI NGHE CHƠI GAME KHÔNG DÂY LOGITECH G735 MÀU TRẮNG (WIRELESS/BLUETOOTH 5.2)', 'Tai nghe chơi game không dây Logitech G735\r\nTai nghe thuộc dòng sản phẩm Aurora cao cấp mới của Logitech\r\nChuẩn kết nối: Wireless Lightspeed 2.4Ghz / Bluetooth 5.2 (phạm vi hoạt động lên đến 20m)\r\nDriver 40 mm\r\nThời lượng pin lên đến trên 16 giờ chơi game', '3999000.00', 5, 't5.jpg'),
(56, 'TAI NGHE KHÔNG DÂY CORSAIR HS80 LED RGB WIRELESS - CA-9011235-AP', 'ai nghe không dây Corsair HS80 LED RGB Wireless\r\nDriver Neodymium 50mm cho chất lượng âm thanh cao cấp\r\nChuẩn kết nối: SlipStream Wireless 2.4Ghz độ trễ cực thấp\r\nTích hợp công nghệ âm thanh Dolby Atmos\r\nMicro đa hướng có thể gập để tắt mic\r\nLed RGB', '3599000.00', 5, 't6.jpg'),
(57, 'TAI NGHE RAZER KRAKEN KITTY CHROMA QUARTZ RZ04-02980200-R3M1', 'Tai nghe Razer Kraken Kitty Chroma\r\nThiết kế tai mèo độc đáo\r\nLed RGB Chroma 16.8 triệu màu, bao gồm cả phần tai mèo\r\nCó thể cắm vào nguồn điện sạc dự phòng để hiện led mà không cần cắm vào PC\r\nMicro với tính năng lọc ồn\r\nCông nghệ THX Spatial Audio', '3799000.00', 5, 't7.png'),
(58, 'TAI NGHE KHÔNG DÂY SONY WF-1000XM3BME ĐEN', 'Tai nghe không dây Sony WF-1000XM3\r\nCông nghệ chống ồn kỹ thuật số kết hợp với Bộ xử lý chống ồn HD QN1e và Công nghệ cảm biến tiếng ồn kép\r\nThiết kế không dây đích thực với công nghệ không dây BLUETOOTH®\r\nThời lượng pin tối đa 24 giờ4 để nghe cả ngày\r\nCh', '3369000.00', 5, 't8.jpg'),
(61, 'CHUỘT GAME KHÔNG DÂY CORSAIR IRONCLAW RGB WIRELESS (CH-9317011-AP)', 'Chuột game không dây Corsair Ironclaw RGB Wireless\r\nChuẩn kết nối: SlipStream Wireless 2.4Ghz / Bluetooth / Dây USB\r\nThiết kế form Ergonomic phù hợp dành cho người có bàn tay lớn\r\nMắt cảm biến PMW3391\r\nĐộ phân giải: 18000 DPI\r\nSwitch bấm Omron độ bền 50 t', '1599000.00', 6, 'c1.jpg'),
(62, 'CHUỘT CHƠI GAME LOGITECH G703 HERO LIGHTSPEED WIRELESS GAMING', 'Chuột Logitech G703 LIGHTSPEED WIRELESS GAMING HERO\r\nLà phiên bản nâng cấp của chú chuột G703 Lightspeed trước đây\r\nMắt cảm biến Hero cho hiệu năng vượt trội\r\nĐộ phân giải : 16000 DPI\r\nKết nối không dây công nghệ Lightspeed cho khả năng truyền tín hiệu kh', '1699000.00', 6, 'c2.jpg'),
(63, 'CHUỘT GAME LOGITECH G604 HERO LIGHTSPEED (USB/ĐEN)', 'huột Logitech G604 Lightspeed Wireless\r\nMắt cảm biến Hero 16K cao cấp nhất của Logitech\r\nKế thừa thiết kế của chú chuột Logitech G602 trước đây\r\nNút cuộn với 2 chế độ siêu nhanh\r\n11 nút có thể lập trình được với 15 chế độ khác nhau\r\nKết nối không dây hoàn', '1590000.00', 6, 'c3.jpg'),
(64, 'CHUỘT KHÔNG DÂY RAZER OROCHI V2 (USB/BLUETOOTH) (RZ01-03730100-R3A1)', 'Chuột không dây Razer Orochi V2\r\nThiết kế siêu gọn nhẹ với trọng lượng chưa đến 60g\r\nMắt cảm biến Razer 5G cao cấp\r\nSử dụng Switch Razer thế hệ thứ 2 cho cảm giác nhấn tốt và độ bền cực cao\r\nChuẩn kết nối: Wireless HyperSpeed / Bluetooth\r\nThời lượng sử dụ', '1399000.00', 6, 'c4.jpg'),
(65, 'CHUỘT CHƠI GAME KHÔNG DÂY CORSAIR HARPOON RGB WIRELESS (CH-9311011-AP)', 'Chuột chơi game Corsair Harpoon RGB Wireless\r\nCông nghệ không day SlipStream, độ trễ 1ms\r\n6 nút bấm có thể lập trình\r\nĐèn led RGB tùy chỉnh hiệu ứng theo ý muốn\r\nMắt đọc Pixart 3325 cho độ chính xác cao\r\nDPI : 10000DPI', '1199000.00', 6, 'c5.jpg'),
(66, 'CHUỘT CORSAIR M65 RGB ULTRA BLACK (CH-9309411-AP2)', 'Thiết kế iconic\r\nCông nghệ quickstrike\r\nCông nghệ làm nhanh corsair\r\nCông tắc quang học omron\r\nCảm biến marksman corsair\r\nĐiều chỉnh cân nặng hợp lý', '1499000.00', 6, 'c6.jpg'),
(67, 'CHUỘT GAME KHÔNG DÂY LOGITECH G502 HERO LIGHTSPEED (USB/RGB/ĐEN) ', 'Chuột Chơi game Không dây Logitech G502 Lightspeed\r\nPhiên bản không dây của huyền thoại Logitech G502\r\nCông nghệ không dây Lightspeed với độ trễ cực thấp\r\nMắt đọc Hero 16K cho độ chính xác cực cao và tiết kiệm pin\r\nTương thích vơi bàn di chuột kèm sạc khô', '2299000.00', 6, 'c7.jpg'),
(71, 'BÀN PHÍM CƠ GAMING CORSAIR K70 MK2 LOW PROFILE CHERRY SPEED SWITCH (CH-9109018-NA)', 'Thiết kế switch Low-profile\r\nHành trình phím ngắn\r\nHiệu năng cao với switch đến từ Cherry\r\nĐược trang bị LED RGB 16.8 triệu màu\r\nTuỳ chỉnh bằng phần mềm iCUE', '1259000.00', 7, 'b1.jpg'),
(72, 'BÀN PHÍM CƠ LOGITECH G413 SE TKL TACTILE SW (USB/PBT)', 'Bàn phím cơ Logitech G413 TKl\r\nThiết kế Tenkeyless\r\nThiết kế hở chân switch với phần plate kim loại nhôm chắc chắc và sang trọng\r\nSử dụng Tactile switch (Switch bấm có khấc cảm nhận) được thiết kế bởi Logitech\r\nLed trắng\r\nKeycap Pbt bền bỉ', '1259000.00', 7, 'b2.jpg'),
(73, 'BÀN PHÍM CƠ KHÔNG DÂY LOGITECH G613 WIRELESS (USB)', 'Bàn phím chơi game không day Logitech : Logitech G613 Wireless\r\nSwitch Cơ học Romer-G\r\nKết nối không day LightSpeed\r\nTuổi thọ pin cao lên đến 18 tháng\r\nDãy phím Macro tiện dụng', '1699000.00', 7, 'b3.jpg'),
(74, 'BÀN PHÍM CƠ QUANG E-DRA EK308 RGB PLUS (USB/OPTICAL SWITCH/ĐEN)', 'Bàn phím cơ quang E-Dra EK308 RGB Plus\r\nPhiên bản nâng cấp, có thêm các phím Multimedia\r\nSwitch Quang học tiên tiến nhất\r\nLED RGB 16.8 triệu màu trên phím và viền\r\nĐi kèm kê tay', '1099000.00', 7, 'b4.jpg'),
(75, 'BÀN PHÍM KHÔNG DÂY NEWMEN GM610 RGB DUAL MODE BROWN SW (USB/BLUETOOTH)', 'LED hiệu ứng mạnh RGB backlit\r\nBluetooth 5.0: Kết nối nhanh, tiết kiệm pin và ổn định\r\nSwitch HotSwap dễ dàng DIY và bảo trì\r\nKeycap PBT siêu cứng siêu bền\r\nSwitch OUTEMU\r\nTặng kèm thêm bộ Keycap độc đáo', '1049000.00', 7, 'b5.jpg'),
(76, 'BÀN PHÍM CƠ KHÔNG DÂY EDRA EK384W V2 BLUE SW (USBC/PBT/BLUETOOTH/3MODE)', 'Bàn phím cơ không dây Edra EK384W V2\r\nLayout 84 nút gọn nhẹ\r\nChuẩn kết nối: Bluetooth / Wireless 2.4Ghz / Dây Type C\r\nKeycaps: PBT Dyesub JSA profile\r\nSwitch Gateron BLue\r\nTính năng Anti-Ghosting', '1299000.00', 7, 'b6.jpg'),
(110, 'LAPTOP ASUS ZENBOOK UP3404VA-KN039W (I7 1360P/16GB RAM/512GB SSD/14 OLED ', 'CPU: Intel Core I7-1360P (upto 5.0 GHz, 18MB)\r\nRAM: 16GB LPDDR5 on board\r\nỔ cứng: 512GB M.2 NVMe PCIe 4.0 SSD\r\nVGA: Intel Iris Plus Graphics\r\nMàn hình: 14\" OLED WQXGA+ (2880 x 1800),400 NITS ,DCI-P3:100%, 90Hz, Cảm ứng\r\nTính năng: Đèn nền bàn phím\r\nMàu sắ', '31000000.00', 1, 'asus10.png'),
(111, 'LAPTOP ASUS ZENBOOK UX325EA-KG656W (I5 1135G7/8GB RAM/512GB SSD/13.3', 'CPU: Intel Core i5 1135G7\r\nRAM: 8GB\r\nỔ cứng: 512GB SSD\r\nVGA: Onboard\r\nMàn hình: 13.3 FHD Oled\r\nBàn phím: có đèn led\r\nHĐH: Win 11\r\nMàu: Xám', '14990000.00', 1, 'asus11.jpg'),
(112, 'LAPTOP ASUS GAMING ZEPHYRUS DUO GX650RX-LO156W (R9 6900HX/16GB RAM/2TB', 'CPU: AMD Ryzen™ 9-6900HX (3.3GHz upto 4.9GHz, 16MB)\r\nRAM: 32GB(16GB x 2) DDR5-4800 SO-DIMM (2 khe, tối đa 64GB)\r\nỔ cứng: 1TB M.2 NVMe™ PCIe® 4.0 Performance SSD\r\nVGA: NVIDIA® GeForce RTX™ RTX 3080Ti 16GB\r\nMàn hình: 16-inch WQXGA (2560 x 1600) 16:10,', '128990000.00', 1, 'asus12.png'),
(113, 'LAPTOP ACER GAMING ASPIRE 7 A715-42G-R4XX (NH.QAYSV.008) (R5 5500U/8GB', 'CPU: AMD R5 5500U\r\nRAM: 8GB\r\nỔ cứng: 256GB SSD\r\nVGA: NVIDIA GTX1650 4G\r\nMàn hình: 15.6 inch FHD\r\nHĐH: Win 11\r\nMàu: Đen', '15499000.00', 2, 'acer6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `address`, `password`) VALUES
(7, 'cuongne', 'cuongtran01092000@gmail.com', '123456', 'dong quan', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
