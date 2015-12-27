/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : xinya

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-12-28 00:11:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `article_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL COMMENT '内容',
  `alias_name` varchar(100) NOT NULL COMMENT '内容类型',
  `class_type` enum('公司信息') DEFAULT '公司信息',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`article_id`),
  UNIQUE KEY `alias_key` (`alias_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '测试', '测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试v', 'ceshi1', '公司信息', '0', '2015-12-22 17:04:15');

-- ----------------------------
-- Table structure for `backup`
-- ----------------------------
DROP TABLE IF EXISTS `backup`;
CREATE TABLE `backup` (
  `backup_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_path` varchar(1000) NOT NULL,
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='数据库备份表';

-- ----------------------------
-- Records of backup
-- ----------------------------
INSERT INTO `backup` VALUES ('1', 'E:\\htdocs\\project\\xinya\\\\data\\20151222111638.bak', '1', '2015-12-22 11:16:38');
INSERT INTO `backup` VALUES ('2', 'E:\\htdocs\\project\\xinya\\\\data\\20151222111639.bak', '1', '2015-12-22 11:16:39');
INSERT INTO `backup` VALUES ('3', 'E:\\htdocs\\project\\xinya\\\\data\\20151222111639.bak', '1', '2015-12-22 11:16:39');
INSERT INTO `backup` VALUES ('4', 'E:\\htdocs\\project\\xinya\\\\data\\20151222111643.bak', '1', '2015-12-22 11:16:43');
INSERT INTO `backup` VALUES ('5', 'E:\\htdocs\\project\\xinya\\\\data\\20151222111643.bak', '0', '2015-12-22 11:16:43');
INSERT INTO `backup` VALUES ('6', 'E:\\htdocs\\project\\xinya\\\\data\\20151222111705.bak', '0', '2015-12-22 11:17:05');
INSERT INTO `backup` VALUES ('7', 'E:\\htdocs\\project\\xinya\\\\data\\20151222112109.gz', '0', '2015-12-22 11:21:09');
INSERT INTO `backup` VALUES ('8', 'E:\\htdocs\\project\\xinya\\data\\20151222114649.gz', '0', '2015-12-22 11:46:49');
INSERT INTO `backup` VALUES ('9', 'E:\\htdocs\\project\\xinya\\data\\20151222114722.gz', '0', '2015-12-22 11:47:22');
INSERT INTO `backup` VALUES ('10', 'E:\\htdocs\\project\\xinya\\data\\20151223094315.gz', '0', '2015-12-23 09:43:15');
INSERT INTO `backup` VALUES ('11', 'E:\\htdocs\\project\\xinya\\data\\20151224102307.gz', '0', '2015-12-24 10:23:07');
INSERT INTO `backup` VALUES ('12', 'E:\\htdocs\\project\\xinya\\data\\20151224103543.gz', '0', '2015-12-24 10:35:43');

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
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` varchar(50) NOT NULL COMMENT '订单号',
  `open_id` char(128) DEFAULT NULL COMMENT '用户在商户下的唯一标示',
  `shop_id` int(11) unsigned NOT NULL,
  `consume_code` char(8) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `prepay_id` char(64) DEFAULT NULL COMMENT '预支付ID',
  `transaction_id` char(32) DEFAULT NULL COMMENT '微信订单号',
  `total_fee` float(10,2) unsigned NOT NULL COMMENT '订单金额',
  `order_status` enum('未支付','已支付','已消费','已退款') NOT NULL DEFAULT '未支付' COMMENT '订单状态',
  `pay_time` datetime DEFAULT NULL COMMENT '订单支付时间',
  `complete_time` datetime DEFAULT NULL COMMENT '订单完成时间（到店内进行了美容)',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL COMMENT '下单时间',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('43', '201512271625551205476783', 'ttt', '2', '51985275', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:25:55');
INSERT INTO `order` VALUES ('44', '201512271625551205476783', 'ttt', '1', '11505211', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:25:55');
INSERT INTO `order` VALUES ('45', '201512271625551205476783', 'ttt', '1', '25165021', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:25:55');
INSERT INTO `order` VALUES ('46', '201512271630051209068872', 'ttt', '2', '90613872', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:30:05');
INSERT INTO `order` VALUES ('47', '201512271630051209068872', 'ttt', '1', '27026016', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:30:05');
INSERT INTO `order` VALUES ('48', '201512271630051209068872', 'ttt', '1', '01213852', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:30:05');
INSERT INTO `order` VALUES ('49', '201512271630051209068872', 'ttt', '1', '82500881', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:30:05');
INSERT INTO `order` VALUES ('50', '201512271630051209068872', 'ttt', '1', '00732199', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:30:05');
INSERT INTO `order` VALUES ('51', '201512271655001202434173', 'ttt', '2', '58521005', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:55:00');
INSERT INTO `order` VALUES ('52', '201512271655001202434173', 'ttt', '1', '12109750', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:55:00');
INSERT INTO `order` VALUES ('53', '201512271655001202434173', 'ttt', '1', '67632542', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:55:00');
INSERT INTO `order` VALUES ('54', '201512271655001202434173', 'ttt', '1', '07211492', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:55:00');
INSERT INTO `order` VALUES ('55', '201512271655001202434173', 'ttt', '1', '2691510', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 16:55:00');
INSERT INTO `order` VALUES ('56', '201512271710391206225994', 'ttt', '2', '35272101', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:10:39');
INSERT INTO `order` VALUES ('57', '201512271710391206225994', 'ttt', '1', '12776511', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:10:39');
INSERT INTO `order` VALUES ('58', '201512271710391206225994', 'ttt', '1', '22503501', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:10:39');
INSERT INTO `order` VALUES ('59', '201512271710391206225994', 'ttt', '1', '10613212', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:10:39');
INSERT INTO `order` VALUES ('60', '201512271710391206225994', 'ttt', '1', '20372056', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:10:40');
INSERT INTO `order` VALUES ('61', '201512271711201201777043', 'ttt', '2', '12301272', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('62', '201512271711201201777043', 'ttt', '2', '22111112', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('63', '201512271711201201777043', 'ttt', '2', '01117020', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('64', '201512271711201201777043', 'ttt', '2', '23110067', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('65', '201512271711201201777043', 'ttt', '2', '0221271', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('66', '201512271711201201777043', 'ttt', '2', '75121103', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('67', '201512271711201201777043', 'ttt', '1', '15701420', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('68', '201512271711201201777043', 'ttt', '1', '11200167', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('69', '201512271711201201777043', 'ttt', '1', '15010120', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('70', '201512271711201201777043', 'ttt', '1', '02732211', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('71', '201512271711201201777043', 'ttt', '1', '10172191', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('72', '201512271711201201777043', 'ttt', '1', '27116220', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('73', '201512271711201201777043', 'ttt', '1', '00171121', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('74', '201512271711201201777043', 'ttt', '1', '32002519', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');
INSERT INTO `order` VALUES ('75', '201512271711201201777043', 'ttt', '1', '32957154', null, null, null, null, '0.01', '未支付', null, null, '0', '2015-12-27 17:11:20');

-- ----------------------------
-- Table structure for `order_project`
-- ----------------------------
DROP TABLE IF EXISTS `order_project`;
CREATE TABLE `order_project` (
  `order_project_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(11) unsigned NOT NULL,
  `project_id` bigint(11) unsigned NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_use_time` int(10) NOT NULL,
  `project_price` float(10,2) unsigned NOT NULL COMMENT '项目金额',
  `project_cover` varchar(1000) DEFAULT NULL,
  `buy_counts` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '项目购买数量',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`order_project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COMMENT='订单下的项目表';

-- ----------------------------
-- Records of order_project
-- ----------------------------
INSERT INTO `order_project` VALUES ('37', '43', '9', '测试脸部按摩3', '44', '0.01', null, '1', '2015-12-27 16:25:55');
INSERT INTO `order_project` VALUES ('38', '44', '4', '面部按摩测试', '1100', '0.01', null, '1', '2015-12-27 16:25:55');
INSERT INTO `order_project` VALUES ('39', '45', '4', '面部按摩测试', '1100', '0.01', null, '1', '2015-12-27 16:25:55');
INSERT INTO `order_project` VALUES ('40', '46', '9', '测试脸部按摩3', '44', '0.01', null, '1', '2015-12-27 16:30:05');
INSERT INTO `order_project` VALUES ('41', '47', '4', '面部按摩测试', '1100', '0.01', null, '1', '2015-12-27 16:30:05');
INSERT INTO `order_project` VALUES ('42', '48', '4', '面部按摩测试', '1100', '0.01', null, '1', '2015-12-27 16:30:05');
INSERT INTO `order_project` VALUES ('43', '49', '4', '面部按摩测试', '1100', '0.01', null, '1', '2015-12-27 16:30:05');
INSERT INTO `order_project` VALUES ('44', '50', '4', '面部按摩测试', '1100', '0.01', null, '1', '2015-12-27 16:30:05');
INSERT INTO `order_project` VALUES ('45', '51', '9', '测试脸部按摩3', '44', '0.01', '{\"file_name\":\"6f925f02d87040cf649df7585ec15319.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/6f925f02d87040cf649df7585ec15319.jpg\",\"raw_name\":\"6f925f02d87040cf649df7585ec15319\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 16:55:00');
INSERT INTO `order_project` VALUES ('46', '52', '4', '面部按摩测试', '1100', '0.01', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 16:55:00');
INSERT INTO `order_project` VALUES ('47', '53', '4', '面部按摩测试', '1100', '0.01', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 16:55:00');
INSERT INTO `order_project` VALUES ('48', '54', '4', '面部按摩测试', '1100', '0.01', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 16:55:00');
INSERT INTO `order_project` VALUES ('49', '55', '4', '面部按摩测试', '1100', '0.01', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 16:55:00');
INSERT INTO `order_project` VALUES ('50', '56', '9', '测试脸部按摩3', '44', '0.01', '{\"file_name\":\"6f925f02d87040cf649df7585ec15319.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/6f925f02d87040cf649df7585ec15319.jpg\",\"raw_name\":\"6f925f02d87040cf649df7585ec15319\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:10:39');
INSERT INTO `order_project` VALUES ('51', '57', '4', '面部按摩测试', '1100', '0.01', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:10:39');
INSERT INTO `order_project` VALUES ('52', '58', '4', '面部按摩测试', '1100', '0.01', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:10:39');
INSERT INTO `order_project` VALUES ('53', '59', '4', '面部按摩测试', '1100', '0.01', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:10:40');
INSERT INTO `order_project` VALUES ('54', '60', '4', '面部按摩测试', '1100', '0.01', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:10:40');
INSERT INTO `order_project` VALUES ('55', '61', '9', '测试脸部按摩3', '44', '0.01', '{\"file_name\":\"6f925f02d87040cf649df7585ec15319.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/6f925f02d87040cf649df7585ec15319.jpg\",\"raw_name\":\"6f925f02d87040cf649df7585ec15319\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('56', '62', '9', '测试脸部按摩3', '44', '0.01', '{\"file_name\":\"6f925f02d87040cf649df7585ec15319.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/6f925f02d87040cf649df7585ec15319.jpg\",\"raw_name\":\"6f925f02d87040cf649df7585ec15319\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('57', '63', '9', '测试脸部按摩3', '44', '0.01', '{\"file_name\":\"6f925f02d87040cf649df7585ec15319.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/6f925f02d87040cf649df7585ec15319.jpg\",\"raw_name\":\"6f925f02d87040cf649df7585ec15319\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('58', '64', '9', '测试脸部按摩3', '44', '0.01', '{\"file_name\":\"6f925f02d87040cf649df7585ec15319.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/6f925f02d87040cf649df7585ec15319.jpg\",\"raw_name\":\"6f925f02d87040cf649df7585ec15319\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('59', '65', '9', '测试脸部按摩3', '44', '0.01', '{\"file_name\":\"6f925f02d87040cf649df7585ec15319.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/6f925f02d87040cf649df7585ec15319.jpg\",\"raw_name\":\"6f925f02d87040cf649df7585ec15319\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('60', '66', '9', '测试脸部按摩3', '44', '0.01', '{\"file_name\":\"6f925f02d87040cf649df7585ec15319.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/6f925f02d87040cf649df7585ec15319.jpg\",\"raw_name\":\"6f925f02d87040cf649df7585ec15319\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('61', '67', '5', '测试脸部按摩', '33', '0.01', '{\"file_name\":\"e430b8b888b92a2b32f689e07e219c2a.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/e430b8b888b92a2b32f689e07e219c2a.jpg\",\"raw_name\":\"e430b8b888b92a2b32f689e07e219c2a\",\"orig_name\":\"zhuoku106.jpg\",\"client_name\":\"zhuoku106.jpg\",\"file_ext\":\".jpg\",\"file_size\":507.62,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('62', '68', '5', '测试脸部按摩', '33', '0.01', '{\"file_name\":\"e430b8b888b92a2b32f689e07e219c2a.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/e430b8b888b92a2b32f689e07e219c2a.jpg\",\"raw_name\":\"e430b8b888b92a2b32f689e07e219c2a\",\"orig_name\":\"zhuoku106.jpg\",\"client_name\":\"zhuoku106.jpg\",\"file_ext\":\".jpg\",\"file_size\":507.62,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('63', '69', '5', '测试脸部按摩', '33', '0.01', '{\"file_name\":\"e430b8b888b92a2b32f689e07e219c2a.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/e430b8b888b92a2b32f689e07e219c2a.jpg\",\"raw_name\":\"e430b8b888b92a2b32f689e07e219c2a\",\"orig_name\":\"zhuoku106.jpg\",\"client_name\":\"zhuoku106.jpg\",\"file_ext\":\".jpg\",\"file_size\":507.62,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('64', '70', '5', '测试脸部按摩', '33', '0.01', '{\"file_name\":\"e430b8b888b92a2b32f689e07e219c2a.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/e430b8b888b92a2b32f689e07e219c2a.jpg\",\"raw_name\":\"e430b8b888b92a2b32f689e07e219c2a\",\"orig_name\":\"zhuoku106.jpg\",\"client_name\":\"zhuoku106.jpg\",\"file_ext\":\".jpg\",\"file_size\":507.62,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('65', '71', '5', '测试脸部按摩', '33', '0.01', '{\"file_name\":\"e430b8b888b92a2b32f689e07e219c2a.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/e430b8b888b92a2b32f689e07e219c2a.jpg\",\"raw_name\":\"e430b8b888b92a2b32f689e07e219c2a\",\"orig_name\":\"zhuoku106.jpg\",\"client_name\":\"zhuoku106.jpg\",\"file_ext\":\".jpg\",\"file_size\":507.62,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('66', '72', '4', '面部按摩测试', '1100', '0.01', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('67', '73', '4', '面部按摩测试', '1100', '0.01', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('68', '74', '4', '面部按摩测试', '1100', '0.01', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');
INSERT INTO `order_project` VALUES ('69', '75', '4', '面部按摩测试', '1100', '0.01', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1', '2015-12-27 17:11:20');

-- ----------------------------
-- Table structure for `project`
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `project_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '项目ID',
  `project_name` varchar(100) NOT NULL COMMENT '项目名称',
  `category_id` int(11) unsigned NOT NULL COMMENT '所属分类',
  `shop_id` int(11) unsigned NOT NULL DEFAULT '0',
  `project_cover` varchar(1000) DEFAULT NULL COMMENT '封面',
  `use_time` mediumint(10) unsigned NOT NULL COMMENT '使用时间',
  `price` float(10,2) unsigned NOT NULL COMMENT '价格',
  `suitable_skin` varchar(500) DEFAULT NULL COMMENT '适合皮肤',
  `effects` varchar(500) DEFAULT NULL COMMENT '功效',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='项目表';

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES ('1', '腿部按摩第一疗程', '17', '0', '{\"file_name\":\"754b40cf12b22646043a3bd9f6327a2e.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/754b40cf12b22646043a3bd9f6327a2e.jpg\",\"raw_name\":\"754b40cf12b22646043a3bd9f6327a2e\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '111', '0.01', '11', '11', '0', '2015-12-18 15:50:20');
INSERT INTO `project` VALUES ('2', '腿部按摩第二疗程', '31', '0', '{\"file_name\":\"754b40cf12b22646043a3bd9f6327a2e.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/754b40cf12b22646043a3bd9f6327a2e.jpg\",\"raw_name\":\"754b40cf12b22646043a3bd9f6327a2e\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '11', '0.01', 'dddd                        ggg                                                          ', null, '0', '2015-12-21 14:39:11');
INSERT INTO `project` VALUES ('3', '腿部按摩第三疗程', '34', '1', '{\"file_name\":\"0d81292127f935e3c8fdf034622d7107.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/0d81292127f935e3c8fdf034622d7107.jpg\",\"raw_name\":\"0d81292127f935e3c8fdf034622d7107\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '11', '0.01', '333', '333', '0', '2015-12-21 14:51:15');
INSERT INTO `project` VALUES ('4', '面部按摩测试', '17', '1', '{\"file_name\":\"a3dfb5f33258cac220a22c6495349555.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/a3dfb5f33258cac220a22c6495349555.jpg\",\"raw_name\":\"a3dfb5f33258cac220a22c6495349555\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '1100', '0.01', 'ddd', 'ddddd', '0', '2015-12-21 14:54:00');
INSERT INTO `project` VALUES ('5', '测试脸部按摩', '31', '1', '{\"file_name\":\"e430b8b888b92a2b32f689e07e219c2a.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/e430b8b888b92a2b32f689e07e219c2a.jpg\",\"raw_name\":\"e430b8b888b92a2b32f689e07e219c2a\",\"orig_name\":\"zhuoku106.jpg\",\"client_name\":\"zhuoku106.jpg\",\"file_ext\":\".jpg\",\"file_size\":507.62,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '33', '0.01', '33', '33', '0', '2015-12-21 16:56:28');
INSERT INTO `project` VALUES ('6', '测试脸部按摩0', '31', '0', '{\"file_name\":\"e0d44dc957fe473e4e973e382b5be095.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/e0d44dc957fe473e4e973e382b5be095.jpg\",\"raw_name\":\"e0d44dc957fe473e4e973e382b5be095\",\"orig_name\":\"Jianyue029.jpg\",\"client_name\":\"Jianyue029.jpg\",\"file_ext\":\".jpg\",\"file_size\":141,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '22', '0.01', '22', '222', '0', '2015-12-21 16:58:10');
INSERT INTO `project` VALUES ('7', '测试脸部按摩1', '37', '2', '{\"file_name\":\"663eeecd0f4b93c1cdb6f81dd3c185e1.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/663eeecd0f4b93c1cdb6f81dd3c185e1.jpg\",\"raw_name\":\"663eeecd0f4b93c1cdb6f81dd3c185e1\",\"orig_name\":\"Jianyue005.jpg\",\"client_name\":\"Jianyue005.jpg\",\"file_ext\":\".jpg\",\"file_size\":123.65,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '44', '0.01', '根据指定的 字符 个数裁剪字符串。它会保证单词的完整性，所以最终生成的 字符串长度和你指定的长度有可能会有出入根据指定的 字符 个数裁剪字符串。它会保证单词的完整性，所以最终生成的 字符串长度和你指定的长度有可能会有出入', '根据指定的 字符 个数裁剪字符串。它会保证单词的完整性，所以最终生成的 字符串长度和你指定的长度有可能会有出入根据指定的 字符 个数裁剪字符串。它会保证单词的完整性，所以最终生成的 字符串长度和你指定的长度有可能会有出入', '0', '2015-12-21 16:59:18');
INSERT INTO `project` VALUES ('8', '测试脸部按摩2', '37', '2', '{\"file_name\":\"6202aedbeddf55dcb97a745ebbd7b99c.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/6202aedbeddf55dcb97a745ebbd7b99c.jpg\",\"raw_name\":\"6202aedbeddf55dcb97a745ebbd7b99c\",\"orig_name\":\"Jianyue003.jpg\",\"client_name\":\"Jianyue003.jpg\",\"file_ext\":\".jpg\",\"file_size\":136.48,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '44', '0.01', '44', '44', '0', '2015-12-21 17:00:29');
INSERT INTO `project` VALUES ('9', '测试脸部按摩3', '37', '2', '{\"file_name\":\"6f925f02d87040cf649df7585ec15319.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/6f925f02d87040cf649df7585ec15319.jpg\",\"raw_name\":\"6f925f02d87040cf649df7585ec15319\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '44', '0.01', '44', '44', '0', '2015-12-21 17:00:44');
INSERT INTO `project` VALUES ('10', '浦东面部按摩4', '17', '2', '{\"file_name\":\"510f262caffdfca70aed660719ebab01.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/510f262caffdfca70aed660719ebab01.jpg\",\"raw_name\":\"510f262caffdfca70aed660719ebab01\",\"orig_name\":\"zhuoku106.jpg\",\"client_name\":\"zhuoku106.jpg\",\"file_ext\":\".jpg\",\"file_size\":507.62,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '60', '0.01', '浦东面部按摩', '浦东面部按摩', '0', '2015-12-23 16:33:22');

-- ----------------------------
-- Table structure for `shop`
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `shop_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(100) NOT NULL COMMENT '内容',
  `shop_logo` varchar(1000) DEFAULT NULL COMMENT '内容类型',
  `address` varchar(100) NOT NULL,
  `contacts` varchar(50) DEFAULT NULL,
  `contact_number` varchar(32) DEFAULT NULL,
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='店铺表';

-- ----------------------------
-- Records of shop
-- ----------------------------
INSERT INTO `shop` VALUES ('1', '浦东店-1', '{\"file_name\":\"d86046affa9054ed6f10bebf1f4c72bd.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/d86046affa9054ed6f10bebf1f4c72bd.jpg\",\"raw_name\":\"d86046affa9054ed6f10bebf1f4c72bd\",\"orig_name\":\"Jianyue002.jpg\",\"client_name\":\"Jianyue002.jpg\",\"file_ext\":\".jpg\",\"file_size\":117.28,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '浦东路330号', '周小姐', '021-3369665', '0', '2015-12-23 15:14:10');
INSERT INTO `shop` VALUES ('2', '宝山门店1', '{\"file_name\":\"2bccdec2882dcfde093c25b659120a1c.jpg\",\"file_type\":\"image\\/jpeg\",\"file_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/\",\"full_path\":\"D:\\/htdocs\\/project\\/xinya\\/app\\/upload\\/2bccdec2882dcfde093c25b659120a1c.jpg\",\"raw_name\":\"2bccdec2882dcfde093c25b659120a1c\",\"orig_name\":\"zhuoku106.jpg\",\"client_name\":\"zhuoku106.jpg\",\"file_ext\":\".jpg\",\"file_size\":507.62,\"is_image\":true,\"image_width\":1920,\"image_height\":1200,\"image_type\":\"jpeg\",\"image_size_str\":\"width=\\\"1920\\\" height=\\\"1200\\\"\"}', '宝山路30', '周老板', '021-99658788', '0', '2015-12-24 11:48:12');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `last_login_time` datetime DEFAULT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='账户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'guohao', '763d365ba45922a5acf25c3e1e718308', '0', null, '2015-12-22 17:41:17');
INSERT INTO `user` VALUES ('2', 'xinfei', '15aca095dd2b47181d7b2c30b9da5aa1', '1', null, '2015-12-22 17:42:33');
INSERT INTO `user` VALUES ('5', 'tiantian', '6aba289df83e8aada1bdc46f64d7b00b', '0', null, '2015-12-22 18:00:04');
