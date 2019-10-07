-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: AqNoteApi
-- ------------------------------------------------------
-- Server version	8.0.13

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `idCO` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `titleC` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `like` enum('0','1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `note_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`idCO`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_note_id_foreign` (`note_id`),
  CONSTRAINT `comments_note_id_foreign` FOREIGN KEY (`note_id`) REFERENCES `notes` (`idn`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`idu`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',10,8),(2,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',11,8),(3,NULL,NULL,'Inutili','...','2',12,8),(4,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',13,12),(5,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',11,12),(6,NULL,NULL,'Inutili','...','2',12,12),(7,NULL,NULL,'Utilissimo','Grazie ad essi sono riuscito a prendere 30','4',15,21),(8,NULL,NULL,'Buoni','Li ho trovati utili, ma si trova di meglio','3',12,21),(9,NULL,NULL,'Discreti','Nulla di che...','3',17,21),(10,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',10,25),(11,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',11,25),(12,NULL,NULL,'Inutili','...','2',12,25),(13,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',13,28),(14,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',11,28),(15,NULL,NULL,'Inutili','...','2',12,28),(16,NULL,NULL,'Utilissimo','Grazie ad essi sono riuscito a prendere 30','4',15,37),(17,NULL,NULL,'Buoni','Li ho trovati utili, ma si trova di meglio','3',12,37),(18,NULL,NULL,'Discreti','Nulla di che...','3',17,37),(19,NULL,NULL,'Proprio quello che cercavo','Grazie, fatti bene, leggibili','5',14,55),(20,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',10,55),(21,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',11,55),(22,NULL,NULL,'Inutili','...','2',12,9),(23,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',13,13),(24,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',11,13),(25,NULL,NULL,'Inutili','...','2',12,13),(26,NULL,NULL,'Utilissimo','Grazie ad essi sono riuscito a prendere 30','4',15,22),(27,NULL,NULL,'Buoni','Li ho trovati utili, ma si trova di meglio','3',12,22),(28,NULL,NULL,'Discreti','Nulla di che...','3',17,22),(29,NULL,NULL,'Proprio quello che cercavo','Grazie, fatti bene, leggibili','5',14,26),(30,NULL,NULL,'Inutli','Non c\'e altro da aggiungere...','1',10,38),(31,NULL,NULL,'Inutli','Non c\'e altro da aggiungere...','1',11,38),(32,NULL,NULL,'Inutli','Non c\'e altro da aggiungere...','1',12,38),(33,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',13,47),(34,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',11,47),(35,NULL,NULL,'Inutili','...','2',12,47),(36,NULL,NULL,'Utilissimo','Grazie ad essi sono riuscito a prendere 30','4',15,56),(37,NULL,NULL,'Buoni','Li ho trovati utili, ma si trova di meglio','3',12,56),(38,NULL,NULL,'Discreti','Nulla di che...','3',16,56),(39,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',13,47),(40,NULL,NULL,'Appunti inutli','Non sono serviti a nulla','1',11,47),(41,NULL,NULL,'Inutili','...','2',12,47),(42,NULL,NULL,'Utilissimo','Grazie ad essi sono riuscito a prendere 30','4',15,56),(43,NULL,NULL,'Buoni','Li ho trovati utili, ma si trova di meglio','3',12,56),(44,NULL,NULL,'Discreti','Nulla di che...','3',16,56);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `degree_courses`
--

DROP TABLE IF EXISTS `degree_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `degree_courses` (
  `idDC` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nameDC` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`idDC`),
  KEY `degree_courses_department_id_foreign` (`department_id`),
  CONSTRAINT `degree_courses_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`idd`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `degree_courses`
--

LOCK TABLES `degree_courses` WRITE;
/*!40000 ALTER TABLE `degree_courses` DISABLE KEYS */;
INSERT INTO `degree_courses` VALUES (17,NULL,NULL,'informatica',6),(18,NULL,NULL,'matematica',6),(19,NULL,NULL,'Ingegneria dell\'informazione',6);
/*!40000 ALTER TABLE `degree_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `idD` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nameD` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idD`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (5,'mesva'),(6,'disim'),(7,'diie');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favourites`
--

DROP TABLE IF EXISTS `favourites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favourites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `note_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `favourites_user_id_foreign` (`user_id`),
  KEY `favourites_note_id_foreign` (`note_id`),
  CONSTRAINT `favourites_note_id_foreign` FOREIGN KEY (`note_id`) REFERENCES `notes` (`idn`) ON DELETE CASCADE,
  CONSTRAINT `favourites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`idu`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favourites`
--

LOCK TABLES `favourites` WRITE;
/*!40000 ALTER TABLE `favourites` DISABLE KEYS */;
INSERT INTO `favourites` VALUES (37,NULL,NULL,10,8),(38,NULL,NULL,10,9),(39,NULL,NULL,10,10),(40,NULL,NULL,10,21),(41,NULL,NULL,10,25),(42,NULL,NULL,10,46),(43,NULL,NULL,10,47),(44,NULL,NULL,11,60),(45,NULL,NULL,11,61),(46,NULL,NULL,11,62),(47,NULL,NULL,11,55),(48,NULL,NULL,11,59),(49,NULL,NULL,12,38),(50,NULL,NULL,12,24),(51,NULL,NULL,12,13),(52,NULL,NULL,13,21),(53,NULL,NULL,13,23),(54,NULL,NULL,13,49),(55,NULL,NULL,14,9),(56,NULL,NULL,14,29),(57,NULL,NULL,14,38),(58,NULL,NULL,15,55),(59,NULL,NULL,15,57),(60,NULL,NULL,15,38),(61,NULL,NULL,15,37),(62,NULL,NULL,15,54),(63,NULL,NULL,16,62),(64,NULL,NULL,16,25),(65,NULL,NULL,16,29),(66,NULL,NULL,16,9),(67,NULL,NULL,17,9),(68,NULL,NULL,17,10),(69,NULL,NULL,17,11),(70,NULL,NULL,17,24),(71,NULL,NULL,17,28),(72,NULL,NULL,17,62);
/*!40000 ALTER TABLE `favourites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_05_30_120110_create_users_table',1),(2,'2019_05_30_120213_create_notes_table',1),(3,'2019_05_30_120420_create_photos_table',1),(4,'2019_05_30_120505_create_comments_table',1),(5,'2019_05_30_120700_create_departments_table',1),(6,'2019_05_30_133100_create_degree_courses_table',1),(7,'2019_05_30_134427_create_subjects_table',1),(8,'2019_06_22_150725_drop_field_name_s_subjects_table',1),(9,'2019_06_22_150756_add_field_name_s_subjects_table',1),(10,'2019_06_22_151231_modify_field_year_subjects_table',1),(11,'2019_06_22_152650_modify_table_notes',1),(12,'2019_06_22_153000_add_foreign_key_degree_courses_table_notes',1),(13,'2019_06_28_222112_drop_foreign_key_degree_course_table_notes',1),(14,'2019_06_28_225353_add_foreign_key_subjects_table_notes',1),(15,'2019_07_26_142947_create_favourites_table',2),(16,'2019_07_31_145137_add_cdl_to_users_table',3),(17,'2019_08_22_200405_remove_matriculation_number_from_users_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `idN` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `subject_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`idN`),
  KEY `notes_user_id_foreign` (`user_id`),
  KEY `notes_subject_id_foreign` (`subject_id`),
  CONSTRAINT `notes_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`idu`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (8,NULL,NULL,'appunti di fondamenti','Presi seguendo le lezioni, grazie ad essi ho preso 30',10,11),(9,NULL,NULL,'Riassunti delle slide','Ho rielaborato le slide con le lezioni',11,11),(10,NULL,NULL,'Fondamenti','grazie ad essi ho presi 28',12,11),(11,NULL,NULL,'Esercizi svolti di fondamenti','Ci sono un po\' di esercizi dei compiti con le varie soluzioni',13,11),(12,NULL,NULL,'Appunti di architettura degli elaboratori','Appunti presi a lezione',10,12),(13,NULL,NULL,'Riassunto del libro di architettura','Ho fatto il riassunto del libro, non manca nulla',11,12),(14,NULL,NULL,'Esercizi svolti degli esami','Ci sono esercizi svolti con le soluzioni',12,12),(21,NULL,NULL,'Analisi 1','Spiegazione dettagliata di alcuni dei teoremi più difficili',10,13),(22,NULL,NULL,'Formulario di analisi 1','Formulario con spiegazione delle varie formule e di come si svolgono determinati esercizi',11,13),(23,NULL,NULL,'Esercizi svolti','Esercizi svolti di analisi 1, con spiegazione alla fine e risulati',12,13),(24,NULL,NULL,'Compiti precedenti','esami vecchi con soluzioni, gli esami sono sempre uguali',13,13),(25,NULL,NULL,'Spiegazioni di mips e m68k','l\'assembly è il male, perciò ho fatto questa guida',10,14),(26,NULL,NULL,'Lae, esercizi con il C','Esercizi svolti di C',11,14),(27,NULL,NULL,'esami vecchi','esami vecchi svolti da me',12,14),(28,NULL,NULL,'Appunti di matematica discreta 1','Appunti presi a lezione',10,15),(29,NULL,NULL,'Appunti di matematica 2','Appunti di logica ',16,15),(30,NULL,NULL,'Esami vecchi di matematica discreta 1','Esami svolti',17,15),(31,NULL,NULL,'Riassunti del libro','Riassunti del libro',15,15),(32,NULL,NULL,'Formulario di fisica generale','FOrmulario dettagliato',12,16),(33,NULL,NULL,'Spiegazione dettagliata degli esercizi','Esercizi svolti con le soluzioni e commenti',15,16),(34,NULL,NULL,'Appunti di algoritmi','Appunti presi a lezione',16,18),(35,NULL,NULL,'Appunti di laboratorio di algoritmi','Appunti su esercizi svolti in java',17,18),(36,NULL,NULL,'Riassunti dei costi degli algoritmi','Costi presi dalle slide e dal libro',12,18),(37,NULL,NULL,'Esami vecchi','Esami vecchi svolti',10,22),(38,NULL,NULL,'Appunti presi a lezione di ricerca operativa','Appunti presi a lezione',11,22),(46,NULL,NULL,'Ottimizzazione combinatoria, slide','Ci sono le slide prese da internet',16,21),(47,NULL,NULL,'Esercizi su modelli','Esercizi svolti a lezione',11,21),(48,NULL,NULL,'Esami vecchi con soluzioni','esami con spiegazione e soluzioni dettagliate',14,21),(49,NULL,NULL,'Sistemi operativi riassunti','Riassunti delle slide, con alcune cose prese dal libro',15,19),(50,NULL,NULL,'Esami vecchi','Esami vecchi con soluzioni',12,19),(51,NULL,NULL,'Laboratorio di sistemi operativi','Tutti i compiti con le soluzioni',13,19),(52,NULL,NULL,'Slide di compilatori, slide','Slide prese dal sito del professore',17,24),(53,NULL,NULL,'Esami vecchi','Esami con soluzioni',16,24),(54,NULL,NULL,'Ingegneria del siftware','Passi fondamentali da seguire per passare l\'esame con un buon voto',12,26),(55,NULL,NULL,'Reti evolute, slide','Slide prese dal sito del professore',10,27),(56,NULL,NULL,'Domande frequenti all\'orale','L\'orale di solito si basa molto sullo scritto, di seguito alcune domande ',11,27),(57,NULL,NULL,'Esami passati','Di solito mette sempre gli stessi compiti',15,30),(58,NULL,NULL,'Riassunti del libro','Riassunti del libro',14,30),(59,NULL,NULL,'Tcc, riassunti dei teoremi principali, con esempi','Riassunti ed esempi del libro',12,31),(60,NULL,NULL,'Domande dell\'orale','Di solito fa sempre le stesse domande',13,31),(61,NULL,NULL,'Eserci sulla TM','Eserci sul +1, -1,+2, -2',16,31),(62,NULL,NULL,'Appunti presi a lezione','Appunti presi a lezione',15,31);
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photos` (
  `idP` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nameP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`idP`),
  KEY `photos_note_id_foreign` (`note_id`),
  CONSTRAINT `photos_note_id_foreign` FOREIGN KEY (`note_id`) REFERENCES `notes` (`idn`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photos`
--

LOCK TABLES `photos` WRITE;
/*!40000 ALTER TABLE `photos` DISABLE KEYS */;
INSERT INTO `photos` VALUES (1,NULL,NULL,'../public/storage/11/8/foto1.jpg','foto1.jpg',8),(2,NULL,NULL,'../public/storage/11/8/foto2.jpg','foto2.jpg',8),(3,NULL,NULL,'../public/storage/11/8/foto3.jpg','foto3.jpg',8),(4,NULL,NULL,'../public/storage/11/8/foto4.jpg','foto4.jpg',8),(5,NULL,NULL,'../public/storage/11/8/foto5.jpg','foto5.jpg',8),(6,NULL,NULL,'../public/storage/12/12/foto13.jpg','foto13.jpg',12),(7,NULL,NULL,'../public/storage/12/12/foto14.jpg','foto14.jpg',12),(8,NULL,NULL,'../public/storage/12/12/foto15.jpg','foto15.jpg',12),(9,NULL,NULL,'../public/storage/12/12/foto16.jpg','foto16.jpg',12),(10,NULL,NULL,'../public/storage/13/21/foto8.jpg','foto8.jpg',21),(11,NULL,NULL,'../public/storage/13/21/foto9.jpg','foto9.jpg',21),(12,NULL,NULL,'../public/storage/13/21/foto10.jpg','foto10.jpg',21),(13,NULL,NULL,'../public/storage/13/21/foto11.jpg','foto11.jpg',21),(14,NULL,NULL,'../public/storage/14/25/foto7.jpg','foto7.jpg',25),(15,NULL,NULL,'../public/storage/14/25/foto8.jpg','foto8.jpg',25),(16,NULL,NULL,'../public/storage/14/25/foto9.jpg','foto9.jpg',25),(17,NULL,NULL,'../public/storage/14/25/foto10.jpg','foto10.jpg',25),(18,NULL,NULL,'../public/storage/14/25/foto11.jpg','foto11.jpg',25),(19,NULL,NULL,'../public/storage/14/25/foto12.jpg','foto12.jpg',25),(20,NULL,NULL,'../public/storage/15/28/foto19.jpg','foto19.jpg',28),(21,NULL,NULL,'../public/storage/15/28/foto1.jpg','foto1.jpg',28),(22,NULL,NULL,'../public/storage/15/28/foto2.jpg','foto2.jpg',28),(23,NULL,NULL,'../public/storage/22/37/foto1.jpg','foto1.jpg',37),(24,NULL,NULL,'../public/storage/22/37/foto2.jpg','foto2.jpg',37),(25,NULL,NULL,'../public/storage/22/37/foto3.jpg','foto3.jpg',37),(26,NULL,NULL,'../public/storage/22/37/foto4.jpg','foto4.jpg',37),(27,NULL,NULL,'../public/storage/27/55/foto2.jpg','foto2.jpg',55),(28,NULL,NULL,'../public/storage/27/55/foto3.jpg','foto3.jpg',55),(29,NULL,NULL,'../public/storage/27/55/foto4.jpg','foto4.jpg',55),(30,NULL,NULL,'../public/storage/11/9/foto6.jpg','foto6.jpg',9),(31,NULL,NULL,'../public/storage/11/9/foto7.jpg','foto7.jpg',9),(32,NULL,NULL,'../public/storage/12/13/foto17.jpg','foto17.jpg',13),(33,NULL,NULL,'../public/storage/12/13/foto18.jpg','foto18.jpg',13),(34,NULL,NULL,'../public/storage/12/13/foto19.jpg','foto19.jpg',13),(35,NULL,NULL,'../public/storage/12/13/foto1.jpg','foto1.jpg',13),(36,NULL,NULL,'../public/storage/12/13/foto2.jpg','foto2.jpg',13),(37,NULL,NULL,'../public/storage/13/22/foto12.jpg','foto12.jpg',22),(38,NULL,NULL,'../public/storage/13/22/foto13.jpg','foto13.jpg',22),(39,NULL,NULL,'../public/storage/13/22/foto14.jpg','foto14.jpg',22),(40,NULL,NULL,'../public/storage/13/22/foto15.jpg','foto15.jpg',22),(41,NULL,NULL,'../public/storage/13/22/foto16.jpg','foto16.jpg',22),(42,NULL,NULL,'../public/storage/13/22/foto17.jpg','foto17.jpg',22),(43,NULL,NULL,'../public/storage/14/26/foto13.jpg','foto13.jpg',26),(44,NULL,NULL,'../public/storage/14/26/foto14.jpg','foto14.jpg',26),(45,NULL,NULL,'../public/storage/14/26/foto15.jpg','foto15.jpg',26),(46,NULL,NULL,'../public/storage/14/26/foto16.jpg','foto16.jpg',26),(47,NULL,NULL,'../public/storage/14/26/foto17.jpg','foto17.jpg',26),(48,NULL,NULL,'../public/storage/22/38/foto5.jpg','foto5.jpg',38),(49,NULL,NULL,'../public/storage/22/38/foto6.jpg','foto6.jpg',38),(50,NULL,NULL,'../public/storage/21/47/foto9.jpg','foto9.jpg',47),(51,NULL,NULL,'../public/storage/21/47/foto10.jpg','foto10.jpg',47),(52,NULL,NULL,'../public/storage/21/47/foto11.jpg','foto11.jpg',47),(53,NULL,NULL,'../public/storage/21/47/foto12.jpg','foto12.jpg',47),(54,NULL,NULL,'../public/storage/21/47/foto13.jpg','foto13.jpg',47),(55,NULL,NULL,'../public/storage/27/56/foto5.jpg','foto5.jpg',56),(56,NULL,NULL,'../public/storage/27/56/foto6.jpg','foto6.jpg',56),(57,NULL,NULL,'../public/storage/27/56/foto7.jpg','foto7.jpg',56),(58,NULL,NULL,'../public/storage/27/56/foto8.jpg','foto8.jpg',56),(59,NULL,NULL,'../public/storage/27/56/foto9.jpg','foto9.jpg',56),(60,NULL,NULL,'../public/storage/11/10/foto8.jpg','foto8.jpg',10),(61,NULL,NULL,'../public/storage/11/10/foto9.jpg','foto9.jpg',10),(62,NULL,NULL,'../public/storage/11/10/foto10.jpg','foto10.jpg',10),(63,NULL,NULL,'../public/storage/11/10/foto11.jpg','foto11.jpg',10),(64,NULL,NULL,'../public/storage/12/14/foto3.jpg','foto3.jpg',14),(65,NULL,NULL,'../public/storage/12/14/foto4.jpg','foto4.jpg',14),(66,NULL,NULL,'../public/storage/12/14/foto5.jpg','foto5.jpg',14),(67,NULL,NULL,'../public/storage/12/14/foto6.jpg','foto6.jpg',14),(68,NULL,NULL,'../public/storage/12/14/foto7.jpg','foto7.jpg',14),(69,NULL,NULL,'../public/storage/13/23/foto18.jpg','foto18.jpg',23),(70,NULL,NULL,'../public/storage/13/23/foto19.jpg','foto19.jpg',23),(71,NULL,NULL,'../public/storage/13/23/foto1.jpg','foto1.jpg',23),(72,NULL,NULL,'../public/storage/13/23/foto2.jpg','foto2.jpg',23),(73,NULL,NULL,'../public/storage/13/23/foto3.jpg','foto3.jpg',23),(74,NULL,NULL,'../public/storage/14/27/foto18.jpg','foto18.jpg',27),(75,NULL,NULL,'../public/storage/16/32/foto13.jpg','foto13.jpg',32),(76,NULL,NULL,'../public/storage/16/32/foto14.jpg','foto14.jpg',32),(77,NULL,NULL,'../public/storage/16/32/foto15.jpg','foto15.jpg',32),(78,NULL,NULL,'../public/storage/16/32/foto16.jpg','foto16.jpg',32),(79,NULL,NULL,'../public/storage/18/36/foto15.jpg','foto15.jpg',36),(80,NULL,NULL,'../public/storage/18/36/foto16.jpg','foto16.jpg',36),(81,NULL,NULL,'../public/storage/18/36/foto17.jpg','foto17.jpg',36),(82,NULL,NULL,'../public/storage/18/36/foto18.jpg','foto18.jpg',36),(83,NULL,NULL,'../public/storage/16/32/foto17.jpg','foto17.jpg',32),(84,NULL,NULL,'../public/storage/16/32/foto18.jpg','foto18.jpg',32),(85,NULL,NULL,'../public/storage/16/32/foto19.jpg','foto19.jpg',32),(86,NULL,NULL,'../public/storage/16/32/foto1.jpg','foto1.jpg',32),(87,NULL,NULL,'../public/storage/16/32/foto2.jpg','foto2.jpg',32),(88,NULL,NULL,'../public/storage/18/36/foto19.jpg','foto19.jpg',36),(89,NULL,NULL,'../public/storage/19/50/foto2.jpg','foto2.jpg',50),(90,NULL,NULL,'../public/storage/19/50/foto3.jpg','foto3.jpg',50),(91,NULL,NULL,'../public/storage/19/50/foto4.jpg','foto4.jpg',50),(92,NULL,NULL,'../public/storage/19/50/foto5.jpg','foto5.jpg',50),(93,NULL,NULL,'../public/storage/26/54/foto15.jpg','foto15.jpg',54),(94,NULL,NULL,'../public/storage/26/54/foto16.jpg','foto16.jpg',54),(95,NULL,NULL,'../public/storage/26/54/foto17.jpg','foto17.jpg',54),(96,NULL,NULL,'../public/storage/26/54/foto19.jpg','foto19.jpg',54),(97,NULL,NULL,'../public/storage/26/54/foto1.jpg','foto1.jpg',54),(98,NULL,NULL,'../public/storage/31/59/foto15.jpg','foto15.jpg',59),(99,NULL,NULL,'../public/storage/31/59/foto16.jpg','foto16.jpg',59),(100,NULL,NULL,'../public/storage/11/11/foto12.jpg','foto12.jpg',11),(101,NULL,NULL,'../public/storage/13/24/foto4.jpg','foto4.jpg',24),(102,NULL,NULL,'../public/storage/13/24/foto5.jpg','foto5.jpg',24),(103,NULL,NULL,'../public/storage/13/24/foto6.jpg','foto6.jpg',24),(104,NULL,NULL,'../public/storage/19/51//foto6.jpg','foto6.jpg',51),(105,NULL,NULL,'../public/storage/19/51/foto7.jpg','foto7.jpg',51),(106,NULL,NULL,'../public/storage/19/51/foto8.jpg','foto8.jpg',51),(107,NULL,NULL,'../public/storage/31/60/foto17.jpg','foto17.jpg',60),(108,NULL,NULL,'../public/storage/31/60/foto18.jpg','foto18.jpg',60),(109,NULL,NULL,'../public/storage/31/60/foto19.jpg','foto19.jpg',60),(110,NULL,NULL,'../public/storage/31/60/foto1.jpg','foto1.jpg',60),(111,NULL,NULL,'../public/storage/31/60/foto2.jpg','foto2.jpg',60),(112,NULL,NULL,'../public/storage/21/48/foto14.jpg','foto14.jpg',48),(113,NULL,NULL,'../public/storage/21/48/foto15.jpg','foto15.jpg',48),(114,NULL,NULL,'../public/storage/21/48/foto16.jpg','foto16.jpg',48),(115,NULL,NULL,'../public/storage/30/58/foto14.jpg','foto14.jpg',58),(116,NULL,NULL,'../public/storage/15/31/foto12.jpg','foto12.jpg',31),(117,NULL,NULL,'../public/storage/16/33/foto3.jpg','foto3.jpg',33),(118,NULL,NULL,'../public/storage/16/33/foto4.jpg','foto4.jpg',33),(119,NULL,NULL,'../public/storage/16/33/foto5.jpg','foto5.jpg',33),(120,NULL,NULL,'../public/storage/16/33/foto6.jpg','foto6.jpg',33),(121,NULL,NULL,'../public/storage/16/33/foto7.jpg','foto7.jpg',33),(122,NULL,NULL,'../public/storage/19/49/foto17.jpg','foto17.jpg',49),(123,NULL,NULL,'../public/storage/19/49/foto18.jpg','foto18.jpg',49),(124,NULL,NULL,'../public/storage/19/49/foto19.jpg','foto19.jpg',49),(125,NULL,NULL,'../public/storage/19/49/foto1.jpg','foto1.jpg',49),(126,NULL,NULL,'../public/storage/30/57/foto10.jpg','foto10.jpg',57),(127,NULL,NULL,'../public/storage/30/57/foto11.jpg','foto11.jpg',57),(128,NULL,NULL,'../public/storage/30/57/foto12.jpg','foto12.jpg',57),(129,NULL,NULL,'../public/storage/30/57/foto13.jpg','foto13.jpg',57),(130,NULL,NULL,'../public/storage/31/62/foto8.jpg','foto8.jpg',62),(131,NULL,NULL,'../public/storage/31/62/foto9.jpg','foto9.jpg',62),(132,NULL,NULL,'../public/storage/31/62/foto10.jpg','foto10.jpg',62),(133,NULL,NULL,'../public/storage/31/62/foto11.jpg','foto11.jpg',62),(134,NULL,NULL,'../public/storage/31/62/foto12.jpg','foto12.jpg',62),(135,NULL,NULL,'../public/storage/15/29/foto3.jpg','foto3.jpg',29),(136,NULL,NULL,'../public/storage/15/29/foto4.jpg','foto4.jpg',29),(137,NULL,NULL,'../public/storage/15/29/foto5.jpg','foto5.jpg',29),(138,NULL,NULL,'../public/storage/15/29/foto6.jpg','foto6.jpg',29),(139,NULL,NULL,'../public/storage/18/34/foto8.jpg','foto8.jpg',34),(140,NULL,NULL,'../public/storage/18/34/foto9.jpg','foto9.jpg',34),(141,NULL,NULL,'../public/storage/18/34/foto10.jpg','foto10.jpg',34),(142,NULL,NULL,'../public/storage/21/46/foto7.jpg','foto7.jpg',46),(143,NULL,NULL,'../public/storage/21/46/foto8.jpg','foto8.jpg',46),(144,NULL,NULL,'../public/storage/24/53/foto11.jpg','foto11.jpg',53),(145,NULL,NULL,'../public/storage/24/53/foto12.jpg','foto12.jpg',53),(146,NULL,NULL,'../public/storage/24/53/foto13.jpg','foto13.jpg',53),(147,NULL,NULL,'../public/storage/24/53/foto14.jpg','foto14.jpg',53),(148,NULL,NULL,'../public/storage/31/61/foto3.jpg','foto3.jpg',61),(149,NULL,NULL,'../public/storage/31/61/foto4.jpg','foto4.jpg',61),(150,NULL,NULL,'../public/storage/31/61/foto5.jpg','foto5.jpg',61),(151,NULL,NULL,'../public/storage/31/61/foto6.jpg','foto6.jpg',61),(152,NULL,NULL,'../public/storage/31/61/foto7.jpg','foto7.jpg',61),(153,NULL,NULL,'../public/storage/15/30/foto7.jpg','foto7.jpg',30),(154,NULL,NULL,'../public/storage/15/30/foto8.jpg','foto8.jpg',30),(155,NULL,NULL,'../public/storage/15/30/foto9.jpg','foto9.jpg',30),(156,NULL,NULL,'../public/storage/15/30/foto10.jpg','foto10.jpg',30),(157,NULL,NULL,'../public/storage/15/30/foto11.jpg','foto11.jpg',30),(158,NULL,NULL,'../public/storage/18/35/foto11.jpg','foto11.jpg',35),(159,NULL,NULL,'../public/storage/18/35/foto12.jpg','foto12.jpg',35),(160,NULL,NULL,'../public/storage/18/35/foto13.jpg','foto13.jpg',35),(161,NULL,NULL,'../public/storage/24/52/foto9.jpg','foto9.jpg',52),(162,NULL,NULL,'../public/storage/24/52/foto10.jpg','foto10.jpg',52),(163,NULL,NULL,'../public/storage/18/35/foto14.jpg','foto14.jpg',35);
/*!40000 ALTER TABLE `photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nameS` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` smallint(6) NOT NULL,
  `degreeCourse_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subjects_degreecourse_id_foreign` (`degreeCourse_id`),
  CONSTRAINT `subjects_degreecourse_id_foreign` FOREIGN KEY (`degreeCourse_id`) REFERENCES `degree_courses` (`iddc`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (11,NULL,NULL,'Fondamenti di programmazione',1,17),(12,NULL,NULL,'Architettura degli elaboratori',1,17),(13,NULL,NULL,'Analisi 1',1,17),(14,NULL,NULL,'Laboratorio di architettura degli elaboratori',1,17),(15,NULL,NULL,'Matematica discreta',1,17),(16,NULL,NULL,'Fisica',1,17),(17,NULL,NULL,'Inglese b1',1,17),(18,NULL,NULL,'Algoritmi e strutture dati',2,17),(19,NULL,NULL,'Sistemi operativi',2,17),(20,NULL,NULL,'Probabilità e statistica',2,17),(21,NULL,NULL,'Ottimizzazione combinatoria',2,17),(22,NULL,NULL,'Ricerca Operativa',2,17),(23,NULL,NULL,'Oosde',2,17),(24,NULL,NULL,'Compilatori',3,17),(25,NULL,NULL,'Tecnologie del web',3,17),(26,NULL,NULL,'Ingegneria del software',3,17),(27,NULL,NULL,'Reti evolute',3,17),(28,NULL,NULL,'Inglese b2',3,17),(29,NULL,NULL,'Ingegneria del web',3,17),(30,NULL,NULL,'reti ',3,17),(31,NULL,NULL,'Applicazioni per dispositivi mobili',3,17),(32,NULL,NULL,'Teoria della calcolabilità e complessità',3,17);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idU` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci,
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cdl_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`idU`),
  KEY `users_cdl_id_foreign` (`cdl_id`),
  CONSTRAINT `users_cdl_id_foreign` FOREIGN KEY (`cdl_id`) REFERENCES `degree_courses` (`iddc`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,NULL,NULL,'Alessandro','Di Matteo','achissimo@gmail.com','$2y$10$/iGkpYaAgpCxhu2BaZHekeIlWLbez/W8WBYTQiDfIzKXgYGF4Bq82',NULL,17),(11,NULL,NULL,'Davide ','Fontana','davide.fontana@gmail.com','$2y$10$b4O1KSZfhh0clGEeC4Ai5erzTIobO8.DDkQH/u3Zj6OBmAEMVBYRi',NULL,17),(12,NULL,NULL,'Andrea','Amicosante','andrea.amicosante@gmail.com','$2y$10$XLNhyvsZdlpG7yEgJdwaOeKxeGGosDWHIwB8FrfpIQXbaRf1E5SeO',NULL,17),(13,NULL,NULL,'Angelo','D\'alfonso','angelo.dalfonso@gmail.com','$2y$10$Sy3ZhiOvqfo73jbh8S69yet0G72h79DwXc00F/U9qwYIrIOlODp12',NULL,17),(14,NULL,NULL,'Lica','DI laudo','luca.dilaudo@gmail.com','$2y$10$Usm1BcgtDVlTU4FrDFHEZOvU.iLxoRUNDM2HwYVzoORCGhA/KGMx2',NULL,17),(15,NULL,NULL,'Giulia','Scoccia','giulia.scoccia@gmail.com','$2y$10$s/2UAr8xrt7Ric6mrSTF4ulM.Kel9sGjzyyZbBUea9LLQO.rqCR5S',NULL,17),(16,NULL,NULL,'Erika','Biondi','erika.biondi@gmail.com','$2y$10$r9UbxJahMyd98S/Ptx9XM.1fCQ3rbmmamC3S34xCR5ferFhENOIKu',NULL,17),(17,NULL,NULL,'Giovanna','Di Cresce','giovanna.dicresce@gmail.com','$2y$10$VnmFf.ozzLfUydeE6oabB.uL99pm2hbgna0bmsUflsS5N.MzzwQrW.',NULL,17);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'AqNoteApi'
--

--
-- Dumping routines for database 'AqNoteApi'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-29 22:23:41
