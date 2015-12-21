/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50612
Source Host           : 127.0.0.1:3306
Source Database       : xinya

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2015-12-21 14:27:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL COMMENT '分类名称',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否禁用， 0启用， 1禁用',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='项目分类表';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('17', '面部按摩', '0', '2015-12-17 17:18:41');
INSERT INTO `category` VALUES ('31', '脸部按摩', '0', '2015-12-18 16:00:49');
INSERT INTO `category` VALUES ('34', '腿部按摩', '0', '2015-12-18 16:21:42');
INSERT INTO `category` VALUES ('35', '胸部按摩', '0', '2015-12-18 16:39:49');

-- ----------------------------
-- Table structure for `info`
-- ----------------------------
DROP TABLE IF EXISTS `info`;
CREATE TABLE `info` (
  `info_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL COMMENT '内容',
  `type` varchar(30) NOT NULL COMMENT '内容类型',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='信息表(公司简介.关于我们...)';

-- ----------------------------
-- Records of info
-- ----------------------------

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` char(32) NOT NULL COMMENT '订单号',
  `open_id` char(128) DEFAULT NULL COMMENT '用户在商户下的唯一标示',
  `user_name` varchar(50) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `prepay_id` char(64) DEFAULT NULL COMMENT '预支付ID',
  `transaction_id` char(32) DEFAULT NULL COMMENT '微信订单号',
  `total_fee` float(10,2) unsigned NOT NULL COMMENT '订单金额',
  `order_status` tinyint(2) unsigned NOT NULL COMMENT '订单状态',
  `pay_time` datetime DEFAULT NULL COMMENT '订单支付时间',
  `complete_time` datetime DEFAULT NULL COMMENT '订单完成时间（到店内进行了美容)',
  `create_time` datetime NOT NULL COMMENT '下单时间',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('2', '4kjhgf', 'dfsdergre', 'lfei', '13699854211', '11111111', '2222', '33.00', '1', '2015-12-21 10:35:53', null, '2015-12-21 10:35:57');
INSERT INTO `order` VALUES ('3', 'y56754', 'rgg54y65', 'guohao', '1352268547', '3334', null, '0.00', '3', null, null, '0000-00-00 00:00:00');
INSERT INTO `order` VALUES ('4', '54tyfr', 'dfbfd4343t4', 'zhouzhou', '13447854214', 'dddd', null, '0.00', '2', null, null, '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `order_project`
-- ----------------------------
DROP TABLE IF EXISTS `order_project`;
CREATE TABLE `order_project` (
  `order_project_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(11) unsigned NOT NULL,
  `project_id` bigint(11) unsigned NOT NULL,
  `fee` float(10,2) unsigned NOT NULL COMMENT '项目金额',
  `buy_counts` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '项目购买数量',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`order_project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单下的项目表';

-- ----------------------------
-- Records of order_project
-- ----------------------------

-- ----------------------------
-- Table structure for `project`
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `project_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '项目ID',
  `project_name` varchar(100) NOT NULL COMMENT '项目名称',
  `category_id` int(11) unsigned NOT NULL COMMENT '所属分类',
  `project_cover` varchar(500) DEFAULT NULL COMMENT '封面',
  `use_time` mediumint(10) unsigned NOT NULL COMMENT '使用时间',
  `price` float(10,2) unsigned NOT NULL COMMENT '价格',
  `suitable_skin` varchar(500) DEFAULT NULL COMMENT '适合皮肤',
  `effects` varchar(500) DEFAULT NULL COMMENT '功效',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='项目表';

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES ('1', 'weewew', '17', 'eee', '11', '11.00', '11', '11', '0', '2015-12-18 15:50:20');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
