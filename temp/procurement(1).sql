-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: procurement
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `awarding_contractor`
--

DROP TABLE IF EXISTS `awarding_contractor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awarding_contractor` (
  `idPINAKA_AWARDING_CONTRACTOR` int NOT NULL AUTO_INCREMENT,
  `AWARDING_DECISION` varchar(30) NOT NULL COMMENT 'ΤΑΥΤΟΤΗΤΑ ΕΓΓΡΑΦΟΥ "ΚΑΤΑΚΥΡΩΤΙΚΗ ΑΠΟΦΑΣΗ"',
  `idPINAKA_TEMPORARY_CONTRACTOR` int NOT NULL,
  `SIGN_DATE` date NOT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ ΥΠΟΓΡΑΦΗΣ',
  `PUBLICATION_DATE` date NOT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ ΔΗΜΟΣΙΕΥΣΗΣ',
  `NUM_OF_APPEAL_DAYS` int NOT NULL,
  `PRECONTRACTUAL_CHECK` tinyint NOT NULL COMMENT 'ΠΡΟΣΥΜΒΑΤΙΚΟΣ ΕΛΕΓΧΟΣ (ΝΑΙ Ή ΟΧΙ)\n0:ΔΕΝ ΤΟ ΣΤΕΛΝΟΥΜΕ\n1:ΤΟ ΣΤΕΛΝΟΥΜΕ\n',
  `DATE_SEND_COURT_OF_AUDITORS` date DEFAULT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ ΑΠΟΣΤΟΛΗΣ ΣΤΟ ΕΛΕΓΚΤΙΚΟ ΣΥΝΕΔΡΙΟ (ΑΝ ΧΡΕΙΑΖΕΤΑΙ)',
  PRIMARY KEY (`idPINAKA_AWARDING_CONTRACTOR`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awarding_contractor`
--

LOCK TABLES `awarding_contractor` WRITE;
/*!40000 ALTER TABLE `awarding_contractor` DISABLE KEYS */;
INSERT INTO `awarding_contractor` VALUES (1,'Φ.202/201/201/Σ.201',1,'2022-03-01','2022-03-01',10,0,NULL),(2,'Φ.202/202/202/Σ.202',2,'2022-04-01','2022-04-01',10,0,NULL),(3,'Φ.202/203/203/Σ.203',3,'2022-04-11','2022-04-11',10,0,NULL),(4,'Φ.202/204/204/Σ.204',4,'2022-04-09','2022-04-09',10,0,NULL),(5,'Φ.202/205/205/Σ.205',5,'2022-04-12','2022-04-12',10,0,NULL),(6,'Φ.202/206/206/Σ.206',6,'2022-04-14','2022-04-14',10,0,NULL),(7,'Φ.202/207/207/Σ.207',7,'2022-04-22','2022-04-22',10,0,NULL),(8,'Φ.202/208/208/Σ.208',8,'2022-05-07','2022-05-07',10,1,'2022-05-25'),(9,'Φ.202/209/209/Σ.209',9,'2022-05-12','2022-05-07',10,0,NULL);
/*!40000 ALTER TABLE `awarding_contractor` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `insert_deadline_trigger_awarding_contractor` AFTER INSERT ON `awarding_contractor` FOR EACH ROW BEGIN
	DECLARE public_tender_id varchar(10);
    
	SELECT pt.idPUBLIC_TENDER INTO public_tender_id
    FROM public_tender pt inner join temp_contractor tc on pt.idPINAKA_PUBLIC_TENDER=tc.idPINAKA_PUBLIC_TENDER inner join awarding_contractor ac on tc.idPINAKA_TEMPORARY_CONTRACTOR=ac.idPINAKA_TEMPORARY_CONTRACTOR
    WHERE tc.idPINAKA_TEMPORARY_CONTRACTOR = NEW.idPINAKA_TEMPORARY_CONTRACTOR;
    
    INSERT INTO `deadlines` (`EIDOS`, `DATE`, `MESSAGE`,`PUBLIC_TENDER`)
    VALUES (2, DATE_ADD(DATE_ADD(NEW.`PUBLICATION_DATE`, INTERVAL NEW.`NUM_OF_APPEAL_DAYS` DAY), INTERVAL 1 DAY),CONCAT('ΧΘΕΣ ΕΛΗΞΕ Η ΗΜΕΡΟΜΗΝΙΑ ΥΠΟΒΟΛΗΣ ΕΝΣΤΑΣΕΩΝ ΓΙΑ ΤΗΝ ΚΑΤΑΚΥΡΩΤΙΚΗ ΑΠΟΦΑΣΗ ΤΟΥ ΔΙΑΓΩΝΙΣΜΟΥ ',public_tender_id,'. ΜΠΟΡΕΙΤΕ ΝΑ ΠΡΟΧΩΡΗΣΕΤΕ ΣΤΗΝ ΥΠΟΓΡΑΦΗ ΣΥΜΒΑΣΗΣ/ΣΥΜΦΩΝΙΑΣ ΠΛΑΙΣΙΟ.'),public_tender_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `contract`
--

DROP TABLE IF EXISTS `contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contract` (
  `idPINAKA_CONTRACT` int NOT NULL AUTO_INCREMENT,
  `idCONTRACT` varchar(10) NOT NULL COMMENT 'ID ΣΥΜΒΑΣΗΣ',
  `idPINAKA_AWARDING_CONTRACTOR` int NOT NULL COMMENT 'ID ΔΙΑΓΩΝΙΣΜΟΥ',
  `SIGN_DATE` date NOT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ ΥΠΟΓΡΑΦΗΣ',
  `DELIVERIES` int NOT NULL COMMENT 'ΑΡΙΘΜΟΣ ΠΑΡΑΔΟΣΕΩΝ',
  `DATE_OF_1ST_DELIVERY` date NOT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ 1ΗΣ ΠΑΡΑΔΟΣΗΣ',
  `DATE_OF_2ND_DELIVERY` date DEFAULT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ 2ΗΣ ΠΑΡΑΔΟΣΗΣ',
  `DATE_OF_3RD_DELIVERY` date DEFAULT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ 3ΗΣ ΠΑΡΑΔΟΣΗΣ',
  `DATE_OF_4TH_DELIVERY` date DEFAULT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ 4ΗΣ ΠΑΡΑΔΟΣΗΣ',
  PRIMARY KEY (`idPINAKA_CONTRACT`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract`
--

LOCK TABLES `contract` WRITE;
/*!40000 ALTER TABLE `contract` DISABLE KEYS */;
INSERT INTO `contract` VALUES (1,'1Α/22',1,'2022-03-20',1,'2022-08-20',NULL,NULL,NULL),(2,'2Α/22',2,'2022-04-20',3,'2022-07-20','2022-09-20','2022-10-20',NULL),(3,'4Α/23',3,'2022-04-30',3,'2022-07-30','2022-09-30','2022-10-20',NULL),(4,'3Α/22',4,'2022-04-29',2,'2022-08-29','2022-10-29',NULL,NULL),(5,'5Α/22',5,'2022-04-30',3,'2022-07-30','2022-09-30','2023-10-30',NULL),(6,'6Α/22',6,'2022-05-10',2,'2022-09-10','2022-11-10','0000-00-00',NULL),(7,'7Α/22',7,'2022-05-23',3,'2022-08-23','2022-10-23','2022-11-23',NULL);
/*!40000 ALTER TABLE `contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deadlines`
--

DROP TABLE IF EXISTS `deadlines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deadlines` (
  `idDEADLINES` int NOT NULL AUTO_INCREMENT,
  `EIDOS` tinyint NOT NULL,
  `DATE` date NOT NULL,
  `MESSAGE` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `PUBLIC_TENDER` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idDEADLINES`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deadlines`
--

LOCK TABLES `deadlines` WRITE;
/*!40000 ALTER TABLE `deadlines` DISABLE KEYS */;
INSERT INTO `deadlines` VALUES (9,2,'2022-05-18','ΧΘΕΣ ΕΛΗΞΕ Η ΗΜΕΡΟΜΗΝΙΑ ΥΠΟΒΟΛΗΣ ΕΝΣΤΑΣΕΩΝ ΓΙΑ ΤΗΝ ΚΑΤΑΚΥΡΩΤΙΚΗ ΑΠΟΦΑΣΗ ΤΟΥ ΔΙΑΓΩΝΙΣΜΟΥ 9/22. ΜΠΟΡΕΙΤΕ ΝΑ ΠΡΟΧΩΡΗΣΕΤΕ ΣΤΗΝ ΥΠΟΓΡΑΦΗ ΣΥΜΒΑΣΗΣ/ΣΥΜΦΩΝΙΑΣ ΠΛΑΙΣΙΟ.','9/22');
/*!40000 ALTER TABLE `deadlines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department` (
  `idDEPARTMENT` varchar(10) NOT NULL COMMENT 'id ΤΜΗΜΑΤΟΣ',
  `DESCRIPTION` varchar(20) NOT NULL COMMENT 'ΠΕΡΙΓΡΑΦΗ',
  PRIMARY KEY (`idDEPARTMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES ('2Α','Καύσιμα - ελαιολιπαν'),('2Β','Τρόφιμα'),('2Γ','Έντυπα υλικά'),('2Δ','Μεταφορές'),('3Α','Ιματισμός - γενικά υ'),('3Β','Πυρομαχικά'),('3Γ','Τεχνικά υλικά - α΄ύλ'),('3Δ','Ανταλλακτικά κύριων '),('3Ε','Υλικά FMS, NSPA'),('4Α','Οχήματα - άρματα - μ'),('4Β','Υλικά ΤΘ'),('4Γ','Υλικά ΠΒ - ΑΣ'),('4Δ','Υλικά ΠΖ - ΕΔ - ΜΧ'),('4Ε','Υλικά ΔΒ - ΕΠ'),('5Α','Υγειονομικό υλικό'),('5Β','Φαρμακευτικό υλικό'),('5Γ','Κτηνιατρικό υλικό'),('5Δ','Παροχή υπηρεσιών μέρ'),('6','Οικονομικό'),('7','Διενεργειας διαγωνισ');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `diagonismoi`
--

DROP TABLE IF EXISTS `diagonismoi`;
/*!50001 DROP VIEW IF EXISTS `diagonismoi`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `diagonismoi` AS SELECT 
 1 AS `id`,
 1 AS `cpv`,
 1 AS `posotita`,
 1 AS `axia`,
 1 AS `techniki_prodiagrafi`,
 1 AS `monada_paradosis`,
 1 AS `diairetotita_kata_eidos`,
 1 AS `diairototita_kata_posotita`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `executive_contract`
--

DROP TABLE IF EXISTS `executive_contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `executive_contract` (
  `idPINAKA_EXECUTIVE_CONTRACT` int NOT NULL AUTO_INCREMENT,
  `idEXECUTIVE_CONTRACT` varchar(10) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'id ΕΚΤΕΛΕΣΤΙΚΗΣ ΣΥΜΒΑΣΗΣ',
  `idFRAMEWORK_AGREEMENT` int NOT NULL COMMENT 'id ΣΥΜΦΩΝΙΑΣ ΠΛΑΙΣΙΟ',
  `SIGN_DATE` date DEFAULT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ ΥΠΟΓΡΑΦΗΣ',
  `AFM_SUPPLIER` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'ΑΦΜ ΠΡΟΜΗΘΕΥΤΗ',
  `DELIVERIES` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'ΠΑΡΑΔΟΣΕΙΣ',
  `DATE_OF_1ST_DELIVERY` date DEFAULT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ_1_ΠΑΡΑΔΟΣΗΣ',
  `DATE_OF_2ND_DELIVERY` date DEFAULT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ_2_ΠΑΡΑΔΟΣΗΣ',
  `DATE_OF_3RD_DELIVERY` date DEFAULT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ_3_ΠΑΡΑΔΟΣΗΣ',
  `DATE_OF_4TH_DELIVERY` date DEFAULT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ_4_ΠΑΡΑΔΟΣΗΣ',
  `CPV` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'COMMON PROCUREMENT VOCABULARY',
  `CONTRACT_QUANTITY` int DEFAULT NULL COMMENT 'ΣΥΜΒΑΤΙΚΗ ΠΟΣΟΤΗΤΑ',
  `TOTAL_VALUE` int DEFAULT NULL COMMENT 'ΣΥΝΟΛΙΚΗ ΑΞΙΑ',
  PRIMARY KEY (`idPINAKA_EXECUTIVE_CONTRACT`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `executive_contract`
--

LOCK TABLES `executive_contract` WRITE;
/*!40000 ALTER TABLE `executive_contract` DISABLE KEYS */;
INSERT INTO `executive_contract` VALUES (1,'0',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'0',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'0',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'0',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'0',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'0',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'0',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'0',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `executive_contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `framework_agreement`
--

DROP TABLE IF EXISTS `framework_agreement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `framework_agreement` (
  `idPINAKA_FRAMEWORK_AGREEMENT` int NOT NULL AUTO_INCREMENT,
  `idFRAMEWORK_AGREEMENT` varchar(10) NOT NULL COMMENT 'ID ΣΥΜΦΩΝΙΑΣ ΠΛΑΙΣΙΟ',
  `idPINAKA_AWARDING_CONTRACTOR` int NOT NULL COMMENT 'ID ΑΠΟΦΑΣΗΣ ΚΑΤΑΚΥΡΩΣΗΣ',
  `SIGN_DATE` date NOT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ ΥΠΟΓΡΑΦΗΣ',
  `YEARS` int NOT NULL COMMENT 'ΔΙΑΡΚΕΙΑ ΣΕ ΕΤΗ',
  PRIMARY KEY (`idPINAKA_FRAMEWORK_AGREEMENT`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `framework_agreement`
--

LOCK TABLES `framework_agreement` WRITE;
/*!40000 ALTER TABLE `framework_agreement` DISABLE KEYS */;
INSERT INTO `framework_agreement` VALUES (1,'10Α/23',8,'2023-05-10',3),(2,'20Α/23',10,'2022-09-22',3);
/*!40000 ALTER TABLE `framework_agreement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invitation_to_tender`
--

DROP TABLE IF EXISTS `invitation_to_tender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invitation_to_tender` (
  `idPINAKA_INVITATION_TO_TENDER` int NOT NULL AUTO_INCREMENT,
  `idINVITATION_TO_TENDER` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idPINAKA_FRAMEWORK_AGREEMENT` int NOT NULL,
  `NUM_OF_EXEC_CONTRACT` int NOT NULL,
  `CPV` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `QUANTITY` int NOT NULL,
  `BUDGET` int NOT NULL,
  `PERFORMANCE_BONDS` float(15,2) DEFAULT NULL,
  `ADA` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ADAM` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `SIGN_DATE` date NOT NULL,
  `PUBLICATION_DATE` date NOT NULL,
  `OFFER_LAST_DATE` date NOT NULL,
  PRIMARY KEY (`idPINAKA_INVITATION_TO_TENDER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invitation_to_tender`
--

LOCK TABLES `invitation_to_tender` WRITE;
/*!40000 ALTER TABLE `invitation_to_tender` DISABLE KEYS */;
/*!40000 ALTER TABLE `invitation_to_tender` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `insert_deadline_trigger_invitation_to_tender` AFTER INSERT ON `invitation_to_tender` FOR EACH ROW BEGIN
    INSERT INTO `deadlines` (`EIDOS`, `DATE`)
    VALUES (3, date_add(NEW.`OFFER_LAST_DATE`, interval 1 DAY));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `permanent_reception`
--

DROP TABLE IF EXISTS `permanent_reception`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permanent_reception` (
  `idPINAKA_RECEIPT_DECISION` int NOT NULL AUTO_INCREMENT,
  `idRECEIPT_DECISION` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'ΤΑΥΤΟΤΗΤΑ ΕΓΓΡΑΦΟΥ ΑΠΟΦΑΣΗΣ ΠΑΡΑΛΑΒΗΣ Ή ΠΡΩΤΟΚΟΛΛΟ ΠΡΟΣΩΡΙΝΗΣ ΠΑΡΑΛΑΒΗΣ',
  `idPINAKA_CONTRACT` int DEFAULT NULL,
  `idPINAKA_EXECUTIVE_CONTRACT` int DEFAULT NULL,
  `RECEIPT_QUANTITY` int NOT NULL COMMENT 'ΠΟΣΟΤΗΤΑ ΠΑΡΑΛΑΒΗΣ',
  `RECEPTION_DATE` date NOT NULL,
  `SIGN_DATE` date NOT NULL,
  `FINE` float DEFAULT '0' COMMENT 'ΠΡΟΣΤΙΜΟ',
  PRIMARY KEY (`idPINAKA_RECEIPT_DECISION`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permanent_reception`
--

LOCK TABLES `permanent_reception` WRITE;
/*!40000 ALTER TABLE `permanent_reception` DISABLE KEYS */;
INSERT INTO `permanent_reception` VALUES (1,'Φ.301/301/301/Σ.301',1,NULL,0,'0000-00-00','0000-00-00',0),(2,'Φ.301/301/301/Σ.301',2,NULL,0,'0000-00-00','0000-00-00',0),(3,'Φ.301/301/301/Σ.301',3,NULL,0,'0000-00-00','0000-00-00',0),(4,'Φ.301/301/301/Σ.301',0,NULL,0,'0000-00-00','0000-00-00',0),(5,'Φ.301/301/301/Σ.301',0,NULL,0,'0000-00-00','0000-00-00',0),(6,'Φ.301/301/301/Σ.301',0,NULL,0,'0000-00-00','0000-00-00',0);
/*!40000 ALTER TABLE `permanent_reception` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `CPV` varchar(20) NOT NULL COMMENT 'COMMON PROCUREMENT VOCABULARY',
  `NAME_OF_GOOD` varchar(45) NOT NULL COMMENT 'ΟΝΟΜΑ ΑΓΑΘΟΥ',
  `TECHNICAL_SPECIFICATION` varchar(20) DEFAULT NULL COMMENT 'ΤΕΧΝΙΚΗ_ΠΡΟΔΙΑΓΡΑΦΗ (ΜΠΟΡΕΙ ΝΑ ΜΗΝ ΥΠΑΡΧΕΙ)',
  `DESCRIPTION_OF_GOOD` varchar(45) DEFAULT NULL COMMENT 'ΠΕΡΙΓΡΑΦΗ ΥΛΙΚΟΥ (ΜΠΟΡΕΙ ΝΑ ΔΙΑΦΕΡΕΙ ΑΠΟ ΤΟ ΟΝΟΜΑ ΤΟΥ ΥΛΙΚΟΥ, ΝΑ ΕΙΝΑΙ ΠΙΟ ΕΞΕΙΔΙΚΕΥΜΕΝΟ)',
  PRIMARY KEY (`CPV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES ('03211300-6','ΡΥΖΙ','ΟΧΙ',NULL),('09200000-1','ΠΕΤΡΕΛΑΙΟ, ΑΝΘΡΑΚΑΣ ΚΑΙ ΠΕΤΡΕΛΑΙΟΕΙΔΗ','ΝΑΙ',NULL),('15851100-9','ΜΗ ΜΑΓΕΙΡΕΜΕΝΑ ΖΥΜΑΡΙΚΑ','ΟΧΙ',NULL),('18443340-1','ΠΗΛΗΚΙΑ','ΝΑΙ',NULL),('18444110-7','ΚΡΑΝΗ','ΝΑΙ',NULL),('33140000-3','ΙΑΤΡΙΚΑ ΑΝΑΛΩΣΙΜΑ','ΝΑΙ',NULL),('33141114-2','ΙΑΤΡΙΚΗ ΓΑΖΑ','ΝΑΙ',NULL),('33141115-9','ΙΑΤΡΙΚΟ ΒΑΜΒΑΚΙ','ΝΑΙ',NULL),('34513750-8','ΕΛΑΦΡΑ ΣΚΑΦΗ','ΟΧΙ',NULL),('35321000-0','ΕΛΑΦΡΑ ΠΥΡΟΒΟΛΑ ΟΠΛΑ','ΝΑΙ',NULL),('35331100-4','ΣΦΑΙΡΕΣ ΠΥΡΟΒΟΛΩΝ','ΝΑΙ',NULL),('35812000-9','ΣΤΟΛΕΣ ΕΚΣΤΡΑΤΕΙΑΣ','ΝΑΙ',NULL),('35812100-0','ΕΠΕΝΔΥΤΕΣ ΠΑΡΑΛΛΑΓΗΣ','ΝΑΙ',NULL),('35815100-1','ΑΛΕΞΙΣΦΑΙΡΑ ΓΙΛΕΚΑ','ΟΧΙ',NULL),('37453400-2','ΣΦΑΙΡΕΣ','ΝΑΙ',NULL),('39514500-3','ΠΕΤΣΕΤΕΣ ΠΡΟΣΩΠΟΥ','ΝΑΙ',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progress`
--

DROP TABLE IF EXISTS `progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `progress` (
  `idPINAKA_PUBLIC_TENDER` int NOT NULL,
  `TENDER_PROGRESS` int NOT NULL,
  `STAGE` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idPINAKA_PUBLIC_TENDER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progress`
--

LOCK TABLES `progress` WRITE;
/*!40000 ALTER TABLE `progress` DISABLE KEYS */;
/*!40000 ALTER TABLE `progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `public_tender`
--

DROP TABLE IF EXISTS `public_tender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `public_tender` (
  `idPINAKA_PUBLIC_TENDER` int NOT NULL AUTO_INCREMENT,
  `idPUBLIC_TENDER` varchar(10) NOT NULL COMMENT 'idΔΙΑΓΩΝΙΣΜΟΥ',
  `WRIT` varchar(50) NOT NULL COMMENT 'ΕΝΤΟΛΗ ΔΙΑΓΩΝΙΣΜΟΥΣ ΑΠΟ ΤΟ ΓΕΣ',
  `TYPE` tinyint NOT NULL COMMENT 'ΕΙΔΟΣ ΔΙΑΓΩΝΙΣΤΙΚΗΣ ΔΙΑΔΙΚΑΣΙΑΣ (ΣΥΜΒΑΣΗ\\\\ΣΥΜΦΩΝΙΑ ΠΛΑΙΣΙΟ\\\\ΕΚΤΕΛΕΣΤΙΚΗ ΣΥΜΒΑΣΗ)\n0:ΔΙΑΓΩΝΙΣΜΟΣ ΠΟΥ ΚΑΤΑΛΗΓΕΙ ΣΕ ΣΥΜΒΑΣΗ\n1:ΔΙΑΓΩΝΙΣΜΟΣ ΠΟΥ ΚΑΤΑΛΗΓΕΙ ΣΕ ΣΥΜΦΩΝΙΑ ΠΛΑΙΣΙΟ\n2:ΔΙΑΓΩΝΙΣΜΟΣ ΠΟΥ ΞΕΚΙΝΑΕΙ ΑΠΟ ΣΠ ΚΑΙ ΚΑΤΑΛΗΓΕΙ ΣΕ ΕΚΤΕΛΕΣΤΙΚΗ ΣΥΜΒΑΣΗ',
  `DEPARTMENT` varchar(3) NOT NULL COMMENT 'ΤΜΗΜΑ ΤΗΣ ΔΙΕΥΘΥΝΣΗΣ ΠΡΟΜΗΘΕΙΩΝ ΠΟΥ ΑΝΑΛΑΜΒΑΝΕΙ ΤΟ ΔΙΑΓΩΝΙΣΜΟ',
  `CPV` varchar(20) NOT NULL COMMENT 'COMMON PROCUREMENT VOCABULARY',
  `QUANTITY` int NOT NULL COMMENT 'ΠΟΣΟΤΗΤΑ',
  `BUDGET` int NOT NULL COMMENT 'ΠΡΟΫΠΟΛΟΓΙΣΜΟΣ',
  `TECHNICAL_SPECIFICATION` tinyint(1) NOT NULL COMMENT 'ΤΕΧΝΙΚΗ ΠΡΟΔΙΑΓΡΑΦΗ',
  `UNIT_OF_DELIVERY` varchar(30) NOT NULL,
  `DIVIDABILITY_BY_CPV` tinyint(1) NOT NULL COMMENT 'ΔΙΑΙΡΕΤΟΤΗΤΑ ΚΑΤΑ ΕΙΔΟΣ (ΔΗΛΑΔΗ ΝΑ ΜΠΟΡΕΙ Ο ΠΡΟΜΗΘΕΥΤΗΣ ΝΑ ΚΑΝΕΙ ΠΡΟΣΦΟΡΑ ΓΙΑ ΕΝΑ ΑΠΟ ΤΑ ΥΛΙΚΑ ΤΟΥ ΔΙΑΓΩΝΙΣΜΟΥ)',
  `DIVIDABILITY_BY_QUANTITY` tinyint(1) NOT NULL COMMENT 'ΔΙΑΙΡΕΤΟΤΗΤΑ ΚΑΤΑ ΠΟΣΟΤΗΤΑ (ΝΑ ΜΠΟΡΕΙ Ο ΠΡΟΜΗΘΕΥΤΗΣ ΝΑ ΚΑΝΕΙ ΠΡΟΣΦΟΡΑ ΓΙΑ ΛΙΓΟΤΕΡΗ ΑΠΟ ΤΗ ΣΥΝΟΛΙΚΗ ΠΟΣΟΤΗΤΑ ΤΟΥ ΔΙΑΓΩΝΙΣΜΟΥ)',
  `PERFORMANCE_BONDS` int NOT NULL COMMENT 'ΕΓΓΥΗΤΙΚΗ ΕΠΙΣΤΟΛΗ ΣΥΜΜΕΤΟΧΗΣ (ΧΡΗΜΑΤΑ ΤΟΥ ΠΡΟΜΗΘΕΥΤΗ ΠΟΥ ΔΕΣΜΕΥΟΝΤΑΙ ΓΙΑ ΝΑ ΣΥΜΜΕΤΕΧΕΙ ΣΤΟ ΔΙΑΓΩΝΙΣΜΟ)',
  `ADA` varchar(12) DEFAULT NULL COMMENT 'ΑΔΑ - ΑΡΙΘΜΟΣ ΔΙΑΔΙΚΤΥΑΚΗΣ ΑΝΑΡΤΗΣΗΣ',
  `ADAM` varchar(20) DEFAULT NULL COMMENT 'ΑΔΑΜ - ΑΡΙΘΜΟΣ ΔΙΑΔΙΚΤΥΑΚΗΣ ΑΝΑΡΤΗΣΗΣ ΜΗΤΡΩΟΥ',
  `SIGN_DATE` date NOT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ ΥΠΟΓΡΑΦΗΣ',
  `PUBLICATION_DATE` date NOT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ ΑΝΑΡΤΗΣΗΣ',
  `OFFER_LAST_DATE` date NOT NULL COMMENT 'ΚΑΤΑΛΗΚΤΙΚΗ ΗΜΕΡΟΜΗΝΙΑ ΥΠΟΒΟΛΗΣ ΠΡΟΣΦΟΡΩΝ',
  PRIMARY KEY (`idPINAKA_PUBLIC_TENDER`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `public_tender`
--

LOCK TABLES `public_tender` WRITE;
/*!40000 ALTER TABLE `public_tender` DISABLE KEYS */;
INSERT INTO `public_tender` VALUES (1,'1/22','Φ.100/201/301/Σ.401/01 ΙΑΝ 22/ΓΕΣ/ΔΥΠ',0,'2Α','09200000-1',1000000,1000000,1,'ΕΚΕΜΣ',0,0,15000,NULL,NULL,'2022-01-10','2022-01-10','2022-02-15'),(2,'2/22','Φ.100/202/302/Σ.402/02 ΙΑΝ 22/ΓΕΣ/ΔΥΠ',0,'3Β','37453400-2',400000,750000,1,'2ο ΤΥΛΠ',0,0,11250,NULL,NULL,'2022-01-25','2022-01-25','2022-03-02'),(3,'3/22','Φ.100/203/303/Σ.403/03 ΙΑΝ 22/ΓΕΣ/ΔΥΠ',0,'3Β','35331100-4',5000,900000,1,'3ο ΤΥΛ',0,1,13500,NULL,NULL,'2022-02-15','2022-02-17','2022-03-25'),(4,'4/22','Φ.100/204/304/Σ.404/04 ΙΑΝ 22/ΓΕΣ/ΔΥΠ',0,'4Γ','35321000-0',1000,4000000,1,'ΠΒΚ',0,0,60000,NULL,NULL,'2022-02-15','2022-02-15','2022-03-22'),(5,'5/22','Φ.100/205/305/Σ.405/05 ΙΑΝ 22/ΓΕΣ/ΔΥΠ',0,'5Β','33140000-3',1000000,500000,1,'401 ΓΣΝΑ',0,0,7500,NULL,NULL,'2022-02-17','2022-02-18','2022-03-25'),(6,'6/22','Φ.100/206/306/Σ.406/06 ΙΑΝ 22/ΓΕΣ/ΔΥΠ',0,'3Α','18443340-1',120000,600000,1,'1ο ΤΥΛ',0,1,9000,NULL,NULL,'2022-02-20','2022-02-20','2022-03-27'),(7,'7/22','Φ.100/207/307/Σ.407/07 ΙΑΝ 22/ΓΕΣ/ΔΥΠ',0,'5Α','33141114-2',10000,200000,1,'424 ΓΣΝΘ',0,0,3000,NULL,NULL,'2022-02-25','2022-02-26','2022-04-01'),(8,'8/22','Φ.100/208/308/Σ.408/08 ΙΑΝ 22/ΓΕΣ/ΔΥΠ',1,'3Α','35812100-0',180000,2400000,1,'2ο ΤΥΛ',0,0,36000,NULL,NULL,'2022-03-15','2022-03-15','2022-04-20'),(9,'9/22','Φ.100/209/309/Σ.409/09 ΙΑΝ 22/ΓΕΣ/ΔΥΠ',0,'4Α','34513750-8',9,4500000,0,'ΚΕΕΔ ',0,0,67500,NULL,NULL,'2022-03-20','2022-03-20','2022-04-25'),(10,'10/22','Φ.100/210/310/Σ.410/10 ΙΑΝ 22/ΓΕΣ/ΔΥΠ',1,'2Β','03211300-6',5000000,10000000,1,'ΕΚΕΜΣ',0,0,150000,NULL,NULL,'2022-01-15','2022-01-15','2022-02-20'),(11,'11/22','Φ.100/211/311/Σ.411/11 ΙΑΝ 22/ΓΕΣ/ΔΥΠ',0,'3Α','18444110-7',3000,600000,0,'1ο ΤΥΛ',0,0,2500,NULL,NULL,'2022-04-30','2022-04-30','2022-06-04');
/*!40000 ALTER TABLE `public_tender` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `insert_deadline_trigger_public_tender` AFTER INSERT ON `public_tender` FOR EACH ROW BEGIN
    INSERT INTO `deadlines` (`EIDOS`, `DATE`, `MESSAGE`,`PUBLIC_TENDER`)
    VALUES (0, DATE_ADD(NEW.`OFFER_LAST_DATE`, interval 1 DAY),CONCAT('ΧΘΕΣ ΗΤΑΝ Η ΚΑΤΑΛΗΚΤΙΚΗ ΗΜΕΡΟΜΗΝΙΑ ΥΠΟΒΟΛΗΣ ΠΡΟΣΦΟΡΩΝ ΓΙΑ ΤΟΝ ΔΙΑΓΩΝΙΣΜΟ ',new.idPUBLIC_TENDER,'. ΜΠΟΡΕΙΤΕ ΝΑ ΠΡΟΧΩΡΗΣΕΤΕ ΣΤΗΝ ΑΠΟΣΦΡΑΓΙΣΗ ΠΡΟΣΦΟΡΩΝ.'),new.idPUBLIC_TENDER);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier` (
  `AFM_SUPPLIER` varchar(9) NOT NULL COMMENT 'ΑΦΜ_ΠΡΟΜΗΘΕΥΤΗ',
  `NAME` varchar(45) NOT NULL COMMENT 'ΕΠΩΝΥΜΙΑ',
  `TELEPHONE` int NOT NULL COMMENT 'ΤΗΛΕΦΩΝΟ',
  `EMAIL` varchar(30) NOT NULL,
  `HEADQUARTERS` varchar(45) NOT NULL COMMENT 'ΕΔΡΑ',
  PRIMARY KEY (`AFM_SUPPLIER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES ('094000000','ΑΛΦΑ Α.Ε.',2105550000,'alpha@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 1, 15773, ΑΘΗΝΑ'),('094000001','ΒΗΤΑ Α.Ε',2105550001,'beta@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 2, 15773, ΑΘΗΝΑ'),('094000002','ΓΑΜΜΑ Α.Ε.',2105550002,'gamma@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 3, 15773, ΑΘΗΝΑ'),('094000003','ΔΕΛΤΑ Α.Ε.',2105550003,'delta@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 4, 15773, ΑΘΗΝΑ'),('094000004','ΕΨΙΛΟΝ Α.Ε.',2105550004,'epsilon@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 5, 15773, ΑΘΗΝΑ'),('094000005','ΖΗΤΑ Α.Ε.',2105550005,'zeta@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 6, 15773, ΑΘΗΝΑ'),('094000006','ΗΤΑ Α.Ε.',2105550006,'eta@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 7, 15773, ΑΘΗΝΑ'),('094000007','ΘΗΤΑ Α.Ε.',2105550007,'theta@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 8, 15773, ΑΘΗΝΑ'),('094000008','ΙΩΤΑ Α.Ε.',2105550008,'iota@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 9, 15773, ΑΘΗΝΑ'),('094000009','ΚΑΠΠΑ Α.Ε.',2105550009,'kappa@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 10, 15773, ΑΘΗΝΑ'),('094000010','ΛΑΜΔΑ Α.Ε.',2105550010,'lamda@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 11, 15773, ΑΘΗΝΑ'),('094000011','ΜΙ Α.Ε.',2105550011,'mi@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 12, 15773, ΑΘΗΝΑ'),('094000012','ΝΙ Α.Ε.',2105550012,'ni@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 13, 15773, ΑΘΗΝΑ'),('094000013','ΞΙ Α.Ε.',2105550013,'xi@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 14, 15773, ΑΘΗΝΑ'),('094000014','ΟΜΙΚΡΟΝ Α.Ε.',2105550014,'omikron@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 15, 15773, ΑΘΗΝΑ'),('094000015','ΠΙ Α.Ε.',2105550015,'pi@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 16, 15773, ΑΘΗΝΑ'),('094000016','ΡΟ Α.Ε.',2105550016,'ro@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 17, 15773, ΑΘΗΝΑ'),('094000017','ΣΙΓΜΑ Α.Ε.',2105550017,'sigma@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 18, 15773, ΑΘΗΝΑ'),('094000018','ΤΑΦ Α.Ε.',2105550018,'taf@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 19, 15773, ΑΘΗΝΑ'),('094000019','ΥΨΙΛΟΝ Α.Ε.',2105550019,'ypsilon@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 20, 15773, ΑΘΗΝΑ'),('094000020','ΦΙ Α.Ε.',2105550020,'fi@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 21, 15773, ΑΘΗΝΑ'),('094000021','ΧΙ Α.Ε.',2105550021,'hi@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 22, 15773, ΑΘΗΝΑ'),('094000022','ΨΙ Α.Ε.',2105550022,'psi@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 23, 15773, ΑΘΗΝΑ'),('094000023','ΩΜΕΓΑ Α.Ε.',2105550023,'omega@gmail.com','ΜΕΓΑΛΟΥ ΑΛΕΞΑΝΔΡΟΥ 24, 15773, ΑΘΗΝΑ');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_offer`
--

DROP TABLE IF EXISTS `supplier_offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier_offer` (
  `idPUBLIC_TENDER` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'idΔΙΑΓΩΝΙΣΜΟΥ',
  `idSUPPLIER` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'ΑΦΜ ΠΡΟΜΗΘΕΥΤΗ',
  `CPV` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'COMMON PROCUREMENT VOCABULARY',
  `OFFER` float DEFAULT NULL COMMENT 'ΠΡΟΣΦΟΡΑ',
  PRIMARY KEY (`idPUBLIC_TENDER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='ΠΡΟΣΦΟΡΑ ΠΡΟΜΗΘΕΥΤΗ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_offer`
--

LOCK TABLES `supplier_offer` WRITE;
/*!40000 ALTER TABLE `supplier_offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier_offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_public_tender`
--

DROP TABLE IF EXISTS `supplier_public_tender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier_public_tender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `AFM_SUPPLIER` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idPINAKA_PUBLIC_TENDER` int NOT NULL,
  `CPV` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `QUANTITY` int NOT NULL,
  `PRICE_PER_UNIT` float(15,2) NOT NULL,
  `VAT` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Προμηθευτής Συμμετέχει σε Διαγωνισμό';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_public_tender`
--

LOCK TABLES `supplier_public_tender` WRITE;
/*!40000 ALTER TABLE `supplier_public_tender` DISABLE KEYS */;
INSERT INTO `supplier_public_tender` VALUES (1,'094000000',1,'',0,0.00,0),(2,'094000000',6,'',0,0.00,0),(3,'094000000',10,'',0,0.00,0),(4,'094000001',2,'',0,0.00,0),(5,'094000001',9,'',0,0.00,0),(6,'094000001',10,'',0,0.00,0),(7,'094000002',5,'',0,0.00,0),(8,'094000002',10,'',0,0.00,0),(9,'094000003',2,'',0,0.00,0),(10,'094000003',3,'',0,0.00,0),(11,'094000003',9,'',0,0.00,0),(12,'094000004',7,'',0,0.00,0),(13,'094000005',1,'',0,0.00,0),(14,'094000005',7,'',0,0.00,0),(15,'094000005',8,'',0,0.00,0),(16,'094000006',3,'',0,0.00,0),(17,'094000008',2,'',0,0.00,0),(18,'094000008',8,'',0,0.00,0),(19,'094000008',9,'',0,0.00,0),(20,'094000009',4,'',0,0.00,0),(21,'094000009',5,'',0,0.00,0);
/*!40000 ALTER TABLE `supplier_public_tender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `symvaseis`
--

DROP TABLE IF EXISTS `symvaseis`;
/*!50001 DROP VIEW IF EXISTS `symvaseis`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `symvaseis` AS SELECT 
 1 AS `id_diagonismou`,
 1 AS `id_symvasis`,
 1 AS `CPV`,
 1 AS `promitheutis`,
 1 AS `imerominia_ypografis`,
 1 AS `paradoseis`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `temp_contractor`
--

DROP TABLE IF EXISTS `temp_contractor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temp_contractor` (
  `idPINAKA_TEMPORARY_CONTRACTOR` int NOT NULL AUTO_INCREMENT,
  `idTEMPORARY_CONTRACTOR_DECISION` varchar(30) NOT NULL COMMENT 'ΤΑΥΤΟΤΗΤΑ ΕΓΓΡΑΦΟΥ "ΑΠΟΦΑΣΗ ΠΡΟΣΩΡΙΝΟΥ ΑΝΑΔΟΧΟΥ"',
  `idPINAKA_PUBLIC_TENDER` int NOT NULL,
  `AFM_SUPPLIER` varchar(9) NOT NULL COMMENT 'ΑΦΜ ΠΡΟΣΩΡΙΝΟΥ ΑΝΑΔΟΧΟΥ',
  `CPV` varchar(20) NOT NULL,
  `QUANTITY` int NOT NULL,
  `TOTAL_VALUE` float(15,2) NOT NULL,
  `SIGN_DATE` date NOT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ ΥΠΟΓΡΑΦΗΣ',
  `PUBLICATION_DATE` date NOT NULL COMMENT 'ΗΜΕΡΟΜΗΝΙΑ ΑΝΑΡΤΗΣΗΣ ΣΤΟ ΔΙΑΔΙΚΤΥΟ',
  `NUM_OF_APPEAL_DAYS` int NOT NULL,
  PRIMARY KEY (`idPINAKA_TEMPORARY_CONTRACTOR`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_contractor`
--

LOCK TABLES `temp_contractor` WRITE;
/*!40000 ALTER TABLE `temp_contractor` DISABLE KEYS */;
INSERT INTO `temp_contractor` VALUES (1,'Φ.200/201/201/Σ.201',1,'094000000','09200000-1',11500000,900000.00,'2022-02-20','2022-02-20',10),(2,'Φ.200/202/202/Σ.202',2,'094000001','37453400-2',400000,750000.00,'2022-03-10','2022-03-20',10),(3,'Φ.200/203/203/Σ.203',3,'094000003','35331100-4',5000,900000.00,'2022-03-30','2022-03-31',10),(4,'Φ.200/204/204/Σ.204',4,'094000009','35321000-0',1000,4000000.00,'2022-03-28','2022-03-28',10),(5,'Φ.200/205/205/Σ.205',5,'094000002','33140000-3',1000000,500000.00,'2022-04-01','2022-04-01',10),(6,'Φ.200/206/206/Σ.206',6,'094000000','18443340-1',120000,600000.00,'2022-04-02','2022-04-02',10),(7,'Φ.200/207/207/Σ.207',7,'094000004','33141114-2',10000,200000.00,'2022-04-10','2022-04-10',10),(8,'Φ.200/208/208/Σ.208',8,'094000005','35812100-0',180000,2400000.00,'2022-04-25','2022-04-25',10),(9,'Φ.200/209/209/Σ.209',9,'094000008','34513750-8',9,4500000.00,'2022-04-27','2022-04-27',10),(10,'Φ.200/210/210/Σ.210',10,'094000002','18444110-7',3050,600000.00,'2022-03-10','2022-03-10',10);
/*!40000 ALTER TABLE `temp_contractor` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `insert_deadline_trigger_temp_contractor` AFTER INSERT ON `temp_contractor` FOR EACH ROW BEGIN
	DECLARE public_tender_id varchar(10);
    
	SELECT pt.idPUBLIC_TENDER INTO public_tender_id
    FROM public_tender pt inner join temp_contractor tc on pt.idPINAKA_PUBLIC_TENDER=tc.idPINAKA_PUBLIC_TENDER
    WHERE pt.idPINAKA_PUBLIC_TENDER = NEW.idPINAKA_PUBLIC_TENDER;
    
    INSERT INTO `deadlines` (`EIDOS`, `DATE`, `MESSAGE`,`PUBLIC_TENDER`)
    VALUES (1, DATE_ADD(DATE_ADD(NEW.`PUBLICATION_DATE`, INTERVAL NEW.`NUM_OF_APPEAL_DAYS` DAY), INTERVAL 1 DAY),CONCAT('ΧΘΕΣ ΕΛΗΞΕ Η ΗΜΕΡΟΜΗΝΙΑ ΥΠΟΒΟΛΗΣ ΕΝΣΤΑΣΕΩΝ ΓΙΑ ΤΗΝ ΑΠΟΦΑΣΗ ΟΙΚΟΝΟΜΙΚΩΝ ΠΡΟΣΦΟΡΩΝ ΤΟΥ ΔΙΑΓΩΝΙΣΜΟΥ ',public_tender_id,'. ΜΠΟΡΕΙΤΕ ΝΑ ΠΡΟΧΩΡΗΣΕΤΕ ΣΤΗΝ ΔΙΑΔΙΚΑΣΙΑ ΚΑΤΑΚΥΡΩΣΗΣ ΤΟΥ ΔΙΑΓΩΝΙΣΜΟΥ.'),public_tender_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `idUSER` varchar(10) NOT NULL COMMENT 'id ΧΡΗΣΤΗ',
  `PASSWORK` varchar(45) NOT NULL,
  `POSITION` varchar(15) NOT NULL COMMENT 'ΘΕΣΗ (ΕΠΙΤΕΛΗΣ\\ΠΡΟΪΣΤΑΜΕΝΟΣ\\ΥΠΟΔΙΕΥΘΥΝΤΗΣ\\ΔΙΕΥΘΥΝΤΗΣ)',
  `DEPARTMENT` varchar(6) NOT NULL COMMENT 'ΤΜΗΜΑ',
  `FIRST_NAME` varchar(15) NOT NULL COMMENT 'ΟΝΟΜΑ',
  `LASTNAME` varchar(20) NOT NULL COMMENT 'ΕΠΩΝΥΜΟ',
  `RANK` varchar(15) NOT NULL COMMENT 'ΒΑΘΜΟΣ',
  `BRANCH` varchar(20) NOT NULL COMMENT 'ΟΠΛΟ-ΣΩΜΑ',
  PRIMARY KEY (`idUSER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('dpm1001','','ΕΠΙΤΕΛΗΣ','3Α','ΑΝΤΩΝΙΟΣ','ΛΑΔΟΠΟΥΛΟΣ','ΥΠΟΛΟΧΑΓΟΣ','Ο'),('dpm1002','','ΕΠΙΤΕΛΗΣ','4Α','ΓΕΩΡΓΙΟΣ','ΧΡΗΣΤΙΔΗΣ','ΛΟΧΑΓΟΣ','ΠΒ'),('dpm1003','','ΕΠΙΤΕΛΗΣ','2Α','ΓΕΩΡΓΙΟΣ','ΠΑΠΑΔΟΠΟΥΛΟΣ','ΤΑΓΜΑΤΑΡΧΗΣ','ΕΜ'),('dpm1004','','ΠΡΟΪΣΤΑΜΕΝΟΣ','3','ΣΥΜΕΩΝ','ΜΠΑΤΖΩΝΗΣ','ΣΥΝΤΑΓΜΑΤΑΡΧΗΣ','ΥΠ'),('dpm1005','','ΕΠΙΤΕΛΗΣ','5Α','ΙΩΑΝΝΗΣ','ΧΛΙΜΙΤΖΑΣ','ΛΟΧΙΑΣ','ΥΓ'),('dpm1006','','ΠΡΟΪΣΤΑΜΕΝΟΣ','4','ΓΡΗΓΟΡΙΟΣ','ΣΠΑΝΟΣ','ΛΟΧΑΓΟΣ','ΤΘ'),('dpm1007','','ΥΠΟΔΙΕΥΘΥΝΤΗΣ','','ΤΡΙΑΝΤΑΦΥΛΛΟΣ','ΚΑΤΣΑΡΟΣ','ΣΥΝΤΑΓΜΑΤΑΡΧΗΣ','ΔΒ'),('dpm1008','','ΠΡΟΪΣΤΑΜΕΝΟΣ','3','ΚΩΝΣΤΑΝΤΙΝΟΣ','ΣΙΟΝΤΗΣ','ΤΑΓΜΑΤΑΡΧΗΣ','ΕΜ'),('dpm1009','','ΔΙΕΥΘΥΝΤΗΣ','','ΑΘΑΝΑΣΙΟΣ','ΠΑΣΣΑΣ','ΤΑΞΙΑΡΧΟΣ','ΕΠ'),('dpm1010','','ΠΡΟΪΣΤΑΜΕΝΟΣ','5','ΤΡΥΦΩΝ','ΣΠΑΝΤΙΔΟΣ','ΣΥΝΤΑΓΜΑΤΑΡΧΗΣ','ΥΟ'),('dpm1011','','ΠΡΟΪΣΤΑΜΕΝΟΣ','2','ΚΩΝΣΤΑΝΤΙΝΟΣ','ΜΠΑΤΣΟΣ','ΑΝΤΙΣΥΝΤΑΓΜΑΤΑΡ','ΕΜ'),('dpm1012','','ΠΡΟΪΣΤΑΜΕΝΟΣ','6','ΔΗΜΗΤΡΙΟΣ','ΚΟΥΤΡΙΔΗΣ','ΑΝΘΥΠΟΛΟΧΑΓΟΣ','Ο'),('dpm1013','','ΕΠΙΤΕΛΗΣ','7','ΘΕΩΔΟΡΟΣ','ΓΟΥΛΑΣ','ΑΝΘΥΠΑΣΠΙΣΤΗΣ','ΑΣ'),('dpm1014','','ΠΡΟΪΣΤΑΜΕΝΟΣ','7','ΚΩΝΣΤΑΝΤΙΝΟΣ','ΚΑΡΑΪΣΚΟΣ','ΑΝΤΙΣΥΝΤΑΓΜΑΤΑΡ','ΤΧ');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'procurement'
--

--
-- Dumping routines for database 'procurement'
--

--
-- Final view structure for view `diagonismoi`
--

/*!50001 DROP VIEW IF EXISTS `diagonismoi`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `diagonismoi` AS select `public_tender`.`idPUBLIC_TENDER` AS `id`,`public_tender`.`CPV` AS `cpv`,`public_tender`.`QUANTITY` AS `posotita`,`public_tender`.`BUDGET` AS `axia`,`public_tender`.`TECHNICAL_SPECIFICATION` AS `techniki_prodiagrafi`,`public_tender`.`UNIT_OF_DELIVERY` AS `monada_paradosis`,`public_tender`.`DIVIDABILITY_BY_CPV` AS `diairetotita_kata_eidos`,`public_tender`.`DIVIDABILITY_BY_QUANTITY` AS `diairototita_kata_posotita` from `public_tender` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `symvaseis`
--

/*!50001 DROP VIEW IF EXISTS `symvaseis`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `symvaseis` AS select `pt`.`idPUBLIC_TENDER` AS `id_diagonismou`,`c`.`idCONTRACT` AS `id_symvasis`,`tc`.`CPV` AS `CPV`,`s`.`NAME` AS `promitheutis`,`c`.`SIGN_DATE` AS `imerominia_ypografis`,`c`.`DELIVERIES` AS `paradoseis` from ((((`public_tender` `pt` join `temp_contractor` `tc` on((`pt`.`idPINAKA_PUBLIC_TENDER` = `tc`.`idPINAKA_PUBLIC_TENDER`))) join `awarding_contractor` `ac` on((`tc`.`idPINAKA_TEMPORARY_CONTRACTOR` = `ac`.`idPINAKA_TEMPORARY_CONTRACTOR`))) join `contract` `c` on((`ac`.`idPINAKA_AWARDING_CONTRACTOR` = `c`.`idPINAKA_AWARDING_CONTRACTOR`))) join `supplier` `s` on((`s`.`AFM_SUPPLIER` = `tc`.`AFM_SUPPLIER`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-16  1:13:23
