SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `ProjectDB` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ProjectDB`;

--
-- Table structure for table `customer`
--
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `cname` varchar(255) CHARACTER SET utf8mb3 NOT NULL,
  `cpassword` varchar(255) CHARACTER SET utf8mb3 NOT NULL,
  `ctel` int DEFAULT NULL,
  `caddr` text CHARACTER SET utf8mb3,
  `company` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--
LOCK TABLES `customer` WRITE;
INSERT INTO `customer` VALUES (1,'Alex Wong','itp4235m',21232123,'G/F, ABC Building, King Yip Street, KwunTong, Kowloon, Hong Kong','Fat Cat Company Limited'),(2,'Tina Chan','itp4235m',31233123,'303, Mei Hing Center, Yuen Long, NT, Hong Kong','XDD LOL Company'),(3,'Bowie','itp4235m',61236123,'401, Sing Kei Building, Kowloon, Hong Kong','GPA4 Company');
UNLOCK TABLES;

--
-- Table structure for table `material`
--
DROP TABLE IF EXISTS `material`;
CREATE TABLE `material` (
  `mid` int NOT NULL AUTO_INCREMENT,
  `mname` varchar(255) CHARACTER SET utf8mb3 NOT NULL,
  `mqty` int NOT NULL,
  `mrqty` int NOT NULL,
  `munit` varchar(20) CHARACTER SET utf8mb3 NOT NULL,
  `mreorderqty` int NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material`
--
LOCK TABLES `material` WRITE;
INSERT INTO `material` VALUES (1,'Rubber 3233',1000,0,'KG',200),(2,'Cotten CDC24',2000,200,'KG',400),(3,'Wood RAW77',5000,0,'KG',1000),(4,'ABS LL Chem 5026',2000,200,'KG',400),(5,'4 x 1 Flat Head Stainless Steel Screws',50000,2400,'PC',20000);
UNLOCK TABLES;

--
-- Table structure for table `product`
--
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `pname` varchar(255) CHARACTER SET utf8mb3 NOT NULL,
  `pdesc` text CHARACTER SET utf8mb3,
  `pcost` decimal(12,2) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--
LOCK TABLES `product` WRITE;
INSERT INTO `product` VALUES (1,'Cyberpunk Truck C204','Explore the world of imaginative play with our vibrant and durable toy truck. Perfect for little hands, this truck will inspire endless storytelling adventures both indoors and outdoors. Made from high-quality materials, it is built to withstand hours of creative playtime.',19.90),(2,'XDD Wooden Plane','Take to the skies with our charming wooden plane toy. Crafted from eco-friendly and child-safe materials, this beautifully designed plane sparks the imagination and encourages interactive play. With smooth edges and a sturdy construction, it\'s a delightful addition to any young aviator\'s toy collection.',9.90),(3,'iRobot 3233GG','Introduce your child to the wonders of technology and robotics with our smart robot companion. Packed with interactive features and educational benefits, this futuristic toy engages curious minds and promotes STEM learning in a fun and engaging way. Watch as your child explores coding, problem-solving, and innovation with this cutting-edge robot friend.',249.90),(4,'Apex Ball Ball Helicopter M1297','Experience the thrill of flight with our ball helicopter toy. Easy to launch and navigate, this exciting toy provides hours of entertainment for children of all ages. With colorful LED lights and a durable design, it\'s a fantastic outdoor toy that brings joy and excitement to playtime.',30.00),(5,'RoboKat AI Cat Robot','Meet our AI Cat Robot – the purr-fect blend of technology and cuddly companionship. This interactive robotic feline offers lifelike movements, sounds, and responses, providing a realistic pet experience without the hassle. With customizable features and playful interactions, this charming cat robot is a delightful addition to your child\'s playroom.',499.00);
UNLOCK TABLES;


--
-- Table structure for table `orders`
--
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `oid` int NOT NULL AUTO_INCREMENT,
  `odate` datetime NOT NULL,
  `pid` int NOT NULL,
  `oqty` int NOT NULL,
  `ocost` decimal(20,2) NOT NULL,
  `cid` int NOT NULL,
  `odeliverdate` datetime DEFAULT NULL,
  `ostatus` int NOT NULL,
  PRIMARY KEY (`oid`),
  KEY `pid_PK_idx` (`pid`),
  KEY `cid_pk_idx` (`cid`),
  CONSTRAINT `cid_pk` FOREIGN KEY (`cid`) REFERENCES `customer` (`cid`),
  CONSTRAINT `pid_pk` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--
LOCK TABLES `orders` WRITE;
INSERT INTO `orders` VALUES (1,'2025-04-12 17:50:00',1,200,3980.00,1,NULL,1),(2,'2025-04-13 12:01:00',5,200,99800.00,2,'2025-06-22 12:30:00',3);
UNLOCK TABLES;

--
-- Table structure for table `prodmat`
--
DROP TABLE IF EXISTS `prodmat`;
CREATE TABLE `prodmat` (
  `pid` int NOT NULL,
  `mid` int NOT NULL,
  `pmqty` int DEFAULT NULL,
  PRIMARY KEY (`pid`,`mid`),
  KEY `mid_fk_idx` (`mid`),
  CONSTRAINT `mid_fk` FOREIGN KEY (`mid`) REFERENCES `material` (`mid`),
  CONSTRAINT `pid_fk` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodmat`
--
LOCK TABLES `prodmat` WRITE;
INSERT INTO `prodmat` VALUES (1,4,1),(1,5,6),(2,3,1),(2,5,4),(3,4,1),(3,5,12),(4,4,1),(4,5,8),(5,2,1),(5,5,6);
UNLOCK TABLES;

--
-- Table structure for table `staff`
--
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `spassword` varchar(255) CHARACTER SET utf8mb3 NOT NULL,
  `sname` varchar(255) CHARACTER SET utf8mb3 NOT NULL,
  `srole` varchar(45) CHARACTER SET utf8mb3 DEFAULT NULL,
  `stel` int DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--
LOCK TABLES `staff` WRITE;
INSERT INTO `staff` VALUES (1,'itp4523m','Hachi Leung','admin',25669197);
UNLOCK TABLES;
