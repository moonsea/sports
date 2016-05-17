/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50090
Source Host           : localhost:3306
Source Database       : sports

Target Server Type    : MYSQL
Target Server Version : 50090
File Encoding         : 65001

Date: 2016-05-17 14:23:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ad`
-- ----------------------------
DROP TABLE IF EXISTS `ad`;
CREATE TABLE `ad` (
  `ad_id` varchar(32) NOT NULL,
  `ad_title` varchar(100) default NULL,
  `ad_content` text,
  `ad_url` text,
  `remark` varchar(100) default NULL,
  PRIMARY KEY  (`ad_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ad
-- ----------------------------

-- ----------------------------
-- Table structure for `club`
-- ----------------------------
DROP TABLE IF EXISTS `club`;
CREATE TABLE `club` (
  `club_id` varchar(32) NOT NULL,
  `club_name` varchar(100) default NULL,
  `img` text COMMENT '头像',
  `rank` varchar(32) NOT NULL default '0',
  `remark` varchar(255) default NULL,
  PRIMARY KEY  (`club_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of club
-- ----------------------------

-- ----------------------------
-- Table structure for `comment`
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comment_id` varchar(32) NOT NULL,
  `user_id` varchar(32) default NULL,
  `video_id` varchar(32) default NULL,
  `content` text,
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for `favorite`
-- ----------------------------
DROP TABLE IF EXISTS `favorite`;
CREATE TABLE `favorite` (
  `favo_id` varchar(32) NOT NULL,
  `user_id` varchar(32) default NULL COMMENT '关注用户的id',
  `atten_id` varchar(32) default NULL COMMENT '被关注用户的id',
  `remark` varchar(100) default NULL,
  PRIMARY KEY  (`favo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of favorite
-- ----------------------------

-- ----------------------------
-- Table structure for `follow`
-- ----------------------------
DROP TABLE IF EXISTS `follow`;
CREATE TABLE `follow` (
  `follow_id` varchar(32) NOT NULL,
  `user_id` varchar(32) default NULL COMMENT '被follow的id',
  `follow_user` varchar(32) default NULL COMMENT 'follow的id',
  `remark` varchar(100) default NULL,
  PRIMARY KEY  (`follow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of follow
-- ----------------------------

-- ----------------------------
-- Table structure for `game`
-- ----------------------------
DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `game_id` varchar(32) NOT NULL,
  `game_name` varchar(500) default NULL,
  `user_id` varchar(32) default NULL COMMENT '发起人',
  `wiki_id` varchar(32) default NULL,
  `type_id` varchar(32) default NULL,
  PRIMARY KEY  (`game_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of game
-- ----------------------------

-- ----------------------------
-- Table structure for `game_rank`
-- ----------------------------
DROP TABLE IF EXISTS `game_rank`;
CREATE TABLE `game_rank` (
  `id` varchar(32) NOT NULL,
  `game_id` varchar(32) default NULL,
  `rank` varchar(32) default NULL COMMENT '比赛名次',
  `user_id` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of game_rank
-- ----------------------------

-- ----------------------------
-- Table structure for `game_type`
-- ----------------------------
DROP TABLE IF EXISTS `game_type`;
CREATE TABLE `game_type` (
  `type_id` varchar(32) NOT NULL,
  `type_name` varchar(32) default NULL,
  PRIMARY KEY  (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of game_type
-- ----------------------------

-- ----------------------------
-- Table structure for `game_video`
-- ----------------------------
DROP TABLE IF EXISTS `game_video`;
CREATE TABLE `game_video` (
  `id` varchar(32) NOT NULL,
  `video_id` varchar(32) default NULL,
  `game_id` varchar(32) default NULL,
  `video_type` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of game_video
-- ----------------------------

-- ----------------------------
-- Table structure for `item`
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `item_id` varchar(32) NOT NULL,
  `item_name` varchar(32) default NULL,
  `user_id` varchar(32) default NULL,
  PRIMARY KEY  (`item_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of item
-- ----------------------------

-- ----------------------------
-- Table structure for `joined_game`
-- ----------------------------
DROP TABLE IF EXISTS `joined_game`;
CREATE TABLE `joined_game` (
  `joined_id` varchar(32) NOT NULL,
  `user_id` varchar(32) default NULL COMMENT '参加用户的id',
  `game_id` varchar(32) default NULL COMMENT '参加比赛的id',
  `remark` varchar(100) default NULL,
  PRIMARY KEY  (`joined_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of joined_game
-- ----------------------------

-- ----------------------------
-- Table structure for `join_club`
-- ----------------------------
DROP TABLE IF EXISTS `join_club`;
CREATE TABLE `join_club` (
  `join_id` varchar(32) NOT NULL,
  `user_id` varchar(32) default NULL,
  `club_id` varchar(32) default NULL,
  `remark` varchar(100) default NULL,
  PRIMARY KEY  (`join_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of join_club
-- ----------------------------

-- ----------------------------
-- Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `message_id` varchar(32) NOT NULL,
  `msg_content` text,
  `user_id` varchar(32) default NULL,
  `add_time` varchar(100) default NULL,
  `update_time` varchar(100) default NULL,
  `remark` varchar(500) default NULL,
  PRIMARY KEY  (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of message
-- ----------------------------

-- ----------------------------
-- Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` varchar(32) NOT NULL,
  `role_name` varchar(100) default NULL,
  `remark` varchar(100) default NULL,
  PRIMARY KEY  (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of role
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` varchar(32) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `desc` text COMMENT '用户介绍',
  `medal` varchar(32) NOT NULL default '0' COMMENT '金牌数',
  `img` text COMMENT '头像',
  `champion` varchar(32) NOT NULL default '0' COMMENT '冠军币',
  `rank` varchar(32) NOT NULL default '0' COMMENT '等级',
  `role` varchar(32) default NULL COMMENT '身份认证',
  `sex` varchar(32) default NULL,
  `birthday` varchar(32) default NULL,
  `location` varchar(32) default NULL,
  `mobile` varchar(32) default NULL,
  PRIMARY KEY  (`user_id`),
  KEY `role` (`role`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for `video`
-- ----------------------------
DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `id` varchar(32) NOT NULL,
  `name` varchar(500) default NULL,
  `user_id` varchar(100) default NULL,
  `detail` text,
  `play_count` varchar(32) NOT NULL default '0' COMMENT '播放次数',
  `praise_count` varchar(32) NOT NULL default '0',
  `add_time` varchar(32) default NULL,
  `last_time` varchar(32) default NULL,
  `desc` varchar(100) default NULL COMMENT '视频简介',
  `source_id` varchar(32) default NULL,
  `class_id` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of video
-- ----------------------------

-- ----------------------------
-- Table structure for `video_class`
-- ----------------------------
DROP TABLE IF EXISTS `video_class`;
CREATE TABLE `video_class` (
  `class_id` varchar(32) NOT NULL,
  `class_name` varchar(32) default NULL,
  PRIMARY KEY  (`class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of video_class
-- ----------------------------

-- ----------------------------
-- Table structure for `video_source`
-- ----------------------------
DROP TABLE IF EXISTS `video_source`;
CREATE TABLE `video_source` (
  `source_id` varchar(32) NOT NULL,
  `source_name` varchar(32) default NULL,
  PRIMARY KEY  (`source_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of video_source
-- ----------------------------

-- ----------------------------
-- Table structure for `video_type`
-- ----------------------------
DROP TABLE IF EXISTS `video_type`;
CREATE TABLE `video_type` (
  `type_id` varchar(32) NOT NULL,
  `type_name` varchar(32) default NULL,
  PRIMARY KEY  (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of video_type
-- ----------------------------

-- ----------------------------
-- Table structure for `wiki`
-- ----------------------------
DROP TABLE IF EXISTS `wiki`;
CREATE TABLE `wiki` (
  `wiki_id` varchar(32) NOT NULL,
  `wiki_name` varchar(100) default NULL,
  `remark` varchar(100) default NULL,
  PRIMARY KEY  (`wiki_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wiki
-- ----------------------------
