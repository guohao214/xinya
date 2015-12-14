/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50612
Source Host           : 127.0.0.1:3306
Source Database       : xinya

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2015-12-14 18:59:52
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
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目分类表';

-- ----------------------------
-- Records of category
-- ----------------------------

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` char(32) NOT NULL COMMENT '订单号',
  `open_id` char(128) DEFAULT NULL COMMENT '用户在商户下的唯一标示',
  `prepay_id` char(64) DEFAULT NULL COMMENT '预支付ID',
  `transaction_id` char(32) DEFAULT NULL COMMENT '微信订单号',
  `total_fee` float(10,2) unsigned NOT NULL COMMENT '订单金额',
  `create_time` datetime NOT NULL COMMENT '下单时间',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for `project`
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `project_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '项目ID',
  `project_name` varchar(100) NOT NULL COMMENT '项目名称',
  `categoty_id` int(11) unsigned NOT NULL COMMENT '所属分类',
  `project_cover` varchar(500) DEFAULT NULL COMMENT '封面',
  `use_time` mediumint(10) unsigned NOT NULL COMMENT '使用时间',
  `price` float(10,2) unsigned NOT NULL COMMENT '价格',
  `suitable_skin` varchar(500) DEFAULT NULL COMMENT '适合皮肤',
  `effects` varchar(500) DEFAULT NULL COMMENT '功效',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目表';

-- ----------------------------
-- Records of project
-- ----------------------------

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
