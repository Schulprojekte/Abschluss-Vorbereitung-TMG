-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: schulwebsite
-- ------------------------------------------------------
-- Server version	8.0.28

--
-- Table structure for table `articles`
--
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` varchar(64) DEFAULT NULL,
	`description` text,
	`price` double DEFAULT NULL,
	`img` varchar(64) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `articles`
--
LOCK TABLES `articles` WRITE;
INSERT INTO `articles` VALUES
	(1,'Buch','Ein Buch aus sehr hochwertigem Papier.',9.99,'buch.jpg'),
	(2,'Radiergummi','Ein Radiergummi welches sehr alt ist.',5.99,'radierer.png'),
	(3,'Lineal ','Ein Lineal. Kein Zollstock...',2.8,'lineal.png'),
	(4,'Bleistift','Aus echtem Blei. Wiegt 50 KG.',50,'bleistift.png');
UNLOCK TABLES;

--
-- Table structure for table `besucher`
--
DROP TABLE IF EXISTS `besucher`;
CREATE TABLE `besucher` (
	`besucherzahl` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `besucher`
--
LOCK TABLES `besucher` WRITE;
INSERT INTO `besucher` VALUES (11);
UNLOCK TABLES;

--
-- Table structure for table `loginsystem`
--
DROP TABLE IF EXISTS `loginsystem`;
CREATE TABLE `loginsystem` (
	`id` int NOT NULL AUTO_INCREMENT,
	`username` varchar(64) DEFAULT NULL,
	`pwhash` varchar(64) DEFAULT NULL,
	`mitarbeiter` tinyint(1) DEFAULT NULL,
	`article` int DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `loginsystem`
--
LOCK TABLES `loginsystem` WRITE;
INSERT INTO `loginsystem` VALUES
	(1,'admin','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',1,3),
	(2,'manager','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',1,2),
	(3,'testuser','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',0,NULL),
	(4,'mitarbeiter','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',1,1),
	(5,'mitarbeiter2','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',1,4);
UNLOCK TABLES;

--
-- Table structure for table `messagesystem`
--
DROP TABLE IF EXISTS `messagesystem`;
CREATE TABLE `messagesystem` (
	`id` int NOT NULL AUTO_INCREMENT,
	`ownerid` int DEFAULT NULL,
	`senderid` int DEFAULT NULL,
	`msgtext` text,
	`unixtime` int DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `messagesystem`
--
LOCK TABLES `messagesystem` WRITE;
INSERT INTO `messagesystem` VALUES
	(1,2,1,'Testnachricht',1649360979),
	(2,2,1,'Testnachricht',1649361176),
	(3,3,1,'Testnachricht',1649361181),
	(4,1,2,'Testnachricht',1649361427),
	(5,1,2,'Testnachricht',1649361439),
	(6,1,2,'Testnachricht',1649361574),
	(7,1,2,'Testnachricht',1649361574),
	(8,1,2,'Testnachricht',1649361575),
	(9,1,2,'Testnachricht',1649361616),
	(10,1,2,'Testnachricht',1649361678),
	(11,1,2,'Testnachricht',1649361678),
	(12,1,2,'Testnachricht',1649361678),
	(13,1,2,'Testnachricht',1649361679),
	(14,1,2,'Testnachricht',1649361785),
	(15,4,0,'Es ist eine Bestellung eingegangen: ID: 1, Artikelname: Buch f├╝r 9.99Ôé¼ Datum: 07.04.2022 | 23:00\n',1649365202);
UNLOCK TABLES;

-- Dump completed on 2022-04-07 23:08:49
