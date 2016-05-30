/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : mysms

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2016-05-15 23:58:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL,
  `password` char(32) NOT NULL,
  `nickname` varchar(50) NOT NULL COMMENT '姓名',
  `workid` varchar(10) DEFAULT NULL COMMENT '工号',
  `bind_account` varchar(50) NOT NULL,
  `last_login_time` int(11) unsigned DEFAULT '0',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(8) unsigned DEFAULT '0',
  `verify` varchar(32) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `entrydate` datetime DEFAULT NULL COMMENT '入职时间',
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `type_id` tinyint(2) unsigned DEFAULT '0',
  `info` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '1111', '管理员', null, '', '1312088534', '127.0.0.1', '924', '8888', 'bruce-vip@qq.com', 'admin', null, '1222907803', '1239977420', '1', '0', '');
INSERT INTO `user` VALUES ('2', 'demo', '1111', '演示', null, '', '1306159437', '127.0.0.1', '94', '8888', '', '', null, '1239783735', '1254325770', '1', '0', '');
INSERT INTO `user` VALUES ('40', 'libingxian1', 'libingxian', '华康移动', '', '', '0', null, '0', null, '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '');
INSERT INTO `user` VALUES ('37', 'demo1', '1111', 'demo', '', '', '0', null, '0', null, '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '');
