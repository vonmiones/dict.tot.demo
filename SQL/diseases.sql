/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : dict_tot

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 02/04/2023 23:15:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for diseases
-- ----------------------------
DROP TABLE IF EXISTS `diseases`;
CREATE TABLE `diseases`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `symptoms` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `treatment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dtcreated` datetime NULL DEFAULT current_timestamp,
  `dtupdated` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `datastatus` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 101 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of diseases
-- ----------------------------
INSERT INTO `diseases` VALUES (1, 'Alzheimer\'s disease', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (2, 'Parkinson\'s disease', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (3, 'Multiple sclerosis', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (4, 'Malaria', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (5, 'Tuberculosis', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (6, 'HIV/AIDS', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (7, 'Cancer', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (8, 'Diabetes', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (9, 'Hypertension', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (10, 'Asthma', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (11, 'Arthritis', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (12, 'Epilepsy', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (13, 'Schizophrenia', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (14, 'Depression', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (15, 'Anxiety disorders', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (16, 'Anemia', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (17, 'Hemophilia', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (18, 'Sickle cell anemia', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (19, 'Cystic fibrosis', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (20, 'Influenza', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (21, 'Pneumonia', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (22, 'Cholera', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (23, 'Typhoid fever', NULL, NULL, NULL, '2023-03-30 08:22:27', '2023-03-30 08:22:27', NULL);
INSERT INTO `diseases` VALUES (24, 'Yellow fever', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (25, 'Dengue fever', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (26, 'Chikungunya', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (27, 'Zika virus', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (28, 'Ebola virus disease', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (29, 'Measles', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (30, 'Rubella', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (31, 'Chickenpox', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (32, 'Shingles', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (33, 'Hepatitis B', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (34, 'Hepatitis C', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (35, 'Cirrhosis', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (36, 'Heart disease', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (37, 'Stroke', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (38, 'Kidney disease', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (39, 'Meningitis', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (40, 'Encephalitis', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (41, 'Rabies', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (42, 'Lyme disease', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (43, 'Chlamydia', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (44, 'Gonorrhea', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (45, 'Syphilis', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (46, 'Trichomoniasis', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (47, 'Human papillomavirus (HPV)', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (48, 'Herpes simplex virus', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (49, 'Varicella-zoster virus', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (50, 'West Nile virus', NULL, NULL, NULL, '2023-03-30 08:22:28', '2023-03-30 08:22:28', NULL);
INSERT INTO `diseases` VALUES (51, 'Leukemia', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (52, 'Lymphoma', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (53, 'Melanoma', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (54, 'Bladder cancer', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (55, 'Breast cancer', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (56, 'Colorectal cancer', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (57, 'Lung cancer', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (58, 'Prostate cancer', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (59, 'Ovarian cancer', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (60, 'Pancreatic cancer', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (61, 'Rheumatoid arthritis', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (62, 'Lupus', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (63, 'Psoriasis', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (64, 'Eczema', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (65, 'Acne', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (66, 'Vitiligo', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (67, 'Alopecia', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (68, 'Osteoporosis', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (69, 'Gout', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (70, 'Crohn\'s disease', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (71, 'Ulcerative colitis', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (72, 'Irritable bowel syndrome (IBS)', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (73, 'Diverticulitis', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (74, 'Celiac disease', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (75, 'Food allergies', NULL, NULL, NULL, '2023-03-30 08:22:29', '2023-03-30 08:22:29', NULL);
INSERT INTO `diseases` VALUES (76, 'Hay fever', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (77, 'Hives', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (78, 'Asthma', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (79, 'Chronic obstructive pulmonary disease (COPD)', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (80, 'Sleep apnea', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (81, 'Chronic fatigue syndrome', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (82, 'Fibromyalgia', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (83, 'Chronic pain', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (84, 'Carpal tunnel syndrome', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (85, 'Tennis elbow', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (86, 'Plantar fasciitis', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (87, 'Osteoarthritis', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (88, 'Sciatica', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (89, 'Scoliosis', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (90, 'Glaucoma', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (91, 'Cataracts', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (92, 'Macular degeneration', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (93, 'Retinopathy', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (94, 'Diabetes-related complications', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (95, 'Hypothyroidism', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (96, 'Hyperthyroidism', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (97, 'Addison\'s disease', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (98, 'Cushing\'s syndrome', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (99, 'Polycystic ovary syndrome (PCOS)', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);
INSERT INTO `diseases` VALUES (100, 'Endometriosis', NULL, NULL, NULL, '2023-03-30 08:22:30', '2023-03-30 08:22:30', NULL);

SET FOREIGN_KEY_CHECKS = 1;
