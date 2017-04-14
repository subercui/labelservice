/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 100121
Source Host           : localhost:3306
Source Database       : label

Target Server Type    : MYSQL
Target Server Version : 100121
File Encoding         : 65001

Date: 2017-02-09 20:50:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for feature
-- ----------------------------
DROP TABLE IF EXISTS `feature`;
CREATE TABLE `feature` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `CaseID` varchar(12) DEFAULT '' COMMENT '文件名',
  `Problem` varchar(1204) DEFAULT NULL COMMENT '问题',
  `Anwser` varchar(255) DEFAULT '' COMMENT '采纳回答',
  `GetPay` tinyint(4) DEFAULT NULL COMMENT '是否算工伤/可以拿到赔偿',
  `AssoPay` tinyint(4) DEFAULT NULL COMMENT '是否关于赔偿金额',
  `InjuryDegree` tinyint(4) DEFAULT NULL COMMENT '是否关于工伤分级',
  `InjRange` tinyint(4) DEFAULT NULL COMMENT '是否关于工伤赔偿的覆盖范围',
  `BearPay` tinyint(4) DEFAULT NULL COMMENT '是否关于赔偿金承担方',
  `PayMeth` tinyint(4) DEFAULT NULL COMMENT '是否关于赔偿支付方式选择',
  `GenMeth` tinyint(4) DEFAULT NULL COMMENT '是否是一般性解决方案',
  `AppPay` tinyint(4) DEFAULT NULL COMMENT '是否关于如何申请工伤赔偿',
  `CondUnre` tinyint(4) DEFAULT NULL COMMENT '是否是和状态无关的一般性问题',
  `WorkTime` tinyint(4) DEFAULT NULL COMMENT '是否是工作时间',
  `WorkPlace` tinyint(4) DEFAULT NULL COMMENT '是否在工作场所',
  `JobRel` tinyint(4) DEFAULT NULL COMMENT '是否从事和工作相关事务',
  `DiseRel` tinyint(4) DEFAULT NULL COMMENT '是否和职业病相关',
  `OutForPub` tinyint(4) DEFAULT NULL COMMENT '是否因公外出',
  `OnOff` tinyint(4) DEFAULT NULL COMMENT '是否上下班',
  `Rescue` tinyint(4) DEFAULT NULL COMMENT '是否抢险救灾',
  `Service` tinyint(4) DEFAULT NULL COMMENT '是否服役相关',
  `Crime` tinyint(4) DEFAULT NULL COMMENT '是否故意犯罪',
  `Drink` tinyint(4) DEFAULT NULL COMMENT '是否醉酒或吸毒',
  `Suicide` tinyint(4) DEFAULT NULL COMMENT '是否自残或自杀',
  `InjIden` tinyint(4) DEFAULT NULL COMMENT '是否已做工伤认定',
  `Valid` tinyint(4) DEFAULT NULL COMMENT '是否在工伤认定有效期内',
  `InjDate` date DEFAULT NULL COMMENT '工伤发生的时间',
  `Year` tinyint(4) DEFAULT NULL COMMENT '年',
  `Month` tinyint(4) DEFAULT NULL COMMENT '月',
  `Day` tinyint(4) DEFAULT NULL COMMENT '日',
  `AdmitInj` tinyint(4) DEFAULT NULL COMMENT '雇主是否承认工伤',
  `WillPay` tinyint(4) DEFAULT NULL COMMENT '雇主是否原意赔付',
  `AmountDispute` tinyint(4) DEFAULT NULL COMMENT '数额是否存在争议',
  `RangeDispute` tinyint(4) DEFAULT NULL COMMENT '覆盖范围是否存在争议',
  `SettlePrivate` tinyint(4) DEFAULT NULL COMMENT '雇主是否想私了',
  `SickDispute` tinyint(4) DEFAULT NULL COMMENT '是否有病假争议',
  `LaborArbi` tinyint(4) DEFAULT NULL COMMENT '是否经过劳动仲裁',
  `LaborDisp` tinyint(4) DEFAULT NULL COMMENT '是否是劳务派遣',
  `Employ` tinyint(4) DEFAULT NULL COMMENT '和单位还是个人存在雇佣关系',
  `ExistEmp` tinyint(4) DEFAULT NULL COMMENT '是否存在雇佣关系',
  `Qualify` tinyint(4) DEFAULT NULL COMMENT '雇主是否有资质',
  `EndLabor` tinyint(4) DEFAULT NULL COMMENT '是否终止劳动关系',
  `LaborContr` tinyint(4) DEFAULT NULL COMMENT '工伤发生时是否有劳动合同',
  `HaveContr` tinyint(4) DEFAULT NULL COMMENT '是否有劳动合同在手上',
  `ValidContr` tinyint(4) DEFAULT NULL COMMENT '劳动合同是否有效',
  `ConfrmLevel` tinyint(4) DEFAULT NULL COMMENT '是否已由权威机构定级',
  `Insurance` tinyint(4) DEFAULT NULL COMMENT '是否已投保',
  `PersonalWage` float(12,0) DEFAULT NULL COMMENT '个人平均月工资',
  `SocialWage` float(12,0) DEFAULT NULL COMMENT '社会平均月工资',
  `HaveMedicalFee` tinyint(4) DEFAULT NULL COMMENT '是否有医疗费开销',
  `MedicalFee` float(12,0) DEFAULT NULL COMMENT '医疗费',
  `BearMedicalFee` tinyint(4) DEFAULT NULL COMMENT '雇主是否已承担医疗费',
  `Identity` tinyint(4) DEFAULT NULL COMMENT '伤者、伤者家属、雇主、其他',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;
