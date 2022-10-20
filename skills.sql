-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: h2a
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skillenglish` varchar(45) NOT NULL,
  `skillspanish` varchar(45) NOT NULL,
  `skilltype` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (1,'Chard','acelga','produce'),(2,'Avocado','aguacate','produce'),(3,'Artichoke','alcachofa','produce'),(4,'Alfalfa','alfalfa','produce'),(5,'Garlic','ajo','produce'),(6,'Celery','apio','produce'),(7,'Blueberry','arandano','produce'),(8,'Eggplant','berenjena','produce'),(9,'Beetroot','betabel','produce'),(10,'Broccoli','brocoli','produce'),(11,'Peanut','cacahuate','produce'),(12,'Coffee','cafe','produce'),(13,'Pumpkin','calabaza','produce'),(14,'Cane','cana','produce'),(15,'Onion','cebolla','produce'),(16,'Cherry','cereza','produce'),(17,'Apricot','chabacano','produce'),(18,'Pea','chicharo','produce'),(19,'Kale','col','produce'),(20,'Chili','chile','produce'),(21,'Cilantro','cilantro','produce'),(22,'Date','datil','produce'),(23,'Peach','durazno','produce'),(24,'Green bean','ejote','produce'),(25,'Corn','elote','produce'),(26,'Spinich','espinaca','produce'),(27,'Asparagus','esparrago','produce'),(28,'Strawberry','fresa','produce'),(29,'Bean','frijol','produce'),(30,'Broad beans','habas','produce'),(31,'Lemon','limon','produce'),(32,'Lechuga','lechuga','produce'),(33,'Orange','naranja','produce'),(34,'Apple','manzana','produce'),(35,'Cantaloupe','melon','produce'),(36,'Potato','papa','produce'),(37,'Pear','pera','produce'),(38,'Pineapple','pina','produce'),(39,'Cucumber','pepino','produce'),(40,'Radish','rabano','produce'),(41,'Cabbage','repollo','produce'),(42,'Tomato','tomate','produce'),(43,'Tomatillo','tomatillo','produce'),(44,'Watermelon','sandia','produce'),(45,'Carrot','zanahoria','produce'),(46,'Greenhouse','Invernaderos','ability'),(47,'Irrigation','Sistema de Riego','ability'),(48,'Farm','Alguna Granja','ability'),(49,'Machinery','Maquinaria Agrícola','ability'),(50,'Mechanics','Mecanica','ability'),(51,'Welding','Soldadura','ability'),(52,'Truck & trailer','Troque y Tráiler','ability'),(53,'Tractor','Tractor','ability'),(54,'Forklift','Montacargas','ability'),(55,'Electrical','Electricidad','ability'),(56,'English','Ingles','ability'),(57,'Other crops','Otros cultivos','produce');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-19 14:47:23
