-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: mxy
-- ------------------------------------------------------
-- Server version	5.7.26

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
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_user` (
  `uid` int(10) NOT NULL COMMENT '管理员id',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_time_last` int(10) NOT NULL COMMENT '最后登录时间',
  `login_num` int(10) NOT NULL COMMENT '总计登录次数',
  `login_ip_last` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user`
--

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_data`
--

DROP TABLE IF EXISTS `api_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_data` (
  `id` int(11) NOT NULL,
  `api_name` varchar(100) NOT NULL,
  `api_link` varchar(100) NOT NULL,
  `api_notice` varchar(1000) NOT NULL,
  `api_example` varchar(1000) NOT NULL COMMENT '请求示例',
  `api_way` varchar(1000) NOT NULL COMMENT '请求方式',
  `api_format` varchar(1000) NOT NULL COMMENT 'api数据返回格式',
  `api_return` varchar(1000) NOT NULL COMMENT '接口返回数据',
  `api_par` varchar(1000) NOT NULL COMMENT '接口参数数据',
  `api_par_return` varchar(1000) NOT NULL COMMENT '接口返回参数数据',
  `api_type` varchar(100) NOT NULL COMMENT 'API状态'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_data`
--

LOCK TABLES `api_data` WRITE;
/*!40000 ALTER TABLE `api_data` DISABLE KEYS */;
INSERT INTO `api_data` VALUES (1,'这是个示例','http://localhost/api/test.php','请在这里填写api简介','http://localhost/api/test.php','GET','IMAGE','<img src=\"/admin/images/logo.png\" width=\"200px\" height=\"200px\">','{\n  \"data\": [\n    {\n      \"name\": \"example1\",\n      \"doc\": \"这是示例参数1\",\n      \"type\": \"str\",\n      \"need\": \"否\"\n    },\n    {\n      \"name\": \"example2\",\n      \"doc\": \"这是示例参数2\",\n      \"type\": \"str\",\n      \"need\": \"否\"\n    }\n  ]\n}','{\n	\"data\":[\n		{\n			\"name\": \"coe\",\n			\"doc\": \"返回状态码\",\n			\"type\": \"int\"\n		},\n		{\n		\"name\": \"data\",\n		\"doc\": \"接口返回的数据\",\n		\"type\": \"str\"\n		}\n	]\n}','正常');
/*!40000 ALTER TABLE `api_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_use_data`
--

DROP TABLE IF EXISTS `api_use_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_use_data` (
  `date` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_use_data`
--

LOCK TABLES `api_use_data` WRITE;
/*!40000 ALTER TABLE `api_use_data` DISABLE KEYS */;
INSERT INTO `api_use_data` VALUES ('total',1,0);
/*!40000 ALTER TABLE `api_use_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_data`
--

DROP TABLE IF EXISTS `event_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_data` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `event` varchar(100) DEFAULT NULL,
  `event_time` int(11) NOT NULL,
  `event_ip` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_data`
--

LOCK TABLES `event_data` WRITE;
/*!40000 ALTER TABLE `event_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friend_data`
--

DROP TABLE IF EXISTS `friend_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `friend_data` (
  `friend_name` varchar(100) NOT NULL,
  `friend_icon_url` varchar(100) NOT NULL,
  `friend_doc` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `friend_url` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friend_data`
--

LOCK TABLES `friend_data` WRITE;
/*!40000 ALTER TABLE `friend_data` DISABLE KEYS */;
INSERT INTO `friend_data` VALUES ('VitaApi','/admin/images/logo.png','VitaApi的官方仓库',1,'https://github.com/mengxinyuan638/VitaApi');
/*!40000 ALTER TABLE `friend_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_data`
--

DROP TABLE IF EXISTS `menu_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_data` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `menu_url` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_data`
--

LOCK TABLES `menu_data` WRITE;
/*!40000 ALTER TABLE `menu_data` DISABLE KEYS */;
INSERT INTO `menu_data` VALUES (1,'百度','https://www.baidu.com');
/*!40000 ALTER TABLE `menu_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_data`
--

DROP TABLE IF EXISTS `site_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_data` (
  `site_name` varchar(100) NOT NULL COMMENT '平台名称',
  `site_qq` varchar(100) NOT NULL,
  `site_link` varchar(100) NOT NULL,
  `site_title_2` varchar(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `notice_data` varchar(100) NOT NULL COMMENT '公告数据',
  `notice_type` varchar(100) NOT NULL COMMENT '公告开启状态',
  `background` varchar(100) NOT NULL COMMENT '背景链接'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_data`
--

LOCK TABLES `site_data` WRITE;
/*!40000 ALTER TABLE `site_data` DISABLE KEYS */;
INSERT INTO `site_data` VALUES ('萌新源api','1648576390','http://localhost','提供免费快速的api接口','site','大家好，我是萌新源，我正在使用VitaApi管理系统搭建api平台，已经超越全国99%的用户，你也快来试试吧','true','/index/images/slide01.jpg');
/*!40000 ALTER TABLE `site_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitor_data`
--

DROP TABLE IF EXISTS `visitor_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visitor_data` (
  `visit_time` varchar(100) NOT NULL,
  `visit_num` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitor_data`
--

LOCK TABLES `visitor_data` WRITE;
/*!40000 ALTER TABLE `visitor_data` DISABLE KEYS */;
INSERT INTO `visitor_data` VALUES ('total',0);
/*!40000 ALTER TABLE `visitor_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'mxy'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-01 17:30:21
