-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.6.12-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema yiicms
--

CREATE DATABASE IF NOT EXISTS yiicms;
USE yiicms;

--
-- Definition of table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `comment_author` varchar(60) NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_ip` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_approved` enum('approved','reject','new') NOT NULL DEFAULT 'new',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `comment_post_id` (`comment_post_id`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`,`comment_post_id`,`comment_author`,`comment_author_email`,`comment_author_url`,`comment_author_ip`,`comment_date`,`comment_date_gmt`,`comment_content`,`comment_approved`,`comment_type`,`comment_parent`,`user_id`) VALUES 
 (1,50,'1','','','','0000-00-00 00:00:00','0000-00-00 00:00:00','fdsa','approved','',0,0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


--
-- Definition of table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;


--
-- Definition of table `postmeta`
--

DROP TABLE IF EXISTS `postmeta`;
CREATE TABLE `postmeta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postmeta`
--

/*!40000 ALTER TABLE `postmeta` DISABLE KEYS */;
INSERT INTO `postmeta` (`id`,`post_id`,`meta_key`,`meta_value`) VALUES 
 (1,63,'_menu_item_menu_item_parent','0'),
 (2,63,'_menu_item_object','post'),
 (3,63,'_menu_item_object_id','60'),
 (4,63,'_menu_item_type','post_type'),
 (5,64,'_menu_item_menu_item_parent','0'),
 (6,64,'_menu_item_object','post'),
 (7,64,'_menu_item_object_id','55'),
 (8,64,'_menu_item_type','post_type'),
 (9,65,'_menu_item_menu_item_parent','0'),
 (10,65,'_menu_item_object','post'),
 (11,65,'_menu_item_object_id','60'),
 (12,65,'_menu_item_type','post_type'),
 (13,66,'_menu_item_menu_item_parent','0'),
 (14,66,'_menu_item_object','post'),
 (15,66,'_menu_item_object_id','55'),
 (16,66,'_menu_item_type','post_type'),
 (17,67,'_menu_item_menu_item_parent','66'),
 (18,67,'_menu_item_object','post'),
 (19,67,'_menu_item_object_id','60'),
 (20,67,'_menu_item_type','post_type'),
 (21,68,'_menu_item_menu_item_parent','69'),
 (22,68,'_menu_item_object','post'),
 (23,68,'_menu_item_object_id','55'),
 (24,68,'_menu_item_type','post_type'),
 (25,69,'_menu_item_menu_item_parent','0'),
 (26,69,'_menu_item_object','post'),
 (27,69,'_menu_item_object_id','60'),
 (28,69,'_menu_item_type','post_type'),
 (29,70,'_menu_item_menu_item_parent','0'),
 (30,70,'_menu_item_object','post'),
 (31,70,'_menu_item_object_id','55'),
 (32,70,'_menu_item_type','post_type'),
 (33,71,'_menu_item_menu_item_parent','0'),
 (34,71,'_menu_item_object','post'),
 (35,71,'_menu_item_object_id','60'),
 (36,71,'_menu_item_type','post_type'),
 (37,72,'_menu_item_menu_item_parent','0'),
 (38,72,'_menu_item_object','post'),
 (39,72,'_menu_item_object_id','55'),
 (40,72,'_menu_item_type','post_type'),
 (41,73,'_menu_item_menu_item_parent','0'),
 (42,73,'_menu_item_object','post'),
 (43,73,'_menu_item_object_id','60'),
 (44,73,'_menu_item_type','post_type'),
 (45,122,'_menu_item_menu_item_parent','0'),
 (46,122,'_menu_item_object','post'),
 (47,122,'_menu_item_object_id','116'),
 (48,122,'_menu_item_type','post_type'),
 (49,123,'_menu_item_menu_item_parent','0'),
 (50,123,'_menu_item_object','post'),
 (51,123,'_menu_item_object_id','117'),
 (52,123,'_menu_item_type','post_type'),
 (53,124,'_menu_item_menu_item_parent','0'),
 (54,124,'_menu_item_object','post'),
 (55,124,'_menu_item_object_id','118'),
 (56,124,'_menu_item_type','post_type'),
 (57,125,'_menu_item_menu_item_parent','124'),
 (58,125,'_menu_item_object','post'),
 (59,125,'_menu_item_object_id','111'),
 (60,125,'_menu_item_type','post_type'),
 (61,126,'_menu_item_menu_item_parent','0'),
 (62,126,'_menu_item_object','post'),
 (63,126,'_menu_item_object_id','112'),
 (64,126,'_menu_item_type','post_type'),
 (65,127,'_menu_item_menu_item_parent','70'),
 (66,127,'_menu_item_object','post'),
 (67,127,'_menu_item_object_id','116'),
 (68,127,'_menu_item_type','post_type'),
 (69,128,'_menu_item_menu_item_parent','0'),
 (70,128,'_menu_item_object','post'),
 (71,128,'_menu_item_object_id','117'),
 (72,128,'_menu_item_type','post_type');
/*!40000 ALTER TABLE `postmeta` ENABLE KEYS */;


--
-- Definition of table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` int(10) unsigned NOT NULL,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL,
  `post_content` text NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` enum('publish','draft','deleted') NOT NULL DEFAULT 'publish',
  `comment_status` enum('open','close') NOT NULL DEFAULT 'open',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_parent` int(10) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `post_name` (`post_name`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`id`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`,`post_author`,`post_date`,`post_date_gmt`,`post_content`,`post_title`,`post_excerpt`,`post_status`,`comment_status`,`post_name`,`post_modified`,`post_modified_gmt`,`post_parent`,`guid`,`post_type`,`post_mime_type`) VALUES 
 (40,1,'2013-11-26 15:01:19','0000-00-00 00:00:00','fas','fdasdas.0','','publish','open','','2013-11-26 16:48:07','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/40','post',''),
 (41,1,'2013-11-26 15:01:25','0000-00-00 00:00:00','fasdsafas','fas','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/41','post',''),
 (44,1,'2013-11-26 15:01:47','0000-00-00 00:00:00','232','2','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/44','post',''),
 (46,1,'2013-11-26 16:45:28','0000-00-00 00:00:00','fasfdsadfas','fsa','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/46','post',''),
 (47,1,'2013-11-26 16:45:37','0000-00-00 00:00:00','11111111111111111111111','ewer','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/47','post',''),
 (48,1,'2013-11-27 08:46:17','0000-00-00 00:00:00','fafds','fsa','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/48','post',''),
 (50,1,'2013-11-27 09:06:15','0000-00-00 00:00:00','fdsa','fsa','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/50','post',''),
 (51,1,'2013-11-27 09:09:13','0000-00-00 00:00:00','ssh','sh','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/51','post',''),
 (52,1,'2013-11-27 11:05:41','0000-00-00 00:00:00','Home page','Home','','publish','open','','2013-11-28 10:42:30','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/52','post',''),
 (53,1,'2013-11-27 16:14:21','0000-00-00 00:00:00','fdsadfas','fa','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/53','post',''),
 (55,1,'2013-11-27 17:33:52','0000-00-00 00:00:00','fdsadf','fdasdas','','publish','open','','2013-11-28 10:42:36','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/55','page',''),
 (59,1,'2013-11-28 16:47:47','0000-00-00 00:00:00','魂牵梦萦大规模','朝秦暮楚','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/59','post',''),
 (62,2,'2013-12-02 15:04:51','0000-00-00 00:00:00','土','魂牵梦萦','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/62','post',''),
 (63,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','12','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (64,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','fdasdas','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (65,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','12','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (66,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','fdasdas','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (67,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','12','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (68,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','fdasdas','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (69,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','12','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (70,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','fdasdas','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (71,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','12','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (75,2,'2013-12-06 13:45:35','0000-00-00 00:00:00','editor three update &nbsp;fdsa','editor tow dfsa','','publish','open','','2013-12-06 13:46:03','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/75','post',''),
 (76,2,'2013-12-06 13:46:11','0000-00-00 00:00:00','fffffffffffffffffffffffnew&nbsp;','dfasfd new ','','publish','open','','2013-12-06 13:49:14','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/76','post',''),
 (77,2,'2013-12-06 13:49:31','0000-00-00 00:00:00','three','three','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/77','post',''),
 (78,2,'2013-12-09 10:44:54','0000-00-00 00:00:00','fdsa','fda','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/78','post',''),
 (79,2,'2013-12-09 10:45:37','0000-00-00 00:00:00','<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span>','2013-12-09','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/79','post',''),
 (80,1,'2013-12-09 10:47:49','0000-00-00 00:00:00','<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。<span style=\"color:#333333;font-family:sans-serif;line-height:17.142858505249023px;background-color:#FFFFFF;\">摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。</span></span>','editor 12-09','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/80','post',''),
 (81,2,'2013-12-09 10:48:01','0000-00-00 00:00:00','fsdfsfdsfafasfds','fds','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/81','post',''),
 (84,1,'2013-12-09 10:49:52','0000-00-00 00:00:00','e','e','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/84','post',''),
 (85,1,'2013-12-10 09:51:02','0000-00-00 00:00:00','魂牵梦萦大规模fd','朝秦暮楚','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/85','page',''),
 (86,2,'2013-12-10 09:51:43','0000-00-00 00:00:00','232魂牵梦萦','111','','publish','open','','2013-12-10 09:54:30','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/86','page',''),
 (87,2,'2013-12-10 09:54:50','0000-00-00 00:00:00','魂牵梦萦仍','erw人','','publish','open','','2013-12-10 09:57:47','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/87','page',''),
 (89,1,'2013-12-10 10:03:58','0000-00-00 00:00:00','魂牵梦萦f','朝秦暮楚','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/88','page',''),
 (98,1,'2013-12-10 10:37:47','0000-00-00 00:00:00','fdsa','fasd','fdsa','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/98','page',''),
 (99,1,'2013-12-10 10:38:06','0000-00-00 00:00:00','f','f','f','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/99','page',''),
 (101,1,'2013-12-10 10:50:02','0000-00-00 00:00:00','<p style=\"font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;\">\r\n	新华网北京12月9日电 中共中央总书记、国家主席、中央军委主席习近平12月9日下午在中南海听取河北省委党的群众路线教育实践活动总体情况汇报。他指出，第一批教育实践活动处于收尾阶段，群众期盼和社会评价高度聚焦，要确保整改成效让群众看得见、感受得到、大多数人满意，确保形成的制度行得通、指导力强、能长期管用，确保整个活动善始善终、善作善成，必须继续努力，一鼓作气抓好各项收尾工作。第二批教育实践活动即将开展，要借鉴第一批活动经验，从实际情况和特点出发，搞好舆论引导，制定好活动方案，明确好政策原则，认真扎实做好各项准备工作。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;\">\r\n	河北省是习近平联系的第一批开展教育实践活动的地方。此前，他分别于7月中旬、9月下旬两次到河北就教育实践活动实地调研指导，并全程参加了省委常委班子专题民主生活会，指导教育实践活动深入开展。进入整改落实、建章立制环节后，习近平多次了解河北教育实践活动进展情况，要求狠抓落实、加强督导，确保善始善终，善作善成，务求实效。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;\">\r\n	河北省委书记周本顺向习近平汇报了河北第一批教育实践活动总体情况特别是集中整改落实、建章立制的情况，以及第二批教育实践活动调研准备情况。周本顺在汇报中说，在总书记亲自指导下，河北省通过教育实践活动，进一步坚定了党员干部的理想信念、转变了发展指导思想，正风肃纪见到成效，群众反映强烈的问题得到有效解决，1.7万辆O牌车全部取消，清理超标办公用房91.2万平方米，查出“吃空饷”1.85万人，清理楼堂馆所项目237个，压缩省直部门简报42%，省直单位减少公务接待费用24%，活动中累计处理违纪干部2750多人。习近平边听边记，不时插话询问，就有关问题同河北同志交流。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;\">\r\n	听取汇报后，习近平发表重要讲话。他对河北第一批教育实践活动的组织领导工作和取得的成效表示肯定，认为活动抓得紧、抓得实，较好体现了中央精神，也有自己特点，成效比较明显，积累了一些重要经验。他表示，河北省委常委班子专题民主生活会开得很好，好就好在真刀真枪提意见、满腔热情帮同志，起到了重要示范作用。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;\">\r\n	习近平指出，对我们共产党人来说，讲“认真”不仅是态度问题，而且是关系世界观和方法论的大问题，是关系党的性质和宗旨的大问题，是关系党和人民事业发展全局的大问题。这股“认真”劲应该体现在干事创业的方方面面，也应该体现在党内生活的方方面面。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;\">\r\n	习近平要求，第一批教育实践活动告一段落后，要认真总结，广泛听取意见特别是听取干部群众意见，作出实事求是的归纳和评价。特别是要把成功做法经验化、零星探索系统化，使总结的过程成为认识再提高、措施再完善、工作再推进的过程。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;\">\r\n	习近平强调，你们提了8个方面、38条整改举措，关键是要抓好落实。这些年，河北积累的发展矛盾比较多，整改触及的利益很直接，仅调减钢铁、燃煤、水泥、玻璃产能和治理大气污染就需要下极大功夫。抓整改要动真碰硬、攻坚克难，上下协力、加强联动，持续用劲、步步为营，不达目的不罢休。无论班子整改还是个人整改，都要严明责任，加强监督，确保兑现承诺，立了军令状就要看结果。凡是有问题不整改、大问题小整改、边整改边再犯的，都要严肃批评教育，必要时采取组织措施和纪律措施。要以适当形式继续发挥广大党员、干部建言献策和支持监督的作用，使活动自始至终做到全员全程参与。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;\">\r\n	习近平强调，解决形式主义、官僚主义、享乐主义和奢靡之风问题，做到为民务实清廉，既要立足当前又要着眼长远，既要着力治标又要注重治本。对提出的目标，都要分清轻重缓急，从实际出发进行细化和量化，然后按计划、有步骤、分阶段加以实施，使措施和目标配套，把目标要求落到实处。长效机制一定要起作用，思想不能疲、劲头不能松、措施不能软。\r\n</p>\r\n<div id=\"ad_44086\" class=\"otherContent_01\" style=\"color:#333333;font-family:宋体;font-size:14px;background-color:#FFFFFF;margin:10px 20px 10px 0px;padding:4px;border:1px solid #CDCDCD;\">\r\n	<iframe width=\"200px\" height=\"300px\" frameborder=\"0\" src=\"http://d5.sina.com.cn/shh/lechan/sports_Ad/iframe_200_300.html\">\r\n	</iframe>\r\n</div>\r\n<p style=\"font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;\">\r\n	习近平指出，全国第一批教育实践活动的实践说明，群众路线是党的生命线，教育和实践必须一以贯之、紧密结合。教育和实践是贯彻群众路线的两手，要两手抓、两手都要硬，使党的群众路线在全体党员、干部中深深扎根，使践行党的根本宗旨成为党员、干部的普遍自觉，使各项事业推进有更加深厚的群众基础。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;\">\r\n	习近平对做好第二批教育实践活动准备工作提出了明确要求。他指出，第二批教育实践活动范围片大面广，涉及的矛盾和问题具体尖锐，务必对确保活动健康发展进行系统设计。要更加注重发挥群众积极性，坚持开门搞活动，确保全过程都发动群众参与、置于群众监督之下。要更加强化问题导向，注重解决实际问题，特别是对需要侧重解决的问题进行调查梳理，提前做到心中有数，从解决具体问题抓起改起。要更加注重严格要求，坚持标准，确保质量，防止降格以求。要更加注重衔接带动，推动第一批活动制定的整改措施和制度规定传导落实到“末梢神经”。要更加注重分类指导，针对不同层级、不同领域、不同对象提出不同目标要求，注重发挥行业系统指导作用，对可能发生的种种复杂情况进行分析预判，并制定出预防和解决对策。\r\n</p>\r\n<p style=\"font-size:14px;color:#333333;font-family:宋体;background-color:#FFFFFF;\">\r\n	王沪宁、赵乐际、栗战书和中央督导组、河北省委有关负责同志参加上述活动。\r\n</p>','习近平在听取河北省委党的群众路线教育实践活动总体情况汇报时指出(edit)','一鼓作气抓好第一批活动收尾工作 认真扎实做好第二批活动准备工作','deleted','open','','2013-12-10 10:50:24','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/100','page',''),
 (102,1,'2013-12-10 10:54:54','0000-00-00 00:00:00','fdsa','fdsa','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/102','page',''),
 (104,1,'2013-12-10 11:48:04','0000-00-00 00:00:00','<span><span><span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa</span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa</span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa</span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa</span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa</span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa</span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa<span>dfsa</span><span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa</span>dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsad317ds</span></span></span></span></span></span></span></span></span></span><span><span></span><span><span></span><span><span></span><span><span></span><span></span><span></span></span><span></span></span><span></span></span><span></span></span><span></span></span>','fdsdfsa12ds','dfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsadfsa​​​​640ds','deleted','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php','page',''),
 (105,1,'2013-12-10 11:51:15','0000-00-00 00:00:00','fasdfsafd1211tyyt','fdas15fda112','fdsa1112121','deleted','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/105','page',''),
 (107,1,'2013-12-11 10:24:35','0000-00-00 00:00:00','ff','layout11','f','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/107','page',''),
 (109,2,'2013-12-11 10:27:48','0000-00-00 00:00:00','fdsa','fdasdas.0','ffff','publish','open','3','2013-12-11 15:10:21','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/108','page',''),
 (110,1,'2013-12-11 13:59:02','0000-00-00 00:00:00','draftdraftdraftdrafterw','draft11','draftdraft','deleted','close','','2013-12-11 14:17:24','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/110','page',''),
 (111,1,'2013-12-11 14:05:50','0000-00-00 00:00:00','fdsa','fda11','fdsa','deleted','close','fdas','2013-12-12 08:27:43','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/111','page',''),
 (112,2,'2013-12-11 14:28:38','0000-00-00 00:00:00','fdsa','fdsa','fdsa','deleted','open','1','2013-12-12 08:26:55','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/112','page',''),
 (113,1,'2013-12-11 15:37:45','0000-00-00 00:00:00','丝','蚕','fa','deleted','open','','2013-12-11 18:24:32','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/113','page',''),
 (114,1,'2013-12-11 15:41:44','0000-00-00 00:00:00','朝秦暮楚','城区','','deleted','open','','2013-12-11 18:24:14','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/showPostDetailPage/114','page',''),
 (116,1,'2013-12-11 16:00:53','0000-00-00 00:00:00','fdlajdl&nbsp;&nbsp;&nbsp;&nbsp;','add category','','deleted','open','','2013-12-11 18:24:05','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/116','page',''),
 (117,1,'2013-12-11 16:01:49','0000-00-00 00:00:00','fds','dfsa','','deleted','open','','2013-12-11 18:19:30','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/117','page',''),
 (118,1,'2013-12-11 16:03:26','0000-00-00 00:00:00','fdsadfsafdsa','fda','','deleted','open','','2013-12-11 18:19:44','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/118','page',''),
 (121,2,'2013-12-12 12:25:46','0000-00-00 00:00:00','fdsa','dsa','fdsa','draft','close','fdas','2013-12-12 12:25:57','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/119','page',''),
 (122,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','add category','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (123,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','dfsa','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (124,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','fda','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (125,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','fda11','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (126,2,'0000-00-00 00:00:00','0000-00-00 00:00:00','','fdsa','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (127,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','add category','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (128,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','','dfsa','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','nav_menu_item',''),
 (129,1,'2013-12-12 14:41:59','0000-00-00 00:00:00','guid','guid','','deleted','open','','2013-12-12 18:34:59','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/129','page',''),
 (130,1,'2013-12-12 14:45:18','0000-00-00 00:00:00','guid3','guid2','','deleted','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/130','page',''),
 (131,1,'2013-12-20 09:16:42','0000-00-00 00:00:00','fdsaf','safd','','deleted','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/131','page',''),
 (132,2,'2013-12-20 09:17:24','0000-00-00 00:00:00','f','test9:17','f','deleted','close','f','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms/index.php/post/132','page',''),
 (133,2,'2013-12-20 09:38:24','0000-00-00 00:00:00','fdsadasfa','dsa','1','deleted','open','1','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms//post/133','page',''),
 (134,1,'2013-12-20 09:38:38','0000-00-00 00:00:00','1','1','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms//post/134','page',''),
 (135,1,'2013-12-20 09:41:20','0000-00-00 00:00:00','2','2','','publish','open','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'http://localhost/yiicms//post/135','page','');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;


--
-- Definition of table `term_relationships`
--

DROP TABLE IF EXISTS `term_relationships`;
CREATE TABLE `term_relationships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `term_taxonomy_id` int(10) unsigned DEFAULT '0',
  `term_order` int(10) DEFAULT '0',
  `object_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `term_relationships`
--

/*!40000 ALTER TABLE `term_relationships` DISABLE KEYS */;
INSERT INTO `term_relationships` (`id`,`term_taxonomy_id`,`term_order`,`object_id`) VALUES 
 (1,5,0,40),
 (2,6,0,40),
 (3,7,0,40),
 (4,6,0,41),
 (5,7,0,41),
 (6,7,0,61),
 (7,5,0,61),
 (8,6,0,62),
 (9,7,0,62),
 (10,8,1,63),
 (11,8,2,64),
 (12,8,3,65),
 (13,5,1,66),
 (14,5,2,67),
 (15,5,3,68),
 (16,5,4,69),
 (17,9,1,70),
 (18,9,2,71),
 (19,9,3,72),
 (20,9,4,73),
 (21,5,0,115),
 (22,5,0,115),
 (23,5,0,115),
 (24,6,0,115),
 (27,5,0,119),
 (32,6,0,120),
 (33,5,0,120),
 (34,6,0,120),
 (35,6,0,120),
 (36,5,0,119),
 (37,6,0,117),
 (38,5,0,118),
 (39,6,0,116),
 (40,5,0,114),
 (42,5,0,113),
 (43,5,0,112),
 (44,6,0,111),
 (45,6,0,121),
 (46,0,0,122),
 (47,0,0,122),
 (48,7,1,122),
 (49,7,2,123),
 (50,7,3,124),
 (51,7,4,125),
 (52,7,5,126),
 (53,9,5,127),
 (54,9,6,128),
 (55,5,0,129),
 (56,6,0,135);
/*!40000 ALTER TABLE `term_relationships` ENABLE KEYS */;


--
-- Definition of table `term_taxonomy`
--

DROP TABLE IF EXISTS `term_taxonomy`;
CREATE TABLE `term_taxonomy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` int(10) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `term_taxonomy`
--

/*!40000 ALTER TABLE `term_taxonomy` DISABLE KEYS */;
INSERT INTO `term_taxonomy` (`id`,`term_id`,`taxonomy`,`description`,`parent`,`count`) VALUES 
 (1,1,'nav_menu','',0,0),
 (2,2,'nav_menu','',0,0),
 (3,3,'nav_menu','',0,0),
 (4,4,'nav_menu','',0,0),
 (5,5,'category','dsa',0,0),
 (6,6,'category','fdsa',0,0),
 (7,7,'post_tag','fsa',0,0),
 (8,8,'nav_menu','',0,0),
 (9,9,'nav_menu','',0,0);
/*!40000 ALTER TABLE `term_taxonomy` ENABLE KEYS */;


--
-- Definition of table `terms`
--

DROP TABLE IF EXISTS `terms`;
CREATE TABLE `terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terms`
--

/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
INSERT INTO `terms` (`id`,`name`,`slug`,`term_group`) VALUES 
 (3,'456','456',0),
 (4,'fdas','fdas',0),
 (5,'Yii','sa',0),
 (6,'PHP','fdsa',0),
 (7,'Js','dfsa',0),
 (8,'顶戴df','顶戴df',0),
 (9,'xw','xw',0);
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;


--
-- Definition of table `usermeta`
--

DROP TABLE IF EXISTS `usermeta`;
CREATE TABLE `usermeta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usermeta`
--

/*!40000 ALTER TABLE `usermeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `usermeta` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nickname` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nickname` (`user_nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`user_login`,`user_pass`,`user_nickname`,`user_email`,`user_url`,`user_registered`,`user_status`) VALUES 
 (1,'shawn','e99a18c428cb38d5f260853678922e03','f','shawn@qq.com','','0000-00-00 00:00:00',0),
 (2,'123','202cb962ac59075b964b07152d234b70','fjl','12@qq.com','','0000-00-00 00:00:00',0),
 (3,'abc','202cb962ac59075b964b07152d234b70','fdsa','abc@qq.com','','2014-02-21 14:55:58',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
