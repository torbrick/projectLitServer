-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: lit_schema
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

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
-- Table structure for table `light_strip`
--

DROP TABLE IF EXISTS `light_strip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `light_strip` (
  `light_strip_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `num_lights` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`light_strip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `light_strip`
--

LOCK TABLES `light_strip` WRITE;
/*!40000 ALTER TABLE `light_strip` DISABLE KEYS */;
INSERT INTO `light_strip` VALUES (1,'light strip one',5),(2,'light strip two',15),(3,'light strip three',30),(4,'light strip four',60);
/*!40000 ALTER TABLE `light_strip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lights`
--

DROP TABLE IF EXISTS `lights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lights` (
  `light_id` int(11) NOT NULL AUTO_INCREMENT,
  `light_strip_owner` int(11) DEFAULT NULL,
  `state` tinyint(1) DEFAULT 0,
  `red` smallint(6) DEFAULT 0,
  `green` smallint(6) DEFAULT 128,
  `blue` smallint(6) DEFAULT 255,
  PRIMARY KEY (`light_id`),
  KEY `lights_ibfk_1` (`light_strip_owner`),
  CONSTRAINT `lights_ibfk_1` FOREIGN KEY (`light_strip_owner`) REFERENCES `light_strip` (`light_strip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lights`
--

LOCK TABLES `lights` WRITE;
/*!40000 ALTER TABLE `lights` DISABLE KEYS */;
INSERT INTO `lights` VALUES (1,1,0,0,128,255),(2,1,0,0,128,255),(3,1,0,0,128,255),(4,1,0,0,128,255),(5,1,0,0,128,255),(6,2,0,0,128,255),(7,2,0,0,128,255),(8,2,0,0,128,255),(9,2,0,0,128,255),(10,2,0,0,128,255),(11,2,0,0,128,255),(12,2,0,0,128,255),(13,2,0,0,128,255),(14,2,0,0,128,255),(15,2,0,0,128,255),(16,2,0,0,128,255),(17,2,0,0,128,255),(18,2,0,0,128,255),(19,2,0,0,128,255),(20,2,0,0,128,255),(21,3,0,0,128,255),(22,3,0,0,128,255),(23,3,0,0,128,255),(24,3,0,0,128,255),(25,3,0,0,128,255),(26,3,0,0,128,255),(27,3,0,0,128,255),(28,3,0,0,128,255),(29,3,0,0,128,255),(30,3,0,0,128,255),(31,3,0,0,128,255),(32,3,0,0,128,255),(33,3,0,0,128,255),(34,3,0,0,128,255),(35,3,0,0,128,255),(36,3,0,0,128,255),(37,3,0,0,128,255),(38,3,0,0,128,255),(39,3,0,0,128,255),(40,3,0,0,128,255),(41,3,0,0,128,255),(42,3,0,0,128,255),(43,3,0,0,128,255),(44,3,0,0,128,255),(45,3,0,0,128,255),(46,3,0,0,128,255),(47,3,0,0,128,255),(48,3,0,0,128,255),(49,3,0,0,128,255),(50,3,0,0,128,255),(141,4,0,0,128,255),(142,4,0,0,128,255),(143,4,0,0,128,255),(144,4,0,0,128,255),(145,4,0,0,128,255),(146,4,0,0,128,255),(147,4,0,0,128,255),(148,4,0,0,128,255),(149,4,0,0,128,255),(150,4,0,0,128,255),(151,4,0,0,128,255),(152,4,0,0,128,255),(153,4,0,0,128,255),(154,4,0,0,128,255),(155,4,0,0,128,255),(156,4,0,0,128,255),(157,4,0,0,128,255),(158,4,0,0,128,255),(159,4,0,0,128,255),(160,4,0,0,128,255),(161,4,0,0,128,255),(162,4,0,0,128,255),(163,4,0,0,128,255),(164,4,0,0,128,255),(165,4,0,0,128,255),(166,4,0,0,128,255),(167,4,0,0,128,255),(168,4,0,0,128,255),(169,4,0,0,128,255),(170,4,0,0,128,255),(171,4,0,0,128,255),(172,4,0,0,128,255),(173,4,0,0,128,255),(174,4,0,0,128,255),(175,4,0,0,128,255),(176,4,0,0,128,255),(177,4,0,0,128,255),(178,4,0,0,128,255),(179,4,0,0,128,255),(180,4,0,0,128,255),(181,4,0,0,128,255),(182,4,0,0,128,255),(183,4,0,0,128,255),(184,4,0,0,128,255),(185,4,0,0,128,255),(186,4,0,0,128,255),(187,4,0,0,128,255),(188,4,0,0,128,255),(189,4,0,0,128,255),(190,4,0,0,128,255),(191,4,0,0,128,255),(192,4,0,0,128,255),(193,4,0,0,128,255),(194,4,0,0,128,255),(195,4,0,0,128,255),(196,4,0,0,128,255),(197,4,0,0,128,255),(198,4,0,0,128,255),(199,4,0,0,128,255),(200,4,0,0,128,255);
/*!40000 ALTER TABLE `lights` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-08 17:31:41
