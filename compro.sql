/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST-MYSQL
 Source Server Type    : MySQL
 Source Server Version : 100420
 Source Host           : localhost:3306
 Source Schema         : compro

 Target Server Type    : MySQL
 Target Server Version : 100420
 File Encoding         : 65001

 Date: 20/10/2023 09:15:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for album
-- ----------------------------
DROP TABLE IF EXISTS `album`;
CREATE TABLE `album`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `published` bit(1) NULL DEFAULT b'0',
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of album
-- ----------------------------
INSERT INTO `album` VALUES (1, 'Event Pengajian Masjid Nurul Ummah', '<p>With the themes and dashboards built by our partners, you can build eye-catching apps and pages &mdash; all using BootstrapVue! The following items have been curated by the BootstrapVue team.&nbsp;</p>', b'1', '2023-10-10 11:41:37', NULL, NULL);
INSERT INTO `album` VALUES (2, 'gallery2', '<p>gallery2</p>', b'1', '2023-10-10 11:51:45', NULL, NULL);

-- ----------------------------
-- Table structure for album_images
-- ----------------------------
DROP TABLE IF EXISTS `album_images`;
CREATE TABLE `album_images`  (
  `album_id` int NOT NULL,
  `image_id` int NOT NULL,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  UNIQUE INDEX `index`(`album_id`, `image_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of album_images
-- ----------------------------
INSERT INTO `album_images` VALUES (1, 20, '2023-10-10 11:46:42', NULL, NULL);
INSERT INTO `album_images` VALUES (1, 21, '2023-10-10 11:46:42', NULL, NULL);
INSERT INTO `album_images` VALUES (1, 22, '2023-10-10 11:46:42', NULL, NULL);
INSERT INTO `album_images` VALUES (1, 23, '2023-10-10 11:46:42', NULL, NULL);
INSERT INTO `album_images` VALUES (1, 24, '2023-10-10 11:46:42', NULL, NULL);
INSERT INTO `album_images` VALUES (1, 25, '2023-10-10 11:46:42', NULL, NULL);
INSERT INTO `album_images` VALUES (1, 27, '2023-10-10 11:50:19', NULL, NULL);
INSERT INTO `album_images` VALUES (1, 28, '2023-10-10 11:50:19', NULL, NULL);
INSERT INTO `album_images` VALUES (2, 29, '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `album_images` VALUES (2, 30, '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `album_images` VALUES (2, 31, '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `album_images` VALUES (2, 32, '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `album_images` VALUES (2, 33, '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `album_images` VALUES (2, 34, '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `album_images` VALUES (2, 35, '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `album_images` VALUES (2, 36, '2023-10-10 11:51:45', NULL, NULL);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------

-- ----------------------------
-- Table structure for ci_session
-- ----------------------------
DROP TABLE IF EXISTS `ci_session`;
CREATE TABLE `ci_session`  (
  `id` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  INDEX `ci_sessions_timestamp`(`timestamp`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ci_session
-- ----------------------------
INSERT INTO `ci_session` VALUES ('7u4kmhi7oeiihkm79jvsgi9f1kc4a8vp', '127.0.0.1', 1697698966, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373639383936363B);
INSERT INTO `ci_session` VALUES ('2na3hldmdjdth960rtrbqkd1uu27jsb7', '127.0.0.1', 1697699279, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373639393237393B);
INSERT INTO `ci_session` VALUES ('s6ldtspdma71o643uohqfqmnotcaphd8', '127.0.0.1', 1697699593, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373639393539333B);
INSERT INTO `ci_session` VALUES ('iqcc3mg0ncej5e9u26noiv65jsdtfnhr', '127.0.0.1', 1697699983, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373639393938333B);
INSERT INTO `ci_session` VALUES ('jdmqn6do14q3s7gh0m97ovej10a2rfn9', '127.0.0.1', 1697700382, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730303338323B);
INSERT INTO `ci_session` VALUES ('pu34ush6b7pfjtjg31vljed3ka4sthm2', '127.0.0.1', 1697700005, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730303030353B);
INSERT INTO `ci_session` VALUES ('i0rfcgbskgncv0nae9akcqaggo28sa6v', '127.0.0.1', 1697700697, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730303639373B);
INSERT INTO `ci_session` VALUES ('tqrpkdk4rjdd1o8jbru01te6mo6oravc', '127.0.0.1', 1697701015, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730313031353B);
INSERT INTO `ci_session` VALUES ('m6jdf4lgbsa4a5j3p42hnu3uocp21o5v', '127.0.0.1', 1697701317, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730313331373B);
INSERT INTO `ci_session` VALUES ('e1vcbt33vvqfbtb4q0a82l4d9578sdtr', '127.0.0.1', 1697701618, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730313631383B);
INSERT INTO `ci_session` VALUES ('ii6ctkd0l9v38v99o9lrj8re4cd2rard', '127.0.0.1', 1697701985, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730313938353B);
INSERT INTO `ci_session` VALUES ('apsej8ce4vttsqlh3sqb31sdstpeori2', '127.0.0.1', 1697702338, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730323333383B);
INSERT INTO `ci_session` VALUES ('tue2taojj299np97vcvgo7mvcemv8pdf', '127.0.0.1', 1697702658, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730323635383B);
INSERT INTO `ci_session` VALUES ('dmg1da16o990cnamdrddd93lnqdeel6p', '127.0.0.1', 1697703071, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730333037313B);
INSERT INTO `ci_session` VALUES ('dbiuk2nrfjd2s3hevbnjo9p65ht1dhd8', '127.0.0.1', 1697703388, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730333338383B);
INSERT INTO `ci_session` VALUES ('91rrnbb9sd4elea4j91ieo3k81gpk1nl', '127.0.0.1', 1697703693, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730333639333B);
INSERT INTO `ci_session` VALUES ('on12cucvo0vf9k54occ7sf5dc98tl8lp', '127.0.0.1', 1697704072, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730343037323B);
INSERT INTO `ci_session` VALUES ('jgp006pquqss1nqf32f0ti49cc6jrn8b', '127.0.0.1', 1697703946, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730333934363B);
INSERT INTO `ci_session` VALUES ('00pqasreb2qu37jah4vv6u7182fr15g8', '127.0.0.1', 1697704449, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730343434393B);
INSERT INTO `ci_session` VALUES ('v47mk6ieiionbd0mu0njhmlc7p2ecahu', '127.0.0.1', 1697704851, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730343835313B);
INSERT INTO `ci_session` VALUES ('t5dbel3atn9j46ool71r7r1lqgh6jn8s', '127.0.0.1', 1697705156, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730353135363B);
INSERT INTO `ci_session` VALUES ('j34vkhdv8i37mubo0ghlps5iea34t2ho', '127.0.0.1', 1697705541, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730353534313B);
INSERT INTO `ci_session` VALUES ('l2lt9hj4qma908grs8n8fiaf4e0mlpro', '127.0.0.1', 1697705895, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730353839353B);
INSERT INTO `ci_session` VALUES ('i6lo2i5hvpa9d0ha49dklnd9fs3s1n5c', '127.0.0.1', 1697709860, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730393836303B);
INSERT INTO `ci_session` VALUES ('e5i8r1fbccnjc6vj1337qlgja1bv34ls', '127.0.0.1', 1697709882, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373730393836303B);
INSERT INTO `ci_session` VALUES ('fbivr0sin0ks5csn13jsvlu79bl2t2nd', '127.0.0.1', 1697766274, 0x5F5F63695F6C6173745F726567656E65726174657C693A313639373736363235393B);

-- ----------------------------
-- Table structure for companies
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `maps` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of companies
-- ----------------------------
INSERT INTO `companies` VALUES (1, 'PT. Dinamika Cahaya Pustaka ( Gresik )', 'Jl. Raya Wringinanom Km 30-31, Gresik', '031-8982999', NULL, NULL, '', '', '2023-10-19 14:52:43', NULL, NULL);
INSERT INTO `companies` VALUES (2, 'asd', 'assd', 'asd', NULL, NULL, 'assdasasd', 'asdasd', '2023-10-19 15:11:25', '2023-10-19 15:12:51', '2023-10-19 15:12:51');

-- ----------------------------
-- Table structure for contains
-- ----------------------------
DROP TABLE IF EXISTS `contains`;
CREATE TABLE `contains`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `lang` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'ID' COMMENT 'ID,EN',
  `section` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `index`(`id`, `code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contains
-- ----------------------------
INSERT INTO `contains` VALUES (1, '%address%', '1', 'ID', 'location', '2023-09-18 15:40:37', '2023-10-05 11:42:10', NULL);
INSERT INTO `contains` VALUES (3, '%mapcoor%', '2', 'ID', 'location', '2023-09-18 15:41:29', '2023-10-05 11:42:10', NULL);
INSERT INTO `contains` VALUES (4, '%email%', '3', 'ID', 'location', '2023-09-18 15:41:35', '2023-10-05 11:42:11', NULL);
INSERT INTO `contains` VALUES (5, '%phone%', '4', 'ID', 'location', '2023-09-18 15:42:05', '2023-10-05 11:42:11', NULL);
INSERT INTO `contains` VALUES (9, '%keywords%', 'Al quran, Publishing, Kitab Suci, Cahaya Quran, Temprina', 'ID', 'site', '2023-09-25 10:28:09', '2023-10-09 07:38:55', NULL);
INSERT INTO `contains` VALUES (10, '%description%', 'CahayaQuran adalah perusahaan publishing yang menerbitkan mushaf Al Quran, Berdiri sejak 2017 dengan nama PT. Dinamika Cahaya Pustaka berbasis di kota Bandung dan Gresik.', 'ID', 'site', '2023-09-25 10:28:20', '2023-10-09 07:41:37', NULL);
INSERT INTO `contains` VALUES (11, '%logo%', 'files/upload/logo-utama.png', 'ID', 'site', '2023-09-21 14:17:37', '2023-10-10 17:00:59', NULL);
INSERT INTO `contains` VALUES (12, '%title%', 'CahayQuran', 'ID', 'site', '2023-09-25 09:15:51', '2023-10-09 10:30:33', NULL);
INSERT INTO `contains` VALUES (15, '%profile%', '<p>Profile</p>', 'ID', 'profile', '2023-10-18 12:28:46', '2023-10-18 13:29:50', NULL);
INSERT INTO `contains` VALUES (16, '%profileimg%', 'files/upload/img-profile.jpg', 'ID', 'profile', '2023-10-18 12:28:56', '2023-10-18 13:29:54', NULL);
INSERT INTO `contains` VALUES (17, '%visimisi%', '<p>Visi</p>\n<ul>\n<li>visi satu</li>\n<li>visi dua</li>\n</ul>\n<p>Misi</p>\n<ul>\n<li>misi satu</li>\n<li>misi dua</li>\n</ul>', 'ID', 'profile', '2023-10-18 12:40:25', '2023-10-18 13:29:54', NULL);
INSERT INTO `contains` VALUES (18, '%visimisiimg%', 'files/upload/img-visimisi.jpg', 'ID', 'profile', '2023-10-18 12:40:29', '2023-10-18 13:29:54', NULL);

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `caption` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `filepath` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of images
-- ----------------------------
INSERT INTO `images` VALUES (1, NULL, '', 'files/upload/25f365e7724f55bba6a5ce6d56dba1411f6002ae8b733cacb5.webp', 'product', '2023-10-10 11:36:29', NULL, NULL);
INSERT INTO `images` VALUES (2, NULL, '', 'files/upload/6ad30ed8e8a8ef60e9213a2899f5e527c154b9780568ab3bd2.jpeg', 'product', '2023-10-10 11:36:29', NULL, NULL);
INSERT INTO `images` VALUES (3, NULL, '', 'files/upload/943813d665ce3fddd5b57e5db764f792b4fcd9f45bd6082613.jpeg', 'product', '2023-10-10 11:36:29', NULL, NULL);
INSERT INTO `images` VALUES (4, NULL, '', 'files/upload/4137897cde00a7f8239adaff324825a42ca0aedb8441f0792b.jpeg', 'product', '2023-10-10 11:36:29', '2023-10-10 16:33:30', '2023-10-10 16:33:30');
INSERT INTO `images` VALUES (5, NULL, NULL, 'files/upload/05e332054487cf66b682af86def9eaa4.jpeg', '', '2023-10-10 11:37:52', NULL, NULL);
INSERT INTO `images` VALUES (6, NULL, '', 'files/upload/399e4089876d66b98c5329fc34464a5babb6ccfb6bd3fc8cbe.jpeg', 'article', '2023-10-10 11:39:31', NULL, NULL);
INSERT INTO `images` VALUES (7, NULL, '', 'files/upload/e559ba2150480edf93568c4e15b3f195780ba97456b6c54028.jpeg', 'album', '2023-10-10 11:41:37', '2023-10-10 11:43:14', '2023-10-10 11:43:14');
INSERT INTO `images` VALUES (8, NULL, '', 'files/upload/4e3efa05289d72722af15dfc6fab9308d51cbd0b5cbcb972d5.jpeg', 'album', '2023-10-10 11:41:37', '2023-10-10 11:43:16', '2023-10-10 11:43:16');
INSERT INTO `images` VALUES (9, NULL, '', 'files/upload/6ee9a3a8ba5d704f0bc1417e39d2b1ec399429d27de4973ff9.webp', 'album', '2023-10-10 11:41:37', '2023-10-10 11:45:52', '2023-10-10 11:45:52');
INSERT INTO `images` VALUES (10, NULL, '', 'files/upload/9604679b469f8429259c1ce6cb27a597b9e12096c7df13b2e1.png', 'album', '2023-10-10 11:41:37', '2023-10-10 11:43:18', '2023-10-10 11:43:18');
INSERT INTO `images` VALUES (11, NULL, '', 'files/upload/1bbe481e2b3028f5ff0c37c37fec1c3691ce78a053bc01aaef.jpeg', 'album', '2023-10-10 11:41:37', '2023-10-10 11:45:53', '2023-10-10 11:45:53');
INSERT INTO `images` VALUES (12, NULL, '', 'files/upload/9165e49bcc3ba92cc45f36387edc91fb16732d310a84b45215.jpeg', 'album', '2023-10-10 11:41:37', '2023-10-10 11:45:55', '2023-10-10 11:45:55');
INSERT INTO `images` VALUES (13, NULL, '', 'files/upload/683d2cb4b1b10f2567a501a2782e3326e2d12009f27d27354d.png', 'album', '2023-10-10 11:41:37', '2023-10-10 11:45:56', '2023-10-10 11:45:56');
INSERT INTO `images` VALUES (14, NULL, '', 'files/upload/ea0b1c5e63dce170231ada573b23cfcf91cf87b29bb499d0a9.jpeg', 'album', '2023-10-10 11:41:37', '2023-10-10 11:45:58', '2023-10-10 11:45:58');
INSERT INTO `images` VALUES (15, NULL, '', 'files/upload/d4ca8c6c108179b51289a45d3432f7aee9f476430e500acd78.jpeg', 'album', '2023-10-10 11:43:42', '2023-10-10 11:43:49', '2023-10-10 11:43:49');
INSERT INTO `images` VALUES (16, NULL, '', 'files/upload/f88600ad4e84fff3f91cb52b438e0a92b3efdef627ee72bebe.jpeg', 'album', '2023-10-10 11:43:42', '2023-10-10 11:46:00', '2023-10-10 11:46:00');
INSERT INTO `images` VALUES (17, NULL, '', 'files/upload/e968785d4d9c599616b382e065e81ac77b51837ac2d1a67a5a.jpeg', 'album', '2023-10-10 11:43:42', '2023-10-10 11:46:01', '2023-10-10 11:46:01');
INSERT INTO `images` VALUES (18, NULL, '', 'files/upload/9fa2056ea07371a7287d548b15b3753f11c0b8928fa4ff7272.jpeg', 'album', '2023-10-10 11:43:55', '2023-10-10 11:46:04', '2023-10-10 11:46:04');
INSERT INTO `images` VALUES (19, NULL, '', 'files/upload/432bfe9c16512ddca006a0528391dda9dbe1a4b80b97bed401.jpeg', 'album', '2023-10-10 11:46:42', '2023-10-10 11:48:24', '2023-10-10 11:48:24');
INSERT INTO `images` VALUES (20, NULL, '', 'files/upload/9aa3c982befd415673a0c76670d8c8f64df8e95aa0c1afbb76.jpeg', 'album', '2023-10-10 11:46:42', NULL, NULL);
INSERT INTO `images` VALUES (21, NULL, '', 'files/upload/3061e32e4789c6fb3bd56f59f04b172f122a2a65f8cd9f3d90.jpeg', 'album', '2023-10-10 11:46:42', NULL, NULL);
INSERT INTO `images` VALUES (22, NULL, '', 'files/upload/8c6913556a86041a38ee41e6e9414c83d372b423e0d6f7cad4.jpeg', 'album', '2023-10-10 11:46:42', NULL, NULL);
INSERT INTO `images` VALUES (23, NULL, '', 'files/upload/5b2310ef50a6f9b98efa7acf83b3677e6b6cf4c62dcaa52df9.png', 'album', '2023-10-10 11:46:42', NULL, NULL);
INSERT INTO `images` VALUES (24, NULL, '', 'files/upload/c1d3999fbaffc8e461711794d83ec21ca822bd1bd7ff4cddd8.jpeg', 'album', '2023-10-10 11:46:42', NULL, NULL);
INSERT INTO `images` VALUES (25, NULL, '', 'files/upload/c8e46d67b2689b3f43581ddd24713a6cbde7a6a3d81aea380a.jpeg', 'album', '2023-10-10 11:46:42', NULL, NULL);
INSERT INTO `images` VALUES (26, NULL, '', 'files/upload/ba63d94602853aeb7c224d1866d314bd6b57728316be29e4fe.jpeg', 'album', '2023-10-10 11:46:42', '2023-10-10 11:48:30', '2023-10-10 11:48:30');
INSERT INTO `images` VALUES (27, NULL, '', 'files/upload/fff228de7b427d775f080539eb0b9d46b173b67a0d681f1ab7.jpeg', 'album', '2023-10-10 11:50:19', NULL, NULL);
INSERT INTO `images` VALUES (28, NULL, '', 'files/upload/d40d249d4427326dbcb1aa0e33fdadd83e6f94fb577bf0a9b0.jpeg', 'album', '2023-10-10 11:50:19', NULL, NULL);
INSERT INTO `images` VALUES (29, NULL, '', 'files/upload/37e68cd94ca770f3e17e14c274ca5be0185f89860d9b9e6791.jpeg', 'album', '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `images` VALUES (30, NULL, '', 'files/upload/380636344e80c0be33f3317a8a7711d448571145d025ecaa95.jpeg', 'album', '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `images` VALUES (31, NULL, '', 'files/upload/f3db180e72a88ea3174b1e9e640c8e4b7348c29ee94dfeaba7.jpeg', 'album', '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `images` VALUES (32, NULL, '', 'files/upload/c743dde090970f5e12f1a9d4d133eacfc6c873f26ec2420016.jpeg', 'album', '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `images` VALUES (33, NULL, '', 'files/upload/0cedb659dd1443d7879449920d3f5d007b24922680f042e05b.jpeg', 'album', '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `images` VALUES (34, NULL, '', 'files/upload/a62b37986a78ae9cb19e501ca68171dbf48d30386400993093.jpeg', 'album', '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `images` VALUES (35, NULL, '', 'files/upload/ade1864c7c2b7dfe5e082f763ac57ece8c0156840668e252ca.jpeg', 'album', '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `images` VALUES (36, NULL, '', 'files/upload/8125df8710bd497bd7d156e966f33d2dabfb4815d8fdcce331.jpeg', 'album', '2023-10-10 11:51:45', NULL, NULL);
INSERT INTO `images` VALUES (37, 'ada', NULL, 'files/upload/e3302ed0ceb386dc0e8fc3802c03e8b0.png', 'images', '2023-10-10 14:18:29', NULL, NULL);
INSERT INTO `images` VALUES (38, 'asda', NULL, 'files/upload/e3302ed0ceb386dc0e8fc3802c03e8b0.png', 'slide', '2023-10-10 14:19:39', '2023-10-10 14:25:00', '2023-10-10 14:25:00');
INSERT INTO `images` VALUES (39, 'asda', NULL, 'files/upload/e3302ed0ceb386dc0e8fc3802c03e8b0.png', 'slide', '2023-10-10 14:19:54', '2023-10-10 14:25:27', '2023-10-10 14:25:27');
INSERT INTO `images` VALUES (40, 'tes', 'asda', 'files/upload/e3302ed0ceb386dc0e8fc3802c03e8b0.png', 'slide', '2023-10-10 14:26:31', '2023-10-10 16:51:57', '2023-10-10 16:51:57');
INSERT INTO `images` VALUES (41, 'asda', '', 'files/upload/e3302ed0ceb386dc0e8fc3802c03e8b0.png', 'partner', '2023-10-10 14:27:46', '2023-10-10 14:32:04', '2023-10-10 14:32:04');
INSERT INTO `images` VALUES (42, 'asdasd', 'asdasd', 'files/upload/e3302ed0ceb386dc0e8fc3802c03e8b0.png', 'banner', '2023-10-10 14:28:22', '2023-10-10 14:32:06', '2023-10-10 14:32:06');
INSERT INTO `images` VALUES (43, '22222222222', 'asdasdasdasd', 'files/upload/e3302ed0ceb386dc0e8fc3802c03e8b0.png', 'slide', '2023-10-10 14:28:32', '2023-10-10 14:28:40', '2023-10-10 14:28:40');
INSERT INTO `images` VALUES (44, 'rrrr', 'werwefsdfds', 'files/upload/4fe185dffcecca8950a71609d4bca71a.jpeg', 'slide', '2023-10-10 14:33:48', NULL, NULL);
INSERT INTO `images` VALUES (45, NULL, '', 'files/upload/f338262dd67f04daf9f2d26298509ec90dab497779e38e7695.jpeg', 'product', '2023-10-10 16:23:27', NULL, NULL);
INSERT INTO `images` VALUES (46, NULL, '', 'files/upload/0cc5c7b9fe4f901353204855a8b3b9b70baa4c2781b373f28f.jpeg', 'product', '2023-10-10 16:47:21', NULL, NULL);
INSERT INTO `images` VALUES (47, NULL, '', 'files/upload/99d96f9782a6c50cb591a57b7abcd14826cec56372fcf9421f.webp', 'product', '2023-10-10 16:47:21', NULL, NULL);
INSERT INTO `images` VALUES (48, NULL, '', 'files/upload/aeec17c37b3871ddd7f3abd7f1b72cf238d1a924e419a9ff7d.jpeg', 'product', '2023-10-10 16:47:21', NULL, NULL);
INSERT INTO `images` VALUES (49, 'asdsad', 'asdasd', 'files/upload/e3302ed0ceb386dc0e8fc3802c03e8b0.png', 'slide', '2023-10-10 16:52:11', NULL, NULL);
INSERT INTO `images` VALUES (50, 'penghargaan', '', 'files/upload/fa54e8dacdcfc3f4e6673cd4a20957e9.jpeg', 'achievement', '2023-10-18 13:34:14', NULL, NULL);

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `index` int NULL DEFAULT NULL,
  `sort` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'Beranda', 'index', 0, 0, '2023-10-10 14:54:13', NULL, NULL);
INSERT INTO `menu` VALUES (2, 'Katalog', 'catalogue', 0, 2, '2023-10-10 15:00:22', NULL, NULL);
INSERT INTO `menu` VALUES (3, 'Produk', 'product', 2, 1, '2023-10-10 15:00:38', NULL, NULL);
INSERT INTO `menu` VALUES (4, 'x', 'x', 1, 1, '2023-10-10 15:17:18', '2023-10-10 15:21:52', '2023-10-10 15:21:52');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `images_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `published` binary(1) NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (1, 'Documentation information', '<p>In many of the examples shown in BootstrapVue\'s documentation, you may see the use of CSS classes such as <code class=\"text-nowrap\">ml-2</code>, <code class=\"text-nowrap\">py-1</code>, etc. These are Bootstrap v4.6 utility classes that help control padding, margins, positioning, and more. You can find information on these classes in the <a class=\"font-weight-bold\" href=\"https://dev.bootstrap-vue.org/docs/reference/utility-classes\">Utility Classes</a> reference section.</p>\n<p>Many of the examples in this documentation are <em>live</em> and can be edited in-place for an enhanced learning experience (note some examples may not work in IE 11 due to use of ES6 JavaScript code in the <code class=\"text-nowrap\" translate=\"translate\">&lt;template&gt;</code> sections).</p>\n<p>BootstrapVue also provides an <a class=\"font-weight-bold\" href=\"https://dev.bootstrap-vue.org/play\">interactive playground</a> where you can experiment with the various components and export your results to JSFiddle, CodePen, and/or CodeSandbox<img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"../../files/upload/05e332054487cf66b682af86def9eaa4.jpeg\" alt=\"\" width=\"400\" height=\"400\"></p>\n<h3 id=\"css-box-sizing\" class=\"bv-no-focus-ring\"><span class=\"bd-content-title\">CSS box-sizing</span></h3>\n<p>For more straightforward sizing in CSS, the global <code class=\"text-nowrap\" translate=\"translate\">box-sizing</code> value is switched from <code class=\"text-nowrap\" translate=\"translate\">content-box</code> to <code class=\"text-nowrap\" translate=\"translate\">border-box</code>. This ensures <code class=\"text-nowrap\" translate=\"translate\">padding</code> does not affect the final computed width of an element, but it can cause problems with some third party software like Google Maps and Google Custom Search Engine.&nbsp;</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"../../files/upload/05e332054487cf66b682af86def9eaa4.jpeg\" alt=\"\" width=\"400\" height=\"400\"></p>', NULL, 'Artikel', '6', 0x31, '2023-10-10 11:39:31', '2023-10-10 15:55:29', NULL);
INSERT INTO `news` VALUES (2, 'Documentation information', '<p>In many of the examples shown in BootstrapVue\'s documentation, you may see the use of CSS classes such as <code class=\"text-nowrap\">ml-2</code>, <code class=\"text-nowrap\">py-1</code>, etc. These are Bootstrap v4.6 utility classes that help control padding, margins, positioning, and more. You can find information on these classes in the <a class=\"font-weight-bold\" href=\"https://dev.bootstrap-vue.org/docs/reference/utility-classes\">Utility Classes</a> reference section.</p>\n<p>Many of the examples in this documentation are <em>live</em> and can be edited in-place for an enhanced learning experience (note some examples may not work in IE 11 due to use of ES6 JavaScript code in the <code class=\"text-nowrap\" translate=\"translate\">&lt;template&gt;</code> sections).</p>\n<p>BootstrapVue also provides an <a class=\"font-weight-bold\" href=\"https://dev.bootstrap-vue.org/play\">interactive playground</a> where you can experiment with the various components and export your results to JSFiddle, CodePen, and/or CodeSandbox<img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"../../files/upload/05e332054487cf66b682af86def9eaa4.jpeg\" alt=\"\" width=\"400\" height=\"400\"></p>\n<h3 id=\"css-box-sizing\" class=\"bv-no-focus-ring\"><span class=\"bd-content-title\">CSS box-sizing</span></h3>\n<p>For more straightforward sizing in CSS, the global <code class=\"text-nowrap\" translate=\"translate\">box-sizing</code> value is switched from <code class=\"text-nowrap\" translate=\"translate\">content-box</code> to <code class=\"text-nowrap\" translate=\"translate\">border-box</code>. This ensures <code class=\"text-nowrap\" translate=\"translate\">padding</code> does not affect the final computed width of an element, but it can cause problems with some third party software like Google Maps and Google Custom Search Engine.&nbsp;</p>\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"../../files/upload/05e332054487cf66b682af86def9eaa4.jpeg\" alt=\"\" width=\"400\" height=\"400\"></p>', NULL, 'Artikel', '6', 0x31, '2023-10-10 11:39:31', '2023-10-16 12:08:13', '2023-10-16 12:08:13');

-- ----------------------------
-- Table structure for person
-- ----------------------------
DROP TABLE IF EXISTS `person`;
CREATE TABLE `person`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `num` int NOT NULL,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of person
-- ----------------------------
INSERT INTO `person` VALUES (1, 'Uyeah Rukmawati', 'General Manager', '[{\"name\":\"facebook\",\"value\":\"fb.com\\/asda.asda\"},{\"name\":\"instagram\",\"value\":\"@asdasda.asd\"},{\"name\":\"linkedin\",\"value\":\"\"}]', 'files/upload/5e4f290e3fcbeb893f9ad2ffae168ff311f1f30fddbf6ac244.jpeg', 1, '2023-10-19 14:13:56', '2023-10-19 15:15:18', NULL);
INSERT INTO `person` VALUES (2, 'Maudy Ayunda', 'Direktur', '[{\"name\":\"facebook\",\"value\":\"fb.com\\/maudy.ayunda\"},{\"name\":\"instagram\",\"value\":\"@maudyayunda\"},{\"name\":\"linkedin\",\"value\":\"\"}]', 'files/upload/5455113c5557e5c89c491f0d1264e304d51fb4760326562468.jpeg', 1, '2023-10-19 14:28:23', '2023-10-19 15:15:18', NULL);

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `price` decimal(20, 2) NULL DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `link` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `published` binary(1) NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `update_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (1, 'xxxxxxxx', '<p>xxxxxxxxxxxx</p>', 1000.00, 'kitab', NULL, 0x30, '2023-10-10 11:36:29', '2023-10-18 13:38:47', NULL);
INSERT INTO `product` VALUES (2, 'xxxxxxxx', '<p>xxxxxxxxxxxx</p>', 1000.00, 'al-quran', NULL, 0x31, '2023-10-10 11:36:29', '2023-10-18 13:38:25', NULL);

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images`  (
  `product_id` int NOT NULL,
  `image_id` int NOT NULL,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  UNIQUE INDEX `unique`(`product_id`, `image_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES (1, 1, '2023-10-10 11:36:29', NULL, NULL);
INSERT INTO `product_images` VALUES (1, 2, '2023-10-10 11:36:29', NULL, NULL);
INSERT INTO `product_images` VALUES (1, 3, '2023-10-10 11:36:29', NULL, NULL);
INSERT INTO `product_images` VALUES (2, 45, '2023-10-10 16:23:27', NULL, NULL);
INSERT INTO `product_images` VALUES (2, 46, '2023-10-10 16:47:21', NULL, NULL);
INSERT INTO `product_images` VALUES (2, 47, '2023-10-10 16:47:21', NULL, NULL);
INSERT INTO `product_images` VALUES (2, 48, '2023-10-10 16:47:21', NULL, NULL);

-- ----------------------------
-- Table structure for product_stores
-- ----------------------------
DROP TABLE IF EXISTS `product_stores`;
CREATE TABLE `product_stores`  (
  `product_id` int NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  UNIQUE INDEX `unique`(`product_id`, `name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_stores
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'default.jpg',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `is_confirmed` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'sarif', 'me@sarif.my.id', '$2y$10$GcaVN4KOBXD.gMVfkM9SZe2xqJxjPtYK6jCzYhhnsSKl9yXur1UMq', 'default.jpg', '2023-09-29 16:33:43', NULL, 0, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
