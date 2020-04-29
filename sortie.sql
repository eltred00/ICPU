-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: umls
-- ------------------------------------------------------
-- Server version	10.1.37-MariaDB

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
-- Table structure for table `transfusion_terms`
--

DROP TABLE IF EXISTS `transfusion_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transfusion_terms` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descConcept` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfusion_terms`
--

LOCK TABLES `transfusion_terms` WRITE;
/*!40000 ALTER TABLE `transfusion_terms` DISABLE KEYS */;
INSERT INTO `transfusion_terms` VALUES (1,'C0001175','Acquired  Immunodeficiency Syndrome\r'),(2,'C0002627','Amniocentesis\r'),(3,'C0030605','Activated  Partial Thromboplastin  Time measurement\r'),(4,'C0002962','Angina  Pectoris\r'),(5,'C0043031','Warfarin\r'),(6,'C0019682','HIV\r'),(7,'C0162871','Aortic  Aneurysm'),(8,'C0005767','Blood\r'),(9,'C2926614','Everdiagnosed by  a doctor as having an abdominal aortic aneurysm:Finding:Point in time:^Patient:Ordinal \r'),(10,'C0005768','In  Blood\r'),(11,'C0229664','peripheral  blood\r'),(12,'C0023896','Alcoholic  Liver Diseases\r'),(13,'C0005810','Blood  Group (classification)\r'),(14,'C0600103','Blood  group transfusion  observation\r'),(15,'C0003232','Antibiotics\r'),(16,'C0003280','Anticoagulants\r'),(17,'C0001122','Acidosis\r'),(18,'C0003130','Anoxia\r'),(19,'C0242184','Hypoxia\r'),(20,'C1963140','Hypoxia  Adverse Event\r'),(21,'C0220981','Metabolic  acidosis\r'),(22,'C0226004','Arterial  system\r'),(23,'C0003842','Arteries\r'),(24,'C0005953','Bone  Marrow\r'),(25,'C0012634','Disease\r'),(26,'C0019080','Hemorrhage\r'),(27,'C0005791','Apheresis  (procedure)\r'),(28,'C1515895','Allogeneic\r'),(29,'C4522247','Allogeneic  Blood Product  Donation\r'),(30,'C0002871','Anemia\r'),(31,'C0003241','Antibodies \r'),(32,'C3536809','Antihistamine  [EPC]\r'),(33,'C0003360','Antihistamines\r'),(34,'C0085430','Blood  Component Transfusion\r'),(35,'C0450129','Blood  component\r'),(36,'C1413336','CEL  gene\r'),(37,'C1948049','Cell  (compartment)\r'),(38,'C1704653','Cell  Device Component\r'),(39,'C0007634','Cells\r'),(40,'C0453946','Coat  (physical object)\r'),(41,'C0019592','Histamine  H1 Antagonists\r'),(42,'C3665580','Immunoglobulin  complex location'),(43,'C0021027','Immunoglobulins\r'),(44,'C0237820','Recovery  - action\r'),(45,'C0085405','Salvage  Therapy\r'),(46,'C0442967','Salvage  procedure\r'),(47,'C2709037','ante  partum\r'),(48,'C0368675','antibody  antigen\r'),(49,'C0856716','aspirin  asthma\r'),(50,'C0369095','d  antibody\r'),(51,'C2976467','EPO  protein'),(52,'C0357126','Epoetin  Alfa\r'),(53,'C0014822','Erythropoietin\r'),(54,'C0376541','Recombinant  Erythropoietin\r'),(55,'C1755594','erythropoietin  activity\r'),(56,'C0007785','Cerebral  Infarction\r'),(57,'C0015505','Factor  VIIa\r'),(58,'C0857490','Granulocyte  count\r'),(59,'C4521391','Granulocytes  Product\r'),(60,'C0018183','granulocyte\r'),(61,'C0016006','Fibrinogen\r'),(62,'C3540039','Fibrinogen  containing hemostatics\r'),(63,'C1167394','fibrinogen  complex location\r'),(64,'C2587184','fibrinogen  concentrate (human)\r'),(65,'C1547245','Blood  Product Code  - Fresh  Frozen Plasma\r'),(66,'C0016709','Fresh  frozen plasma\r'),(67,'C0014792','Erythrocytes\r'),(68,'C0015879','Ferritin\r'),(69,'C0014772','Red  Blood Cell  Count measurement\r'),(70,'C0013798','Electrocardiogram\r'),(71,'C1705651','Electrocardiogram  Domain\r'),(72,'C1623258','Electrocardiography\r'),(73,'C2348066','dabigatran\r'),(74,'C0000941','Accreditation\r'),(75,'C2732002','Antihemophilic  Factor'),(76,'C0015506','Factor  VIII\r'),(77,'C1307126','factor  VIII'),(78,'C0010825','Cytomegalovirus\r'),(79,'C0149871','Deep  Vein Thrombosis\r'),(80,'C0011946','Dialysis  procedure\r'),(81,'C1059964','Genus  Dialysis\r'),(82,'C0011945','Physical  Dialysis\r'),(83,'C0003130','Anoxia\r'),(84,'C0024117','Chronic  Obstructive Airway  Disease\r'),(85,'C3245512','HL7PublishingSubSection  <practice>\r'),(86,'C0242184','Hypoxia\r'),(87,'C1963140','Hypoxia  Adverse Event\r'),(88,'C0030667','Pathology'),(89,'C0237607','Practice  Experience\r'),(90,'C1547561','Authorization  Mode -  Electronic\r'),(91,'C0012634','Disease\r'),(92,'C0013850','Electronic\r'),(93,'C4281784','Electronics  discipline\r'),(94,'C0013990','Pathological  accumulation of  air in  tissues\r'),(95,'C0034067','Pulmonary  Emphysema\r'),(96,'C0005778','Blood  coagulation\r'),(97,'C0441509','Coagulation  procedure\r'),(98,'C1328723','Coagulation  process\r'),(99,'C1554192','ActClass  - consent\r'),(100,'C0007584','Cell  Count\r'),(101,'C0007634','Cells\r'),(102,'C2937358','Cerebral  Hemorrhage\r'),(103,'C1511481','Consent\r'),(104,'C0855279','Crossmatch\r'),(105,'C0012240','Gastrointestinal  system\r'),(106,'C0205170','Good\r'),(107,'C0018928','Hematinics\r'),(108,'C0442123','Intravascular\r'),(109,'C2960476','Intravascular  Route of  Drug Administration\r'),(110,'C1706387','Issue  (document)\r'),(111,'C1141951','Panel-reactive  antibody\r'),(112,'C0033213','Problem\r'),(113,'C0443121','cryoprecipitate\r'),(114,'C1165603','dextrose  solution\r'),(115,'C0870840','manufacture\r'),(116,'C1332206','Adult  Lymphoma\r'),(117,'C1332979','Childhood  Lymphoma\r'),(118,'C0024299','Lymphoma\r'),(119,'C0304925','Albumin  Human'),(120,'C0018991','Hemiplegia\r'),(121,'C0018951','Hematopoiesis\r'),(122,'C0003130','Anoxia\r'),(123,'C0413252','Hypothermia  due to  exposure\r'),(124,'C0020672','Hypothermia'),(125,'C0242184','Hypoxia\r'),(126,'C1963140','Hypoxia  Adverse Event\r'),(127,'C0021289','Infant'),(128,'C0019134','heparin\r'),(129,'C0770546','heparin'),(130,'C1963138','Hypertension  Adverse Event\r'),(131,'C0020538','Hypertensive  disease\r'),(132,'C0020649','Hypotension\r'),(133,'C3163620','Hypotension  Adverse Event\r'),(134,'C0018747','Health  Services\r'),(135,'C0518014','Hematocrit  level\r'),(136,'C0019046','Hemoglobin\r'),(137,'C0019045','Hemoglobinopathies\r'),(138,'C2937287','Hemolysis  (biological function)\r'),(139,'C0019054','Hemolysis  (disorder)\r'),(140,'C0019080','Hemorrhage\r'),(141,'C0740166','Hemostasis  procedure\r'),(142,'C0019116','Hemostatic  function\r'),(143,'C1547311','Patient  Condition Code  - Stable\r'),(144,'C0205360','Stable  status\r'),(145,'C0359180','albumin  solution\r'),(146,'C1263988','hemolytic  disease\r'),(147,'C1518422','Negation\r'),(148,'C0376520','Dietary  Iron\r'),(149,'C1166521','Ferrum  metallicum'),(150,'C0302583','Iron\r'),(151,'C3714701','Iron  Drug Class\r'),(152,'C0043299','Diagnostic  radiologic examination\r'),(153,'C1306645','Plain  x-ray\r'),(154,'C1962945','Radiographic  imaging procedure\r'),(155,'C3891450','Radiography  Study File\r'),(156,'C0043309','Roentgen  Rays\r'),(157,'C0034571','roentgenographic\r'),(158,'C0000970','Acetaminophen\r'),(159,'C0005767','Blood\r'),(160,'C0005768','In  Blood\r'),(161,'C0229664','peripheral  blood\r'),(162,'C0428953','Electrocardiogram:  myocardial infarction  (finding)\r'),(163,'C0022346','Icterus\r'),(164,'C0027051','Myocardial  Infarction\r'),(165,'C3810814','Myocardial  Infarction ECG  Assessment\r'),(166,'C2926063','Myocardial  infarction         \r'),(167,'C2010848','jaundice\r'),(168,'C0024204','lymph  nodes\r'),(169,'C0005821','Blood  Platelets\r'),(170,'C1963076','Platelets  Adverse Event\r'),(171,'C0443116','Platelets  Product\r'),(172,'C0032285','Pneumonia\r'),(173,'C0086388','Health  Care\r'),(174,'C0028773','Discipline  of obstetrics\r'),(175,'C0282193','Iron  Overload\r'),(176,'C1963148','Iron  Overload Adverse  Event\r'),(177,'C0587597','Obstetrics  service\r'),(178,'C0027462','Health  Services'),(179,'C0024235','Lymphatic  System\r'),(180,'C0030312','Pancytopenia\r'),(181,'C0032326','Pneumothorax\r'),(182,'C1963215','Pneumothorax  Adverse Event\r'),(183,'C0086960','Schedule  (document type)              \r'),(185,'C0013227','Pharmaceutical  Preparations\r'),(186,'C1552615','Act  Relationship Subset  - maximum\r'),(187,'C1548980','Blood  Product Processing  Requirements - Irradiated\r'),(188,'C0005841','Blood  Transfusion\r'),(189,'C0449432','Component  object\r'),(190,'C1546934','Event  Reported To  - Regulatory agency\r'),(191,'C2349976','Gamma  - unit  of measure\r'),(192,'C0017011','Gamma  Rays\r'),(193,'C0442123','Intravascular\r'),(194,'C2960476','Intravascular  Route of  Drug Administration\r'),(195,'C0348016','Intravenous\r'),(196,'C1277077','Irradiated  blood product  (product)\r'),(197,'C0023212','Left-Sided  Heart Failure\r'),(198,'C0023516','Leukocytes\r'),(199,'C3463824','MYELODYSPLASTIC  SYNDROME\r'),(200,'C0806909','Maximum\r'),(201,'C2826546','Maximum  Value Derivation  Technique\r'),(202,'C0026764','Multiple  Myeloma\r'),(203,'C0026985','Myelodysplasia\r'),(204,'C3538749','NCI  CTEP SDC  Myeloma Sub-Category Terminology\r'),(205,'C0302523','Observation  in research\r'),(206,'C3244290','Observations  domain\r'),(207,'C1882154','Operative\r'),(208,'C0543467','Operative  Surgical Procedures\r'),(209,'C1705178','Order  (action)\r'),(210,'C1705176','Order  (arrangement)\r'),(211,'C1705175','Order  (document)\r'),(212,'C1705177','Order  (taxonomic)\r'),(213,'C0483415','Oxygen  saturation test  result\r'),(214,'C0700325','Patient  observation\r'),(215,'C1882348','Permutation\r'),(216,'C1254351','Pharmacologic  Substance\r'),(217,'C0687676','Post\r'),(218,'C1704687','Post  Device Component\r'),(219,'C1571888','Report  source -  Regulatory agency\r'),(220,'C3469826','SLC35G1  gene\r'),(221,'C3889825','Sequence  of Planned  Assessment Schedule\r'),(222,'C0587668','Surgical  service\r'),(223,'C1522449','Therapeutic  radiology procedure\r'),(224,'C1879316','Transfusion  (procedure)\r'),(225,'C0199960','Transfusion  - action\r'),(226,'C0042149','Uterus\r'),(227,'C0682356','Witnesses\r'),(228,'C0023418','leukemia\r'),(229,'C1514468','product\r'),(230,'C0680775','regulatory  agency\r'),(231,'C0003209','Anti-Inflammatory  Agents\r'),(232,'C1515999','Anti-inflammatory  effect\r'),(233,'C1518422','Negation\r'),(234,'C1565536','Octaplex\r'),(235,'C0347985','intra\r'),(236,'C0482694','Coagulation  tissue factor\r'),(237,'C1739768','rivaroxaban\r'),(238,'C0005767','Blood\r'),(239,'C0005768','In  Blood\r'),(240,'C0229664','peripheral  blood\r'),(241,'C0036043','Safety\r'),(242,'C1705187','Safety  Study\r'),(243,'C3245512','HL7 PublishingSubSection\r'),(244,'C0237607','Practice  Experience\r'),(245,'C3541888','CDISC  Events Class\r'),(246,'C0441471','Event\r'),(247,'C1515981','And\r'),(248,'C0332152','Before\r'),(249,'C0740175','Before  values\r'),(250,'C0040300','Body  tissue\r'),(251,'C0014792','Erythrocytes\r'),(252,'C0015967','Fever\r'),(253,'C1882154','Operative\r'),(254,'C0199176','Prophylactic  treatment\r'),(255,'C0034063','Pulmonary  Edema\r'),(256,'C0034065','Pulmonary  Embolism\r'),(257,'C0232804','Renal  function\r'),(258,'C0424790','Rigor  - Temperature-associated  observation\r'),(259,'C4048712','factor  IX complex\r'),(260,'C2257086','photoreactivating  enzyme activity\r'),(261,'C0850002','post  partum haemorrhage\r'),(262,'C0033107','prevention  & control\r'),(263,'C3853787','prophylaxis\r'),(264,'C0037993','Spleen\r'),(265,'C0038002','Splenomegaly\r'),(266,'C0037995','Splenectomy\r'),(267,'C0038250','Stem  cells\r'),(268,'C0005841','Blood  Transfusion\r'),(269,'C0205404','Serious\r'),(270,'C0205555','Special\r'),(271,'C1879316','Transfusion  (procedure)\r'),(272,'C0199960','Transfusion  - action\r'),(273,'C0598697','hazard\r'),(274,'C0042878','Vitamin  K\r'),(275,'C3714648','Vitamin  K Drug  Class\r'),(276,'C2936884','Vitamin  K [EPC]\r'),(277,'C3541380','Vitamin  K containing  hemostatics\r'),(278,'C0042420','Vasovagal  syncope\r'),(279,'C0005857','Bloodletting\r'),(280,'C0684257','Venesection\r'),(281,'C0190979','Venous  blood sampling\r'),(282,'C0043031','Warfarin\r'),(283,'C0039231','Tachycardia\r'),(284,'C3827868','Tachycardia  by ECG  Finding\r'),(285,'C0005821','Blood  Platelets\r'),(286,'C3816193','Nucleated  Thrombocyte Count\r'),(287,'C0282332','Cold  Chain\r'),(288,'C0040613','Tranexamic  Acid\r'),(289,'C2921022','Transfusion  associated circulatory  overload\r'),(290,'C0242488','Acute  Lung Injury\r'),(291,'C0302148','Blood  Clot\r'),(292,'C0392386','Decreased  platelet count\r'),(293,'C0040034','Thrombocytopenia\r'),(294,'C0087086','Thrombus\r'),(295,'C3146237','Thrombus  (sponge genus)\r'),(296,'C0042396','Vascular  constriction (function)\r'),(297,'C3536904','Vasoconstriction\r'),(298,'C0042401','Vasodilation\r'),(299,'C3537065','Vasodilation\r'),(300,'C0595862','Vasodilation  disorder\r'),(301,'C0005841','Blood  Transfusion\r'),(302,'C1879316','Transfusion  (procedure)\r'),(303,'C0199960','Transfusion  - action\r'),(304,'C0012634','Disease\r'),(305,'C0042449','Veins\r'),(306,'C0018133','Graft-vs-Host  Disease\r'),(307,'C3714514','Infection\r'),(308,'C1558950','Adverse  Event Associated  with Vascular\r'),(309,'C0332281','Associated  with\r'),(310,'C0005847','Blood  Vessel\r'),(311,'C0439849','Relationships\r'),(312,'C0039070','Syncope\r'),(313,'C0332289','Transmitted  by\r'),(314,'C0205419','Variant\r'),(315,'C1801960','Vascular\r'),(316,'C0242781','disease  transmission\r'),(317,'C1521797','transmission  process\r');
/*!40000 ALTER TABLE `transfusion_terms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-16 12:53:33
