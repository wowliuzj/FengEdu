-- MySQL dump 10.13  Distrib 5.1.52, for unknown-linux-gnu (x86_64)
--
-- Host: localhost    Database: education
-- ------------------------------------------------------
-- Server version	5.1.52

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
-- Table structure for table `access`
--

DROP TABLE IF EXISTS `access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access` (
  `r_id` int(10) unsigned NOT NULL COMMENT '角色ID',
  `p_id` int(10) unsigned NOT NULL COMMENT '权限ID',
  `ac_r` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有读的权限',
  `ac_w` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否有写的权限',
  PRIMARY KEY (`r_id`,`p_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access`
--

LOCK TABLES `access` WRITE;
/*!40000 ALTER TABLE `access` DISABLE KEYS */;
INSERT INTO `access` VALUES (1,6,1,0),(1,7,1,0),(2,21,1,0),(3,1,1,0),(3,2,1,0),(3,3,1,0),(3,4,1,0),(3,5,1,0),(3,19,1,0),(3,35,1,0),(4,14,1,0),(4,15,1,0),(4,16,1,0),(4,23,1,0),(5,17,1,0),(5,18,1,0),(6,9,1,0),(6,10,1,0),(6,12,1,0),(6,13,1,0),(6,22,1,0),(7,29,1,0),(7,30,1,0),(7,31,1,0),(7,32,1,0),(7,33,1,0),(7,34,1,0),(8,20,1,0),(8,24,1,0),(8,25,1,0),(8,26,1,0),(8,27,1,0),(8,28,1,0);
/*!40000 ALTER TABLE `access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT '1' COMMENT '活动类型，1班会，2活动',
  `name` varchar(200) DEFAULT NULL COMMENT '活动名称',
  `time` datetime DEFAULT NULL COMMENT '活动时间',
  `desc` varchar(5000) DEFAULT NULL COMMENT '活动介绍',
  `cid` int(11) DEFAULT NULL COMMENT '班级id,0为整个学校的活动',
  `img` varchar(500) DEFAULT NULL,
  `shared_cnt` varchar(5000) DEFAULT NULL,
  `is_shared` int(11) DEFAULT '0' COMMENT '是否分享给本系统的所有用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='活动';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `a_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `a_name` char(20) NOT NULL COMMENT '用户名',
  `a_pwd` char(64) NOT NULL COMMENT '用户密码值',
  `a_salt` char(32) CHARACTER SET latin1 NOT NULL COMMENT '用户密码salt',
  `r_id` varchar(255) NOT NULL DEFAULT '0' COMMENT '用户权限组,0默认权限为空',
  `a_ip` varchar(255) NOT NULL DEFAULT '192.168.*|127.0.0.1' COMMENT '允许登录的IP地址列表',
  `a_status` tinyint(255) unsigned DEFAULT '0' COMMENT '用户状态，0正常，1:限制登录，2解除权限',
  `fid` int(11) DEFAULT NULL COMMENT '关联的老师学生等本人信息的表id',
  `ftype` int(11) DEFAULT '0' COMMENT '1管理员,2企业管理员,3班主任，4教师端,5家长，6学生端，7总部管理员，8校区管理员',
  `campus_id` int(11) DEFAULT '0' COMMENT '校区id',
  PRIMARY KEY (`a_id`),
  UNIQUE KEY `UNK` (`a_name`),
  KEY `r_id` (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','5653e682ce835717ed0d9b13d94941b35004eeeaa5033c7cf28fd0f022f245f8','r)XEsXO;WF(PPR)=!4Yu\\yI.rq)]\"%6\"','1','192.168.*|127.0.0.1',0,0,1,0),(2,'info','5653e682ce835717ed0d9b13d94941b35004eeeaa5033c7cf28fd0f022f245f8','r)XEsXO;WF(PPR)=!4Yu\\yI.rq)]\"%6\"','2','127.0.0.1',0,0,2,0),(3,'hq','5653e682ce835717ed0d9b13d94941b35004eeeaa5033c7cf28fd0f022f245f8','r)XEsXO;WF(PPR)=!4Yu\\yI.rq)]\"%6\"','7','127.0.0.1',0,0,7,0),(4,'campus','5653e682ce835717ed0d9b13d94941b35004eeeaa5033c7cf28fd0f022f245f8','r)XEsXO;WF(PPR)=!4Yu\\yI.rq)]\"%6\"','8','127.0.0.1',0,0,8,1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '发布的内容',
  `time` datetime DEFAULT NULL COMMENT '发布时间',
  `type` int(11) DEFAULT NULL COMMENT '信息类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='发布信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attent`
--

DROP TABLE IF EXISTS `attent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT '0' COMMENT '班级id',
  `sid` int(11) DEFAULT '0' COMMENT '学生id',
  `time` varchar(12) DEFAULT '0000-00-00' COMMENT '考勤日期',
  `status` int(11) DEFAULT '0' COMMENT '考勤情况：1迟到，2早退，3旷课，4事假，5病假',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sid` (`sid`,`time`)
) ENGINE=InnoDB AUTO_INCREMENT=362 DEFAULT CHARSET=utf8 COMMENT='考勤记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attent`
--

LOCK TABLES `attent` WRITE;
/*!40000 ALTER TABLE `attent` DISABLE KEYS */;
/*!40000 ALTER TABLE `attent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_teacher`
--

DROP TABLE IF EXISTS `class_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cid` int(11) DEFAULT NULL COMMENT '班级id',
  `tid` int(11) DEFAULT NULL COMMENT '老师id',
  `cuid` int(11) DEFAULT NULL COMMENT '教学大纲id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_teacher`
--

LOCK TABLES `class_teacher` WRITE;
/*!40000 ALTER TABLE `class_teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程序号',
  `year` int(4) unsigned DEFAULT '2015' COMMENT '年份',
  `name` varchar(255) DEFAULT NULL COMMENT '模块名称',
  `cnt` varchar(255) DEFAULT NULL COMMENT '教学内容简介',
  `num` int(11) DEFAULT '1' COMMENT '课时数',
  `outline_id` int(11) DEFAULT '0' COMMENT '大纲id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8 COMMENT='课程';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `course_info`
--

DROP TABLE IF EXISTS `course_info`;
/*!50001 DROP VIEW IF EXISTS `course_info`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `course_info` (
  `id` int(10) unsigned,
  `title` char(100),
  `name` varchar(255),
  `num` int(11),
  `outline_id` int(11),
  `tid` int(11),
  `campus_id` int(11),
  `cid` int(20),
  `it_name` char(20),
  `icl_number` varchar(50)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `eval_work`
--

DROP TABLE IF EXISTS `eval_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eval_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hid` int(11) DEFAULT '0' COMMENT '作业id',
  `shid` int(11) DEFAULT '0' COMMENT '学生的作业id',
  `star` float DEFAULT '0' COMMENT '星级一共10星，单位半星，20',
  `desc` varchar(2000) DEFAULT NULL COMMENT '评价的内容',
  `time` datetime DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `sname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='学生评价作业';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eval_work`
--

LOCK TABLES `eval_work` WRITE;
/*!40000 ALTER TABLE `eval_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `eval_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(100) DEFAULT NULL COMMENT '考试标题',
  `cid` int(11) DEFAULT NULL COMMENT '班级id',
  `time` datetime DEFAULT NULL COMMENT '考试时间',
  `desc` text COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam`
--

LOCK TABLES `exam` WRITE;
/*!40000 ALTER TABLE `exam` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_score`
--

DROP TABLE IF EXISTS `exam_score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `eid` int(11) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL COMMENT '学生id',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '成绩',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_score`
--

LOCK TABLES `exam_score` WRITE;
/*!40000 ALTER TABLE `exam_score` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homework`
--

DROP TABLE IF EXISTS `homework`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homework` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) DEFAULT NULL COMMENT '布置作业的老师',
  `cid` int(11) DEFAULT '0' COMMENT '班级id',
  `time` datetime DEFAULT NULL COMMENT '布置作业的时间',
  `title` varchar(500) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL COMMENT '作业图片',
  `desc` varchar(2000) DEFAULT NULL COMMENT '作业要求',
  `finish_time` datetime DEFAULT NULL COMMENT '作业完成时间',
  `course_id` int(11) DEFAULT NULL COMMENT '课程id',
  `num` int(11) DEFAULT '1' COMMENT '课时数',
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`),
  KEY `cid` (`cid`),
  KEY `time` (`time`),
  KEY `title` (`title`(255))
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='作业';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homework`
--

LOCK TABLES `homework` WRITE;
/*!40000 ALTER TABLE `homework` DISABLE KEYS */;
/*!40000 ALTER TABLE `homework` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `homework_info`
--

DROP TABLE IF EXISTS `homework_info`;
/*!50001 DROP VIEW IF EXISTS `homework_info`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `homework_info` (
  `id` int(11),
  `title` varchar(500),
  `tid` int(11),
  `cid` int(11),
  `campus_id` int(11),
  `course_id` int(11),
  `num` int(11),
  `it_name` char(20),
  `icl_number` varchar(50),
  `name` varchar(255)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `info_campus`
--

DROP TABLE IF EXISTS `info_campus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_campus` (
  `ic_id` int(11) NOT NULL AUTO_INCREMENT,
  `ic_name` varchar(100) NOT NULL DEFAULT '' COMMENT '校区名称',
  `ic_address` varchar(255) DEFAULT NULL COMMENT '地址',
  `ic_postcode` char(10) DEFAULT NULL COMMENT '邮编',
  `ic_tel` char(20) DEFAULT NULL COMMENT '电话',
  PRIMARY KEY (`ic_id`),
  UNIQUE KEY `UNK` (`ic_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_campus`
--

LOCK TABLES `info_campus` WRITE;
/*!40000 ALTER TABLE `info_campus` DISABLE KEYS */;
INSERT INTO `info_campus` VALUES (1,'东校区','南环路','434400','1234567'),(2,'中心校区','北京路','424400','123456'),(3,'北校区','南环路','434400','123456'),(4,'南校区','南环路','434400','123456'),(5,'西校区','北京路','424400','123456');
/*!40000 ALTER TABLE `info_campus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_class`
--

DROP TABLE IF EXISTS `info_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_class` (
  `icl_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '班级ID',
  `icl_number` varchar(50) NOT NULL COMMENT '班级序号',
  `icl_tid` int(11) NOT NULL COMMENT '班主任',
  `icl_note` varchar(1024) DEFAULT NULL COMMENT '备注',
  `icl_year` int(4) DEFAULT NULL COMMENT '开设年份',
  `status` int(11) DEFAULT '1' COMMENT '状态： 1正常，2毕业',
  `campus_id` int(11) DEFAULT '1' COMMENT '校区id',
  PRIMARY KEY (`icl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_class`
--

LOCK TABLES `info_class` WRITE;
/*!40000 ALTER TABLE `info_class` DISABLE KEYS */;
/*!40000 ALTER TABLE `info_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_college`
--

DROP TABLE IF EXISTS `info_college`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_college` (
  `ico_id` char(20) NOT NULL,
  `ico_name` varchar(100) NOT NULL COMMENT '学院名称',
  `ic_name` varchar(100) NOT NULL COMMENT '校区名称',
  `ico_tel` char(20) NOT NULL COMMENT '学院电话',
  `ico_teacher` char(20) NOT NULL COMMENT '主要负责人',
  PRIMARY KEY (`ico_id`),
  UNIQUE KEY `UNK` (`ico_name`,`ic_name`) USING BTREE,
  KEY `ic_name` (`ic_name`),
  CONSTRAINT `info_college_ibfk_1` FOREIGN KEY (`ic_name`) REFERENCES `info_campus` (`ic_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_college`
--

LOCK TABLES `info_college` WRITE;
/*!40000 ALTER TABLE `info_college` DISABLE KEYS */;
/*!40000 ALTER TABLE `info_college` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_curriculum`
--

DROP TABLE IF EXISTS `info_curriculum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_curriculum` (
  `cu_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程ID',
  `cu_name` char(100) NOT NULL COMMENT '课程名',
  `cu_point` float unsigned NOT NULL COMMENT '学分',
  `cu_time` int(10) unsigned NOT NULL COMMENT '学时',
  `cu_book` varchar(128) DEFAULT NULL COMMENT '对应书籍',
  `ico_id` char(20) NOT NULL COMMENT '课程所属学院',
  `cu_note` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`cu_id`),
  KEY `ico_id` (`ico_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7796 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_curriculum`
--

LOCK TABLES `info_curriculum` WRITE;
/*!40000 ALTER TABLE `info_curriculum` DISABLE KEYS */;
/*!40000 ALTER TABLE `info_curriculum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_discipline`
--

DROP TABLE IF EXISTS `info_discipline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_discipline` (
  `id_id` char(20) NOT NULL COMMENT '专业ID',
  `id_name` varchar(50) NOT NULL COMMENT '专业名称',
  `id_teacher` char(10) NOT NULL COMMENT '专业负责人',
  `id_time` int(4) unsigned NOT NULL COMMENT '专业年级',
  `ico_id` char(20) DEFAULT NULL COMMENT '学院ID',
  PRIMARY KEY (`id_id`),
  UNIQUE KEY `unique_id_name` (`id_name`,`id_time`) USING BTREE,
  KEY `ico_id` (`ico_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_discipline`
--

LOCK TABLES `info_discipline` WRITE;
/*!40000 ALTER TABLE `info_discipline` DISABLE KEYS */;
/*!40000 ALTER TABLE `info_discipline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_student`
--

DROP TABLE IF EXISTS `info_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_student` (
  `is_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '学号',
  `is_name` char(20) NOT NULL COMMENT '名称',
  `is_hometown` char(20) DEFAULT NULL COMMENT '籍贯',
  `is_sex` char(2) NOT NULL COMMENT '性别',
  `is_birthday` date DEFAULT NULL COMMENT '生日',
  `is_province` varchar(50) DEFAULT NULL COMMENT '省份',
  `is_city` varchar(20) DEFAULT NULL COMMENT '城市',
  `is_county` varchar(20) DEFAULT NULL COMMENT '县',
  `is_zone` varchar(20) DEFAULT NULL COMMENT '地区',
  `is_address` varchar(100) DEFAULT NULL COMMENT '详细管理',
  `is_id_card` char(18) NOT NULL COMMENT '身份证号码',
  `is_politics` varchar(10) DEFAULT NULL COMMENT '政治面貌',
  `campus_id` int(11) DEFAULT NULL COMMENT '校区',
  `ico_id` char(20) DEFAULT NULL COMMENT '学院ID',
  `id_id` char(20) DEFAULT NULL COMMENT '专业ID',
  `icl_id` char(20) NOT NULL COMMENT '班级ID',
  `is_email` varchar(128) DEFAULT NULL COMMENT '邮箱',
  `is_tel` char(20) DEFAULT NULL COMMENT '电话',
  `is_room` varchar(128) DEFAULT NULL COMMENT '宿舍',
  `is_room_number` char(10) DEFAULT NULL COMMENT '宿舍号',
  `is_study_date` date DEFAULT NULL COMMENT '入学日期',
  `is_grade` int(4) unsigned DEFAULT NULL COMMENT '年级',
  `is_status` int(11) NOT NULL DEFAULT '1' COMMENT '状态： 1在读，2休学，3退学，4插班，5毕业',
  `is_age` int(11) DEFAULT '20' COMMENT '年龄',
  `parent_name` varchar(255) DEFAULT NULL COMMENT '父母名字',
  `parent_phone` varchar(255) DEFAULT NULL COMMENT '父母手机号',
  PRIMARY KEY (`is_id`),
  UNIQUE KEY `is_id_card` (`is_id_card`),
  KEY `ic_name` (`campus_id`),
  KEY `ico_id` (`ico_id`),
  KEY `id_id` (`id_id`),
  KEY `icl_id` (`icl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2010000057 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_student`
--

LOCK TABLES `info_student` WRITE;
/*!40000 ALTER TABLE `info_student` DISABLE KEYS */;
/*!40000 ALTER TABLE `info_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_teacher`
--

DROP TABLE IF EXISTS `info_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_teacher` (
  `it_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '教师ID',
  `it_name` char(20) DEFAULT NULL COMMENT '教师名称',
  `it_start_date` date DEFAULT NULL COMMENT '入职时间',
  `it_sex` char(2) DEFAULT NULL COMMENT '性别',
  `it_birthday` date DEFAULT NULL COMMENT '出生日期',
  `it_marry` char(255) DEFAULT NULL COMMENT '婚姻状况',
  `it_tel` char(20) DEFAULT NULL COMMENT '电话',
  `it_address` varchar(255) DEFAULT NULL COMMENT '住址',
  `it_email` varchar(128) DEFAULT NULL COMMENT '邮箱',
  `it_note` varchar(255) DEFAULT NULL COMMENT '备注',
  `it_id_card` char(18) DEFAULT NULL COMMENT '身份证',
  `it_edu` char(20) DEFAULT NULL COMMENT '学历',
  `it_type` int(11) DEFAULT '4' COMMENT '3班主任，4教师',
  `campus_id` int(11) DEFAULT NULL COMMENT '校区id',
  PRIMARY KEY (`it_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10010 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_teacher`
--

LOCK TABLES `info_teacher` WRITE;
/*!40000 ALTER TABLE `info_teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `info_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  `cnt` varchar(2000) DEFAULT NULL COMMENT '正文',
  `reply_msg` varchar(2000) DEFAULT NULL COMMENT '回复',
  `sid` int(11) DEFAULT NULL COMMENT '学生id',
  `time` datetime DEFAULT NULL COMMENT '留言时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mg_curriculum`
--

DROP TABLE IF EXISTS `mg_curriculum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mg_curriculum` (
  `mc_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程序号',
  `mc_year` int(4) unsigned NOT NULL COMMENT '年份',
  `mc_number` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '学期',
  `mc_grade` int(4) unsigned NOT NULL COMMENT '专业年级',
  `mc_note` varchar(255) DEFAULT NULL COMMENT '备注',
  `id_id` char(20) NOT NULL COMMENT '专业号',
  `ico_id` char(20) NOT NULL COMMENT '学院',
  `cu_id` int(10) unsigned NOT NULL COMMENT '课程ID',
  `it_id` int(10) unsigned NOT NULL COMMENT '教师ID',
  PRIMARY KEY (`mc_id`),
  KEY `id_id` (`id_id`),
  KEY `ico_id` (`ico_id`),
  KEY `it_id` (`it_id`),
  KEY `cu_id` (`cu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51696 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mg_curriculum`
--

LOCK TABLES `mg_curriculum` WRITE;
/*!40000 ALTER TABLE `mg_curriculum` DISABLE KEYS */;
/*!40000 ALTER TABLE `mg_curriculum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outline`
--

DROP TABLE IF EXISTS `outline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outline` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程ID',
  `title` char(100) DEFAULT NULL COMMENT '课程名',
  `cid` int(20) DEFAULT NULL COMMENT '班级id',
  `tid` int(11) DEFAULT NULL COMMENT '授课老师',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ico_id` (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COMMENT='教学大纲';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outline`
--

LOCK TABLES `outline` WRITE;
/*!40000 ALTER TABLE `outline` DISABLE KEYS */;
/*!40000 ALTER TABLE `outline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `p_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限ID',
  `p_name` char(64) NOT NULL COMMENT '权限名称',
  `p_alias` varchar(64) NOT NULL COMMENT '权限别名',
  `p_status` tinyint(255) unsigned NOT NULL DEFAULT '0' COMMENT '权限状态，0：有效，1：无效',
  `p_view` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否在抬头显示',
  `p_mid` int(11) NOT NULL DEFAULT '1' COMMENT '模块id，功能大模块的编号id,1管理员,3班主任，4教师端,5家长，6学生端',
  `p_style` varchar(255) DEFAULT NULL COMMENT '样式',
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `UKN` (`p_name`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'student/add','添加学生',0,1,3,'bg_lb'),(2,'student/index','管理学生',0,1,3,'bg_lg'),(3,'attent/index','出勤记录',0,1,3,'bg_ly'),(4,'activity/index','班级活动',0,1,3,'bg_ls'),(5,'exam/index','考试管理',0,1,3,'bg_lr'),(6,'access/role','权限管理',0,1,1,'bg_lb'),(7,'admin/index','用户管理',0,1,1,'bg_lg'),(8,'admin/reset_pwd','重置密码',0,0,1,'bg_ly'),(9,'student/study/index','学习功能',0,1,6,'bg_lb'),(10,'student/homework/index','作业功能',0,1,6,'bg_lg'),(12,'student/find_socre/index','成绩查询',0,1,6,'bg_ly'),(13,'student/eval_work/index','评价作业',0,1,6,'bg_ls'),(14,'outline/index','教学功能',0,1,4,'bg_lb'),(15,'homework/index','布置作业',0,1,4,'bg_lg'),(16,'homework/sindex','批改作业',0,1,4,'bg_ly'),(17,'parent/find','查询',0,1,5,'bg_ls'),(18,'parent/message','留言',0,1,5,'bg_lr'),(19,'bzr/msg_mrg','留言管理',0,1,3,'bg_lv'),(20,'teacher/tindex','教师管理',0,1,1,'bg_ls'),(21,'article/index','发布信息',0,1,1,'bg_lr'),(22,'topic/my-index','问答管理',0,1,6,'bg_lr'),(23,'homework/fin_index','查看作业',0,1,4,'bg_ls'),(24,'admin/campus/teach/index','教学情况',0,1,8,'bg_lb'),(25,'admin/campus/homework/index','作业情况',0,1,8,'bg_lg'),(26,'admin/campus/exam/index','考试情况',0,1,8,'bg_ly'),(27,'admin/campus/attent/index','出勤情况',0,1,8,'bg_ls'),(28,'admin/campus/activity/index','活动情况',0,1,8,'bg_lr'),(29,'admin/hq/teach/index','教学情况',0,1,7,'bg_lb'),(30,'admin/hq/homework/index','作业情况',0,1,7,'bg_lg'),(31,'admin/hq/exam/index','考试情况',0,1,7,'bg_ly'),(32,'admin/hq/attent/index','出勤情况',0,1,7,'bg_ls'),(33,'admin/hq/activity/index','活动情况',0,1,7,'bg_lr'),(34,'admin/hq/campus/index','校区管理',0,1,7,'bg_lo'),(35,'class/index','班级管理',0,1,3,'bg_lh');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reply`
--

DROP TABLE IF EXISTS `reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '回复主键',
  `tid` int(11) DEFAULT NULL COMMENT '主贴ID',
  `floor` smallint(6) NOT NULL DEFAULT '0' COMMENT '楼层',
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT '回复者ID',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '回复者昵称',
  `content` varchar(200) DEFAULT NULL COMMENT '回复内容',
  `time` datetime NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='回帖';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reply`
--

LOCK TABLES `reply` WRITE;
/*!40000 ALTER TABLE `reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `r_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `r_name` char(20) NOT NULL COMMENT '角色名称',
  `r_status` tinyint(255) unsigned DEFAULT '0' COMMENT '角色状态，0:正常，1:禁用',
  PRIMARY KEY (`r_id`),
  UNIQUE KEY `UNN` (`r_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'超级管理员',0),(2,'企业端管理员',0),(3,'班主任',0),(4,'教师',0),(5,'家长',0),(6,'学生',0),(7,'总部管理员',0),(8,'校区管理员',0);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stu_work`
--

DROP TABLE IF EXISTS `stu_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stu_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT '0' COMMENT '班级id',
  `sid` int(11) DEFAULT '0' COMMENT '学生id',
  `hid` int(11) DEFAULT '0' COMMENT '作业id',
  `sdesc` varchar(2000) DEFAULT NULL COMMENT '学生对作业的描述',
  `simg` varchar(255) DEFAULT NULL COMMENT '学生提交作业的图片',
  `stime` datetime DEFAULT NULL COMMENT '提交作业的时间',
  `tdesc` varchar(2000) DEFAULT NULL COMMENT '老师的评语',
  `ttime` datetime DEFAULT NULL COMMENT '老师评语',
  `score` int(11) DEFAULT '0' COMMENT '分数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='学生写的作业';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stu_work`
--

LOCK TABLES `stu_work` WRITE;
/*!40000 ALTER TABLE `stu_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `stu_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `stuwork_info`
--

DROP TABLE IF EXISTS `stuwork_info`;
/*!50001 DROP VIEW IF EXISTS `stuwork_info`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `stuwork_info` (
  `id` int(11),
  `is_name` char(20),
  `icl_number` varchar(50),
  `campus_id` int(11),
  `title` varchar(500),
  `score` int(11),
  `tid` int(11),
  `it_name` char(20),
  `cid` int(11),
  `name` varchar(255)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `topic`
--

DROP TABLE IF EXISTS `topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `desc` text,
  `time` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '发布人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic`
--

LOCK TABLES `topic` WRITE;
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_homework`
--

DROP TABLE IF EXISTS `view_homework`;
/*!50001 DROP VIEW IF EXISTS `view_homework`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_homework` (
  `it_name` char(20),
  `score` int(11),
  `bhid` int(11),
  `shid` int(11),
  `sid` int(11),
  `stime` datetime,
  `simg` varchar(255),
  `sdesc` varchar(2000),
  `ttime` datetime,
  `tdesc` varchar(2000),
  `ecount` bigint(21)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `work_wall_view`
--

DROP TABLE IF EXISTS `work_wall_view`;
/*!50001 DROP VIEW IF EXISTS `work_wall_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `work_wall_view` (
  `id` int(11),
  `simg` varchar(255),
  `it_name` char(20),
  `is_name` char(20),
  `ic_name` varchar(100)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `course_info`
--

/*!50001 DROP TABLE IF EXISTS `course_info`*/;
/*!50001 DROP VIEW IF EXISTS `course_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `course_info` AS select `a`.`id` AS `id`,`b`.`title` AS `title`,`a`.`name` AS `name`,`a`.`num` AS `num`,`a`.`outline_id` AS `outline_id`,`b`.`tid` AS `tid`,`info_class`.`campus_id` AS `campus_id`,`b`.`cid` AS `cid`,`info_teacher`.`it_name` AS `it_name`,`info_class`.`icl_number` AS `icl_number` from (((`course` `a` join `outline` `b`) join `info_teacher`) join `info_class`) where ((`a`.`outline_id` = `b`.`id`) and (`b`.`tid` = `info_teacher`.`it_id`) and (`b`.`cid` = `info_class`.`icl_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `homework_info`
--

/*!50001 DROP TABLE IF EXISTS `homework_info`*/;
/*!50001 DROP VIEW IF EXISTS `homework_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `homework_info` AS select `a`.`id` AS `id`,`a`.`title` AS `title`,`a`.`tid` AS `tid`,`a`.`cid` AS `cid`,`c`.`campus_id` AS `campus_id`,`a`.`course_id` AS `course_id`,`a`.`num` AS `num`,`b`.`it_name` AS `it_name`,`c`.`icl_number` AS `icl_number`,`d`.`name` AS `name` from (((`homework` `a` join `info_teacher` `b`) join `info_class` `c`) join `course` `d`) where ((`a`.`tid` = `b`.`it_id`) and (`a`.`cid` = `c`.`icl_id`) and (`a`.`course_id` = `d`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `stuwork_info`
--

/*!50001 DROP TABLE IF EXISTS `stuwork_info`*/;
/*!50001 DROP VIEW IF EXISTS `stuwork_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `stuwork_info` AS select `a`.`id` AS `id`,`c`.`is_name` AS `is_name`,`b`.`icl_number` AS `icl_number`,`b`.`campus_id` AS `campus_id`,`b`.`title` AS `title`,`a`.`score` AS `score`,`b`.`tid` AS `tid`,`b`.`it_name` AS `it_name`,`a`.`cid` AS `cid`,`b`.`name` AS `name` from ((`stu_work` `a` join `homework_info` `b`) join `info_student` `c`) where ((`a`.`hid` = `b`.`id`) and (`a`.`sid` = `c`.`is_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_homework`
--

/*!50001 DROP TABLE IF EXISTS `view_homework`*/;
/*!50001 DROP VIEW IF EXISTS `view_homework`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_homework` AS select `c`.`it_name` AS `it_name`,`b`.`score` AS `score`,`b`.`hid` AS `bhid`,`b`.`id` AS `shid`,`b`.`sid` AS `sid`,`b`.`stime` AS `stime`,`b`.`simg` AS `simg`,`b`.`sdesc` AS `sdesc`,`b`.`ttime` AS `ttime`,`b`.`tdesc` AS `tdesc`,(select count(1) from `eval_work` where (`eval_work`.`shid` = `b`.`id`)) AS `ecount` from ((`homework` `a` join `stu_work` `b`) join `info_teacher` `c`) where ((`a`.`id` = `b`.`hid`) and (`a`.`tid` = `c`.`it_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `work_wall_view`
--

/*!50001 DROP TABLE IF EXISTS `work_wall_view`*/;
/*!50001 DROP VIEW IF EXISTS `work_wall_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `work_wall_view` AS select `a`.`id` AS `id`,`a`.`simg` AS `simg`,`t`.`it_name` AS `it_name`,`s`.`is_name` AS `is_name`,`c`.`ic_name` AS `ic_name` from ((((`stu_work` `a` join `homework` `b`) join `info_student` `s`) join `info_teacher` `t`) join `info_campus` `c`) where ((`a`.`hid` = `b`.`id`) and (`a`.`sid` = `s`.`is_id`) and (`b`.`tid` = `t`.`it_id`) and (`t`.`campus_id` = `c`.`ic_id`) and (`a`.`score` >= 18)) */;
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

-- Dump completed on 2015-10-31 14:45:47
