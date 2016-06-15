-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: 123.57.31.72    Database: sports
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `ad`
--

DROP TABLE IF EXISTS `ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad` (
  `ad_id` int(32) NOT NULL AUTO_INCREMENT,
  `ad_title` varchar(100) DEFAULT NULL,
  `ad_content` text,
  `ad_url` text,
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad`
--

LOCK TABLES `ad` WRITE;
/*!40000 ALTER TABLE `ad` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apply`
--

DROP TABLE IF EXISTS `apply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apply` (
  `apply_id` int(32) NOT NULL AUTO_INCREMENT,
  `user_id` int(32) DEFAULT NULL,
  `user_img` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `card_img` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `event` int(32) DEFAULT NULL,
  PRIMARY KEY (`apply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apply`
--

LOCK TABLES `apply` WRITE;
/*!40000 ALTER TABLE `apply` DISABLE KEYS */;
/*!40000 ALTER TABLE `apply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `club`
--

DROP TABLE IF EXISTS `club`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `club` (
  `club_id` int(32) NOT NULL AUTO_INCREMENT,
  `club_name` varchar(100) DEFAULT NULL,
  `img` text COMMENT '头像',
  `rank` varchar(32) NOT NULL DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`club_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `club`
--

LOCK TABLES `club` WRITE;
/*!40000 ALTER TABLE `club` DISABLE KEYS */;
INSERT INTO `club` VALUES (1,'俱乐部1',NULL,'0',NULL),(2,'俱乐部2',NULL,'0',NULL);
/*!40000 ALTER TABLE `club` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `comment_id` int(32) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) DEFAULT NULL,
  `video_id` varchar(32) DEFAULT NULL,
  `content` text,
  `create_time` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,'4','2','评论内容','1464872221');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorite` (
  `favo_id` int(32) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) DEFAULT NULL COMMENT '关注用户的id',
  `atten_id` varchar(32) DEFAULT NULL COMMENT '被关注用户的id',
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`favo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite`
--

LOCK TABLES `favorite` WRITE;
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
INSERT INTO `favorite` VALUES (1,'2','1',NULL),(2,'2','3',NULL),(3,'2','2',NULL),(4,'2','1',NULL),(5,'2','3',NULL),(6,'2','3',NULL),(7,'2','1',NULL),(8,'2','2',NULL),(9,'2','3',NULL),(10,'2','3',NULL),(11,'2','1',NULL),(12,'2','3',NULL),(13,'2','2',NULL),(14,'2','2',NULL),(15,'2','1',NULL),(16,'2','3',NULL),(17,'2','1',NULL),(18,'2','2',NULL),(19,'2','3',NULL),(20,'2','1',NULL),(21,'2','3',NULL),(22,'2','2',NULL),(23,'2','3',NULL),(24,'2','1',NULL),(25,'2','2',NULL),(26,'2','2',NULL),(27,'2','2',NULL),(28,'2','2',NULL),(29,'2','2',NULL),(30,'2','2',NULL),(31,'2','2',NULL),(32,'2','1',NULL);
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `feedback_id` int(32) NOT NULL AUTO_INCREMENT,
  `user_id` int(32) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `add_time` varchar(50) NOT NULL,
  `status` smallint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,2,'éŽ´æˆžæ§¸å¨´å¬­ç˜¯é¨å‹«å¼½æ££å œä¿ŠéŽ­îˆ›åžœé„îˆ›ç¥´ç’‡æ› æ®‘é™å¶‰î›­æ·‡â„ƒä¼…éŽ´æˆžæ§¸å¨´å¬­ç˜¯é¨å‹«å¼½æ££å œä¿ŠéŽ­ï¿½','1464681987',0),(2,2,'éŽ´æˆžæ§¸å¨´å¬­ç˜¯é¨å‹«å¼½æ££å œä¿ŠéŽ­îˆ›åžœé„îˆ›ç¥´ç’‡æ› æ®‘é™å¶‰î›­æ·‡â„ƒä¼…éŽ´æˆžæ§¸å¨´å¬­ç˜¯é¨å‹«å¼½æ££å œä¿ŠéŽ­ï¿½','1464681999',0);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follow`
--

DROP TABLE IF EXISTS `follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follow` (
  `follow_id` int(32) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) DEFAULT NULL COMMENT '被follow的id',
  `follow_user` varchar(32) DEFAULT NULL COMMENT 'follow的id',
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`follow_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follow`
--

LOCK TABLES `follow` WRITE;
/*!40000 ALTER TABLE `follow` DISABLE KEYS */;
INSERT INTO `follow` VALUES (1,'2','3',NULL),(2,'1','2',NULL);
/*!40000 ALTER TABLE `follow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game` (
  `game_id` int(32) NOT NULL AUTO_INCREMENT,
  `game_name` varchar(500) DEFAULT NULL,
  `game_img` varchar(100) DEFAULT NULL,
  `user_id` varchar(32) DEFAULT NULL COMMENT '发起人',
  `type_id` varchar(32) DEFAULT NULL,
  `is_hot` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_rank`
--

DROP TABLE IF EXISTS `game_rank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_rank` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `game_id` varchar(32) DEFAULT NULL,
  `rank` varchar(32) DEFAULT NULL COMMENT '比赛名次',
  `user_id` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_rank`
--

LOCK TABLES `game_rank` WRITE;
/*!40000 ALTER TABLE `game_rank` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_rank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_type`
--

DROP TABLE IF EXISTS `game_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_type` (
  `type_id` int(32) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_type`
--

LOCK TABLES `game_type` WRITE;
/*!40000 ALTER TABLE `game_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_video`
--

DROP TABLE IF EXISTS `game_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_video` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `video_id` varchar(32) DEFAULT NULL,
  `game_id` varchar(32) DEFAULT NULL,
  `video_type` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_video`
--

LOCK TABLES `game_video` WRITE;
/*!40000 ALTER TABLE `game_video` DISABLE KEYS */;
INSERT INTO `game_video` VALUES (1,'6','1','0');
/*!40000 ALTER TABLE `game_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `item_id` int(32) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(32) DEFAULT NULL,
  `user_id` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `join_club`
--

DROP TABLE IF EXISTS `join_club`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `join_club` (
  `join_id` int(32) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) DEFAULT NULL,
  `club_id` varchar(32) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`join_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `join_club`
--

LOCK TABLES `join_club` WRITE;
/*!40000 ALTER TABLE `join_club` DISABLE KEYS */;
INSERT INTO `join_club` VALUES (1,'2','1',NULL),(2,'2','2',NULL);
/*!40000 ALTER TABLE `join_club` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `joined_game`
--

DROP TABLE IF EXISTS `joined_game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `joined_game` (
  `joined_id` int(32) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) DEFAULT NULL COMMENT '参加用户的id',
  `game_id` varchar(32) DEFAULT NULL COMMENT '参加比赛的id',
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`joined_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `joined_game`
--

LOCK TABLES `joined_game` WRITE;
/*!40000 ALTER TABLE `joined_game` DISABLE KEYS */;
INSERT INTO `joined_game` VALUES (1,'1','1',NULL),(2,'2','1',NULL),(3,'1','2',NULL);
/*!40000 ALTER TABLE `joined_game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `message_id` int(32) NOT NULL AUTO_INCREMENT,
  `msg_content` text,
  `user_id` varchar(32) DEFAULT NULL,
  `add_time` varchar(100) DEFAULT NULL,
  `update_time` varchar(100) DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `role_id` int(32) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (0,'普通用户',NULL),(1,'专家用户',NULL),(2,'俱乐部会员',NULL);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search_record`
--

DROP TABLE IF EXISTS `search_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `search_record` (
  `search_id` int(32) NOT NULL AUTO_INCREMENT,
  `search_content` varchar(255) DEFAULT NULL,
  `search_user` varchar(32) DEFAULT NULL,
  `search_time` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`search_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_record`
--

LOCK TABLES `search_record` WRITE;
/*!40000 ALTER TABLE `search_record` DISABLE KEYS */;
INSERT INTO `search_record` VALUES (2,'1','-1','1464845335'),(3,'1','-1','1464845433'),(4,'1','-1','1464845644'),(5,'1','-1','1464845671'),(6,'2','-1','1464845733');
/*!40000 ALTER TABLE `search_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `sesskey` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `expiry` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `adminid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `user_name` varchar(60) NOT NULL,
  `user_rank` tinyint(3) NOT NULL,
  `discount` decimal(3,2) NOT NULL,
  `email` varchar(60) NOT NULL,
  `data` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`sesskey`),
  KEY `expiry` (`expiry`) USING HASH
) ENGINE=MEMORY DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('5250b769535328fa7e65313f92c76981',1464943002,2,0,'','',0,0.00,'',''),('b3e2048d6e5378173713705fde6a93da',1464778912,3,0,'','',0,0.00,'',''),('306d0d13694aade3f16dbb58934fdc8f',1464925770,4,0,'','',0,0.00,'','');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(32) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(500) NOT NULL,
  `desc` text COMMENT '用户介绍',
  `medal` varchar(32) NOT NULL DEFAULT '0' COMMENT '金牌数',
  `img` text COMMENT '头像',
  `champion` varchar(32) NOT NULL DEFAULT '0' COMMENT '冠军币',
  `rank` varchar(32) NOT NULL DEFAULT '0' COMMENT '等级',
  `role` int(32) DEFAULT '0' COMMENT '身份认证',
  `sex` varchar(32) DEFAULT NULL,
  `birthday` varchar(32) DEFAULT NULL,
  `location` varchar(32) DEFAULT NULL,
  `mobile` varchar(32) DEFAULT NULL,
  `is_hot` tinyint(2) DEFAULT '0',
  `game_type` varchar(32) DEFAULT '-1',
  PRIMARY KEY (`user_id`),
  KEY `role` (`role`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'test','test',NULL,'0',NULL,'0','0',0,NULL,NULL,NULL,NULL,0,'-1'),(2,'KingDragon0826','c33367701511b4f6020ec61ded352059','大爷今儿个心情好 再改个签名','0','http://o83f02wso.bkt.clouddn.com/FoMpXF4QWVUF4nbBTvyBDo4P6oe2','10010','1',1,NULL,NULL,NULL,'13810332931',0,'-1'),(3,'来个中文名','e10adc3949ba59abbe56e057f20f883e',NULL,'0',NULL,'0','0',0,NULL,NULL,NULL,'15555555555',0,'3'),(4,'Moonsea','c33367701511b4f6020ec61ded352059',NULL,'0','http://o83f02wso.bkt.clouddn.com/FvfM0W8XgqdyCX7Lb0FYCcW5Ri8L','0','0',0,NULL,NULL,NULL,'18811565795',1,'4');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `detail` text,
  `play_count` varchar(32) NOT NULL DEFAULT '0' COMMENT '播放次数',
  `praise_count` varchar(32) NOT NULL DEFAULT '0',
  `add_time` varchar(32) DEFAULT NULL,
  `last_time` varchar(32) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL COMMENT '视频简介',
  `source_id` int(32) DEFAULT NULL,
  `class` tinyint(4) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `video_cover` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (1,'test1','1','test1','0','0','1464700117','1464700117','test1',NULL,1,'https://link.zhihu.com/?target=http%3A//developer.qiniu.com/samples/%25E9%25BB%2591%25E5%2590%258D%25E5%258D%2595-S01E12.flv',NULL),(2,'test2','1','test2','0','0','1464700117','1464700117','test2',NULL,1,'http://7o50kb.com2.z0.glb.qiniucdn.com/c1.1.mp4',NULL),(3,'test3','2','test3','0','0','1464700117','1464700117','test3',NULL,1,'http://7xt3xy.com2.z0.glb.clouddn.com/download_and_setup_sublime_text_3_for_win.mp4',NULL),(4,NULL,'4','','0','0','1464857198','1464857198','',NULL,0,'test_path','test_cover'),(5,NULL,'4','','0','0','1464857198','1464857198','',NULL,0,'test_path','test_cover'),(6,NULL,'4','','0','0','1464857292','1464857292','',NULL,0,'test_path','test_cover');
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_class`
--

DROP TABLE IF EXISTS `video_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_class` (
  `class_id` int(32) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_class`
--

LOCK TABLES `video_class` WRITE;
/*!40000 ALTER TABLE `video_class` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_source`
--

DROP TABLE IF EXISTS `video_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_source` (
  `source_id` int(32) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`source_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_source`
--

LOCK TABLES `video_source` WRITE;
/*!40000 ALTER TABLE `video_source` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_source` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_type`
--

DROP TABLE IF EXISTS `video_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_type` (
  `type_id` int(32) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_type`
--

LOCK TABLES `video_type` WRITE;
/*!40000 ALTER TABLE `video_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wiki`
--

DROP TABLE IF EXISTS `wiki`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiki` (
  `wiki_id` int(32) NOT NULL AUTO_INCREMENT,
  `wiki_name` varchar(100) DEFAULT NULL,
  `video_id` int(32) DEFAULT NULL,
  `type` tinyint(2) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `user_id` int(32) DEFAULT NULL,
  PRIMARY KEY (`wiki_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiki`
--

LOCK TABLES `wiki` WRITE;
/*!40000 ALTER TABLE `wiki` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiki` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-03 15:04:38
