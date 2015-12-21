/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : xinya

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-12-22 00:39:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL COMMENT '分类名称',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='项目分类表';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('17', '面部按摩', '0', '2015-12-17 17:18:41');
INSERT INTO `category` VALUES ('31', '脸部按摩', '0', '2015-12-18 16:00:49');
INSERT INTO `category` VALUES ('34', '腿部按摩', '1', '2015-12-18 16:21:42');
INSERT INTO `category` VALUES ('35', '胸部按摩', '0', '2015-12-18 16:39:49');
INSERT INTO `category` VALUES ('37', '腿部按摩', '0', '2015-12-21 16:26:56');

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
INSERT INTO `order` VALUES ('2', 'abc987652147ddkopl9658www26593ee', 'dfsdergre', 'lfei', '13699854211', '11111111', '2222', '33.00', '1', '2015-12-21 10:35:53', null, '2015-12-21 10:35:57');
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
  `project_cover` varchar(1000) DEFAULT NULL COMMENT '封面',
  `use_time` mediumint(10) unsigned NOT NULL COMMENT '使用时间',
  `price` int(10) unsigned NOT NULL COMMENT '价格',
  `suitable_skin` varchar(500) DEFAULT NULL COMMENT '适合皮肤',
  `effects` varchar(500) DEFAULT NULL COMMENT '功效',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='项目表';

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES ('1', 'weewew', '17', '{\"file_name\":\"754b40cf12b22646043a3bd9f6327a2e.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/754b40cf12b22646043a3bd9f6327a2e.jpg\",\"raw_name\":\"754b40cf12b22646043a3bd9f6327a2e\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '11', '11', '11', '11', '1', '2015-12-18 15:50:20');
INSERT INTO `project` VALUES ('2', '33', '31', '{\"file_name\":\"754b40cf12b22646043a3bd9f6327a2e.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/754b40cf12b22646043a3bd9f6327a2e.jpg\",\"raw_name\":\"754b40cf12b22646043a3bd9f6327a2e\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '11', '22', 'dddd                        ggg                                                          ', null, '1', '2015-12-21 14:39:11');
INSERT INTO `project` VALUES ('3', '33', '34', '{\"file_name\":\"0d81292127f935e3c8fdf034622d7107.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/0d81292127f935e3c8fdf034622d7107.jpg\",\"raw_name\":\"0d81292127f935e3c8fdf034622d7107\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '11', '22', '333', '333', '1', '2015-12-21 14:51:15');
INSERT INTO `project` VALUES ('4', '面部按摩测试', '17', '{\"file_name\":\"c9ef4790782d44eaf7dee890682a887a.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/c9ef4790782d44eaf7dee890682a887a.jpg\",\"raw_name\":\"c9ef4790782d44eaf7dee890682a887a\",\"orig_name\":\"Jianyue029.jpg\",\"client_name\":\"Jianyue029.jpg\",\"file_ext\":\".jpg\",\"file_size\":141,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1100', '909090', 'ddd', 'ddddd', '0', '2015-12-21 14:54:00');
INSERT INTO `project` VALUES ('5', '测试胸部按摩', '31', '{\"file_name\":\"40e8e3b6a14fb9bfb396d9c74dc38e55.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/40e8e3b6a14fb9bfb396d9c74dc38e55.jpg\",\"raw_name\":\"40e8e3b6a14fb9bfb396d9c74dc38e55\",\"orig_name\":\"Jianyue005.jpg\",\"client_name\":\"Jianyue005.jpg\",\"file_ext\":\".jpg\",\"file_size\":123.65,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '33', '33', '33', '33', '0', '2015-12-21 16:56:28');
INSERT INTO `project` VALUES ('6', '测试胸部按摩', '31', '{\"file_name\":\"44bdbc745ba00d488e38b1fe96b7010f.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/44bdbc745ba00d488e38b1fe96b7010f.jpg\",\"raw_name\":\"44bdbc745ba00d488e38b1fe96b7010f\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '22', '212', '22', '222', '0', '2015-12-21 16:58:10');
INSERT INTO `project` VALUES ('7', '测试胸部按摩', '37', '{\"file_name\":\"816eb99b63ef35d26508e574df36134d.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/816eb99b63ef35d26508e574df36134d.jpg\",\"raw_name\":\"816eb99b63ef35d26508e574df36134d\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '44', '44', '55', '555', '0', '2015-12-21 16:59:18');
INSERT INTO `project` VALUES ('8', '测试胸部按摩', '37', '{\"file_name\":\"c994f5ef1a643961065104e4e0c3334b.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/c994f5ef1a643961065104e4e0c3334b.jpg\",\"raw_name\":\"c994f5ef1a643961065104e4e0c3334b\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '44', '444', '44', '44', '0', '2015-12-21 17:00:29');
INSERT INTO `project` VALUES ('9', '测试胸部按摩', '37', '{\"file_name\":\"fb0fe1390b887c2c60ce6c05628ec3ca.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/fb0fe1390b887c2c60ce6c05628ec3ca.jpg\",\"raw_name\":\"fb0fe1390b887c2c60ce6c05628ec3ca\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '44', '444', '44', '44', '0', '2015-12-21 17:00:44');

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
