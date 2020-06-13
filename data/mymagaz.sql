-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: mymagaz
-- ------------------------------------------------------
-- Server version	5.5.62

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3438 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Женское белье',0),(2,'Купальники',0),(4,'Комплекты белья',1),(5,'Бюстгальтеры',1),(6,'Балконет',5),(7,'Push up',5),(8,'Уплотнённая чашка',5),(9,'Мягкая чашка',5),(10,'Трусики',1),(11,'Беременным',10),(12,'Стринги',10),(13,'Шортики',10),(14,'Cлипы',10),(15,'Кофточки, блузки, свитера',19),(18,'Пояса, подвязки',1),(19,'Женская одежда',0),(20,'Боди, корсеты',1),(22,'Корсеты, бюстье, корсажи',1),(24,'Купальники раздельные',2),(25,'Купальники слитные',2),(27,'Home',0),(28,'Men',0),(29,'Women',0),(30,'Kids',0),(31,'Shoes',28),(32,'Clothing',28),(33,'Accessories',28),(34,'Brand',28),(35,'All Shoes',31),(36,'Running',31),(37,'Training & Gym',31),(38,'Compression & Nike Pro',32),(39,'Tops & T-Shirts',32),(40,'Compression & Nike Pro',33),(41,'Tops & T-Shirts',33),(42,'Невидимка',5),(43,'Hoodies & Sweatshirts',33),(44,'Basketball',31),(45,'Бретельки, вкладыши',1),(47,'News',0),(48,'Contact',0),(49,'Contact Us #1',48),(50,'Contact Us #2',48),(51,'Blog-grid',47),(52,'Blog List',47),(55,'Homepage #1',27),(56,'Homepage #2',27),(57,'Homepage #3',27),(58,'NIKE',34),(59,'Adidas',34),(66,'sdaf',57),(67,'34342234afdsfafads',57),(90,'Корректирующее белье',1),(95,'Соблазнительное белье',1),(130,'Пижамы, костюмы',160),(132,'Сорочки, пеньюары',160),(133,'Халаты, накидки',160),(134,'Майки, футболки, топы',19),(135,'Тапочки для дома',160),(136,'Бразилианы',10),(139,'Спортивное',1),(157,'Push up двойной',5),(158,'Платья, туники, юбки',19),(159,'Костюмы ,брюки, шорты',19),(160,'Домашняя одежда',19),(161,'Верхняя одежда',19),(163,'Для пляжа',0),(174,'Верх купальника',2),(175,'Плавки',2),(181,'(OLD)_Комбидресс',1),(3007,'Шапки, шарфы, куртки',19),(3025,'Маски защитные',19),(3026,'Юбки',19),(3041,'(OLD)_Майки, футболки, кофточки',160),(3043,'Купальники монокини',2),(3048,'(OLD)_Термобельё',19),(3052,'Термобельё',1),(3101,'Свадебные платья и аксессуары',19),(3103,'Комплекты белья',3101),(3104,'Красивые бретели',3101),(3105,'Пояса, подвязки',3101),(3106,'Чулки',3101),(3107,'Пеньюары и халатики',3101),(3112,'Спортивная одежда',19),(3119,'Тапочки',19),(3120,'Купальники танкини',2),(3181,'(OLD)_Майка и трусики',1),(3390,'Аксессуары',19),(3391,'Кошельки и клатчи',3390),(3392,'Сумки и рюкзаки',3390),(3393,'Чемоданы',3390),(3437,'Яркие принты',10);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colours`
--

DROP TABLE IF EXISTS `colours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colours` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `colour` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colours`
--

LOCK TABLES `colours` WRITE;
/*!40000 ALTER TABLE `colours` DISABLE KEYS */;
INSERT INTO `colours` VALUES (1,'black'),(2,'red'),(3,'brown'),(4,'blue');
/*!40000 ALTER TABLE `colours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_category` (
  `product_id` smallint(5) unsigned NOT NULL,
  `category_id` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
INSERT INTO `product_category` VALUES (9,1),(9,2),(10,3),(11,1),(11,2),(12,1),(12,2),(12,3),(13,1),(13,2),(14,4);
/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_colour_quantity`
--

DROP TABLE IF EXISTS `product_colour_quantity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_colour_quantity` (
  `product_id` smallint(5) unsigned NOT NULL,
  `colour_id` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_colour_quantity`
--

LOCK TABLES `product_colour_quantity` WRITE;
/*!40000 ALTER TABLE `product_colour_quantity` DISABLE KEYS */;
INSERT INTO `product_colour_quantity` VALUES (9,1),(9,2),(10,3),(11,1),(11,2),(11,3),(12,1),(12,2),(12,3),(13,1),(13,2),(13,3),(14,2);
/*!40000 ALTER TABLE `product_colour_quantity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Товары';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (9,'chair','cougar','150-60-60','the best of chairs','a:1:{i:0;s:18:\"5ed3574281af60.png\";}'),(10,'sofa','kall','110-220-80','Shmat kalla','a:1:{i:0;s:18:\"5ed357a7d94830.png\";}'),(11,'king','dx-racer','150-80-80','king size dx-racer','a:3:{i:0;s:18:\"5ed3582258dd80.png\";i:1;s:18:\"5ed3582258dd81.png\";i:2;s:18:\"5ed35822591c02.png\";}'),(12,'вапр','пвар','вапр','впра','a:3:{i:0;s:18:\"5ed3eea43a0cf0.png\";i:1;s:18:\"5ed3eea43a0cf1.png\";i:2;s:18:\"5ed3eea43a4b72.png\";}'),(13,'aaaa','aaaaa','aaaaa','aaaa','a:1:{i:0;s:18:\"5ed3f097944690.png\";}'),(14,'dfghf','ghfghf','gdhfgd','hfgdh','a:1:{i:0;s:18:\"5ed3f0b4ef4310.png\";}');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_user`
--

DROP TABLE IF EXISTS `session_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_user` (
  `user_id` int(10) DEFAULT NULL,
  `session_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `session_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_user`
--

LOCK TABLES `session_user` WRITE;
/*!40000 ALTER TABLE `session_user` DISABLE KEYS */;
INSERT INTO `session_user` VALUES (4,'usiss1iv0osr1hu967bfssldl3');
/*!40000 ALTER TABLE `session_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_user_test`
--

DROP TABLE IF EXISTS `session_user_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_user_test` (
  `user_id` int(10) DEFAULT NULL,
  `session_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `session_user_test_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `test` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_user_test`
--

LOCK TABLES `session_user_test` WRITE;
/*!40000 ALTER TABLE `session_user_test` DISABLE KEYS */;
INSERT INTO `session_user_test` VALUES (1,'783eudd3dtvsn3dh2mtsp5i483'),(2,'kh7m7k02boahk0st8nlnjfvv37'),(3,'kh7m7k02boahk0st8nlnjfvv37');
/*!40000 ALTER TABLE `session_user_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (1,'admin@mymagaz.local','admin','admin'),(2,'user@mymagaz.local','user','user'),(3,'test@mymagaz.local','test','test');
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `top_menu`
--

DROP TABLE IF EXISTS `top_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `top_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `top_menu`
--

LOCK TABLES `top_menu` WRITE;
/*!40000 ALTER TABLE `top_menu` DISABLE KEYS */;
INSERT INTO `top_menu` VALUES (1,20),(2,NULL),(3,NULL),(4,2),(5,28);
/*!40000 ALTER TABLE `top_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (0,'admin@mymagaz.local','admin','admin'),(1,'user@mymagaz.local','user','user'),(2,'guest@mymagaz.local','guest','guest'),(3,'test@mymagaz.local','test','test'),(4,'vasa','jopa','pupkin'),(5,'vasa','jopa','pupkin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@mymagaz.local','admin','admin'),(2,'user@mymagaz.local','user','user'),(3,'guest@mymagaz.local','guest','guest'),(4,'test@mymagaz.local','test','test');
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

-- Dump completed on 2020-06-13 18:23:27
