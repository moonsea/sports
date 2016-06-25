-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: edusys
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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
-- Table structure for table `operation`
--

DROP TABLE IF EXISTS `operation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operation` (
  `OperationId` varchar(50) NOT NULL,
  `OperationName` varchar(50) DEFAULT NULL,
  `Url` varchar(100) DEFAULT NULL,
  `ParentId` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`OperationId`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operation`
--

LOCK TABLES `operation` WRITE;
/*!40000 ALTER TABLE `operation` DISABLE KEYS */;
INSERT INTO `operation` VALUES ('00000000','','','99999999',''),('01000000','竞赛管理系统','','00000000',''),('01010000','竞赛申报','','01000000','normal_icon1'),('01010100','作品申报','/ShowReport.wx?PAGEID=submitContest','01010000','normal_icon1'),('01010200','参赛申报','/ShowReport.wx?PAGEID=submitContestAttendList','01010000',NULL),('01020000','作品管理',NULL,'01000000',NULL),('01020100','申报作品查询','/ShowReport.wx?PAGEID=submitContestList','01020000',NULL),('01030000','竞赛总结','','01000000','normal_icon1'),('01030200','个人总结','/ShowReport.wx?PAGEID=summary_individual_stu','01030000','normal_icon1'),('01030300','团队总结','/ShowReport.wx?PAGEID=summary_team_stu','01030000','normal_icon1'),('01040000','竞赛获奖','','01000000',''),('01040100','获奖查询','/ShowReport.wx?PAGEID=awards_query_stu','01040000','normal_icon1'),('01040200','获奖认定','/ShowReport.wx?PAGEID=awards_con_stu','01040000','normal_icon1'),('01050000','个人设置','','01000000','normal_icon1'),('01050100','个人信息','/ShowReport.wx?PAGEID=personal_info_stu','01050000','normal_icon1'),('01050200','修改密码','/ShowReport.wx?PAGEID=passwd_change_stu','01050000','normal_icon1'),('02000000','教师竞赛管理','','00000000','normal_icon1'),('02010000','参赛信息','','02000000','normal_icon1'),('02010100','指导作品查询','','02010000','normal_icon1'),('02010200','XXXXX','/ShowReport.wx?PAGEID=DianmingPage','02030000','normal_icon1'),('02020000','系统设置','/ShowReport.wx?PAGEID=StaAttendencePage','02000000','normal_icon1'),('02020100','个人信息','/ShowReport.wx?PAGEID=StaChengjiDetailPage','02020000','normal_icon1'),('02020200','登陆密码','/ShowReport.wx?PAGEID=PingjunChengjiDetailPage','02020000','normal_icon1'),('03000000','院系竞赛管理','','00000000','normal_icon1'),('03010000','参赛人员管理','','03000000',''),('03010100','增加学生','/ShowReport.wx?PAGEID=mem_stu_add_dep','03010000','normal_icon1'),('03010200','学生管理','/ShowReport.wx?PAGEID=member_manage_student_dep','03010000','normal_icon1'),('03010300','添加教师','/ShowReport.wx?PAGEID=mem_tea_add_dep','03010000','normal_icon1'),('03010400','教师管理','/ShowReport.wx?PAGEID=member_manage_teacher_dep','03010000','normal_icon1'),('03020000','竞赛作品管理','','03000000','normal_icon1'),('03020100','竞赛作品审核','/ShowReport.wx?PAGEID=project_apply_check_dep','03020000','normal_icon1'),('03020200','申报作品管理','/ShowReport.wx?PAGEID=project_apply_dep','03020000','normal_icon1'),('03030000','竞赛总结管理','','03000000','normal_icon1'),('03030100','个人总结','/ShowReport.wx?PAGEID=summary_individual_dep','03030000','normal_icon1'),('03030200','团队总结','/ShowReport.wx?PAGEID=summary_team_dep','03030000','normal_icon1'),('03040000','竞赛获奖管理','','03000000','normal_icon1'),('03040100','获奖查询','/ShowReport.wx?PAGEID=awards_query_dep','03040000','normal_icon1'),('03040200','获奖认定审核','/ShowReport.wx?PAGEID=awards_con_dep','03040000','normal_icon1'),('03050000','统计分析管理','','03000000','normal_icon1'),('03050100','参赛情况统计','/ShowReport.wx?PAGEID=join_con_info_dep','03050000',''),('03050200','竞赛获奖统计','/ShowReport.wx?PAGEID=ChargeListPage','03050000','normal_icon1'),('03050300','竞赛经费统计','/ShowReport.wx?PAGEID=NewRefundPage','03050000','normal_icon1'),('03060000','系统管理','','03000000','normal_icon1'),('03060100','账户信息','/ShowReport.wx?PAGEID=personal_info_dep','03060000','normal_icon1'),('03060200','密码修改','/ShowReport.wx?PAGEID=passwd_change_dep','03060000',''),('04000000','校团委竞赛管理','','00000000','normal_icon1'),('04010000','参赛成员管理','','04000000','normal_icon1'),('04010100','学生成员管理','/ShowReport.wx?PAGEID=member_manage_student_sch','04010000','normal_icon1'),('04010200','教师成员管理','/ShowReport.wx?PAGEID=member_manage_teacher_sch','04010000','normal_icon1'),('04010400','学生年级信息管理','/ShowReport.wx?PAGEID=mmeber_grade_student','04010000',NULL),('04020000','申报作品管理','','04000000','normal_icon1'),('04020100','申报作品管理','/ShowReport.wx?PAGEID=contest_export_list','04020000',NULL),('04020200','科创中心审批','/ShowReport.wx?PAGEID=project_apply_check_sch_1st','04020000',''),('04020300','校团副书记审批','/ShowReport.wx?PAGEID=project_apply_check_sch_2nd','04020000',NULL),('04020400','校团书记审批','/ShowReport.wx?PAGEID=project_apply_check_sch_3rd','04020000',NULL),('04030000','竞赛总结管理','','04000000','normal_icon1'),('04030100','个人总结','/ShowReport.wx?PAGEID=summary_individual_list','04030000','normal_icon1'),('04030200','团队总结','/ShowReport.wx?PAGEID=summary_team_list','04030000','normal_icon1'),('04040000','竞赛获奖管理','','04000000','normal_icon1'),('04040100','竞赛获奖查询','/ShowReport.wx?PAGEID=awards_query_sch','04040000',''),('04040200','科创中心审核','/ShowReport.wx?PAGEID=awards_con_sch_1st','04040000','normal_icon1'),('04040300','校团副书记审核','/ShowReport.wx?PAGEID=awards_con_sch_2nd','04040000',NULL),('04040400','校团书记审核','/ShowReport.wx?PAGEID=awards_con_sch_3rd','04040000',NULL),('04040500','作者确认书','/ShowReport.wx?PAGEID=awards_author_sch','04040000',NULL),('04050000','经费管理','','04000000','normal_icon1'),('04050100','科创中心审核','/ShowReport.wx?PAGEID=fund_check_sch_1st','04050000',''),('04050200','校团副书记审核','/ShowReport.wx?PAGEID=fund_check_sch_2nd','04050000',NULL),('04050300','校团书记审核','/ShowReport.wx?PAGEID=fund_check_sch_3rd','04050000',NULL),('04060000','统计分析管理','','04000000','normal_icon1'),('04060100','参赛情况统计','/ShowReport.wx?PAGEID=join_con_info_sch','04060000','normal_icon1'),('04060200','竞赛获奖统计','/ShowReport.wx?PAGEID=awards_con_info_sch','04060000','normal_icon1'),('04060300','竞赛经费统计','/ShowReport.wx?PAGEID=con_fund_info_sch','04060000','normal_icon1'),('04070000','竞赛库管理',NULL,'04000000',NULL),('04070100','添加竞赛','/ShowReport.wx?PAGEID=addcontestpage','04070000','normal_icon1'),('04070200','竞赛信息','/ShowReport.wx?PAGEID=contest_info','04070000','normal_icon1'),('04070300','竞赛年份信息管理','/ShowReport.wx?PAGEID=contest_year_manage','04070000',NULL),('04070400','竞赛默认年份设置','/ShowReport.wx?PAGEID=contest_year_current','04070000',NULL),('04080000','系统管理',NULL,'04000000','normal_icon1'),('04080100','经费类型管理','/ShowReport.wx?PAGEID=fund_type','04080000','normal_icon1'),('04080200','角色管理','/ShowReport.wx?PAGEID=RoleOperationRelPage','04080000','normal_icon1'),('04080300','院系管理','/ShowReport.wx?PAGEID=department_manage','04080000','normal_icon1'),('04080400','系统管理人员','/ShowReport.wx?PAGEID=admin_manage_sch','04080000','normal_icon1'),('04080500','个人信息管理','/ShowReport.wx?PAGEID=personal_info_sch','04080000','normal_icon1'),('04080600','修改密码','/ShowReport.wx?PAGEID=passwd_change_sch','04080000','normal_icon1');
/*!40000 ALTER TABLE `operation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-16  0:43:50
