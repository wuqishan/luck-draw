/*
Navicat MySQL Data Transfer

Source Server         : vagrant
Source Server Version : 50173
Source Host           : localhost:3306
Source Database       : luck

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-08-17 11:13:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for reward
-- ----------------------------
DROP TABLE IF EXISTS `reward`;
CREATE TABLE `reward` (
  `id` int(11) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `away` tinyint(1) DEFAULT '0' COMMENT '该奖品是否已经被抽走，0表示未抽走，1表示已经抽走',
  `comments` text,
  `away_time` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(16) DEFAULT NULL,
  `comments` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user_reward
-- ----------------------------
DROP TABLE IF EXISTS `user_reward`;
CREATE TABLE `user_reward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `reward_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
