-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: php_test
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'Иванов Артем Сергеевич','author1.jpg'),(2,'Петров Иван Алексеевич','author2.jpg'),(3,'Иванов Иван Иванович','author3.jpg'),(4,'Петрова Александра Сергеевна','author4.jpg'),(5,'Иванов Станислав','author5.jpg'),(6,'Григарчук Елизавета Андреевна','author6.jpg');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 DEFAULT NULL,
  `parentId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Общая категория',1),(2,'Финансы',1),(3,'Авто',1),(4,'Технологии',1),(5,'Недвижимость',1),(6,'Цены',2),(7,'Как заработать',2),(8,'Аварии',3),(9,'Электромобили',3),(10,'IT',4),(11,'Гаджеты',4),(12,'Новые места',5),(13,'Архитектура',5);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publication`
--

DROP TABLE IF EXISTS `publication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(15) NOT NULL,
  `text` longtext DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `authorsId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publication`
--

LOCK TABLES `publication` WRITE;
/*!40000 ALTER TABLE `publication` DISABLE KEYS */;
INSERT INTO `publication` VALUES (1,'Снос особняка','В американском городе Ноксвилл решили снести огромный особняк, который считается крупнейшим частным домом всего штата Теннесси. В здании общей площадью 3700 кв. м насчитывается целых 86 комнат, включая собственный винный погреб и кинотеатр, но его новый владелец решил от него избавиться, посчитав, что выгоднее будет отдать участок под новую застройку','2022-04-22 17:00:00','img1.jpg',1),(2,'Новый объект','На выходных в Центральном ботаническом саду появился новый исторический объект — стоянка первобытного человека. А точнее, ее реконструкция. Об этом на своей странице в Facebook рассказал Вадим Лакиза, директор Института истории НАН Беларуси. Возможно, это станет началом скансена — музея под открытым небом. О его создании ученый говорил еще пару лет назад.','2022-04-22 17:01:00','img2.jpg',2),(3,'iPhone','Думаю, что настоящий полноэкранный iPhone появится в 2024 году. Старшие модели iPhone в 2024 году будут использовать фронтальные камеры, установленные под дисплеем, а также подэкранные Face ID','2022-04-22 17:05:00','img3.jpg',3),(4,'Аренда пауэрбэн','Белорусский стартап Сhargex решил попробовать себя на ниве аренды. В аренду ребята собираются сдавать пауэрбанки. Решение рассчитано на посетителей кофеен, ресторанов, фитнес-клубов и прочих заведений. Создатели сервиса считают, что помогут белорусам решить проблему разряжающихся в самый неподходящий момент телефонов.','2022-04-23 06:10:00','img4.jpg',1),(5,'Дрифт МАЗа','Вчера вечером на перекрестке в Новополоцке произошло столкновение двух автомобилей. Момент столкновения попал на видео. Судя по записи, легковушка поворачивала налево и не пропустила встречный МАЗ. В результате удара грузовик занесло и развернуло.','2022-04-23 06:25:00','img5.jpg',1),(6,'Будущее','В этом году линейка BMW Group пополнится несколькими электрическими моделями: к уже существующим электрокарам i4, iX и Mini Cooper SE добавятся батарейные версии третьей и пятой серии, кроссоверов X1 и X3, а также «семерки» нового поколения.','2022-04-23 07:00:00','img6.jpg',1),(7,'Склады','По данным на 1 апреля, объем складских запасов в Беларуси в денежном выражении превысил 6,72 млрд рублей ($2,43 млрд). На это обратил внимание cайт Banki24.by.\nДанными от флагманов белорусской промышленности регулярно делится Белстат. На сайте представлена статистика с 2019 года. Судя по таблице, так много складских запасов в денежном выражении за последние годы в Беларуси еще не было.','2022-04-23 08:00:00','img7.jpg',2),(8,'Облигации','Евроторг («Евроопт», «Хит!» и «Грошык») выпустил валютные облигации. Размещение облигаций начнется 20 апреля. Среди валютных облигаций, выпущенных в этом году, они дают самый высокий процент. На 2 пункта больше, чем самый аппетитный депозит.','2022-04-23 08:30:00','img8.jpg',3);
/*!40000 ALTER TABLE `publication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publication_category`
--

DROP TABLE IF EXISTS `publication_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publication_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publicationId` int(11) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publication_category`
--

LOCK TABLES `publication_category` WRITE;
/*!40000 ALTER TABLE `publication_category` DISABLE KEYS */;
INSERT INTO `publication_category` VALUES (1,1,13),(2,2,12),(3,3,10),(4,4,11),(5,5,8),(6,6,9),(7,7,6),(8,8,7),(9,1,5),(10,7,7);
/*!40000 ALTER TABLE `publication_category` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-24 16:31:07
