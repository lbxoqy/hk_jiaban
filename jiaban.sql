/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : mysms

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2016-05-15 23:58:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for jiaban
-- ----------------------------
DROP TABLE IF EXISTS `jiaban`;
CREATE TABLE `jiaban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `workid` varchar(255) DEFAULT NULL,
  `entrydate` date DEFAULT NULL,
  `morningtime` datetime DEFAULT NULL,
  `hometime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jiaban
-- ----------------------------
INSERT INTO `jiaban` VALUES ('1', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('2', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('3', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('4', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('5', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('6', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('7', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('8', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('9', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('10', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('11', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('12', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('13', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('14', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('15', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
INSERT INTO `jiaban` VALUES ('16', '李炳贤', '男', '392', '2016-04-11', null, '2016-05-14 23:25:11');
