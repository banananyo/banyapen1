-- phpMyAdmin SQL Dump
-- version 3.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2018 at 11:48 PM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dkhousec_banya`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sname` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`, `sname`, `number`, `icon`, `account_name`) VALUES
(3, 'ธนาคารกสิกรไทย', 'KB', '123-3213-321', 'KB.jpg', 'ตัวอย่างชื่อบัญชี');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `product_list` text NOT NULL,
  `address` text,
  `email` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `reciever_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `member_id`, `product_list`, `address`, `email`, `tel`, `reciever_name`) VALUES
(49, 19, '{"38":{"amount_purchase":1,"name":"diane-35  21''s","price":"152"}}', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `detail`) VALUES
(5, 'ยาคุมกำเนิดและฮอร์โมน', ''),
(6, 'Antibiotics - Antifungal - Antiviral', ''),
(7, 'ยาระบบทางเดินหายใจ', ''),
(8, 'ยาระบบทางเดินอาหารและลำไส้', ''),
(9, 'ยาระบบหัวใจและหลอดเลือด', ''),
(13, 'ยาระบบทางเดินปัสสาวะ', ''),
(15, 'ยาครีม - ยาสอด - ยาใช้ภายนอก', ''),
(36, 'ยาบรรเทาปวด ลดไข้  NSAIDs  (แบบแผง)', ''),
(37, 'ยาบรรเทาปวด ลดไข้  NSAIDs  (แบบกระปุก)', ''),
(38, 'ยาทาบรรเทาปวด ยาใช้ภายนอก', ''),
(39, 'ยาหู-ตา-คอ-จมูก', ''),
(40, 'แผ่นพลาสเตอร์บรรเทาปวด', ''),
(41, 'ยาดม - ยาหม่อง - สเปรย์ปรับอากาศ', ''),
(42, 'ยาถ่ายพยาธิ - ยาฆ่าเหา - ยากันยุง', ''),
(43, 'ผลิตภัณฑ์เสริมอาหาร-วิตามิน-เกลือแร่', ''),
(44, 'ซัพพอร์ตกล้ามเนื้อ - แผ่นพลาสเตอร์บรรเทาปวด', ''),
(45, 'ถุงยางอนามัย-ที่ตรวจตั้งครรภ์-ผ้าอนามัย', ''),
(46, 'ยาสมุนไพร-ยาโบราณ', ''),
(47, 'ยาสามัญประจำบ้าน', ''),
(48, 'ผลิตภัณฑ์บำรุงผิว เครื่องสำอาง เวชสำอาง', ''),
(49, 'อาหารทางการแพทย์ - นมผง', ''),
(50, 'ยาอม', ''),
(51, 'ยาฉีด', ''),
(52, 'ยาน้ำสำหรับเด็ก - ผู้ใหญ่', ''),
(53, 'อุปกรณ์ปฐมพยาบาล', ''),
(54, 'อุปกรณ์การแพทย์ - เครื่องมือแพทย์', ''),
(55, 'แผ่นรองซับ - ผ้าอ้อม - สำลี', ''),
(56, 'ผลิตภัณฑ์สำหรับแม่และเด็ก', ''),
(57, 'ผลิตภัณฑ์เพิ่มสมรรถภาพ', ''),
(58, 'ผลิตภัณฑ์ดูแลช่องปาก', ''),
(59, 'ผลิตภัณฑ์รักษาสิว', ''),
(60, 'ผลิตภัณฑ์บำรุงผมร่วง-ผมบาง', '');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `image`, `order`) VALUES
(6, 'Banner 1', '03012018153916.jpg', 1),
(7, 'Banner 2', '03012018153923.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `username`, `password`, `email`, `level`, `name`, `address`, `tel`, `facebook_token`, `image`, `status`, `key`) VALUES
(9, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'banyapen1@gmail.com', 1, 'แอดมิน บ้านยาเป็นหนึ่ง', 'ตัวอย่างที่อยู่', '123456789', NULL, '', 1, NULL),
(19, 'chanin', 'e10adc3949ba59abbe56e057f20f883e', 'chanin304@gmail.com', 1, 'ชนินทร์ ปิยะศิลป์', '2966/9 ถ.เดชอุดม', '0844094558', NULL, '', 1, NULL),
(20, 'jang', 'e10adc3949ba59abbe56e057f20f883e', 'phanthipha304@gmail.com', 1, 'พันทิพา เนื่อง ณ สุวรรณ', '2966/9 ถ.เดชอุดม', '0933907733', NULL, '', 1, NULL),
(21, '1993761373986565', '', 'wazjakorn@gmail.com', 1, 'wadjakorn tonsri', '111', '0819543611', '1993761373986565', '', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_ref` varchar(255) NOT NULL,
  `status` varchar(3) NOT NULL,
  `member_id` int(11) NOT NULL,
  `products` text NOT NULL,
  `order_datetime` datetime NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `ems` varchar(200) DEFAULT NULL,
  `info` text NOT NULL,
  `reciever_name` varchar(255) NOT NULL,
  `total_price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orders_ref`, `status`, `member_id`, `products`, `order_datetime`, `address`, `email`, `tel`, `ems`, `info`, `reciever_name`, `total_price`) VALUES
(66, 'BL-20181111-0000', 'SHP', 21, '{"38":{"amount_purchase":1,"name":"diane-35  21''s","price":"152"}}', '2018-11-11 00:15:12', '111', 'wazjakorn@gmail.com', '0819543611', 'zxcasd', '', 'wadjakorn tonsri', 152),
(67, 'BL-20181111-0001', 'SHP', 21, '{"42":{"amount_purchase":3,"name":"Marvelon 28''s","price":"76"}}', '2018-11-11 01:25:42', '111', 'wazjakorn@gmail.com', '0819543611', 'xxxxxxx', 'OK', 'wadjakorn tonsri', 228);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hint` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`, `hint`, `data`, `update_time`) VALUES
(1, 'PAGE_INDEX', 'หน้าแรก', '<p style="text-align:center"><strong>บ้านยาเป็นหนึ่ง</strong></p>\r\n', '2018-11-09 11:27:42'),
(2, 'PAGE_ABOUT', 'เกี่ยวกับเรา', '<p style="text-align:center">&nbsp;</p>\r\n\r\n<p><span style="font-family:Verdana,Geneva,sans-serif"><strong><u>จัดส่งสินค้าทุกวัน โดยขนส่งเอกชน NIM EXPRESS เป็นหลัก</u>&nbsp; &nbsp; &nbsp;<span style="font-size:26px"><span style="color:#3300ff"> [ยาน้ำ เราก็ส่ง]</span></span></strong></span></p>\r\n\r\n<ul>\r\n	<li><span style="font-family:Verdana,Geneva,sans-serif"><span style="color:#e74c3c"><strong>ภาคอีสาน&nbsp; 5,000 บ. จัดส่งฟรี</strong></span></span></li>\r\n	<li><span style="font-family:Verdana,Geneva,sans-serif"><span style="color:#e74c3c"><strong>ภาคอื่นๆ&nbsp; 10,000 บ. จัดส่งฟรี</strong></span></span></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:12px"><span style="font-family:Verdana,Geneva,sans-serif">(ยาน้ำ สำลี สินค้าขนาดใหญ่หรือมีน้ำหนักมาก ทางร้านจัดส่งฟรีตามสัดส่วนที่เหมาะสมกับยอดซื้อ กรณีที่มีค่าขนส่งเพิ่มเติมจะแจ้งลูกค้าก่อนจัดสินค้าทุกครั้ง)</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="color:#e74c3c"><span style="font-family:Verdana,Geneva,sans-serif"><strong>แจ้งโอนเงินก่อนจัดส่งสินค้าเท่านั้น!!</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-family:Verdana,Geneva,sans-serif"><strong><u>รอบจัดส่งสินค้าเวลา 16.00 น. ของทุกวัน</u>&nbsp; &nbsp;&nbsp;</strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-family:Verdana,Geneva,sans-serif">(สั่งสินค้าโดยเผื่อระยะเวลาจัดของ , แจ้งยอด ให้พนักงานด้วยค่ะ)</span></p>\r\n\r\n<p><span style="font-family:Verdana,Geneva,sans-serif">ระยะเวลาในการจัดส่ง 1-2วันทำการ โดยส่วนใหญ่ได้รับของในวันถัดไป พื้นที่ต่างอำเภอที่ห่างไกลจากศูนย์กระจายสินค้าประมาณ 1-3วัน</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>***ก่อนจัดส่งของไปยังลูกค้า ทางขนส่งจะโทรติดต่อลูกค้าก่อนทุกครั้ง กรณีที่ติดต่อปลายทางไม่ได้ ขนส่งจะเลื่อนจัดส่งเป็นวันถัดไป จนกว่าจะติดต่อลูกค้าได้ก่อนจึงจะทำการจัดส่ง</p>\r\n', '2018-11-10 05:36:43'),
(3, 'PAGE_HOWTO', 'วีธีการชำระเงิน', 'วีธีการชำระเงิน', '2017-12-17 20:49:39'),
(4, 'PAGE_CONTACT', 'ติดต่อเรา', '<p>&nbsp;</p>\r\n\r\n<p>บริษัท บ้านยาเป็นหนึ่ง จำกัด</p>\r\n\r\n<p>2966/8&nbsp;ถ.เดชอุดม ต.ในเมือง อ.เมือง จ.นครราชสีมา 30000</p>\r\n\r\n<p>044-076590</p>\r\n\r\n<p>084-4094558</p>\r\n\r\n<p>093-3907733</p>\r\n', '2018-11-09 12:42:33'),
(5, 'PAGE_PROMOTION', 'โปรโมชั่น', '<p style="text-align:center"><strong>โปรโมชั่น</strong></p>\r\n', '2017-12-17 20:57:45'),
(6, 'PAGE_PAYMENT', 'แจ้งโอนเงิน', '<p style="text-align:center">แจ้งโอนเงิน</p>\r\n', '2017-12-19 16:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `payment_confirm`
--

CREATE TABLE IF NOT EXISTS `payment_confirm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_ref` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `status` varchar(3) NOT NULL,
  `payment_date` varchar(255) NOT NULL,
  `payment_time` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `slip_url` text NOT NULL,
  `text_remark` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `payment_confirm`
--

INSERT INTO `payment_confirm` (`id`, `orders_ref`, `bank`, `status`, `payment_date`, `payment_time`, `name`, `tel`, `email`, `price`, `slip_url`, `text_remark`) VALUES
(21, 'BL-20181111-0000', '{"bank":"ธนาคารกสิกรไทย","number":"123-3213-321"}', 'SHP', '11/11/2018', '00:20', 'sss', 'asd', 'wazjakorn@gmail.com', '333', 'admin/uploads/payment_confirm/1541870277.jpg', ''),
(22, 'BL-20181111-0001', '{"bank":"ธนาคารกสิกรไทย","number":"123-3213-321"}', 'SHP', '11/11/2018', '01:31', 'asddd', '0819543611', 'wazjakorn@gmail.com', '5657567', 'admin/uploads/payment_confirm/1541874422.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `sdescription` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=122 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `sdescription`, `image`, `stock`, `category_id`, `active`) VALUES
(38, 'diane-35  21''s', 152, 'EE 0.035 + Cyproterone', 'EE 0.035 + Cyproterone', '10112018170314.jpg', 196, 5, 1),
(39, 'Minny 28''s', 78, 'EE 0.02 + Desogestrel', 'EE 0.02 + Desogestrel', '10112018171229.jpg', 199, 5, 1),
(40, 'Minny 21''s', 78, 'EE 0.02 + Desogestrel', 'EE 0.02 + Desogestrel', '10112018171609.jpg', 200, 5, 1),
(41, 'Marvelon 21''s', 76, 'EE 0.03 + Desogestrel', 'EE 0.03 + Desogestrel', '10112018171923.jpg', 200, 5, 1),
(42, 'Marvelon 28''s', 76, 'EE 0.03 + Desogestrel', 'EE 0.03 + Desogestrel ', '10112018172325.jpg', 196, 5, 1),
(43, 'Mercilon 21''s', 134, 'EE 0.02 + Desogestrel', 'EE 0.02 + Desogestrel', '10112018172603.jpg', 200, 5, 1),
(44, 'Mercilon 28''s', 134, 'EE 0.02 + Desogestrel', 'EE 0.02 + Desogestrel', '10112018172820.jpg', 200, 5, 1),
(45, 'Preme 28''s', 86, 'EE 0.035 + Cyproterone', 'EE 0.035 + Cyproterone', '10112018173539.jpg', 200, 5, 1),
(46, 'Preme 21''s', 86, 'EE 0.035 + Cyproterone', 'EE 0.035 + Cyproterone', '10112018174203.jpg', 200, 5, 1),
(47, 'Dafne35 (สูตร Diane)', 85, 'EE 0.035 + Cyproterone', 'EE 0.035 + Cyproterone (สูตร Diane)', '10112018174614.jpg', 2, 5, 1),
(48, 'Minoz 28''s', 75, 'EE 0.015 + Gestodene', 'EE 0.015 + Gestodene  (สูตร Minidoz)', '10112018175045.jpg', 200, 5, 1),
(49, 'Rigevidon  21+7 Fe', 35, 'EE 0.03 + Levonorgestrel 0.15', 'EE 0.03 + Levonorgestrel 0.15', '10112018180419.jpg', 200, 5, 1),
(50, 'Beriz 21''s  (สูตร Diane)', 69, 'EE 0.035 + Cyproterone', 'EE 0.035 + Cyproterone', '10112018184135.jpg', 2, 5, 1),
(51, 'Synfonia 24+4''s  (สูตร Yaz)', 266, 'Drospirenone 3 mg +  EE 0.02 mg', 'Drospirenone 3 mg +  EE 0.02 mg', '10112018183857.jpg', 200, 5, 1),
(52, 'Onjel  28''s', 72, 'EE 0.02 + Gestodene 0.075', 'EE 0.02 + Gestodene 0.075', '10112018182827.jpg', 200, 5, 1),
(53, 'Femine 28''s  (สูตร Marvelon)', 45, 'EE 0.03 + Desogestrel', 'EE 0.03 + Desogestrel', '10112018183442.jpg', 200, 5, 1),
(54, 'Chariva 21''s  (สูตร Belara)', 198, 'EE 0.030 + CMA', 'EE 0.030 + CMA', '10112018184535.jpg', 200, 5, 1),
(55, 'Sasha 21''s (สูตร Diane)', 55, 'EE 0.035 + Cyproterone', 'EE 0.035 + Cyproterone', '10112018184924.jpg', 200, 5, 1),
(56, 'Justima 21''s (สูตร Yasmin)', 180, 'EE 0.03 + Drospirenone', 'EE 0.03 + Drospirenone', '10112018185353.jpg', 200, 5, 1),
(57, 'Yasmin 21''s ', 315, 'EE 0.03 + Drospirenone', 'EE 0.03 + Drospirenone', '10112018185727.jpg', 200, 5, 1),
(58, 'Diora 21''s', 35, 'EE 0.03 + Levonorgestrel', 'EE 0.03 + Levonorgestrel', '10112018190031.jpg', 200, 5, 1),
(59, 'Sucee 21''s', 76, 'EE 0.035 + Cyproterone', 'EE 0.035 + Cyproterone', '10112018190341.jpg', 200, 5, 1),
(60, 'Nina 21''s  (สูตร Diane)', 51, 'EE 0.035 + Cyproterone', 'EE 0.035 + Cyproterone', '10112018190840.jpg', 2, 5, 1),
(61, 'Sucee 28''s ', 76, 'EE 0.035 + Cyproterone', 'EE 0.035 + Cyproterone', '12112018112451.jpg', 200, 5, 1),
(62, 'OC-35 21''s (สูตร Diane)', 70, 'EE 0.035 + Cyproterone', 'EE 0.035 + Cyproterone', '12112018113219.jpg', 200, 5, 1),
(63, 'Minidoz 28''s', 135, 'EE 0.015 + Gestodene', 'EE 0.015 + Gestodene', '12112018113552.jpg', 200, 5, 1),
(64, 'Annylyn 28''s', 86, 'EE 0.02 + Gestodene', 'EE 0.02 + Gestodene', '12112018114108.jpg', 200, 5, 1),
(65, 'Microgynon 30ED 28''s', 54, 'EE 0.03 + Levonorgestrel', 'EE 0.03 + Levonorgestrel', '12112018114624.jpg', 200, 5, 1),
(66, 'Meliane ED 28''s', 105, 'EE 0.02 + Gestodene', 'EE 0.02 + Gestodene', '12112018115319.jpg', 200, 5, 1),
(67, 'Diora 28''s', 35, 'EE 0.03 + Levonorgestrel', 'EE 0.03 + Levonorgestrel', '12112018115703.jpg', 200, 5, 1),
(68, 'Camella 28''s (สูตร Gynera ED)', 72, 'EE 0.03 + Gestodene', 'EE 0.03 + Gestodene', '12112018120038.jpg', 200, 5, 1),
(69, 'Lindynette20 21''s', 80, 'EE 0.02 + Gestodene', 'EE 0.02 + Gestodene', '12112018120555.jpg', 200, 5, 1),
(70, 'Yaz 28''s', 357, 'EE 0.02 + Drospirenone', 'EE 0.02 + Drospirenone', '12112018120947.jpg', 200, 5, 1),
(71, 'R-Den 28''s', 20, 'EE 0.03 + Levonorgestrel', 'EE 0.03 + Levonorgestrel', '12112018121542.jpg', 200, 5, 1),
(72, 'Belara 21''s', 250, 'EE 0.030 + CMA', 'EE 0.030 + CMA', '12112018121913.jpg', 200, 5, 1),
(73, 'Meliane 21''s', 105, 'EE 0.02 + Gestodene', 'EE 0.02 + Gestodene ', '12112018122138.jpg', 200, 5, 1),
(74, 'Annylyn 21''s', 86, 'EE 0.02 + Gestodene', 'EE 0.02 + Gestodene', '12112018122424.jpg', 200, 5, 1),
(75, 'Madonna', 19, 'Levonorgestrel', 'Levonorgestrel', '12112018123240.jpg', 200, 5, 1),
(76, 'Dailyton 28''s [สูตร Exluton]', 65, 'Lynestrenol 0.5', 'Lynestrenol 0.5', '12112018123554.jpg', 200, 5, 1),
(77, 'Cerazette 28''s', 180, 'Desogestrel', 'Desogestrel', '12112018123900.jpg', 200, 5, 1),
(78, 'Melodia 21''s', 223, 'Drospirenone 3 mg  +  EE 0.03 mg', 'Drospirenone 3 mg  +  EE 0.03 mg', '12112018124123.jpg', 200, 5, 1),
(79, 'Oilezz 22''s', 337, 'EE 0.03 + Desogestrel', 'EE 0.03 + Desogestrel', '12112018124336.jpg', 200, 5, 1),
(80, 'Helen 21''s', 62, 'EE 0.035 + Cyproterone', 'EE 0.035 + Cyproterone', '12112018132050.jpg', 200, 5, 1),
(81, 'Postinor 2''s', 40, 'Levonorgestrel', 'Levonorgestrel', '12112018132608.jpg', 200, 5, 1),
(82, 'Exluton 28''s', 86, 'Lynestrenol', 'Lynestrenol', '12112018133152.jpg', 200, 5, 1),
(83, 'Norpak 2''s', 12, 'Levonorgestrel', 'Levonorgestrel', '12112018133636.jpg', 200, 5, 1),
(84, 'Camella 21''s (สูตร Gynera ED)', 72, 'EE 0.03 + Gestodene', 'EE 0.03 + Gestodene', '12112018134842.jpg', 200, 5, 1),
(85, 'Lina  6x21''s', 195, 'EE 0.02 + Levonorgestrel 0.1', 'EE 0.02 + Levonorgestrel 0.1', '12112018140225.jpg', 20, 5, 1),
(86, 'Pospond 1x10''s  (สูตร Primolut-N)', 34, 'Norethisterone', 'Norethisterone', '12112018141148.jpg', 200, 5, 1),
(87, 'Primolut-N 10x10''s', 520, 'Norethisterone', 'Norethisterone', '12112018141421.jpg', 20, 5, 1),
(88, 'Steron 5mg.  10x10''s  (สูตร Primolut-N)', 260, 'Norethisterone', 'Norethisterone', '12112018141907.jpg', 200, 5, 1),
(89, 'Norca 5 mg 10X10''s (สูตร Primolut-N)', 255, 'Norethisterone', 'Norethisterone', '12112018142424.jpg', 200, 5, 1),
(90, 'B-Lady 21''s', 55, 'EE 0.035 + Cyproterone ', 'EE 0.035 + Cyproterone ', '12112018142940.jpg', 200, 5, 1),
(91, 'Anamai 28''s', 15, 'Mestranol + Norethisterone', 'Mestranol + Norethisterone', '12112018143407.jpg', 500, 5, 1),
(92, 'Marnon 28''s', 9, 'EE 0.05 + Norgestrel', 'EE 0.05 + Norgestrel', '12112018143810.jpg', 200, 5, 1),
(93, 'Jeny-F.M.P. 28''s', 15, 'EE 0.05 + Norgestrel', 'EE 0.05 + Norgestrel', '12112018144247.jpg', 200, 5, 1),
(94, 'Nora Shampoo 30ml.', 54, 'Ketoconazole', 'Ketoconazole', '12112018155508.jpg', 200, 15, 1),
(95, 'ทัมใจ 100ซอง', 113, 'Aspirin', 'Aspirin', '12112018160902.jpg', 50, 36, 1),
(96, 'ผงพิเศษ ตราร่มชูชีพ  [36 ซอง/กล่อง]', 260, 'ผงพิเศษ ตราร่มชูชีพ', 'ผงพิเศษ ตราร่มชูชีพ', '12112018161419.jpg', 100, 15, 1),
(97, 'Unison enema ผู้ใหญ่ 10x20cc.', 66, 'Sodium Chloride', 'Sodium Chloride ', '12112018170001.jpg', 200, 15, 1),
(98, 'Unison Enema 10x10ml. (เด็ก)', 62, 'Sodium Chloride', 'Sodium Chloride', '12112018170254.jpg', 200, 15, 1),
(99, 'U-ENEMA 100cc.', 22, 'Sodium Chloride', 'Sodium Chloride', '12112018172651.jpg', 200, 15, 1),
(100, 'Dentofizz 15''s  (เม็ดฟู่แช่ฟันปลอม)', 34, 'ช่วยลดคราบได้อย่างทั่วถึง ลดการสะสมของเชื้อโรค ไม่ทำอันตรายต่อฟันปลอม', 'ช่วยลดคราบได้อย่างทั่วถึง ลดการสะสมของเชื้อโรค ไม่ทำอันตรายต่อฟันปลอม', '12112018214638.jpg', 24, 58, 1),
(101, ' Polident Tab 24''s (เม็ดฟู่แช่ฟันปลอม)', 100, 'แช่ทำความสะอาดฟันปลอม', 'แช่ทำความสะอาดฟันปลอม', '12112018215532.jpg', 60, 58, 1),
(102, 'DENTA DENTE'' 60g. ยาสีฟันสมุนไพร', 42, 'ยาสีฟันสมุนไพร', 'ยาสีฟันสมุนไพร', '12112018220522.jpg', 20, 58, 1),
(103, 'DENTA DENTE'' 160g.  ยาสีฟันสมุนไพร', 80, ' ยาสีฟันสมุนไพร', ' ยาสีฟันสมุนไพร', '12112018175105.jpg', 24, 28, 1),
(104, ' INDOHIM  แคปซูลเหลือง 1000''s', 270, 'seven stars', 'Indometacin 20mg.', '12112018222201.jpg', 20, 37, 1),
(105, 'PIROXIM FORTE แคปซูลสีฟ้า-เหลือง 1000''s', 440, 'seven stars', 'Piroxicam 20 mg.', '12112018222418.jpg', 20, 37, 1),
(106, 'COSIC 1000''s  เม็ดสีส้มรี (สูตร Norgesic)', 360, 'Paracetamol 500 mg. +  Orphenadrine 35 mg.', 'Paracetamol 500 mg. +  Orphenadrine 35 mg.', '12112018221002.jpg', 20, 37, 1),
(107, 'NEOSEC 1000''s เม็ดกลมสีขาว (สูตร Norgesic)', 350, 'MASALAB', 'Paracetamol 450 mg. + Orphenadrine 35 mg.', '12112018221251.jpg', 20, 37, 1),
(108, 'NABESAC เม็ดสีส้มรี 1000''s (สูตร Norgesic)', 350, 'MASALAB', 'Paracetamol 500 mg. + Orphenadrine 35 mg.', '12112018224323.jpg', 20, 37, 1),
(109, 'Volcidol-S เม็ดขาวกลม 1000''s ', 1500, 'Central poly trading', 'Tramadol 50 mg.', '12112018223900.jpg', 20, 37, 1),
(110, 'IBUMAN-PLUS เม็ดสีม่วงรี 500''s', 690, 'T.MAN', 'Ibuprofen 400 mg. + Paracetamol 325 mg.', '12112018224050.jpg', 20, 37, 1),
(111, 'Cenbufen 400mg. เม็ดสีฟ้าหมอน 1000''s', 830, 'Ibuprofen 400 mg.', 'Ibuprofen 400 mg.', '12112018194227.jpg', 2, 37, 1),
(112, 'Kintal B 500''s (เม็ดสีฟ้ารี)', 590, 'Ibuprofen 400 mg. + Paracetamol 325 mg.', 'Central Poly Trading', '12112018225255.jpg', 20, 37, 1),
(113, 'INDOMETHACIN 25mg. 1000''s (แคปซูลสีฟ้าขาว)', 170, 'Indomethacin 25 mg.', 'A.U.', '12112018225613.jpg', 100, 37, 1),
(114, 'CEMOL 1000''s  (เม็ดสีขาวกลม)', 160, 'Paracetamol 500 mg.', 'Central Poly Trading', '12112018230444.jpg', 20, 37, 1),
(115, 'PARAMAN-2  1000''s  (เม็ดยา2ชั้น สีฟ้าเหลือง)', 130, 'Paracetamol 325 mg.', 'T.MAN', '12112018230822.jpg', 20, 37, 1),
(116, 'CENBUFEN 400  1000''s (เม็ดสีฟ้ารี)', 830, 'Ibuprofen 400 mg. ', 'Central Poly Trading', '12112018231525.jpg', 20, 37, 1),
(117, 'CEFEN 400P  1000''s  (เม็ดกลมสีชมพู)', 400, 'Ibuprofen 400 mg.', 'Central Poly Trading', '12112018231833.jpg', 2, 37, 1),
(118, 'CEMOL  1000''s  (เม็ดสีฟ้าขาว)', 170, 'Paracetamol 500 mg.', 'Central Poly Trading', '12112018232126.jpg', 10, 37, 1),
(119, 'MENAMIC  250mg. 500''s (แคปซูลสีฟ้า-ครีม)', 230, 'Mefenamic 250 mg.', 'OSI', '12112018232625.jpg', 10, 37, 1),
(120, 'INDOHIM 1000''s  (แคปซูลสีเขียว-เหลือง)', 270, 'Indomethacin 25 mg.', 'seven stars', '12112018233015.jpg', 1, 37, 1),
(121, 'NUOSIC  1000''s เม็ดสี่เหลี่ยมสีเขียว (สูตร Norgesic)', 360, 'Paracetamol 500 mg. + Orphenadrine 35 mg.', 'MILLIMED', '12112018233422.jpg', 20, 37, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
