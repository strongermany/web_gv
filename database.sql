-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for lecturer
CREATE DATABASE IF NOT EXISTS `lecturer` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lecturer`;

-- Dumping structure for table lecturer.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `category_code` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '1' COMMENT 'Trạng thái: 1 - Hiển thị, 0 - Ẩn',
  `sort_order` int DEFAULT '0' COMMENT 'Thứ tự sắp xếp',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_code` (`category_code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table lecturer.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `instructor` varchar(100) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `discount` int DEFAULT '0',
  `discounted_price` decimal(10,2) DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT '0.00',
  `rating_count` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for function lecturer.remove_accents
DELIMITER //
CREATE FUNCTION `remove_accents`(str VARCHAR(255)) RETURNS varchar(255) CHARSET utf8mb4
    DETERMINISTIC
BEGIN
    SET str = LOWER(str);
    SET str = REPLACE(str, 'à', 'a');
    SET str = REPLACE(str, 'á', 'a');
    SET str = REPLACE(str, 'ả', 'a');
    SET str = REPLACE(str, 'ã', 'a');
    SET str = REPLACE(str, 'ạ', 'a');
    SET str = REPLACE(str, 'ă', 'a');
    SET str = REPLACE(str, 'ắ', 'a');
    SET str = REPLACE(str, 'ằ', 'a');
    SET str = REPLACE(str, 'ẳ', 'a');
    SET str = REPLACE(str, 'ẵ', 'a');
    SET str = REPLACE(str, 'ặ', 'a');
    SET str = REPLACE(str, 'â', 'a');
    SET str = REPLACE(str, 'ấ', 'a');
    SET str = REPLACE(str, 'ầ', 'a');
    SET str = REPLACE(str, 'ẩ', 'a');
    SET str = REPLACE(str, 'ẫ', 'a');
    SET str = REPLACE(str, 'ậ', 'a');

    SET str = REPLACE(str, 'è', 'e');
    SET str = REPLACE(str, 'é', 'e');
    SET str = REPLACE(str, 'ẻ', 'e');
    SET str = REPLACE(str, 'ẽ', 'e');
    SET str = REPLACE(str, 'ẹ', 'e');
    SET str = REPLACE(str, 'ê', 'e');
    SET str = REPLACE(str, 'ế', 'e');
    SET str = REPLACE(str, 'ề', 'e');
    SET str = REPLACE(str, 'ể', 'e');
    SET str = REPLACE(str, 'ễ', 'e');
    SET str = REPLACE(str, 'ệ', 'e');

    SET str = REPLACE(str, 'ì', 'i');
    SET str = REPLACE(str, 'í', 'i');
    SET str = REPLACE(str, 'ỉ', 'i');
    SET str = REPLACE(str, 'ĩ', 'i');
    SET str = REPLACE(str, 'ị', 'i');

    SET str = REPLACE(str, 'ò', 'o');
    SET str = REPLACE(str, 'ó', 'o');
    SET str = REPLACE(str, 'ỏ', 'o');
    SET str = REPLACE(str, 'õ', 'o');
    SET str = REPLACE(str, 'ọ', 'o');
    SET str = REPLACE(str, 'ô', 'o');
    SET str = REPLACE(str, 'ố', 'o');
    SET str = REPLACE(str, 'ồ', 'o');
    SET str = REPLACE(str, 'ổ', 'o');
    SET str = REPLACE(str, 'ỗ', 'o');
    SET str = REPLACE(str, 'ộ', 'o');
    SET str = REPLACE(str, 'ơ', 'o');
    SET str = REPLACE(str, 'ớ', 'o');
    SET str = REPLACE(str, 'ờ', 'o');
    SET str = REPLACE(str, 'ở', 'o');
    SET str = REPLACE(str, 'ỡ', 'o');
    SET str = REPLACE(str, 'ợ', 'o');

    SET str = REPLACE(str, 'ù', 'u');
    SET str = REPLACE(str, 'ú', 'u');
    SET str = REPLACE(str, 'ủ', 'u');
    SET str = REPLACE(str, 'ũ', 'u');
    SET str = REPLACE(str, 'ụ', 'u');
    SET str = REPLACE(str, 'ư', 'u');
    SET str = REPLACE(str, 'ứ', 'u');
    SET str = REPLACE(str, 'ừ', 'u');
    SET str = REPLACE(str, 'ử', 'u');
    SET str = REPLACE(str, 'ữ', 'u');
    SET str = REPLACE(str, 'ự', 'u');

    SET str = REPLACE(str, 'ỳ', 'y');
    SET str = REPLACE(str, 'ý', 'y');
    SET str = REPLACE(str, 'ỷ', 'y');
    SET str = REPLACE(str, 'ỹ', 'y');
    SET str = REPLACE(str, 'ỵ', 'y');

    SET str = REPLACE(str, 'đ', 'd');

    RETURN str;
END//
DELIMITER ;

-- Dumping structure for table lecturer.slider_items
CREATE TABLE IF NOT EXISTS `slider_items` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `image_url` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '1' COMMENT 'Trạng thái: 1 - Hiển thị, 0 - Ẩn',
  PRIMARY KEY (`item_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `slider_items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table lecturer.tbl_admin
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `Admin_Id` varchar(50) NOT NULL DEFAULT '',
  `Admin_name` varchar(200) NOT NULL DEFAULT '',
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Role` varchar(50) DEFAULT 'admin',
  `password` varchar(50) NOT NULL DEFAULT '0',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Last_login` timestamp NULL DEFAULT NULL,
  `Status` tinyint(1) DEFAULT '1' COMMENT '1: active, 0: inactive',
  `avatar` varchar(255) DEFAULT 'avatar.jpg',
  PRIMARY KEY (`Admin_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table lecturer.tbl_attendance
CREATE TABLE IF NOT EXISTS `tbl_attendance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Student_Id` varchar(50) NOT NULL,
  `Object_Id` varchar(50) NOT NULL,
  `Group_Id` varchar(50) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Date` date NOT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_attendance` (`Student_Id`,`Object_Id`,`Group_Id`,`Date`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table lecturer.tbl_group
CREATE TABLE IF NOT EXISTS `tbl_group` (
  `Group_Id` int NOT NULL AUTO_INCREMENT,
  `Name_group` varchar(50) NOT NULL,
  `Object_Id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`Group_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table lecturer.tbl_lession
CREATE TABLE IF NOT EXISTS `tbl_lession` (
  `Lession_Id` int NOT NULL AUTO_INCREMENT,
  `Name_ls` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Object_Id` int NOT NULL,
  `Name_object` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `File_Path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `File_Name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `File_Type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`Lession_Id`),
  KEY `Object_Id` (`Object_Id`),
  CONSTRAINT `tbl_lession_ibfk_1` FOREIGN KEY (`Object_Id`) REFERENCES `tbl_object` (`Object_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table lecturer.tbl_news
CREATE TABLE IF NOT EXISTS `tbl_news` (
  `news_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `image_url` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table lecturer.tbl_object
CREATE TABLE IF NOT EXISTS `tbl_object` (
  `Object_Id` int NOT NULL AUTO_INCREMENT,
  `Name_class` varchar(200) NOT NULL,
  `Shift_class` int NOT NULL,
  `Group_Id` int NOT NULL,
  PRIMARY KEY (`Object_Id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table lecturer.tbl_student
CREATE TABLE IF NOT EXISTS `tbl_student` (
  `Student_Id` int NOT NULL AUTO_INCREMENT,
  `Name_std` varchar(50) NOT NULL,
  `Status_std` varchar(50) NOT NULL,
  `Group_Id` int NOT NULL,
  `Generation` varchar(50) DEFAULT NULL,
  `Email_std` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Student_Id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=;

-- Data exporting was unselected.

-- Dumping structure for table lecturer.timetable
CREATE TABLE IF NOT EXISTS `timetable` (
  `id` int NOT NULL AUTO_INCREMENT,
  `thu` varchar(10) NOT NULL,
  `tiet` varchar(10) NOT NULL,
  `mon_hoc` varchar(100) NOT NULL,
  `lop` varchar(20) NOT NULL,
  `phong` varchar(20) NOT NULL,
  `bat_dau` time NOT NULL,
  `ket_thuc` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
