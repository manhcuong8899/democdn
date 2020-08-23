-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: web30
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.16.04.1

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `city` char(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receiver_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `short` text,
  `long` mediumtext,
  `mode` char(50) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `group` char(15) DEFAULT NULL,
  `locale` char(15) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `cate_id` varchar(50) DEFAULT NULL,
  `description` tinytext,
  `keywords` tinytext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (214,'QUÀ TẶNG ĐI CÙNG THỜI ĐẠI','qua-tang-di-cung-thoi-dai.html','qua-tang-di-cung-thoi-dai.png','<div>\r\n	<em><strong>USB GIA HƯNG k&iacute;nh ch&agrave;o qu&yacute; kh&aacute;ch !</strong></em></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	- C&ocirc;ng ty TNHH QU&Agrave; TẶNG GIA HƯNG th&agrave;nh lập v&agrave;o năm 2010 với mảng kinh doanh c&aacute;c mặt h&agrave;ng qu&agrave; tặng. Trong đ&oacute;, usb qu&agrave; tặng l&agrave; 1 nh&aacute;nh ch&iacute;nh trong chiến lược ph&aacute;t triển của c&ocirc;ng ty</div>\r\n<div>\r\n	- C&aacute;c sản phẩm usb của Gia Hưng lu&ocirc;n cập nhật những chuẩn thiết bị mới nhất thị trường như cổng cắm TYPE C, USB 3.0, USB 3.1 (đẩy nhanh tốc độ ghi dữ liệu, tối đa l&ecirc;n đến 1Gb/gi&acirc;y), dung lượng lưu trữ đa dạng 4-8-16-32-64-128 Gb</div>\r\n<div>\r\n	- V&agrave;o năm 2018, ch&uacute;ng t&ocirc;i đ&atilde; đầu tư, x&acirc;y dựng xưởng lắp r&aacute;p usb tại Việt Nam với mục ti&ecirc;u: Đẩy nhanh tốc độ ho&agrave;n thiện sản phẩm, giảm gi&aacute; th&agrave;nh</div>\r\n<div>\r\n	- QU&Agrave; TẶNG ĐI C&Ugrave;NG THỜI ĐẠI &ndash; Ch&uacute;ng t&ocirc;i tin rằng usb ở tại thời điểm n&agrave;y v&agrave; 10 năm nữa, vẫn l&agrave; m&oacute;n qu&agrave; tặng kh&ocirc;ng lỗi mốt v&agrave; v&ocirc; c&ugrave;ng hữu dụng</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<em><strong>Cảm ơn bạn đ&atilde; gh&eacute; thăm website b&aacute;n h&agrave;ng của ch&uacute;ng t&ocirc;i</strong></em></div>\r\n','<div>\r\n	<em><strong>USB GIA HƯNG k&iacute;nh ch&agrave;o qu&yacute; kh&aacute;ch !</strong></em></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	- C&ocirc;ng ty TNHH QU&Agrave; TẶNG GIA HƯNG th&agrave;nh lập v&agrave;o năm 2010 với mảng kinh doanh c&aacute;c mặt h&agrave;ng qu&agrave; tặng. Trong đ&oacute;, usb qu&agrave; tặng l&agrave; 1 nh&aacute;nh ch&iacute;nh trong chiến lược ph&aacute;t triển của c&ocirc;ng ty</div>\r\n<div>\r\n	- C&aacute;c sản phẩm usb của Gia Hưng lu&ocirc;n cập nhật những chuẩn thiết bị mới nhất thị trường như cổng cắm TYPE C, USB 3.0, USB 3.1 (đẩy nhanh tốc độ ghi dữ liệu, tối đa l&ecirc;n đến 10Gbps), dung lượng lưu trữ đa dạng 4-8-16-32-64-128 Gb</div>\r\n<div>\r\n	- V&agrave;o năm 2018, ch&uacute;ng t&ocirc;i đ&atilde; đầu tư, x&acirc;y dựng xưởng lắp r&aacute;p usb tại Việt Nam với mục ti&ecirc;u: Đẩy nhanh tốc độ ho&agrave;n thiện sản phẩm, giảm gi&aacute; th&agrave;nh</div>\r\n<div>\r\n	- QU&Agrave; TẶNG ĐI C&Ugrave;NG THỜI ĐẠI &ndash; Ch&uacute;ng t&ocirc;i tin rằng usb ở tại thời điểm n&agrave;y v&agrave; 10 năm nữa, vẫn l&agrave; m&oacute;n qu&agrave; tặng kh&ocirc;ng lỗi mốt v&agrave; v&ocirc; c&ugrave;ng hữu dụng</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<em><strong>Cảm ơn bạn đ&atilde; gh&eacute; thăm website b&aacute;n h&agrave;ng của ch&uacute;ng t&ocirc;i</strong></em></div>\r\n','0',1,'introductions','vn',1,'226','','','2019-11-14 21:35:25','2019-12-03 01:21:18'),(216,' Chuẩn USB 3.1 là gì? tốc độ sao chép dữ liệu hơn 3.0 bao nhiêu?','chuan-usb-31-la-gi-toc-do-sao-chep-du-lieu-hon-30-bao-nhieu.html','chuan-usb-31-la-gi-toc-do-sao-chep-du-lieu-hon-30-bao-nhieu.jpg','<p>\r\n	<strong>Với việc c&ocirc;ng bố ch&iacute;nh thức phi&ecirc;n bản kế tiếp của chuẩn kết nối USB 3.1 với tốc độ cao hơn gấp hai lần so với USB 3.0. Tuy nhi&ecirc;n c&oacute; kh&aacute; nhiều người d&ugrave;ng lại t&ograve; m&ograve; về chuẩn giao thức USB mới n&agrave;y. Vậy với b&agrave;i viết dưới đ&acirc;y ch&uacute;ng ta sẽ c&ugrave;ng đi t&igrave;m hiểu chuẩn USB 3.1 l&agrave; g&igrave;? tốc độ sao ch&eacute;p dữ liệu hơn <a href=\"https://thuthuat.taimienphi.vn/usb-3-0-la-gi-may-tinh-cua-ban-co-duoc-ho-tro-usb-3-0-khong-25570n.aspx\">USB 3.0</a> bao nhi&ecirc;u nh&eacute;</strong></p>\r\n','<div class=\"des3 clearfix\" style=\"height: auto !important;\">\r\n	<p>\r\n		<strong>USB</strong> l&agrave; một trong những c&ocirc;ng nghệ th&agrave;nh c&ocirc;ng nhất trong ng&agrave;nh điện to&aacute;n khi được trang bị cho c&aacute;c thiết bị m&aacute;y t&iacute;nh hiện nay, ngo&agrave;i nhiệm vụ l&agrave; lưu trữ file th&igrave; USB c&ograve;n hỗ trợ nhiều hơn thế, bạn dễ d&agrave;ng tạo usb c&agrave;i Win 10 chỉ từ chiếc USB của bạn, việc <a href=\"https://thuthuat.taimienphi.vn/tao-bo-cai-windows-10-tu-usb-3641n.aspx\">tạo usb c&agrave;i Win 10</a> cũng kh&aacute; đơn giản, Taimienphi đ&atilde; hướng dẫn rất chi tiết, c&aacute;c bạn c&oacute; thể t&igrave;m thấy b&agrave;i viết tr&ecirc;n Thuthuat.taimienphi.vn</p>\r\n	<p>\r\n		<img alt=\"chuan usb 3 1 la gi toc do sao chep du lieu hon 3 0 bao nhieu\" height=\"250\" src=\"https://imgt.taimienphi.vn/cf/Images/ddt/2017/7/12/chuan-usb-3-1-la-gi-toc-do-sao-chep-du-lieu-hon-3-0-bao-nhieu.jpg\" width=\"450\" /></p>\r\n	<p>\r\n		Với c&ocirc;ng nghệ ng&agrave;y c&agrave;ng ph&aacute;t triển th&igrave; c&aacute;c sản phẩm sử dụng thế hệ mới nhất của chuẩn giao tiếp n&agrave;y đang bắt đầu xuất hiện v&agrave; mới đ&acirc;y nhất l&agrave; chuẩn kết nối <strong>USB 3.1</strong> được nhiều người d&ugrave;ng nhắc tới so với USB 3.0 trước đ&acirc;y. Nếu bạn quan t&acirc;m tới chuẩn kết nối n&agrave;y, mời bạn đọc theo d&otilde;i b&agrave;i viết sau đ&acirc;y để c&ugrave;ng t&igrave;m hiểu chuẩn USB 3.1 l&agrave; g&igrave;? tốc độ sao ch&eacute;p dữ liệu hơn <a href=\"https://thuthuat.taimienphi.vn/usb-3-0-la-gi-may-tinh-cua-ban-co-duoc-ho-tro-usb-3-0-khong-25570n.aspx\">USB 3.0</a> bao nhi&ecirc;u nh&eacute;.</p>\r\n	<p>\r\n		<u>Chuẩn USB 3.1 l&agrave; g&igrave;? tốc độ sao ch&eacute;p dữ liệu hơn 3.0 bao nhi&ecirc;u?</u></p>\r\n	<p>\r\n		USB 3.1 (hay c&ograve;n gọi l&agrave; USB 3.1/thế hệ 2) l&agrave; sự kế thừa cho USB 3.0, c&oacute; thể nhận diện bằng cổng kết nối turquois. <strong>USB 3.1 tăng gấp đ&ocirc;i tốc độ truyền tải của 3.0 l&ecirc;n đến một con số khổng lồ 10 Gbps</strong>. V&agrave; cũng giống như c&aacute;c phi&ecirc;n bản trước đ&oacute; của USB, n&oacute; ho&agrave;n to&agrave;n tương th&iacute;ch với c&aacute;c thiết bị cũ.</p>\r\n	<p>\r\n		<img alt=\"chuan usb 3 1 la gi toc do sao chep du lieu hon 3 0 bao nhieu 2\" height=\"250\" src=\"http://i1.taimienphi.vn/tmp/cf/aut/chuan-usb-3-1-la-gi-toc-do-sao-chep-du-lieu-hon-3-0-bao-nhieu-1.jpg\" width=\"500\" /></p>\r\n	<p>\r\n		Khi được kết hợp c&aacute;c kết nối Type-C, USB 3.1 chắc chắn sẽ tạo n&ecirc;n rất nhiều điều th&uacute; vị. B&ecirc;n cạnh đ&oacute;, với khả năng truyền tải điện năng 100W phi&ecirc;n bản 2.0, n&oacute; ho&agrave;n to&agrave;n c&oacute; thể cung cấp năng lượng hoặc sạc đầy cho cả một chiếc notebook, c&oacute; nghĩa l&agrave; cổng AC độc quyền c&oacute; thể sớm được thay thế bởi sự thay thế t&iacute;nh phổ biến cao n&agrave;y. Với 4 l&agrave;n dữ liệu, USB 3.1 Type-C thậm ch&iacute; c&oacute; thể mang cả cổng DisplayPort v&agrave; HDMI đi xa hơn c&ocirc;ng dụng của n&oacute;. Bạn h&atilde;y tưởng tượng xem, một cổng-nhưng kết nối được tất cả, điều n&agrave;y sẽ c&oacute; thể tiện lợi đến như thế n&agrave;o?</p>\r\n	<p>\r\n		Hiện tại, <strong>giao thức USB 3.1</strong> l&agrave; giao thức cao nhất v&agrave; l&agrave; người kế nhiệm của giao thức USB 3.0, một giao thức qu&aacute; phổ biến trong đa số c&aacute;c d&ograve;ng laptop v&agrave; desktop hiện nay. Nếu đi t&igrave;m hiểu s&acirc;u hơn một t&yacute; th&igrave; giao thức USB 3.1 lại được chia nhỏ ra th&agrave;nh 2 loại như sau:</p>\r\n	<p>\r\n		- <strong>USB 3.1 Gen 1</strong>: Giao thức n&agrave;y kh&aacute; giống như USB 3.0 v&agrave; tốc độ tối đa của n&oacute; vẫn ở mức 4.8 - 5 Gbps nhưng chỉ &quot;nhỉnh&quot; hơn ch&uacute;t về hiệu năng. Về cơ bản th&igrave; bạn kh&ocirc;ng cần qu&aacute; quan t&acirc;m đến giao thức n&agrave;y.</p>\r\n	<p>\r\n		- <strong>USB 3.1 Gen 2</strong>: Đ&acirc;y mới thật sự l&agrave; thế hệ USB mới. N&oacute; c&oacute; tốc độ truyền tải dữ liệu tối đa 10Gbps, gấp đ&ocirc;i so với USB 3.0 / 3.1 gen 1. USB 3.1 gen 2 c&ograve;n được cải tiến khả năng xử l&yacute; t&iacute;n hiệu để phần dữ liệu bị d&ocirc;i ra (overhead) trở n&ecirc;n nhỏ hơn, tức l&agrave; tiết kiệm dung lượng khi truyền đi hơn so với thế hệ cũ. Logo d&ugrave;ng để chỉ USB 3.1 gen 2 l&agrave; SuperSPEED+.</p>\r\n	<p>\r\n		Chi tiết tốc độ xử l&yacute; dữ liệu của USB 3.1 c&aacute;c bạn c&oacute; thể tham khảo h&igrave;nh ảnh so s&aacute;nh sau:</p>\r\n	<p>\r\n		<img alt=\"chuan usb 3 1 la gi toc do sao chep du lieu hon 3 0 bao nhieu 3\" class=\"lazy\" data-original=\"https://imgt.taimienphi.vn/cf/Images/ddt/2017/7/12/chuan-usb-3-1-la-gi-toc-do-sao-chep-du-lieu-hon-3-0-bao-nhieu-2.jpg\" height=\"415\" src=\"https://imgt.taimienphi.vn/cf/Images/ddt/2017/7/12/chuan-usb-3-1-la-gi-toc-do-sao-chep-du-lieu-hon-3-0-bao-nhieu-2.jpg\" style=\"display: block;\" width=\"500\" /></p>\r\n	<p>\r\n		USB 3.1 tương th&iacute;ch ngược với USB 2.0, tức l&agrave; nếu ch&uacute;ng ta c&oacute; một c&aacute;i ổ cứng x&agrave;i USB 2.0 nhưng gắn v&agrave;o m&aacute;y t&iacute;nh c&oacute; kết nối USB 3.0 th&igrave; n&oacute; vẫn đọc được v&agrave; ngược lại. Khi đ&oacute; tốc độ sẽ đạt mức cao nhất c&oacute; thể của ổ cứng chứ kh&ocirc;ng tận dụng được hết 5Gbps của USB 3.0. Tất nhi&ecirc;n l&agrave; n&oacute; cũng phải x&agrave;i c&ugrave;ng cổng cắm, chứ cổng USB-C th&igrave; l&agrave;m sao m&agrave; gắn v&agrave;o lỗ USB-A v&agrave; ngược lại được.</p>\r\n	<p>\r\n		Để nhận biết USB 3.0 hay 2.0 tr&ecirc;n m&aacute;y t&iacute;nh kh&ocirc;ng phải ai cũng biết r&otilde;, nếu quan t&acirc;m, bạn theo d&otilde;i b&agrave;i viết hướng dẫn <strong><a href=\"https://thuthuat.taimienphi.vn/canh-nhan-biet-cong-usb-3-0-tren-laptop-pc-25522n.aspx\">nhận biết cổng USB 3.0</a></strong> tr&ecirc;n latop, m&aacute;y t&iacute;nh tại đ&acirc;y</p>\r\n	<p>\r\n		<span style=\"color:#f1ffff;font-size:4px\">https://thuthuat.taimienphi.vn/chuan-usb-3-1-la-gi-toc-do-sao-chep-du-lieu-hon-3-0-bao-nhieu-25571n.aspx </span><br />\r\n		Như vậy qua b&agrave;i viết tr&ecirc;n đ&acirc;y c&aacute;c bạn đ&atilde; c&oacute; thể thấy r&otilde; &quot;sức mạnh&quot; của chuẩn kết nối USB 3.1 như thế n&agrave;o rồi phải kh&ocirc;ng. Ngo&agrave;i ra, với những bạn kh&ocirc;ng đủ điều kiện để n&acirc;ng cấp m&aacute;y t&iacute;nh hỗ trợ chuẩn kết nối USB mới n&agrave;y ho&agrave;n to&agrave;n c&oacute; thể sử dụng th&ecirc;m phần mềm thứ 3 để hỗ trợ việc sao ch&eacute;p dữ liệu chẳng hạn như <a href=\"https://taimienphi.vn/download-teracopy-593\">Teracopy</a>, chi tiết bạn đọc c&oacute; thể tham khảo th&ocirc;ng qua b&agrave;i viết hướng dẫn <strong><a href=\"https://thuthuat.taimienphi.vn/sao-chep-file-bang-teracopy-1059n.aspx\" target=\"_blank\">tăng tốc copy file bằng Teracopy</a></strong> m&agrave; ch&uacute;ng t&ocirc;i đ&atilde; chia sẻ trước đ&oacute; nh&eacute;.</p>\r\n</div>\r\n<div id=\"endshow\">\r\n	&nbsp;</div>\r\n<p class=\"info4\">\r\n	<b>T&aacute;c giả: </b><a class=\"auth\" href=\"https://thuthuat.taimienphi.vn/tacgia/Nguy%e1%bb%85n+C%e1%ba%a3nh+Nam.aspx\" rel=\"nofollow\"><b>Nguyễn Cảnh Nam</b></a></p>\r\n','0',1,'news','vn',1,'225','','','2019-11-20 23:40:16','2019-11-20 23:40:16'),(217,'Cách nhận biết cổng USB 3.0 trên Laptop, PC','cach-nhan-biet-cong-usb-30-tren-laptop-pc.html','cach-nhan-biet-cong-usb-30-tren-laptop-pc.jpg','<p>\r\n	<strong>Bạn chuẩn bị mua một chiếc Laptop, PC v&agrave; quan t&acirc;m cũng như t&igrave;m hiểu c&aacute;c cổng kết nối của thiết bị đặc biệt l&agrave; cổng USB 3.0 được nhiều người d&ugrave;ng quan t&acirc;m. Tuy nhi&ecirc;n th&ocirc;ng tin của bạn kh&aacute; &iacute;t về định dạng cổng kết nối n&agrave;y, ch&iacute;nh v&igrave; vậy b&agrave;i viết dưới đ&acirc;y Taimienphi sẽ gi&uacute;p bạn c&aacute;ch nhận biết cổng USB 3.0 tr&ecirc;n Laptop, PC để từ đ&oacute; đưa ra được sự lựa chọn cũng như quyết định cho thiết bị bạn đang c&acirc;n nhắc.&nbsp;</strong></p>\r\n','<div class=\"des3 clearfix\" style=\"height: auto !important;\">\r\n	<p>\r\n		Những năm gần đ&acirc;y, c&aacute;i t&ecirc;n <strong>USB 3.0</strong> đ&atilde; dần xuất hiện phổ biến tr&ecirc;n c&aacute;c thiết bị c&ocirc;ng nghệ như laptop, PC, ổ cứng di động... v&agrave; nhận được nhiều sự quan t&acirc;m của người d&ugrave;ng c&ocirc;ng nghệ. Tại sao cổng kết nối USB n&agrave;y lại trở n&ecirc;n th&ocirc;ng dụng v&agrave; c&oacute; g&igrave; kh&aacute;c so với thế hệ <strong>USB 2.0</strong> trước đ&oacute;, với b&agrave;i viết <strong><a href=\"https://thuthuat.taimienphi.vn/so-sanh-usb-20-va-usb-30-5260n.aspx\" target=\"_blank\">so s&aacute;nh USB 2.0 v&agrave; USB 3.0</a></strong> m&agrave; Taimienphi đ&atilde; chia sẻ trước đ&acirc;y, phần n&agrave;o c&aacute;c bạn h&igrave;nh dung ra được điều đ&oacute;.</p>\r\n	<p>\r\n		<img alt=\"cach nhan biet cong usb 3 0 tren laptop pc\" height=\"250\" src=\"https://imgt.taimienphi.vn/cf/Images/ddt/2017/7/12/cach-nhan-biet-cong-usb-3-0-tren-laptop-pc.jpg\" width=\"450\" /></p>\r\n	<p>\r\n		C&ograve;n trong b&agrave;i sau đ&acirc;y Taimienphi sẽ gi&uacute;p c&aacute;c bạn giải đ&aacute;p c&aacute;c vấn đề về USB 3.0 chi tiết hơn như l&agrave; kh&aacute;i niệm cũng như c&aacute;ch nhận biết cổng USB 3.0 tr&ecirc;n Laptop, PC.</p>\r\n	<p>\r\n		<u>USB 3.0 l&agrave; g&igrave;?</u></p>\r\n	<p>\r\n		<strong>USB</strong> (t&ecirc;n đ&acirc;y đủ l&agrave; Universal Serial Bus) l&agrave; một chuẩn kết nội được sử dụng kh&aacute; phổ biến cho ph&eacute;p m&aacute;y t&iacute;nh, laptop c&oacute; thể kết nối trực tiếp với c&aacute;c thiết bị ngoại vi kh&aacute;c như b&agrave;n ph&iacute;m, chuột, ổ cứng di động, internet v&agrave; c&aacute;c thiết bị tablet, smartphone kh&aacute;c. Những con số đi k&egrave;m ph&iacute;a sau t&ecirc;n gọi <strong>USB</strong> như <strong>1.1, 2.0</strong> hay <strong>3.0</strong> l&agrave; để chỉ c&aacute;c phi&ecirc;n bản kh&aacute;c nhau của chuẩn kết nối n&agrave;y. V&agrave; trong khi đ&oacute; USB 3.0 ch&iacute;nh thức xuất hiện lần đầu ti&ecirc;n năm 2009, c&oacute; khả năng truyền tải dữ liệu nhanh gấp 10 lần so với USB 2.0, đ&aacute;nh dấu một bước ph&aacute;t triển mới trong lĩnh vực c&ocirc;ng nghệ. Một trong những ưu điểm của USB 3.0 đ&oacute; ch&iacute;nh l&agrave; khả năng tương th&iacute;ch ngược với USB 2.0 v&agrave; đương nhi&ecirc;n bạn c&oacute; thể dễ d&agrave;ng sử dụng c&aacute;c thiết bị c&oacute; giao tiếp USB 2.0 để kết nối lẫn nhau. Tuy nhi&ecirc;n tốc độ sẽ bị giới hạn v&agrave; chậm hơn.</p>\r\n	<p>\r\n		D&ugrave; c&oacute; c&ugrave;ng h&igrave;nh d&aacute;ng, c&ugrave;ng t&ecirc;n gọi v&agrave; c&ugrave;ng một mục đ&iacute;ch l&agrave; để kết nối với c&aacute;c thiết bị ngoại vi, nhưng kh&ocirc;ng phải tất cả c&aacute;c cổng USB n&agrave;o cũng giống nhau về t&aacute;c dụng. Một số được thiết kế để thực hiện c&aacute;c t&iacute;nh năng m&agrave; một số kh&aacute;c kh&ocirc;ng c&oacute;. Chẳng hạn như bạn c&oacute; thể nhận thấy điện thoại của m&igrave;nh được sạc nhanh hơn với cổng USB n&agrave;y, nhưng lại chậm hơn khi cắm v&agrave;o cổng USB kh&aacute;c. Vậy mỗi khi mua c&aacute;c thiết bị điện tử mới như Laptop, Mainboard , ổ cứng di động... th&igrave; l&agrave;m thế n&agrave;o để biết được rằng thiết bị đ&oacute; c&oacute; hổ trợ cổng USB 3.0 hay kh&ocirc;ng? C&acirc;u trả lời sẽ c&oacute; ngay sau đ&acirc;y.</p>\r\n	<p>\r\n		<u>C&aacute;ch nhận biết cổng USB 3.0 tr&ecirc;n Laptop, PC</u></p>\r\n	<p>\r\n		Để nhận biết cổng USB 3.0 tr&ecirc;n Laptop, PC ch&uacute;ng ta sẽ c&oacute; 2 c&aacute;ch nhận biết ch&iacute;nh sau đ&acirc;y:</p>\r\n	<p>\r\n		<em>C&aacute;ch 1: </em>Nhận biết cổng USB 3.0 qua m&agrave;u sắc</p>\r\n	<p>\r\n		C&oacute; lẽ ai cũng biết tới c&aacute;ch n&agrave;y cũng như dễ d&agrave;ng để ph&acirc;n biệt USB 3.0 v&agrave; USB 2.0. Khi đ&oacute;, USB 3.0 thường được c&aacute;c nh&agrave; sản xuất sơn m&agrave;u xanh (cả cho đầu đực v&agrave; đầu c&aacute;i) để dễ d&agrave;ng ph&acirc;n biệt với cổng USB 2.0 tốc độ thấp với ch&acirc;n cắm m&agrave;u đen.</p>\r\n	<p>\r\n		<img alt=\"cach nhan biet cong usb 3 0 tren laptop pc 2\" height=\"287\" src=\"http://i1.taimienphi.vn/tmp/cf/aut/cach-nhan-biet-cong-usb-3-0-tren-laptop-pc-1.jpg\" width=\"500\" /></p>\r\n	<p>\r\n		<em>C&aacute;ch 2:</em> Trong trường hợp kh&ocirc;ng được sơn m&agrave;u đặc biệt, bạn buộc phải nh&igrave;n v&agrave;o biểu tượng kế b&ecirc;n cổng USB đ&oacute; để ph&acirc;n biệt giữa chuẩn 3.0 v&agrave; 2.0. Th&ocirc;ng thường ở USB 3.0 sẽ c&oacute; chữ SS đằng trước biểu tượng USB c&ograve;n đối với USB 2.0 th&igrave; sẽ kh&ocirc;ng c&oacute; (SS c&oacute; nghĩa l&agrave; Super Speed).</p>\r\n	<p>\r\n		<img alt=\"cach nhan biet cong usb 3 0 tren laptop pc 3\" class=\"lazy\" data-original=\"https://imgt.taimienphi.vn/cf/Images/ddt/2017/7/12/cach-nhan-biet-cong-usb-3-0-tren-laptop-pc-2.jpg\" height=\"207\" src=\"https://imgt.taimienphi.vn/cf/Images/ddt/2017/7/12/cach-nhan-biet-cong-usb-3-0-tren-laptop-pc-2.jpg\" style=\"display: block;\" width=\"300\" /></p>\r\n	<p>\r\n		Ngo&agrave;i ra, tr&ecirc;n một số thiết bị mới hiện nay, nhiều bạn c&oacute; thể nh&igrave;n thấy biểu tượng kết nối với một cổng USB k&egrave;m h&igrave;nh sấm s&eacute;t, c&oacute; nghĩa cổng USB n&agrave;y được thiết kế th&ecirc;m cho mục đ&iacute;ch sạc c&aacute;c thiết bị ngo&agrave;i như điện thoại, ipod...</p>\r\n	<p>\r\n		<img alt=\"cach nhan biet cong usb 3 0 tren laptop pc 4\" class=\"lazy\" data-original=\"https://imgt.taimienphi.vn/cf/Images/ddt/2017/7/12/cach-nhan-biet-cong-usb-3-0-tren-laptop-pc-3.jpg\" height=\"119\" src=\"https://imgt.taimienphi.vn/cf/Images/ddt/2017/7/12/cach-nhan-biet-cong-usb-3-0-tren-laptop-pc-3.jpg\" style=\"display: block;\" width=\"500\" /></p>\r\n	<p>\r\n		<u>C&aacute;c t&iacute;nh năng vượt trội của USB 3.0</u></p>\r\n	<p>\r\n		- Về l&yacute; thuyết th&igrave; tốc độ tối đa của USB 3.0 l&agrave; 4.8 - 5 Gbps, khoảng 600 - 625MB/s trong khi USB 2.0 c&oacute; tối độ tối đa l&agrave; 480 Mbps, tức 60MB/s. V&agrave; bạn c&oacute; thể dễ d&agrave;ng nhận thấy USB 3.0 sẽ c&oacute; tốc độ gấp 10 lần so với USB 2.0.</p>\r\n	<p>\r\n		- Số lượng d&acirc;y trong USB 3.0 tăng gấp đ&ocirc;i, từ 4 d&acirc;y l&ecirc;n 8 d&acirc;y. C&aacute;c d&acirc;y bổ sung cần nhiều kh&ocirc;ng gian hơn trong cả phần c&aacute;p v&agrave; kết nối, v&igrave; vậy c&aacute;c kiểu kết nối mới đ&atilde; được thiết kế.</p>\r\n	<p>\r\n		- USB 2.0 cung cấp 500 mA trong khi USB 3.0 cung cấp l&ecirc;n đến 900 mA. Thiết bị USB 3.0 cung cấp th&ecirc;m năng lượng khi cần thiết v&agrave; tiết kiệm năng lượng hơn khi thiết bị được kết nối nhưng kh&ocirc;ng hoạt động.</p>\r\n	<p>\r\n		- Thay v&igrave; xử l&yacute; dữ liệu theo một chiều, USB 3.0 sử dụng hai đường dẫn dữ liệu một chiều, một để nhận dữ liệu v&agrave; một để truyền tải dữ liệu trong khi đ&oacute; USB 2.0 chỉ c&oacute; thể xử l&yacute; dữ liệu theo một chiều.</p>\r\n	<p>\r\n		- Một t&iacute;nh năng mới đ&atilde; được t&iacute;ch hợp th&ecirc;m tr&ecirc;n USB 3.0 (sử dụng g&oacute;i NRDY v&agrave; ERDY) đ&oacute; l&agrave; th&ocirc;ng b&aacute;o một thiết bị kh&ocirc;ng đồng bộ với m&aacute;y chủ. Khi dữ liệu được truyền tải th&ocirc;ng qua thiết bị USB 3.0, d&acirc;y c&aacute;p v&agrave; kết nối, m&aacute;y chủ sẽ gửi y&ecirc;u cầu th&ocirc;ng b&aacute;o chọn c&aacute;ch thức kết nối c&aacute;c thiết bị. C&aacute;c thiết bị n&agrave;y c&oacute; thể được chấp nhận kết nối hoặc bị ejects (loại bỏ).</p>\r\n	<p>\r\n		<em>T&igrave;m hiểu chuẩn USB 3.1 mới</em></p>\r\n	<p>\r\n		USB 3.1 l&agrave; phi&ecirc;n bản kế tiếp của giao thức 3.0 tuy nhi&ecirc;n USB 3.1 lại được chia nhỏ th&agrave;nh 2 loại.</p>\r\n	<p>\r\n		- USB 3.1 Gen 1: Giao thức n&agrave;y kh&aacute; giống như USB 3.0 v&agrave; tốc độ tối đa của n&oacute; vẫn ở mức 4.8 - 5 Gbps nhưng chỉ &quot;nhỉnh&quot; hơn ch&uacute;t về hiệu năng. Về cơ bản th&igrave; bạn kh&ocirc;ng cần qu&aacute; quan t&acirc;m đến giao thức n&agrave;y.</p>\r\n	<p>\r\n		- USB 3.1 Gen 2: Đ&acirc;y mới ch&iacute;nh l&agrave; giao thức mới m&agrave; bạn n&ecirc;n quan t&acirc;m. Với giao thức n&agrave;y sẽ c&oacute; tốc độ truyền tải dữ liệu tối đa l&ecirc;n đến 10 Gbps, gấp đ&ocirc;i so với USB 3.0/ 3.1 Gen 1. V&agrave; biểu tượng của USB 3.1 Gen 2 cũng sẽ c&oacute; một ch&uacute;t kh&aacute;c biệt đ&oacute; ch&iacute;nh l&agrave; c&oacute; dấu cộng + ph&iacute;a sau, SuperSpeed+.</p>\r\n	<p>\r\n		<img alt=\"cach nhan biet cong usb 3 0 tren laptop pc 5\" class=\"lazy\" data-original=\"https://imgt.taimienphi.vn/cf/Images/ddt/2017/7/12/cach-nhan-biet-cong-usb-3-0-tren-laptop-pc-4.jpg\" height=\"309\" src=\"https://imgt.taimienphi.vn/cf/Images/ddt/2017/7/12/cach-nhan-biet-cong-usb-3-0-tren-laptop-pc-4.jpg\" style=\"display: block;\" width=\"500\" /></p>\r\n	<p>\r\n		Tuy nhi&ecirc;n sẽ c&ograve;n mất kh&aacute; nhiều thời gian để chuẩn USB 3.1 mới n&agrave;y trở n&ecirc;n phổ biến do y&ecirc;u cầu kỹ thuật v&agrave; mức gi&aacute; th&agrave;nh cao, ch&iacute;nh v&igrave; vậy vị thế của USB 3.0 sẽ vẫn được duy tr&igrave; vững chắc &iacute;t nhất l&agrave; trong một thời gian d&agrave;i tới.</p>\r\n	<p>\r\n		Như vậy, qua b&agrave;i viết m&agrave; Taimienphi chia sẻ tr&ecirc;n đ&acirc;y c&aacute;c bạn đ&atilde; biết được c&aacute;ch nhận biết cổng USB 3.0 tr&ecirc;n Laptop, PC rồi phải kh&ocirc;ng? Hy vọng rằng b&agrave;i viết sẽ mang đến cho bạn những kiến thức hữu &iacute;ch v&agrave; g&oacute;p phần n&agrave;o đ&oacute; cho những quyết định lựa chọn v&agrave; mua c&aacute;c thiết bị c&ocirc;ng nghệ của bạn.</p>\r\n	<p>\r\n		Ngo&agrave;i ra, trong b&agrave;i viết trước ch&uacute;ng t&ocirc;i đ&atilde; chia sẻ với bạn c&aacute;ch c&agrave;i driver usb 3.0 cho win 7 để c&agrave;i đặt hệ điều h&agrave;nh cho một số d&ograve;ng m&aacute;y kh&ocirc;ng hỗ trợ c&agrave;i Win bằng USB nữa, nếu bạn quan t&acirc;m, bạn c&oacute; thể tham khảo c&aacute;ch <strong><a href=\"https://thuthuat.taimienphi.vn/them-usb-3-0-vao-bo-cai-windows-7-24610n.aspx\">c&agrave;i driver usb 3.0 cho win 7</a></strong> tại đ&acirc;y</p>\r\n	<p>\r\n		<span style=\"color:#f1ffff;font-size:4px\">https://thuthuat.taimienphi.vn/canh-nhan-biet-cong-usb-3-0-tren-laptop-pc-25522n.aspx </span><br />\r\n		USB l&agrave; c&ocirc;ng cụ hữu &iacute;ch cho người d&ugrave;ng, ngo&agrave;i việc lưu trữ dữ liệu th&igrave; d&ugrave;ng USB để c&agrave;i Win l&agrave; một trong những c&aacute;ch được d&acirc;n m&aacute;y t&iacute;nh hay sử dụng, nếu bạn muốn c&agrave;i Windows 10 m&agrave; kh&ocirc;ng cần phải tốn tiền mua đĩa, h&atilde;y tiến h&agrave;nh tạo USB c&agrave;i win 10 bằng những c&ocirc;ng cụ, thiết bị đơn giản nhất, chỉ với một chiếc USB c&oacute; bộ nhớ từ 4GB trở l&ecirc;n, c&aacute;c ứng dụng hỗ trợ tạo USB boot, bạn dễ d&agrave;ng <a href=\"https://thuthuat.taimienphi.vn/tao-bo-cai-windows-10-tu-usb-3641n.aspx\">tạo USB c&agrave;i Win 10</a> trong khoảng thời gian ngắn nhất.</p>\r\n</div>\r\n<div id=\"endshow\">\r\n	&nbsp;</div>\r\n<p class=\"info4\">\r\n	<b>T&aacute;c giả: </b><a class=\"auth\" href=\"https://thuthuat.taimienphi.vn/tacgia/Tr%e1%ba%a7n+V%c4%83n+Vi%e1%bb%87t.aspx\" rel=\"nofollow\"><b>Trần Văn Việt</b></a></p>\r\n','0',1,'news','vn',1,'225','','','2019-11-20 23:41:43','2019-11-20 23:41:43'),(218,'So sánh USB 2.0 và USB 3.0','so-sanh-usb-20-va-usb-30.html','so-sanh-usb-20-va-usb-30.jpg','<p>\r\n	<strong>USB 3.0 ra đời đ&aacute;nh dấu bước chuyển m&igrave;nh trong tốc độ sao lưu, ghi ch&eacute;p t&agrave;i liệu giữa c&aacute;c thiết bị. Vậy USB 3.0 c&oacute; g&igrave; cải tiến hơn so với phi&ecirc;n bản tiền nhiệm USB 2.0. H&atilde;y để Taimienphi.vn giải đ&aacute;p những thắc mắc đ&oacute; cho bạn</strong></p>\r\n','<div class=\"des3 clearfix\" style=\"height: auto !important;\">\r\n	<p>\r\n		Với hơn 10 năm tuổi đời, đ&atilde; đến l&uacute;c USB 2.0 l&ugrave;i về hậu đ&agrave;i để nhường chỗ cho người đ&agrave;n em nhanh v&agrave; mạnh hơn rất nhiều l&agrave; USB 3.0. C&ugrave;ng với đ&oacute;, USB 3.0 c&ograve;n tương th&iacute;ch với phần mềm <a href=\"https://taimienphi.vn/download-khoa-cong-usb-19494\" target=\"_blank\"><strong>kh&oacute;a cổng USB</strong></a> gi&uacute;p người d&ugrave;ng bảo mật dữ liệu. Vậy ch&iacute;nh x&aacute;c l&agrave; phi&ecirc;n bản n&acirc;ng cấp 3.0 n&agrave;y c&oacute; những ưu điểm g&igrave;, v&agrave; nhanh hơn bao nhi&ecirc;u so với USB 2.0. Trước hết h&atilde;y đi t&igrave;m hiểu USB 3.0 l&agrave; g&igrave;?.</p>\r\n	<p>\r\n		<strong><img alt=\"so sanh usb 2.0 va 3.0\" height=\"194\" src=\"https://imgt.taimienphi.vn/cf/Images/2015/12/nth/so-sanh-usb-20-va-usb-30-1.jpg\" width=\"259\" /></strong></p>\r\n	<p>\r\n		<strong><u>1. Định nghĩa USB 3.0</u></strong></p>\r\n	<p>\r\n		Theo định nghĩa chuẩn quốc tế, USB (Universal Serial Bus) l&agrave; một chuẩn kết nối cho ph&eacute;p c&aacute;c thiết bị kết nối với nhau để thực hiện qu&aacute; tr&igrave;nh truyền tải hay chuyển đổi dữ liệu.</p>\r\n	<p>\r\n		C&aacute;c phi&ecirc;n bản của USB được ghi r&otilde; ở đằng sau như 1.1, 2.0 hay&nbsp; 3.0. USB 3.0 ra đời v&agrave;o năm 2009, với tốc độ gấp 10 lần người đ&agrave;n anh 2.0. Với tốc độ vượt trội so với USB 2.0 th&igrave; USB 3.0 được coi như bước đột ph&aacute; trong l&agrave;ng c&ocirc;ng nghệ l&uacute;c bấy giờ.</p>\r\n	<p>\r\n		<strong><img alt=\"so sanh usb 2.0 va 3.0\" height=\"305\" src=\"http://i1.taimienphi.vn/tmp/cf/aut/so-sanh-usb-20-va-usb-30-2.jpg\" width=\"460\" /></strong></p>\r\n	<p>\r\n		Mới đầu năm 2015, phi&ecirc;n bản cập nhật của 3.0 l&agrave; USB 3.1 (USB Type C) đ&atilde; ra đời. Tuy nhi&ecirc;n USB 3.1 vẫn chưa được phổ biến rộng r&atilde;i tr&ecirc;n c&aacute;c thiết bị, tương lai gần ch&uacute;ng ta vẫn sẽ sử dụng USB 3.0 như c&ocirc;ng cụ ch&iacute;nh để truyền tải dữ liệu.</p>\r\n	<p>\r\n		<strong><u>2. C&aacute;ch ph&acirc;n biệt USB 2.0 v&agrave; 3.0</u></strong></p>\r\n	<p>\r\n		Một c&aacute;ch đơn giản nhất đ&oacute; l&agrave; c&aacute;c cổng USB 2.0 c&oacute; m&agrave;u đen, c&ograve;n đối với USB 3.0 th&igrave; c&oacute; m&agrave;u xanh dương. Tuy nhi&ecirc;n tr&ecirc;n 1 số thiết bị của c&aacute;c nh&agrave; ph&acirc;n phối vẫn c&oacute; sự thay đổi m&agrave;u sắc của USB để đồng bộ với thiết bị.</p>\r\n	<p>\r\n		<strong><img alt=\"so sanh usb 2.0 va 3.0\" class=\"lazy\" data-original=\"https://imgt.taimienphi.vn/cf/Images/2015/12/nth/so-sanh-usb-20-va-usb-30-3.jpg\" height=\"205\" src=\"https://imgt.taimienphi.vn/cf/Images/2015/12/nth/so-sanh-usb-20-va-usb-30-3.jpg\" style=\"display: block;\" width=\"500\" /></strong></p>\r\n	<p>\r\n		Ngo&agrave;i ra, b&ecirc;n cạnh c&aacute;c cổng USB 3.0 thường c&oacute; th&ecirc;m k&iacute; hiệu &quot;SS&quot; (Super Speed - Si&ecirc;u tốc độ) đi k&egrave;m với biểu tượng USB, c&ograve;n với c&aacute;c USB 2.0 th&igrave; chỉ c&oacute; biểu tượng USB m&agrave; th&ocirc;i.</p>\r\n	<p>\r\n		<strong><img alt=\"so sanh usb 2.0 va 3.0\" class=\"lazy\" data-original=\"https://imgt.taimienphi.vn/cf/Images/2015/12/nth/so-sanh-usb-20-va-usb-30-4.jpg\" height=\"262\" src=\"https://imgt.taimienphi.vn/cf/Images/2015/12/nth/so-sanh-usb-20-va-usb-30-4.jpg\" style=\"display: block;\" width=\"500\" /></strong></p>\r\n	<p>\r\n		<strong><u>3. Tốc độ tr&ecirc;n l&yacute; thuyết</u></strong></p>\r\n	<p>\r\n		Như đ&atilde; đề cập, tốc độ của USB 3.0 gấp 10 lần phi&ecirc;n bản 2.0. Cụ thể USB 2.0 chỉ c&oacute; tốc độ tối đa l&agrave; 480 Mbps, tức 60MB/s. Trong khi đ&oacute;, tốc độ chuẩn của USB 3.0 sẽ l&agrave; 4.8 - 5 Gbps, tức 600 - 625MB/s. Nh&igrave;n qua về mặt l&yacute; thuyết, r&otilde; r&agrave;ng USB 3.0 c&oacute; tốc độ vượt trội.</p>\r\n	<p>\r\n		<strong><img alt=\"so sanh usb 2.0 va 3.0\" class=\"lazy\" data-original=\"https://imgt.taimienphi.vn/cf/Images/2015/12/nth/so-sanh-usb-20-va-usb-30-5.jpg\" height=\"435\" src=\"https://imgt.taimienphi.vn/cf/Images/2015/12/nth/so-sanh-usb-20-va-usb-30-5.jpg\" style=\"display: block;\" width=\"400\" /></strong></p>\r\n	<p>\r\n		Qua b&agrave;i đ&aacute;nh gi&aacute; n&agrave;y, c&aacute;c bạn phần n&agrave;o cũng đ&atilde; nắm được sơ lược về USB 3.0 v&agrave; 2.0. Ngo&agrave;i ra c&aacute;c bạn cũng c&oacute; thể tham khảo <strong><a href=\"https://thuthuat.taimienphi.vn/top-5-cong-cu-kiem-tra-toc-do-usb-2682n.aspx\" target=\"_blank\">Top 5 c&ocirc;ng cụ kiểm tra tốc độ USB</a></strong> để theo d&otilde;i tốc độ truyền tải của USB c&aacute; nh&acirc;n.</p>\r\n	<p>\r\n		Cho d&ugrave; l&agrave; 2.0 hay 3.0 th&igrave; những loại USB m&agrave; ch&uacute;ng ta hay sử dụng để lưu trữ dữ liệu thường bị virus x&acirc;m nhập. C&aacute;ch tốt nhất trong trường hợp n&agrave;y l&agrave; Format lại USB, nhưng nhiều trường hợp l&agrave;m sai c&aacute;ch đ&atilde; dẫn tới hỏng lu&ocirc;n thiết bị của bạn. Để Format USB an to&agrave;n, đ&uacute;ng quy tr&igrave;nh h&atilde;y tham khảo c&aacute;c <a href=\"https://thuthuat.taimienphi.vn/format-usb-969n.aspx\" target=\"_blank\"><strong>Format USB, phần mềm định dạng USB</strong></a></p>\r\n	<p>\r\n		<span style=\"color:#f1ffff;font-size:4px\">https://thuthuat.taimienphi.vn/so-sanh-usb-20-va-usb-30-5260n.aspx </span><br />\r\n		&nbsp;</p>\r\n</div>\r\n<div id=\"endshow\">\r\n	&nbsp;</div>\r\n<p class=\"info4\">\r\n	<b>T&aacute;c giả: </b><a class=\"auth\" href=\"https://thuthuat.taimienphi.vn/tacgia/Nguy%e1%bb%85n+H%e1%ba%a3i+S%c6%a1n.aspx\" rel=\"nofollow\"><b>Nguyễn Hải Sơn</b></a></p>\r\n','0',1,'news','vn',1,'225','','','2019-11-21 01:04:11','2019-11-21 01:04:11'),(219,' Hướng dẫn cài Windows 7 lên trên USB và sử dụng trên cổng USB 3.0','huong-dan-cai-windows-7-len-tren-usb-va-su-dung-tren-cong-usb-30.html','huong-dan-cai-windows-7-len-tren-usb-va-su-dung-tren-cong-usb-30.jpg','','<div class=\"des3 clearfix\" style=\"height: auto !important;\">\r\n	<p>\r\n		<em>Bước 1:</em> D&ugrave;ng phần mềm tạo ổ đĩa ảo để tạo ra một ổ ảo. Sau đ&oacute; mount file image chứa hệ điều h&agrave;nh Windows 7 v&agrave;o trong đ&oacute;. Copy file Install.wim v&agrave;o một thư mục bất kỳ tr&ecirc;n m&aacute;y t&iacute;nh của bạn. (V&iacute; dụ C:\\test\\)</p>\r\n	<p>\r\n		<em>Bước 2:&nbsp;</em>Khởi động &nbsp;phẩn mềm Deployment tools command prompt<em>&nbsp;</em>trong bộ Microsoft Windows AIK với quyền của Administrator (<strong>Start &gt; All Programs &gt; Microsoft Windows AIK &nbsp;&gt; Deploutment Tools Command Prompt</strong>).</p>\r\n	<p>\r\n		<img alt=\"cai windows 7 len usb va su dung tren usb 3.0\" height=\"390\" src=\"https://imgt.taimienphi.vn/cf/Images/2015/6/hvl/cai-windows-7-len-tren-usb-va-su-dung-tren-cong-usb-30-1.jpg\" width=\"339\" /></p>\r\n	<p>\r\n		<em>Bước 3:</em>Mở tr&igrave;nh Command Prompt l&ecirc;n. Tiếp đến nhập &nbsp;&ldquo;<strong>Dism /get-wiminfo /wimfile:c:\\test\\install.wim</strong>&rdquo; sau đ&oacute; nhấn Enter.</p>\r\n	<p>\r\n		<img alt=\" cai windows 7 qua usb 3.0\" height=\"240\" src=\"http://i1.taimienphi.vn/tmp/cf/aut/cai-windows-7-len-tren-usb-va-su-dung-tren-cong-usb-30-2.jpg\" width=\"460\" /></p>\r\n	<p>\r\n		Với lệnh n&agrave;y th&igrave; to&agrave;n bộ th&ocirc;ng tin v&agrave; c&aacute;c chỉ số của c&aacute;c phi&ecirc;n bản Windows 7 trong file Install.wim sẽ được hiện ra. Bạn chỉ cần nhớ chỉ số <strong>Index </strong>của phi&ecirc;n bản thực hiện.</p>\r\n	<p>\r\n		<em>Bước 4: </em>G&otilde; lệnh &ldquo;<strong>dism /mount-wim /wimfile:c:\\test\\install.wim /index:2 /mountdir:c:\\test\\edit</strong>&rdquo;</p>\r\n	<p align=\"center\">\r\n		<img alt=\"cai dat win 7 len usb\" class=\"lazy\" data-original=\"https://imgt.taimienphi.vn/cf/Images/2015/6/hvl/cai-windows-7-len-tren-usb-va-su-dung-tren-cong-usb-30-3.jpg\" height=\"261\" src=\"https://imgt.taimienphi.vn/cf/Images/2015/6/hvl/cai-windows-7-len-tren-usb-va-su-dung-tren-cong-usb-30-3.jpg\" style=\"display: block;\" width=\"500\" /></p>\r\n	<p>\r\n		H&atilde;y giải n&eacute;n bộ driver USB 3.0 của bạn ra một thư mục dễ nhớ nhất v&agrave; phải nhớ kỹ t&ecirc;n file chứa driver c&oacute; đu&ocirc;i l&agrave; inf.</p>\r\n	<p>\r\n		<em>Bước 5: </em>G&otilde; lệnh &ldquo;<strong>dism /image:c:\\test\\edit /add-driver\\driver:c:\\test\\driver\\usb3\\tenfile.inf</strong>&rdquo; v&agrave; nhấn Enter.</p>\r\n	<p align=\"center\">\r\n		<img alt=\"cai windows 7 len usb va su dung tren usb 3.0, cai windows 7 qua usb 3.0, cai dat win 7 len usb\" class=\"lazy\" data-original=\"https://imgt.taimienphi.vn/cf/Images/2015/6/hvl/cai-windows-7-len-tren-usb-va-su-dung-tren-cong-usb-30-4.jpg\" height=\"261\" src=\"https://imgt.taimienphi.vn/cf/Images/2015/6/hvl/cai-windows-7-len-tren-usb-va-su-dung-tren-cong-usb-30-4.jpg\" style=\"display: block;\" width=\"500\" /></p>\r\n	<p>\r\n		Do một số driver kh&ocirc;ng được ph&eacute;p sử dụng do ch&iacute;nh s&aacute;ch chứng thực của Windows th&igrave; bạn c&oacute; thể cưỡng &eacute;p sử dụng bằng c&aacute;ch th&ecirc;m /Forceunsigned</p>\r\n	<p>\r\n		<strong>V&iacute; dụ:</strong><em>&nbsp;</em>&ldquo;dism /image:d:\\test\\edit /add-driver:d:\\test\\driver\\usb3\\tenfile.inf /forceunsigned&rdquo; v&agrave; nhấn &nbsp;Enter.</p>\r\n	<p>\r\n		Sau khi thao t&aacute;c xong th&igrave; bạn chờ một ch&uacute;t để windows c&oacute; thể thực hiện việc ch&egrave;n driver v&agrave;o m&aacute;y t&iacute;nh. Tiếp đến bạn g&otilde; lệnh:&nbsp;&ldquo;<strong>dism /unmount-wim /mountdir:d:\\test\\edit /commit</strong>&rdquo; để ho&agrave;n tất qu&aacute; tr&igrave;nh add driver.</p>\r\n	<p>\r\n		<img alt=\"\" class=\"lazy\" data-original=\"https://imgt.taimienphi.vn/cf/Images/2015/6/hvl/cai-windows-7-len-tren-usb-va-su-dung-tren-cong-usb-30-5.jpg\" height=\"261\" src=\"https://imgt.taimienphi.vn/cf/Images/2015/6/hvl/cai-windows-7-len-tren-usb-va-su-dung-tren-cong-usb-30-5.jpg\" style=\"display: block;\" width=\"500\" /></p>\r\n	<p>\r\n		<span style=\"color:#f1ffff;font-size:4px\">https://thuthuat.taimienphi.vn/cai-windows-7-len-tren-usb-va-su-dung-tren-cong-usb-30-4552n.aspx </span><br />\r\n		Như vậy với c&aacute;c bước tr&ecirc;n l&agrave; bạn đ&atilde;&nbsp;c&agrave;i Windows 7 l&ecirc;n tr&ecirc;n USB v&agrave; sử dụng tr&ecirc;n cổng USB 3.0 th&agrave;nh c&ocirc;ng. Thực chất phương ph&aacute;p c&agrave;i đặt Windows 7 l&ecirc;n USB 3.0 cũng tương tự như 2.0 vậy. Th&ecirc;m nữa đ&acirc;y l&agrave; phương ph&aacute;p n&acirc;ng cao thế n&ecirc;n kh&ocirc;ng phải ai cũng d&aacute;m bắt tay v&agrave;o h&agrave;nh động. Nếu muốn đơn giản hơn, h&atilde;y tham khảo <a href=\"https://thuthuat.taimienphi.vn/tao-bo-cai-windows-7-tu-usb-3639n.aspx\" target=\"_blank\"><strong>c&aacute;ch tạo bộ c&agrave;i Windows 7 từ USB</strong></a> để biết th&ecirc;m chi tiết.</p>\r\n</div>\r\n<div id=\"endshow\">\r\n	&nbsp;</div>\r\n<p class=\"info4\">\r\n	<b>T&aacute;c giả: </b><a class=\"auth\" href=\"https://thuthuat.taimienphi.vn/tacgia/Tr%e1%ba%a7n+V%c4%83n+Vi%e1%bb%87t.aspx\" rel=\"nofollow\"><b>Trần Văn Việt</b></a></p>\r\n','0',1,'news','vn',1,'225','','','2019-11-21 01:05:08','2019-11-21 01:05:08'),(221,'DỊCH VỤ GÓI QUÀ','dich-vu-goi-qua.html','dich-vu-goi-qua.jpg','<p>\r\n	ABCXYZ</p>\r\n<p>\r\n	ABCXYZ</p>\r\n<p>\r\n	ABCXYZ</p>\r\n<p>\r\n	ABCXYZ</p>\r\n<p>\r\n	ABCXYZ</p>\r\n<p>\r\n	ABCXYZ</p>\r\n<p>\r\n	ABCXYZ</p>\r\n','<p>\r\n	ABCXYZ</p>\r\n<p>\r\n	ABCXYZ</p>\r\n<p>\r\n	ABCXYZ</p>\r\n<p>\r\n	ABCXYZ</p>\r\n<p>\r\n	ABCXYZ</p>\r\n<p>\r\n	ABCXYZ</p>\r\n<p>\r\n	ABCXYZ</p>\r\n','0',1,'services','vn',1,'227','','','2019-12-02 18:28:39','2019-12-02 18:28:39');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banknumber` varchar(255) DEFAULT '0',
  `accountbank` varchar(255) DEFAULT '0',
  `branch` text,
  `status` tinyint(4) DEFAULT '1',
  `cate_id` int(11) DEFAULT '1',
  `order` int(11) DEFAULT '1',
  `customer_id` int(11) DEFAULT '0',
  `locale` char(50) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank`
--

LOCK TABLES `bank` WRITE;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
INSERT INTO `bank` VALUES (22,'1007217280','Hoàng Mạnh Cường','SHB Hà Nội',1,283,1,0,'vn','2020-02-13 19:41:29','2020-02-13 19:41:29'),(23,'104870916769','Hoàng Mạnh Cường','VietinBank Hà Nội',1,284,1,0,'vn','2020-02-13 19:50:14','2020-02-13 19:50:14');
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cate_article`
--

DROP TABLE IF EXISTS `cate_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cate_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `code` char(50) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `parent_slug` varchar(255) DEFAULT NULL,
  `short` text,
  `long` text,
  `status` tinyint(4) DEFAULT '1',
  `parent_id` int(11) DEFAULT '0',
  `group` char(15) DEFAULT NULL,
  `locale` char(15) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `properties_id` varchar(50) DEFAULT NULL,
  `keywords` tinytext,
  `description` tinytext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=286 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cate_article`
--

LOCK TABLES `cate_article` WRITE;
/*!40000 ALTER TABLE `cate_article` DISABLE KEYS */;
INSERT INTO `cate_article` VALUES (59,'Hình ảnh Slide',NULL,'slide','hinh-anh-slide',NULL,'Hình ảnh Slide cho trang chủ',NULL,1,0,'images','vn',1,NULL,NULL,NULL,'2017-03-29 00:50:35','2017-03-29 00:50:35'),(118,'Menu Top',NULL,'menutop',NULL,NULL,'',NULL,1,0,'menus','vn',1,NULL,NULL,NULL,'2017-04-11 05:34:01','2017-04-11 05:34:01'),(133,'Menu Trái',NULL,'menutrai',NULL,NULL,'',NULL,1,0,'menus','vn',1,NULL,NULL,NULL,'2017-05-03 01:20:16','2017-05-03 01:20:16'),(134,'Menu Phải',NULL,'menuphai',NULL,NULL,'',NULL,1,0,'menus','vn',1,NULL,NULL,NULL,'2017-05-03 01:20:29','2017-05-03 01:20:29'),(135,'Menu dưới',NULL,'menuduoi',NULL,NULL,'',NULL,1,0,'menus','vn',1,NULL,NULL,NULL,'2017-05-03 01:20:45','2017-05-03 01:20:45'),(225,'Tin khuyến mãi',NULL,'','tin-tuc/tin-khuyen-mai','','',NULL,1,0,'news','vn',1,NULL,NULL,NULL,'2019-11-07 19:09:55','2019-11-07 19:09:55'),(226,'Giới thiệu công ty',NULL,'','gioi-thieu/gioi-thieu-cong-ty','','',NULL,1,0,'introductions','vn',1,NULL,NULL,NULL,'2019-11-07 20:52:18','2019-11-07 20:52:18'),(229,'Máy chủ, Máy trạm',NULL,'','san-pham/may-chu-may-tram','','  ',NULL,1,0,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:26:52','2020-02-12 00:28:28'),(230,'Máy tính văn phòng',NULL,'','san-pham/may-tinh-van-phong','','',NULL,1,0,'products','vn',3,NULL,NULL,NULL,'2020-02-12 00:27:00','2020-02-12 00:30:48'),(231,'Thiết bị mạng',NULL,'','san-pham/thiet-bi-mang','','',NULL,1,0,'products','vn',4,NULL,NULL,NULL,'2020-02-12 00:27:10','2020-02-12 00:30:48'),(232,'Thiết bị an ninh',NULL,'','san-pham/thiet-bi-an-ninh','','',NULL,1,0,'products','vn',5,NULL,NULL,NULL,'2020-02-12 00:27:44','2020-02-12 00:30:48'),(233,'Laptop, Máy tính xách tay',NULL,'','san-pham/laptop-may-tinh-xach-tay','','',NULL,1,0,'products','vn',2,NULL,NULL,NULL,'2020-02-12 00:30:38','2020-02-12 00:30:48'),(234,'Laptop Asus',NULL,'','san-pham/laptop-asus','san-pham/laptop-may-tinh-xach-tay','',NULL,1,233,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:33:17','2020-02-12 00:33:17'),(235,'Laptop Dell',NULL,'','san-pham/laptop-dell','san-pham/laptop-may-tinh-xach-tay','',NULL,1,233,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:33:39','2020-02-12 00:33:39'),(236,'Laptop HP',NULL,'','san-pham/laptop-hp','san-pham/laptop-may-tinh-xach-tay','',NULL,1,233,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:33:49','2020-02-12 00:33:49'),(237,'Laptop Lenovo',NULL,'','san-pham/laptop-lenovo','san-pham/laptop-may-tinh-xach-tay','',NULL,1,233,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:33:59','2020-02-12 00:33:59'),(238,'Laptop Apple',NULL,'','san-pham/laptop-apple','san-pham/laptop-may-tinh-xach-tay','',NULL,1,233,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:34:13','2020-02-12 00:34:13'),(239,'Laptop Acer',NULL,'','san-pham/laptop-acer','san-pham/laptop-may-tinh-xach-tay','',NULL,1,233,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:34:35','2020-02-12 00:34:35'),(240,'Máy chủ HP',NULL,'','san-pham/may-chu-hp','san-pham/may-chu-may-tram','',NULL,1,229,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:35:29','2020-02-12 00:35:29'),(241,'Máy chủ Dell',NULL,'','san-pham/may-chu-dell','san-pham/may-chu-may-tram','',NULL,1,229,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:35:39','2020-02-12 00:35:39'),(242,'Máy chủ Lenovo',NULL,'','san-pham/may-chu-lenovo','san-pham/may-chu-may-tram','',NULL,1,229,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:36:22','2020-02-12 00:36:22'),(243,'Workstation Dell',NULL,'','san-pham/workstation-dell','san-pham/may-chu-may-tram','',NULL,1,229,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:37:33','2020-02-12 00:37:33'),(244,'Workstation HP',NULL,'','san-pham/workstation-hp','san-pham/may-chu-may-tram','',NULL,1,229,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:37:44','2020-02-12 00:37:44'),(245,'Workstation SuperMicro',NULL,'','san-pham/workstation-supermicro','san-pham/may-chu-may-tram','',NULL,1,229,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:38:18','2020-02-12 00:38:18'),(246,'Máy tính văn phòng Dell',NULL,'','san-pham/may-tinh-van-phong-dell','san-pham/may-tinh-van-phong','',NULL,1,230,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:40:30','2020-02-12 00:40:30'),(247,'Máy tính văn phòng HP',NULL,'','san-pham/may-tinh-van-phong-hp','san-pham/may-tinh-van-phong','',NULL,1,230,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:40:43','2020-02-12 00:40:43'),(248,'Máy tính văn phòng Lenovo',NULL,'','san-pham/may-tinh-van-phong-lenovo','san-pham/may-tinh-van-phong','',NULL,1,230,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:41:07','2020-02-12 00:41:07'),(249,'Máy tính văn phòng Asus',NULL,'','san-pham/may-tinh-van-phong-asus','san-pham/may-tinh-van-phong','',NULL,1,230,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:41:47','2020-02-12 00:41:47'),(250,'Máy tính văn phòng Acer',NULL,'','san-pham/may-tinh-van-phong-acer','san-pham/may-tinh-van-phong','',NULL,1,230,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:42:10','2020-02-12 00:42:10'),(251,'Thiết bị Router',NULL,'','san-pham/thiet-bi-router','san-pham/thiet-bi-mang','',NULL,1,231,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:43:19','2020-02-12 00:43:19'),(252,'Thiết bị Switch chuyển mạch',NULL,'','san-pham/thiet-bi-switch-chuyen-mach','san-pham/thiet-bi-mang','',NULL,1,231,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:43:51','2020-02-12 00:43:51'),(253,'Phụ kiện mạng',NULL,'','san-pham/phu-kien-mang','san-pham/thiet-bi-mang','',NULL,1,231,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:44:20','2020-02-12 00:44:20'),(254,'Camera an ninh',NULL,'','san-pham/camera-an-ninh','san-pham/thiet-bi-an-ninh','',NULL,1,232,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:44:47','2020-02-12 00:44:47'),(255,'Đầu ghi hình',NULL,'','san-pham/dau-ghi-hinh','san-pham/thiet-bi-an-ninh','',NULL,1,232,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:45:24','2020-02-12 00:45:24'),(256,'Ổ cứng camera',NULL,'','san-pham/o-cung-camera','san-pham/thiet-bi-an-ninh','',NULL,1,232,'products','vn',1,NULL,NULL,NULL,'2020-02-12 00:46:00','2020-02-12 00:46:00'),(257,'Thiết bị văn phòng',NULL,'','san-pham/thiet-bi-van-phong','','',NULL,1,0,'products','vn',6,NULL,NULL,NULL,'2020-02-12 21:12:16','2020-02-12 21:12:44'),(258,'Máy in',NULL,'','san-pham/may-in','san-pham/thiet-bi-van-phong','',NULL,1,257,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:12:54','2020-02-12 21:12:54'),(259,'Máy Fax',NULL,'','san-pham/may-fax','san-pham/thiet-bi-van-phong','',NULL,1,257,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:13:03','2020-02-12 21:13:03'),(260,'Máy Scan Ảnh',NULL,'','san-pham/may-scan-anh','san-pham/thiet-bi-van-phong','',NULL,1,257,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:13:09','2020-02-12 21:13:09'),(261,'​ Mực Máy In & Phụ Kiện',NULL,'','san-pham/muc-may-in-phu-kien','san-pham/thiet-bi-van-phong','',NULL,1,257,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:13:16','2020-02-12 21:13:16'),(262,'Bộ Lưu Điện',NULL,'','san-pham/bo-luu-dien','san-pham/thiet-bi-van-phong','',NULL,1,257,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:13:25','2020-02-12 21:13:25'),(263,'Máy Chiếu & Phụ Kiện',NULL,'','san-pham/may-chieu-phu-kien','san-pham/thiet-bi-van-phong','',NULL,1,257,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:13:32','2020-02-12 21:13:32'),(264,'​ Máy Photocopy',NULL,'','san-pham/may-photocopy','san-pham/thiet-bi-van-phong','',NULL,1,257,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:13:52','2020-02-12 21:13:52'),(265,'Máy Hủy Tài Liệu',NULL,'','san-pham/may-huy-tai-lieu','san-pham/thiet-bi-van-phong','',NULL,1,257,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:13:59','2020-02-12 21:13:59'),(266,'Máy chấm công',NULL,'','san-pham/may-cham-cong','san-pham/thiet-bi-van-phong','',NULL,1,257,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:14:05','2020-02-12 21:14:05'),(267,'Máy đếm tiền',NULL,'','san-pham/may-dem-tien','san-pham/thiet-bi-van-phong','',NULL,1,257,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:14:11','2020-02-12 21:14:11'),(268,'Linh kiện máy tính',NULL,'','san-pham/linh-kien-may-tinh','','',NULL,1,0,'products','vn',7,NULL,NULL,NULL,'2020-02-12 21:16:55','2020-02-12 21:17:16'),(269,'CPU - Bộ vi xử lý',NULL,'','san-pham/cpu-bo-vi-xu-ly','san-pham/linh-kien-may-tinh','',NULL,1,268,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:17:10','2020-02-12 21:17:10'),(270,'Mainboard - Bo mạch chủ',NULL,'','san-pham/mainboard-bo-mach-chu','san-pham/linh-kien-may-tinh','',NULL,1,268,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:17:27','2020-02-12 21:17:27'),(271,'RAM - Bộ nhớ trong',NULL,'','san-pham/ram-bo-nho-trong','san-pham/linh-kien-may-tinh','',NULL,1,268,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:17:35','2020-02-12 21:17:35'),(272,'Ổ cứng HDD',NULL,'','san-pham/o-cung-hdd','san-pham/linh-kien-may-tinh','',NULL,1,268,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:17:40','2020-02-12 21:17:40'),(273,'Ổ cứng SSD',NULL,'','san-pham/o-cung-ssd','san-pham/linh-kien-may-tinh','',NULL,1,268,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:17:47','2020-02-12 21:17:47'),(274,'VGA - Card Màn Hình',NULL,'','san-pham/vga-card-man-hinh','san-pham/linh-kien-may-tinh','',NULL,1,268,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:17:55','2020-02-12 21:17:55'),(275,'Case - Vỏ máy tính',NULL,'','san-pham/case-vo-may-tinh','san-pham/linh-kien-may-tinh','',NULL,1,268,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:18:01','2020-02-12 21:18:01'),(276,'PSU - Nguồn máy tính',NULL,'','san-pham/psu-nguon-may-tinh','san-pham/linh-kien-may-tinh','',NULL,1,268,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:18:08','2020-02-12 21:18:08'),(277,'Máy tính chơi game',NULL,'','san-pham/may-tinh-choi-game','','',NULL,1,0,'products','vn',8,NULL,NULL,NULL,'2020-02-12 21:19:24','2020-02-12 21:19:40'),(278,'Máy Tính Chơi Game Asus',NULL,'','san-pham/may-tinh-choi-game-asus','san-pham/may-tinh-choi-game','',NULL,1,277,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:19:35','2020-02-12 21:19:35'),(279,'Máy Tính Chơi Game Gigabyte',NULL,'','san-pham/may-tinh-choi-game-gigabyte','san-pham/may-tinh-choi-game','',NULL,1,277,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:19:49','2020-02-12 21:19:49'),(280,'Máy Tính Chơi Game MSI',NULL,'','san-pham/may-tinh-choi-game-msi','san-pham/may-tinh-choi-game','',NULL,1,277,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:19:55','2020-02-12 21:19:55'),(281,'Máy Tính Chơi Game HNC',NULL,'','san-pham/may-tinh-choi-game-hnc','san-pham/may-tinh-choi-game','',NULL,1,277,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:20:04','2020-02-12 21:20:04'),(282,'Máy Tính Chơi Game Hãng Khác',NULL,'','san-pham/may-tinh-choi-game-hang-khac','san-pham/may-tinh-choi-game','',NULL,1,277,'products','vn',1,NULL,NULL,NULL,'2020-02-12 21:20:11','2020-02-12 21:20:11'),(283,'Ngân hàng Sài Gòn Hà Nội (SHB)','ngan-hang-sai-gon-ha-noi-shb.png','','banks/ngan-hang-sai-gon-ha-noi-shb','',' ',NULL,1,0,'banks','vn',1,NULL,NULL,NULL,'2020-02-13 19:39:39','2020-02-13 19:46:22'),(284,'Ngân hàng Viettin Bank','ngan-hang-viettin-bank.png','','banks/ngan-hang-viettin-bank','','',NULL,1,0,'banks','vn',1,NULL,NULL,NULL,'2020-02-13 19:49:08','2020-02-13 19:49:08'),(285,'Menu Footer',NULL,'menuduoi','menu/menu-footer','','',NULL,1,0,'menus','vn',1,NULL,NULL,NULL,'2020-02-16 18:59:27','2020-02-16 18:59:27');
/*!40000 ALTER TABLE `cate_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complaints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` char(50) DEFAULT 'waitcomplaint',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `short` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `customer_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(8) DEFAULT '0',
  `value` int(11) DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '0',
  `status` char(8) DEFAULT '0',
  `type` tinyint(4) DEFAULT '0',
  `data` char(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT '0',
  `end_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `group_cate` varchar(255) DEFAULT '0',
  `group_product` varchar(255) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (28,'hckmcfnd',5,'Khuyến mãi tháng 02','1',2,'all',0,'2020-02-14 17:00:00','0','0','2020-02-13 20:29:36','2020-02-13 20:29:36');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(15) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `value` decimal(15,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `email_subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_body` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `syntax_help` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` char(50) CHARACTER SET utf8 NOT NULL,
  `title` char(50) CHARACTER SET utf8 NOT NULL,
  `email` char(50) CHARACTER SET utf8 NOT NULL,
  `sender_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `reply` text COLLATE utf8_unicode_ci NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT '0',
  `status` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'noreply',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_products`
--

DROP TABLE IF EXISTS `groups_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `slug` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `group_cate` varchar(255) CHARACTER SET utf8 NOT NULL,
  `group_product` varchar(255) CHARACTER SET utf8 NOT NULL,
  `data` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `block` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_products`
--

LOCK TABLES `groups_products` WRITE;
/*!40000 ALTER TABLE `groups_products` DISABLE KEYS */;
INSERT INTO `groups_products` VALUES (18,'Thiết bị Máy Chủ','thiet-bi-may-chu','[\"240\",\"241\",\"242\"]','','categories',1,'2020-02-12 01:23:05','2020-02-12 01:23:05','trangchu',NULL),(19,'Laptop - Máy tính xách tay','laptop-may-tinh-xach-tay','[\"234\",\"235\",\"236\",\"237\",\"238\",\"239\"]','','categories',1,'2020-02-12 01:24:48','2020-02-12 01:25:29','trangchu',NULL),(20,'Máy tính văn phòng','may-tinh-van-phong','[\"246\",\"247\",\"248\",\"249\",\"250\"]','','categories',1,'2020-02-12 01:26:31','2020-02-12 01:26:35','trangchu',NULL),(21,'Thiết bị mạng','thiet-bi-mang','[\"251\",\"252\",\"253\"]','','categories',1,'2020-02-12 01:26:58','2020-02-12 01:26:58','trangchu',NULL);
/*!40000 ALTER TABLE `groups_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `short` mediumtext NOT NULL,
  `images` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '0',
  `locale` char(15) NOT NULL DEFAULT '0',
  `cate_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `order` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (89,'Server Dell','','server-dell.jpg','top','#','vn',59,1,1,'2020-02-12 01:05:44','2020-02-12 01:05:44'),(90,'Server HP','','server-hp.jpg','top','#','vn',59,1,1,'2020-02-12 01:13:06','2020-02-12 01:13:06');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `join_mode`
--

DROP TABLE IF EXISTS `join_mode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `join_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `join_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `group` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=686 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `join_mode`
--

LOCK TABLES `join_mode` WRITE;
/*!40000 ALTER TABLE `join_mode` DISABLE KEYS */;
/*!40000 ALTER TABLE `join_mode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `join_property`
--

DROP TABLE IF EXISTS `join_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `join_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `type` char(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `join_property`
--

LOCK TABLES `join_property` WRITE;
/*!40000 ALTER TABLE `join_property` DISABLE KEYS */;
/*!40000 ALTER TABLE `join_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linktype`
--

DROP TABLE IF EXISTS `linktype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `linktype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vn` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `en` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `name` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fa` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `order` tinyint(1) DEFAULT '0',
  `category` tinyint(1) DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linktype`
--

LOCK TABLES `linktype` WRITE;
/*!40000 ALTER TABLE `linktype` DISABLE KEYS */;
INSERT INTO `linktype` VALUES (1,'introductions','gioi-thieu','introductions','Giới thiệu',NULL,1,1,1,'2019-10-25 07:06:43',NULL),(2,'news','tin-tuc','news','Tin tức',NULL,1,4,1,'2019-10-25 07:06:43',NULL),(3,'services','dich-vu','services','Dịch vụ',NULL,1,3,1,'2019-10-25 07:06:43',NULL),(5,'sucide','tu-van','sucide','Tư vấn',NULL,0,0,1,NULL,NULL),(7,'products','san-pham','products','Sản phẩm',NULL,1,2,1,'2019-10-25 07:06:43',NULL),(10,'guides','huong-dan','guides','Hướng dẫn',NULL,1,5,1,'2019-10-25 07:06:43',NULL),(11,'images','hinh-anh','images','Hình ảnh',NULL,1,6,1,'2019-10-25 07:06:43',NULL),(12,'fag','cau-hoi-thuong-gap','fag','Câu hỏi thường gặp',NULL,0,0,1,NULL,NULL),(20,'menus','menu','menus','Quản lý menu',NULL,1,1,0,'2019-10-28 10:47:27','2019-10-28 10:47:27'),(21,'policy','chinh-sach','policy','Chính sách',NULL,1,1,1,'2019-11-07 19:50:49','2019-11-07 19:50:49'),(22,'banks','banks','banks','Ngân hàng',NULL,1,1,0,'2020-02-13 19:39:21','2020-02-13 19:39:21');
/*!40000 ALTER TABLE `linktype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `menu_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'vn',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` text,
  `short` tinytext,
  `group` char(50) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `is_usergroup` tinyint(4) DEFAULT '0',
  `is_send` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `code` char(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `cost` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `freight` decimal(15,2) DEFAULT NULL,
  `full_name` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `phonepay` varchar(250) DEFAULT NULL,
  `phone2pay` varchar(250) DEFAULT NULL,
  `emailbill` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` int(4) DEFAULT NULL,
  `type_order` int(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (5,'wvm0t3bj','admin@usbgiahung.com',NULL,1,NULL,42447000.00,0.00,NULL,'Administrator','HN','+84888191138','+84888191138','+84888191138','admin@usbgiahung.com','Ha Noi',NULL,'2020-02-13 20:28:15','2020-02-13 20:28:15',1,1),(6,'pmi4jqqe','admin@usbgiahung.com',NULL,1,NULL,24978000.00,1248900.00,NULL,'Administrator','HN','+84888191138','+84888191138','+84888191138','admin@usbgiahung.com','Ha Noi',NULL,'2020-02-13 20:55:28','2020-02-13 20:55:28',1,1),(7,'sqfofpjn','hoangmanhcuong.hust@gmail.com',NULL,2,NULL,8694000.00,0.00,NULL,'Hoàng Mạnh Cường','HN','+84888191138','+84888191138','+84888191138','hoangmanhcuong.hust@gmail.com','KĐT Pháp Vân - Hoàng Liệt - Hoàng Mai - Hà Nội',NULL,'2020-02-13 21:00:13','2020-02-14 00:44:46',380,1),(9,'byy0jgbe','hoangmanhcuong.hust@gmail.com',NULL,1,NULL,197373410.00,9868670.50,NULL,'Hoàng Mạnh Cường','HN','+84888191138','+84888191138','+84888191138','hoangmanhcuong.hust@gmail.com','KĐT Pháp Vân - Hoàng Liệt - Hoàng Mai - Hà Nội',NULL,'2020-02-16 20:44:39','2020-02-16 20:44:39',380,1),(10,'mfq6bbai','dotrungdong@gmail.com',NULL,1,NULL,159705000.00,0.00,NULL,'Đỗ Trung Đông','HN','+84362550880','+84362550880','+84362550880','dotrungdong@gmail.com','Long Biên - Hà Nội',NULL,'2020-02-16 20:55:18','2020-02-16 20:55:18',382,1),(11,'mrb8zr0u','dotrungdong@gmail.com',NULL,1,NULL,1658000.00,0.00,NULL,'Đỗ Trung Đông','HN','+84362550880','+84362550880','+84362550880','dotrungdong@gmail.com','Long Biên - Hà Nội',NULL,'2020-02-16 20:56:15','2020-02-16 20:56:15',382,1),(12,'3siy5hdu','luuvanlam@gmail.com',NULL,1,NULL,56046000.00,0.00,NULL,'Lưu Văn Lâm','HN','+84963449622','+84963449622','+84963449622','luuvanlam@gmail.com','Hai Bà Trưng - Hà Nội',NULL,'2020-02-16 20:57:41','2020-02-16 20:57:41',381,1),(13,'uqr28bga','hoangmanhcuong.hust@gmail.com',NULL,1,NULL,91597000.00,0.00,NULL,'Hoàng Mạnh Cường','HN','+84888191138','+84888191138','+84888191138','hoangmanhcuong.hust@gmail.com','KĐT Pháp Vân - Hoàng Liệt - Hoàng Mai - Hà Nội',NULL,'2020-02-16 21:06:45','2020-02-16 21:06:45',380,1);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_detail` (
  `order_id` int(4) DEFAULT NULL,
  `product_id` int(4) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `coupon` decimal(15,2) DEFAULT NULL,
  `fee` decimal(15,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `totalprice` decimal(15,2) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_detail`
--

LOCK TABLES `order_detail` WRITE;
/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */;
INSERT INTO `order_detail` VALUES (7,341,1449000.00,0.00,NULL,6,8694000.00,'2020-02-13 21:00:13','2020-02-13 21:00:13'),(9,324,55183000.00,5518300.00,NULL,2,110366000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,334,14149000.00,2829800.00,NULL,4,56596000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,327,30411410.00,1520570.50,NULL,1,30411410.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(10,325,68108000.00,0.00,NULL,2,136216000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(10,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(11,339,209000.00,0.00,NULL,1,209000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(11,341,1449000.00,0.00,NULL,1,1449000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(12,334,14149000.00,0.00,NULL,3,42447000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(12,330,13599000.00,0.00,NULL,1,13599000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(13,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(13,325,68108000.00,0.00,NULL,1,68108000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(7,341,1449000.00,0.00,NULL,6,8694000.00,'2020-02-13 21:00:13','2020-02-13 21:00:13'),(9,324,55183000.00,5518300.00,NULL,2,110366000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,334,14149000.00,2829800.00,NULL,4,56596000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,327,30411410.00,1520570.50,NULL,1,30411410.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(10,325,68108000.00,0.00,NULL,2,136216000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(10,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(11,339,209000.00,0.00,NULL,1,209000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(11,341,1449000.00,0.00,NULL,1,1449000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(12,334,14149000.00,0.00,NULL,3,42447000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(12,330,13599000.00,0.00,NULL,1,13599000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(13,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(13,325,68108000.00,0.00,NULL,1,68108000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(7,341,1449000.00,0.00,NULL,6,8694000.00,'2020-02-13 21:00:13','2020-02-13 21:00:13'),(9,324,55183000.00,5518300.00,NULL,2,110366000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,334,14149000.00,2829800.00,NULL,4,56596000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,327,30411410.00,1520570.50,NULL,1,30411410.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(10,325,68108000.00,0.00,NULL,2,136216000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(10,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(11,339,209000.00,0.00,NULL,1,209000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(11,341,1449000.00,0.00,NULL,1,1449000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(12,334,14149000.00,0.00,NULL,3,42447000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(12,330,13599000.00,0.00,NULL,1,13599000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(13,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(13,325,68108000.00,0.00,NULL,1,68108000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(7,341,1449000.00,0.00,NULL,6,8694000.00,'2020-02-13 21:00:13','2020-02-13 21:00:13'),(9,324,55183000.00,5518300.00,NULL,2,110366000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,334,14149000.00,2829800.00,NULL,4,56596000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,327,30411410.00,1520570.50,NULL,1,30411410.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(10,325,68108000.00,0.00,NULL,2,136216000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(10,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(11,339,209000.00,0.00,NULL,1,209000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(11,341,1449000.00,0.00,NULL,1,1449000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(12,334,14149000.00,0.00,NULL,3,42447000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(12,330,13599000.00,0.00,NULL,1,13599000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(13,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(13,325,68108000.00,0.00,NULL,1,68108000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(7,341,1449000.00,0.00,NULL,6,8694000.00,'2020-02-13 21:00:13','2020-02-13 21:00:13'),(9,324,55183000.00,5518300.00,NULL,2,110366000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,334,14149000.00,2829800.00,NULL,4,56596000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,327,30411410.00,1520570.50,NULL,1,30411410.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(10,325,68108000.00,0.00,NULL,2,136216000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(10,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(11,339,209000.00,0.00,NULL,1,209000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(11,341,1449000.00,0.00,NULL,1,1449000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(12,334,14149000.00,0.00,NULL,3,42447000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(12,330,13599000.00,0.00,NULL,1,13599000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(13,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(13,325,68108000.00,0.00,NULL,1,68108000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(7,341,1449000.00,0.00,NULL,6,8694000.00,'2020-02-13 21:00:13','2020-02-13 21:00:13'),(9,324,55183000.00,5518300.00,NULL,2,110366000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,334,14149000.00,2829800.00,NULL,4,56596000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,327,30411410.00,1520570.50,NULL,1,30411410.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(10,325,68108000.00,0.00,NULL,2,136216000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(10,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(11,339,209000.00,0.00,NULL,1,209000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(11,341,1449000.00,0.00,NULL,1,1449000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(12,334,14149000.00,0.00,NULL,3,42447000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(12,330,13599000.00,0.00,NULL,1,13599000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(13,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(13,325,68108000.00,0.00,NULL,1,68108000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(7,341,1449000.00,0.00,NULL,6,8694000.00,'2020-02-13 21:00:13','2020-02-13 21:00:13'),(9,324,55183000.00,5518300.00,NULL,2,110366000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,334,14149000.00,2829800.00,NULL,4,56596000.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(9,327,30411410.00,1520570.50,NULL,1,30411410.00,'2020-02-16 20:44:39','2020-02-16 20:44:39'),(10,325,68108000.00,0.00,NULL,2,136216000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(10,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 20:55:18','2020-02-16 20:55:18'),(11,339,209000.00,0.00,NULL,1,209000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(11,341,1449000.00,0.00,NULL,1,1449000.00,'2020-02-16 20:56:15','2020-02-16 20:56:15'),(12,334,14149000.00,0.00,NULL,3,42447000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(12,330,13599000.00,0.00,NULL,1,13599000.00,'2020-02-16 20:57:41','2020-02-16 20:57:41'),(13,331,23489000.00,0.00,NULL,1,23489000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(13,325,68108000.00,0.00,NULL,1,68108000.00,'2020-02-16 21:06:45','2020-02-16 21:06:45'),(5,334,14149000.00,0.00,NULL,3,42447000.00,'2020-02-13 20:28:15','2020-02-13 20:28:15'),(6,335,12489000.00,1248900.00,NULL,2,24978000.00,'2020-02-13 20:55:28','2020-02-13 20:55:28'),(7,341,1449000.00,0.00,NULL,6,8694000.00,'2020-02-13 21:00:13','2020-02-13 21:00:13'),(5,334,14149000.00,0.00,NULL,3,42447000.00,'2020-02-13 20:28:15','2020-02-13 20:28:15'),(6,335,12489000.00,1248900.00,NULL,2,24978000.00,'2020-02-13 20:55:28','2020-02-13 20:55:28'),(7,341,1449000.00,0.00,NULL,6,8694000.00,'2020-02-13 21:00:13','2020-02-13 21:00:13');
/*!40000 ALTER TABLE `order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1,'2017-09-16 15:30:49','2017-09-16 15:30:51'),(2,1,NULL,NULL),(3,1,NULL,NULL),(4,1,NULL,NULL),(5,1,NULL,NULL),(6,1,NULL,NULL),(7,1,NULL,NULL),(8,1,NULL,NULL),(9,1,NULL,NULL),(10,1,NULL,NULL),(11,1,NULL,NULL),(12,1,NULL,NULL);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'config_management','{\"vn\":\"Quản lý cấu hình\"}','2017-01-11 12:48:23','2017-01-11 12:48:23'),(2,'image_management','{\"vn\":\"Quản lý hình ảnh\"}','2017-01-11 12:48:23','2017-01-11 12:48:23'),(3,'info_management','{\"vn\":\"Quản lý bài viết\"}','2017-01-11 12:48:24','2017-01-11 12:48:24'),(4,'categories_management','{\"vn\":\"Quản lý danh mục\"}','2017-01-11 12:48:24','2017-01-11 12:48:24'),(5,'orderonline_management','{\"vn\":\"Quản lý đơn đặt hàng\"}','2017-01-11 12:48:24','2017-01-11 12:48:24'),(6,'menu_management','{\"vn\":\"Quản lý menu\"}','2017-01-11 12:48:24','2017-01-11 12:48:24'),(7,'user_management','{\"vn\":\"Quản lý tài khoản\"}','2017-01-11 12:48:24','2017-01-11 12:48:24'),(8,'role_management','{\"vn\":\"Quản lý phân quyền\"}','2017-01-11 12:48:24','2017-01-11 12:48:24'),(9,'feedback_management','{\"vn\":\"Quản lý góp ý\"}','2017-01-11 12:48:24','2017-01-11 12:48:24'),(10,'product_management','{\"vn\":\"Quản lý sản phẩm\"}','2017-09-11 06:29:50','2017-09-11 06:29:50'),(11,'grouproducts_management','{\"vn\":\"Quản lý nhóm sản phẩm\"}','2019-11-07 04:06:25','2019-11-07 04:06:26'),(12,'coupons_management','{\"vn\":\"Quản lý mã giảm giá\"}','2020-02-14 03:30:32','2020-02-14 03:30:33');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `listprice` decimal(15,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `size` char(50) DEFAULT NULL,
  `color` char(50) DEFAULT NULL,
  `short` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `shortcate` tinyint(1) DEFAULT '1',
  `long` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `longcate` tinyint(1) DEFAULT '1',
  `status` tinyint(1) DEFAULT '1',
  `mode` char(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `locale` char(15) DEFAULT NULL,
  `cate_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug_name` varchar(250) DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=345 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (324,'HPE ProLiant DL360 Gen10','DL360Gen10','san-pham/HPEProLiantDL360Gen10-dl360gen10.html','DL360Gen10.png','DL360Gen10',55183000.00,NULL,10,NULL,NULL,NULL,'<p>\r\n	Đang cập nhật</p>\r\n',NULL,'<p>\r\n	Đang cập nhật</p>\r\n',NULL,1,'null',1,'vn','240',NULL,'2020-02-12 01:35:38','2020-02-12 01:35:38','hpe-proliant-dl360-gen10',NULL,NULL),(325,'HPE ProLiant DL380 Gen10 12LFF','DL380Gen1012LFF','san-pham/HPEProLiantDL380Gen1012LFF-dl380-gen1012lff.html','DL380 Gen1012LFF.jpg','DL380Gen1012LFF',68108000.00,NULL,100,NULL,NULL,NULL,'<ul>\r\n	<li>\r\n		Chassis HP DL380 G10 12LFF - 1x500W Power Supply 12x HDD HotSwap</li>\r\n	<li>\r\n		MAINBOARD HP DL380 G10</li>\r\n	<li>\r\n		804338-B21 HPE Smart Array P816i-a SR Gen10 (16 Internal Lanes/4GB Cache/SmartCache) 12G SAS Modular Controller</li>\r\n	<li>\r\n		1 x INTEL&reg; XEON&reg; SILVER 4210 PROCESSOR (13.75M Cache, 2.20 GHz)</li>\r\n	<li>\r\n		1 x HPE 16GB (1x16GB) Single Rank x4 DDR4-2933 CAS-21-21-21 Registered Smart Memory Kit</li>\r\n	<li>\r\n		1 x .NONE HDD</li>\r\n	<li>\r\n		H8QN6E HPE 3Y FC NBD DL38x Gen10 SVC</li>\r\n	<li>\r\n		1 x Heatsink Kit for Proliant DL380 G10</li>\r\n</ul>\r\n',NULL,'<p>\r\n	Đang cập nhật</p>\r\n',NULL,1,'null',1,'vn','240',NULL,'2020-02-12 01:52:54','2020-02-12 02:02:16','hpe-proliant-dl380-gen10-12lff',NULL,NULL),(326,'DELL POWEREDGE R440 - 2.5 INCH','R44025inch','san-pham/DELLPOWEREDGER440-25INCH-r44025inch.html','R44025inch.png','R44025inch',63081410.00,NULL,100,NULL,NULL,NULL,'<ul>\r\n	<li>\r\n		DELL 1U CHASSIS R440 8x2.5INCH ( 1x 550W ) 8x HDD HotSwap</li>\r\n	<li>\r\n		DELL MAINBOARD R440 2.5INCH</li>\r\n	<li>\r\n		PERC H330 Mini/Adapter RAID Controllers</li>\r\n	<li>\r\n		1 x INTEL&reg; XEON&reg; SILVER 4210 PROCESSOR (13.75M Cache, 2.20 GHz)</li>\r\n	<li>\r\n		1 x Dell 16GB DDR4 RDIMM, 2666MT/s, Dual Rank, x8 Data Width</li>\r\n	<li>\r\n		2 x SSD 240GB Seagate Nytro 1351 2.5&quot; SATA III 3D TLC - Enterprise</li>\r\n	<li>\r\n		Slim 8X DVD+/-RW 9.5mm Internal Drive</li>\r\n	<li>\r\n		1 x Dell EMC PE R440 Standard Heat Sink</li>\r\n	<li>\r\n		2 x Tray DELL 14G 2.5in</li>\r\n</ul>\r\n',NULL,'<p>\r\n	Đang cập nhật</p>\r\n',NULL,1,'null',1,'vn','241',NULL,'2020-02-12 02:11:13','2020-02-12 02:20:07','dell-poweredge-r440-25-inch',NULL,NULL),(327,'DELL POWEREDGE R240 - HOTPLUG 3.5INCH','R24035INCH','san-pham/DELLPOWEREDGER240-HOTPLUG35INCH-r24035inch.html','R24035INCH.png','R24035INCH',30411410.00,NULL,100,NULL,NULL,NULL,'<ul>\r\n	<li>\r\n		DELL 1U CHASSIS R240 Hot-plug 4x HDD HotSwap</li>\r\n	<li>\r\n		DELL MAINBOARD R240</li>\r\n	<li>\r\n		Dell Perc H330 SAS 12Gbp/s Adapter PCI-Express ( Raid 0,1,5,10,50 . max 16 disk )</li>\r\n	<li>\r\n		1 x Intel&reg; Xeon&reg; E-2134 Processor 8M Cache, up to 4.50 GHz TM R240 HP</li>\r\n	<li>\r\n		1 x 8GB PC4-2666 ECC UDIMM</li>\r\n	<li>\r\n		Slim 8X DVD+/-RW 9.5mm Internal Drive</li>\r\n</ul>\r\n',NULL,'<p>\r\n	Đang cập nhật</p>\r\n',NULL,1,'null',1,'vn','241',NULL,'2020-02-12 02:26:22','2020-02-12 02:26:22','dell-poweredge-r240-hotplug-35inch',NULL,NULL),(328,'Laptop Dell Inspiron 3580 70184569','70184569','san-pham/LaptopDellInspiron358070184569-70184569.html','70184569.jpg','70184569',14199000.00,NULL,100,NULL,NULL,NULL,'<p>\r\n	Laptop Dell Inspiron 3580 70184569 (i5 8265U/4GB RAM/1TB HDD/DVDRW/AMD Radeon 2GB/15.6&quot; FHD/WL+BT/Win 10)</p>\r\n',NULL,'',NULL,1,'null',1,'vn','235',NULL,'2020-02-12 18:58:22','2020-02-12 19:14:25','laptop-dell-inspiron-3580-70184569',NULL,NULL),(329,'Laptop Dell Vostro 5490','V4I3101W','san-pham/LaptopDellVostro5490-v4i3101w.html','V4I3101W.jpg','V4I3101W',14099000.00,NULL,100,NULL,NULL,NULL,'<p>\r\n	Laptop Dell Vostro 5490 (V4I3101W) (i3 10110U/4G RAM/128GB SSD/14&quot; FHD/Win 10/X&aacute;m)</p>\r\n',NULL,'',NULL,1,'null',1,'vn','235',NULL,'2020-02-12 19:17:15','2020-02-12 19:17:15','laptop-dell-vostro-5490',NULL,NULL),(330,'Laptop Dell Inspiron 3580 (70198169)','70198169','san-pham/LaptopDellInspiron358070198169-70198169.html','70198169.jpeg','70198169',13599000.00,NULL,100,NULL,NULL,NULL,'<p>\r\n	Laptop Dell Inspiron 3580 (70198169) (i5 8265U/4GB RAM/1TB HDD/AMD 520 2GB/DVDRW/15.6&quot; FHD/Dos)</p>\r\n',NULL,'',NULL,1,'null',1,'vn','235',NULL,'2020-02-12 19:20:06','2020-02-12 19:25:43','laptop-dell-inspiron-3580-70198169',NULL,NULL),(331,'Laptop Dell Inspiron 5593A','P90F002N93A','san-pham/LaptopDellInspiron5593A-p90f002n93a.html','P90F002N93A.png','P90F002N93A',23489000.00,NULL,100,NULL,NULL,NULL,'<p>\r\n	Laptop Dell Inspiron 5593A (P90F002N93A) (i7 1065G7/8GB RAM/512GB SSD/15.6&quot; FHD/Win 10/Bạc).</p>\r\n<ul>\r\n	<li>\r\n		CPU: Intel Core i7 1065G7</li>\r\n	<li>\r\n		RAM: i7 1065G7</li>\r\n	<li>\r\n		VGA: Nvidia Geforce MX230 4G DDR5</li>\r\n	<li>\r\n		Ổ cứng: 512GB SSD</li>\r\n	<li>\r\n		M&agrave;n h&igrave;nh: 15.6&quot; FHD</li>\r\n</ul>\r\n',NULL,'',NULL,1,'null',1,'vn','235',NULL,'2020-02-12 19:22:11','2020-02-12 19:22:11','laptop-dell-inspiron-5593a',NULL,NULL),(332,'Laptop Dell Vostro 3490','70196714','san-pham/LaptopDellVostro3490-70196714.html','70196714.png','70196714',1289000.00,NULL,100,NULL,NULL,NULL,'<p>\r\n	Laptop Dell Vostro 3490 (70196714) (i5 10210U/4GB RAM/1TB HDD/FP/14&quot; HD/Win 10/Đen)</p>\r\n',NULL,'',NULL,1,'null',1,'vn','235',NULL,'2020-02-12 19:23:57','2020-02-12 19:23:57','laptop-dell-vostro-3490',NULL,NULL),(333,'PC Dell Inspiron 3670','PCDE450','san-pham/PCDellInspiron3670-pcde450.html','PCDE450.png','PCDE450',10499000.00,NULL,100,NULL,NULL,NULL,'<div>\r\n	Th&ocirc;ng số sản phẩm</div>\r\n<ul>\r\n	<li>\r\n		CPU: Intel Core i3-9100</li>\r\n	<li>\r\n		RAM: 8 GB</li>\r\n	<li>\r\n		Ổ cứng: HDD 1TB</li>\r\n	<li>\r\n		Ổ quang: C&oacute; Đọc+Ghi</li>\r\n	<li>\r\n		Phụ kiện đi k&egrave;m: B&agrave;n ph&iacute;m + chuột</li>\r\n</ul>\r\n',NULL,'',NULL,1,'null',1,'vn','246',NULL,'2020-02-12 19:29:59','2020-02-12 19:29:59','pc-dell-inspiron-3670',NULL,NULL),(334,'PC Dell Vostro 3671MT','PCDE523','san-pham/PCDellVostro3671MT-pcde523.html','PCDE523.png','PCDE523',14149000.00,NULL,100,NULL,NULL,NULL,'<div>\r\n	Th&ocirc;ng số sản phẩm</div>\r\n<ul>\r\n	<li>\r\n		CPU: Intel Core i5-9400</li>\r\n	<li>\r\n		RAM: 8GB RAM</li>\r\n	<li>\r\n		VGA: NVIDIA GT730 2GB</li>\r\n	<li>\r\n		Ổ cứng: 1TB HDD</li>\r\n	<li>\r\n		Hệ điều h&agrave;nh: Linux</li>\r\n</ul>\r\n',NULL,'',NULL,1,'null',1,'vn','246',NULL,'2020-02-12 19:32:02','2020-02-12 19:32:02','pc-dell-vostro-3671mt',NULL,NULL),(335,'PC Dell Inspiron 3470 ','PCDE452','san-pham/PCDellInspiron3470-pcde452.html','PCDE452.jpg','PCDE452',12489000.00,NULL,100,NULL,NULL,NULL,'<div>\r\n	Th&ocirc;ng số sản phẩm</div>\r\n<ul>\r\n	<li>\r\n		CPU: Core i5-9400</li>\r\n	<li>\r\n		RAM: DDR4 8GB</li>\r\n	<li>\r\n		Ổ cứng: HDD 1TB</li>\r\n	<li>\r\n		Ổ quang: C&oacute; Đọc+Ghi</li>\r\n	<li>\r\n		Phụ kiện đi k&egrave;m: B&agrave;n ph&iacute;m + chuột</li>\r\n</ul>\r\n',NULL,'',NULL,1,'null',1,'vn','246',NULL,'2020-02-12 19:35:04','2020-02-12 19:35:04','pc-dell-inspiron-3470',NULL,NULL),(336,'PC Dell OptiPlex 3070 Micro','PCDE483','san-pham/PCDellOptiPlex3070Micro-pcde483.html','PCDE483.png','PCDE483',12589000.00,NULL,100,NULL,NULL,NULL,'<p>\r\n	PC Dell OptiPlex 3070 Micro (i5-9500T/4GB RAM/500GB HDD/Fedora) (42OC370003)</p>\r\n',NULL,'',NULL,1,'null',1,'vn','246',NULL,'2020-02-12 19:40:35','2020-02-12 19:40:35','pc-dell-optiplex-3070-micro',NULL,NULL),(337,'PC Dell Vostro 3470','PCDE493','san-pham/PCDellVostro3470-pcde493.html','PCDE493.png','PCDE493',10549000.00,NULL,100,NULL,NULL,NULL,'<div>\r\n	Th&ocirc;ng số sản phẩm</div>\r\n<ul>\r\n	<li>\r\n		CPU: Intel Core i3-9100</li>\r\n	<li>\r\n		RAM: 4GB</li>\r\n	<li>\r\n		Ổ cứng: 1TB HDD</li>\r\n	<li>\r\n		HĐH: Windows 10</li>\r\n</ul>\r\n',NULL,'',NULL,1,'null',1,'vn','246',NULL,'2020-02-12 19:46:46','2020-02-12 19:46:46','pc-dell-vostro-3470',NULL,NULL),(338,'Router wifi TP-Link TL-WR941HP','RTTP059','san-pham/RouterwifiTP-LinkTL-WR941HP-rttp059.html','RTTP059.jpg','RTTP059',999000.00,NULL,100,NULL,NULL,NULL,'<div>\r\n	Th&ocirc;ng số sản phẩm</div>\r\n<ul>\r\n	<li>\r\n		Băng tần hỗ trợ: 2.4 GHz</li>\r\n	<li>\r\n		Chuẩn kết nối: 802.11 b/g/n</li>\r\n	<li>\r\n		Tốc độ 2.4GHz: 450Mbps</li>\r\n	<li>\r\n		Ăng ten: 3x ngo&agrave;i / 9 dBi</li>\r\n	<li>\r\n		Độ phủ s&oacute;ng cao &ndash; Độ khuếch đại c&ocirc;ng suất cao v&agrave; độ lợi ăng-ten lớn</li>\r\n</ul>\r\n',NULL,'',NULL,1,'null',1,'vn','251',NULL,'2020-02-12 19:49:41','2020-02-12 19:49:41','router-wifi-tp-link-tl-wr941hp',NULL,NULL),(339,'Router Wifi Totolink N210RE','RTTO021','san-pham/RouterWifiTotolinkN210RE-rtto021.html','RTTO021.jpg','RTTO021',209000.00,NULL,100,NULL,NULL,NULL,'<div>\r\n	Th&ocirc;ng số sản phẩm</div>\r\n<ul>\r\n	<li>\r\n		Wireless Router Chuẩn N tốc độ 300Mbps</li>\r\n	<li>\r\n		WAN : 10/100Mbps, RJ45</li>\r\n	<li>\r\n		LAN: 2 x 10/100Mbps</li>\r\n	<li>\r\n		Hỗ trợ Wi-Fi chuẩn IEEE 802.11b/g/n. Tốc độ đạt đến 300Mbps</li>\r\n	<li>\r\n		02 Anten độ lợi cao 2 x 5dBi</li>\r\n</ul>\r\n',NULL,'',NULL,1,'null',1,'vn','251',NULL,'2020-02-12 19:51:32','2020-02-12 19:51:32','router-wifi-totolink-n210re',NULL,NULL),(340,'Router wifi Gaming ASUS ','RTAS032','san-pham/RouterwifiGamingASUS-rtas032.html','RTAS032.jpg','RTAS032',5999000.00,NULL,100,NULL,NULL,NULL,'<div>\r\n	Th&ocirc;ng số sản phẩm</div>\r\n<ul>\r\n	<li>\r\n		Tăng tốc chơi game ba cấp độ - Tối ưu h&oacute;a ho&agrave;n to&agrave;n c&aacute;c g&oacute;i game trực tuyến từ PC của bạn tới m&aacute;y chủ game.</li>\r\n	<li>\r\n		Bộ định tuyến với chứng nhận GeForce Now &ndash; Tận hưởng trải nghiệm chơi game tr&ecirc;n đ&aacute;m m&acirc;y tuyệt đỉnh.</li>\r\n	<li>\r\n		Hỗ trợ AiMesh - Kết hợp với c&aacute;c bộ định tuyến tương th&iacute;ch AiMesh</li>\r\n</ul>\r\n',NULL,'',NULL,1,'null',1,'vn','251',NULL,'2020-02-12 19:53:01','2020-02-12 19:53:01','router-wifi-gaming-asus',NULL,NULL),(341,'Switch 24 Port Totolink SG24D','SWTO005','san-pham/Switch24PortTotolinkSG24D-swto005.html','SWTO005.jpg','SWTO005',1449000.00,NULL,100,NULL,NULL,NULL,'<div>\r\n	Th&ocirc;ng số sản phẩm</div>\r\n<ul>\r\n	<li>\r\n		Tương th&iacute;ch chuẩn IEEE 802.3, IEEE 802.3u, IEEE 802.3ab, IEEE 802.3x</li>\r\n	<li>\r\n		24 cổng 10/100/1000Mbps auto-negotiation.</li>\r\n	<li>\r\n		Hỗ trợ 802.3x kiểm so&aacute;t lưu lượng cho tất cả chế độ full-duplex hoặc hafl-duplex</li>\r\n	<li>\r\n		Hỗ trợ lưu trữ v&agrave; chuyển tiếp.</li>\r\n</ul>\r\n',NULL,'',NULL,1,'null',1,'vn','252',NULL,'2020-02-12 20:00:49','2020-02-12 20:07:52','switch-24-port-totolink-sg24d',NULL,NULL),(343,'Switch Netis 24P','SWNE009','san-pham/SwitchNetis24P-swne009.html','SWNE009.jpg','SWNE009',1999000.00,NULL,100,NULL,NULL,NULL,'<div>\r\n	Th&ocirc;ng số sản phẩm</div>\r\n<ul>\r\n	<li>\r\n		H&atilde;ng sản xuất Netis</li>\r\n	<li>\r\n		Chủng loại ST-3124</li>\r\n	<li>\r\n		Ports 24 cổng RJ45 10/100/1000Mbps Ports (Auto MDI/MDIX)</li>\r\n</ul>\r\n',NULL,'',NULL,1,'null',1,'vn','252',NULL,'2020-02-12 20:05:57','2020-02-12 20:05:57','switch-netis-24p',NULL,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=307 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (303,1,'1988-02-04','male',NULL,'Ha Noi',NULL,'0888191138','http://web30.hust.edu.vn','https://www.facebook.com/',NULL,'<p>tsts</p>','2020-02-13 19:19:36','2020-02-13 19:19:36'),(304,380,NULL,NULL,NULL,'KĐT Pháp Vân - Hoàng Liệt - Hoàng Mai - Hà Nội','HN','+84888191138',NULL,NULL,NULL,NULL,'2020-02-13 20:58:46','2020-02-13 20:58:46'),(305,381,NULL,NULL,NULL,'Hai Bà Trưng - Hà Nội','HN','+84963449622',NULL,NULL,NULL,NULL,'2020-02-16 20:49:54','2020-02-16 20:49:54'),(306,382,NULL,NULL,NULL,'Long Biên - Hà Nội','HN','+84362550880',NULL,NULL,NULL,NULL,'2020-02-16 20:54:27','2020-02-16 20:54:27');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` char(50) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `locale` char(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` VALUES (1,'Hà Nội'),(2,'TP Hồ Chí Minh'),(3,'Hải Phòng'),(4,'Đà Nẵng'),(5,'Cần Thơ'),(6,'An Giang'),(7,'Bà Rịa - Vũng Tàu'),(8,'Bắc Giang'),(9,'Bắc Kạn'),(10,'Bạc Liêu'),(11,'Bắc Ninh'),(12,'Bến Tre'),(13,'Bình Định'),(14,'Bình Dương'),(15,'Bình Phước'),(16,'Bình Thuận'),(17,'Cà Mau'),(18,'Cao Bằng'),(19,'Đắk Lắk'),(20,'Đắk Nông'),(21,'Điện Biên'),(22,'Đồng Nai'),(23,'Đồng Tháp'),(24,'Gia Lai'),(25,'Hà Giang'),(26,'Hà Nam'),(27,'Hà Tĩnh'),(28,'Hải Dương'),(29,'Hậu Giang'),(30,'Hòa Bình'),(31,'Hưng Yên'),(32,'Khánh Hòa'),(33,'Kiên Giang'),(34,'Kon Tum'),(35,'Lai Châu'),(36,'Lâm Đồng'),(37,'Lạng Sơn'),(38,'Lào Cai'),(39,'Long An'),(40,'Nam Định'),(41,'Nghệ An'),(42,'Ninh Bình'),(43,'Ninh Thuận'),(44,'Phú Thọ'),(45,'Quảng Bình'),(46,'Quảng Nam'),(47,'Quảng Ngãi'),(48,'Quảng Ninh'),(49,'Quảng Trị'),(50,'Sóc Trăng'),(51,'Sơn La'),(52,'Tây Ninh'),(53,'Thái Bình'),(54,'Thái Nguyên'),(55,'Thanh Hóa'),(56,'Thừa Thiên Huế'),(57,'Tiền Giang'),(58,'Trà Vinh'),(59,'Tuyên Quang'),(60,'Vĩnh Long'),(61,'Vĩnh Phúc'),(62,'Yên Bái'),(63,'Phú Yên</option>');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrator','{\"en\":\"Supper Admin\",\"vn\":\"Supper Admin\"}','2017-01-11 12:48:25','2017-01-11 12:48:25'),(2,'admin','{\"en\":\"Admin\",\"vn\":\"Quản trị viên\"}','2017-05-06 04:59:22','2017-05-06 04:59:23');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sendemail`
--

DROP TABLE IF EXISTS `sendemail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sendemail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` mediumtext CHARACTER SET utf8 NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `formsend` tinyint(4) NOT NULL DEFAULT '1',
  `type` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sendemail`
--

LOCK TABLES `sendemail` WRITE;
/*!40000 ALTER TABLE `sendemail` DISABLE KEYS */;
/*!40000 ALTER TABLE `sendemail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `locale` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'vn',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'crmname','WEB THẾ HỆ MỚI - DEMO WEBSITE BÁN HÀNG TRỰC TUYẾN','vn','2017-01-11 12:48:22','2017-02-28 07:06:12'),(2,'crmdescription','Copyright 2020 HUST All rights reserved','vn','2017-01-11 12:48:22','2017-02-28 07:06:12'),(3,'crmfooter','WEB THẾ HỆ MỚI - DEMO WEBSITE BÁN HÀNG TRỰC TUYẾN','vn','2017-01-11 12:48:22','2017-04-02 07:33:08'),(4,'orgname','WEB THẾ HỆ MỚI - DEMO WEBSITE BÁN HÀNG TRỰC TUYẾN','vn','2017-01-11 12:48:22','2017-02-28 07:06:12'),(6,'orgdescription','WEB THẾ HỆ MỚI - DEMO WEBSITE BÁN HÀNG TRỰC TUYẾN','vn','2017-01-11 12:48:23','2017-04-02 07:33:08'),(7,'address','Số 01 Đại Cồ Việt - Hai Bà Trưng - Hà Nội','vn','2017-01-11 12:48:23','2019-11-07 18:57:43'),(8,'locale','vn','vn','2017-01-11 12:48:23','2017-02-26 14:14:04'),(11,'new_user_role','authenticated','vn','2017-01-11 12:48:23','2017-02-26 14:10:23'),(12,'titlehomepage','WEB THẾ HỆ MỚI - DEMO WEBSITE BÁN HÀNG TRỰC TUYẾN','vn','2017-02-26 04:33:48','2019-10-25 07:09:57'),(13,'phone','088.819.1138 - 088.600.2865','vn','2017-02-26 04:35:49','2019-11-07 18:57:43'),(14,'hotline','Hotline: 088.819.1138 (Mr Mạnh Cường) | Email: hoangmanhcuong.hust@gmail.com','vn','2017-02-26 04:36:07','2019-11-04 20:17:48'),(15,'linkfanpage','https://www.facebook.com/quatanggiahung.net','vn','2017-02-26 04:36:30','2019-11-06 22:17:21'),(16,'linkgoogle','https://www.facebook.com/quatanggiahung.net','vn','2017-02-26 04:36:49','2019-11-06 22:23:04'),(17,'googlemap','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.5638263266155!2d105.8822384142258!3d21.05013148598682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a97885d8d1ed%3A0xdb48d6009a55eae6!2zNTYyIE5ndXnhu4VuIFbEg24gQ-G7qywgTmfhu41jIEzDom0sIExvbmcgQmnDqm4sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1567678441822!5m2!1svi!2s','vn','2017-02-26 04:37:06','2019-11-07 18:57:43'),(19,'footer','Bản quyền thuộc về WEB THẾ HỆ MỚI - DEMO WEBSITE BÁN HÀNG TRỰC TUYẾN','vn','2017-02-26 04:37:41','2019-11-04 20:17:48'),(20,'email','hoangmanhcuong.hust@gmail.com','vn','2017-02-26 04:38:17','2017-09-18 11:06:03'),(49,'wellcome','Thứ 2 đến thứ 6--  8:00am to 17:00pm ','vn',NULL,NULL),(58,'url','','vn',NULL,NULL),(70,'chatfacebook','<iframe src=\"https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fshiphang1688&tabs=messages&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=230455703780001\" width=\"340\" height=\"500\" style=\"border:none;overflow:hidden\" scrolling=\"no\" frameborder=\"0\" allowTransparency=\"true\"></iframe>','vn',NULL,'2019-11-06 22:17:21'),(71,'messengerfacebook','','vn',NULL,'2019-11-06 22:17:21'),(80,'time','8h - 18h ','vn',NULL,'2017-06-12 01:17:23'),(81,'skype','manhcuong8899','vn','2017-02-26 04:36:07','2019-11-06 22:17:21'),(82,'images','logo.jpg','vn','2017-01-11 12:48:22','2020-02-12 01:15:03'),(87,'keywords','','vn',NULL,'2017-06-11 22:14:23'),(88,'description','','vn',NULL,'2017-06-19 22:26:39'),(126,'enable_registration','0','vn',NULL,'2019-11-04 20:17:48'),(127,'vanchuyen','<p>\r\n	Đang cập nhật</p>\r\n','vn',NULL,'2020-02-12 00:54:04'),(128,'thanhtoan','<p>\r\n	Đang cập nhật</p>\r\n','vn',NULL,'2020-02-12 00:54:04'),(129,'backgroudmenu','#333333','vn',NULL,'2019-11-06 20:04:22'),(130,'fontcolormenu','#ffffff','vn',NULL,'2019-11-06 19:51:03'),(131,'instagram','gg','vn',NULL,'2020-02-09 06:29:41'),(132,'successorder','Đặt hàng thành công','vn',NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_accounts`
--

DROP TABLE IF EXISTS `social_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_user_id` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_accounts`
--

LOCK TABLES `social_accounts` WRITE;
/*!40000 ALTER TABLE `social_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_order`
--

DROP TABLE IF EXISTS `status_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `type_order` int(11) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_order`
--

LOCK TABLES `status_order` WRITE;
/*!40000 ALTER TABLE `status_order` DISABLE KEYS */;
INSERT INTO `status_order` VALUES (1,'new','Đơn hàng mới','Đơn hàng mới',1,NULL),(2,'confrBuy','Xác nhận mua hàng','Xác nhận mua hàng',1,NULL),(3,'fromship','Gửi đơn vị vận chuyển','Đơn hàng đã gửi đơn vị vận chuyển',1,NULL),(4,'shipping','Đang giao hàng','Đơn hàng đang vận chuyển giao cho khách hàng',1,NULL),(5,'finish','Giao hàng thành công','Hoàn thành đơn hàng',1,NULL),(6,'waitdeposit','Đợi đặt cọc','Đợi đặt cọc đối với một số mặt hàng quy định',1,NULL),(7,'deposit','Đã đặt cọc','Đã đặt cọc',1,NULL),(8,'reconfirm','Cần xác nhận lại','Cần xác nhận lại thông tin đơn hàng',1,NULL),(9,'cancel','Hủy đơn hàng','Hủy đơn hàng',1,NULL);
/*!40000 ALTER TABLE `status_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppermenus`
--

DROP TABLE IF EXISTS `suppermenus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppermenus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `url` int(11) DEFAULT '0',
  `cate_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `submenu` char(50) DEFAULT 'no',
  `root_id` int(11) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `bank` tinyint(4) DEFAULT '0',
  `type` char(50) DEFAULT NULL,
  `data` char(50) DEFAULT NULL,
  `locale` char(50) DEFAULT 'vn',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=460 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppermenus`
--

LOCK TABLES `suppermenus` WRITE;
/*!40000 ALTER TABLE `suppermenus` DISABLE KEYS */;
INSERT INTO `suppermenus` VALUES (446,'Trang chủ',NULL,'/',0,118,0,'no',0,1,0,'custom','0','vn','2020-02-12 00:46:58','2020-02-12 00:46:58'),(447,'Sản phẩm',NULL,'#',0,118,0,'yes',0,2,0,'custom','0','vn','2020-02-12 00:47:26','2020-02-12 00:48:05'),(448,'KHUYẾN MÃI',NULL,'#',0,118,0,'no',0,3,0,'custom','0','vn','2020-02-12 00:49:55','2020-02-12 00:50:20'),(449,'CHÍNH SÁCH',NULL,'#',0,118,0,'no',0,4,0,'custom','0','vn','2020-02-12 00:50:11','2020-02-12 00:51:27'),(450,'Hướng dẫn',NULL,'#',0,118,0,'no',0,5,0,'custom','0','vn','2020-02-12 00:50:31','2020-02-12 00:51:49'),(451,'Thông báo',NULL,'#',0,118,0,'no',0,4,0,'custom','0','vn','2020-02-12 00:51:11','2020-02-12 00:51:21'),(452,'Máy chủ, Máy trạm',NULL,'san-pham/may-chu-may-tram',229,118,447,'no',0,1,0,'products','categories','vn','2020-02-12 20:16:05','2020-02-12 20:16:05'),(453,'Máy tính xách tay',NULL,'san-pham/laptop-may-tinh-xach-tay',0,118,447,'no',0,1,0,'custom','0','vn','2020-02-12 21:04:25','2020-02-12 21:06:31'),(454,'Máy tính văn phòng',NULL,'san-pham/may-tinh-van-phong',230,118,447,'no',0,1,0,'products','categories','vn','2020-02-12 21:04:40','2020-02-12 21:04:40'),(455,'Thiết bị mạng',NULL,'san-pham/thiet-bi-mang',231,118,447,'no',0,1,0,'products','categories','vn','2020-02-12 21:04:56','2020-02-12 21:04:56'),(456,'Thiết bị an ninh',NULL,'san-pham/thiet-bi-an-ninh',232,118,447,'no',0,1,0,'products','categories','vn','2020-02-12 21:08:08','2020-02-12 21:15:44'),(457,'Thiết bị văn phòng',NULL,'san-pham/thiet-bi-van-phong',257,118,447,'no',0,1,0,'products','categories','vn','2020-02-12 21:14:49','2020-02-12 21:14:49'),(458,'Máy tính chơi game',NULL,'san-pham/may-tinh-choi-game',277,118,447,'no',0,1,0,'products','categories','vn','2020-02-12 21:21:05','2020-02-12 21:21:05'),(459,'Linh kiện máy tính',NULL,'san-pham/linh-kien-may-tinh',268,118,447,'no',0,1,0,'products','categories','vn','2020-02-12 21:21:27','2020-02-12 21:21:27');
/*!40000 ALTER TABLE `suppermenus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `skype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '1',
  `cate_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support`
--

LOCK TABLES `support` WRITE;
/*!40000 ALTER TABLE `support` DISABLE KEYS */;
INSERT INTO `support` VALUES (8,'0948 226 130','Ms Huế','huent@pcsonline.vn','hue_ptit',1,1,143,'2017-06-11 21:56:06','2017-06-11 21:56:06'),(9,'0982 366 612','Ms Thúy','thuynt@pcsonline.vn','thuy.sociu@gmail.com',1,1,143,'2017-06-11 21:56:33','2017-08-29 02:57:44'),(10,'0165 399 5526','Ms Hằng','dohang1809@gmail.com','dohang1809',1,1,161,'2017-06-11 21:57:23','2017-08-21 18:26:40'),(12,'0987 228 992','Ms Thảo','thaopt@pcsonline.vn','live:f7355b01500bc9be',1,1,160,'2017-06-11 22:00:57','2017-06-11 22:00:57'),(13,'0974 034 321','Ms Ngọc','ngocpt@pcsonline.vn','phanngoc92',1,1,160,'2017-06-11 22:02:46','2017-06-28 01:57:52'),(14,'01688 631 696','Mr Tùng','buidtung2105@gmail.com','buidtung2105',1,1,161,'2017-08-01 08:02:51','2017-08-21 18:27:12');
/*!40000 ALTER TABLE `support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tips`
--

DROP TABLE IF EXISTS `tips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `images` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `short` text CHARACTER SET utf8,
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tips`
--

LOCK TABLES `tips` WRITE;
/*!40000 ALTER TABLE `tips` DISABLE KEYS */;
/*!40000 ALTER TABLE `tips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_notification`
--

DROP TABLE IF EXISTS `type_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `images` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_notification`
--

LOCK TABLES `type_notification` WRITE;
/*!40000 ALTER TABLE `type_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_order`
--

DROP TABLE IF EXISTS `type_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_order`
--

LOCK TABLES `type_order` WRITE;
/*!40000 ALTER TABLE `type_order` DISABLE KEYS */;
INSERT INTO `type_order` VALUES (1,'online','Đơn đặt hàng'),(2,'package','Đơn hàng ký gửi'),(3,'complaint','Đơn khiếu nại');
/*!40000 ALTER TABLE `type_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `images` varchar(255) NOT NULL,
  `short` tinytext NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_level`
--

DROP TABLE IF EXISTS `user_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `code` char(50) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_level`
--

LOCK TABLES `user_level` WRITE;
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` VALUES (1,9,'discount','CK phí giao dịch',70,'2017-04-01 12:05:45','2017-05-16 10:08:15'),(2,8,'discount','CK phí giao dịch',71,'2017-04-01 12:05:45','2017-05-16 10:08:24'),(4,6,'discount','CK phí giao dịch',73,'2017-04-01 12:06:58','2017-05-16 10:08:52'),(5,7,'discount','CK phí giao dịch',72,'2017-04-01 14:17:26','2017-05-16 10:08:35'),(11,9,'transport','CK phí vận chuyển',70,'2017-05-04 20:16:59','2017-05-04 20:22:22'),(12,8,'transport','CK phí vận chuyển',71,'2017-05-04 20:17:07','2017-05-04 20:22:33'),(13,7,'transport','CK phí vận chuyển',72,'2017-05-04 20:17:33','2017-05-04 20:22:44'),(14,6,'transport','CK phí vận chuyển',73,'2017-05-04 20:17:45','2017-05-04 20:22:55'),(15,50,'deposit','Đặt cọc',70,'2017-05-04 20:18:39','2017-05-04 20:18:39'),(16,60,'deposit','Đặt cọc',71,'2017-05-04 20:18:47','2017-05-04 20:18:47'),(17,70,'deposit','Đặt cọc',72,'2017-05-04 20:19:00','2017-05-04 20:19:00'),(18,80,'deposit','Đặt cọc',73,'2017-05-04 20:19:09','2017-06-22 04:50:45');
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` char(50) COLLATE utf8_unicode_ci DEFAULT 'regular',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_lock` tinyint(1) NOT NULL DEFAULT '0',
  `activecode` char(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_handle_id` int(11) DEFAULT NULL,
  `device_token` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=383 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin','admin@usbgiahung.com','$2y$10$3wMEIuqrkYrqHNSEka0TGe5.NtzEgDHdYb.CuLYyLn/YB39gNrqHa','vn','admin','gold',1,0,'','btqSLIPIgLNUxEKRRTUzAduWbOzwQY','2020-02-14 07:09:27','0AaRg6BrpE8p6cUABkRDHcZeAKMXErcW8jQ63UxaqVEHuZargN3GhDHir021','2017-01-11 12:48:28','2020-02-14 00:09:27',0,NULL,NULL),(380,'Hoàng Mạnh Cường','hoangmanhcuong.hust@gmail.com','hoangmanhcuong.hust@gmail.com','$2y$10$7jSI50c8NmYNCgHkWSbCUugQsOzqBeMQoN.klTHjHtChqQVY6A4ta','vn','customer','regular',1,0,'0','mQzgCOiCM6vsnVRv4mBh3GBnctlios',NULL,'gqwoLOismPmEPxJ8rtTNij80LJhwOTEQGYAE2ov9ylZJSri2I7kr74EcHFa7','2020-02-13 20:58:46','2020-02-13 21:08:57',NULL,NULL,NULL),(381,'Lưu Văn Lâm','luuvanlam@gmail.com','luuvanlam@gmail.com','$2y$10$qfSlQYbLbx5kbxSEcYeV4eAGjlyFPWpUjrOQYJC4RWn7X.3vBQewy','vn','customer','regular',1,0,'0','UMrhH5NZmMKQbWErZzDklM9x3tblhc','2020-02-17 03:56:32','lRry6mVH0jpZMCANkPIltWvpQ01Jd7yMyTPcurnl0hzFQr7EcMLsjgdS7VyD','2020-02-16 20:49:54','2020-02-16 20:57:46',NULL,NULL,NULL),(382,'Đỗ Trung Đông','dotrungdong@gmail.com','dotrungdong@gmail.com','$2y$10$uh1o86qltoRuRB/MslGj1OjXM3MWL8XX4B.lipp.yNU1aYxtJEQc6','vn','customer','regular',1,0,'0','WexOUPPlAbEijK42liN6bjlyPij6dY',NULL,'ClCccrM4Cfp7W3TJnhWQnY9cahC7ad6FEWxRXSpyENZMtCbsooznx00LW9CV','2020-02-16 20:54:27','2020-02-16 20:56:20',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-26  8:27:31
